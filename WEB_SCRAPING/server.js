const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const puppeteer = require('puppeteer');
const randomUseragent = require('random-useragent');
const mysql = require('mysql2'); // Importa mysql2
const db = require('./db'); // Importa la conexión a la base de datos
const moment = require('moment');

const app = express();

// Configura CORS para permitir solicitudes desde cualquier origen
app.use(cors());

app.use(bodyParser.json()); // Asegúrate de usar el middleware para manejar JSON
app.use(express.static('public')); // Servir archivos estáticos como HTML

let scrapingProcess = null; // Variable para almacenar el proceso de scraping
let cancelScraping = false; // Variable para controlar la cancelación del scraping

const convertirFecha = (fecha) => {
    return moment(fecha, 'DD-MM-YYYY').format('YYYY-MM-DD');
};

const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));

// Asegura que la conexión a la base de datos esté activa
const ensureDbConnection = () => {
    return new Promise((resolve, reject) => {
        db.query('SELECT 1', (err) => {
            if (err) {
                console.log('Conexión perdida. Creando una nueva conexión...');
                db.end(() => {
                    // Nota: La conexión se reiniciará automáticamente cuando se vuelva a necesitar
                    resolve(); // En caso de error, se maneja en el lugar donde se usa
                });
            } else {
                resolve(); // La conexión está activa
            }
        });
    });
};

const insertDataIntoDB = async (data) => {
    try {
        await ensureDbConnection(); // Asegura la conexión antes de insertar
        const query = `
            INSERT INTO oferta_laborals (titulo, ubicacion, remuneracion, descripcion, body, fecha_inicio, fecha_fin, limite_postulante, image, state, category_id, empresa_id, user_id, tipo, compania, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        `;
        const insertPromises = data.map((row) => {
            const values = [
                row.titulo,
                row.ubicacion,
                row.remuneracion,
                row.descripcion,
                row.body,
                row.fecha_inicio,
                row.fecha_fin,
                row.limite_postulante,
                row.image,
                row.state,
                row.category_id,
                row.empresa_id,
                row.user_id,
                row.tipo,          // Nuevo campo tipo
                row.compania,      // Nuevo campo compañia
                row.created_at
            ];
            return new Promise((resolve, reject) => {
                db.query(query, values, (err) => {
                    if (err) {
                        console.error('Error insertando datos:', err);
                        reject(err);
                    } else {
                        console.log('Datos insertados con éxito');
                        resolve();
                    }
                });
            });
        });
        await Promise.all(insertPromises);
    } catch (err) {
        console.error('Error al insertar datos en la base de datos:', err);
    }
};

