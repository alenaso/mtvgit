<?php
	if($anuario->idAnuario != ""){
		$imagenAnuario = new ImagenAnuario();
		$listadoImagenes = $imagenAnuario->findAllByAnuarioId($anuario->idAnuario);
		$anuarioTemplate = count($listadoImagenes);
?>

        <ul id="foo2">
            <li>
                <div class="contentTemplate">
                    <div class="template0<?php echo $anuario->categoriaId?>"></div>
                    <?php 
                        $nro = 0;
                        $randStr = rand(0,999999999);
                        foreach($listadoImagenes as $i => $imagen) { 
                            $nro++; ?>
                            <div class="<?php echo "template0".$anuarioTemplate."Foto0".$nro?>"> 
                                <img id="imgAnuarioResize<?php echo $nro?>" src="<?php echo $RUTA_IMG_ANUARIO . $imagen->ruta . "?asd=".$randStr?>" class="imagenWidth" />
                            </div>
                    <?php } ?>
                    
                    <script type="text/javascript">
                        $(function() {
                            if ( $.browser.msie ) {
                                <?php if($anuarioTemplate == 1) {?> 
                                    $('#imgAnuarioResize1').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,385,289,true)});
                                <?php } elseif($anuarioTemplate == 2) { ?>
                                    $('#imgAnuarioResize1').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,240,180,true)});
                                    $('#imgAnuarioResize2').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,240,180,true)});
                                <?php } elseif($anuarioTemplate == 3) { ?>
                                    $('#imgAnuarioResize1').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,240,180,true)});
                                    $('#imgAnuarioResize2').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,160,120,true)});
                                <?php } elseif($anuarioTemplate == 4) { ?>
                                    $('#imgAnuarioResize1').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,160,120,true)});
                                    $('#imgAnuarioResize2').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,160,120,true)});
                                    $('#imgAnuarioResize4').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[3]->width.",".$listadoImagenes[3]->height?>,160,120,true)});
                                <?php } elseif($anuarioTemplate == 5) { ?>
                                    $('#imgAnuarioResize1').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,160,120,true)});
                                    $('#imgAnuarioResize2').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,120,90,true)});
                                    $('#imgAnuarioResize4').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[3]->width.",".$listadoImagenes[3]->height?>,120,90,true)});
                                    $('#imgAnuarioResize5').removeAttr('height').removeAttr('width').load(function(){resizeImage($(this),<?php echo $listadoImagenes[4]->width.",".$listadoImagenes[4]->height?>,120,90,true)});
                                <?php } ?>
                            } else {
                                <?php if($anuarioTemplate == 1) {?> 
                                    $('#imgAnuarioResize1').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,385,289,true)});
                                <?php } elseif($anuarioTemplate == 2) { ?>
                                    $('#imgAnuarioResize1').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,240,180,true)});
                                    $('#imgAnuarioResize2').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,240,180,true)});
                                <?php } elseif($anuarioTemplate == 3) { ?>
                                    $('#imgAnuarioResize1').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,240,180,true)});
                                    $('#imgAnuarioResize2').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,160,120,true)});
                                <?php } elseif($anuarioTemplate == 4) { ?>
                                    $('#imgAnuarioResize1').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,160,120,true)});
                                    $('#imgAnuarioResize2').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,160,120,true)});
                                    $('#imgAnuarioResize4').load(function(){resizeImage($(this),<?php echo $listadoImagenes[3]->width.",".$listadoImagenes[3]->height?>,160,120,true)});
                                <?php } elseif($anuarioTemplate == 5) { ?>
                                    $('#imgAnuarioResize1').load(function(){resizeImage($(this),<?php echo $listadoImagenes[0]->width.",".$listadoImagenes[0]->height?>,160,120,true)});
                                    $('#imgAnuarioResize2').load(function(){resizeImage($(this),<?php echo $listadoImagenes[1]->width.",".$listadoImagenes[1]->height?>,160,120,true)});
                                    $('#imgAnuarioResize3').load(function(){resizeImage($(this),<?php echo $listadoImagenes[2]->width.",".$listadoImagenes[2]->height?>,120,90,true)});
                                    $('#imgAnuarioResize4').load(function(){resizeImage($(this),<?php echo $listadoImagenes[3]->width.",".$listadoImagenes[3]->height?>,120,90,true)});
                                    $('#imgAnuarioResize5').load(function(){resizeImage($(this),<?php echo $listadoImagenes[4]->width.",".$listadoImagenes[4]->height?>,120,90,true)});
                                <?php } ?>
                            }
                        });
                    </script>
                </div>
            </li>
        </ul>
<?php } ?>