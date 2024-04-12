
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Reservas - Viajes Colombia</title>
	<link rel="stylesheet" type="text/css" href="css\estilos.css"></link>
</head>

<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      text-align: center;
    }

    input[type="search"] {
      width: 70%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-right: 10px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .centered-table {
  margin: 20px auto;
  text-align: center;
}

.centered-table table {
  width: 80%;
  margin: 0 auto;
}

.centered-table th, .centered-table td {
  padding: 10px;
}

.centered-table th {
  background-color: #007bff;
  color: #fff;
}

.centered-table tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

 .add-reservation-form {
      margin-top: 50px;
    }
    .add-reservation-form label {
      color: blue;
      font-size: 18px;
      font-weight: bold;
    }
    .add-reservation-form input[type="date"],
    .add-reservation-form select {
      width: 50%;
      font-size: 16.5px;
      padding: 1.5px;
      box-sizing: border-box;
      font-weight: bold;
    }

  </style>

<body>
  <?php require_once "database.php";?>
	<?php require 'Partial/header.php'   ?>

  
  <?php
  if (isset($_POST["anular"])) {

    $id_reserva = $_POST["id_reserva"];  
    $sql8 = "DELETE FROM reservas WHERE ID_reserva = '$id_reserva'";
    $stmt8 = mysqli_stmt_init($conn);
    $prepareStmt8 = mysqli_stmt_prepare($stmt8,$sql8);
    if ($prepareStmt8) {
     
        mysqli_stmt_execute($stmt8);
        echo "<div class='alert alert-success'>Reserva anulada</div>";
    }

  }
  
  if (isset($_POST["reserva"]) & isset($_POST["select_paquete"])) {
      

    //echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 
    
    $id_paquete = $_POST["select_paquete"];  

    if($id_paquete > 0)
    {
          
        $finicio = $_POST["fecha_inicio"];
        $ffin = $_POST["fecha_fin"];
        $precio_total = 0;
        
        $sql4 = "SELECT * FROM paquetes WHERE ID_paquete = '$id_paquete'";
        $result5 = mysqli_query($conn, $sql4);
        while ($row = mysqli_fetch_object($result5)){
        $precio_total = $precio_total + $row->Precio_total;
        
        }
        $id_cliente = $_SESSION["idcliente"];
        $id_empleado = 30;
          
        $sql4 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ('$finicio', '$ffin', '$precio_total', '$id_paquete', '$id_cliente','$id_empleado')";
        //$sql3 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ( ?, ?, ?, ? ,? ,? )";
        $stmt3 = mysqli_stmt_init($conn);
        $prepareStmt3 = mysqli_stmt_prepare($stmt3,$sql4);
        if ($prepareStmt3) {
            mysqli_stmt_execute($stmt3);
            echo "<div class='alert alert-success'>Reserva exitosa.</div>";
        }else{
            die("Algo ha fallado!");
        }
    }else 
    {
      echo "<div class='alert alert-success'>Por favor selecciona un paquete</div>";

    }

    
  }
  
  ?>
 

<br>




<br>


  <div class="container add-reservation-form">
  
         <h2><center>Añadir reserva</center></h2>
                
  <form action="reserva.php"  method="post">
            <div class="inpute">
              <br>
              <label>Inicio:</label>
              <input type="date" name="fecha_inicio" id="fecha_inicio"  required/>
            </div>
              <br>
              <div class="inpute">
              <br>
              <label>Fin:</label>
              <input type="date" name="fecha_fin" id="fecha_fin"  required/>
            </div>
            <div>
              <br>
              <br>
              <label>Paquete:</label>
              <br>
              <br>
              <select name="select_paquete" id="select_paquete">
              <option value="0">Selecciona un paquete...</option>
                <?php
                    $sql2= "SELECT paquetes.ID_paquete,paquetes.Nombre_paquete, paquetes.Descripcion, destinos.Nombre_Destino, paquetes.Precio_total, destinos.Descripcion as Tipo FROM paquetes, destinos WHERE paquetes.ID_Destino = destinos.ID_Destino";
                    $result2 = mysqli_query($conn, $sql2);
                     while ($row = mysqli_fetch_object($result2)){
                      echo '<option value="'.$row->ID_paquete.'">'.$row->Nombre_paquete.' - '.$row->Descripcion.' - '.$row->Nombre_Destino. ' - '.$row->Tipo. ' - ' .$row->Precio_total.  ' EUROS </option>';
                     
                     }
                  ?>
  
                </select>
             
            </div>
            <div>
              <br>
              <input name="reserva" type="submit"/>
            </div>
        </form>
       
          </div>
      </article>
    </section>
  
  </center>


  <h2 class="title">Reservas </h2>
  <center>
    
    <section>
      <article>
        <table border="1" bgcolor="#D6EAF8">
          <tr>
            
            
            <th class="tbl">Inicio</th>
            <th class="tbl">Fin</th>
            <th class="tbl">Precio</th>
            <th class="tbl"></th>
      
          </tr>

          <?php
                 $currendUser = $_SESSION["idcliente"];
                 $sql6 = "SELECT * FROM reservas WHERE ID_cliente = '$currendUser'";
                 $result6 = mysqli_query($conn, $sql6);
           while ($row = mysqli_fetch_object($result6)){
              /*
              echo "<tr><td class='tb'>" ;
              echo $row->ID_reserva;
              echo "</td>";

              
              echo "<td class='tb'>" ;
              echo $row->ID_cliente;
              echo "</td>";
              */
            
              echo "<td class='tb'>" ;
              echo $row->Fecha_inicio;
              echo "</td>";

              echo "<td class='tb'>" ;
              echo $row->Fecha_fin;
              echo "</td>";
              
              /*
              echo "<td class='tb'>" ;
              echo $row->ID_paquete;
              echo "</td>";
              */
              echo "<td class='tb'>" ;
              echo $row->Precio_total;
              echo " Euros </td>";

              echo "<td class='tb'>" ;
              echo "<form method='post' action='reserva.php'> <input type='hidden' name='id_reserva' value='$row->ID_reserva' /> <input name='anular' type='submit' value='anular'/> </form>";
              echo "</td></tr>";

           }
          ?>
        </table>
      </article>
    </section>
  
  </center>

</body>

<hr>
<div class="container">

<H1> BUSCADOR</H1>
<form action="reserva.php" method="POST" target="_blank">
  <p>
    <input type="search" name="buscar">
    <br>
    <br>
  <input type="submit" value="Buscar">
</p>
</form>
</div>

<div class="centered-table">
<?php
// Verificar si se ha enviado un formulario y el campo 'buscar' está definido
if (isset($_POST['buscar'])) {
    // Establecer la variable $buscar con el valor del campo 'buscar' del formulario
    $buscar = $_POST['buscar'];

    // Realizar la consulta SQL solo si $buscar está definido
    $SQL_READ = "SELECT * FROM clientes WHERE Nombre LIKE '%" . $buscar . "%' OR Apellido LIKE '%" . $buscar . "%' OR Email LIKE '%" . $buscar . "%'";
    $sql_query = mysqli_query($conn, $SQL_READ);

    // Comprobar si hay resultados de la consulta y mostrarlos en la tabla
    if ($sql_query && mysqli_num_rows($sql_query) > 0) {
        echo "<table border='2px'>";
        echo "<thead><th>Nombre</th><th>Apellido</th><th>Email</th></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($sql_query)) {
            echo "<tr>";
            echo "<td>" . $row['Nombre'] . "</td>";
            echo "<td>" . $row['Apellido'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "No se ha enviado ningún formulario.";
}
?>

</div>






</html>

