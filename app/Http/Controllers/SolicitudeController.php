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
