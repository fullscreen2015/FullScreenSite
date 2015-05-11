$(document).ready(function(){

 var array_url=window.location.href.split('/');
 var ultima_posicao=array_url[array_url.length-1];
 var array_do_arquivo=ultima_posicao.split('.');
 var id_link= "#link-" + array_do_arquivo[0];

 $(id_link).addClass('link_rodape');

});



$(document).ready(function(){

 var array_url=window.location.href.split('/');
 var ultima_posicao=array_url[array_url.length-1];

 $(".menu_link").each(function(){
 	var href= $(this).attr("href");

 	if(href == ultima_posicao)
 	{
 	  $(this).addClass('a_destaque');
 	  	var ref= $(this).attr('rel');

 	  for (var i = ref-1; i != 0; i--) {
		$(".menu_link[rel="+i+"]").addClass('a_destaque_anteriores');
		} 		
 	}
 });

});