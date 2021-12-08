<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reglas;
use App\Models\lenguajes;
use App\Models\estandares;
use App\Models\apartados;
use App\Models\valores;

class reglasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reglas = reglas::where('status',1)->orderBy('id_apartado')->get();
        return view('reglas.index')->with('reglas',$reglas);
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
        $apartados = apartados::select('id','nombre')
        ->where('status',1)->get();
        return view('reglas.create')
        ->with('lenguajes',$lenguajes)
        ->with('estandares',$estandares)
        ->with('apartados',$apartados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $id_apartado = $request->id_apartado;
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

        if ($n_errores == 0) {
            $datos = $request->all();
            reglas::create($datos);
            return redirect('apartado_reglas/'.$id_apartado);
        }else{
            return redirect('errores_reg/'.$errores.'/'.$id_apartado);
        } 

    

        //$reglas = reglas::where('id_apartado',$id_apartado)->orderBy('posicion')->get();
        //return view('reglas.index')->with('reglas',$reglas);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regla = reglas::find($id);
        return view('reglas.read')->with('regla', $regla);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regla = reglas::find($id);
        $id_apartado = $regla->id_apartado;
        $apartados = apartados::where('id',$id_apartado)->get();
        return view('reglas.edit')->with('regla', $regla)->with('apartados', $apartados);
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

        $id_apartado = $request->id_apartado;
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

        if ($n_errores == 0) {
            $datos = $request->all();
            $regla = reglas::find($id);
            $regla->update($datos);
            return redirect('apartado_reglas/'.$id_apartado);
        }else{
            return redirect('errores_reg/'.$errores.'/'.$id_apartado);
        } 

        //$reglas = reglas::where('id_apartado',$id_apartado)->orderBy('posicion')->get();
        //return view('reglas.index')->with('reglas',$reglas);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $regla = reglas::find($id);
        $id_apartado = $regla->id_apartado;
        $regla -> destroy($id);
        return redirect('apartado_reglas/'.$id_apartado);
    }

    public function buscar_apartado($id_estandar)
    {
        $apartados = apartados::select('id','nombre')
        ->where('id_estandar',$id_estandar)  
        ->where('status',1)  
        ->orderBy('nombre')
        ->get();
        return $apartados;
    }

    public function regla_valor($id)
    {
        $bus = reglas::find($id);
        $id_apartado = $bus->id_apartado;
        $tipo = $bus ->tipo_regla;
        if($tipo == 0){
            $valores = valores::where('tipo_valor',0)->where('id_regla',$id) ->get();
            return view('valores.index')->with('valores',$valores)->with('tipo',$tipo)
            ->with('id_apartado',$id_apartado);
        }else{
            $valores = valores::where('tipo_valor',1)->where('id_regla',$id) ->get();
            return view('valores.index')->with('valores',$valores)->with('tipo',$tipo)
            ->with('id_apartado',$id_apartado);
        }
        
    }

    public function especifico($id)
    {   
        $regla = reglas::find($id);
        
        return view('valores.create')
        ->with('regla',$regla);
    }

    public function errores_reg($errores,$id_apartado)
    {
        return view('reglas.errores')->with('errores',$errores)
        ->with('id_apartado',$id_apartado);
    }
}
