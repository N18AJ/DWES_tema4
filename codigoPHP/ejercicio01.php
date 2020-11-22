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
            #cont{
                    margin-left: 10%;
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
                        <h3>Ejercicio 01</h3>
                    </header>
                    <div id="cont">
                        <?php
                            /*
                              @author: Nerea Álvarez Justel
                              @since: 27/10/2020 
                              @description: 1 .- Conexión a la base de datos con la cuenta usuario y tratamiento de errores.
                             */
                            require '../config/confDB.php'; //Fichero de conexión, contien los datos

                             try {
                                // Datos de la conexión a la base de datos
                                $mySQL = new PDO(HOST,USER, PASSWD);
                                            // set the PDO error mode to exception
                                                                        //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                                $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            echo "<h3 style='color: green';>Conexión establecida a la base de datos</h3>";

                            $atributos = array( //array que contiene los atributos del PDO::ATTR - Se utiliza para llamar los atributos
                                "AUTOCOMMIT", //Activa o desactiva las modificaciones de la base de datos
                                "ERRMODE", //Manejo de errores
                                "CASE",
                                "CLIENT_VERSION",
                                "CONNECTION_STATUS",
                                "ORACLE_NULLS",
                                "PERSISTENT",
                                "SERVER_INFO",
                                "SERVER_VERSION"
                                        );

                            echo "<h3>Atributos de la conexion</h3>";
                            foreach ($atributos as $valor) { //mediante un foreach recorremos el array de atributos
                                echo "<b>PDO::ATTR_$valor: </b>";
                                echo $mySQL->getAttribute(constant("PDO::ATTR_$valor")) . "<br>"; //mostramos mensaje de salida
                            }

                            //conexión erronea
                            $mySQL = new PDO("mysql:host=".HOST.";dbname=".DB, USER, "paso1234");
                                            // set the PDO error mode to exception
                                $mySQL2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            } catch (PDOException $mensajeError) {
                                echo "<h3 style='color: red';>Mensaje de conexión errónea</h3>";
                                echo "Error: " . $mensajeError->getMessage() . "<br>";
                                echo "Código de error: " . $mensajeError->getCode();
                            } finally {
                                unset($mySQL);  //Cerramos la conexion
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
