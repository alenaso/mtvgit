// JavaScript Document

//global para evitar multiples acciones simultaneas
var doingLogin = false;

//hack para trim en ie7/8
if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
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
	}, {scope:'email,user_birthday,publish_stream,user_photos,user_location'});

}

function fbFeedRegistro(user, redirectUrl){
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'MTV &Uacute;ltimo A&ntilde;o',
    	link: $('#shareFBLink').val(),
    	picture: $('#shareFBLink').val() + 'images/facebook-image.jpg',
    	caption: user + " ya es parte del universo de &Uacute;ltimo A&ntilde;o, la nueva serie de MTV. &iexcl;Con&eacute;ctate con Facebook y s&uacute;mate t&uacute; tambi&eacute;n!",
    	description: '&iquest;Quieres crear tu anuario? &iexcl;Haz clic y s&uacute;mate a &Uacute;ltimo A&ntilde;o!'
  	}, function(response) {
			//alert(response.toSource());
			document.location.href = redirectUrl;
  	});
}


function fbCompartirAnuario(idAnuario, nombre) {
	var usuario = '';
	if(nombre==undefined || nombre==''){
		var usuario = $('#user_name').val();
	} else {
		usuario = nombre;
	}
	
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'MTV &Uacute;ltimo A&ntilde;o',
    	link: $('#shareFBLink').val() + "index.php?aid=" + idAnuario,
    	picture: $('#shareFBLink').val() + 'images/facebook-image.jpg',
    	caption: usuario + " ya cre&oacute; su anuario de &Uacute;ltimo A&ntilde;o. &iexcl;Entra a ver sus fotos!",
    	description: '&iquest;Quieres crear tu anuario? &iexcl;Haz clic y s&uacute;mate a &Uacute;ltimo A&ntilde;o!'
  	}, function(response) {
			//alert(response.toSource());
  	});
}

function fbCompartirMapa(idMapa, nombre) {
	var usuario = '';
	if(nombre==undefined || nombre==''){
		var usuario = $('#user_name').val();
	} else {
		usuario = nombre;
	}
	
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'MTV &Uacute;ltimo A&ntilde;o',
    	link: $('#shareFBLink').val(),
    	picture: $('#shareFBLink').val() + 'images/facebook-image.jpg',
		//(Nombre de usuario que etiqueta) etiquetó a (Nombre de usuario etiquetado) en su mapa de relaciones de Último Año. ¡Conéctate con Facebook y súmate tú también!
    	caption: usuario + " ya cre&oacute; su mapa de relaciones de &Uacute;ltimo A&ntilde;o. &iexcl;Entra a verlo!",
    	description: '&iquest;Quieres crear tu mapa? &iexcl;Haz clic y s&uacute;mate a &Uacute;ltimo A&ntilde;o!'
  	}, function(response) {
			//alert(response.toSource());
  	});
}

function fbCompartirVotacion(img, extracto) {
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'MTV &Uacute;ltimo A&ntilde;o',
    	link: $('#shareFBLink').val(),
    	picture: $('#shareFBLink').val() + 'images/facebook-image.jpg',
    	caption: $('#user_name').val() + " ",
    	description: '"' + extracto + '"'
  	}, function(response) {
			//alert(response.toSource());
  	});
}

function fbShareApp() {
	FB.ui({
    	method: 'feed',
		display : 'iframe',
    	name: 'MTV &Uacute;ltimo A&ntilde;o',
    	link: $('#shareFBLink').val(),
    	picture: $('#shareFBLink').val() + 'images/facebook-image.jpg',
    	caption: "&iexcl;S&eacute; parte del universo de &Uacute;ltimo A&ntilde;o!",
    	description: $('#user_name').val() + ' ya est&aacute; participando y cre&oacute; su perfil. &iquest;Quieres sumarte? &iexcl;Es muy f&aacute;cil! Haz clic y crea el tuyo.'
  	}, function(response) {
			//alert(response.toSource());
  	});
}

