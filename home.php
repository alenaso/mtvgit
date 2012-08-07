<?php 
	session_start();
	
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Anuario.class.php");
	include_once("classes/ImagenAnuario.class.php");
	include_once("includes/lib/Paginador.class.php");
	
	make_conexion(); 
	
	if(!isset($_SESSION["usuario"])){
		die(header("location: index.php"));	
	}
	
	$userView = new Usuario();
	$anuario = new Anuario();
	$user = unserialize($_SESSION["usuario"]);
	 
	if(isset($_GET["userid"]) && is_numeric($_GET["userid"])) {
		if(!$userView->findById($_GET["userid"])){
			die(header("location: index.php"));
		}
	} else {
		$userView = $user;
	}
	
	$listaAnuarios = $anuario->findAllByUsuario($userView->idUsuario);
	$cantPaginas = count($listaAnuarios);
	if($cantPaginas == 0){
		if($userView->idUsuario == $user->idUsuario){
			die(header("location: crea_anuario_inicial.php"));
		} else {
			die(header("location: home.php"));
		}
	} else {
		$anuario = $listaAnuarios[0];
	}
	
	//calculo pagina actual
	$paginaActual = 0;
	if(isset($_GET["aid"]) && is_numeric($_GET["aid"])) {
		if(!$anuario->findById($_GET["aid"])){
			die(header("location: index.php"));
		} else {
			$i=0;
			foreach($listaAnuarios as $an){
				if($an->idAnuario == $anuario->idAnuario){
					break;
				}
				$i++;
			}
			$paginaActual=$i;
		}
	}
	
	if(isset($_GET["pid"]) && is_numeric($_GET["pid"])) {
		$paginaActual = $_GET["pid"];
		$anuario = $listaAnuarios[$_GET["pid"]];
	}
	
	$total = count($listaAnuarios);
	if(isset($_GET["userid"])) {
		$paginador = new Paginador("home.php?userid=".$_GET["userid"]."&pid=##", $paginaActual, 1, $total);
	} else {
		$paginador = new Paginador("home.php?pid=##", $paginaActual, 1, $total);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include("sections/jscss.inc.php"); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="fb:app_id" content="<?php echo $application_id; ?>" /> 
    <meta property="og:title" content="MTV || &Uacute;ltimo a&ntilde;o" /> 
    <meta property="og:image" content="<?php echo $URL_SITE."images/facebook-image.jpg"?>" /> 
    <meta property="og:description" content="<?php echo "A ".$user->nombreCompleto." le gusta el anuario de ".$userView->nombreCompleto." en Último Año."?> " /> 
    <meta property="og:url" content="<?php echo $URL_SITE."index.php?&aid=".$_GET["aid"] ?>" />
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>
</head>

<body style="background: url("../images/body.jpg") no-repeat center top #99E4C9;">
<?php include_once("includes/script_facebook.php"); ?>
<div class="contentGeneral">
	<div class="contentHeader"><?php include("sections/header.inc.php"); ?></div><!--/contentHeader-->
    <div class="content">
    	<div class="menu"><?php include("sections/menu.inc.php"); ?> </div>
        <div class="contenido">
        	  <div class="contentAnuario">
            	<div class="<?php echo ($userView->idUsuario != $user->idUsuario) ? "boxSocialInferior" : "boxSocial" ?>">
                    <div class="compartir">
                    <a href="#" onclick="fbCompartirAnuario(<?php echo $anuario->idAnuario?>, '<?php echo $userView->nombreCompleto?>');"><img src="images/btn.compartir.png" width="84" height="20" /></a>
                    </div>
                    <div class="fb-like like" data-send="false" data-layout="button_count" data-width="350" data-show-faces="false" data-href="<?php echo $URL_SITE."/index.php?aid=".$anuario->idAnuario; ?>"></div>
                </div><!--/boxSocial-->
                <?php if ($userView->idUsuario != $user->idUsuario) { ?>
                <div class="contentPerfil">
                	<div class="usuarioFoto"><img src="<?php echo $userView->imagen?>" width="75" height="76" /></div>
                    <div class="usuarioNombre"><h5 class="azul"><?php echo $userView->nombreCompleto?></h5></div>
                    <div class="btnAnuarioPerfil"><a href="anuario.php?userid=<?php echo $userView->idUsuario?>"><img src="images/btn.perfil.anuario.png" alt="anuario" width="111" height="31" border="0" /></a></div>
                    <div class="btnMapaPerfil"><a href="mapa_relaciones.php?userid=<?php echo $userView->idUsuario?>"><img src="images/btn.perfil.mapas.png" alt="mapas" width="111" height="31" border="0" /></a></div>
                </div>
                <?php } ?>
                <div class="nombreCategoria">
                	<h4 class="azul"><?php echo $g_categorias_anuario[$anuario->categoriaId] ?></h4>
                </div><!--/nombreCategoria-->
                <div class="btnAgrega">
                	<a href="crea_anuario_inicial.php"><img src="images/btn.agrega.png" width="183" height="52" alt="Agrega una hoja a tu Anuario"/></a>
                </div>  
          
          		<div class="list_carousel">
          			<?php if($anuario != NULL) { include_once("sections/anuario_template.php"); } ?>
                    
                	<div class="clearfix"></div>
					<?php 	$ant = $paginador->getAnterior();
                            if($ant >=0) { ?>
                                <a id="prev2" class="prev" href="home.php?<?php echo isset($_GET["userid"]) ? "userid=".$_GET["userid"]."&" : "" ?>pid=<?php echo $ant?>"><img src="images/arrow.prev.png" width="57" height="34" alt="anterior" /></a>
                    <?php 	} ?>
                    <?php 	$sig = $paginador->getSiguiente();
                            if($sig >=0) { ?>
                                <a id="next2" class="next" href="home.php?<?php echo isset($_GET["userid"]) ? "userid=".$_GET["userid"]."&" : "" ?>pid=<?php echo $sig?>"><img src="images/arrow.next.png" width="57" height="34" alt="siguiente" /></a>
                    <?php 	} ?>
                    <div class="contentPager">
                        <div id="pager2" class="pager">
                            <?php echo (isset($_GET["userid"])) ? $paginador->getLinksPaginasGaleria('home.php?userid='.$_GET["userid"].'&') : $paginador->getLinksPaginasGaleria('home.php?'); ?>
                        </div>
                    </div>
                </div>
            
            </div><!--/contentAnuario-->
            <div class="contentConsigna"><?php include("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
        
        </div><!--/contenido-->
    <div class="navRight"><?php include("sections/nav.right.inc.php"); ?> </div>
    </div><!--/content-->
    </div><!--/contentGeneral-->
 	<?php include("sections/footer.php"); ?>
    
</body>
</html>