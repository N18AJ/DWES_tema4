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
            .obligatorio input{
                background-color: #EBE8E7;
            }
            .obligatorio textarea{
                background-color: #EBE8E7;
            }
            .obligatorio select{
                background-color: #EBE8E7;
            }
            .obligatorio label{
                text-decoration: underline;
            }
            .error{
                color: #ff708c;
            }
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
            input{
                width: 185px;
                height: 25px;
                text-align: center;
                margin-top: 10px;
            }
            #enviar{
                width: 60px;
                height: 20px;
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
                        <h3>Ejercicio 04</h3>
                    </header>
                    <div id="cont">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <fieldset>
                                <legend>Buscador de departamentos</legend>
                                <div class="obligatorio">
                                    Descripción del departamento: 
                                    <input type="text" name="descripcion" placeholder="Descripción" value="<?php if(isset($_REQUEST['descripcion'])){ echo $_REQUEST['descripcion'];} ?>"><br> <!--//Si el valor es bueno, lo escribe en el campo-->                
                                </div>
                                <br/>
                                <div>
                                    <input id="enviar" type="submit" name="buscar" value="Buscar">
                                </div>
                            </fieldset>
                        </form>   
                                <br/>
                                <br/>
                        <?php
                            /*
                              @author: Nerea Álvarez Justel
                              @since: 28/10/2020 
                              4 .-  Formulario de búsqueda de departamentos por decripción (por una parte del campò DescDepartamento).
                             */
                            require '../config/confDB.php';//Fichero de conexión, contien los datos
                            require '../core/validacionFormularios.php'; //Importamos la libreria de validacion
                            try{
                                $mySQL = new PDO(HOST,USER, PASSWD);
                                                    // set the PDO error mode to exception
                                                                        //PDO::ERRMODE_EXCEPTION - Además de establecer el código de error, PDO lanzará una excepción PDOException y establecerá sus propiedades para luego poder reflejar el error y su información.
                                $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            /* Muestra de tabla entera */
                            if (isset($_POST['buscar'])) {//Al buscar "nada" Mostrara toda la tabla
                                //OBLIGATORIOS
                                $aFormulario['descripcion'] = ($_REQUEST['descripcion']); 
                                //Búsqueda del departamento  
                                $sentenciaSQL = "SELECT * FROM Departamento WHERE DescDepartamento LIKE '%$aFormulario[descripcion]%'"; //Consulta SQL que queremos mostrar
                                $resultadoSQL = $mySQL->prepare($sentenciaSQL); //La metemos en una variable
                                $resultadoSQL->execute(); //Ejecutamos la sentencia

                                if($resultadoSQL->rowCount() === 0){
                                    echo "<h2>No se ha encontrado ningún departamento relacionado con esa descripción</h2>";
                                }else{
                                    echo "<table>";
                                    echo "<tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Fecha de Baja</th>
                                            <th>Volumen de Negocio</th>
                                        </tr>";
                                    while($fila = $resultadoSQL->fetchObject()){ //Mientras haya filas, lo hace
                                        echo "<tr><td>" . $fila->CodDepartamento . "</td><td>" . $fila->DescDepartamento . "</td><td>" . $fila->FechaBaja . "</td><td>" . $fila->VolumenNegocio . "</td></tr>";
                                    }
                                    echo "</table>";
                                }
                            }    
                            }catch(PDOException $excepcion){
                                echo "<h1>Se ha producido un error, disculpe las molestias</h1>";
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