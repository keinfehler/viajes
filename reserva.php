
<body>
<?php
include('partial/header.php');
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

if (isset($_POST["reserva"]) & isset($_POST["select_paquete"]) & isset($_POST["select_comercial"]) ) {
  
  $id_paquete = $_POST["select_paquete"];  

  $id_comercial = $_POST["select_comercial"];

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
     $id_temporada = $_POST["select_temporada"]; // Suponiendo que el usuario selecciona la temporada en un formulario
      
      // Mapeo de niveles de temporada a valores numéricos
      $temporada_values = array(
          "alta" => 1,
          "media" => 2,
          "baja" => 3
      );

      // Verificar si la temporada seleccionada está en el mapeo, de lo contrario, establecer un valor predeterminado
     
        
      $sql4 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado, ID_temporada) VALUES ('$finicio', '$ffin', '$precio_total', '$id_paquete', '$id_cliente','$id_empleado', '$id_temporada')";

      $fecha_oferta = date("Y/m/d");
      $sqlOferta = "INSERT INTO ofertas (ComercialID, ClienteID, PaqueteID, Estado, FechaOferta) VALUES ('$id_comercial', '$id_cliente', '$id_paquete', 'ofertado', '$fecha_oferta')";

      //$sql3 = "INSERT INTO reservas (Fecha_Inicio, Fecha_fin, Precio_total, ID_paquete, ID_cliente, ID_Empleado) VALUES ( ?, ?, ?, ? ,? ,? )";
      $stmt3 = mysqli_stmt_init($conn);
      $prepareStmt3 = mysqli_stmt_prepare($stmt3,$sql4);
      if ($prepareStmt3) {
          mysqli_stmt_execute($stmt3);
          echo "<div class='alert alert-success'>Reserva exitosa.</div>";
      }else{
          die("Algo ha fallado!");
      }

      $stmtOferta = mysqli_stmt_init($conn);
      $prepareStmtOferta = mysqli_stmt_prepare($stmtOferta,$sqlOferta);
      if ($prepareStmtOferta) {
        mysqli_stmt_execute($stmtOferta);
        echo "<div class='alert alert-success'>Oferta exitosa.</div>";
      }else{
          die("Algo ha fallado al instertar la oferta!");
      }

  }else 
  {
    echo "<div class='alert alert-success'>Por favor selecciona un paquete</div>";

  }

  
}
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Reservar</h1>
          <p></p>
          
          <div class="formulario">
         
         <form action="reserva.php"  method="post">
            <div class="form-floating">
              <label>Inicio:</label>
              <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio"  required/>
            </div>
            <div class="form-floating">
                <label>Fin:</label>
                <input class="form-control" type="date" name="fecha_fin" id="fecha_fin"  required/>
            </div>
            <div class="form-floating">
                <label>Paquete:</label>
                <select class="form-control" name="select_paquete" id="select_paquete">
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
            <div class="form-floating">
              <label>Temporada:</label>
              <select class="form-control" name="select_temporada" id="select_temporada">
                <option value="0">Selecciona una temporada...</option>
                 <?php
                 $sql_temporadas = "SELECT id_temporada, Nombre_Temporada FROM temporadas";
                 $result_temporadas = mysqli_query($conn, $sql_temporadas);
                 while ($row_temporada = mysqli_fetch_assoc($result_temporadas)) {
                     $id_temporada = $row_temporada['id_temporada'];
                     $nombre_temporada = $row_temporada['Nombre_Temporada'];
                     echo '<option value="' . $id_temporada . '">' . $nombre_temporada . '</option>';
                 }
                 ?>
             </select>
            </div>

            <div class="form-floating">
              <label>Comercial:</label>
              <select class="form-control" name="select_comercial" id="select_comercial">
              <option value="0">Selecciona un comercial...</option> 
                <?php
                $sql_comerciales = "SELECT ComercialID, Nombre_comercial from comerciales";
                $result_comerciales = mysqli_query($conn,$sql_comerciales);
                while ($row_comercial = mysqli_fetch_assoc($result_comerciales)) {
                  $id_comercial = $row_comercial['ComercialID'];
                  $nombre_comercial = $row_comercial['Nombre_comercial'];
                  echo '<option value="' . $id_comercial . '">' . $nombre_comercial . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-floating">
            
              <button class="btn btn-primary w-100 py-2" type="submit" name="reserva">Añadir</button>
            </div>
        </form>
  </div>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
        
        <table  class="table">
          <tr>
            
            
            <th class="tbl">Inicio</th>
            <th class="tbl">Fin</th>
            <th class="tbl">Precio</th>
            <th class="tbl">Estado</th>
            <th class="tbl"></th>
      
          </tr>

          <?php
                 $currendUser = $_SESSION["idcliente"];
                 $sql6 = "SELECT * FROM reservas LEFT JOIN ofertas ON reservas.ID_Cliente = ofertas.ClienteID AND reservas.ID_Paquete = ofertas.PaqueteID WHERE ID_cliente = '$currendUser'";
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
              echo $row->Estado;
              echo "</td>";
              
              echo "<td class='tb'>" ;
              echo "<form method='post' action='reserva.php'> <input type='hidden' name='id_reserva' value='$row->ID_reserva' />  <button class='btn btn-primary w-100 py-2' type='submit' name='anular'>Anular</button></form>";
              echo "</td></tr>";

           }
          ?>
        </table>
        </div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
