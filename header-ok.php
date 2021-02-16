<script>
// on load finished
$(window).load(function() {
    // select element and fade it out
    $('.overlay').fadeOut();
});
</script>


        <!--menu toggle-->
<script src="https://www.lucaspiano.com/scripts/toggle.js" type="text/javascript"></script>


<script type="text/javascript">
$(document).ready(function(){
//Ocultar o toogle no carregamento da página
$(".togglebox1").hide();
//Exibir o conteúdo quando clicar sobre o H2
$("div").click(function(){
//Ocultar o conteúdo quando clicar sobre o H2.
$(this).next(".togglebox1").slideToggle("slow");
return true;
});
});
</script>
        <!--menu toggle fim-->



<?
//LANGUAGE
$current_url = $_SERVER['REQUEST_URI'];
$current_url = str_replace('?lang=pt','',$current_url);
$current_url = str_replace('?lang=en','',$current_url);
$current_url = str_replace('?lang=es','',$current_url);
$current_url = str_replace('&lang=pt','',$current_url);
$current_url = str_replace('&lang=en','',$current_url);
$current_url = str_replace('&lang=es','',$current_url);

if (strpos($current_url,'?') !== false)
    $current_url = $current_url . "&";	
else
	$current_url = $current_url . "?";
	
$sess_lang = $_REQUEST['lang'];
//echo "<script>alert('".$sess_lang."');</script>";
if (isset($sess_lang))
	$_SESSION['LUCASPIANO_LANG'] = $sess_lang;

	
