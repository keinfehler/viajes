
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Clientes</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
	
	
</head>

<body>


<?php
require 'Partial/header.php';
require_once "database.php";

$nombre_cliente_buscar = '';

if (isset($_POST["submit"])) {
    $nombre_cliente_buscar = $_POST['nombre_cliente'];
}
?>

<br>
	<br>
	<br>
<h2 class="title">Clientes </h2>
<h2 class="title">Buscar </h2>
    <form action="admin_clientes.php" method="post">
        <label>Nombre del cliente</label>
        <input type="text" name="nombre_cliente"/>
        <input type="submit" value="Buscar..." name="submit">
    </form>
  <center>
  
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            
            
            <th class="tbl">Id</th>
            <th class="tbl">Nombre</th>
            <th class="tbl">Email</th>
            <th class="tbl">Es administrador?</th>
            <th class="tbl"></th>
      
          </tr>

          <?php
                
                 $sql6 = "SELECT * FROM clientes";
                 if ($nombre_cliente_buscar <> '')
                 $sql6 =  "SELECT * FROM clientes WHERE Nombre like '%$nombre_cliente_buscar%'";


                 $result6 = mysqli_query($conn, $sql6);
            while ($row = mysqli_fetch_object($result6)){
             
            
              echo "<td class='tb'>" ;
              echo $row->ID_Cliente;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Nombre;
              echo "</td>";
              
              /*
              echo "<td class='tb'>" ;
              echo $row->ID_paquete;
              echo "</td>";
              */
              echo "<td class='tb'>" ;
              echo $row->Email;
              echo "</td>";

              echo "<td class='tb'>" ;
              if ($row->ID_cargo == 1)
              {
                echo "Sí";
              }else 
              {
                echo "No";
              }

              echo "</td>";


              echo "<td class='tb'>" ;
              echo "<a href='admin_cliente.php?id_usuario=$row->ID_Cliente&action=editar'>Editar</a> "; 
              echo "<a href='admin_cliente.php?id_usuario=$row->ID_Cliente&action=eliminar'>Eliminar</a>"; 
              echo "</td></tr>";

           }
          ?>
        </table>
      </article>
    </section>
  
  </center>

    
</body>
</html>