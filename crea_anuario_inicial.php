<?php 

	session_start();
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Anuario.class.php");
	
	make_conexion();
	
	if(!isset($_SESSION["usuario"])){
		die(header("location: index.php"));
	}
	
	$user = unserialize($_SESSION["usuario"]);
	
	$anuario = new Anuario();
	$listaAnuarios = $anuario->findAllByUsuario($user->idUsuario);
	if(count($listaAnuarios) > 0){
		die(header("location: crea_tu_anuario.php"));
	}
	 
	session_write_close();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include("sections/jscss.inc.php"); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>
</head>

<body style="background: url("../images/body.jpg") no-repeat center top #99E4C9;">
<?php include_once("includes/script_facebook.php"); ?>
<div class="contentGeneral">
	<div class="contentHeader"><?php include("sections/header.inc.php"); ?></div><!--/contentHeader-->
    <div class="content">
    	<div class="menu"><?php include("sections/menu.inc.php"); ?> </div>
        <div class="contenido">
        	<div class="contentCreaAnuario">
            	<div class="boxSocial">
                    <div class="compartir">
                    <img src="images/btn.compartir.png" width="84" height="20" />
                    </div>
                    <div class="fb-like like" data-send="false" data-layout="button_count" data-width="350" data-show-faces="true"></div>
                </div><!--/boxSocial-->
                <div class="btnCrear"><a href="crea_tu_anuario.php"><img src="images/btn.creatuanuario.png" width="183" height="52" alt="Crea tu Anuario"/></a></div>  
<div class="hoja01">
                	<h4 class="rosa">Paso 1</h4>
                    <p class="azul">&#161;Bienvenido al Colegio San Martino!<br />
Como estamos en &#218;ltimo A&#241;o, &#161;te invitamos a que armes tu propio anuario!<br /><br />
Lo primero que tienes que hacer es elegir la categor&#237;a del anuario que vas a crear.<br />
&#191;Quieres compartir las fotos de tus mejores amigos? &#191;O tu familia? &#191;Tal vez recuerdos de un viaje inolvidable?<br />

<span class="rosa">&#161;Selecciona y comienza&#33;</span></p>
                    <h4 class="rosa">Paso 2</h4>
                    <p class="azul">Una vez que eliges la categor&#237;a, es el momento de elegir las fotos que integrar&#225;n tu anuario.<br />
Aqu&#237; puedes subirlas desde tu computadora o bien conectarte con Facebook y seleccionarlas de tus &#225;lbumes.
</p>
              </div>
              <div class="hoja02">
                <h4 class="rosa">Paso 3</h4>
                    <p class="azul">Ya subiste tus fotos: &#161;ahora etiqueta a tus amigos&#33;<br />
Te invitamos a que lo compartas con ellos publicando tu anuario en sus perfiles de Facebook y los invites a hacer los suyos.<br />
Despu&#233;s de esto, s&#243;lo tienes que tocar PUBLICAR y ver&#225;s c&#243;mo se crea tu anuario.<br />
<br />
Si quieres ver tus anuarios, vuelve a la Home y encu&#233;ntralos en tu perfil.
<br />
<br />
&#191;Est&#225;s listo para empezar&#63;<br />
&#161;Haz clic y crea tu anuario&#33;</p>
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