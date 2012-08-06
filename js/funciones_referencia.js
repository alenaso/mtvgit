
//hack para trim en ie7/8
if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}


function toolTipOver(id) {
	$("#"+id).fadeIn(200);
}
function toolTipOverOut(id) {
	$("#"+id).fadeOut(200);
}

$(document).ready(function(){
	$('.foto').mouseenter(function(){
		$(this).find(".tooltip").fadeIn(200);
	}).mouseleave(function(){
		$(this).find(".tooltip").fadeOut(200);
	});
	
	$("#uploadGaleriaFB").click(function(){
		openModalImgFb("galeria");
	});
	
	$("#uploadGaleriaDMFB").click(function(){
		openModalImgFb("galeriaDM");
	});
	
	$("#uploadGaleriaVideo").click(function(){
		openModalUploadVideo();
	});
	
	$("#uploadLogoFB").click(function(){
		openModalImgFb("logo");
	});
	
	$('#albumFotosDiv .cerrar').click(function(){
		closeModalImgFb();
	});
	
	$('.default-value').each(function() {
		$(this).focus(function() {
			if(this.value == this.title) {
				this.value = '';
			}
		});
		$(this).blur(function() {
			if(this.value == '') {
				this.value = this.title;
			}
		});
	});
	
	$('#back').click(function(){
		//history.go(-1);
		$.post("navegacion.php", function(data) {
			if(data!=""){
				window.location.href = data;
			}
		});
	});
	
	$('#sortable').delegate('li .extractImg .eliminar', 'click', function(e){
		//alert($(this).closest('.ui-state-default').index());
		var nro = parseInt($(this).closest('.ui-state-default').index()) + parseInt($('#currentPosition').val());
		eliminarImg('galeria', nro);
	});

	
});


/********heart-minds modify***************************************/
function modificarDatos() {
	$(".datos").toggle();
}

function updateProfile(){
	var isValid = true;
	var msg = "";
	if($('#fullName').val().trim() == "" || $('#birthday').val().trim() == "" || $('#state').val().trim() == ""){
		isValid = false;
		msg += 'All fields are mandatory.';
	}
	
	try{
        $.datepicker.parseDate('yy-mm-dd', $('#birthday').val().trim(), null);
    }
    catch(error){
        isValid = false;
		msg += 'Birthday format must be yyyy-mm-dd. ';
    }
	
	if(isValid){
		$.post("updateProfile.php", { nombre_completo : $('#fullName').val().trim(), nacimiento : $('#birthday').val().trim(), location : $('#state').val().trim()}, 
			function(data) {
				if (data == "ok") {
					$('#fullNameInfo').html($('#fullName').val());
					$('#birthdayInfo').html($('#birthday').val());
					$('#stateInfo').html($('#state').val());
					alert('Your data have been modified successfully');
					$(".datos").toggle();
				} else {
					var msg = data.split("|");
					alert(msg[1]);
				}
		});
	} else {
		alert(msg);
	}
}


/*****************************************************************/
/******** FACEBOOK FUNCTS ****************************************/
/*****************************************************************/
function fbPermisos() {
	FB.login(function(response) {
		if (response.authResponse) {
			FB.api('/me', function(info) {
				login(response, info);
			});	   
		} else {
			//user cancelled login or did not grant authorization
		}
	}, {scope:'email,user_birthday,publish_stream,user_photos,user_interests,user_location'});

}

function fbCompartirSuenoUser(img, extracto) {
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: $('#url_site').val() + 'uploadExtracto/' + img,
    	caption: $('#user_name').val() + " wants toooo share his/her dream with you on Posibl Application. Sign Up in posibl, and help him  make it happen.",
    	description: '"' + extracto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}
function fbCompartirNews(news , nombreNews) {
	if($('#user_name').val() == nombreNews){
		nombreNews = "his";
	}
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: $('#url_site').val() + 'img/imgShare.jpg',
    	caption: $('#user_name').val() + " wants to share "+nombreNews+" news with you on Posibl Application. Sign Up in posibl, and help him  make it happen.",
    	description: '"' + news + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}

function fbShareTimeline(rutaImg, texto, userTimeline, userComment) {
	if($('#user_name').val() == userTimeline){
		caption = $('#user_name').val() +' wants to share the help recived from '+ userComment;
	}else if($('#user_name').val() == userComment){
		caption = $('#user_name').val() +' wants to share the help gived to '+ userTimeline;
	}else{
		caption = $('#user_name').val() +' wants to share the help that '+userComment+' gived to '+ userTimeline;
	}
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: $('#url_site').val() + rutaImg,
    	caption: caption,
    	description: '"' + texto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}

function fbShareTimelineFin(rutaImg, texto, userTimeline) {
	if($('#user_name').val() == userTimeline){
		caption = $('#user_name').val() +' wants to share that his dream come true.';
	}else{
		caption = $('#user_name').val() +' wants to share that '+userTimeline+' dream come true.';
	}
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: $('#url_site').val() + rutaImg,
    	caption: caption,
    	description: '"' + texto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}
