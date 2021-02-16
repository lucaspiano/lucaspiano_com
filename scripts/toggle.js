$(document).ready(function(){
//Hide the tooglebox when page load
$(".togglebox").hide(); 
//slide up and down when hover over heading 2
$("h2").hover(function(){
// slide toggle effect set to slow you can set it to fast too.
$(this).next(".togglebox").slideToggle("slow");
return true;
});
});

$(document).ready(function(){

	//Hide (Collapse) the toggle containers on load
	$(".togglebox1").hide(); 

	//Slide up and down on hover
	$("h2").click(function(){
		$(this).next(".togglebox1").slideToggle("slow");
	});

});

/* Dropdown Acesso ao Sistema */
$(document).ready(function () {
    $(".abre_sistema").hover(
  function () {
     $('ul.dropdown').stop().show();
  }, 
  function () {
     $('ul.dropdown').stop().hide();
  }
);

/* Chama funcao de ABAS do Dropdown Acesso ao Sistema  - ABAIXO*/
$.abasSimples();

});


/* Função que carrega script das abas */

$.abasSimples = function ()
{

	/* Guarda IDs dos elementos */

	var abas = 'p.seletor_abas';
	var conteudos = 'ul.abas';
	
	/* Oculta todas as abas */
	
	$(conteudos + ' li').hide();
	
	/* Exibe a primeira aba */
	
	$(conteudos + ' li#aba1').show();
	
	/* Quando uma aba for clicada */
	
	$(abas + ' a').click(function()
	{
	
		/* Remove todas as classes de todas as abas */
	
		$(abas + ' a').removeClass('selected');
		
		/* Acrescenta uma classe CSS marcando visualmente a aba como selecionada */
		
		$(this).addClass('selected');
		
		/* Oculta todas as abas abertas */
		
		$(conteudos + ' li').hide();
		
		/* Exibe a aba que foi clicada */
		
		$(conteudos +  ' ' + $(this).attr('name')).show();
		
		/* Fim :D */
		
		return false;
		
	});
	
};


/*anchor home banner*/
$("#firstDiv").click(function(){
            $('html, body').animate({ scrollTop: $('#content').offset().top }, 'slow');
           
})

$("#content").click(function(){
    $('html,body').animate({
        scrollTop:$("#firstDiv").offset().top
    },'slow')
})


