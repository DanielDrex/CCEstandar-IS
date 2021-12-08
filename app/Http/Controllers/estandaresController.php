<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estandares;
use App\Models\lenguajes;
use App\Models\apartados;

class estandaresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estandares = estandares::where('status',1)->orderBy('id_lenguaje')->get();
        return view('estandares.index')->with('estandares',$estandares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lenguajes = lenguajes::select('id','nombre')
        ->where('status',1)->get();
        return view('estandares.create')
        ->with('lenguajes',$lenguajes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_lenguaje = $request->get('id_lenguaje');
        $errores = '';
        $n_errores = 0;
        $nombre = $request->get('nombre');
        $tamano_nom = strlen($nombre);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';

        if($tamano_nom > 10){
         $n_errores++;
         $errores .= 'El nombre del estandar debe ser menor a 10 caracteres<BR>';
        }

        if(preg_match("/$meta/", $nombre)){
         $n_errores++;
         $errores .= 'El nombre no debe tener caracteres especiales<BR>';
        }

        //$estandares = estandares::where('id_lenguaje',$id)->get();
        //return view('estandares.index')->with('estandares',$estandares);
        if ($n_errores == 0) {
            $datos = $request->all();
            estandares::create($datos);
            return redirect('lenguaje_estandar/'.$id_lenguaje);
        }else{
            return redirect('errores_est/'.$errores.'/'.$id_lenguaje);
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
        $estandar = estandares::find($id);
        return view('estandares.read')->with('estandar', $estandar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estandar = estandares::find($id);
        $id_lenguaje = $estandar->id_lenguaje;
        $lenguajes = lenguajes::where('id',$id_lenguaje)->get();
        return view('estandares.edit')->with('estandar', $estandar)
        ->with('lenguajes',$lenguajes); 
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
        $estandar = estandares::find($id);
        $id_lenguaje = $estandar->id_lenguaje;
        $errores = '';
        $n_errores = 0;
        $nombre = $request->get('nombre');
        $tamano_nom = strlen($nombre);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';

        //$estandares = estandares::where('id_lenguaje',$id_lenguaje)->get();
        //return view('estandares.index')->with('estandares',$estandares)->with('id_leng',$id);
        if($tamano_nom > 10){
         $n_errores++;
         $errores .= 'El nombre del estandar debe ser menor a 10 caracteres<BR>';
        }

        if(preg_match("/$meta/", $nombre)){
         $n_errores++;
         $errores .= 'El nombre no debe tener caracteres especiales<BR>';
        }

        if ($n_errores == 0) {
            $estandar->update($datos);
            return redirect('lenguaje_estandar/'.$id_lenguaje);
        }else{
            return redirect('errores_est/'.$errores.'/'.$id_lenguaje);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estandar = estandares::find($id);
        $id_lenguaje = $estandar->id_lenguaje;
        $estandar -> destroy($id);
        return redirect('/view-clear');
        //return redirect('lenguaje_estandar/'.$id_lenguaje);
    }


    public function estandar_apartado($id)
    {
        $apartados = apartados::where('id_estandar',$id)->get();;
        return view('apartados.index')->with('apartados',$apartados);
    }

    public function errores_est($errores,$id_lenguaje)
    {
        return view('estandares.errores')->with('errores',$errores)
        ->with('id_lenguaje',$id_lenguaje);
    }
}
