
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once("sections/jscss.inc.php"); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MTV || &Uacute;ltimo a&ntilde;o</title>
	<script type="text/javascript">
		function showRelation(id){
			hideRelations();
			$('#'+id).fadeIn(800);
		}
		function hideRelations(){
			$('.mapasRelaciones').hide();
		}
	</script>
</head>

<body style="background: url("../images/body.jpg") no-repeat center top #99E4C9;">
	<?php include_once("includes/script_facebook.php"); ?>
<div class="contentGeneral">
	<div class="contentHeader"><?php include_once("sections/header.inc.php"); ?></div><!--/contentHeader-->
    <div class="content">
    	<div class="menu"><?php include_once("sections/menu.inc.php"); ?> </div>
        <div class="contenidoGrande">
        	<div class="contentMapaPersonajes">
            	<div class="mapasRelaciones" id="mapaBenjamin"><img src="images/benjamin.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaCamila"><img src="images/camila.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaCeleste"><img src="images/celeste.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaDolores"><img src="images/dolores.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaFernanda"><img src="images/fernanda.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaJulieta"><img src="images/julieta.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaLeonidas"><img src="images/leonidas.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaMartin"><img src="images/martin.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaMiguel"><img src="images/miguel.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="mapasRelaciones" id="mapaNico"><img src="images/nico.mapa.png" width="961" height="430" onclick="hideRelations()" /></div>
            	<div class="boxBenjamin" onclick="showRelation('mapaBenjamin')">
                	<div class="protagonista manito">
                    	<div class="nombreMapa">BENJAM&Iacute;N</div>
                        <div class="imagenProtagonista"></div>
                    </div>
                </div>
                <div class="boxFernanda" onclick="showRelation('mapaFernanda')">
                    <div class="protagonista manito">
                        <div class="nombreMapa">FERNANDA</div>
                        <div class="imagenProtagonista"></div>
                    </div>
					<div class="boxFernandaHover"></div>    
                </div>

                <div class="boxCeleste" onclick="showRelation('mapaCeleste')">
                    <div class="protagonista manito">
                    	<div class="nombreMapa">CELESTE</div>
                        <div class="imagenProtagonista"></div>
                    </div>
                </div>
                <div class="boxMartin" onclick="showRelation('mapaMartin')">
                	<div class="protagonista manito">
                    	<div class="nombreMapa">MART&iacute;N</div>
                        <div class="imagenProtagonista"></div>
                    </div>
                </div>
                
                <div class="boxCamila" onclick="showRelation('mapaCamila')">
                	<div class="secundario manito">
                    	<div class="nombreMapa">CAMILA</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
                
                <div class="boxDolores" onclick="showRelation('mapaDolores')">
           	  		<div class="secundario manito">
                    	<div class="nombreMapa">DOLORES</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
                <div class="boxNico" onclick="showRelation('mapaNico')">
                	<div class="secundario manito">
                    	<div class="nombreMapa">NICO</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
                <div class="boxLeonidas" onclick="showRelation('mapaLeonidas')">
                	<div class="secundario manito">
                    	<div class="nombreMapa">LE&Oacute;NIDAS</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
                <div class="boxMiguel" onclick="showRelation('mapaMiguel')">
                	<div class="secundario manito">
                    	<div class="nombreMapa">MIGUEL ANGEL</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
                <div class="boxJulieta" onclick="showRelation('mapaJulieta')">
                	<div class="secundario manito">
                    	<div class="nombreMapa">JULIETA</div>
                        <div class="secundarioImagen"></div>
                   	</div>
                </div>
               <div class="btnCreaMapa"><a href="crea_mapa_relaciones.php"><img src="images/btn.crea.mapa.png" width="184" height="53" alt="Crea tu mapa" /></a></div>

            </div><!--/contentMapaPersonajes-->
            
        
        </div><!--/contenido-->
        
        <div class="contentConsigna"><?php include_once("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->

   		<div class="navRight"><?php include_once("sections/nav.right.inc.php"); ?> </div>
    </div><!--/content-->
 	
</div><!--/contentGeneral-->
<?php include_once("sections/footer.php"); ?>

<?php include_once("sections/modalFb.php"); ?>
    
</body>
</html>