function fbShareGenericoSuenoUser(rutaImg, texto, nombreActual, tipo) {
	if($('#user_name').val() == nombreActual){
		nombreActual = "his";
	}
	if(tipo == "video"){
		img = rutaImg;
		caption = $('#user_name').val() + " wants to share " + nombreActual + " dream video with you! You can help "+ nombreActual +" dream come true.";
	}else{
		img = $('#url_site').val() + rutaImg;
		caption = $('#user_name').val() + " wants to share " + nombreActual + " dream image with you! You can help "+ nombreActual +" dream come true.";
	}
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: img,
    	caption: caption,
    	description: '"' + texto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}
function fbShareGenericoDm(rutaImg, texto, nombreActual, tipo) {
	if($('#user_name').val() == nombreActual){
		nombreActual = "his";
	}
	if(tipo == "video"){
		img = rutaImg;
		caption = $('#user_name').val()+" wants to share "+ nombreActual +" video with you!";
	}else{
		img = $('#url_site').val() + rutaImg;
		caption = $('#user_name').val()+" wants to share "+ nombreActual +" image with you!";
	}
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: img,
    	caption: caption,
    	description: '"' + texto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}
function fbShareOurHelp(rutaImg, texto) {
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'Posibl.',
    	link: $('#shareFBLink').val(),
    	picture: $('#url_site').val() + rutaImg,
    	caption: $('#user_name').val() + " wants to share this help.",
    	description: '"' + texto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
	
}
function fbSendRequest() {
	FB.ui({
		method: 'apprequests',
    	message: $('#user_name').val() + ' wants to share Posibl. application with you. Share your dream. You will receive help from other dreamers like you, and can also help them realize theirs.',
		title: 'Posibl.',
		data: {"url" : $('#shareFBLink').val(),
		description: 'POSIBL. is a facebook application created to help people begin to express their dreams and how to work achieve them.' }
		
  	}, function() {
		alert('Your invitation has been sent');
	});	
}

function fbRegistroSueno(userid){
	FB.api('/me/feed', 'post', { 
		name: 'Posibl.',
    	link: $('#shareFBLink').val() + "/iHaveADream.php?userid=" + userid,
    	picture:  $('#url_site').val() + $('#imagenRegistro img').attr('src'),
    	description: "Sign up in Posibl. and start living your dreams too.",
		message: $('#fullName').val() + " has a dream on Posibl. Application." }, 
		function(response) {
			window.location.href = 'mySoul.php';
	});
}

function fbRegistroDM(userid){
	FB.api('/me/feed', 'post', { 
		name: 'Posibl.',
    	link: $('#shareFBLink').val() + "/iHaveADream.php?userid=" + userid,
    	picture:  $('#url_site').val() + $('#imagenLogo').attr('src'),
    	description: "Sign up in Posibl. and start living your dreams too.",
		message: $('#brandName').val() + " has a dream on Posibl. Application." }, 
		function(response) {
			window.location.href = 'mySoul.php';
	});
}

function fbSuenoFinalizadoShare(img){
	var rutaImg = $('#url_site').val() + "uploadAyuda/"+img;
	
	FB.api('/me/feed', 'post', { 
		name: 'Posibl.',
    	link: $('#shareFBLink').val() + "/iHaveADream.php?userid=" + $('#user_id').val(),
    	picture:  rutaImg,
    	description: "Great news! Sign up in posibl and start follow your dreams too.",
		message: $('#user_name').val() + " has achieved his/her dream on Posibl. Application." }, 
		function(response) {
			//alert(response);
	});
}

function fbAyudaValoradaTimelineShare(img, nombre, texto){
	var rutaImg = $('#url_site').val() + "uploadAyuda/"+img;

	FB.api('/me/feed', 'post', { 
		name: 'Posibl.',
    	link: $('#shareFBLink').val() + "/iHaveADream.php?userid=" + $('#user_id').val(),
    	picture:  rutaImg,
    	description: texto,
		message: "Thanks to "+nombre+" I am one step closer to my dream coming true on Posibl. Application." }, 
		function(response) {
			//alert(response);
	});
}

function agregarAmigo(divId,idAmigo) {
	FB.ui({
		method: 'friends.add', 
		id: idAmigo
  	}, function(data) {
		/*if(data['action'] != false){
		} */
	});
}


/***********************************************************/
/******** CALLBACKS ****************************************/
/***********************************************************/
var doingLogin = false;

function login(response, info){

	if (response.authResponse) {
		if (doingLogin) {
			return;	
		}
		
		doingLogin = true;
		$.post("registrarFb.php", { fbid : info.id, nombre_completo : info.name, nombre : info.first_name, apellido : info.last_name, sexo : info.gender, nacimiento : info.birthday, email : info.email, location : info.location}, 
			function(data) {
				doingLogin = false;
				var msg = data.split("|");
				if (msg[0] == "ok") {
					document.location.href = msg[1];
				} else {
					if (msg[1] == "redirect") {
						window.location.href = 'index.php';
					}
				}
		});
	}
}

/*****************************************************************/
/******** IMAGENES DE FACEBOOK ***********************************/
/*****************************************************************/

