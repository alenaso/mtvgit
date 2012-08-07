<?php 
	session_start();

	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Anuario.class.php");
	include_once("classes/MapaRelaciones.class.php");
	include_once("classes/ImagenAnuario.class.php");
	include_once("classes/ImagenMapaRelaciones.class.php");
	include_once("includes/lib/Paginador.class.php");
	
	make_conexion();
	
	$user = new Usuario();
	if(isset($_SESSION["usuario"])){
		$user = unserialize($_SESSION["usuario"]);
	}
	
	$anuario = new Anuario();
	$mapa = new MapaRelaciones();
	$listaAnuarios = $anuario->getAll(-1);
	$listaMapas = $mapa->getAll(-1);
	$cantMapas = count($listaMapas);
	$cantAnuarios = count($listaAnuarios);
	
	$paginaActual = 0;
	
	if(isset($_GET["pid"]) && is_numeric($_GET["pid"])) {
		$paginaActual = $_GET["pid"];
	}
	
	if(isset($_GET["aid"]) && $anuario->findById($_GET["aid"]) && $anuario->publicado!=0){
		$i=0;
		foreach($listaAnuarios as $an){
			if($an->idAnuario == $anuario->idAnuario){ break; }
				$i++;
		}
		$paginaActual=$i;
	} elseif(isset($_GET["mid"]) && $mapa->findById($_GET["mid"])){
		$i=$cantAnuarios - 1;
		foreach($listaMapas as $mp){
			if($mp->idMapaRelacion == $mapa->idMapaRelacion){ break; }
				$i++;
		}
		$paginaActual=$i;
	}

	$total = $cantMapas + $cantAnuarios;
	if($paginaActual >= $total){
		die(header("location: index,php"));
	}
	
	$urlParams="";
	$userView = new Usuario();
	$isAnuario = TRUE;
	
	if($paginaActual >= $cantAnuarios){
		//va mapa
		$isAnuario = FALSE;
		$mapa = $listaMapas[$paginaActual - $cantAnuarios + 1];
		$urlParams = "mid=".$mapa->idMapaRelacion;
		$userView->findById($mapa->usuarioId);
	} else {
		//va anuario
		$anuario = $listaAnuarios[$paginaActual];
		$userView->findById($anuario->usuarioId);
		$urlParams = "aid=".$anuario->idAnuario;
	}
	
	$paginador = new Paginador("index.php?pid=##", $paginaActual, 1, $total);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include("sections/jscss.inc.php"); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta property="fb:app_id" content="<?php echo $application_id; ?>" /> 
    <meta property="og:title" content="MTV || &Uacute;ltimo a&ntilde;o" /> 
    <meta property="og:image" content="<?php echo $URL_SITE."images/facebook-image.jpg"?>" /> 
    <meta property="og:url" content="<?php echo $URL_SITE."index.php?aid=".$_GET["aid"]."&mid=".$_GET["mid"]; ?>" />
     <meta property="og:description" content="MTV Último Año." /> 
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>
</head>

<body style="background: url("../images/body.jpg") no-repeat center top #99E4C9;">
	<?php include_once("includes/script_facebook.php"); ?>
    <div class="contentGeneral">
        <div class="contentHeader"><?php include("sections/header.inc.php"); ?></div><!--/contentHeader-->
        <div class="content">
            <div class="menu"><?php include("sections/menu.inc.php"); ?> </div>
            <div class="contenido">
            	<?php if($isAnuario) { //anuario ?>
                    <div class="contentAnuario">
                        <div class="boxSocial">
                            <div class="compartir">
                            <a href="#" onclick="fbCompartirAnuario(<?php echo $anuario->idAnuario?>, '<?php echo $userView->nombreCompleto?>');"><img src="images/btn.compartir.png" width="84" height="20" /></a>
                            </div>
                            <div class="fb-like like" data-send="false" data-layout="button_count" data-width="350" data-show-faces="false" data-href="<?php echo $URL_SITE."index.php?aid=".$anuario->idAnuario;?>"></div>
                        </div><!--/boxSocial-->
                        <div class="nombreCategoria">
                            <h4 class="azul"><?php echo $g_categorias_anuario[$anuario->categoriaId]?></h4>
                        </div><!--/nombreCategoria-->
                        <div class="btnCrear">
                        <?php if(isset($_SESSION["usuario"])){ ?>
                        	<a href="crea_anuario_inicial.php"><img src="images/btn.creatuanuario.png" width="183" height="52" alt="Crea tu Anuario"/></a></div>  
                        <?php } else { ?>
                        	<a href="#" onclick="fbPermisos();"><img src="images/btn.creatuanuario.png" width="183" height="52" alt="Crea tu Anuario"/></a></div>  
						<?php } ?>
                        
                        <div class="list_carousel">
                            <?php include_once("sections/anuario_template.php"); ?>
                                
                            <div class="clearfix"></div>
                            <?php 	$ant = $paginador->getAnterior();
                                    if($ant >=0) { ?>
                                        <a id="prev2" class="prev" href="index.php?pid=<?php echo $ant?>"><img src="images/arrow.prev.png" width="57" height="34" alt="anterior" /></a>
                            <?php 	} ?>
                            <?php 	$sig = $paginador->getSiguiente();
                                    if($sig >=0) { ?>
                                        <a id="next2" class="next" href="index.php?pid=<?php echo $sig?>"><img src="images/arrow.next.png" width="57" height="34" alt="siguiente" /></a>
                            <?php 	} ?>
                            <div class="contentPager">
                                <div id="pager2" class="pager">
                                    <?php echo $paginador->getLinksPaginasGaleria('index.php?'); ?>
                                </div>
                            </div>
                        </div>
                    
                    </div><!--/contentAnuario-->
                <?php } else { //mapa ?>
					<div class="contentMapaPerfil">
                        <div class="boxSocial">
                            <div class="compartir">
                             <a href="#" onclick="fbCompartirMapa(<?php echo $mapa->idMapaRelacion?>,'<?php echo $userView->nombreCompleto?>');"><img src="images/btn.compartir.png" width="84" height="20" /></a>
                            </div>
                            <div class="fb-like like" data-send="false" data-layout="button_count" data-width="350" data-show-faces="false" data-href="<?php echo $URL_SITE."index.php?mid=".$mapa->idMapaRelacion; ?>"></div>
                        </div><!--/boxSocial-->
                        
                        <?php include_once("sections/mapa_template.php"); ?>
                            
                        <div class="clearfix"></div>
                        <?php 	$ant = $paginador->getAnterior();
                                if($ant >=0) { ?>
                                    <a id="prev2" class="prev" href="index.php?pid=<?php echo $ant?>"><img src="images/arrow.prev.png" width="57" height="34" alt="anterior" /></a>
                        <?php 	} ?>
                        <?php 	$sig = $paginador->getSiguiente();
                                if($sig >=0) { ?>
                                    <a id="next2" class="next" href="index.php?pid=<?php echo $sig?>"><img src="images/arrow.next.png" width="57" height="34" alt="siguiente" /></a>
                        <?php 	} ?>
                        <div class="contentPager">
                            <div id="pager2" class="pager">
                               <?php echo $paginador->getLinksPaginasGaleria('index.php?'); ?>
                            </div>
                        </div>
                        
                    </div><!--/contentMapaRelaciones-->
				<?php } ?>
                <div class="contentConsigna"><?php include("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
            
            </div><!--/contenido-->
            <div class="navRight"><?php include("sections/nav.right.inc.php"); ?> </div>
        </div><!--/content-->
    </div><!--/contentGeneral-->
 	<?php include("sections/footer.php"); ?>

</body>
</html>