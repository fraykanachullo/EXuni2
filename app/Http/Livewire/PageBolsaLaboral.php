<?php

namespace App\Http\Livewire;

use App\Models\OfertaLaboral;
use Livewire\Component;
use Illuminate\Http\Request;

class PageBolsaLaboral extends Component
{

    public $primerDetalle;

   public function handleClick()
    {
        $this->emit('iniciarPostulacion');
    }

    public function mount()
    {
        // Obtener el primer detalle al cargar el componente
        $this->primerDetalle = OfertaLaboral::where('state', 2)->first();
    }

    public function render()
    {
        // Obtener todas las ofertas
        $ofertas = OfertaLaboral::where('state', 2)->paginate();
        return view('pages.page-bolsa-laboral', compact('ofertas'));
    }

    public function obtenerDetallesOferta($id)
    {
        // Cargar los detalles de la oferta según el ID recibido
        $this->primerDetalle = OfertaLaboral::findOrFail($id);
    }




}
