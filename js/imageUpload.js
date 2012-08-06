$(document).ready(function(){
	$("#btnFacebookGal").click(function(){
		openModalImgFb();
	});
	
	$('#btnCerrarModal').click(function(){
		closeModalImgFb();
	});
});


/*****************************************************************/
/******** IMAGENES DE FACEBOOK ***********************************/
/*****************************************************************/

function openModalImgFb(){
	showLoader();
	$('#modalFotosFB').data('jsp').getContentPane().empty();

	//llamada al api de fb para obtener imagenes
	FB.api('/me/albums',  function(resp) {
		var msg = "";

		for (var i=0, l=resp.data.length; i<l; i++){
			var album = resp.data[i];
			msg += '<div class="album">';
				msg += '<div class="fotoAlbum">';
						msg += '<img src="https://graph.facebook.com/'+album.id+'/picture?access_token='+FB.getAuthResponse().accessToken+'" style="cursor:pointer;" onclick="detalleAlbum(\''+album.id+'\')" />';
				msg += '</div>';
				msg += '<div class="tituloAlbum">'+album.name+'</div>';
			msg += '</div>';
		}
		
		$("#modalFotosFB").data('jsp').getContentPane().html(msg);
		$("#modalContenedor").show();
		$("#modalFotosFB").data('jsp').reinitialise();
		
		ocultarLoader();
	});
}

function closeModalImgFb(){
	$("#modalContenedor").fadeOut(300);
}

function detalleAlbum(id) {
	showLoader();
	$("#modalFotosFB").data('jsp').getContentPane().empty();

	//llamada al api de fb para obtener imagenes
	FB.api('/'+id+'/photos',  function(resp) {
		var msg = '';
		
		for (var i=0, l=resp.data.length; i<l; i++){
			var photo = resp.data[i];
			
			msg += '<div class="modalThumb">';
			msg += '<img src="'+photo["images"][6].source+'" style="cursor:pointer;" onclick="elegirImagen(\''+photo["images"][0].source+'\')" />';
			msg += '</div>';
		}
		
		$("#modalFotosFB").data('jsp').getContentPane().html(msg);
		$("#modalContenedor").show();
		$("#modalFotosFB").data('jsp').reinitialise();
		
		ocultarLoader();
	});
}

function elegirImagen(url) {
	//post para guardarla en la base (solo las de facebook)
	showLoader();
	$.post("subir_imagen_fb.php", { 'tipoFoto' : 'anuario', 'url' : url}, 
		function(data) {
			imageUploadResult(data);
		}
	);
}




/*****************************************************************/
/******** IMAGENES GENERAL ***********************************/
/*****************************************************************/

function eliminarImg(img, nro){
	if (doingLogin) {
		return;	
	}
	var imagen = $('#imgGal'+nro).attr('src');
	if(imagen != "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="){
		if(confirm('Queres eliminar esta imagen?')){
			doingLogin = true;
			$.post("eliminar_imagen.php", { 'tipoImg' : img, 'ruta' : imagen, 'nro' : nro}, 
				function(data) {
					doingLogin = false;
					if(data == "ok"){
						if(img == "anuario"){
							$('#fotoThumb'+nro).remove();
							
							$('#galFotosAnuario').append('<div class="fotoThumb" id="fotoThumb'+nro+'"><div class="quitar manito" style="display:none" onclick="eliminarImg(\'anuario\','+nro+')"><img src="images/cross.png" width="16" height="17" /></div><img id="imgGal'+nro+'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" /></div>')
							
							$('.uploadImagenes').show();
						}
					} else {
						alert('Ocurrio un problema intentando eliminar la imagen');
					}
				}
			);
		}
	}
}

function imageUploadResult(msg){
	doingLogin = false;
	
	var mensaje = msg.split('|');
	if(mensaje[0] == "error"){
		if(mensaje[1] == "redirect"){
			window.location.href= 'index.php';
		} else {
			alert(mensaje[1]);
		}
	} else {
		closeModalImgFb();
		if(mensaje[5] == "anuario"){
			$('.fotoThumb').each(function(index){
				var idImg = $(this).children('img').attr('id');
				if($(this).children('img').attr('src') == "data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="){
					//cargo img y muestro proporcionalmente
					$(this).children('img').unbind('load');
					$(this).children('img').hide();
					$(this).children('img').removeAttr('height').removeAttr('width').removeAttr('src').attr('src',mensaje[1]).load(function(){$(this).show(); resizeImage($(this),mensaje[3],mensaje[4],100,100,true);});
					
					$(this).children("div.quitar").show();
					return false;
				}
			});
			
			if(mensaje[2] >= 5){
				$('.uploadImagenes').hide();
			}
			
		} else if(mensaje[3] == "mapa") {
			//TODO
			
			
		}
	}
	ocultarLoader();
}

function enviarFormFoto(){
	if (doingLogin) {
		return;	
	}
	doingLogin = true;
	showLoader();
	$('#form1').attr('action','subir_imagen.php');
	$('#form1').submit();
}

