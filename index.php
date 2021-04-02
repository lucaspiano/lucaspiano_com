<?php
require_once __DIR__ . "/boostrap.php";

$meta = $staticData->get('meta');
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Lucas Piano | Official Website</title>

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="description" content="<?= $meta['description'] ?>" />
        <meta name="keywords" content="<?= implode(",", $meta['keywords']) ?>" />
        <meta name="author" content="TY Interactive" />

        <meta property="fb:app_id" content="<?= $meta['facebook']['app_id'] ?>" />
        <meta property="og:title" content="<?= $meta['facebook']['og_title'] ?>" />
        <meta property="og:description" content="<?= $meta['facebook']['og_description'] ?>" />
        <meta property="og:type" content="<?= $meta['facebook']['og_type'] ?>" />
        <meta property="og:url" content="<?= $meta['facebook']['og_url'] ?>" />
        <meta property="og:image" content="<?= $meta['facebook']['og_image'] ?>" />

        <link rel="shortcut icon" type="image/ico" href="https://www.lucaspiano.com/images/lucaspiano_logo.ico.png" />

        <!-- Estilos -->
        <link rel="stylesheet" href="css/common.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/home.css" type="text/css" media="all" />
        <link rel="stylesheet" href="css/animate.css" type="text/css" media="all" />

        <!--anchor-->
        <script type="text/javascript" src="https://www.lucaspiano.com/scripts/gentle_anchors_1.2.6.js"></script>

        <!-- Scripts -->
        <?php require_once "scripts.php" ?>
    </head>
    <body class="header-home">

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '563322483682752',
                xfbml: true,
                version: 'v2.3'
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

    <?php require_once "header.php" ?>

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
                            <?php
                            $youtube = new YoutubeHelper();
                            $result = $youtube->GetPlaylists(4);

                            foreach ($result as $playlist): ?>
                                <div class="videoItem">
                                    <a class="venobox-playlist" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?p=<?=$playlist->Id?>"><img src="<?=$playlist->Thumbnail?>"></a>
                                    <a class="venobox-playlist" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?p=<?=$playlist->Id?>"><?=$playlist->Title?></a><br>
                                    <span><?=$playlist->Total?> Videos</span>
                                    <span><a href="https://www.lucaspiano.com/videos/?category=1">PlayLists</a></span>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>

                    <div id="news">
                        <?= GetHeader("Latest Videos") ?>

                        <div id="ultimos-videos">
                            <h1><?= TranslateItem("ultimos Vídeos", "Latest Videos","últimos vidéos") ?></h1>
                            <?php
                                $query = "
                                    SELECT
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
                                    LIMIT 9
                                ";

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
                    <h1><?=TranslateItem("Fica Ligado","Stay Tuned","Quedate Atento")?></h1>
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

                <div id="stayTuned" style="display: ;">
                    <h1><?=TranslateItem("Seja patrocinador","Sponsorship","patrocinador")?></h1>
                    <div class="banner-patrocinio">
                        <div class="banner01">
                            <div class="icon">@lucaspiano</div>
                            <a href="https://www.patreon.com/lucaspiano/creators" class="btn-banner-patrocinio" target="_blank"><?=TranslateItem("Seja um patreon","Become a patreon","Ser uno patreon")?></a>
                        </div>
                        <div class="banner02">
                            <div class="icon">@lucaspiano</div>
                            <a href="https://www.paypal.com/donate?hosted_button_id=R7FGQ5VRX5LB4" class="btn-banner-patrocinio" target="_blank"><?=TranslateItem("faça uma doação","make a donation","Haz una donación")?></a>
                        </div>
                    </div>
                    <h2><?=TranslateItem("Voce podê participar da jornada musical do Lucas Piano e fazer parte de um pequeno grupo seleto e privilegiado de pessoas ganhando acesso a livestreams, acessos iniciais a projetos solo, aulas em video, chats e shout-outs personalizados e muito mais!","You can be a sponsor to Lucas Piano's journey and make part of a private and privileged small group of people gaining access to livestreams, early access to solo projects, video lessons, live chats and personalized shout outs and much more!","Puede ser un patrocinador del viaje de Lucas Piano y formar parte de un pequeño grupo privado y privilegiado de personas que obtienen acceso a transmisiones en vivo, acceso temprano a proyectos en solitario, lecciones en video, chats en vivo y gritos personalizados y mucho más.")?></h2>
                </div>
            </div>
        </div>

    </div>

    <!--FOOTER-->
    <?php require_once "footer.php" ?>

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
</html>