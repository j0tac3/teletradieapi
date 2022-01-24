<?php

namespace App\Http\Controllers;

use App\Http\Resources\PerfilResource;
use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index() {
        $perfil = Perfil::latest()->paginate(10);
        return PerfilResource::collection($perfil);
    }

    public function show($id) {
        $perfil = Perfil::findOrFail($id);
        return new PerfilResource($perfil);
    }

    public function store(Request $request) {
        $request->validate([
            'desc' => 'required'
        ]);
        //return Post::create($request->all())

        $perfil = new Perfil();
        $perfil->desc = $request->desc;

        if ($perfil->save()){
            return new PerfilResource($perfil);
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'desc' => 'required'
        ]);
        
        $perfil = Perfil::findOrFail($id);
        $perfil->desc = $request->desc;

        if ($perfil->save()){
            return new PerfilResource($perfil);
        }
    }

    public function destroy($id) {
        $perfil = Perfil::findOrFail($id);        
        //return $post->delete();
        if ($perfil->delete()){
            return new PerfilResource($perfil);
        }
    }
}