function fbSendRequest() {
	FB.ui({
		method: 'apprequests',
    	message: $('#user_name').val() + ' te ha invitado a MTV &Uacute;ltimo A&ntilde;o',
		title: 'MTV &Uacute;ltimo A&ntilde;o',
		data: {"url" : $('#shareFBLink').val(),
			description: 'description' }
		
  	}, function(data) {
		if(data!=null){
			alert('Las invitaciones han sido enviadas');
		}
	});	
}

function postearEnMuroAmigosAnuario(amigosIds, amigosNombres, redirect){
	var cant = 0;
	for(var i=0, l=amigosIds.length; i<l; i++){
		var opts = {
			message : $('#user_name').val() + ' etiquetó a ' + amigosNombres[i] + ' en su anuario de Último Año. ¡Conéctate con Facebook y súmate tú también!',
			link : $('#shareFBLink').val() + redirect,
			description : 'MTV &Uacute;ltimo A&ntilde;o',
			picture : $('#shareFBLink').val() + 'images/facebook-image.jpg',
			caption : 'MTV Último Año'
		};

		FB.api('/'+amigosIds[i]+'/feed', 'post', opts, 
			function(response) {
				cant++;
				//console.log(response);
			}
		);
	}
	
	window.setInterval(function(){
		if(cant >= amigosIds.length) { 
			document.location.href = redirect;
		}
	},1000);
}

function postearEnMuroAmigosMapa(amigosIds, amigosNombres, redirect){
	var cant = 0;
	for(var i=0, l=amigosIds.length; i<l; i++){
		var opts = {
			message : $('#user_name').val() + ' etiquetó a ' + amigosNombres[i] + ' en su mapa de relaciones de Último Año. ¡Conéctate con Facebook y súmate tú también!',
			link : $('#shareFBLink').val() + redirect,
			description : 'MTV &Uacute;ltimo A&ntilde;o',
			picture : $('#shareFBLink').val() + 'images/facebook-image.jpg',
			caption : 'MTV Último Año'
		};

		FB.api('/'+amigosIds[i]+'/feed', 'post', opts, 
			function(response) {
				cant++;
				//console.log(response);
			}
		);
	}

	window.setInterval(function(){
		if(cant >= amigosIds.length) { 
			document.location.href = redirect;
		}
	},1000);
}
/***********************************************************/
/******** CALLBACKS ****************************************/
/***********************************************************/

function login(response, info){
	if (response.authResponse) {
		if (doingLogin) { return; }
		
		showLoader();
		doingLogin = true;
		
		$.post("registrar.php", { fbid : info.id, nombre_completo : info.name, nombre : info.first_name, apellido : info.last_name, sexo : info.gender, nacimiento : info.birthday, email : info.email, location : info.location}, 			function(data) {
				doingLogin = false;
				var msg = data.split("|");
				if (msg[0] == "ok") {
					if(msg[2] == 1){
						fbFeedRegistro(msg[3],msg[1]);
					} else {
						document.location.href = msg[1];
					}
				} else {
					alert('Error al registrarse, vuelva a intentarlo mas tarde');
					ocultarLoader();
				}
		});
	}
}


/***********************************************************/
/******** ANUARIO ****************************************/
/***********************************************************/
function validarFormAnuario(){
	var isValid = true;
	var msg = "";
	
	if($('#categoria').val() == 0 ){
		isValid = false;
		msg += 'Tenes que elegir una categoria.';
	}
	if($("img[src='data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==']").size() >=5 ){
		isValid = false;
		msg += 'Tenes que subir al menos una imagen. ';
	}
	
	if(isValid){
		saveAnuario($('#postearEnMuro').is(':checked'));
	} else {
		alert(msg);
		return false;
	}
}