const processPage = async (page, url) => {
    console.log('Visitando página ==>', url);
    await page.goto(url, { waitUntil: 'networkidle2' });

    const jobSelector = '.sc-cyVxgd'; // Cambia esto según el selector adecuado de la página
    try {
        await page.waitForSelector(jobSelector, { timeout: 5000 });
    } catch (error) {
        console.log(`No se encontraron resultados en la página ${url}. Deteniendo...`);
        return false;
    }

    const listaDeItems = await page.$$('.sc-jYIdPM');
    let pageData = [];

    // Función para obtener la fecha actual en formato timestamp
      const fecha_hoy = () => {
        return moment().format('YYYY-MM-DD HH:mm:ss');
    };

    const fecha_requerida = fecha_hoy(); // Llama a la función para obtener la fecha actual

    for (const item of listaDeItems) {
        const titulo = await item.$(".sc-dCVVYJ");
        const ubicacion = await item.$(".sc-LAuEU");
        const remuneracion = await item.$(".dIB.mr10");
        const descripcion = await item.$(".sc-dCVVYJ");
        const body = await item.$(".sc-huKLiJ");
        const fecha_inicio = await item.$(".dIB.mr10");
        const fecha_fin = await item.$(".dIB.mr10");
        const limite_postulante = await item.$(".dIB.mr10");
        const image = await item.$(".sc-imDdex img");
        const state = await item.$(".dIB.mr10");
        const category_id = await item.$(".dIB.mr10");
        const empresa_id = await item.$(".dIB.mr10");
        const user_id = await item.$(".dIB.mr10");
         // Nuevos campos
         let tipo = 'N/A';
         try {
             tipo = await item.$eval('.sc-hdNmWC > .sc-fPEBxH:nth-of-type(2) h3', el => el.innerText.trim());
         } catch (error) {
             console.log('No se encontró el segundo <h3>. Usando "N/A".');
         }

         const compania = await item.$(".sc-kIXKos"); // Cambia el selector según sea necesario
        const created_at = fecha_requerida; // Asigna directamente la fecha actual



        const getTitulo = await page.evaluate(el => el ? el.innerText : 'N/A', titulo);
        const getUbicacion = await page.evaluate(el => el ? el.innerText : 'N/A', ubicacion);
        const getRemuneracion = await page.evaluate(el => el ? el.innerText : 's/. 2500', remuneracion);
        const getDescripcion = await page.evaluate(el => el ? el.innerText : 'N/A', descripcion);
        const getBody = await page.evaluate(el => el ? el.innerText : 'N/A', body);
        const getFechaInicio = convertirFecha(await page.evaluate(el => el ? el.innerText : '02-09-2024', fecha_inicio));
        const getFechaFin = convertirFecha(await page.evaluate(el => el ? el.innerText : '15-09-2024', fecha_fin));
        const getLimitePostulante = await page.evaluate(el => el ? el.innerText : 'N/A', limite_postulante);
        const getImage = await page.evaluate(el => el ? el.getAttribute('src') : 'N/A', image);
        const getState = await page.evaluate(el => el ? el.innerText : '2', state);
        const getCategoryId = await page.evaluate(el => el ? el.innerText : '2', category_id);
        const getEmpresaId = await page.evaluate(el => el ? el.innerText : '2', empresa_id);
          // Nuevos campos
          const getTipo = await page.evaluate(el => el ? el.innerText : 'N/A', tipo);
          const getCompania = await page.evaluate(el => el ? el.innerText : 'N/A', compania);
        const getUserId = await page.evaluate(el => el ? el.innerText : '2', user_id);


        pageData.push({
            titulo: getTitulo,
            ubicacion: getUbicacion,
            remuneracion: getRemuneracion,
            descripcion: getDescripcion,
            body: getBody,
            fecha_inicio: getFechaInicio,
            fecha_fin: getFechaFin,
            limite_postulante: getLimitePostulante,
            image: getImage,
            state: getState,
            category_id: getCategoryId,
            empresa_id: getEmpresaId,
            user_id: getUserId,
            tipo: tipo,        // Nuevo campo tipo
            compania: getCompania, // Nuevo campo compañia
            created_at: created_at,
        });
    }

    await insertDataIntoDB(pageData);
    console.log(`Datos de la página ${url} insertados en la base de datos.`);

    await delay(2000);

    return !cancelScraping; // Si se canceló, no hay más páginas
};

app.post('/start-scraping', async (req, res) => {
    const { link_web } = req.body;

    console.log('Enlace recibido:', link_web);

    if (!link_web || !link_web.startsWith('https://www.bumeran.com.pe/')) {
        return res.status(400).send('Link incorrecto');
    }

    if (scrapingProcess) {
        return res.status(400).send('El scraping ya está en curso.');
    }

    cancelScraping = false;
    scrapingProcess = (async () => {
        await ensureDbConnection(); // Asegura la conexión antes de iniciar el scraping

        const browser = await puppeteer.launch({
            headless: true,
            ignoreHTTPSErrors: true
        });

        const page = await browser.newPage();
        const header = randomUseragent.getRandom((ua) => ua.browserName === 'Firefox');
        await page.setUserAgent(header);
        await page.setViewport({ width: 1920, height: 1080 });

        let pageNumber = 1;
        let hasMorePages = true;

        while (hasMorePages && !cancelScraping) {
            const currentUrl = `${link_web}empleos.html?page=${pageNumber}`;
            console.log('URL actual:', currentUrl);
            hasMorePages = await processPage(page, currentUrl);

            if (hasMorePages) {
                pageNumber++;
            } else {
                console.log('No se encontraron más páginas para procesar.');
            }
        }

        await page.close();
        await browser.close();
     //   db.end();

        scrapingProcess = null; // Restablece el estado del proceso
        return 'Scraping completado';
    })();

    const result = await scrapingProcess;
    res.send(result);
});

app.post('/stop-scraping', (req, res) => {
    if (scrapingProcess) {
        cancelScraping = true;
        res.send('Scraping detenido');
    } else {
        res.status(400).send('No hay proceso de scraping en curso');
    }
});

app.post('/shutdown-server', (req, res) => {
    res.send('Servidor apagándose...');
    process.exit(0); // Apaga el servidor
});

app.listen(3000, () => {
    console.log('Servidor escuchando en el puerto 3000');
});
