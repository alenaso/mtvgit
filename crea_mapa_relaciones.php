<?php 

	session_start();
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/MapaRelaciones.class.php");
	include_once("classes/Amigo.class.php");
	
	make_conexion();
	
	if(!isset($_SESSION["usuario"])){
		die(header("location: index.php"));
	}
	$user = unserialize($_SESSION["usuario"]);
	
	$imgPixel = "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
	
?>
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
        	<div class="contentMapaRelaciones">
            	<form id="formMapa" name="formMapa">
                    <h4 class="rosa">Crea tu Mapa de Relaciones:</h4>
                    <div class="contentMapa">
                        
                        <div class="boxYo">
                            <div class="nombreMapa"><?php echo $user->nombre?></div>
                            <div class="imagenYo"><img src="<?php echo $user->imagen?>" width="75" height="75" /></div>
                        </div>
                        
                        <div class="rel01">
                            <div class="amigo right">
                               <div class="nombreMapa" id="nombreAmigo1"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo1" /></div>
                            </div>
                            <p class="caracteristica right" id="caracAmigo1"></p>
                        </div> 
                        
                        <div class="rel02">
                            <div class="amigo left">
                               <div class="nombreMapa" id="nombreAmigo2"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo2" /></div>
                            </div>
                            <p class="caracteristica left" id="caracAmigo2"></p>
                        </div> 
    
                        <div class="rel03">
                            <div class="amigo right">
                               <div class="nombreMapa" id="nombreAmigo3"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo3" /></div>
                            </div>
                            <p class="caracteristica right" id="caracAmigo3"></p>
                        </div> 
                        <div class="rel04">
                            <div class="amigo left">
                               <div class="nombreMapa" id="nombreAmigo4"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo4" /></div>
                            </div>
                            <p class="caracteristica left" id="caracAmigo4"></p>
                        </div>
                         
                        <div class="rel05">
                            <div class="amigo right">
                               <div class="nombreMapa" id="nombreAmigo5"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo5" /></div>
                            </div>
                            <p class="caracteristica right" id="caracAmigo5"></p>
                        </div> 
    
                        <div class="rel06">
                        <div class="amigo left">
                               <div class="nombreMapa" id="nombreAmigo6"></div>
                               <div class="amigoImagen"><img src="<?php echo $imgPixel?>" width="57" height="57" id="imgAmigo6" /></div>
                            </div>
                            <p class="caracteristica left" id="caracAmigo6"></p>
                        </div> 
                    </div><!--/contentMapa-->
                    <h4 class="rosa">Crea tu Mapa de Relaciones:</h4>
                   <div class="contentSelectFotos">
                        <div class="selectAmigo">
                            <select id="caracteristica1" name="caracteristica1" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                        echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo1" name="tagsAmigo1" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo1" src="<?php echo $imgPixel?>" width="75" height="75" /></div>
                        </div>
                        <div class="selectAmigo">
                            <select id="caracteristica2" name="caracteristica2" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                            echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo2" name="tagsAmigo2" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo2" src="<?php echo $imgPixel?>" width="75" height="75" /></div>
                        </div>
                        <div class="selectAmigo">
                            <select id="caracteristica3" name="caracteristica3" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                        echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo3" name="tagsAmigo3" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo3" src="<?php echo $imgPixel?>" width="75" height="75" /></div>
                        </div>
                        <div class="selectAmigo">
                            <select id="caracteristica4" name="caracteristica4" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                        echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo4" name="tagsAmigo4" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo4" src="<?php echo $imgPixel?>" width="75" height="75" /></div>
                        </div>
                        <div class="selectAmigo">
                            <select id="caracteristica5" name="caracteristica5" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                        echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo5" name="tagsAmigo5" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo5" src="<?php echo $imgPixel?>" width="75" height="75"/></div>
                        </div>
                        <div class="selectAmigo">
                            <select id="caracteristica6" name="caracteristica6" class="selectCaracteristica" />
                            <?php 	for($i=0;$i<count($g_categorias_mapa);$i++) {
                                        echo "<option value=".$i.">".$g_categorias_mapa[$i]."</option>";
                                    } ?>
                            </select>
                      <div class="selectNombre"><input id="tagsAmigo6" name="tagsAmigo6" class="inputEtiqueta" /></div>
                            <div class="fotoAmigo"><img id="fotoAmigo6" src="<?php echo $imgPixel?>" width="75" height="75" /></div>
                        </div>
                   	</div><!--/contentSelectFotos-->
                   	<div class="bloquePostear">
                        <label class="label_check" for="checkPostear">
                        <input name="checkPostear" id="postearEnMuro" value="1" type="checkbox" checked="checked" class="check" /> Postear en el muro de <span class="rosa">mis amigos. </span></label>
					</div><!--/bloquePostear-->
                    <div class="btnPublicar manito"><a href="#" onclick="validarFormMapa()"><img src="images/btn.publicar.png" width="183" height="51" alt="publicar" /></a></div>
				</form>
                
            </div><!--/contentMapaRelaciones-->
            
            <div class="contentConsigna"><?php include_once("sections/consigna.inc.php"); ?> </div><!--/contentConsigna-->
        
        </div><!--/contenido-->
    <div class="navRight"><?php include_once("sections/nav.right.inc.php"); ?> </div>
    </div><!--/content-->
 	
    </div><!--/contentGeneral-->
    <?php include_once("sections/footer.php"); ?>
    
    <?php include_once("sections/modalFb.php"); ?>
    
    
    <script type="text/javascript">
	$(function() {
		<?php 
			$amigo = new Amigo();
			$listadoAmigos = $amigo->findAllByUserId($user->idUsuario);
			$amigosNombres = "";
			$amigosIds = "";
			for($i=0; $i<count($listadoAmigos); $i++){
				if($i == count($listadoAmigos) - 1){
					$amigosNombres .= '"'.utf8_encode($listadoAmigos[$i]->nombre).'"';
					$amigosIds .= '"'.$listadoAmigos[$i]->amigoFacebookID.'"';
				} else {
					$amigosNombres .= '"'.utf8_encode($listadoAmigos[$i]->nombre).'",';
					$amigosIds .= '"'.$listadoAmigos[$i]->amigoFacebookID.'",';
				}
			}
		?>

		var availableTags = [<?php echo $amigosNombres?>];
		var idsAmigos = [<?php echo $amigosIds?>];

		$( ".inputEtiqueta" ).autocomplete({
			source: availableTags,
			mustMatch: true,
			scroll: true,
			select: function(event, ui) {
				var idAmigo = $(this).attr('id').replace('tagsAmigo','');
				validarItemMapa(idAmigo, 0, '');
				if(ui.item != undefined) {
					for(var i=0; i<availableTags.length; i++){
						if(availableTags[i] == ui.item.value){
							validarItemMapa(idAmigo,idsAmigos[i], ui.item.value);
						}
					}
				}
			}
		});
		
		$( ".inputEtiqueta" ).change(function(){
			var id = $(this).attr('id').replace('tagsAmigo','');
			resetearItemMapa(id);
		});
		
		$( ".selectCaracteristica" ).change(function(){
			var id = $(this).attr('id').replace('caracteristica','');
			validarItemMapa(id, 0, '');
		});
	});
	</script>
    
    
</body>
</html>