function openModalImgFb(tipo){
	showLoader();
	$('#contenedorAlbumesFotos').data('jsp').getContentPane().empty();
	$('.titulo').append('Select album');
	//llamada al api de fb para obtener imagenes
	FB.api('/me/albums',  function(resp) {
		var msg = '';
	
		for (var i=0, l=resp.data.length; i<l; i++){
			var album = resp.data[i];
		
			msg += '<div class="albumes">';
				msg += '<div class="bgAlbumFoto">';
						msg += '<img src="https://graph.facebook.com/'+album.id+'/picture?access_token='+FB.getAuthResponse().accessToken+'" style="cursor:pointer;" onclick="detalleAlbum(\''+album.id+'\', \''+tipo+'\')" />';
				msg += '</div>';
				msg += '<div class="albumFotoTexto"><p title="'+album.name+'">'+album.name+'</p></div>';
			msg += '</div>';
		}
		
		$("#contenedorAlbumesFotos").data('jsp').getContentPane().html(msg);
		$("#albumFotosDiv").show();
		$("#contenedorAlbumesFotos").data('jsp').reinitialise();
		
		ocultarLoader();
	});
}

function closeModalImgFb(){
	$("#fotosDiv iframe").attr('src','');
	$("#albumFotosDiv").fadeOut(300);
}

function detalleAlbum(id, tipo) {
	showLoader();
	$("#contenedorAlbumesFotos").data('jsp').getContentPane().empty();
	$('.titulo').empty();
	$('.titulo').append('Select photo');
	//llamada al api de fb para obtener imagenes
	FB.api('/'+id+'/photos',  function(resp) {
		var msg = '';
		
		for (var i=0, l=resp.data.length; i<l; i++){
			var photo = resp.data[i];
			
			msg += '<div class="fotos">';
			msg += '<div class="bgAlbumFoto">';
			msg += '<img src="'+photo["images"][6].source+'" style="cursor:pointer;" onclick="elegirImagen(\''+photo["images"][0].source+'\', \''+tipo+'\')" />';
			msg += '</div>';
			msg += '</div>';
		}
		
		$("#contenedorAlbumesFotos").data('jsp').getContentPane().html(msg);
		$("#albumFotosDiv").show();
		$("#contenedorAlbumesFotos").data('jsp').reinitialise();
		
		ocultarLoader();
	});
}

function elegirImagen(url, tipo) {
	//post para guardarla en la base (solo las de facebook)
	$.post("subir_imagen_fb.php", { 'tipoFoto' : tipo, 'url' : url}, 
		function(data) {
			imageUploadResult(data);
		}
	);
	$("#fotosDiv iframe").attr('src','');
}

function ocultarLoader(){
	$('#fotosDiv .loader').fadeOut(300);
}

function showLoader(){
	$('#fotosDiv .loader').fadeIn(300);
}


/*****************************************************************/
/***************** REGISTRO **************************************/
/*****************************************************************/
function showModalLoginRequired(){
	//por el momento esto no es necesario
}

function registroCompleto(publicado){
	if(publicado==1){
		alert('Data has been saved');
	} else {
		alert('Data has been saved. You need to publish your data to make it visible to other dreamers and dream makers.');
	}
}

function publishDream(userid){
	fbRegistroSueno(userid);
}


function validarFormRegistro(status){
	var isValid = true;
	var msg = "";
	
	if($('#interest').val().trim() == "" || $('#interest').val().trim() == $('#interest').attr('title') || $('#extract').val().trim() == "" || $('#description').val().trim() == ""){
		isValid = false;
		msg += 'All fields are mandatory. ';
	}
	if($('#extract').val().trim().length > 250){
		isValid = false;
		msg += 'Your title cannot exceed 250 characters. ';
	}
	
	if(isValid){
		if(status == "save"){
			saveRegistro();
		} else if (status == "publish") {
			if($("#sortable li:first-child").length == 0 /*|| $('#imgGaleria1').attr('src') == "" || $('#imgGaleria1').attr('src').substring(0, 6) != "upload"*/) {
				alert('You must upload at least one image for your dream gallery.');
				return false;
			} else {
				publicarRegistro();
			}
		}
	} else {
		alert(msg);
		return false;
	}
}

function saveRegistro(){
	$('#modalRegistro').fadeOut(300);
	$('#form1').attr('action','registrar.php');
	$('#tipoFoto').val('');
	$('#form1').submit();
}

function publicarRegistro(){
	//$('#modalRegistro').fadeOut(300);
	$('#form1').attr('action','publicar.php');
	$('#tipoFoto').val('');
	$('#form1').submit();
}

function showErrorPost(error){
	alert(error);
}

function eliminarImg(img, nro){
	if (doingLogin) {
		return;	
	}
	if(confirm('Are you sure you want to delete this image?')){
		doingLogin = true;
		$.post("eliminar_imagen.php", { 'tipoImg' : img, 'nro' : nro}, 
			function(data) {
				doingLogin = false;
				if(data == "ok"){
					if(img == "galeria"){
						$("#sortable").trigger("removeItem", [nro, true]);
						
						$('#static').append('<li class="ui-state-default"><div class="extractImg"></div></li>');
						
					} else if(img == "logo"){
						$('#imagenLogo').attr('src','img/logoGenerico.png');
						$('#uploadLogoFB').show();
						$('#uploadLogo').show();
						$('#eliminarLogoImg').addClass('hide');
					}
				} else {
					alert('There was a problem trying to delete the image');
				}
			}
		);
	}
}

