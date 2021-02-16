<?
require_once("../classes/connection.php");
require_once("../YoutubeHelper.php");

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">

 <head>
 	<meta name="keywords" content="piano, online learning, ensino a distancia, piano classico, classical piano, materias, videos, aprendizado, video-aula, mozart, chopin, aprenda piano, aprender piano, tutorial piano" />
	<meta name="author" content="TY Interactive" />
    <meta property="og:title" content="lucaspiano.com" />
    <meta property="og:type" content="website" />
    <meta property="fb:app_id" content="563322483682752" />
    <link rel="shortcut icon" type="image/ico" href="http://www.lucaspiano.com/images/lucaspiano_logo.ico.png" />
    <meta property="fb:admin" content="pianolucas" />


    <!-- Estilos -->
	<link rel="stylesheet" href="../css/common.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../css/videobox.css" type="text/css" media="all" />

	<!-- Scripts -->
	<?require("../scripts.php"); ?>
        
    <script src="https://apis.google.com/js/plusone.js"> </script>
	
 </head>

<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '563322483682752',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>      
<style type="text/css">
#videos {margin:0 auto !important; padding:30px;}

/*Ytv Plugin*/
	#playlist-frame, 
	.description{		
		width: 920px;
		height: 400px;
		}
		
	.playlists .special{
	    position: absolute;
	    top: 50px;
	    left: 50%;
	    margin-left: 420px;
		}

	.playlists .ytv-list-header > a{
		-webkit-animation: pulse 2s infinite;
		-moz-animation: pulse 2s infinite;
		-o-animation: pulse 2s infinite;
		animation: pulse 2s infinite;
		}
		.playlists .ytv-list-header.ytv-playlist-open > a{
			-webkit-animation: none;
			-moz-animation: none;
			-o-animation: none;
			animation: none;
			}

	@-webkit-keyframes pulse {
	  0%   { background: rgba(255,255,255,0); }
	  50%  { background: rgba(255,255,255,0.1); }
	  100% { background: rgba(255,255,255,0); }
	}
	@-moz-keyframes pulse {
	  0%   { background: rgba(255,255,255,0); }
	  50%  { background: rgba(255,255,255,0.1); }
	  100% { background: rgba(255,255,255,0); }
	}
	@-o-keyframes pulse {
	  0%   { background: rgba(255,255,255,0); }
	  50%  { background: rgba(255,255,255,0.1); }
	  100% { background: rgba(255,255,255,0); }
	}
	@keyframes pulse {
	  0%   { background: rgba(255,255,255,0); }
	  50%  { background: rgba(255,255,255,0.1); }
	  100% { background: rgba(255,255,255,0); }
	}



</style>

