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
            form{
                margin-left: 15%;
            }
            table{
                border-collapse: collapse;
            }
            th{
                font-size: 28px;
                border-bottom: 2px solid white;
                margin-bottom: 10px;
            }
            td{
                text-align: center;
            }
            th:first-child{
                width: 20%;
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
                        <h3>Ejercicio 06</h3>
                    </header>
                    <div>
                       <?php
                        /*
                        @author: Nerea Álvarez Justel
                        @since: 03/11/2020
                        6.- Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos utilizando una consulta preparada.
                       */
                       
                       require '../config/confDB.php';  
                        
                        try {
                            // Datos de la conexión a la base de datos
                            $mySQL = new PDO(HOST,USER, PASSWD);
                                        // set the PDO error mode to exception
                                                                    //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                            $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $aParametros = [array("TTT","Departamento de TTT",NULL,33),array("BBB","Departamento de BBB",NULL,88)];  
                            $sqlDepartamento = 'INSERT INTO Departamento VALUES (:codigo,:descripcion,:baja,:volumen)'; //sentencia SQL que vamos a utilizar

                            $consulta = $mySQL->prepare($sqlDepartamento); //preparamos la consulta preparada

                        $mySQL->beginTransaction();
                            foreach ($aParametros as $key => $value) { //bucle que recorre el array y otorga los valores
                                $consulta->bindParam(":codigo", $value[0]);
                                $consulta->bindParam(":descripcion", $value[1]);
                                $consulta->bindParam(":baja", $value[2]);
                                $consulta->bindParam(":volumen", $value[3]);
                                $consulta->execute(); //ejecucion de la consulta
                            }
                        $mySQL->commit();
                            $consultaSelect = $mySQL->prepare('SELECT * FROM Departamento'); //consulta preparada que mostrara todos los registros de la tabla Departamentos
                            $consultaSelect->execute();
                            echo "<h3>Se ha añadido el departamento TTT y el departamento de BBB</h3>" . "<br>";
                            ?>            
                            <table>
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Fecha Baja</th>
                                        <th>Volumen Negocio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($registro = $consultaSelect->fetchObject()) { //mostramos los datos hasta que llegamos al final
                                        ?>
                                        <tr>
                                            <?php
                                            echo "<td>$registro->CodDepartamento</td>"; //mostramos el codigo del departamento
                                            echo "<td>$registro->DescDepartamento</td>"; //mostramos la descripcion del departamento
                                            echo "<td>$registro->FechaBaja</td>"; //mostramos la fecha de baja
                                            echo "<td>$registro->VolumenNegocio</td>"; //mostramos el volumen de negocio
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                        } catch (PDOException $mensajeError) {
                            echo "Error " . $mensajeError->getMessage() . "<br>"; //mensaje de salida
                            echo "Codigo del error " . $mensajeError->getCode() . "<br>"; //mensaje de salida/codigo del error
                            $mySQL->rollBack();
                            echo "Error tipo rollback";
                        } finally {
                            unset($mySQL); //Se cierra la conexion
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
