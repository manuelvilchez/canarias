<?php
require_once(getcwd().'/wp-content/plugins/insert-php-code-snippet/libreria/bootstrap.php');

 $phpWord = new \PhpOffice\PhpWord\PhpWord();

  // Adding an empty Section to the document...
  $section = $phpWord->addSection();
/***lineas agregadas**/


/****lineas agregadas***/

function generaPass(){
    //Se define una cadena de caractares.
    //Os recomiendo desordenar las minúsculas, mayúsculas y números para mejorar la probabilidad.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Definimos la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, puedes poner la longitud que necesites
    //Se debe tener en cuenta que cuanto más larga sea más segura será.
    $longitudPass=10;
     
    //Creamos la contraseña recorriendo la cadena tantas veces como hayamos indicado
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña con cada carácter aleatorio.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}

/****lineas agregadas***/
$email = $_POST['2__Correo_electronico'];
$codigo = $_POST['codigo_aleatorio'];
$img_traida = $_POST['img_traida'];
$copia_del_doc = $_POST['100__Desea_una_copia_del_formulario_por'];

function cargar_imagen($nombre_imagen){
    // Cargar la Imagen
    $temp = explode(".", $_FILES[$nombre_imagen]["name"]);
    $extension = end($temp);

    if ($extension!="") {

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $image =$_FILES[$nombre_imagen]["name"];
            $uploadedfile = $_FILES['imgform']['tmp_name'];   
        }

        $tamano = $_FILES[$nombre_imagen]["size"] / 1024;
        $nombrearchivo = utf8_decode($_FILES[$nombre_imagen]["name"]);        


        if ($tamano >= "0" ){

            $nombrearchivo = preg_replace("/\.[^.]+$/", "", $nombrearchivo);

            $nombrereal = $nombrearchivo.".".$extension;
            $nombrecolocar = uniqid();  
            $nombrecolocar = $nombrecolocar.".".$extension;

            if ($img_traida=="") {
              $urlarchivo = "tempfile/".$nombrecolocar;   
            }else{
              $urlarchivo=$_POST['img_traida'];
            }
            //$urlarchivo = "tempfile/".$nombrecolocar;       
            unlink($urlarchivo);

            $filename1 = $urlarchivo;

            $a = 1;
            $resultado = move_uploaded_file($_FILES[$nombre_imagen]["tmp_name"],$urlarchivo); 

            $urlimagenfinal = "https://canariasplanet.net/$urlarchivo";

            return $urlarchivo;


        }
    }
}

