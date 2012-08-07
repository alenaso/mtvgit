<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once("sections/jscss.inc.php"); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>

</head>

<body style="background: url("../images/body.jpg") no-repeat center top #99E4C9;">
	<?php include_once("includes/script_facebook.php"); ?>
<div class="contentGeneral">
	<div class="contentHeader"><?php include_once("sections/header.inc.php"); ?></div><!--/contentHeader-->
    <div class="content">
    	<div class="menu"><?php include_once("sections/menu.inc.php"); ?> </div>
        <div class="contenido">
        	<div class="contentMapaPerfil">
            	<div class="boxSocialInferior">
                    <div class="compartir">
                    <img src="images/btn.compartir.png" width="84" height="20" />
                    </div>
                    <div class="fb-like like clear" data-send="false" data-layout="button_count" data-width="350" data-show-faces="false"></div>
                </div><!--/boxSocial-->
                <div class="contentPerfil">
                	<div class="usuarioFoto"><img src="<?php echo $userView->imagen?>" width="75" height="76" /></div>
                    <div class="usuarioNombre"><h5 class="azul"><?php echo $userView->nombreCompleto?></h5></div>
                    <div class="btnAnuarioPerfil"><img src="images/btn.perfil.anuario.png" alt="anuario" width="111" height="31" border="0" /></div>
                    <div class="btnMapaPerfil"><a href="mapa_relaciones.php?userid=<?php echo $userView->idUsuario?>"><img src="images/btn.perfil.mapas.png" alt="mapas" width="111" height="31" border="0" /></a></div>
                </div><!--/contentPerfil-->
                
                
                <div class="contentMapa">
                	
                    <div class="boxYo">
                    	<div class="nombreMapa">YO</div>
                    	<div class="imagenYo"></div>
                    </div>
                    
                    <div class="rel01">
                    	<div class="amigo right">
                           <div class="nombreMapa">AMIGO 01</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
                        <div class="caracteristica right">Creativo</div>
                    </div> 
                    
                    <div class="rel02">
                    	<div class="amigo left">
                           <div class="nombreMapa">AMIGO 02</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
                        <p class="caracteristica left">Irresponsable</p>
                    </div> 

                    <div class="rel03">
                    	<div class="amigo right">
                           <div class="nombreMapa">AMIGO 03</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
						<p class="caracteristica right">Lider</p>
                    </div> 
                    <div class="rel04">
                    	<div class="amigo left">
                           <div class="nombreMapa">AMIGO 04</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
                        <p class="caracteristica left">Hippie</p>
                    </div>
                     
                    <div class="rel05">
                    	<div class="amigo right">
                           <div class="nombreMapa">AMIGO 05</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
                        <p class="caracteristica right">Inteligente</p>
                    </div> 

                    <div class="rel06">
                    <div class="amigo left">
                           <div class="nombreMapa">AMIGO 06</div>
                           <div class="amigoImagen"><img src="upload/mapa/amigo.muestra.jpg" class="imagenWidth" /></div>
                        </div>
                        <p class="caracteristica left">M&iacute;stico</p>
                    </div> 
                    
                    
              </div><!--/contentMapa-->
            	
              <div class="btnCreaMapa manito"><a href="#"><img src="images/btn.crea.mapa.png" width="184" height="53" alt="Crea tu mapa" /></a></div>
                
            </div><!--/contentMapaRelaciones-->
            
            <div class="contentConsigna"><?php include_once("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
        
        </div><!--/contenido-->
    <div class="navRight"><?php include_once("sections/nav.right.inc.php"); ?> </div>
    </div><!--/content-->
 	
    </div><!--/contentGeneral-->
    <?php include_once("sections/footer.php"); ?>
    
    <?php include_once("sections/modalFb.php"); ?>
    
</body>
</html>
