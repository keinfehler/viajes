
<body>
<?php
include('partial/header.php');
require_once "database.php";
	
  if (isset($_POST["reserva"])) {
    $finicio = $_POST["fecha_inicio"];
    $ffin = $_POST["fecha_fin"];
    $precio_total = 0;//$_POST["Contraseña"];
    $id_paquete = $_POST["select_paquete"];
    $id_cliente = 10;//$_SESSION["idcliente"];
    $id_empleado = 30;
       
    $sql4 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ('$finicio', '$ffin', '$precio_total', '$id_paquete', '$id_cliente','$id_empleado')";
    //$sql3 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ( ?, ?, ?, ? ,? ,? )";
    $stmt3 = mysqli_stmt_init($conn);
    $prepareStmt3 = mysqli_stmt_prepare($stmt3,$sql4);
    if ($prepareStmt3) {
    
        mysqli_stmt_execute($stmt3);
        echo "<div class='alert alert-success'>Reserva exitoso.</div>";
    }else{
        die("Algo ha fallado!");
    }
    
  }
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Paquetes de viaje</h1>
          <p>Informacion de los paquetes disponibles</p>

        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <?php
                 $sql = "SELECT paquetes.Nombre_paquete, paquetes.Descripcion, destinos.Nombre_Destino, paquetes.Precio_total, destinos.Descripcion as Tipo FROM paquetes, destinos WHERE paquetes.ID_Destino = destinos.ID_Destino";
                 $result = mysqli_query($conn, $sql);
           while ($row = mysqli_fetch_object($result)){

            
              echo 
              "
                  <div class='col'>
                  <div class='card mb- rounded-3 shadow-sm'>
                    <div class='card-header py-3'>
                      <h4 class='my-0 fw-normal'>$row->Nombre_paquete</h4>
                    </div>
                    <div class='card-body'>
                      <h1 class='card-title pricing-card-title'>$row->Precio_total €<small class='text-body-secondary fw-light'></small></h1>
                      <ul class='list-unstyled mt-3 mb-4'>
                        <li>$row->Descripcion</li>
                        <li>$row->Nombre_Destino</li>
                        <li>$row->Tipo</li>
                        
                      </ul>
                      
                    </div>
                  </div>
                </div>
              
              ";
              

           }
          ?>

<a type="button" href="reserva.php" class="w-100 btn btn-lg btn-outline-primary">Reservar</a>

        </div>
        </div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
