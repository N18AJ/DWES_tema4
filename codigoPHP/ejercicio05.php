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
                        <h3>Ejercicio 05</h3>
                    </header>
                    <div id="cont">
                         <?php
                    /*
                      @author: Nerea Álvarez Justel
                      @since: 29/10/2019
                      5.- Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.
                     */				
                         require '../config/confDB.php';
                         
                            try{
                                // Datos de la conexión a la base de datos
                                $mySQL = new PDO(HOST,USER, PASSWD);
                                            // set the PDO error mode to exception
                                                                        //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                                $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                //Inicializamos un array que contenga las 3 inserciones
                                $aInserciones = array(
                                    "INSERT INTO Departamento VALUES ('UUU', 'Transacción del U',null,'4');", 
                                    "INSERT INTO Departamento VALUES ('III', 'Transacción del I',null,'1');", 
                                    "INSERT INTO Departamento VALUES ('OOO', 'Transacción del O',null,'8');");
                                $mySQL->beginTransaction();
                                    $mySQL->exec($aInserciones[0]);
                                    $mySQL->exec($aInserciones[1]);
                                    $mySQL->exec($aInserciones[2]);

                                    $mySQL->commit();

                                    echo "<h3>La transacción con las 3 funcionó correctamente</h3>";

                                ?>
                                <br/>
                                <br/>
                            <?php
                            }catch(PDOException $excepcion){
                                echo "<h1>Se ha producido un error, disculpe las molestias</h1>";
                                if($excepcion->getCode() == 1045 || $excepcion->getCode() == 2002){ //codigos de error de conexion
                                    echo "<h4>No se ha podido establecer la conexión a la base de datos</h4>";
                                }else{
                                    echo "<h4>Se ha producido un error en la inserción</h4>";
                                    $mySQL->rollBack();
                                }
                            }finally{
                                unset($mySQL);
                            }
                            ?>
                                <input id="enviar" type="button" name="Ver" value="Ver" onclick="location='ejercicio02.php'">
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
