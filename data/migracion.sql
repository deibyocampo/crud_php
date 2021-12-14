CREATE DATABASE tutorial_crud;

use tutorial_crud;

CREATE TABLE alumnos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  edad INT(3),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/*  esta es es una opcion para crear una base de datos con MYSQL, dando esta instruccion en con la sintaxis MYSQL 
    Tambien podemos probar la consulta antes de usarla en el codigo en phpmyadmin en la seccion SQL.
    Copiamos este codigo y lo pegamos en el espacio de texto y damos continuar.
    si nos nos sale ningun error es que la base de datos ha sido correctamente creada.
*/