function cambiarOrdenImagenGaleria(posInicial, posFinal){
	if(posInicial != posFinal){
		$.post("cambiarOrdenImgGaleria.php", { 'posInicial' : posInicial, 'posFinal' : posFinal},
			function(data){
				//hacer algo si queremos catchear errores de esto.
			}
		);
	}
}

function imageUploadResult(msg){
	doingLogin = false;
	var mensaje = msg.split('|');
	if(mensaje[0] == "error"){
		alert(mensaje[1]);
		if(mensaje[mensaje.length-1] == "logo") {
			$('#imagenRegistro .loaderSmall').fadeOut(300);
		}
	} else {
		closeModalImgFb();
		if(mensaje[mensaje.length-1] == "galeria" || mensaje[mensaje.length-1] == "galeriaDM"){
			var dir = "uploadGaleria";
			if(mensaje[mensaje.length-1] == "galeriaDM"){
				dir += "DM";
			}
			$("#sortable").trigger("insertItem", ['<li class="ui-state-default"><div class="extractImg"><div class="eliminar"></div><img  style="width:100%;" border="0" src="'+dir+'/'+mensaje[1]+'"></div></li>', "end", true]);
			$('#static').empty();
			if($("#sortable > li").length < 6){
				for(var i=0; i < (6-$("#sortable > li").length); i++ ){
					$('#static').append('<li class="ui-state-default"><div class="extractImg"></div></li>');
				}
			}
		} else if(mensaje[mensaje.length-1] == "logo") {
			$('#eliminarLogoImg').removeClass('hide');
			$('#uploadLogoFB').hide();
			$('#uploadLogo').hide();
			$('#imagenRegistro .loaderSmall').fadeOut(300);
			$('#imagenLogo').attr('src','uploadLogo/' + mensaje[1]);
		}
	}
}

function enviarFormFoto(img){
	if (doingLogin) {
		return;	
	}
	doingLogin = true;
	
	if(img == 'logo'){
		$('#form1').attr('action','subir_imagen.php');
		$('#tipoFoto').val(img);
		$('#imagenRegistro .loaderSmall').fadeIn(300);
		$('#imagenLogo').attr('src','data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
		$('#form1').submit();
	} else if(img!='ayuda'){
		$('#form1').attr('action','subir_imagen.php');
		$('#tipoFoto').val(img);
		$('#form1').submit();
	}else{
		$('#formComentario').attr('action','subir_imagen.php');
		$('#tipoFotoComentario').val(img);
		$('#formComentario').submit();
	}
}

function validarFormVideo(){
	var isValid = true;
	var msg = "";
	
	if($('#nombreVideo').val().trim() == "" || $('#urlVideo').val().trim() == "" ){
		isValid = false;
		msg += 'All fields are mandatory.';
	}
	if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test($('#urlVideo').val().trim()) == false) {
		isValid = false;
		msg += 'Invalid URL.';
	}
	
	if(!isValid){
		alert(msg);
	} else {
		$.post("subir_video.php", { 'nombreVideo' : $('#nombreVideo').val().trim(), 'urlVideo' : $('#urlVideo').val().trim()},
			function(msg){
				var data = msg.split("|");
				if(data[0] == "ok"){
					//agregar el video al slider con algo que lo represente
					$("#sortable").trigger("insertItem", ['<li class="ui-state-default"><div class="extractImg"><div class="eliminar"></div><img  style="width:100%;" border="0" src="'+data[1]+'"></div></li>', "end", true]);
					closeModalLoged();
				} else {
					alert(data);
				}
		});
	}
}

/*****************************************************************/
/***************** REGISTRO DREAM MAKERS**************************/
/*****************************************************************/

function validarFormRegistroDreamMaker(status){
	var isValid = true;
	var msg = "";
	
	if($('#imagenLogo').attr('src') == "" || $('#imagenLogo').attr('src').substring(0, 6) != "upload") {
		isValid = false;
    	msg += 'You must upload a logo image. ';
	}
	
	if($('#brandName').val().trim() == "" || $('#slogan').val().trim() == "" || $('#category').val().trim() == "" || $('#positioning').val().trim() == "" || $('#extract').val().trim() == "" || $('#description').val().trim() == "" || $('#brandName').val() == $('#brandName').attr('title') || $('#slogan').val() == $('#slogan').attr('title') || $('#category').val() == $('#category').attr('title') || $('#positioning').val() == $('#positioning').attr('title') || $('#extract').val() == $('#extract').attr('title') || $('#description').val() == $('#description').attr('title')){
		isValid = false;
		msg += 'All fields are mandatory. ';
	}
	
	if($('#extract').val().trim().length > 250){
		isValid = false;
		msg += 'Your title cannot exceed 250 characters. ';
	}
	
	if(isValid){
		if(status == "save"){
			saveRegistroDreamMaker();
		} else if (status == "publish") {
			if($("#sortable li:first-child").length == 0) {
				alert('You must upload at least one image for your gallery.');
				return false;
			} else {
				publicarRegistroDreamMaker();
			}
		}
	} else {
		alert(msg);
		return false;
	}
}

