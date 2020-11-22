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
            .error{
                color: #ff708c;
                font-size: 14px;
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
                        <h3>Ejercicio 07</h3>
                    </header>
                    <div>
                        <?php
                            /*
                              @author: Nerea Álvarez Justel
                              @since: 02/05/2020
                              Comentarios: 
                              7.- Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla Departamento de nuestra base de datos. (IMPORTAR).
                             */
                        //es idéntica a require excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye de nuevo
                        require_once '../config/confDB.php';
                        try{
                            $mySQL = new PDO(HOST,USER, PASSWD); //Se inicia la variable como objeto PDO    
                                                // set the PDO error mode to exception
                                                                    //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                            $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            //Borrado de la información anterior - Borrando tabla
                            $consultaDrop = $mySQL->prepare('DROP TABLE Departamento');
                            $consultaDrop->execute();
                            //Creación de tabla para nueva inserción
                            $consultaCrear = $mySQL->prepare('CREATE TABLE IF NOT EXISTS Departamento (
                                                                CodDepartamento CHAR(3) PRIMARY KEY,
                                                                DescDepartamento VARCHAR(255) NOT NULL,
                                                                FechaBaja DATE NULL,
                                                                VolumenNegocio float NULL
                                                            )  ENGINE=INNODB;'); 
                            $consultaCrear->execute();
                            //sentencia de insert
                            $sqlDepartamento = 'INSERT INTO Departamento VALUES (:CodDepartamento,:DescDepartamento,:FechaBaja,:VolumenNegocio)'; //sentencia SQL que vamos a utilizar  
                            $consulta=$mySQL->prepare($sqlDepartamento);
                            $xml = new DOMDocument("1.0", "utf-8");
                            $xml->load('../tmp/ficheroXML.xml');

                            $numeroDepartamentos = $xml->getElementsByTagName('Departamento')->count();
                            for ($numeroDepartamento = 0; $numeroDepartamento < $numeroDepartamentos; $numeroDepartamento++){
                                //COMPROBACIÓN
                                //var_dump($numeroDepartamentos);
                                $CodDepartamento = $xml->getElementsByTagName("CodDepartamento")->item($numeroDepartamento)->nodeValue;
                                $DescDepartamento = $xml->getElementsByTagName("DescDepartamento")->item($numeroDepartamento)->nodeValue;
                                $FechaBaja = $xml->getElementsByTagName("FechaBaja")->item($numeroDepartamento)->nodeValue;
                                if(empty($FechaBaja)){
                                    $FechaBaja = null;
                                }
                                $VolumenNegocio = $xml->getElementsByTagName("VolumenNegocio")->item($numeroDepartamento)->nodeValue; 

                                $parametros=[":CodDepartamento"=>$CodDepartamento,
                                            ":DescDepartamento"=>$DescDepartamento, 
                                            ":FechaBaja"=>$FechaBaja,
                                            ":VolumenNegocio"=>$VolumenNegocio];
                                $consulta->execute($parametros);
                                }
                            echo "Datos cargados";
                        } catch (PDOException $excepcion){
                            echo $excepcion->getMessage();
                            echo $excepcion->getCode();
                            echo "ERROR";
                            $mySQL->rollBack();
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
