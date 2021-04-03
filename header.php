<?php

$current_url = $_SERVER['REQUEST_URI'];
$current_url = str_replace('?lang=pt','', $current_url);
$current_url = str_replace('?lang=en','', $current_url);
$current_url = str_replace('?lang=es','', $current_url);
$current_url = str_replace('&lang=pt','', $current_url);
$current_url = str_replace('&lang=en','', $current_url);
$current_url = str_replace('&lang=es','', $current_url);

$current_url = $current_url . "?";

if (strpos($current_url,'?') !== false) {
    $current_url = $current_url . "&";
}

$sess_lang = $_REQUEST['lang'];

if (isset($sess_lang)) {
    $_SESSION['LUCASPIANO_LANG'] = $sess_lang;
}

if (isset($_SESSION['LUCASPIANO_LANG'])) {
	$GLOBALS['LANG'] = $_SESSION['LUCASPIANO_LANG'];
} else  {
    $GLOBALS['LANG'] = 'en';

	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
	    $GLOBALS['LANG'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	}
}
 
function TranslateItem($pt, $en, $es) {
	switch ($GLOBALS['LANG']) {
		case "pt":
			echo $pt;
			break;
		case "es":
			echo $es;
			break;
		default:
			echo $en;
			break;
	}	
}

function GetHeader($text) {
	echo "<h1 class='{$GLOBALS['LANG']}'>{$text}</h1>";
}
?>

<!--HEADER-->
<div class="overlay">
  <div><img src="https://www.lucaspiano.com/images/loading_nv.gif" width="66" height="66" /></div>
</div>