if (isset($_SESSION['LUCASPIANO_LANG']))
{
	$GLOBALS['LANG'] = $_SESSION['LUCASPIANO_LANG'];
}
else
{
	$GLOBALS['LANG'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
}
 
function TranslateItem($pt, $en, $es)
{
	switch ($GLOBALS['LANG']){
		case "pt":
			echo($pt);
			break;
		case "en":
			echo($en);
			break;
		case "es":
			echo($es);
			break;
		default:
			echo($en);
			break;
	}	
}

function GetHeader($text)
{
	echo("<h1 class=\"".$GLOBALS['LANG']."\">".$text."</h1>");	
}

?>

<!--HEADER-->
<script src="https://apis.google.com/js/plusone.js"> </script>
<style type="text/css">
	#languageMenu
	{
		position:absolute;
		top:30px;
		right:2px;
		background:#333;
		display:block;
		padding:15px;
		border:1px solid #444;
		z-index:9999;
		display:none;
		
	}
	
	#languageMenu ul
	{		
		list-style:none;
		margin:0;
		padding:0;
	}
	#languageMenu ul li
	{
		display:inline-block;
	}
	
	#languageMenu ul li a
	{
		display:inline-block;
		padding:3px 6px;
		background:#555;
		color:#eaeaea;		
	}
	
	#languageMenu ul li a:hover
	{
		text-decoration:none;
		background:#FFAC00;
		color:#fff;
	}
	
	
	
	

	
	
</style>
<div class="overlay">
  <div><img src="https://www.lucaspiano.com/images/loading.gif" width="66" height="66" /></div></div>


<div id="header">
	<div id="headerContent">
		<div id="logo">
			<a href="https://www.lucaspiano.com"><img src="https://www.lucaspiano.com/images/logo.png" /></a>
		</div>
            
                <div id="facebook-like">
                    <div class="fb-like" data-href="https://www.facebook.com/lucaspiano" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>		
                </div>
            
                <!--div id ="linkedin-follow">
                    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                    <script type="IN/MemberProfile" data-id="https://www.linkedin.com/in/lucaspiano" data-format="hover" data-related="true"></script>
                </div-->
            
                
                <!--div id="facebook-follow">        
                    <div class="fb-follow" data-href="http://www.facebook.com/lucaspiano" data-colorscheme="dark" data-layout="button_count" data-show-faces="true"></div>
                </div-->
                
                <div id="youtube-subscribe">
                    <div class="g-ytsubscribe" data-channel="lucaspiano" data-layout="default" data-count="default" data-theme="dark"></div>
                </div>
                
              <!--script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script type="IN/MemberProfile" data-id="https://www.linkedin.com/in/lucaspiano" data-format="hover" data-related="false"></script-->
                
		<div id="languageSelector">
			[<?=TranslateItem("Portugu&ecirc;s","English","Espa&ntilde;ol")?>]<a id="lnkChangeLang" href="#">&nbsp;<?=TranslateItem("Mudar","Change","Cambiar")?></a>
		</div>
		
		<div id="languageMenu">
			<ul>
				<li><a href="<?=$current_url?>lang=pt">Portugu&ecirc;s</a></li>
				<li><a href="<?=$current_url?>lang=en">English</a></li>
				<li><a href="<?=$current_url?>lang=es">Espa&ntilde;ol</a></li>
			</ul>
		</div>

		<!--<div id="menu">
		<ul class="topnav">
            <li><a href="http://www.lucaspiano.com/bio">Bio</a></li>
            <li><a href="http://www.lucaspiano.com/videos">Videos</a></li>
            <li><a href="http://lucaspiano.teachable.com"><?=TranslateItem("Conservatorio","Conservatory","Conservatorio")?></a></li>
            <li><a href="http://www.lucaspiano.com/store"><?=TranslateItem("Loja","Store","Tienda")?></a></li>
            <li><a href="http://www.lucaspiano.com/contact"><?=TranslateItem("Contato","Contact","Contacto")?></a></li>
        </ul>

		</div>-->
        
        

        
        
        
        <!---////////////novo menu////////////////////---> 
        <nav id="primary_nav_wrap">
<ul>
  <!--<li class="current-menu-item">-->
  <!--<a href="http://www.lucaspiano.com/#">Home</a></li>-->
  <!-- <li><a href="#">Menu 1</a>
    <ul>
      <li><a href="#">Sub Menu 1</a></li>
      <li><a href="#">Sub Menu 2</a></li>
      <li><a href="#">Sub Menu 3</a></li>
      <li><a href="#">Sub Menu 4</a>
        <ul>
          <li><a href="#">Deep Menu 1</a>
            <ul>
              <li><a href="#">Sub Deep 1</a></li>
              <li><a href="#">Sub Deep 2</a></li>
              <li><a href="#">Sub Deep 3</a></li>
                <li><a href="#">Sub Deep 4</a></li>
            </ul>
          </li>
          <li><a href="#">Deep Menu 2</a></li>
        </ul>
      </li>
      <li><a href="#">Sub Menu 5</a></li>
    </ul>
  </li>-->
  <li><a href="#"><?=TranslateItem("Sobre","About","Acerca")?></a>
    <ul>
      <li><a href="https://www.lucaspiano.com/bio">Bio</a></li>
      <li><a href="https://www.lucaspiano.com/contact"><?=TranslateItem("Contato","Contact","Contacto")?></a></li>
    </ul>
  </li>
  <li><a href="#"><?=TranslateItem("Mídia","Media","Media")?></a>
    <ul>
      <li><a href="https://www.lucaspiano.com/videos"><?=TranslateItem("Vídeos","Videos","Vídeos")?></a></li>
      <li><a href="https://www.lucaspiano.com/discography"><?=TranslateItem("Discografia","Discography","Discografia")?></a></li>
    </ul>
  </li>
  <li><a href="https://www.lucaspiano.com/conservatory"><?=TranslateItem("Conservatório","Conservatory","Conservatorio")?></a></li>
  <li><a href="https://store.lucaspiano.com"><?=TranslateItem("Loja","Store","Tienda")?></a></li>
</ul>
</nav>
      <!--/*///////////////////////////////*/-->  
      
<!--/*///////////menu responsivo////////*/--> 
<h2 id="p1"><img src="https://lucaspiano.com/images/haburger.png" width="31"></h2>
<div class="togglebox1" style="">
                <div class="block">
                        <div class="menu2">
                            <ul>
 							  <li><a href="#"><?=TranslateItem("Sobre","About","Acerca")?></a></li>
                              <li><a href="https://www.lucaspiano.com/bio">///Bio</a></li>
                              <li><a href="https://www.lucaspiano.com/contact"><?=TranslateItem("///Contato","///Contact","///Contacto")?></a></li> 
                              <li><a href="#"><?=TranslateItem("Mídia","Media","Media")?></a></li>
                              <li><a href="https://www.lucaspiano.com/videos"><?=TranslateItem("///Vídeos","///Videos","///Vídeos")?></a></li>
							  <li><a href="https://www.lucaspiano.com/discography"><?=TranslateItem("///Discografia","///Discography","///Discografia")?></a></li>
							  <li><a href="https://www.lucaspiano.com/conservatory"><?=TranslateItem("Conservatório","Conservatory","Conservatorio")?></a></li>
                              <li><a href="https://store.lucaspiano.com"><?=TranslateItem("Loja","Store","Tienda")?></a></li>
                            </ul>     
                       </div>
                </div>
    		</div>
      <!--/*///////////////////////////////*/-->      
      
      
<style>      
 #primary_nav_wrap
{
	margin-top: 27px;

    position: absolute;
    right: 0px;
}

#primary_nav_wrap ul
{
	list-style:none;
	position:relative;
	float:left;
	margin:0;
	padding:0
}

#primary_nav_wrap > ul > li:before {
    content: "|";
    margin-top: 9px;
    position: absolute;
}

#primary_nav_wrap > ul > li:first-child:before{
	content:"";
}

#primary_nav_wrap > ul > li > ul > li:before{
	content:"";

}


#primary_nav_wrap ul a
{
	display: block;
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    font-size: 12px;
    line-height: 32px;
    padding: 0 15px;
	font-family:"HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif
}



#primary_nav_wrap ul a:hover{
	color: #FFAC00;
}

#primary_nav_wrap ul li
{
	position:relative;
	float:left;
	margin:0;
	padding:0
}

#primary_nav_wrap ul li.current-menu-item
{
	background: #060606;
}

#primary_nav_wrap ul li:hover
{
	background: transparent;
}

#primary_nav_wrap ul ul
{
	display:none;
	position:absolute;
	top:100%;
	left:0;
	background:#060606;
	padding:0
}

#primary_nav_wrap ul ul li
{
	float:none;
	width:200px
}

#primary_nav_wrap ul ul a
{
	line-height:120%;
	padding:10px 15px
}

#primary_nav_wrap ul ul ul
{
	top:0;
	left:100%
}

#primary_nav_wrap ul li:hover > ul
{
	display:block
}
</style>
      
      
      
      <!--/-////////////////////////////////--->

	</div>
</div>
