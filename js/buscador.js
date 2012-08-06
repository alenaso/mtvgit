// JavaScript Document
/*------autocomplete buscador-----*/
$(function() {
	var resultadoAC=[];
	var cantidadRes = 0;
		$( "#project" ).autocomplete({
			minLength: 1,
			source: "busqueda.php",
			select: function( event, ui ) {
				url= "iHaveADream.php?userid="+(ui.item.id);
				window.location.href = url;
				return false;
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
			resultadoAC+=item.id+",";
			cantidadRes++;
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a href=''><img src='"+item.icon+"' /><h1>"+ item.label + "</h1><span>"+item.desc+"</span></a>" )
				.appendTo( ul );
		};
		
		$( "#project" ).autocomplete({
		   search: function(event, ui) {
			    }
		});
		
		$(document).keypress(function(e) {
			if(e.which == 13 && resultadoAC != "") {
				url= "dreamersBusqueda.php?busqueda="+$('#project').val();
				window.location.href = url;
			}
		});
		$(".lupa").click(function(){
			if(resultadoAC != "") {
				url= "dreamersBusqueda.php?busqueda="+$('#project').val();
				window.location.href = url;
			}
		});

		
	});