function saveRegistroDreamMaker(){
	//$('#modalRegistro').fadeOut(300);
	$('#form1').attr('action','registrarDM.php');
	$('#tipoFoto').val('');
	$('#form1').submit();
}

function publicarRegistroDreamMaker(){
	//$('#modalRegistro').fadeOut(300);
	$('#form1').attr('action','publicarDM.php');
	$('#tipoFoto').val('');
	$('#form1').submit();
}

function unpublishDreamMaker(){
	if(confirm('Are you sure you want to unpublish your user?')){
		doingLogin = true;
		$.post("unpublish.php",  
			function(data) {
				if(data == "ok"){
					$('#btnUnpublish').hide();
					$('#btnPublish').show();
					alert('User is now unpublished. You can publish it now clicking the publish button');
				} else {
					alert('There was a problem trying to unpublish the user');
				}
			}
		);
	}
}

function publishDM(userid){
	$('#btnUnpublish').show();
	$('#btnPublish').hide();
	fbRegistroDM(userid);
}

function registroDMCompleto(){
	alert('Data has been saved. You need to publish your data to make it visible to dreamers.');
}

/*****************************************************************/
/******** GALERIA DE DREAMERS ************************************/
/*****************************************************************/

function cambiarPaginaGaleria(pagina , sueno) {
	switch (sueno){
		case "dFalse":
		  pag="content_dreamers.php";
		  break;
		case "dTrue":
		  pag="content_dreamersComeTrue.php";
		  break;
		case "dm":
		  pag="content_dreamMakers.php";
		  break;
		case "busqueda":
		  pag="content_dreamersBusqueda.php";
		  break;
	} 
	$.post("sections/"+pag+"", { pag: pagina},
		function(data) {
			$('#contenido').html(data);
			achicarImagenes('.foto img', 65, 61);
		}
	);
}

function ordenarPaginaGaleria(letra , sueno) {
	switch (sueno){
		case "dFalse":
		  pag="content_dreamers.php";
		  break;
		case "dTrue":
		  pag="content_dreamersComeTrue.php";
		  break;
		case "dm":
		  pag="content_dreamMakers.php";
		  break;
		case "dBusqueda":
		  pag="content_dreamersBusqueda.php";
		  break;
	} 
	$.post("sections/"+pag+"", { filtro: letra },
		function(data) {
			$('#contenido').html(data);
			achicarImagenes('.foto img', 65, 61);
			$("#letraTODOS").removeClass('active');
			$("#letra"+letra).addClass('active');
		}
	);
	
}
/*****************************************************************/
/******** GALERIA DE AYUDAS ************************************/
/*****************************************************************/

function cambiarPaginaForMe(pagina) {
	$.post("sections/content_forme.php", { pag: pagina},
		function(data) {
			$('#contenido').html(data);
			achicarImagenes('.foto img', 73, 70);
		}
	);
}

function cambiarPaginaForYou(pagina) {
	$.post("sections/content_foryou.php", { pag: pagina},
		function(data) {
			$('#contenido').html(data);
			achicarImagenes('.foto img', 73, 70);
		}
	);
}

/*****************************************************************/
/********************* AYUDAS ************************************/
/*****************************************************************/

function openModalComentarAyuda(idAyuda){
	$('#idAyuda').val(idAyuda);
	$('#modalComentario').fadeIn(300);
}

function openModalDreamComesTrue(idAyuda){
	if(confirm('Is your dream come true? If your answer is yes, Congratulations! Please upload a picture to represent it, and keep dreaming on Posibl.')){
		if(idAyuda != '0'){
			$('#modalComentario p').append('You rated a help degree, make a comment upload a picture and share it! It will be posted in your dream timeline.');
		}else{
			$('#modalComentario p').append('You are making your dream true, make a comment upload a picture and share it! It will be posted in your dream timeline.');
		}
		$('#idAyuda').val(idAyuda);
		$('#modalComentario').fadeIn(300);
	}
}

function openModalAyudar(toId, toName, fromId, fromName){
	$('#receptorAyuda').val(toName);
	$('#idReceptor').val(toId);
	$('#emisorAyuda').val(fromName);
	$('#idEmisor').val(fromId);
	$('#modalMensaje').fadeIn(300);
}

function sendAyuda(){
	if($('#textoAyuda').val().trim() != ""){
		$.post("enviarAyuda.php", { idEmisor: $('#idEmisor').val(), idReceptor: $('#idReceptor').val(), isDreamMaker: $('#isDreamMaker').val(), texto: $('#textoAyuda').val().trim() },
			function(data) {
				if(data == "ok"){
					alert('Your help was sent successfully! User will be notified');
					$('#modalMensaje').fadeOut(500);
				} else {
					var msg = data.split('|');
					alert(msg[1]);
				}
		});
	} else {
		alert('You must enter a description for the help');
	}
}

