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

