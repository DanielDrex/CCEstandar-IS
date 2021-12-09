<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\valores;
use App\Models\lenguajes;
use App\Models\estandares;
use App\Models\apartados;
use App\Models\reglas;

class valoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valores = valores::where('status',1)->get();;
        return view('valores.index')->with('valores',$valores);
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
        $reglas = reglas::select('id','nombre')
        ->where('status',1)->get();
        return view('valores.create')
        ->with('lenguajes',$lenguajes)
        ->with('estandares',$estandares)
        ->with('apartados',$apartados)
        ->with('reglas',$reglas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $tipo = $request->tipo_valor;
        $id_regla = $request->id_regla;
        $errores = '';
        $n_errores = 0;
        $meta = '[\(\)\^\$\.\[\]\|\?\*\+\{\}\\\]';

        if ($tipo==0) {//SI ES CONSTANTE

            $valor = $request->get('valor');
            $tamano_val = strlen($valor);

            //evaluacion de errores

            if($tamano_val > 100){
             $n_errores++;
             $errores .= '-El valor debe ser menor a 100 caracteres<BR>';
            }

            if(preg_match("/$meta/", $valor)){
             $n_errores++;
             $errores .= '-El valor no debe tener caracteres especiales<BR>';
             $errores .= 'si necesitas usar un caracter especial prueba con un caracter variable<BR>';
            }

            if($valor == null){
             $n_errores++;
             $errores .= 'El nombre es nulo<BR>';
            }


            if ($n_errores == 0) {
                $datos = $request->all();
                valores::create($datos);
                return redirect('regla_valor/'.$id_regla);
            }else{
                return redirect('errores_val/'.$errores.'/'.$id_regla);
            } 

        }else{//SI ES VARIABLE

            /*$nombre = $request->get('nombre');
            $tamano_nom = strlen($nombre);
                
            if($tamano_nom > 10){
             $n_errores++;
             $errores .= 'El nombre del valor debe ser menor a 10 caracteres<BR>';
            }

            if(preg_match("/$meta/", $nombre)){
             $n_errores++;
             $errores .= 'El nombre no debe tener caracteres especiales<BR>';
            }*/

            $valores_existencias = valores::where('id_regla',$id_regla)->count();

            if($valores_existencias > 0){
             $n_errores++;
             $errores .= '-Las reglas de tipo variable solo deben tener un registro<BR>';
            }

            if ($n_errores == 0) {
                $datos = $request->all();
                valores::create($datos);
                return redirect('regla_valor/'.$id_regla);
            }else{
                return redirect('errores_val/'.$errores.'/'.$id_regla);
            } 

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
        $valor = valores::find($id);
        return view('valores.read')->with('valor', $valor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valor = valores::find($id);
        $lenguajes = lenguajes::select('id','nombre')
        ->where('status',1)->get();
        $estandares = estandares::select('id','nombre')
        ->where('status',1)->get();
        $apartados = apartados::select('id','nombre')
        ->where('status',1)->get();
        $reglas = reglas::select('id','nombre')
        ->where('status',1)->get();
        return view('valores.edit')->with('valor', $valor)
        ->with('lenguajes',$lenguajes)
        ->with('estandares',$estandares)
        ->with('apartados',$apartados)
        ->with('reglas',$reglas);
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
        $valor = valores::find($id);
        $valor->update($datos);
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
        $valor = valores::find($id);
        $id_regla = $valor->id_regla;
        $valor -> destroy($id);
        return redirect('regla_valor/'.$id_regla);
    }

    public function ver_eliminados()
    {
        $valores = valores::where('status',0)
        ->get();
        return view('valores.ver_eliminados')->with('valores',$valores);
    }

    public function restaurar($id)
    {
        $valor = valores::find($id);
        $valor -> destroy($id);
        return redirect('/lenguajes');
    }

    public function buscar_reglav($id_apartado)
    {
        $reglas = reglas::select('id','nombre')
        ->where('id_apartado',$id_apartado)  
        ->where('status',1)
        ->orderBy('nombre')
        ->get();
        return $reglas;
    }

    public function errores_val($errores,$id_regla)
    {
        return view('valores.errores')->with('errores',$errores)
        ->with('id_regla',$id_regla);
    }

    
}
