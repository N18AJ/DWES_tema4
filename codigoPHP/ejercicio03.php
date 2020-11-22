<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="author" content="Nerea Álvarez Justel">
        <meta name="application-name" content="Sitio Web">
        <meta name="description" content="Desarrollo del segundo curso de DAW">
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
                        <h3>Ejercicio 03</h3>
                    </header>
                    <div id="cont">
                        <?php
                            /*
                              @author: Nerea Álvarez Justel
                              @since: 28/10/2020 
                              3 .-  Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.
                             */
                            require '../config/confDB.php';
                            require '../core/validacionFormularios.php'; //Importamos la libreria de validacion

                            $entradaOK = true; //Inicializamos una variable que nos ayudara a controlar si todo esta correcto

                            //Inicializamos un array que se encargara de recoger los errores(Campos vacios)
                            $aErrores = [
                                'CodDepartamento' => null,
                                'DescDepartamento' => null,
                                'VolumenNegocio' => null
                            ];

                            //Inicializamos un array que se encargara de recoger los datos del formulario(Campos vacios)
                            $aFormulario = [
                                'CodDepartamento' => null,
                                'DescDepartamento' => null,
                                'VolumenNegocio' => null
                            ];

                            if (isset($_REQUEST['Enviar']) && $_REQUEST['Enviar'] == 'Enviar') { //Si se ha pulsado enviar
                                //La posición del array de errores recibe el mensaje de error si hubiera
                            #OBLIGATORIOS
                                $aErrores['CodDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['CodDepartamento'], 3, 3, 1);  //maximo, mínimo y obligatorio 
                                
                                if($aErrores['CodDepartamento'] == null){ // si no ha habido ningun error de validacion del campo del codigo del departamento
                                try { // Bloque de código que puede tener excepciones en el objeto PDO
                                    $mySQL = new PDO(HOST,USER, PASSWD); // creo un objeto PDO con la conexion a la base de datos
                                    $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establezco el atributo para la apariciopn de errores y le pongo el modo para que cuando haya un error se lance una excepcion

                                    $selectSQL = "SELECT CodDepartamento FROM Departamento WHERE CodDepartamento=:codDepartamento";
                                    $sentenciaSQL = $mySQL->prepare($selectSQL); // prepara la consulta
                                    $codigoDuplicado = [':codDepartamento'=> $_REQUEST['CodDepartamento']];
                                    $sentenciaSQL->execute($codigoDuplicado); // ejecuta la consulta 
                                    if($sentenciaSQL->rowCount()>0){
                                        $aErrores['CodDepartamento']= "El código del departamento ya existe"; // meto un mensaje de error en el array de errores del codigo del departamento
                                    }

                                }catch (PDOException $mensajeError) { //Cuando se produce una excepcion se corta el programa y salta la excepción con el mensaje de error
                                    echo "<h4>Se ha producido un error. Disculpe las molestias</h4>";
                                } finally {
                                    unset($mySQL);
                                }
                            }

                                $aErrores['DescDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['DescDepartamento'], 255, 1, 1);  //maximo, mínimo y obligatorio
                                $aErrores['VolumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['VolumenNegocio'], PHP_INT_MAX, 1, 1);//maximo, mínimo y obligatorio
                                
                                foreach ($aErrores as $campo => $error) { //Recorre el array en busca de mensajes de error
                                    if ($error != null) { //Si lo encuentra vacia el campo y cambia la condiccion
                                        $entradaOK = false; //Cambia la condiccion de la variable
                                    }
                                    else{
                                        if(isset($_REQUEST[$campo])){
                                            $aFormulario[$campo] = $_REQUEST[$campo];
                                        }
                                    } 
                                }
                            } else {
                                $entradaOK = false; //Cambiamos el valor de la variable porque no se ha pulsado el botón
                            }

                            if ($entradaOK) { //Si el valor es true procesamos los datos que hemos recogido
                                //Mostramos los datos por pantalla
                                $aFormulario['CodDepartamento'] = strtoupper($_REQUEST['CodDepartamento']); //Todo en mayúsculas
                                $aFormulario['DescDepartamento'] = ucfirst($_REQUEST['DescDepartamento']); //La primera letra en mayúscula
                                $aFormulario['VolumenNegocio'] = $_REQUEST['VolumenNegocio'];

                            try {                               
                                // Datos de la conexión a la base de datos
                                $mySQL = new PDO(HOST,USER, PASSWD);
                                $mySQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Cómo capturar las excepciones y muestre los errores

                                //Crear el departamento en la base de datos    
                                $sentenciaSQL = $mySQL->prepare("INSERT INTO Departamento(CodDepartamento, DescDepartamento, VolumenNegocio) VALUES (:codigo, :descripcion, :volumen);");
                                $sentenciaSQL->bindParam(":codigo", $aFormulario['CodDepartamento']);
                                $sentenciaSQL->bindParam(":descripcion", $aFormulario['DescDepartamento']);
                                $sentenciaSQL->bindParam(":volumen", $aFormulario['VolumenNegocio']);
                                $sentenciaSQL->execute();

                                $selectSQL = "SELECT * FROM Departamento"; //Consulta SQL que queremos mostrar
                                $resultadoSQL = $mySQL->prepare($selectSQL); //La metemos en una variable
                                $resultadoSQL->execute(); //Ejecutamos la sentencia
                                echo '<table>';
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
                                echo '</table>';
                            } catch (PDOException $mensajeError) { //Cuando se produce una excepcion se corta el programa y salta la excepción con el mensaje de error
                                echo "<h3>Mensaje de ERROR</h3>";
                                echo "Error: " . $mensajeError->getMessage() . "<br>";
                                echo "Código de error: " . $mensajeError->getCode();
                            } finally {
                                unset($mySQL);
                            }

                            } else { //Mostrar el formulario hasta que se rellene correctamente
                        ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <fieldset>
                                    <legend style="margin-left: 30%; font-size: 28px;">DEPARTAMENTOS</legend>
                                    <br>
                                    <div class="obligatorio">
                                        Código Departamento: 
                                        <input type="text" name="CodDepartamento" placeholder="Introduzca siglas: " 
                                               value="<?php if($aErrores['CodDepartamento'] == NULL && isset($_REQUEST['CodDepartamento'])){ echo $_REQUEST['CodDepartamento'];} ?>"><br> <!--//Si el valor es bueno, lo escribe en el campo-->
                                        <?php if ($aErrores['CodDepartamento'] != NULL) { ?>
                                        <div class="error">
                                            <?php echo $aErrores['CodDepartamento']; //Mensaje de error que tiene el array aErrores   ?>
                                        </div>   
                                    <?php } ?>                
                                    </div>
                                    <br>
                                    <div class="obligatorio">
                                        Descripción Departamento: 
                                        <input type="text" name="DescDepartamento" placeholder="Introduzca descripción: " 
                                               value="<?php if($aErrores['DescDepartamento'] == NULL && isset($_REQUEST['DescDepartamento'])){ echo $_REQUEST['DescDepartamento'];} ?>"><br> <!--//Si el valor es bueno, lo escribe en el campo-->
                                        <?php if ($aErrores['DescDepartamento'] != NULL) { ?>
                                        <div class="error">
                                            <?php echo $aErrores['DescDepartamento']; //Mensaje de error que tiene el array aErrores   ?>
                                        </div>   
                                    <?php } ?>                
                                    </div>
                                    <br>
                                    <div class="obligatorio">
                                        Volumen de Negocio: 
                                        <input type="text" name="VolumenNegocio" placeholder="Introduzca volumen: " 
                                               value="<?php if($aErrores['VolumenNegocio'] == NULL && isset($_REQUEST['VolumenNegocio'])){ echo $_REQUEST['VolumenNegocio'];} ?>"><br> <!--//Si el valor es bueno, lo escribe en el campo-->
                                        <?php if ($aErrores['VolumenNegocio'] != NULL) { ?>
                                        <div class="error">
                                            <?php echo $aErrores['VolumenNegocio']; //Mensaje de error que tiene el array aErrores   ?>
                                        </div>   
                                    <?php } ?>                
                                    </div>
                                    <br/>
                                    <br/>
                                    <div>
                                        <input id="enviar" type="submit" name="Enviar" value="Enviar">
                                    </div>
                                </fieldset>
                            </form>
                        <?php } ?>
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
