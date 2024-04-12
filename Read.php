<?php

include 'connect.php';
$buscar = $_POST['buscar'];
$SQL_READ = "select * from clientes WHERE Nombre LIKE '%".$buscar."%' OR Apellido LIKE '%".$buscar."%' OR Email LIKE '%".$buscar."%'";

$sql_query = mysqli_query($conn,$SQL_READ);

?>