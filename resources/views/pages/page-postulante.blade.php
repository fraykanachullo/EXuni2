<div class="flex flex-col bg-white ">



    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            <div class="flex flex-col gap-2">
                <div class="bg-white px-4 py-8 shadow-md shadow-gray-400">
                    <div class="w-11/12 lg:w-2/6 mx-[auto] pb-5 ">
                        <div class="bg-gray-200 h-1 flex items-center justify-between">
                            <div class="w-1/3  h-1 flex items-center">
                                <div
                                    class="bg-white h-6 w-6 rounded-full  shadow flex items-center justify-center -mr-3 relative">
                                    <div class="h-3 w-3 animate-pulse  bg-indigo-700 rounded-full"></div>
                                </div>
                            </div>
                            <div class="w-1/3 flex justify-between  h-1 items-center relative">

                                <div class="w-2/3 flex justify-end">
                                    <div class="bg-white h-6 w-6 rounded-full shadow"></div>
                                </div>
                            </div>
                            <div class="w-1/3 flex justify-end">
                                <div class="bg-white h-6 w-6 rounded-full shadow"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-center items-center">
                            <span class="py-5 text-center text-xl font-bold">Datos del postulante</span>
                        </div>

                        <form action="{{ route('grabar.postulante', ['id' => $detalles->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">
                                <label>
                                    <span> Nombre Completo</span>
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->name }} </span>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="name"
                                value="{{ auth()->user()->name }}">

                                {{-- <input class="rounded-lg w-full" type="text" name="name" required> --}}
                            </div>
                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">
                                <label>
                                    <span> Apellido Paterno</span>
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->apellido_p }} </span>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="paterno"
                                value="{{ auth()->user()->apellido_p }}">
                                {{-- <input class="rounded-lg w-full" type="text" name="paterno" required> --}}
                            </div>
                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">
                                <label>
                                    <span> Apellido Materno</span>
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->apellido_m }} </span>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="materno"
                                value="{{ auth()->user()->apellido_m }}">
                                {{-- <input class="rounded-lg w-full" type="text" name="materno" required> --}}
                            </div>
                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">
                                <label>
                                    <span> Direccion </span>
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->direccion }} </span>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="address"
                                value="{{ auth()->user()->direccion }}">
                                {{-- <input class="rounded-lg w-full" type="text" name="address"
                                    placeholder="Ejm :  Camiño Sanz, 476, 95º B, 56791, El Naranjo del Mirador" required> --}}
                            </div>
                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">

                                <label>
                                    Email
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->email }}</span>
                                    <span id="changeEmailLink"
                                        class="bg-blue-700 rounded-full px-3 text-white font-bold"
                                        style="cursor: pointer;"><i class="fa-solid fa-exclamation fa-xs"></i></span>
                                </div>
                                <div id="myModal_1" class="modal" style="display: none;">
                                    <div class="modal-content flex flex-row gap-4 py-1">

                                        <p>Para cambiar este correo electrónico, ve a configuración.</p>
                                        <span class="close_1 bg-gray-700 text-white px-3 py-1 rounded-md"
                                            style="cursor: pointer;">&times;</span>
                                    </div>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="email"
                                    value="{{ auth()->user()->email }}">
                            </div>

                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">

                                <label>
                                    Documento de Identidad
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->dni }}</span>
                                    <span id="changeDNILink" class="bg-blue-700 rounded-full px-3 text-white font-bold"
                                        style="cursor: pointer;"><i class="fa-solid fa-exclamation fa-xs"></i></span>
                                </div>
                                <div id="myModal_2" class="modal" style="display: none;">
                                    <div class="modal-content flex flex-row gap-4 py-1">

                                        <p>Para cambiar este correo electrónico, ve a configuración.</p>
                                        <span class="close_2 bg-gray-700 text-white px-3 py-1 rounded-md"
                                            style="cursor: pointer;">&times;</span>
                                    </div>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="document"
                                    value="{{ auth()->user()->dni }}">
                            </div>
                            <div class="flex flex-col w-full  px-3 mb-6 md:mb-0">

                                <label>
                                    Telefono(Celular)
                                </label>
                                <div class="flex justify-between bg-slate-100 rounded-md px-4 py-1">
                                    <span> {{ auth()->user()->telefono }}</span>
                                    <span id="changeTELLink" class="bg-blue-700 rounded-full px-3 text-white font-bold"
                                        style="cursor: pointer;"><i class="fa-solid fa-exclamation fa-xs"></i></span>
                                </div>
                                <div id="myModal" class="modal" style="display: none;">
                                    <div class="modal-content flex flex-row gap-4 py-1">

                                        <p>Para cambiar este correo electrónico, ve a configuración.</p>
                                        <span class="close bg-gray-700 text-white px-3 py-1 rounded-md"
                                            style="cursor: pointer;">&times;</span>
                                    </div>
                                </div>
                                <input class="rounded-lg w-full" type="hidden" name="phone"
                                    value="{{ auth()->user()->telefono }}">
                            </div>


                            <div class="px-4 py-5">
                                <label class=" flex flex-row gap-2 text-gray-500 font-bold">
                                    <input name="tdatos"type="checkbox">
                                    <span class="text-sm">
                                        Acepto el tratamiento de datos personales
                                    </span>
                                </label>
                            </div>


                            <div class="flex items-end justify-end  gap-5 px-10 py-10">
                                <button type="submit" class="rounded-full text-blue-400 border-2 border-blue-400 font-bold px-8 py-1.5  hover:text-white  hover:bg-blue-400">
                                    Guardar
                                </button>
                                <a href="/"class="rounded-full bg-blue-400 text-white font-bold px-8 py-2 hover:bg-transparent hover:text-blue-400 hover:border-2 hover:border-blue-400">Cancelar</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="sticky top-24 z-50">
                    <div
                        class="flex flex-col scale-100 bg-white border-2 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="p-6 w-auto h-auto flex flex-col shadow-md shadow-gray-300">
                            <h2 class="mt-6 text-xl font-semibold text-gray-900">{{ $detalles->titulo }}</h2>

                            <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                <span
                                    class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
                                <div class="flex justify-center items-center">
                                    <span class="border-e h-5  border-gray-400"></span>
                                </div>
                                <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}
                                </span>
                                <div class="flex justify-center items-center">
                                    <span class="border-e h-5  border-gray-400"></span>
                                </div>
                                <span class="flex justify-start items-center text-sm ">{{ $detalles->remuneracion }}
                                </span>
                            </div>
                        </div>
                        <div class="max-h-[34rem] overflow-y-auto" id="scrollableDiv">
                            <div class="p-6 w-auto h-auto flex flex-col border-b border-gray-400">
                                <h2 class="mt-6 text-xl font-semibold text-gray-900">Informacion del empleo</h2>
                                <h6 class="text-xs font-bold text-gray-400">Así es como las especificaciones del empleo
                                    se
                                    alinean con tu perfil</h6>
                                <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                    <span
                                        class="flex justify-start items-center text-sm ">{{ $detalles->empresa->ra_social }}</span>
                                    <div class="flex justify-center items-center">
                                        <span class="border-e h-5  border-gray-400"></span>
                                    </div>
                                    <span class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-6">
                                    <div class="flex flex-row gap-4">
                                        <samp class="flex justify-start items-start"><i
                                                class="fa-solid fa-circle-dollar-to-slot"></i></samp>
                                        <div class="flex flex-col gap-2 font-bold ">
                                            <h2
                                                class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                                                Sueldo</h2>
                                            <span
                                                class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">{{ $detalles->remuneracion }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-row gap-4">
                                        <samp class="flex justify-start items-start"><i
                                                class="fa-solid fa-suitcase"></i></samp>
                                        <div class="flex flex-col gap-2 font-bold ">
                                            <h2
                                                class=" text-md font-semibold text-gray-900 justify-start items-center flex">
                                                Tipo de empleo</h2>
                                            <span
                                                class="flex justify-start items-center text-sm bg-gray-200 rounded-md py-1 px-2">Tiempo
                                                completo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 w-auto h-auto flex flex-col">
                                <div class="flex flex-col">
                                    <h2 class="mt-6 text-xl font-semibold text-gray-900">Ubicacion</h2>

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <span
                                            class="flex justify-start items-center text-sm ">{{ $detalles->ubicacion }}</span>
                                    </div>
                                </div>
                                <samp class="border-b border-gray-400 py-2"></samp>
                                <div class="flex flex-col">
                                    <h2 class="mt-6 text-xl font-semibold text-gray-900">Descripción completa del
                                        empleo
                                    </h2>

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <p>
                                            {{ $detalles->body }}
                                        </p>
                                    </div>
                                </div>
                                <samp class="border-b border-gray-400 py-2"></samp>
                                <div class="flex flex-col">

                                    <div class="flex fle-row justify-start items-center pt-2 gap-2">
                                        <span
                                            class="gap-2 flex justify-start items-center text-sm bg-gray-300 rounded-md text-black py-2 px-6 font-bold flex-row">
                                            <samp><i class="fa-solid fa-flag"></i></samp>
                                            <h1>Reportar empleo</h1>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    document.getElementById('changeTELLink').addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'block';
    });

    document.getElementsByClassName('close')[0].addEventListener('click', function() {
        document.getElementById('myModal').style.display = 'none';
    });
</script>

<script>
    document.getElementById('changeEmailLink').addEventListener('click', function() {
        document.getElementById('myModal_1').style.display = 'block';
    });

    document.getElementsByClassName('close_1')[0].addEventListener('click', function() {
        document.getElementById('myModal_1').style.display = 'none';
    });
</script>

<script>
    document.getElementById('changeDNILink').addEventListener('click', function() {
        document.getElementById('myModal_2').style.display = 'block';
    });

    document.getElementsByClassName('close_2')[0].addEventListener('click', function() {
        document.getElementById('myModal_2').style.display = 'none';
    });
</script>
