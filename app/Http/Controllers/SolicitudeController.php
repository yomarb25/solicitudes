<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use Illuminate\Http\Request;

class SolicitudeController extends Controller
{
    public function show(Solicitude $solicitude){
        $dpi = $solicitude->getFirstMediaUrl('dpi');
        $solicitude->dpi = $dpi;
        return response()->json(['data'=>$solicitude]);
    }

    public function index(Request $request){
        $solicitudes = Solicitude::all();
        return response()->json(['data'=>$solicitudes]);
    }

    public function store(Request $request){
        $request->validate([
            'primer_nombre'    => 'string|required',
            'segundo_nombre'   => 'string|required',
            'primer_apellido'  => 'string|required',
            'segundo_apellido' => 'string|required',
            'cui'              => 'string|required',
            'tipo_documento'   => 'string|required',
            'telefono'         => 'string|required',
            'direccion'        => 'string|required',
            'email'            => 'string|required',
            'sexo'             => 'string|required',
            'estado_civil'     => 'string|required',
            'attachment'       => 'file|max:1000|mimes:pdf'
        ]);
        $solicitude = Solicitude::create( $request->all() );

        if( $request->hasFile('attachment') ){
            $solicitude->addMediaFromRequest('attachment')->toMediaCollection('dpi');
        }

        return response()->json(['data'=>$solicitude]);
    }

    public function update(Request $request, Solicitude $solicitude){
        $solicitude->update(['status' => $request->status]);
        return response()->json(['data'=>$solicitude]);
    }
}