function cargar_multiples_imagenes($nombre_imagenes){
   /**segunda imagen*/
   if ($_FILES["nombre_imagenes"]['tmp_name']!="") 
   {
         //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["nombre_imagenes"]['tmp_name'] as $key => $tmp_name)
        {
          //Validamos que el 95_fotografia exista
          if($_FILES["nombre_imagenes"]["name"][$key]) {
            $filename = uniqid().$_FILES["nombre_imagenes"]["name"][$key]; //Obtenemos el nombre original del 
            $filename=str_replace(' ', '', $filename) ;
            $filename=str_replace('-', '', $filename) ;



            $source = $_FILES["nombre_imagenes"]["tmp_name"][$key]; //Obtenemos un nombre temporal del 95_fotografia
           // echo $source;
            $directorio = 'tempfile'; //Declaramos un  variable con la ruta donde guardaremos los 95_fotografias
            $nombre_fotos[]=$filename;
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if(!file_exists($directorio)){
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");  
            }
            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del 95_fotografia
            
            //Movemos y validamos que el 95_fotografia se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) { 
             
              } else {  
              echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }


            //closedir($dir); //Cerramos el directorio de destino
          }
        } 
    }   
 
        
    //print_r($urlimagenfinal2);

    /**fin segunda imagen **/
}

 /**segunda imagen*/
 $target_path_c=[];
    if ($_POST['img_dos_traida']!="") {
        //$target_path_c[] = $_POST['img_dos_traida'];
        $nuevo=substr( $_POST['img_dos_traida'] , 0 , -1);
        $porciones = explode("-", $nuevo);
        $target_path_c=$porciones ;
        //$nuevo=array_pop($porciones);
       // print_r($target_path_c);
    }
 
   if ($_FILES["95__fotografia"]['tmp_name']!="") 
   {
         //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["95__fotografia"]['tmp_name'] as $key => $tmp_name)
        {
          //Validamos que el 95_fotografia exista
          if($_FILES["95__fotografia"]["name"][$key]) {
            $filename = uniqid().$_FILES["95__fotografia"]["name"][$key]; //Obtenemos el nombre original del 
            $filename=str_replace(' ', '', $filename) ;
            $filename=str_replace('-', '', $filename) ;



            $source = $_FILES["95__fotografia"]["tmp_name"][$key]; //Obtenemos un nombre temporal del 95_fotografia
            
            $directorio = 'tempfile'; //Declaramos un  variable con la ruta donde guardaremos los 95_fotografias
            $nombre_fotos[]=$filename;
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if(!file_exists($directorio)){
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");  
            }
            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del 95_fotografia
            $target_path_c[] = $target_path;
            
            //Movemos y validamos que el 95_fotografia se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) { 
             // echo "El 95_fotografia $filename se ha almacenado en forma exitosa.<br>";

                $urlimagenfinal2 = "https://canariasplanet.net/$target_path";

                /*$section->addImage(
                        $urlimagenfinal2,
                        array(        
                            'height'        => 160,
                            'marginTop'     => -1,
                            'marginLeft'    => -1,
                            'wrappingStyle' => 'behind'
                        )
                    );


                    //Asigno la Imagen al PDF
                    $tabletrpdf .="
                              <tr style='margin-top: 10px'>
                                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 20px' colspan='2'>
                                      <img src='$urlimagenfinal2' style='height: 270px' />

                                  </td>            
                              </tr>  
                          ";

                    $emailimg2 = "<img src='$urlimagenfinal2'  style='height: 220px' />";

                  //Para Email    
                  //$emailvalores .=" $emailimg2 <br>";
                  $email_imagens .=" $emailimg2 <br>";

                  //echo $emailimg2;*/
              } else {  
              echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }


            closedir($dir); //Cerramos el directorio de destino
          }
        } 
    }   
 
        
    //print_r($urlimagenfinal2);

  /**fin segunda imagen **/

 /**tercera imagen*/
 $target_path_c3=[];
   if ($_POST['img_tres_traida']!="") {
          //$target_path_c[] = $_POST['img_dos_traida'];
          $nuevo=substr( $_POST['img_tres_traida'] , 0 , -1);
          $porciones = explode("-", $nuevo);
          $target_path_c3=$porciones ;
          //$nuevo=array_pop($porciones);
          //print_r($target_path_c3);
      }
   if ($_FILES["96__documento_i"]['tmp_name']!="") 
   {
         //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["96__documento_i"]['tmp_name'] as $key => $tmp_name)
        {
          //Validamos que el 95_fotografia exista
          if($_FILES["96__documento_i"]["name"][$key]) {
            $filename = uniqid().$_FILES["96__documento_i"]["name"][$key]; //Obtenemos el nombre original del 
            $filename=str_replace(' ', '', $filename) ;
            $filename=str_replace('-', '', $filename) ;



            $source = $_FILES["96__documento_i"]["tmp_name"][$key]; //Obtenemos un nombre temporal del 95_fotografia
            
            $directorio = 'tempfile'; //Declaramos un  variable con la ruta donde guardaremos los 95_fotografias
            $nombre_fotos[]=$filename;
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if(!file_exists($directorio)){
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");  
            }
            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del 95_fotografia
            $target_path_c3[] = $target_path;
            
            //Movemos y validamos que el 95_fotografia se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) { 
             // echo "El 95_fotografia $filename se ha almacenado en forma exitosa.<br>";

                $urlimagenfinal3 = "https://canariasplanet.net/$target_path";

                /*$section->addImage(
                        $urlimagenfinal2,
                        array(        
                            'height'        => 160,
                            'marginTop'     => -1,
                            'marginLeft'    => -1,
                            'wrappingStyle' => 'behind'
                        )
                    );


                    //Asigno la Imagen al PDF
                    $tabletrpdf .="
                              <tr style='margin-top: 10px'>
                                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 20px' colspan='2'>
                                      <img src='$urlimagenfinal2' style='height: 270px' />

                                  </td>            
                              </tr>  
                          ";

                    $emailimg2 = "<img src='$urlimagenfinal2'  style='height: 220px' />";

                  //Para Email    
                  //$emailvalores .=" $emailimg2 <br>";
                  $email_imagens .=" $emailimg2 <br>";

                  //echo $emailimg2;*/
              } else {  
              echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }


            closedir($dir); //Cerramos el directorio de destino
          }
        } 
    }   
 
        
    //print_r($urlimagenfinal2);

  /**fin tercera imagen **/

 /**cuarta imagen*/
 $target_path_c4=[];
  if ($_POST['img_cuatro_traida']!="") {
          //$target_path_c[] = $_POST['img_dos_traida'];
          $nuevo=substr( $_POST['img_cuatro_traida'] , 0 , -1);
          $porciones = explode("-", $nuevo);
          $target_path_c4=$porciones ;
          //$nuevo=array_pop($porciones);
          //print_r($target_path_c4);
      }
   if ($_FILES["97__contrato_arrendamiento"]['tmp_name']!="") 
   {
         //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["97__contrato_arrendamiento"]['tmp_name'] as $key => $tmp_name)
        {
          //Validamos que el 95_fotografia exista
          if($_FILES["97__contrato_arrendamiento"]["name"][$key]) {
            $filename = uniqid().$_FILES["97__contrato_arrendamiento"]["name"][$key]; //Obtenemos el nombre original del 
            $filename=str_replace(' ', '', $filename) ;
            $filename=str_replace('-', '', $filename) ;



            $source = $_FILES["97__contrato_arrendamiento"]["tmp_name"][$key]; //Obtenemos un nombre temporal del 95_fotografia
            
            $directorio = 'tempfile'; //Declaramos un  variable con la ruta donde guardaremos los 95_fotografias
            $nombre_fotos[]=$filename;
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if(!file_exists($directorio)){
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");  
            }
            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del 95_fotografia
            $target_path_c4[] = $target_path;
            
            //Movemos y validamos que el 95_fotografia se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) { 
             // echo "El 95_fotografia $filename se ha almacenado en forma exitosa.<br>";

                $urlimagenfinal4 = "https://canariasplanet.net/$target_path";

              
              } else {  
              echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }


            closedir($dir); //Cerramos el directorio de destino
          }
        } 
    }   
 
        
    //print_r($urlimagenfinal2);

  /**fin cuarta imagen **/

   /**quinta imagen*/
 $target_path_c5=[];
  if ($_POST['img_cinco_traida']!="") {
          //$target_path_c[] = $_POST['img_dos_traida'];
          $nuevo=substr( $_POST['img_cinco_traida'] , 0 , -1);
          $porciones = explode("-", $nuevo);
          $target_path_c5=$porciones ;
          //$nuevo=array_pop($porciones);
          //print_r($target_path_c4);
      }
   if ($_FILES["98__otra_doc_re"]['tmp_name']!="") 
   {
         //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach($_FILES["98__otra_doc_re"]['tmp_name'] as $key => $tmp_name)
        {
          //Validamos que el 95_fotografia exista
          if($_FILES["98__otra_doc_re"]["name"][$key]) {
            $filename = uniqid().$_FILES["98__otra_doc_re"]["name"][$key]; //Obtenemos el nombre original del 
            $filename=str_replace(' ', '', $filename) ;
            $filename=str_replace('-', '', $filename) ;



            $source = $_FILES["98__otra_doc_re"]["tmp_name"][$key]; //Obtenemos un nombre temporal del 95_fotografia
            
            $directorio = 'tempfile'; //Declaramos un  variable con la ruta donde guardaremos los 95_fotografias
            $nombre_fotos[]=$filename;
            //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if(!file_exists($directorio)){
              mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");  
            }
            
            $dir=opendir($directorio); //Abrimos el directorio de destino
            $target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del 95_fotografia
            $target_path_c5[] = $target_path;
            
            //Movemos y validamos que el 95_fotografia se haya cargado correctamente
            //El primer campo es el origen y el segundo el destino
            if(move_uploaded_file($source, $target_path)) { 
             // echo "El 95_fotografia $filename se ha almacenado en forma exitosa.<br>";

                $urlimagenfinal4 = "https://canariasplanet.net/$target_path";

               
              } else {  
              echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
            }


            closedir($dir); //Cerramos el directorio de destino
          }
        } 
    }   
 
        
    //print_r($urlimagenfinal2);

  /**fin quinta imagen **/