function responderAyuda() {
	if($('#respuestaAyuda').val().trim() == ""){
		alert("You must enter a reply.");
	} else {
		$.post("responderAyuda.php", { 'idAyuda': $('#AyudaAResponder').val(), respuesta: $('#respuestaAyuda').val().trim() },
			function(data) {
				if(data == "ok"){
					alert('Your reply was sent successfully! User will be notified');
					hideFormResponderAyuda();
					$('#respuestaAyuda'+idAyuda).hide();
					//fbCompartir();
				} else {
					var msg = data.split('|');
					alert(msg[1]);
				}
		});
	}
}

function ChangeText(id, idAyuda){
	var abierta = false;
	if($("#acord"+id).children(".btn").html() == "OPEN"){
		abierta = true;
		setAyudaLeida(idAyuda);
	}
	
	$(".answer").hide();
	$(".seeAnswer").hide();	
	hideFormResponderAyuda();
	hideFormVerRespuesta();
	$(".btn").html("OPEN");
	
	if(abierta == true){
		$("#acord"+id).children(".btn").html("CLOSE");
	}
}

function showFormResponderAyuda(id, idAyuda) {
	$(".acord").each(function(index,el){
		if($(this).attr('id') != "acord"+id){
			$(this).hide();
		}
	});
	$("#respuestaAyuda").val('');
	$("#AyudaAResponder").val(idAyuda);
	$(".answer").show();
	$(".seeAnswer").hide();
}

function showFormRespuestas(id, idAyuda, pag) {
	$(".acord").each(function(index,el){
		if($(this).attr('id') != "acord"+id){
			$(this).hide();
		}
	});
	$(".seeAnswer").show();
	$(".answer").hide();
	setRespuestaLeida(idAyuda, pag);
}

function showFormRespuestaAyuda(id, idAyuda, texto) {
	$(".acord").each(function(index,el){
		if($(this).attr('id') != "acord"+id){
			$(this).hide();
		}
	});
	$("#respuestaAyuda").val(texto);
	$(".answer").show();
	
}

function hideFormResponderAyuda() {
	$(".acord").each(function(index,el){
		$(this).show();
	});
	$(".answer").hide();
}

function hideFormVerRespuesta() {
	$(".acord").each(function(index,el){
		$(this).show();
	});
	$(".seeAnswer").hide();
}

function validarFormComentario(){
	var isValid = true;
	var msg = "";
	if($('#comentarioAyuda').val().trim() == ""){
		isValid = false;
		msg += 'Comment field is mandatory.';
	}
	
	if($('#imgAyuda').val() != ""){
		var ext = $('#imgAyuda').val().split('.').pop().toLowerCase();	
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			isValid = false;
			msg += 'Only gif, png, jpg image extensions are allowed.';
		}
	} 
	
	if(isValid){
		enviarFormComentario();
	} else {
		alert(msg);
		return false;
	}
}

function enviarFormComentario(){
	var inTimeline = $('#timeline').is(':checked') ? "1" : "0";

	$.post("comentarAyuda.php", { idAyuda: $('#idAyuda').val(), comentario: $('#comentarioAyuda').val(), timeline: inTimeline },
		function(msg) {
			var data = msg.split("|");
			if(data[0] == "ok"){
				if($('#idAyuda').val() == 0){
					//finaliza sueño => post de facebook
					fbSuenoFinalizadoShare(data[1]);
					$('#btnHelpMe').attr('onclick', '');
					$('.btnRegistro').hide();
					$('.btnRegistroImg').hide();
				} else {
					if(inTimeline == "1"){
						fbAyudaValoradaTimelineShare(data[1],data[2], data[3]);
					}
				}
				alert('Your help was sent successfully! User will be notified');
				$('#modalComentario').fadeOut(500);
				$('#respuestaAyuda'+$('#idAyuda').val()).hide();
				//fbCompartir();
			} else {
				alert(data[1]);
			}
	});
}

function enviarFormComentarioFoto(img){
	if (doingLogin) {
		return;	
	}
	doingLogin = true;
	$('#formComentario').attr('action','subir_imagen.php');
	$('#tipoFotoComentario').val(img);
	$('#formComentario').submit();
}

function setAyudaLeida(id){
	if($('#btnNoLeido'+id).is(':visible')) {
		$.post("setAyudaLeida.php", { 'idAyuda': id },
			function(msg) {
				var data = msg.split("|");
				if(data[0] == "ok"){
					if(data[1] != 0){
						var nroNotif = $('#cantNotif').html();
						$('#cantNotif').html(nroNotif-1);
	
						var nroNotifMe = parseInt($('#cantNotifMe').html());
						$('#cantNotifMe').html(nroNotifMe-1);
					}
					$('#btnNoLeido'+id).hide();
					
				} else {
					/*var msg = data.split('|');
					alert(msg[1]);*/
				}
		});
	}
}

