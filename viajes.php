
<body>
<?php
include('partial/header.php');
?>
  <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Aerolineas</h1>
          <p>Estas compañías están a la vanguardia en seguridad, innovación y lanzamiento de nuevas aeronaves. Para tomar una decisión informada, también debemos considerar factores como accidentes recientes, auditorías regulatorias, edad de la flota y capacitación de las tripulaciones3. ¡Feliz vuelo! ✈️</p>

        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th class="tbl">Clave</th>
              <th class="tbl">Aerolínea</th>
              <th class="tbl">Aviones</th>
              <th class="tbl">Vuelos</th>
            </tr>
          </thead>
          <tbody>
          <tr>
            <td class="tb">AV</td>
            <td class="tb">Avianca</td>
            <td class="tb">Airbus, Boeing</td>
            <td class="tb">
              <a href="https://www.avianca.com/es/?poscode=EU" target="_blank">
                <img src="Fichas\AV.png" width="120" height="120"></a>
              </td>
            </tr>
            <tr>
            <td class="tb">WI</td>
            <td class="tb">Wingo</td>
            <td class="tb">Boeing</td>
            <td class="tb">
              <a href="https://www.wingo.com/" target="_blank">
                <img src="Fichas\wi.jpg" width="120" height="120"></a>
              </td>
            </tr>
             <tr>
            <td class="tb">LA</td>
            <td class="tb">Latam</td>
            <td class="tb">Airbus, Boeing</td>
            <td class="tb">
              <a href="https://www.latamairlines.com/es/es" target="_blank">
                <img src="Fichas\LA.jpg" width="120" height="120"></a>
              </td>
            </tr>
            <tr>
            <td class="tb">VI</td>
            <td class="tb">Viva Colombia</td>
            <td class="tb">Airbus</td>
            <td class="tb">
              <a href="https://www.vivaair.com/co/es" target="_blank">
                <img src="Fichas\vi.jpg" width="120" height="120"></a>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
        <hr>
      </div> <!-- /container -->
    </main>

<?php
    include('partial/footer.php');
?>
</body>
