<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\lenguajes;
use App\Models\estandares;

class lenguajesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lenguajes = lenguajes::where('status',1)
        ->get();
        return view('lenguajes.index')->with('lenguajes',$lenguajes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lenguajes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $n_errores=0;
        $errores = '';
        $nombre = $request->get('nombre');
        $tamano_nom = strlen($nombre);
        $extension = $request->get('extension');
        $tamano_ext = strlen($extension);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';
        if($tamano_nom > 10){
         $n_errores++;
         $errores = $errores.'El nombre del lenguaje debe ser menor a 10 caracteres<BR>';
        }
        if($tamano_ext > 10){
         $n_errores++;
         $errores = $errores.'El nombre de la extensión debe ser menor a 10 caracteres<BR>';
        }
        if(preg_match("/$meta/", $extension)){
         $n_errores++;
         $errores = $errores.'La extensión solo debe tener letras<BR>';
        }


        if($n_errores==0){
            $datos = $request->all();
            lenguajes::create($datos);
            return redirect('/lenguajes'); 
        }else{
            return view('lenguajes.errores')->with('errores', $errores);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lenguaje = lenguajes::find($id);
        return view('lenguajes.read')->with('lenguaje', $lenguaje);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lenguaje = lenguajes::find($id);
        return view('lenguajes.edit')->with('lenguaje', $lenguaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $lenguaje = lenguajes::find($id);
        $lenguaje->update($datos);
        return redirect('/lenguajes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lenguaje = lenguajes::find($id);
        $lenguaje -> destroy($id);
        return redirect('/lenguajes');
    }

    public function ver_eliminados()
    {
        $lenguajes = lenguajes::where('status',0)
        ->get();
        return view('lenguajes.ver_eliminados')->with('lenguajes',$lenguajes);
    }

    public function restaurar($id)
    {
        $lenguaje = lenguajes::find($id);
        $lenguaje -> status = 1;
        $lenguaje -> save();
        return redirect('/lenguajes');
    }

    public function lenguaje_estandar($id)
    {    
        $estandares = estandares::where('id_lenguaje',$id)->get();
        return view('estandares.index')->with('estandares',$estandares)->with('id_leng',$id);
    }


}
