
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Clientes</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <style>
       .container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.container h1 {
    text-align: center;
    margin-bottom: 20px;
}

.container form {
    text-align: center;
}

.container input[type="text"] {
    width: 50%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.container input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.container input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
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
  <div class="container">
<h2><center>Clientes</center></h2>
<h2><center>Buscar</center></h2>
    <form action="admin_clientes.php" method="post">
        <label>Nombre del cliente</label>
        <input type="text" name="nombre_cliente"/>
        <br>
        <br>
        <input type="submit" value="Buscar..." name="submit">
    </form>
  </div>

</body>
</html>

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