<!--CONTENT-->

		<div id="videos">		

		<div class="videosContent">

			<h1 class="<?=$GLOBALS['LANG']?>"><?=TranslateItem("V&iacute;deos", "Videos", "V&iacute;deos")?></h1>


					<?
					$codigoVideo = $_GET['v'];
					$codigoPlaylist = $_GET['p'];
                    
                    if (isset($codigoPlaylist)) {

                    	$youtube = new YoutubeHelper();
						$playlist = $youtube->GetPlayListById($codigoPlaylist);

                		?>

                    	<h5><?=$playlist->Title?></h5>
                        <title>Lucas Piano - <?=$playlist->Title?></title>       
                        
                        <h6>PlayLists</h6> 
                             
                        <div id="playlist-frame"></div>
						<script>
                                                        
							window.onload = function(){
                                                 
                                window.controller = new YTV('playlist-frame', {
									playlist: '<?=$playlist->Id?>',
									accent: '#FFAC00',
                                    autoplay: true
								});
							};
						</script>                                                                                    
                    	
                        <!--span class="right"><!--?$video->ViewCount?> views</span-->
						<?                                                                                     
                    }
                    else {

						if (empty($codigoVideo)) {
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/videos/'>";
							exit();
						}

						//Busca o video no BD
						$query = "
								   SELECT
									  v.Codigo as CodigoVideo,
									  v.Url_".$GLOBALS['LANG']." as Url,
									  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,  
									  v.FileName,
									  v.FileName2,
									  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,
									  c.Codigo as CodigoCategoria
									FROM
									  Video v
									  INNER JOIN Categoria c
									  	ON c.Codigo = v.CodigoCategoria
									WHERE
	                                                                v.Codigo = '$codigoVideo'
									AND v.Url_".$GLOBALS['LANG']." IS NOT NULL
									LIMIT 1
									";
						$result = mysql_query($query);
						if (mysql_num_rows($result) == 0) {
							echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/videos/'>";
							exit();
						}

						while ($row = mysql_fetch_object($result))
						{
							$videoCode = strstr($row->Url, "v=");
							$videoCode = str_replace("v=", "", $videoCode);

							//Views
							$youtube = new YoutubeHelper();
							$video = $youtube->GetVideoDetails($videoCode);

							?>
							<h5><?=$row->TituloVideo?></h5>
	                        <title>Lucas Piano - <?=$row->TituloVideo?></title>       
	                        
	                        <h6><?=$row->NomeCategoria?></h6> 
	                                                                                                                 
	                    	<object width="700" height="400">
		                        <meta property="og:video" content="http://www.lucaspiano.com/videos/video.php?v=<?=$codigoVideo?>" />
		                        <meta property="og:url" content="http://www.lucaspiano.com/videos/video.php?v=<?=$codigoVideo?>" />

		                        <meta property="og:image" content="http://i1.ytimg.com/vi/<?=$codigoVideo?>/hqdefault.jpg" />
		                          
		                        <meta property="og:site_name" content="/videos/video.php?v=<?=$codigoVideo?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" /> 
		                        
		                        <meta property="og:description" content="Lucas Piano - <?=$row->TituloVideo?>" />
		                        
		                        <meta property="og:url" content="http://www.lucaspiano.com/videos/video.php?v=<?=$codigoVideo?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" />
		                            <param name="allowFullScreen" value="true"></param>
								<param name="allowscriptaccess" value="always"></param>
								<iframe width="700" height="400" src="https://www.youtube.com/embed/<?=$videoCode?>?rel=0&autoplay=1&mute=1&enablejsapi=1&iv_load_policy=3&controls=1&disablekb=1&egm=1&showinfo=0&loop=1&modestbranding=1&vq=hd1080" frameborder="0" allowfullscreen"></iframe>
							</object>

				<div>
	                        <span class="right"><?=$video->ViewCount?> views</span>
							                                                                                     
							<?
							if (!empty($row->FileName))
							{
							?>
							<div id="anexos" style="float:right; margin-right:5px; clear:both;">
								<span><strong><?=TranslateItem("Partitura", "Music Sheet", "Partitura")?>:&nbsp;</strong></span><a href="http://www.lucaspiano.com/content/files/<?=$row->FileName?>" target="_blank">download</a>
							</div>

							<?
							}												
							if (!empty($row->FileName2))
							{
							?>
							<div id="anexos" style="float:right; margin-right:5px; clear:both;">
								<span><strong><?=TranslateItem("Áudio", "Audio", "Audio")?>:&nbsp;</strong></span><a href="http://www.lucaspiano.com/content/files/<?=$row->FileName2?>" target="_blank">download</a>
							</div>

							<?
							}
						}
						mysql_free_result($result);
					}
					?>

				</div>


                        <br> </br><br></br> <br> </br>

							<h4><?=TranslateItem("Coment&aacute;rios", "Comments", "Coment&aacute;rios")?></h4>
						
							<div class="fb-comments" data-href="http://www.lucaspiano.com/videos/videobox.php?v=<?=$codigoVideo?>" data-num-posts="50" 
                                                             data-width="540" send_notification_uid="727291632" data-notify="true" data-colorscheme="light"></div>
                                                        
					
						    <div class="cutOffStripesContainer greyBg">
						        <div class="cutOffStripeTop"></div>&nbsp;
						        <div class="cutOffStripeBottom"></div>
						    </div>
		        	        		
			        		<div class="wrappedContent">	
				        		<!--h2>Comments</h2-->        		
			                                
				        		<script type= "text/javascript">
									function getYouTubeInfo() {
											$.ajax({
													url: "http://gdata.youtube.com/feeds/api/videos/<?=$videoCode?>?v=2&alt=json",
													dataType: "jsonp",
													success: function (data) { parseresults(data); }
											});
									}
	
									function parseresults(data) {
											var title = data.entry.title.$t;
			                                                                <h1>Titulo = <?=title?></h1>
											var description = data.entry.media$group.media$description.$t;
											var viewcount = data.entry.yt$statistics.viewCount;
											var author = data.entry.author[0].name.$t;
											$('#title').html(title);
											$('#description').html('<b>Description</b>: ' + description);
											$('#extrainfo').html('<b>Author</b>: ' + author + '<br/><br/><br/><b>Views</b>: ' + viewcount);
											getComments(data.entry.gd$comments.gd$feedLink.href + '&max-results=50&alt=json', 1);
									}
	
									function getComments(commentsURL, startIndex) {
											$.ajax({
													url: commentsURL + '&start-index=' + startIndex,
													dataType: "jsonp",
													success: function (data) {
													$.each(data.feed.entry, function(key, val) {												
															$('#comments').append('<dt><strong>' + val.author[0].name.$t + '</strong></dt>');
															$('#comments').append('<dd>' + val.content.$t + '</dd>');
													});
													if ($(data.feed.entry).size() == 50) { getComments(commentsURL, startIndex + 50); }
													}
											});
									}
	
									$(document).ready(function () {
											getYouTubeInfo();
									});						
								</script>
								<dl id="comments">                        
			                    </dl>					
							</div>
					
							<div class="cutOffStripesContainer greyBg">
						        <div class="cutOffStripeTop"></div>&nbsp;
						
						        <div class="cutOffStripeBottom"></div>
						    </div>
				
        		<!-- =Comment form -->

					</div>
			</div>

		</div>

		</div>
	

<!--Google analytics-->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6805686-2");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