function setRespuestaLeida(idAyuda, pag){
	$.post("setRespuestaLeida.php", { 'idAyuda': idAyuda},
		function(msg) {
			var data = msg.split("|");
			if(data[0] == "ok"){
				if(data[1] > 0){
					var nroNotif = $('#cantNotif').html();
					$('#cantNotif').html(nroNotif-parseInt(data[1]));
					
					if(pag == "foryou"){
						var nroNotifYou = parseInt($('#cantNotifYou').html());
						$('#cantNotifYou').html(nroNotifYou-parseInt(data[1]));
					} else {
						var nroNotifMe = parseInt($('#cantNotifMe').html());
						$('#cantNotifMe').html(nroNotifMe-parseInt(data[1]));
					}
					
					$('#highbtnNoLeido'+idAyuda).hide();
					$('#lowbtnNoLeido'+idAyuda).hide();
				}
			} else {
				/*var msg = data.split('|');
				alert(msg[1]);*/
			}
	});
}

function valorarAyuda(idAyuda, valoracion) {
	$.post("valorarAyuda.php", { 'idAyuda': idAyuda, 'valoracion': valoracion },
		function(data) {
			if(data == "ok"){
				$("#puntos"+idAyuda+" div").each(function(index,el){
					$(this).attr('onclick','').unbind('click');
					$(this).addClass('nubeVotada');
					if(index < valoracion){
						$(this).removeClass('nubeDes');
						$(this).addClass('nubeAct');
					} 
					openModalComentarAyuda(idAyuda);
				});
			} else {
				/*var msg = data.split('|');
				alert(msg[1]);*/
			}
	});
}

/*****************************************************************/
/************ OTRAS FUNCIONES ************************************/
/*****************************************************************/

function resizeImage(img, max_width, max_height) {
    var height = img.height();
    var width = img.width();

    var ratio = ((max_width / width) < (max_height / height) ? max_width / width : max_height / height);
    width = ratio * width;
    height = ratio * height;

    var margin_top = height / -2;
    var margin_left = width / -2;

    img.attr("height", height);
    img.attr("width", width);
    img.css({ "margin-top": margin_top, "margin-left": margin_left, "position": "absolute", "top": "50%", "left": "50%" });
}

function achicarImagenes(selector, width, height) {
	/*$(selector).hide();
    $(selector).unbind("load");
    $(selector).load(function() {
        resizeImage($(this), width, height);

        $(this).show();
    });	*/
}

function doAchicar(selector, width, height) {
	/*$(selector).each(function() {
        resizeImage($(this), width, height);

        $(this).show();
    });*/
}

function preload() {
	for (i = 0; i < preload.arguments.length; i++) {
		images[i] = new Image();
		images[i].src = preload.arguments[i];
	}
}

function url_friendly(text) {
  	var url = text.toLowerCase()
				  .replace(/^\s+|\s+$/g, "\-")
				  .replace(/[_|\s]+/g, "\-")
				  .replace(/ã/g, "a")
				  .replace(/ç/g, "c")
				  .replace(/á/g, "a")
				  .replace(/é/g, "e")
				  .replace(/í/g, "i")
				  .replace(/ó/g, "o")
				  .replace(/ú/g, "u")
				  .replace(/ê/g, "e")
				  .replace(/ô/g, "o")
				  .replace(/[^a-z0-9_]+/g, "\-")
				  .replace(/[_]+/g, "\-")
				  .replace(/^_+|_+$/g, "\-");
    return url;
}
function openModal(modal){
	$('#'+modal).fadeIn(300);
}


/*****************************************************************/
/************ MODALS ************************************/
/*****************************************************************/


function openModalNews(img,texto,nombre,idEvento){
	$('#texto').append(texto);
	$('#modalNews .foto').append('<img src="'+img+'?type=small" />');
	$('#nombreCompleto').append(nombre);
	$('#modTimelineFbComent').append('<div class="fb-comments" id="comment'+idEvento+'" data-href="http://apps.facebook.com/308198259265805/news.php?idEvento='+idEvento+'" data-num-posts="4" data-width="510" data-height="360"></div>');
	FB.XFBML.parse();
	$('#modalNews').fadeIn(300);
}
function openModalTimeline(userImg,img,comentario,mensaje,nombre,idAyuda,idReceptor){
	$('#modTimelineUsuario .foto').append('<img src="'+userImg+'"/>');
	$('#modTimelineImg').append('<img src='+img+' />');
	$('#modTimelineUsuario .descAyuda').append(comentario);
	$('#mensaje').append(mensaje);
	$('#nombreCompleto').append(nombre);
	$('#modTimelineFbComent').append('<div class="fb-comments" id="comment'+idAyuda+'" data-href="http://apps.facebook.com/308198259265805/timeLine.php?ayuda='+idAyuda+'&userid='+idReceptor+'" data-num-posts="4" data-width="345" data-height="233"></div>');
	FB.XFBML.parse();
	$('#modalTimeline').fadeIn(300);
}
function openModalOurHelp(userImg,img,comentario,mensaje,nombre,idAyuda,idReceptor){
	$('#modTimelineUsuario .foto').append('<img src="'+userImg+'" />');
	$('#modTimelineImg').append('<img src='+img+' />');
	$('#modTimelineUsuario .descAyuda').append(comentario);
	$('#mensaje').append(mensaje);
	$('#nombreCompleto').append(nombre);
	$('#modTimelineFbComent').append('<div class="fb-comments" id="comment'+idAyuda+'" data-href="http://apps.facebook.com/308198259265805/timeLine.php?ayuda='+idAyuda+'&userid='+idReceptor+'" data-num-posts="4" data-width="345" data-height="233"></div>');
	FB.XFBML.parse();
	$('#modalTimeline').fadeIn(300);
}