function saveAnuario(postear){
	if (doingLogin) { return; }
	showLoader();
	doingLogin = true;
	
	$.post("saveAnuario.php", $("#form1").serialize(),
		function(data) {
			doingLogin = false;
			var msg = data.split("|");
			
			if (msg[0] == "ok") {
				if(postear){
					var amigosIds = msg[1].split(",");
					var amigosNombres = msg[2].split(",");
					postearEnMuroAmigosAnuario(amigosIds, amigosNombres, msg[3]);
				} 
			} else {
				if(msg[1] == "redirect"){
					document.location.href = "index.php";
				} else {
					alert('Error al guardar el anuario, vuelva a intentarlo mas tarde');
					ocultarLoader();
				}
			}
		}
	);
}


/***********************************************************/
/******** MAPA ****************************************/
/***********************************************************/
function validarFormMapa(){
	var isValid = true;
	var msg = "";
	if($("img[id^=imgAmigo][src='data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==']").size() >=6 ){
		isValid = false;
		msg += 'Tenes que agregar al menos a un amigo a tu mapa.';
	}
	
	if(isValid){
		saveMapa($('#postearEnMuro').is(':checked'));
	} else {
		alert(msg);
	}
}

function validarItemMapa(id, fbIdAmigo, nombreAmigo){
	if(fbIdAmigo != 0) {
		$('#fotoAmigo'+id).attr('src','http://graph.facebook.com/'+fbIdAmigo+'/picture?type=normal');
	}

	if($('#fotoAmigo'+id).attr('src') != 'data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' && $('#caracteristica'+id).val() > 0) {
		$('#imgAmigo'+id).attr('src',$('#fotoAmigo'+id).attr('src'));
		if(nombreAmigo != '') {
			$('#nombreAmigo'+id).html(nombreAmigo);
		} else {
			$('#nombreAmigo'+id).html($('#tagsAmigo'+id).val());
		}
		$('#caracAmigo'+id).html($('#caracteristica'+id+' option:selected').text());
	} else {
		$('#imgAmigo'+id).attr('src','data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
		$('#nombreAmigo'+id).html('');
		$('#caracAmigo'+id).html('');
	}
}

function saveMapa(postear){
	if (doingLogin) { return; }
	showLoader();
	doingLogin = true;
	
	$.post("saveMapa.php", $("#formMapa").serialize(),
		function(data) {
			doingLogin = false;
			var msg = data.split("|");
			
			if (msg[0] == "ok") {
				if(postear){
					var amigosIds = msg[1].split(",");
					var amigosNombres = msg[2].split(",");
					postearEnMuroAmigosMapa(amigosIds, amigosNombres, msg[3]);
				} 
			} else {
				if(msg[1] == "redirect"){
					document.location.href = "index.php";
				} else {
					alert('Error al guardar el mapa, vuelva a intentarlo mas tarde');
					ocultarLoader();
				}
			}
		}
	);
}

function resetearItemMapa(id){
	$('#fotoAmigo'+id).attr('src','data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
	$('#imgAmigo'+id).attr('src','data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
	$('#nombreAmigo'+id).html('');
	$('#caracAmigo'+id).html('');
}

/***********************************************************/
/******** PRELOADER ****************************************/
/***********************************************************/

function ocultarLoader(){
	$('#modalLoder').fadeOut(300);
}

function showLoader(){
	$('#modalLoder').fadeIn(300);
}


/***********************************************************/
/******** DISPLAY DE IMAGENES*******************************/
/***********************************************************/

function resizeImage(img, width, height, maxWidth, maxHeight, estilos) {
	var ratio = height / width;
	
	if(width >= maxWidth && ratio <= 1){
		width = maxWidth;
		height = width * ratio;
	} else if(height >= maxHeight){
		height = maxHeight;
		width = height / ratio;
	}
	
	img.attr("height", height);
    img.attr("width", width);
	
	if(estilos){
		var margin_top = height / -2;
    	var margin_left = width / -2;
    	img.css({ "margin-top": margin_top, "margin-left": margin_left, "position": "absolute", "top": "50%", "left": "50%" });
	}
	img.height(height);
	img.width(width);
}