if(isset($_POST["guardar"])) { 
    $emailvalores="";
    $tabletrpdf="";
    //$datos[]="";
   // $desprendible = $_FILES["desprendible"];

      if(empty($_FILES["0__imgform"])){

      //echo "No hay datos";
        $imagen_uno= "";
      $mostrar_imagen_uno= '';

      $urlimagen_uno='';
   

           $tabletrpdf .="
              <tr style='margin-top: 10px'>
                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 20px' colspan='2'>
                     
                  </td>            
             </tr>   ";
      }else{

      $imagen_uno= cargar_imagen('0__imgform');
      $mostrar_imagen_uno= '<img src="https://canariasplanet.net/'.$imagen_uno.'" alt="">';

      $urlimagen_uno='https://canariasplanet.net/'.$imagen_uno;
     

           $tabletrpdf .="
              <tr style='margin-top: 10px'>
                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 20px' colspan='2'>
                     <img src='$urlimagen_uno' style='height: 270px' />
                  </td>            
             </tr>   ";
      }
   

    $emailvalores.=$mostrar_imagen_uno;


     //saco el numero de elementos
    $longitud = count($target_path_c);
    $imgs2="";
    $imgs2_grupo_url="";
    $imgs2_url="url aqui";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs2.='<br> <img src="https://canariasplanet.net/'.$target_path_c[$i].'" alt="" width="100px"  height="100px">';
       $imgs2_url.='https://canariasplanet.net/'.$target_path_c[$i];
       $imgs2_grupo_url.=$target_path_c[$i]."-";
       $imgs2_url.="url aqui";
        $tabletrpdf .="
              <tr style='margin-top: 10px'>
                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 20px' colspan='2'>
                     $imgs2_url
                  </td>            
             </tr>   ";
    }

   

    $longitud = count($target_path_c3);
    $imgs3="";
    $imgs3_grupo_url="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs3.='<br> <img src="https://canariasplanet.net/'.$target_path_c3[$i].'" alt="" width="100px"  height="100px">';
        $imgs3_grupo_url.=$target_path_c3[$i]."-";          
    }

    $longitud = count($target_path_c4);
    $imgs4="";
    $imgs4_grupo_url="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs4.='<br> <img src="https://canariasplanet.net/'.$target_path_c4[$i].'" alt="" width="100px"  height="100px">';
      $imgs4_grupo_url.=$target_path_c4[$i]."-";        
    }

    $longitud = count($target_path_c5);
    $imgs5="";    
    $imgs5_grupo_url="";    
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs5.='<br> <img src="https://canariasplanet.net/'.$target_path_c5[$i].'" alt="" width="100px"  height="100px">';
       $imgs5_grupo_url.=$target_path_c5[$i]."-";    
                  
    }


  
    
     $nom_pa="";
     $nom_va="";
     $url="";
     

     $que_escribir="";
     foreach ($_POST as $param_name => $param_val) {

        $nombreparametro =$param_name;
        $valorparametro = $param_val;


        $arrnombreparametro = explode("__", $nombreparametro);

        $idfinalparametro = $arrnombreparametro[0];
        $nombrefinalparametro = $arrnombreparametro[1];

        
        $datos=$nombrefinalparametro." =>" .$valorparametro;

        $valorparametro2=$valorparametro;

        //SE FORMA LA URL ANTES DE QUITAR ESPACIOS
        $url.=$nombrefinalparametro."=".$valorparametro."&";

        $titulo="";

        if ($nombrefinalparametro==="Sociedad_tenedora") {
          //echo "<br>";
          $titulo="DATOS GENERALES DEL ACTIVO";
         // echo $titulo;
          $emailvalores .=" $titulo <br>";

          


          
        }
        if ($nombrefinalparametro==="Tipo_procedimiento") {
          //echo "<br>";
          $titulo="INFORMACION PROCEDIMIENTO JUDICIAL";
          //echo $que_escribir=$titulo;
          $emailvalores .=" $titulo <br>";
          
        }

        if ($nombrefinalparametro==="Fecha_y_hora_1_visita") {
         // echo "<br>";
          $titulo="INFORMACION RELATIVA AL ESTADO OCUPACIONAL";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Tiempo_Desocupacion") {
          //echo "<br>";
          $titulo="EN CASO DE ESTAR DESOCUPADO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Nombre_y_apellidos") {
        //  echo "<br>";
          $titulo="EN CASO DE ESTAR OCUPADO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Nombre_y_apellidos_2") {
         // echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Nombre_y_apellidos_3") {
         // echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Nombre_y_apellidos_4") {
          //echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }  
 
        if ($nombrefinalparametro==="Local_en_Bruto") {
          //echo "<br>";
          $titulo="IMPRESION Y DATOS DE LA FINCA (Local/Nave Industrial)";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Finca_con_Construcciones") {
          //echo "<br>";
          $titulo="IMPRESION Y DATOS DE LA FINCA (Suelo)";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

  

       
         if ($nombrefinalparametro==="Desea_una_copia_del_formulario_por") {
           //echo "<br>";
             $titulo=" DOCUMENTACION RELEVANTE <br>";
            $emailvalores.=$titulo;
          
        }   

        if ($nombrefinalparametro==="Desea_una_copia_del_formulario_por") {
           //echo "<br>";
             $nombrefinalparametro="Fotografías activo";
            $valorparametro=$imgs2;
            
            //$nombrefinalparametro=str_replace('_', ' ', $nombrefinalparametro);
            //$emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
         // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }       
       
       if ($nombrefinalparametro==="Fotografías activo") {
           $nombrefinalparametro="Documentos Identidad";
          $valorparametro=$imgs3;
         // echo $nombrefinalparametro." : ".$valorparametro;
          $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
       }

       if ($nombrefinalparametro==="Documentos Identidad") {
           $nombrefinalparametro="Contrato de arrendamiento";
            $valorparametro=$imgs4;
         // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
       }
       if ($nombrefinalparametro==="Contrato de arrendamiento") {
           //echo "<br> ";
            $nombrefinalparametro="Otra documentacion relevante";
            $valorparametro=$imgs5;
           // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }
        if ($nombrefinalparametro==="Otra documentacion relevante") {
           //echo "<br> ";
            $nombrefinalparametro="Desea_una_copia_del_formulario_por";
            $valorparametro=$copia_del_doc;
           // echo $nombrefinalparametro." : ".$valorparametro;
            //$emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }

        $nom_pa.=$nombrefinalparametro;
        $nom_va.=$valorparametro;
       
          
        $nombrefinalparametro=str_replace('_', ' ', $nombrefinalparametro);
        $valorparametro=str_replace('_', ' ', $valorparametro);
        
        //para emial
        $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        
        

              // Para PDF    
         /* $tabletrpdf .="
                <tr>
                    <td style=' text-align: left; color:#13b96b; font-weight: bold; font-size: 22px; colspan='2'>
                        <br><br>$titulo
                    </td>          
                </tr>  
              ";   */
          // Para PDF    
       

          /*$tabletrpdf .="
              <tr style='margin-top: 10px'>
                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 18px'>
                      $nombrefinalparametro: <br>

                  </td>
                  <td style='text-align: left; width:300px; font-size: 17px'>
                      $valorparametro

                  </td>
              </tr>  
          ";*/
      
      }
    
  if ($copia_del_doc=="Word"){
      
      //Coloca el nombre del formulario con la ruta
      $nombrearchivo = "tempfile/Formulario_".uniqid().".docx";
        
      // Agrego el estilo de fuente
      $fontStyleName = 'oneUserDefinedStyle';
      $phpWord->addFontStyle(
          $fontStyleName,
          array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
      );


      // Agrega la fuente
      $fontStyle = new \PhpOffice\PhpWord\Style\Font();
      $fontStyle->setBold(true);
      $fontStyle->setName('Tahoma');
      $fontStyle->setSize(13);


      // Guarda el archivo para luego descargarse
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
      $objWriter->save($nombrearchivo);

      // Se ejecuta la accion de descarga del archivo
      header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
      header('Content-Disposition: attachment;filename='.$nombrearchivo.'');  
      readfile($nombrearchivo);

      unlink($nombrearchivo);
  }
  else if ($copia_del_doc=="Pdf"){
      
      //Coloca el nombre del formulario con la ruta
      $nombrearchivo = "tempfile/Formulario_".uniqid().".pdf";

      require_once(getcwd().'/wp-content/plugins/mpdf-5.7-php7-master/mpdf.php');
     
      $htmlpdf = "
          <pagebreak sheet-size='Letter' />
              <body style='font-family: sans-serif; font-size: 12px; '>
                <div style='font-family:' Times New Roman',Georgia,Serif; background white; margin auto auto auto auto '>
                    <br>
                    <div class='containerpanel' style=' margin-top: 0px; width: 500px; height: 950px;'>
                        <div style='margin: 10px 10px 10px 10px; '>
                            <table style='text-align: center; width: 500px; border-collapse: collapse; margin-top:18px; line-height: 20px '>
                                $tabletrpdf                   
                            </table>
                        </div>
                    </div>
                </div>
            </body> ";

      //$mpdf=new mPDF('', 'Letter', 0, '', 15, 12.7, 12, 4, 8, 8);  
      $mpdf=new mPDF(['debug' => true]);  
        
      $mpdf->WriteHTML($htmlpdf); 
      $mpdf->Output($nombrearchivo,'I');    
      exit;

  }

  require("class.phpmailer.php");
  require("class.smtp.php");


  if ($codigo=="") {

    $codigo =  generaPass();
  }else
  {
    $codigo = $_POST['codigo_aleatorio'];
  }
  $url=str_replace(' ', '-', $url);

  $url1 = "https://canariasplanet.net/formulario?codigo=".$codigo."&imagen_f=".$imagen_uno.$url."imagenes_dos=".$imgs2_grupo_url."&imagenes_tres=".$imgs3_grupo_url."&imagenes_cuatro=".$imgs4_grupo_url."&imagenes_cinco=".$imgs5_grupo_url;
  /*url =  htmlspecialchars($url1)."?"."codigo=". $codigo."&".$valorfinal ;*/
    
  //echo $url1;


 /* if ($email!=""){

    //$valorsinespacio=str_replace('-', '', $valorparametro_email);

  //$url1 = url_completa();


    $asunto = 'formulario canarias incompleto';

   // $mensaje = $emailvalores;
    $mensaje = $emailvalores;
    $mensajedos="para continuar siga el enlace";

    $codigoo =  $codigo;

    $url_enviar= $url1;

  //$prueba=$valorparametro_email;

  //$destinatario = "mvilchezwilsonbruno@gmail.com";
    $destinatario = $email;


  // Datos de la cuenta de correo utilizada para enviar vía SMTP
  $smtpHost = "mail.wimaho.com";  // Dominio alternativo brindado en el email de alta 
  $smtpUsuario = "prueba2@wimaho.com";  // Mi cuenta de correo
  $smtpClave = "LOKOloko_23";  // Mi contraseña




  $mail = new PHPMailer();
  //$mail->IsSMTP();
  $mail->SMTPDebug = 2;
  $mail->SMTPAuth = true;
  //$mail->SMTPAuth = true;
  //$mail->SMTPSecure = 'tls'; 
  $mail->Port = 465;
  $mail->IsHTML(true); 
  $mail->CharSet = "utf-8";

  // VALORES A MODIFICAR //
  $mail->Host = $smtpHost; 
  $mail->Username = $smtpUsuario; 
  $mail->Password = $smtpClave;


  //$mail->From = $email; // Email desde donde envío el correo.
  $mail->From = $smtpUsuario; // Email desde donde envío el correo.
  $mail->FromName = $nombre;
  $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario
  $mail->AddAddress("wmvilchezbruno@gmail.com"); // Esta es la dirección a donde enviamos los datos del formulario

  $mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
  $mensajeHtml = nl2br($mensaje);
  $mail->Body = "
  <html> 

  <body> 

  <h1>Recibiste un nuevo mensaje desde el formulario CanariasPlanet.com</h1>

  <p>Informacion enviada por el usuario de la web:</p>

  <p>asunto: {$asunto}</p>  

  <p>Mensaje: {$mensaje}</p>
   <p>Mensaje2: {$mensajedos}</p>
   <p>codigo: {$codigoo}</p>
   <p>url: {$url_enviar}</p>


 

  </body> 

  </html>

  <br />"; // Texto del email en formato HTML
  $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
  // FIN - VALORES A MODIFICAR //

  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );

  $estadoEnvio = $mail->Send(); 
  echo "esatdo";
  print_r($estadoEnvio);
  if ($estadoEnvio) {
    echo "enviado";
  }else{
    echo "no enviado";
  }*/

        
//}
/*echo "<br> guardar";
print_r($mensaje);
echo "<br> ";
print_r($mensajedos);
  echo "<br> ";
  print_r($codigoo);
  echo "<br> ";
print_r($url_enviar);*/

}
if(isset($_POST["enviar"])){
    $emailvalores="";
    $tabletrpdf="";
    //$datos[]="";
   // $desprendible = $_FILES["desprendible"];/
      /*if (!empty($_FILES["0__imgform"]) && $_POST["img_traida"]!="") {
          $imagen_uno= cargar_imagen('0__imgform');
          $mostrar_imagen_uno= '<img src="https://canariasplanet.net/'.$imagen_uno.'" alt="">';
          $urlimagen_uno='https://canariasplanet.net/'.$imagen_uno;


          $_POST["img_traida"]="";
      }*/
      if ($_POST["img_traida"]!="" ) {
            

            $imagen_uno= $_POST["img_traida"];
            $mostrar_imagen_uno= '<img src="https://canariasplanet.net/'.$imagen_uno.'" alt="">';
            $urlimagen_uno='https://canariasplanet.net/'.$imagen_uno;
           // echo $mostrar_imagen_uno;
      }else if(!empty($_FILES["0__imgform"]) ){
                 $imagen_uno= cargar_imagen('0__imgform');
                $mostrar_imagen_uno= '<img src="https://canariasplanet.net/'.$imagen_uno.'" alt="">';
                 $urlimagen_uno='https://canariasplanet.net/'.$imagen_uno;
            
        }
      
      $emailvalores.=$mostrar_imagen_uno;
     
    //echo $mostrar_imagen_uno;

    //$emailvalores.=$mostrar_imagen_uno;
    /*echo "<br> nueva";
    print_r( $target_path_c);
    echo "<br> nueva";
    print_r( $target_path_c3);
    echo "<br> nueva";
    print_r( $target_path_c4);*/


     //saco el numero de elementos
    $longitud = count($target_path_c);
    $imgs2="";
    //$imgs_url="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs2.='<br> <img src="https://canariasplanet.net/'.$target_path_c[$i].'" alt="" width="100px"  height="100px">';
       $imgs2_url='https://canariasplanet.net/'.$target_path_c[$i];

    }

    $longitud = count($target_path_c3);
    $imgs3="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs3.='<br> <img src="https://canariasplanet.net/'.$target_path_c3[$i].'" alt="" width="100px"  height="100px">';
                  
    }

    $longitud = count($target_path_c4);
    $imgs4="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs4.='<br> <img src="https://canariasplanet.net/'.$target_path_c4[$i].'" alt="" width="100px"  height="100px">';
                  
    }

    $longitud = count($target_path_c5);
    $imgs5="";
    //Recorro todos los elementos
    for($i=0; $i<$longitud; $i++)
    {
        //saco el valor de cada elemento
        //echo $nombre_fotos[$i];
       $imgs5.='<br> <img src="https://canariasplanet.net/'.$target_path_c5[$i].'" alt="" width="100px"  height="100px">';

                  
    }


  
    
     $nom_pa="";
     $nom_va="";
     $url="";
     
     $que_escribir="";
     foreach ($_POST as $param_name => $param_val) {

        $nombreparametro =$param_name;
        $valorparametro = $param_val;
        //echo $nombreparametro;
        //echo $valorparametro;


        $arrnombreparametro = explode("__", $nombreparametro);

        $idfinalparametro = $arrnombreparametro[0];
        $nombrefinalparametro = $arrnombreparametro[1];

         //echo "<br>";
       // print_r($nombreparametro);
        $datos=$nombrefinalparametro." =>" .$valorparametro;
        //echo "<br>";
        //echo $datos;

        $valorparametro2=$valorparametro;

        $url.=$nombrefinalparametro."=".$valorparametro."&";

        $titulo="";
        /*if ($nombrefinalparametro==="Fecha_ultima_de_actualizacion") {
          //echo "<br>";
          $titulo="DATOS GENERALES DEL ACTIVO";
         // echo $titulo;
          $emailvalores .=" $titulo <br>";

          
        }*/

        if ($nombrefinalparametro==="Sociedad_tenedora") {
          //echo "<br>";
          $titulo="DATOS GENERALES DEL ACTIVO";
         // echo $titulo;
          $emailvalores .=" $titulo <br>";

         

          
        }
        if ($nombrefinalparametro==="Tipo_procedimiento") {
          //echo "<br>";
          $titulo="INFORMACION PROCEDIMIENTO JUDICIAL";
          //echo $que_escribir=$titulo;
          $emailvalores .=" $titulo <br>";
          
        }

        if ($nombrefinalparametro==="Fecha_y_hora_1_visita") {
         // echo "<br>";
          $titulo="INFORMACION RELATIVA AL ESTADO OCUPACIONAL";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Tiempo_Desocupacion") {
          //echo "<br>";
          $titulo="EN CASO DE ESTAR DESOCUPADO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Nombre_y_apellidos") {
        //  echo "<br>";
          $titulo="EN CASO DE ESTAR OCUPADO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        } 

        if ($nombrefinalparametro==="Nombre_y_apellidos_2") {
         // echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Nombre_y_apellidos_3") {
         // echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Nombre_y_apellidos_4") {
          //echo "<br>";
          $titulo="EN CASO POSITIVO";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }  
 
        if ($nombrefinalparametro==="Local_en_Bruto") {
          //echo "<br>";
          $titulo="IMPRESION Y DATOS DE LA FINCA (Local/Nave Industrial)";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

        if ($nombrefinalparametro==="Finca_con_Construcciones") {
          //echo "<br>";
          $titulo="IMPRESION Y DATOS DE LA FINCA (Suelo)";
          //echo $titulo;
          $emailvalores .=" $titulo <br>";          
        }

  

       
         if ($nombrefinalparametro==="Desea_una_copia_del_formulario_por") {
           //echo "<br>";
             $titulo=" DOCUMENTACION RELEVANTE <br>";
            $emailvalores.=$titulo;
          
        }   

        if ($nombrefinalparametro==="Desea_una_copia_del_formulario_por") {
           //echo "<br>";
             $nombrefinalparametro="Fotografías activo";
            $valorparametro=$imgs2;
          
            //$emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
         // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }       
       
       if ($nombrefinalparametro==="Fotografías activo") {
           $nombrefinalparametro="Documentos Identidad";
          $valorparametro=$imgs3;
         // echo $nombrefinalparametro." : ".$valorparametro;
          $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
       }

       if ($nombrefinalparametro==="Documentos Identidad") {
           $nombrefinalparametro="Contrato de arrendamiento";
            $valorparametro=$imgs4;
         // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
       }
       if ($nombrefinalparametro==="Contrato de arrendamiento") {
           //echo "<br> ";
            $nombrefinalparametro="Otra documentacion relevante";
            $valorparametro=$imgs5;
           // echo $nombrefinalparametro." : ".$valorparametro;
            $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }
        if ($nombrefinalparametro==="Otra documentacion relevante") {
           //echo "<br> ";
            $nombrefinalparametro="Desea_una_copia_del_formulario_por";
            $valorparametro=$copia_del_doc;
           // echo $nombrefinalparametro." : ".$valorparametro;
            //$emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        }

        $nom_pa.=$nombrefinalparametro;
        $nom_va.=$valorparametro;
       
          
         $nombrefinalparametro=str_replace('_', ' ', $nombrefinalparametro);
          $valorparametro=str_replace('_', ' ', $valorparametro);
        
        //para emial
        $emailvalores .=" $nombrefinalparametro: $valorparametro <br>";
        
        $section->addText((" ".$nombrefinalparametro.": ".$valorparametro." "),array('name' => 'Arial','size' => '11', 'bold' => 'true'));

          
      // Para PDF    
       

          $tabletrpdf .="
              <tr style='margin-top: 10px'>
                  <td style='text-align: left; width:200px; font-weight: bold; font-size: 18px'>
                      $nombrefinalparametro: <br>

                  </td>
                  <td style='text-align: left; width:300px; font-size: 17px'>
                      $valorparametro

                  </td>
              </tr>  
          ";


      }
    
 /* if ($copia_del_doc=="Word"){
      
      //Coloca el nombre del formulario con la ruta
      $nombrearchivo = "tempfile/Formulario_".uniqid().".docx";
        
      // Agrego el estilo de fuente
      $fontStyleName = 'oneUserDefinedStyle';
      $phpWord->addFontStyle(
          $fontStyleName,
          array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
      );


      // Agrega la fuente
      $fontStyle = new \PhpOffice\PhpWord\Style\Font();
      $fontStyle->setBold(true);
      $fontStyle->setName('Tahoma');
      $fontStyle->setSize(13);


      // Guarda el archivo para luego descargarse
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
      $objWriter->save($nombrearchivo);

      // Se ejecuta la accion de descarga del archivo
      header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
      header('Content-Disposition: attachment;filename='.$nombrearchivo.'');  
      readfile($nombrearchivo);

      unlink($nombrearchivo);
  }
  else if ($copia_del_doc=="Pdf"){
      
      //Coloca el nombre del formulario con la ruta
      $nombrearchivo = "tempfile/Formulario_".uniqid().".pdf";

      require_once(getcwd().'/wp-content/plugins/mpdf-5.7-php7-master/mpdf.php');
     
      $htmlpdf = "
          <pagebreak sheet-size='Letter' />
              <body style='font-family: sans-serif; font-size: 12px; '>
                <div style='font-family:' Times New Roman',Georgia,Serif; background white; margin auto auto auto auto '>
                    <br>
                    <div class='containerpanel' style=' margin-top: 0px; width: 500px; height: 950px;'>
                        <div style='margin: 10px 10px 10px 10px; '>
                            <table style='text-align: center; width: 500px; border-collapse: collapse; margin-top:18px; line-height: 20px '>
                                $tabletrpdf                   
                            </table>
                        </div>
                    </div>
                </div>
            </body> ";

      $mpdf=new mPDF('', 'Letter', 0, '', 15, 12.7, 12, 4, 8, 8);  
        
      $mpdf->WriteHTML($htmlpdf); 
      $mpdf->Output($nombrearchivo,'I');    
      exit;

  }*/

  require("class.phpmailer.php");
  require("class.smtp.php");


  if ($codigo=="") {

    $codigo =  generaPass();
  }else
  {
    $codigo = $_POST['codigo_aleatorio'];
  }


  $url1 = "https://canariasplanet.net/formulario?".$url;
  /*url =  htmlspecialchars($url1)."?"."codigo=". $codigo."&".$valorfinal ;*/
    



  if ($email!=""){

    ////$valorsinespacio=str_replace('-', '', $valorparametro_email);

  //$url1 = url_completa();


    $asunto = 'formulario canarias completo';

   // $mensaje = $emailvalores;
    $mensaje = $emailvalores;

    //$codigoo =  $codigo;

    //$url = $url1;

  //$prueba=$valorparametro_email;

  //$destinatario = "mvilchezwilsonbruno@gmail.com";
    $destinatario = $email;


  // Datos de la cuenta de correo utilizada para enviar vía SMTP
  $smtpHost = "mail.wimaho.com";  // Dominio alternativo brindado en el email de alta 
  $smtpUsuario = "prueba2@wimaho.com";  // Mi cuenta de correo
  $smtpClave = "LOKOloko_23";  // Mi contraseña




  $mail = new PHPMailer();
  //$mail->IsSMTP();
  $mail->SMTPDebug = 2;
  $mail->SMTPAuth = true;
  //$mail->SMTPAuth = true;
  //$mail->SMTPSecure = 'tls'; 
  $mail->Port = 465;
  $mail->IsHTML(true); 
  $mail->CharSet = "utf-8";

  // VALORES A MODIFICAR //
  $mail->Host = $smtpHost; 
  $mail->Username = $smtpUsuario; 
  $mail->Password = $smtpClave;


  //$mail->From = $email; // Email desde donde envío el correo.
  $mail->From = $smtpUsuario; // Email desde donde envío el correo.
  $mail->FromName = $nombre;
  $mail->AddAddress($destinatario); // Esta es la dirección a donde enviamos los datos del formulario
  $mail->AddAddress("wmvilchezbruno@gmail.com"); // Esta es la dirección a donde enviamos los datos del formulario

  $mail->Subject = "Formulario desde el Sitio Web"; // Este es el titulo del email.
  $mensajeHtml = nl2br($mensaje);
  $mail->Body = "
  <html> 

  <body> 

  <h1>Recibiste un nuevo mensaje desde el formulario CanariasPlanet.com</h1>

  <p>Informacion enviada por el usuario de la web:</p>

  <p>asunto: {$asunto}</p>

  

  <p>Mensaje: {$mensaje}</p>

 

  </body> 

  </html>

  <br />"; // Texto del email en formato HTML
  $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
  // FIN - VALORES A MODIFICAR //

  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );

  $estadoEnvio = $mail->Send(); 
  echo "esatdo";
  print_r($estadoEnvio);
  if ($estadoEnvio) {
    echo "enviado";
  }else{
    echo "no enviado";
  }

        
}

echo "<br>";
print_r($emailvalores);
}



?>