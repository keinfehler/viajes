
<body>
<?php
include('partial/header.php');
$id_reserva = $_GET['id_reserva']; 
$action = $_GET['action'];

if($action == "eliminar")
{
    
    $delete_query = "DELETE FROM reservas WHERE ID_reserva = $id_reserva";
    mysqli_query($conn, $delete_query);

  
    header("Location: admin_reservas.php");
}



if (isset($_POST["submit"])) {

    $id_reserva = $_POST['id_reserva'];
    $updated_inicio = $_POST['fecha_inicio'];
    $updated_fin = $_POST['fecha_fin'];
    $precio_total = 0;

    $updated_paquete = $_POST['select_paquete'];
    $updated_cliente = $_POST['select_cliente'];
    $updated_temporada = $_POST['select_temporada'];
    $updated_estado = $_POST['select_estado'];


    $sql4 = "SELECT * FROM paquetes WHERE ID_paquete = '$updated_paquete'";
    $result5 = mysqli_query($conn, $sql4);
    while ($row = mysqli_fetch_object($result5)){
    $precio_total = $precio_total + $row->Precio_total;
    
    }

    $update_query = "UPDATE reservas SET Fecha_inicio='$updated_inicio', Fecha_fin='$updated_fin', Precio_total='$precio_total', ID_paquete='$updated_paquete', ID_cliente='$updated_cliente', id_temporada='$updated_temporada' WHERE ID_reserva='$id_reserva'";
    mysqli_query($conn, $update_query);

    $update_oferta_query = "UPDATE ofertas SET Estado = '$updated_estado' WHERE ClienteID='$updated_cliente' AND PaqueteID='$updated_paquete'";
    mysqli_query($conn, $update_oferta_query);

    header("Location: admin_reservas.php");
}


$inicio = "";
$fin = "";
$paquete ="";
$cliente = "";
$temporada = "";
$estado = "";
$estados = array(
    "ofertado" => "ofertado",
    "aceptado" => "aceptado",
    "rechazado" => "rechazado",
    "pagado" => "pagado"
);


if (isset($_SESSION["user"])) {
    $query = "SELECT * FROM reservas LEFT JOIN ofertas ON 
    reservas.ID_Cliente = ofertas.ClienteID AND reservas.ID_Paquete = ofertas.PaqueteID WHERE ID_reserva = $id_reserva";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_object($result)){
        
        $inicio = $row->Fecha_inicio;
        $fin = $row->Fecha_fin;
        $paquete = $row->ID_paquete;
        $cliente = $row->ID_cliente;
        $temporada = $row->id_temporada;
        $estado = $row -> Estado;
    }
    }



?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Reserva: <?php echo $id_reserva ?></h1>
          <p></p>
          
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->

<form  class="formulario" action="admin_reserva.php" method="post">
        
<div class="form-floating">
          <label>Inicio:</label>
          <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio"  value="<?php echo $inicio; ?>"  />

</div>
<div class="form-floating">
          <label>Fin:</label>
          <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fin; ?>"  />
</div>
<div class="form-floating">
          <label>Paquete:</label>
          <select class="form-control" name="select_paquete" id="select_paquete">
          
            <?php
                $sql2= "SELECT paquetes.ID_paquete,paquetes.Nombre_paquete, paquetes.Descripcion, destinos.Nombre_Destino, paquetes.Precio_total, destinos.Descripcion as Tipo FROM paquetes, destinos WHERE paquetes.ID_Destino = destinos.ID_Destino";
                $result2 = mysqli_query($conn, $sql2);
                 while ($row = mysqli_fetch_object($result2)){
                    $isSelected = "";
                    if($row->ID_paquete === $paquete)
                    {
                        $isSelected = "selected";
                    }

                  echo '<option '.$isSelected.' value="'.$row->ID_paquete.'">'.$row->Nombre_paquete.' - '.$row->Descripcion.' - '.$row->Nombre_Destino. ' - '.$row->Tipo. ' - ' .$row->Precio_total.  ' EUROS </option>';
                 
                 }
              ?>

            </select>
</div>
<div class="form-floating">
    <label>Cliente:</label>
    
    <select class="form-control" name="select_cliente" id="select_cliente">
        <?php
        $sqlC = "SELECT ID_cliente, Nombre FROM clientes";
        $resultC = mysqli_query($conn, $sqlC);
        while ($row_cliente = mysqli_fetch_object($resultC)) {
            $isSelectedC = "";
            if ($row_cliente->ID_cliente === $cliente) {
                $isSelectedC = "selected";
            }
            echo '<option ' . $isSelectedC . ' value="' . $row_cliente->ID_cliente . '">' . $row_cliente->Nombre . '</option>';
        }
        ?>
        </select>
</div>
<div class="form-floating">
         <label>Temporada:</label>
         <br>
        <select class="form-control" name="select_temporada" id="select_temporada">
<?php
$sqlP = "SELECT ID_temporada, Nombre_Temporada FROM temporadas";
$resultP = mysqli_query($conn, $sqlP);
while ($row_temporada = mysqli_fetch_object($resultP)) {
    $isSelectedP = "";
    if ($row_temporada->ID_temporada == $temporada) {
        $isSelectedP = "selected";
    }
    echo '<option ' . $isSelectedP . ' value="' . $row_temporada->ID_temporada . '">' . $row_temporada->Nombre_Temporada . '</option>';
}
?>
</select>





</div>
<div class="form-floating">
<label>Estado:</label>
         
        <select class="form-control" name="select_estado" id="select_estado">
           
            <?php
            foreach ($estados as &$e) {
                $isSelectedP = "";
                if ($e == $estado) {
                    $isSelectedP = "selected";
                }
                echo '<option ' . $isSelectedP . ' value="' . $e . '">' . $e . '</option>';
            }
            ?>
        </select>
</div>


<br/>
<div class="form-floating">
        <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>"/>
       
        
        <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Guardar cambios</button>
</div>
    </form>
     </div>
      </div> <!-- /container -->
      <hr>
    </main>

<?php
    include('partial/footer.php');
?>
</body>
