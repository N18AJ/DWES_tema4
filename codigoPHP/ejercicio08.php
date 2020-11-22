<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="author" content="Nerea Álvarez Justel">
        <meta name="robots" content="index, follow" />
        <title>DAW. Nerea Álvarez Justel</title> 
<!-- CSS -->
        <link href="../webroot/css/estilos.css" rel="stylesheet" type="text/css">
<!-- Favicon -->
        <link rel="icon" href="../../../../favicon.png" type="x-icon">
<!-- Tipografía -->
        <link href="https://fonts.googleapis.com/css?family=ZCOOL+KuaiLe" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <style>
            #enviar{
                width: 70px;
                height: 30px;
                margin-left:36%;
            }
        </style>
    </head>

    <body> 
        <!-- Header -->
        <header id="header">
            <a href="../../../doc/cv.pdf" target="_blank"><img src="../webroot/media/images/cv2.png" alt="CV" width="55" class="icono_link"/></a>
            <a href="http://daw212.ieslossauces.es/"><img src="../webroot/media/images/logo2.png" alt="Logo" width="150" class="icono_logo"/></a>
            <a href="https://github.com/N18AJ" target="_blank"><img src="../webroot/media/images/git2.png" alt="GitHub" width="65" class="icono_git"/></a>
        </header>


        <!-- Main -->
        <div id="main">

            <!-- Tiles -->
            <section class="tiles">
                <article>
                    <header class="major">
                        <a href="../indexTema4.html"><img src="../webroot/media/images/atras2.png" alt="atras" width="45" class="icono_atras"/></a>
                        <h3>Ejercicio 08</h3>
                    </header>
                    <div id="cont">
                        <?php
                        /*
                        @author: Nerea Álvarez Justel
                        @since: 02/05/2020
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
                                 echo "<h3>El archivo se ha exportado correctamente</h3>";
                                 ?>
                              <input id="enviar" type="button" name="Ver" value="Ver" onclick="location='ejercicio02.php'">
                               <?php  
                             }catch(PDOException $excepcion){
                                 echo "<h1>No se ha podido exportar el archivo</h1>";
                                 echo $excepcion->getMessage();
                             }finally{
                                 unset($mySQL);
                             }
                       ?>
                    </div>   
                </article>
            </section>
        </div>

        <!-- Footer -->
        <footer id="footer">
            <a href="../../../../index.html"><div class="copyright">&copy; Nerea Álvarez Justel</div></a>
        </footer>
    </body>
</html>
