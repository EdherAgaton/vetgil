<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS PRODUCTO (
      PRO_ID INTEGER,
      PRO_NOMBRE TEXT NOT NULL, 
      PRO_PRECIO REAL NOT NULL,
      PRO_DESCRIPCION REAL NOT NULL,
      CONSTRAINT PRO_PK
       PRIMARY KEY(PRO_ID),
      CONSTRAINT PRO_NOMBRE_UK
       CHECK(LENGTH(PRO_NOMBRE) > 0), 
    CONSTRAINT PRO_PRECIO_CK
        CHECK(PRO_PRECIO > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