<div id="header">
	<div id="headerContent">
		<div id="logo">
			<a href="https://www.lucaspiano.com">
                <img src="https://www.lucaspiano.com/images/logo.png" />
            </a>
		</div>
                           
        <div id="youtube-subscribe">
            <div class="g-ytsubscribe" data-channel="lucaspiano" data-layout="default" data-count="default" data-theme="dark"></div>
        </div>

        <div id="facebook-like">
            <div class="fb-like" data-href="https://www.facebook.com/lucaspiano" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>

       <div id ="spotify-follow">
           <iframe src="https://open.spotify.com/follow/1/?uri=spotify:artist:3XI7IGAtIHZVHafs6FiDVp&size=basic&theme=dark&show-count=0" width="100" height="25" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>
       </div>

       <!--div id ="artistco-follow">
           <a href="https://www.artistco.com/artist/lucaspiano"><img src="http://www.lucaspiano.com/images/artistco-icon.png" title="Support on Artistco"></a>
       </div-->

       <!--div id ="tiktok-follow">
           <a href="https://www.tiktok.com/@lucaspiano"><img src="http://www.lucaspiano.com/images/tiktok.png" title="Follow on TikTok"></a>
       </div>-->

		<div id="languageSelector">
			[<?=TranslateItem("Portugu&ecirc;s","English","Espa&ntilde;ol")?>]<a id="lnkChangeLang" href="#">&nbsp;<?=TranslateItem("Mudar","Change","Cambiar")?></a>
		</div>
		
		<div id="languageMenu">
			<ul>
				<li><a href="<?= $current_url ?>lang=pt">Portugu&ecirc;s</a></li>
				<li><a href="<?= $current_url ?>lang=en">English</a></li>
				<li><a href="<?= $current_url ?>lang=es">Espa&ntilde;ol</a></li>
			</ul>
		</div>

		<!--<div id="menu">
		<ul class="topnav">
            <li><a href="http://www.lucaspiano.com/bio/">Bio</a></li>
            <li><a href="http://www.lucaspiano.com/videos/">Videos</a></li>
            <li><a href="http://lucaspiano.teachable.com/"><?=TranslateItem("Conservatorio","Conservatory","Conservatorio")?></a></li>
            <li><a href="http://www.lucaspiano.com/store/"><?=TranslateItem("Loja","Store","Tienda")?></a></li>
            <li><a href="http://www.lucaspiano.com/contact/"><?=TranslateItem("Contato","Contact","Contacto")?></a></li>
        </ul>

		</div>-->
        <!---////////////novo menu////////////////////---> 
        <nav id="primary_nav_wrap" >
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
  <li><a href="#"><?=TranslateItem("Sobre","About","Acerca")      ?></a>
    <ul>
      <li><a href="https://www.lucaspiano.com/bio/">Bio</a></li>
      <li><a href="https://www.lucaspiano.com/contact/"><?=TranslateItem("Contato","Contact","Contacto")?></a></li>
    </ul>
  </li>
  <li><a href="#"><?=TranslateItem("Mídia","Media","Media")?></a>
    <ul>
      <li><a href="https://www.lucaspiano.com/videos/"><?=TranslateItem("Vídeos","Videos","Vídeos")?></a></li>
      <li><a href="https://www.lucaspiano.com/discography/"><?=TranslateItem("Discografia","Discography","Discografia")?></a></li>
      <li><a href="#"><?=TranslateItem("Endorsements","Endorsements","Endorsements")?></a></li>
    </ul>
  </li>
  <!-- <li><a href="https://lucaspiano.teachable.com" target="_blank" ><?=TranslateItem("Conservatorio","Conservatory","Conservatorio")?></a></li-->
   <li><a href="https://www.lucaspiano.com/conservatory/"><?=TranslateItem("Conservatório","Conservatory","Conservatorio")?></a></li>
   <!--li><a href="https://store.lucaspiano.com"><?=TranslateItem("Loja","Store","Tienda")?></a></li--> 
   <li><a href="https://lucaspiano.bigcartel.com/" target="_blank" ><?=TranslateItem("Loja","Store","Tienda")?></a></li>
 </ul>
 </nav>
      <!--/*///////////////////////////////*/-->  
      
 <!--/*///////////menu responsivo////////*/--> 
 <h2 id="p1">
     <img src="https://lucaspiano.com/images/haburger.png" width="31">
 </h2>
 <div class="togglebox1" style="display:none">

 <ul>
 <button class="accordion"><?=TranslateItem("Sobre","About","Acerca")?></button>
 <li class="panel">
                <ul>
                <li><p><a href="https://www.lucaspiano.com/bio/">Bio</a><p></li>
                <li><p><a href="https://www.lucaspiano.com/contact/"><?=TranslateItem("Contato","Contact","Contacto")?></a></p></li>
                </ul>
 </li>
 <button class="accordion"><?=TranslateItem("Mídia","Media","Media")?></button>
 <li class="panel">
                <ul>
                <li><p><a href="https://www.lucaspiano.com/videos/"><?=TranslateItem("Vídeos","Videos","Vídeos")?></a></p></li>
				<li><p><a href="https://www.lucaspiano.com/discography/"><?=TranslateItem("Discografia","Discography","Discografia")?></a></p></li>
                <li><p><a href="#"><?=TranslateItem("Endorsements","Endorsements","Endorsements")?></a></p></li>
                </ul>
 </li>
 <button  class="accordion" onclick="window.location.href='https://www.lucaspiano.com/conservatory'"><?=TranslateItem("Conservatório","Conservatory","Conservatorio")?></button>
 <!--<li class="panel">
                <ul>
                <li><p><a href="url">link text</a></p></li>
        		<li><p><a href="url">link text</a></p></li>
        		<li><p><a href="url">link text</a></p></li>
                </ul>
 </li>-->
 <button  class="accordion" onclick="window.location.href='https://store.lucaspiano.com/'"><?=TranslateItem("Loja","Store","Tienda")?></button>
 <!--<li class="panel">
                <ul>
                <li><p><a href="url">link text</a></p></li>
        		<li><p><a href="url">link text</a></p></li>
        		<li><p><a href="url">link text</a></p></li>
                </ul>
 </li>-->
 </ul>  
 </div>
	</div>
</div>
