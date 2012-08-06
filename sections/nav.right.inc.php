<?php 
	include_once("classes/Amigo.class.php");
?>
<div class="bannerNav">
<!-- AD CALL 300x250 START -->
<script type="text/javascript"> 
	com.mtvi.ads.AdManager.setKeyValues("site_region=" + site_region);
	com.mtvi.ads.AdManager.placeAd({
		size:"300x250",
		contentType:"adj",
		log: "null",
		demo: "null",
		event:"null",
		keyword:"null",
		vid:"null",
		vid_type:"null",
		region:	countryCode.toUpperCase()
	});
</script>
<!-- AD CALL 300x250 END -->
</div>

<?php if (!isset($_SESSION["usuario"]) ) { ?>
		<div class="btnRegistrate manito" onclick="fbPermisos();"></div>
<?php } else { ?>    
        <div class="contentFreinds">
            <h4 class="friendsTitle">Amigos</h4>
            <div class="btnsFriends"> 
                <?php /*<a href="#" onclick="fbSendRequest()"><img src="images/btn.invitar.png" width="107" height="26" alt="INVITAR AMIGO" /></a> */ ?>
                <a href="#" onclick="fbShareApp()"><img src="images/btn.compartirapp.png" width="107" height="27" alt="COMPARTIR APP" /></a>
            </div>
            <div class="friendsProfile">
                <img src="<?php echo $user->imagen?>" width="50" height="50" />
                <div class="profileNombre">
                    <h5><?php echo $user->nombreCompleto?></h5>
                </div><!--/profileNombre-->
            </div><!--/friendsProfile-->
            <div class="bloqueThumbs scroll-pane">
			<?php
                    $amigoHandler = new Amigo();
                    $amigos = $amigoHandler->findAllByUserId($user->idUsuario);
                    $usuarioAmigo = new Usuario();
                    foreach($amigos as $amigo) {
                        if($usuarioAmigo->findByFbId($amigo->amigoFacebookID)) { ?>
                            <div class="thumbFriend"><a href="anuario.php?userid=<?php echo $usuarioAmigo->idUsuario?>"><img src="<?php echo $usuarioAmigo->imagen;?>" alt="" class="imagenWidth" /></a></div>
            <?php		}
                    } ?>
            </div>
            <div class="cerrarSesion manito"><a href="logout.php"><img src="images/btn.cerrarsesion.png" width="155" height="46" alt="cerrar sesion" /></a></div>
        </div><!--/contentFreinds-->
        <script type="text/javascript">
			$(function() {
				$('.scroll-pane').jScrollPane();
			});
		</script>
<?php } ?>

	
