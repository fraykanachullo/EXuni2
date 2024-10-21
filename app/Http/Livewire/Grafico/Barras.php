<?php

namespace App\Http\Livewire\Grafico;

use App\Models\OfertaLaboral;
use Carbon\Carbon;
use Livewire\Component;

class Barras extends Component
{


    public $companias = [];
    public $ofertasPorCompania = [];

    public function mount()
    {
        // Obtener ofertas por compañía
        $ofertasPorCompania = OfertaLaboral::selectRaw('compania, COUNT(*) as total')
            ->groupBy('compania')
            ->orderBy('total', 'desc')
            ->get();

        // Mapear las compañías y las ofertas
        $this->companias = $ofertasPorCompania->pluck('compania')->toArray();
        $this->ofertasPorCompania = $ofertasPorCompania->pluck('total')->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.barras');
    }
}
