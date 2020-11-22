<?php
/*
@author: Nerea Álvarez Justel
@since: 11/11/2020
Comentarios: 
8.- Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR).
*/
    //es idéntica a require excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye de nuevo
    require_once '../config/confDB.php';

    try{
        // Datos de la conexión a la base de datos
        $mySQL = new PDO(HOST,USER, PASSWD);
                    // set the PDO error mode to exception
                                                //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
        $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $excepcion){
         die("No se pudo establecer la conexión a la base de datos");
     }
     try{
         $resultado = $mySQL->query("SELECT * FROM Departamento;");
         $ficheroXML = new DOMDocument("1.0", "utf-8"); //crear el fichero
         $ficheroXML->formatOutput =true; //hace que salga espaciado y tabulado
         $raiz = $ficheroXML->appendChild($ficheroXML->createElement("Departamentos"));  //Creamos la rama hijos de departamentos

         while($oDepartamento = $resultado->fetchObject()){// creamos un bucle para sacar todos los elementos en la estructura XML
             $departamento = $raiz->appendChild($ficheroXML->createElement("Departamento"));
             $departamento->appendChild($ficheroXML->createElement("CodDepartamento", $oDepartamento->CodDepartamento));
             $departamento->appendChild($ficheroXML->createElement("DescDepartamento", $oDepartamento->DescDepartamento));
             $departamento->appendChild($ficheroXML->createElement("FechaBaja", $oDepartamento->FechaBaja));
             $departamento->appendChild($ficheroXML->createElement("VolumenNegocio", $oDepartamento->VolumenNegocio));
         }
         $ficheroXML->saveXML(); //Guarda la estructura XML en formato String
         $ficheroXML->save("../tmp/ficheroXML.xml");

         header('Content-Type: text/xml');
         header("Content-Disposition: attachment; filename=ficheroXML.xml"); //descargar
         readfile("../tmp/ficheroXML.xml"); //mostrar desde el fichero del servidor en el navegador el documento xml si este no se descarga

     }catch(PDOException $excepcion){
         echo $excepcion->getMessage();
     }finally{
         unset($mySQL);
     }
?>