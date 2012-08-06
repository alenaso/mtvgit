<div class="contentMapa">
    <div class="boxYo">
        <div class="nombreMapa"><?php echo $userView->nombreCompleto?></div>
        <div class="imagenYo"><img src="<?php echo $userView->imagen?>" width="75" height="75" /></div>
    </div>
    <div class="rel01">
        <div class="amigo right">
           <div class="nombreMapa"><?php echo isset($imagenes[0]) ? $imagenes[0]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[0]) ? $RUTA_IMG_MAPA . $imagenes[0]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <div class="caracteristica right"><?php echo isset($imagenes[0]) ? $g_categorias_mapa[$imagenes[0]->caracteristicaId] : "" ?></div>
    </div> 
    
    <div class="rel02">
        <div class="amigo left">
           <div class="nombreMapa"><?php echo isset($imagenes[1]) ? $imagenes[1]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[1]) ? $RUTA_IMG_MAPA . $imagenes[1]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <p class="caracteristica left"><?php echo isset($imagenes[1]) ? $g_categorias_mapa[$imagenes[1]->caracteristicaId] : "" ?></p>
    </div> 

    <div class="rel03">
        <div class="amigo right">
           <div class="nombreMapa"><?php echo isset($imagenes[2]) ? $imagenes[2]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[2]) ? $RUTA_IMG_MAPA . $imagenes[2]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <p class="caracteristica right"><?php echo isset($imagenes[2]) ? $g_categorias_mapa[$imagenes[2]->caracteristicaId] : "" ?></p>
    </div> 
    <div class="rel04">
        <div class="amigo left">
           <div class="nombreMapa"><?php echo isset($imagenes[3]) ? $imagenes[3]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[3]) ? $RUTA_IMG_MAPA . $imagenes[3]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <p class="caracteristica left"><?php echo isset($imagenes[3]) ? $g_categorias_mapa[$imagenes[3]->caracteristicaId] : "" ?></p>
    </div>
     
    <div class="rel05">
        <div class="amigo right">
           <div class="nombreMapa"><?php echo isset($imagenes[4]) ? $imagenes[4]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[4]) ? $RUTA_IMG_MAPA . $imagenes[4]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <p class="caracteristica right"><?php echo isset($imagenes[4]) ? $g_categorias_mapa[$imagenes[4]->caracteristicaId] : "" ?></p>
    </div> 

    <div class="rel06">
    <div class="amigo left">
           <div class="nombreMapa"><?php echo isset($imagenes[5]) ? $imagenes[5]->nombreAmigo : ""?></div>
           <div class="amigoImagen"><img src="<?php  echo isset($imagenes[5]) ? $RUTA_IMG_MAPA . $imagenes[5]->ruta : $imgPixel?>" class="imagenWidth" /></div>
        </div>
        <p class="caracteristica left"><?php echo isset($imagenes[5]) ? $g_categorias_mapa[$imagenes[5]->caracteristicaId] : "" ?></p>

    </div> 
</div><!--/contentMapa-->
<div class="btnCreaMapa manito"><a href="crea_mapa_relaciones.php"><img src="images/btn.crea.mapa.png" width="184" height="53" alt="Crea tu mapa" /></a></div>