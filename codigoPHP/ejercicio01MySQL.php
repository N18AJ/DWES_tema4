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
                              @since: 28/10/2020 
                              @description: 1 .- Conexión a la base de datos con la cuenta usuario y tratamiento de errores.
                             */               
                            require '../config/confDB.php';//Fichero de conexión, contien los datos
                           
                            // Datos de la conexión a la base de datos
                            $miDB = new mysqli();
                            $miDB->connect('192.168.20.19', 'usuarioDAW212DBDepartamentos', 'paso', 'DAW212DBDepartamentos');
                            echo "<h3 style='color: green';>Conexión establecida a la base de datos</h3>";

                            //conexión erronea
                            $miDB2 = new mysqli();
                            $miDB2->connect('192.168.20.19', 'usuarioDAW212DBDepartamentos', 'paso1234', 'DAW212DBDepartamentos');
                            echo"<span style='color: red;'>Error: </span>".$miDB->connect_error."<br>";
                                echo"<p>Código del error: </p>".$miDB->connect_errno."<br>";
                            $miDB->close(); 
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