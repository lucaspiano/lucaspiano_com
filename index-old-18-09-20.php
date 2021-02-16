<?
require_once("classes/connection.php");
require_once("YoutubeHelper.php");

$useragent=$_SERVER['HTTP_USER_AGENT'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">
 <head>
 	<title>Lucas Piano | Official Website</title>
        
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

        
 	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Piano covers, music sheets, tutorials, exercises and everything related to music FOR FREE!!!" />
 	<meta name="keywords" content="piano, online learning, ensino a distancia, piano classico, classical piano, materias, videos, v�deo aula, piano tutorial, piano class, 
              aprenda a tocar, how to play, music sheets, sheets, piano music, keyboard, rock, jazz, blues, pop music, scales, escalas, como tocar, curso de piano, curso de teclado,
              pentatonic, gospel music, choir, chorus, dream theater, adele, jordan rudess, steve vai, joe satriani, yngwee malmsteen, quiet riot, brad brains, mountain, primus,
              meat loaf, fugazi, yes, lenny kravitz, black crowes, danzog misfits, rainbow, litaford, tool, king crimson, foreigner, whitesnake, the beatles, ufo, queensryche, 
              pixes, green day, ratt, marylin manson, hole, bon jovi, spinal tap, pat banatar, twisted sister, foo fighters, lynyrd skynyrd, living colour, megadeath, 
              rolling stones, the cult, steppenwolf, boston, ministry, jethro tull, new york dolls, bad company, anthrax, heart, white zombie, sonic youth, korn, faith no more, 
              thin lizzy, slayer, smashing pumpkins, janis joplin, scorpions, pantera, boyce avenue, pomplamoose, ciara, madonna, cindy lauper, stone temple pilots, neil young, mc5, 
              yardbird, rage agaisnt the machine, the doors, red hot chilli peppers, rush, motorhead, cheap trick, iron maiden, judas priest, deep purple, pearl jam, alice cooper, 
              the clash, ozzy osbourne, ramones, cream, pink floyd, sound garden, queen, kiss, sex pistols, aerosmith, guns n' roses, the who, van halen, nirvana, metallica, ac/dc, 
              jimmy hendrix, black sabbath, led zeppelin, aretha franklin, ray charles, elvis presley, sam cooke, john lennon, marvin gaye, bob dylan, steve wonder, james brown, 
              paul mccartney, little richard, roy orbison, al green, robert plant, mick jagger, tina turner, freddie mercury, bob marley, smokey robinson, johnny cash, international rock,
              piano tutorial, piano video, online learning, music learning, music sheets, hillsong, darlene zschech, diante do trono, aline barros, justin timberlake, rihanna, justin bieber,
              Psy, Israel Jewish music, Arabic music, Muslim music, Christian music, beethoven, mozart, chopin, liszt, brahms, grieg, rachmaninoff, debussy, tchaikovsky, richard wagner,
              saint saenz, richard clayderman, valentina lisitsa, lang lang, horowitz, rubinstein, zubi mehta, luciano pavaroti, placido domingo, lady gaga, madonna, cindy lauper, whitney
              houston, tiffany alvord, boyce avenue, pomplamoose music, ciara, coldplay, estudar m�sica, tutoriales" />
	<meta name="author" content="TY Interactive" />

        <meta property="fb:app_id" content="563322483682752" />
        <meta property="og:title" content="Lucas Piano" />
        <meta property="og:description" content="Piano, synths and violin covers, music sheets, tutorials, exercises and everything related to Music!" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.lucaspiano.com://www.lucaspiano.com" />
        <meta property="og:image" content="https://www.lucaspiano.com/images/bio-avatar.jpg" />
        
        
	<link rel="shortcut icon" type="image/ico" href="https://www.lucaspiano.com/images/lucaspiano_logo.ico.png" />

        
	<!--link rel="shortcut icon" type="image/ico" href="https://www.lucaspiano.com/images/favicon.ico" /-->

	<!-- Estilos -->
	<link rel="stylesheet" href="css/common.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/home.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" media="all" />
	
	<!--anchor-->
	<script type="text/javascript" src="https://www.lucaspiano.com/scripts/gentle_anchors_1.2.6.js"></script>

	<!-- Scripts -->
	<?require("scripts.php"); ?>

 </head>
 

<body class="header-home">
 
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '563322483682752',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
 var player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('ytplayer', {
        events: {
            'onReady': onPlayerReady
        }
    });
}

function onPlayerReady(event) {
    player.mute();
    player.playVideo();
}
   
</script>   
    
<? require("header.php"); ?> 
    
      
<div id="banner" class="bannerHome" style="text-align:center;">
	<div id="bannerContent">
		<a href="#contentPageIndex"><img src="https://www.lucaspiano.com/images/icon-scroll.png"></a>
	</div>
	<div id="title"><h1><img src="https://www.lucaspiano.com/images/logo.png"></h1></div>
		    
</div>

<div id="contentSeparator">
</div>
       
       <div id="navbar">
       		<div id="logo2">
				<a href="https://www.lucaspiano.com"><img src="https://www.lucaspiano.com/images/logo.png" /></a>
			</div>
       </div>
    
