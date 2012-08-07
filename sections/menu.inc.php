<ul>
<?php if(isset($_SESSION["usuario"])){ 
		$pagina = basename($_SERVER['PHP_SELF']);?>
  <li class="home manito <?php if($pagina=="index.php" || $pagina=="home.php") echo "seleccionado"; ?>"><a href="index.php">Home</a></li>
  <li class="manito <?php if($pagina=="anuario.php") echo "seleccionado"; ?>"><a href="anuario.php">Mi Anuario</a></li>
  <li class="imagen"><img src="images/logo.SanMartino.png" alt="San Martino" width="173" height="158" /></li>
  <li class="mapa manito <?php if($pagina=="mapa_relaciones.php") echo "seleccionado"; ?>"><a href="mapa_relaciones.php">Mi Mapa<br/>de Relaciones</a></li>
  <li class="manito <?php if($pagina=="concurso.php") echo "seleccionado"; ?>"><a href="concurso.php">Concurso</a></li>
<?php } else { ?>
  <li class="home manito seleccionado"><a href="#" onclick="fbPermisos();">Home</a></li>
  <li class="manito"><a href="#" onclick="fbPermisos();">Mi Anuario</a></li>
  <li class="imagen"><img src="images/logo.SanMartino.png" alt="San Martino" width="173" height="158" /></li>
  <li class="mapa manito"><a href="#" onclick="fbPermisos();">Mi Mapa<br/>de Relaciones</a></li>
  <li class="manito"><a href="#" onclick="fbPermisos();">Concurso</a></li>
<?php } ?>
</ul>

