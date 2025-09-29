<?php

    $db = \Config\Database::connect();
   $query = $db->query("SELECT * FROM productos WHERE nombre_producto LIKE '%Baby%'");
    $resultados = $query->getResult();

    echo $resultados['nombre_producto'];
    
?>