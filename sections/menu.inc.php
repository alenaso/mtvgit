<ul>
<?php if(isset($_SESSION["usuario"])){ ?>
  <li class="home manito"><a href="index.php">Home</a></li>
  <li class="manito"><a href="anuario.php">Mi Anuario</a></li>
  <li class="imagen"><img src="images/logo.SanMartino.png" alt="San Martino" width="173" height="158" /></li>
  <li class="mapa manito"><a href="mapa_relaciones.php">Mi Mapa<br/>de Relaciones</a></li>
  <li class="manito"><a href="concurso.php">Concurso</a></li>
<?php } else { ?>
  <li class="home manito"></li>
  <li class="manito"></li>
  <li class="imagen"><img src="images/logo.SanMartino.png" alt="San Martino" width="173" height="158" /></li>
  <li class="mapa manito"></li>
  <li class="manito"></li>
<?php } ?>
</ul>

