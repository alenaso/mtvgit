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
	
	//index : muestra random de anuario o bien el anuario que viene por id (desde un like o share de FB)
	//si usuario esta logueado, redirecciona a la home
		
	if(isset($_SESSION["usuario"])){
		$url = "home.php";
		$conector = "?";
		if(isset($_GET["userid"])){
			$url .= $conector."userid=".$_GET["userid"];
			$conector = "&";
		}
		if(isset($_GET["aid"])){
			$url .= $conector."aid=".$_GET["aid"];
		}
		die(header("location: ".$url));
	} 
	
	
	$user = new Usuario();
	$anuario = new Anuario();
	$listaAnuarios = $anuario->getAll(-1);
	if(!isset($_GET["aid"]) || !$anuario->findById($_GET["aid"]) || $anuario->publicado==0){
		$anuario = $listaAnuarios[0];
		$paginaActual = 0;
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
	
	if(isset($_GET["pid"]) && is_numeric($_GET["pid"])) {
		$paginaActual = $_GET["pid"];
		$anuario = $listaAnuarios[$_GET["pid"]];
	}
	
	$total = count($listaAnuarios);
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
    <meta property="og:url" content="<?php echo $URL_SITE."index.php?userid=".$_GET["userid"]."&aid=".$_GET["aid"]."&mid=".$_GET["mid"]; ?>" />
     <meta property="og:description" content="MTV Último Año." /> 
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>
</head>

<body>
	<?php include_once("includes/script_facebook.php"); ?>
    <div class="contentGeneral">
        <div class="contentHeader"><?php include("sections/header.inc.php"); ?></div><!--/contentHeader-->
        <div class="content">
            <div class="menu"><?php include("sections/menu.inc.php"); ?> </div>
            <div class="contenido">
                <div class="contentAnuario">
                    <div class="boxSocial">
                        <div class="compartir">
                        <a href="#" onclick="fbCompartirAnuario(<?php echo $anuario->idAnuario?>, '');"><img src="images/btn.compartir.png" width="84" height="20" /></a>
                        </div>
                        <div class="fb-like like" data-send="false" data-layout="button_count" data-width="350" data-show-faces="false" data-href="<?php echo $URL_SITE."/index.php?aid=".$anuario->idAnuario; ?>"></div>
                    </div><!--/boxSocial-->
                    <div class="nombreCategoria">
                        <h4 class="azul"><?php echo $g_categorias_anuario[$anuario->categoriaId]?></h4>
                    </div><!--/nombreCategoria-->
                    <div class="btnCrear"><a href="#" onclick="fbPermisos();"><img src="images/btn.creatuanuario.png" width="183" height="52" alt="Crea tu Anuario"/></a></div>  
                    
					<div class="list_carousel">
						<?php if($anuario != NULL) { include_once("sections/anuario_template.php"); } ?>
                        
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
                
                <div class="contentConsigna"><?php include("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
            
            </div><!--/contenido-->
            <div class="navRight"><?php include("sections/nav.right.inc.php"); ?> </div>
        </div><!--/content-->
    </div><!--/contentGeneral-->
 	<?php include("sections/footer.php"); ?>

</body>
</html>