<!--CONTENT-->
<div id="contentPageIndex" style="margin-top:0px">
	<div id="content" style="margin-top: 135px;">
		<div id="home">
			<!--NEWS-->
			<div id="news-container">
			            <div class="main-video">
            		<iframe width="100%" height="731" 
                        src="https://www.youtube.com/embed/AVlNFjWy_SI?rel=0&mute=1&autoplay=1&enablejsapi=1&iv_load_policy=3&controls=1&disablekb=1&egm=1&showinfo=0&loop=1&modestbranding=1&vq=hd1080" 
                        frameborder="0" align="center" allowfullscreen></iframe>
                        </div>
                        
					<div class="news">
							<div id="playlists">
							
							<h1>Playlists</h1>
							<?
								$youtube = new YoutubeHelper();
								$result = $youtube->GetPlaylists(4);
			
								foreach ($result as $playlist) {
								?>
									<div class="videoItem">
                    <a class="venobox-playlist" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?p=<?=$playlist->Id?>"><img src="<?=$playlist->Thumbnail?>"></a>
										<a class="venobox-playlist" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?p=<?=$playlist->Id?>"><?=$playlist->Title?></a><br>
										<span><?=$playlist->Total?> Videos</span>
										<span><a href="https://www.lucaspiano.com/videos/?category=1">PlayLists</a></span>
									</div>
								<?
								}
			
							?>
							</div>
						</div>
			
						<div id="news">
							
							<?=GetHeader("Latest Videos")?>
			
							<div id="ultimos-videos">
							
                                                            
                                      <?  
                                                           
							$query = "  SELECT
										  v.Codigo as CodigoVideo,								  
										  v.Views,
										  v.Url_".$GLOBALS['LANG']." as Url,
										  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,
										  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,
										  c.Codigo as CodigoCategoria
										FROM
										  Video v
										  INNER JOIN Categoria c
										  	ON c.Codigo = v.CodigoCategoria
										WHERE (v.Url_".$GLOBALS['LANG']." IS NOT NULL AND v.Url_".$GLOBALS['LANG']." <> '')
										ORDER BY
										Data DESC								
										LIMIT 9";
							
							$result = mysql_query($query);
							$rows = mysql_num_rows($result);
                                                        
                                                        if ($rows == 0) {
								echo "<div align='center'><h3>";
								TranslateItem("Nenhum v�deo cadastrado no momento.", "No video available right now", "No hay videos disponibles en este momento");
								echo "</h3></div>";
							}
							else
							{
								while ($row = mysql_fetch_object($result))
								{
									$videoCode = strstr($row->Url, "v=");
									$videoCode = str_replace("v=", "", $videoCode);

									$video = $youtube->GetVideoDetails($videoCode);

									?>
                                                            
											<div class="videoItem">
                                                                                            
                        <a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>&vq=hd1080"><img src="https://img.youtube.com/vi/<?=$videoCode?>/hqdefault.jpg"></a>
												<a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><?=$row->TituloVideo?></a><br>
												<span><?=$video->ViewCount?> views</span>
												<span><a href="https://www.lucaspiano.com/videos/?category=<?=$row->CodigoCategoria?>"><?=$row->NomeCategoria?></a></span>
			  								</div>
			
									<?
								}
								mysql_free_result($result);
							}
							?>
							</div>
			
			
			
						</div>
					</div>
					

			<div id="stayTuned">

			<h1>Stay Tuned</h1>
			<!-- Place <div> tag where you want the feed to appear -->
			<div id="curator-feed-default-feed-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>
			<!-- The Javascript can be moved to the end of the html page before the </body> tag -->
			<script type="text/javascript">
			/* curator-feed-default-feed-layout */
			(function(){
			var i, e, d = document, s = "script";i = d.createElement("script");i.async = 1;
			i.src = "https://cdn.curator.io/published/8917fcaa-cb58-4894-85cb-32299e8ac7d3.js";
			e = d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
			})();
			</script>





				<!--<?=GetHeader("Stay Tuned")?>

				<div id="links" class="<?=$GLOBALS['LANG']?>">

					<ul>
						<li><a href="https://www.youtube.com/lucaspiano">Youtube</a></li>
						<li><a href="https://twitter.com/lucaspiano">Twitter</a></li>
						<li><a href="https://www.facebook.com/lucaspiano">Facebook</a></li>						
						<li><a href="https://www.instagram.com/lucaspiano">Instagram</a></li>
					</ul>

				</div>
	
               <div id="latest-tweets">
                    <a class="twitter-timeline" data-lang="en" data-width="210" data-height="320" data-theme="dark" float="right" data-link-color="#F5F8FA" href="https://twitter.com/lucaspiano">Tweets by @lucaspiano</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>-->
                            
                         

		
<!-- LightWidget WIDGET -->

<!--<script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script><iframe src="https://cdn.lightwidget.com/widgets/f82f95694baf522b987ebe1757f7ce25.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>-->


<!-- InstaWidget 
<a href="https://instawidget.net/v/user/lucaspiano" id="link-5b1ba04da6829d65152bc2100a317ff833f9484af250b31d919d0105171def1b">@lucaspiano</a>
<script src="https://instawidget.net/js/instawidget.js?u=5b1ba04da6829d65152bc2100a317ff833f9484af250b31d919d0105171def1b&width=210px"></script>
                   -->             
			
		</div>

		</div>
	</div>

</div>

<!--FOOTER-->
<?require("footer.php"); ?>



<!--menu sticky-->
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
<!--fim menu stcky-->



<!--Google analytics-->
<script type="text/javascript">
var gaJsHost = (("https:" === document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6805686-2");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