function openModalMyDream(userImg,img,nombre,idUsuario,idImagen,tipo){
	if(tipo == "video"){
		imgVideo = '<iframe width="415" height="448" src="http://www.youtube-nocookie.com/embed/'+img+'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
	}else{
		imgVideo = '<img src="uploadGaleria/'+img+'" />';
	}
	$('#modMyDream .foto').append('<img src="'+userImg+'?type=small" />');
	$('#modMyDreamImg').append(imgVideo);
	$('#nombreCompleto').append(nombre);
	$('#modMyDreamFbComent').append('<div class="fb-comments" id="comment'+idUsuario+'" data-href="http://apps.facebook.com/308198259265805/iHaveADream.php?userid='+idUsuario+'&imageId='+idImagen+'" data-num-posts="4" data-width="290" data-height="393"></div>');
	FB.XFBML.parse();
	$('#modalMyDream').fadeIn(300);
}
function openModalKnowOurSoul(userImg,img,nombre,idUsuario,idImagen,tipo){
	if(tipo == "video"){
		imgVideo = '<iframe width="415" height="448" src="http://www.youtube-nocookie.com/embed/'+img+'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
	}else{
		imgVideo = '<img src="uploadGaleriaDM/'+img+'" />';
	}
	$('#modMyDream .foto').append('<img src="'+userImg+'"/>');
	$('#modMyDreamImg').append(imgVideo);
	$('#nombreCompleto').append(nombre);
	$('#modMyDreamFbComent').append('<div class="fb-comments" id="comment'+idUsuario+'" data-href="http://apps.facebook.com/308198259265805/iHaveADream.php?userid='+idUsuario+'&imageId='+idImagen+'" data-num-posts="4" data-width="290" data-height="393"></div>');
	FB.XFBML.parse();
	FB.XFBML.parse();
	$('#modalKnowOurSoul').fadeIn(300);
}

function openModalOurMessage(userImg,img,titDesc,slogan,nombre,idDM){
	$('#modTimelineUsuario .foto').append('<img src="'+userImg+'" />');
	$('#modTimelineImg').append('<img src='+img+' />');
	$('#modTimelineUsuario .descAyuda').append(titDesc);
	$('#mensaje').append(slogan);
	$('#nombreCompleto').append(nombre);
	$('#modTimelineFbComent').append('<div class="fb-comments" id="comment'+idDM+'" data-href="http://apps.facebook.com/308198259265805/ourMessage.php?userid='+idDM+'" data-num-posts="4" data-width="345" data-height="233"></div>');
	FB.XFBML.parse();
	$('#modalOurMessage').fadeIn(300);
}

function closeModalKnowOurSoul(){
	$('#modalKnowOurSoul').fadeOut(300);
	$("#modMyDream .foto,#modMyDreamImg,#nombreCompleto,#modMyDreamFbComent").empty();
}

function closeModalOurMessage(){
	$('#modalOurMessage').fadeOut(300);
	$("#modTimelineUsuario .foto,#modTimelineImg,#modTimelineUsuario .descAyuda,#mensaje,#nombreCompleto,#modTimelineFbComent").empty();
}	

function closeModalTimeline(){
	$('#modalTimeline').fadeOut(300);
	$("#modTimelineUsuario .foto,#modTimelineImg,#modTimelineUsuario .descAyuda,#mensaje,#nombreCompleto,#modTimelineFbComent").empty();
}	
function closeModalNews(){
	$('#modalNews').fadeOut(300);
	$("#texto,#modalNews .foto,#nombreCompleto,#modTimelineFbComent").empty();
}
function closeModalMyDream(){
	$('#modalMyDream').fadeOut(300);
	$("#modMyDream .foto,#modMyDreamImg,#nombreCompleto,#modMyDreamFbComent").empty();
}
function closeModal(modal){
	$('#'+modal).fadeOut(300);
}

function openModalLoged(){
	$('#modalLogued').fadeIn(300);
}
function openModalRegistroHelp(){
	$('#modalRegistroHelp').fadeIn(300);
}

function closeModalLoged(){
	$("#modalLogued").fadeOut(300);
	$("#modalRegistro").fadeOut(300);
	$("#modalRegistro").fadeOut(300);
	$("#modalRegistroFirst").fadeOut(300);
	$("#modalRegistroHelp").fadeOut(300);
	$("#modalUploadVideo").fadeOut(300);
}

function openModalUploadVideo(){
	$("#modalUploadVideo").fadeIn(300);
}
