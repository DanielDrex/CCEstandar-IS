<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\archivos;
use App\Models\valores;
use App\Models\lenguajes;
use App\Models\estandares;
use App\Models\apartados;
use App\Models\reglas;
use Storage;
use Illuminate\Support\Facades\Validator;


class archivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos = archivos::where('status',1)
        ->get();
        return view('archivos.index')->with('archivos',$archivos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $errores = '';
        $n_errores = 0;
        $nombre = $request->nombre;
        $tamano_nom = strlen($nombre);
        $meta = '[\(|\)|\^|\$|\.|\[|\]|\||\?|\*|\+|\{|\}]';
        //$rutaarchivos = '../storage/fotografias/';
        $hora = date('h_i_s');
        $fecha = date('d_m_Y');
        $prefijo = $fecha."_".$hora;
        $archiv= $request->file('archiv');
        $input=array('file'=>$archiv);
        $reglas=array('file'=>
            'required|max:10240');//en kb
        $validacion=Validator::make($input,$reglas);

        


        if($archiv!=null){
            if($validacion->fails()){//si la validacion de archivo falla

                $errores.='<h1>Tu archivo no se puede subir por las posibles razones:</h1><BR>';
                $errores.='<p>Es demasiado pesado, el tamaño maximo es de 10MB<BR>'; 
                $errores.='No es un archivo de extension permitida</p><BR>';

                return redirect('errores_arc/'.$errores);
                //$ruta=$prefijo .'_'.$archiv->getClientOriginalName();
                //return view('Correo.plantillamensaje')
                //->with('msj'.'El archivo no es una imagen'.$ruta);
            }else{//si el archivo no fallo

                if($tamano_nom > 30){
                 $n_errores++;
                 $errores .= 'El nombre registro para el archivo debe ser menor a 30 caracteres<BR>';
                }

                if(preg_match("/$meta/", $nombre)){
                 $n_errores++;
                 $errores .= 'El nombre no debe tener caracteres especiales<BR>';
                }

                $ruta=$prefijo .'_'.$archiv->getClientOriginalName();

                if($n_errores == 0){//si no hubo errores de registro

                    $r1= Storage::disk('arc')->put($ruta, \File::get($archiv));

                    $tam_ruta = strlen($ruta);

                    if($tam_ruta > 100){

                        $errores = 'El nombre original del archivo es mayor a 80 caracteres';

                        return redirect('errores_arc/'.$errores);

                    }else{

                        if($r1){//registro normal
                            $datos['ruta'] = $ruta;
                            archivos::create($datos);
                            return redirect('/archivos');
                        }else{//no se subio el archivo
                            $retorno = 'El archivo no se pudo subir';
                            return view('archivos.leidos')->with('retorno',$retorno);
                        }   

                    }

                    

                }else{//si hubo errores de registro

                   $errores;

                   return redirect('errores_arc/'.$errores);
                }
                

            }
        }else{
            return redirect('/archivos');
            
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
        $archivo = archivos::find($id);
        return view('archivos.read')->with('archivo', $archivo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archivo = archivos::find($id);
        return view('archivos.edit')->with('archivo', $archivo);
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
        $archivo = archivos::find($id);
        $archivo->update($datos);
        return redirect('/archivos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $archivo = archivos::find($id);
        $archivo -> destroy($id);
        return redirect('/archivos');



    }

    public function ver_eliminados()
    {
        $archivos = archivos::where('status',0)
        ->get();
        return view('archivos.ver_eliminados')->with('archivos',$archivos);
    }

    public function restaurar($id)
    {
        $archivo = archivos::find($id);
        $archivo -> status = 1;
        $archivo -> save();
        return redirect('/archivos');
    }


    public function evaluacion($id)
    {
        $url = Storage::url($ruta);//ruta


        if (Storage::disk('arc')->exists($ruta)) {


            //$contents = Storage::disk('arc')->get($ruta);//contenido

            $size = Storage::disk('arc')->getSize($ruta);//tamaño

            $kb = $size/1024;

            $mb = $kb/1024;

            $extension = pathinfo($url, PATHINFO_EXTENSION);//extension

            $contador=0;
            $linea=1;
            echo "Nombre: ".$ruta;
            echo "<BR>Extension: ".$extension;
            echo "<BR>Tamaño en Bytes: ".$size;
            echo "<BR>Tamaño en Kb: ".$kb;
            echo "<BR>Tamaño en Mb: ".$mb."<BR><BR>";
            echo "Contenido: <BR><BR>";

            $file=fopen('../storage/arc/'.$ruta,'r');

            $retorno = "<BR>El arhivo : ".$ruta." Contiene todos estos datos";

           return view('archivos.leidos')->with('retorno',$retorno);
        }else{
            $retorno = "El arhivo : ".$ruta." NO se encuentra";
           return view('archivos.leidos')->with('retorno',$retorno);  
        } 
    }



    public function leer_archivo($ruta)
    {   

        $url = Storage::url($ruta);//ruta


        if (Storage::disk('arc')->exists($ruta)) {


            //$contents = Storage::disk('arc')->get($ruta);//contenido

            $size = Storage::disk('arc')->getSize($ruta);//tamaño

            $kb = $size/1024;

            $mb = $kb/1024;

            $extension = pathinfo($url, PATHINFO_EXTENSION);//extension

            $contador=0;
            $linea=1;
            echo "Nombre: ".$ruta;
            echo "<BR>Extension: ".$extension;
            echo "<BR>Tamaño en Bytes: ".$size;
            echo "<BR>Tamaño en Kb: ".$kb;
            echo "<BR>Tamaño en Mb: ".$mb."<BR><BR>";
            echo "Contenido: <BR><BR>";

            $file=fopen('../storage/arc/'.$ruta,'r');

            while(!feof($file)) {
                echo $linea." ";
                echo fgets($file)."<BR>";
                $linea++;
            }
            
            fclose($file);

            $retorno = "<BR>El arhivo : ".$ruta." Contiene todos estos datos";

           return view('archivos.leidos')->with('retorno',$retorno);
        }else{
            $retorno = "El arhivo : ".$ruta." NO se encuentra";
           return view('archivos.leidos')->with('retorno',$retorno);  
        } 
    }

    public function lenguaje_compatible($id)
    {   
        $archivo = archivos::find($id);
        $ruta = $archivo->ruta;
        $url = Storage::url($ruta);//ruta


        if (Storage::disk('arc')->exists($ruta)) {

            $extension = pathinfo($url, PATHINFO_EXTENSION);//extension

            $lenguajes = lenguajes::where('extension',$extension)
            ->get();

          return view('archivos.lenguaje')->with('lenguajes',$lenguajes)
          ->with('archivo',$archivo);

        }else{
            $retorno = "El arhivo : ".$ruta." NO se encuentra";
           return view('archivos.leidos')->with('retorno',$retorno);  
        } 
    }

    public function select_estandar($id_leng,$id_arc)
    {   
        $archivo = archivos::find($id_arc);
        $ruta = $archivo->ruta;
        $url = Storage::url($ruta);//ruta
        $lenguaje = lenguajes::find($id_leng);

        if (Storage::disk('arc')->exists($ruta)) {

            $extension = pathinfo($url, PATHINFO_EXTENSION);//extension

            $estandares = estandares::where('id_lenguaje',$id_leng)
            ->get();

          return view('archivos.estandar')->with('estandares',$estandares)
          ->with('archivo',$archivo)->with('lenguaje',$lenguaje);
        }else{
            $retorno = "El arhivo : ".$ruta." NO se encuentra";
           return view('archivos.leidos')->with('retorno',$retorno);  
        } 
    }


    public function evaluar($id_est,$id_arc)
    {   
        $archivo = archivos::find($id_arc);
        $ruta = $archivo->ruta;
        $url = Storage::url($ruta);//ruta
        $estandar = estandares::find($id_est);

        $apartado_existencias = apartados::where('id_estandar',$id_est)->count();
        //si existe el archivo fisico
        if (Storage::disk('arc')->exists($ruta)) {

            if ($apartado_existencias == 0) { // no existen apartados en el estandar

                $retorno = "El estandar:--".$estandar->nombre."--NO tiene apartados para evaluar";
                 return view('archivos.leidos')->with('retorno',$retorno);
   
            }else{ //existen apartados en el estandar

                $apartados = apartados::where('id_estandar',$id_est)
                ->get();
                //inicio del foreach de apartados
                foreach($apartados as $apartado){

                    $regla_existencias = reglas::where('id_apartado',$apartado->id)->count();
                    //if si no tiene reglas
                    if($regla_existencias == 0){
                        $retorno = "El apartado:--".$apartado->nombre."--NO tiene reglas para evaluar";
                        return view('archivos.leidos')->with('retorno',$retorno);
                    }else{//en caso de si tener reglas

                    echo "Resultados para el apartado de: ".$apartado->nombre."<BR><BR>";
                    $observaciones='';
                    $linea=1;
                    $busqueda_principal='';
                    $busqueda_coincidente='';
                    $bnd_preventivo=0;//para busquedas variables
                    $meta = '/\(\)\^\$\.\[\]\|\?\*\+\{\}\-/';
                    $orden='';

                    $group_pos = reglas::where('id_apartado',$apartado->id)->groupBy('posicion')->count();
                    $group_id = reglas::where('id_apartado',$apartado->id)->groupBy('id')->count();


                    if ($group_pos != $group_id){//if para corroborar las posiciones

                        echo "Verificar que la posicion de las reglas de este apartado no esten duplicadas";
                        
                    }else{//posiciones correctas
                                $reglas = reglas::where('id_apartado',$apartado->id)
                                ->orderBy('posicion')->get();  

                                foreach($reglas as $regla){//foeacch para reglas
                                    $valores_existencias = valores::where('id_regla',$regla->id)->count();
                                    if($valores_existencias==0){//si no hay valores
                                        $retorno = "La regla:--".$regla->nombre."--NO tiene valores para evaluar<BR>Asegurate de que tus demas reglas contengan valores";
                                        return view('archivos.leidos')->with('retorno',$retorno);
                                    }else{//si hay valores    
                                        if($regla->tipo_regla==0){ // valor constante
                                            $constante = '';
                                            $num_val = valores::where('id_regla',$regla->id)->count();
                                            $valores = valores::where('id_regla',$regla->id)
                                            ->where('tipo_valor',0)->get(); 

                                            if ($num_val==1) {//si solo hay un valor
                                                foreach($valores as $valor){
                                                     $constante .= $valor->valor;
                                                     $busqueda_principal = $busqueda_principal.$constante;      
                                                }

                                            } else { // si hay mas
                                                $constante .= '(';
                                                //$busqueda_principal = $busqueda_principal.'(';
                                                foreach($valores as $valor){
                                                $constante .= $valor->valor.'|';
                                                }
                                                $constante = substr($constante, 0,-1).')';  
                                                $busqueda_principal = $busqueda_principal.$constante;           
                                            }

                                            if($bnd_preventivo==0){
                                                $busqueda_coincidente .= $constante;
                                            }

                                            $orden .= $constante;

                                            $bnd_preventivo++;


                                        }else{// valores variables
                                            $valores = valores::where('id_regla',$regla->id)
                                            ->where('tipo_valor',1)->get();
                                                foreach($valores as $valor){
                                                $caracteres = $valor->caracteres;
                                                if ($caracteres == 0) {
                                                 $busqueda_principal = $busqueda_principal." ";
                                                 $orden .= ' ';
                                                }else if($caracteres == 1){
                                                 $busqueda_principal = $busqueda_principal."[a-zA-Z]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 2){
                                                 $busqueda_principal = $busqueda_principal."[0-9]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 3){
                                                 $busqueda_principal = $busqueda_principal."[a-zA-Z0-9_]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 4){
                                                 $busqueda_principal = $busqueda_principal."[\{\}]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 5){
                                                 $busqueda_principal = $busqueda_principal."[\(\)]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 6){
                                                 $busqueda_principal = $busqueda_principal."[\[\]]+";
                                                 $orden .= $regla->nombre;
                                                }else if($caracteres == 7){
                                                 $busqueda_principal = $busqueda_principal."[^ \t\n\r\f\v]+";
                                                 $orden .= $regla->nombre;
                                                }
                                                }//fin foreach
                                        }//fin valores variables
                                    }//fin de else de tener valores
                                }//fin de foeach para reglas    
                                    
                                    if ($bnd_preventivo==0) {//si no hay constantes
                                        echo "LA BUSQUEDA NO CUENTA CON PALABRAS FIJAS POR LO QUE LOS RESULTADOS NO PUEDEN LLEGAR A SER CORRECTOS<br><br>";

                                        $file=fopen('../storage/arc/'.$ruta,'r');

                                            $cont_linea='';

                                                while(!feof($file)) {
                                                    echo $linea." ";
                                                    $cont_linea = fgets($file);

                                                    if(preg_match("/$busqueda_principal/", $cont_linea)){
                                                        echo $cont_linea.'---Cumple con las reglas<BR>';
                                                    }else{
                                                        echo $cont_linea.'<BR>';
                                                    }

                                                    $linea++;
                                                }
                                            
                                    fclose($file);

                                    }else{//si hay constantes

                                    $file=fopen('../storage/arc/'.$ruta,'r');

                                            $cont_linea='';

                                                while(!feof($file)) {
                                                    echo $linea." ";
                                                    $cont_linea = fgets($file);

                                                    if(preg_match("/$busqueda_coincidente/", $cont_linea)){
                                                            if(preg_match("/$busqueda_principal/", $cont_linea)){
                                                                echo $cont_linea.'---Cumple con las reglas<BR>';
                                                            }else{
                                                             $observaciones .= $linea.', ';
                                                             echo $cont_linea.'---Contiene constante de busqueda pero no cumple con las reglas---<BR>';
                                                            }

                                                    }else{
                                                        echo $cont_linea.'<BR>';
                                                    }

                                                    
                                                    $linea++;
                                                }
                                            
                                    fclose($file);

                                    }

                                    

                                    echo "<BR>";
                                    //espacio para mostrar lo que se necesite

                                    if($observaciones==''){
                                        echo "Sin ninguna observacion";   
                                    }else{
                                        echo "Observaciones de incumplimiento en las lineas: ";
                                        $observaciones = substr($observaciones, 0,-1).'.';
                                        echo $observaciones;
                                    }
                                    echo "<BR><BR>";
                                    echo "Orden evaluado: ".$orden;
                                }
                                
                                echo "<BR><BR><BR>";

                    }//fin if para posiciones

                }// fin foreach para apartados

                ///fin de proceso
                $retorno = "El archivo :---- ".$ruta." ---fue evaluado";

                return view('archivos.leidos')->with('retorno',$retorno);
            }//fin else para existencias de apartados
            
        }else{//si no existe archivo fisico
            $retorno = "El arhivo : ".$ruta." NO se encuentra";
           return view('archivos.leidos')->with('retorno',$retorno);  
        } //fin del if para el archivo
    }

    public function errores_arc($errores)
    {
        return view('archivos.errores')->with('errores',$errores);
    }

}
