<?php


namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\OfertaLaboral;
use App\Models\Postulante;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yoeunes\Toastr\Facades\Toastr;

class PagePostulante extends Component
{
    public $detalles;

    public function mount($id)
    {
        $this->detalles = OfertaLaboral::findOrFail($id);

        if (!Auth::check()) {
            Toastr::error('Para continuar, necesitas Iniciar Sesión', 'Error');
            return redirect('/login-bolsa')->with('message', '¡Para continuar, necesitas Iniciar Sesión!');
        }

        if (Auth::user()->email_verified_at == null) {
            Toastr::error('¡Para continuar, necesitas verificar tu dirección de correo electrónico!', 'Error');
            return view('auth.verify-email');
        }

        session(['postulacionIniciado' => true]);
        $this->emit('redirectToPostulacion', $this->detalles->id);
    }

    public function render()
    {
        return view('pages.page-postulante');
    }

    public function save_postulante(Request $request, $id)
    {
        $postulante = new Postulante();
        $postulante->name = $request->name;
        $postulante->paterno = $request->paterno;
        $postulante->materno = $request->materno;
        $postulante->phone = $request->phone;
        $postulante->address = $request->address;
        // $postulante->postal = $request->postal;
        $postulante->email = $request->email;
        $postulante->document = $request->document;
        $postulante->tdatos = ($request->get('tdatos') == "on") ? "1" : "0";
        $postulante->save();

        $request->session()->put('postulante_datos', $postulante);

        // Mostrar notificación Toastr
        Toastr::success('Se guardó tu información satisfactoriamente', '¡Éxito!');
        return redirect()->route('detalle.postulacion', ['id' => $id]);
    }

    public function redirectToPostulacion($id)
    {
        return redirect()->route('postulacion', ['id' => $id]);
    }
}
