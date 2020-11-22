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
                        <h3>Ejercicio 00</h3>
                    </header>
                    <div id="cont">
                        <?php
                            /*
                              @author: Nerea Álvarez Justel
                              @since: 27/10/2020 
                              @description: 0 .- Muestra de los Script.
                             */
                        ?>	
                        
                            <h1>Creación de la Base de Datos</h1>
                        /* Creación de la Base de Datos */
                            CREATE DATABASE if NOT EXISTS DAW212DBDepartamentos;

                        /* Creación del usuario */
                            CREATE USER IF NOT EXISTS 'usuarioDAW212DBDepartamentos'@'%' identified BY 'paso'; 

                        /* Usar la base de datos creada */
                            USE DAW212DBDepartamentos;

                        /* Creación de la table departamento */
                        CREATE TABLE IF NOT EXISTS Departamento (
                            CodDepartamento CHAR(3) PRIMARY KEY,
                            DescDepartamento VARCHAR(255) NOT NULL,
                            FechaBaja DATE NULL,
                            VolumenNegocio float NULL
                        )  ENGINE=INNODB;

                        /* Dar permisos al usuario creado */
                            GRANT ALL PRIVILEGES ON DAW212DBDepartamentos.* TO 'usuarioDAW212DBDepartamentos'@'%'; 

                        /* Base de datos a usar */
                            USE DAW212DBDepartamentos;
                            
                            <h1>Carga Inicial de la Base de Datos</h1>
                        /* Base de datos a usar */<br>
                        USE DAW212DBDepartamentos;<br>

                        /*Introduccion de datos dentro de la tabla creada*/
                        INSERT INTO Departamento(CodDepartamento,DescDepartamento,FechaBaja,VolumenNegocio) VALUES
                        ('INF', 'Departamento de informatica',null,1),
                        ('VEN', 'Departamento de ventas',null,2),
                        ('CON', 'Departamento de contabilidad',null,3),
                        ('COC', 'Departamento de cocina',null,4),
                        ('MEC', 'Departamento de mecanica',null,5),
                        ('MAT', 'Departamento de matematicas',null,6);
                        
                            <h1>Borrado de la Base de Datos</h1>
                        /* Borrar base de datos */
                        DROP database DAW212DBDepartamentos;

                        /* Borrar usuario asociado a esa base de datos */
                        DROP USER usuarioDAW212Departamentos;

                        /*Borrar la tabla de datos con drop*/
                        DROP TABLE Departamento;

                        
                        
                        <h1 style="text-aling:center;">1 AND 1</h1>
                        
                        <h1>EJECUTAMOS LOS SCRIPTS</h1>
                        <?php

                        //Tragen Sie hier Ihre Datenbankinformationen ein und den Namen der Backup-Datei
                        $mysqlDatabaseName ='dbs272023';
                        $mysqlUserName ='dbu287774';
                        $mysqlPassword ='Covid1234$';
                        $mysqlHostName ='db5000278679.hosting-data.io';
                        $mysqlImportFilename ='CargarInicialDAW212DBDepartamentos.sql';

                        //Por favor, no haga ningún cambio en los siguientes puntos
                        //Importación de la base de datos y salida del status
                        $command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
                        exec($command,$output=array(),$worked);
                        switch($worked){
                        case 0:
                        echo 'Los datos del archivo <b>' .$mysqlImportFilename .'</b> se han importado correctamente a la base de datos <b>' .$mysqlDatabaseName .'</b>';
                        break;
                        case 1:
                        echo 'Se ha producido un error durante la importación. Por favor, compruebe si el archivo está en la misma carpeta que este script. Compruebe también los siguientes datos de nuevo: <br/><br/><table><tr><td>Nombre de la base de datos MySQL:</td><td><b>' .$mysqlDatabaseName .'</b></td></tr><tr><td>Nombre de usuario MySQL:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>Contraseña MySQL:</td><td><b>NOTSHOWN</b></td></tr><tr><td>Nombre de host MySQL:</td><td><b>' .$mysqlHostName .'</b></td></tr><tr><td>Nombre de archivo de la importación de MySQL:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
                        break;
                        }
                        ?>                    

                        /* Creación de la table departamento */
                        CREATE TABLE IF NOT EXISTS Departamento (
                            CodDepartamento CHAR(3) PRIMARY KEY,
                            DescDepartamento VARCHAR(255) NOT NULL,
                            FechaBaja DATE NULL,
                            VolumenNegocio float NULL
                        )  ENGINE=INNODB;

                        /*Introduccion de datos dentro de la tabla creada*/
                        INSERT INTO Departamento (CodDepartamento,DescDepartamento,FechaBaja,VolumenNegocio) VALUES
                        ('INF', 'Departamento de informatica',NULL,1000),
                        ('VEN', 'Departamento de ventas',NULL,2500),
                        ('CON', 'Departamento de contabilidad',NULL,5000),
                        ('EVE', 'Departamento de eventos',NULL,15500),
                        ('EMP', 'Departamento de empleados',NULL,5500),
                        ('FIN', 'Departamento de finanzas',NULL,2500);
                        
                       /*Borrar la tabla de datos con drop*/
                        DROP TABLE Departamento;
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

