<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImagenResource;
use App\Models\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function index() {
        $imagen = Imagen::latest()->paginate(10);
        return ImagenResource::collection($imagen);
    }

    public function show($id) {
        $imagen = Imagen::findOrFail($id);
        return new ImagenResource($imagen);
    }

    public function store(Request $request) {
        $request->validate([
            'desc' => 'required'
        ]);
        //return Post::create($request->all())

        $imagen = new Imagen();
        $imagen->desc = $request->desc;

        if ($imagen->save()){
            return new ImagenResource($imagen);
        }
    }

    public function update(Request $request, $id) {
        $request->validate([
            'desc' => 'required'
        ]);
        
        $imagen = Imagen::findOrFail($id);
        $imagen->desc = $request->desc;

        if ($imagen->save()){
            return new ImagenResource($imagen);
        }
    }

    public function destroy($id) {
        $imagen = Imagen::findOrFail($id);        
        //return $post->delete();
        if ($imagen->delete()){
            return new ImagenResource($imagen);
        }
    }
}
