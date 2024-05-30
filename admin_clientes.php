
<body>
<?php
include('partial/header.php');

$nombre_cliente_buscar = '';

if (isset($_POST["submit"])) {
    $nombre_cliente_buscar = $_POST['nombre_cliente'];
}
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Clientes</h1>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
        <div class="container col-xxl-8 px-4 py-5">
  <h2 class="title">Buscar clientes</h2>
    <form action="admin_clientes.php" method="post">
      <div class="form-floating"> 
      <label>Nombre del cliente</label>
        <input class="form-control"  type="text" name="nombre_cliente"/>
      </div>
       
      <div class="form-floating">
          <button type="submit"  name="submit" class="btn btn-primary w-100 py-2">Buscar...</button>
        </div>
    </form>
  


  
  
    <section>
      <article>
        <table class="table">
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
              echo "<a class='btn btn-primary' href='admin_cliente.php?id_usuario=$row->ID_Cliente&action=editar'>Editar</a> "; 
              echo "</td>";

          
              echo "<td class='tb'>" ;
              echo "<a  class='btn btn-primary' href='admin_cliente.php?id_usuario=$row->ID_Cliente&action=eliminar'>Eliminar</a>"; 
              echo "</td></tr>";

           }
          ?>
        </table>
      </article>
    </section>

    </div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
