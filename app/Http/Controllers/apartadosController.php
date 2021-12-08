<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\apartados;
use App\Models\lenguajes;
use App\Models\estandares;
use App\Models\reglas;

class apartadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartados = apartados::where('status',1)->get();;
        return view('apartados.index')->with('apartados',$apartados);
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
        $estandares = estandares::select('id','nombre')
        ->where('status',1)->get();
        return view('apartados.create')
        ->with('lenguajes',$lenguajes)
        ->with('estandares',$estandares);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $id_estandar = $request->id_estandar;

        //$apartados = apartados::where('id_estandar',$id_estandar)->get();
        //return view('apartados.index')->with('apartados',$apartados);

        $errores = '';
        $n_errores = 0;
        $nombre = $request->get('nombre');
        $tamano_nom = strlen($nombre);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';

        if($tamano_nom > 10){
         $n_errores++;
         $errores .= 'El nombre del apartado no debe ser mayor a 10 caracteres<BR>';
        }

        if(preg_match("/$meta/", $nombre)){
         $n_errores++;
         $errores .= 'El nombre no debe tener caracteres especiales<BR>';
        }

        if ($n_errores == 0) {
            $datos = $request->all();
            apartados::create($datos);
            return redirect('estandar_apartado/'.$id_estandar);
        }else{
            return redirect('errores_ap/'.$errores.'/'.$id_estandar);
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
        $apartado = apartados::find($id);
        return view('apartados.read')->with('apartado', $apartado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartado = apartados::find($id);
        $id_estandar = $apartado->id_estandar;
        $estandares = estandares::where('id',$id_estandar)->get();

        return view('apartados.edit')->with('apartado', $apartado)
        ->with('estandares',$estandares);
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
        $apartado = apartados::find($id);
        $id_estandar = $apartado->id_estandar;
        //$apartados = apartados::where('id_estandar',$id_estandar)->get();
        //return view('apartados.index')->with('apartados',$apartados);

        $errores = '';
        $n_errores = 0;
        $nombre = $request->get('nombre');
        $tamano_nom = strlen($nombre);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';

        if($tamano_nom > 10){
         $n_errores++;
         $errores .= 'El nombre del apartado no debe ser mayor a 10 caracteres<BR>';
        }

        if(preg_match("/$meta/", $nombre)){
         $n_errores++;
         $errores .= 'El nombre no debe tener caracteres especiales<BR>';
        }

        if ($n_errores == 0) {
            $datos = $request->all();
            $apartado->update($datos);
            return redirect('estandar_apartado/'.$id_estandar);
        }else{
            return redirect('errores_ap/'.$errores.'/'.$id_estandar);
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
        $apartado = apartados::find($id);
        $id_estandar = $apartado->id_estandar;
        $apartado -> destroy($id);
        return redirect('estandar_apartado/'.$id_estandar);
        
    }

    public function ver_eliminados()
    {
        $apartados = apartados::where('status',0)
        ->get();
        return view('apartados.ver_eliminados')->with('apartados',$apartados);
    }

    public function restaurar($id)
    {
        $apartado = apartados::find($id);
        $apartado -> status = 1;
        $apartado -> save();
        return redirect('/lenguajes');
    }

    public function buscar_estandar($id_lenguaje)
    {
        $estandares = estandares::select('id','nombre')
        ->where('id_lenguaje',$id_lenguaje)  
        ->where('status',1)  
        ->orderBy('nombre')
        ->get();
        return $estandares;
    }

    public function apartado_reglas($id)
    {
        
        $reglas = reglas::where('id_apartado',$id)->orderBy('posicion')->get();;
        return view('reglas.index')->with('reglas',$reglas);
    }

    public function errores_ap($errores,$id_estandar)
    {
        return view('apartados.errores')->with('errores',$errores)
        ->with('id_estandar',$id_estandar);
    }
}
