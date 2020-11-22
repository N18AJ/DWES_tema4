<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="author" content="Nerea Álvarez Justel">
<!-- Recomendado 5 o 8 palabras clave, Cada palabra clave puede estar constituida por hasta 4 o 5 palabras. -->
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
            table{
                border-collapse: collapse;
            }
            th{
                font-size: 30px;
                border-bottom: 3px solid white;
                margin-bottom: 10px;
            }
            td{
                text-align: center;
            }
            #cont{
                text-align: center;
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
                        <h3>Ejercicio 02</h3>
                    </header>
                    <div id="cont">
                        <?php
                            /*
                           @author: Nerea Álvarez Justel
                           @since: 27/10/2020
                           2.- Mostrar el contenido de la tabla Despartamento y el número de registro.
                          */
                        require '../config/confDB.php';//Fichero de conexión, contien los datos
                        
                        try {
                            // Datos de la conexión a la base de datos
                            $mySQL = new PDO(HOST,USER, PASSWD);
                                        // set the PDO error mode to exception
                                                                    //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                            $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sentenciaSQL = "SELECT * FROM Departamento"; //Consulta SQL que queremos mostrar
                            $resultadoSQL = $mySQL->query($sentenciaSQL); //La metemos en una variable
                            
                            echo "<h1> QUERY </h1>";
                            
                            echo "Número de registros en la tabla Departamento: " . $resultadoSQL->rowCount(); //Mostramos el resultado

                            echo "<table border='0'>";
                            echo "<tr>";
                                echo "<th>Codigo</th>";
                                echo "<th>Descripción</th>";
                                echo "<th>Fecha de Baja</th>";
                                echo "<th>Volumen de Negocio</th>";
                            echo "</tr>";
                            while ($registro = $resultadoSQL->fetchObject()) { //Al realizar el fetchObject, se pueden sacar los datos de $registro como si fuera un objeto
                                echo "<tr>";
                                    echo "<td>$registro->CodDepartamento</td>";
                                    echo "<td>$registro->DescDepartamento</td>";
                                    echo "<td>$registro->FechaBaja</td>";
                                    echo "<td>$registro->VolumenNegocio</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } catch (PDOException $mensajeError) { //Cuando se produce una excepcion se corta el programa y salta la excepción con el mensaje de error
                            echo "<h3>Mensaje de ERROR</h3>";
                            echo "Error: " . $mensajeError->getMessage() . "<br>";
                            echo "Código de error: " . $mensajeError->getCode();
                        } finally {
                            unset($mySQL);//Cierre de la conexión
                        }
                         try {
                            // Datos de la conexión a la base de datos
                            $mySQL = new PDO(HOST,USER, PASSWD);
                                        // set the PDO error mode to exception
                                                                    //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                            $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sentenciaSQL = "SELECT * FROM Departamento"; //Consulta SQL que queremos mostrar
                            $resultadoSQL = $mySQL->prepare($sentenciaSQL); //La metemos en una variable
                            $resultadoSQL->execute(); //Ejecutamos la sentencia

                            echo "<h1> PREPARE </h1>";
                            
                            echo "Número de registros en la tabla Departamento: " . $resultadoSQL->rowCount(); //Mostramos el resultado

                            echo "<table border='0'>";
                            echo "<tr>";
                                echo "<th>Codigo</th>";
                                echo "<th>Descripción</th>";
                                echo "<th>Fecha de Baja</th>";
                                echo "<th>Volumen de Negocio</th>";
                            echo "</tr>";
                            while ($registro = $resultadoSQL->fetchObject()) { //Al realizar el fetchObject, se pueden sacar los datos de $registro como si fuera un objeto
                                echo "<tr>";
                                    echo "<td>$registro->CodDepartamento</td>";
                                    echo "<td>$registro->DescDepartamento</td>";
                                    echo "<td>$registro->FechaBaja</td>";
                                    echo "<td>$registro->VolumenNegocio</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } catch (PDOException $mensajeError) { //Cuando se produce una excepcion se corta el programa y salta la excepción con el mensaje de error
                            echo "<h3>Mensaje de ERROR</h3>";
                            echo "Error: " . $mensajeError->getMessage() . "<br>";
                            echo "Código de error: " . $mensajeError->getCode();
                        } finally {
                            unset($mySQL);//Cierre de la conexión
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
