<?php 

	session_start();
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Anuario.class.php");
	include_once("classes/Amigo.class.php");
	include_once("classes/ImagenAnuario.class.php");
	
	make_conexion();
	
	if(!isset($_SESSION["usuario"])){
		die(header("location: index.php"));
	}
	$user = unserialize($_SESSION["usuario"]);
	
	//creo anuario vacio o tomo por defecto el ultimo creado que esta vacio
	$anuario = new Anuario();
	$anuario->createNew($user->idUsuario);
	//obtengo las imagenes ya guardadas del anuario
	$imagenesAnuario = new ImagenAnuario();
	$listImg = $imagenesAnuario->findAllByAnuarioId($anuario->idAnuario);
	
	$imgPixel = "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once("sections/jscss.inc.php"); ?>
    <script type="text/javascript" src="js/imageUpload.js"></script>
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
        	<div class="contentCreaAnuarioCarga">
            	
                <form name="form1" id="form1" action="saveAnuario.php" method="post" target="iframePost" enctype="multipart/form-data">
                	<input type="hidden" name="tipoFoto" id="tipoFoto" value="anuario" />
                    <div class="selectCategoria"><h4><strong>Seleccion&aacute; la Categor&iacute;a</strong></h4>
                    
                    <select id="categoria" name="categoria" class="styled-select">
                    	<?php 
							for($i=0; $i<count($g_categorias_anuario); $i++){
								if($anuario->categoriaId == $i){
									echo '<option value="'.$i.'" selected="selected">'.$g_categorias_anuario["$i"].'</option>';
								} else {
									echo '<option value="'.$i.'">'.$g_categorias_anuario["$i"].'</option>';
								}
							} 
						?>
                    </select>
                    </div>
                    <div class="selectFoto" id="galFotosAnuario">
                        <h4><strong>Seleccion&aacute; tus Fotos</strong></h4>
                        <?php 
							$cantImgs = count($listImg);
							$randStr = rand(0,999999999);
							for($i=1; $i<=5; $i++){
								if($i<=$cantImgs){ ?>
									<div class="fotoThumb" id="fotoThumb<?php echo $i?>">
                                    	<div class="quitar manito" onclick="eliminarImg('anuario',<?php echo $i?>)"><img src="images/cross.png" width="16" height="17" /></div>
                     			 		<img id="imgGal<?php echo $i?>" src="<?php echo $RUTA_IMG_ANUARIO . $listImg[$i-1]->ruta . "?asd=".$randStr?>" class="imagenWidth" />
									</div>
						<?php 	} else { ?>
									<div class="fotoThumb" id="fotoThumb<?php echo $i?>">
                                    	<div class="quitar manito" style="display:none" onclick="eliminarImg('anuario',<?php echo $i?>)"><img src="images/cross.png" width="16" height="17" /></div>
										<img id="imgGal<?php echo $i?>" src="<?php echo $imgPixel?>" />
									</div>
						<?php	}
							} ?>
                    </div><!--/selectFoto-->
                    
                    <div class="uploadImagenes" <?php echo ($cantImgs >= 5) ? "style='display:none'" : ""?> >
                            <div class="btnExaminar">
                                <input type="file" name="imgAnuario" id="imgAnuario" onchange="enviarFormFoto()" class="inputExaminar manito"  />
                            </div>
                            
                            <div class="btnFacebook manito" id="btnFacebookGal"><img src="images/btn.facebook.png" width="183" height="51" alt="examinar" /></div>
                    </div>
                    <div class="etiqueta">
                    <label for="tags">Etiqueta a tus Amigos: </label>
                    	<input id="tags" name="tags" class="inputEtiqueta" />
                        <div class="btnPublicar manito"><a href="#" onclick="validarFormAnuario()"><img src="images/btn.publicar.png" width="183" height="51" alt="publicar" /></a></div>
                    </div>
                     <div class="bloquePostear">
                     	<label class="label_check" for="checkPostear">
              			<input name="checkPostear" id="postearEnMuro" value="1" type="checkbox" checked="checked" class="check" /> Postear en el muro de <span class="rosa">mis amigos. </span></label>
              		</div>
                </form>
                <iframe name="iframePost" id="iframePost" style="display:none"></iframe>
                
            </div><!--/contentAnuario-->
            
            <div class="contentConsigna"><?php include_once("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
        
        </div><!--/contenido-->
    <div class="navRight"><?php include_once("sections/nav.right.inc.php"); ?> </div>
    </div><!--/content-->
 	
    </div><!--/contentGeneral-->
    <?php include_once("sections/footer.php"); ?>
    
    <?php include_once("sections/modalFb.php"); ?>
    
</body>
</html>

<script type="text/javascript">
	$(function() {
		var availableTags = [
		<?php 
			$amigo = new Amigo();
			$listadoAmigos = $amigo->findAllByUserId($user->idUsuario);
			for($i=0; $i<count($listadoAmigos); $i++){
				if($i == count($listadoAmigos) - 1){
					echo '"'.$listadoAmigos[$i]->nombre.'"';
				} else {
					echo '"'.$listadoAmigos[$i]->nombre.'",';
				}
			}
			
		?>
		];
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#tags" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
			
		$('.scroll-pane').jScrollPane();
		
		<?php
			for($i=1; $i<=5; $i++){
				if($i<=$cantImgs){ ?>
				if ( $.browser.msie ) {
					$('#imgGal<?php echo $i?>').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listImg[$i-1]->width.",".$listImg[$i-1]->height ?>,100,100,true)});
				} else {
					$('#imgGal<?php echo $i?>').load(function(){resizeImage($(this),<?php echo $listImg[$i-1]->width.",".$listImg[$i-1]->height ?>,100,100,true)});
				}
		<?php	}
			} ?>
	});
	
	
	
	</script>