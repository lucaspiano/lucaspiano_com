<?php
/** @var StaticDataHelper $staticData */
/** @var YoutubeHelper $youtubeHelper */
/** @var MySQLConnection $dbConnection */
/** @var array $config */

require_once __DIR__ . "/bootstrap.php";

$meta = $staticData->get('meta');

$sess_lang = $_REQUEST['lang'];

if (isset($sess_lang)) {
    $_SESSION['LUCASPIANO_LANG'] = $sess_lang;
}

if (isset($_SESSION['LUCASPIANO_LANG'])) {
    $GLOBALS['LANG'] = $_SESSION['LUCASPIANO_LANG'];
} else {
    $GLOBALS['LANG'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$playlists = $youtubeHelper->getPlaylists(4);

$sql = "
    SELECT
        v.Codigo as CodigoVideo,								  
        v.Views,
        v.Url_{$GLOBALS['LANG']} as Url,
        v.Titulo_{$GLOBALS['LANG']} as TituloVideo,
        c.Nome_{$GLOBALS['LANG']} as NomeCategoria,
        c.Codigo as CodigoCategoria
    FROM Video v
    INNER JOIN Categoria c ON c.Codigo = v.CodigoCategoria
    WHERE (v.Url_{$GLOBALS['LANG']} IS NOT NULL AND v.Url_{$GLOBALS['LANG']} <> '')
    ORDER BY Data DESC								
    LIMIT 9
";

$latestVideos = $dbConnection->execute($sql)->fetchAll();
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

        <link rel="shortcut icon" type="image/ico" href="<?= $config['baseUrl'] ?>/images/lucaspiano_logo.ico.png" />

        <!-- Estilos -->
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/common.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/home.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/animate.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/header.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/yt-master/ytv.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/venobox/venobox.css" type="text/css" media="all" />
        <link rel="stylesheet" href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" type="text/css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $config['baseUrl'] ?>/scripts/gentle_anchors_1.2.6.js" type="text/javascript"></script>
        <script src="<?= $config['baseUrl'] ?>/scripts/swfobject.js" type="text/javascript"></script>
        <script src="<?= $config['baseUrl'] ?>/yt-master/ytv.js" type="text/javascript"></script>
        <script src="<?= $config['baseUrl'] ?>/venobox/venobox.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).mouseup(function(e) {
                var container = $("#languageMenu");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });

            $(document).ready(function() {
                $('.venobox').venobox({
                    framewidth: '800px',
                    frameheight: '900px',
                    border: '10px',
                    bgcolor: '#999',
                    titleattr: 'data-title',
                    numeratio: true,
                    infinigall: true
                });

                $('.venobox-playlist').venobox({
                    framewidth: '1020px',
                    frameheight: '900px',
                    border: '10px',
                    bgcolor: '#999',
                    titleattr: 'data-title',
                    numeratio: true,
                    infinigall: true
                });

                $("#lnkChangeLang").click(function(){
                    $("#languageMenu").show();
                });

                $("ul.subnav").parent().append("<span></span>");

                $("ul.topnav li span").click(function() {
                    $(this).parent().find("ul.subnav").slideDown('fast').show();
                    $(this).parent().hover(function() {}, function() {
                        $(this).parent().find("ul.subnav").slideUp('slow');
                    });
                }).hover(function() {
                    $(this).addClass("subhover");
                }, function() {
                    $(this).removeClass("subhover");
                });
            });

            function linkTo(optVal) {
                if (optVal === "") return false;
                window.location='<?= $config['baseUrl'] ?>/songsheets/artists.php?Codigo='+optVal;
            }

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=461573680537774";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </head>
    <body class="header-home">
        <div id="fb-root"></div>

        <?php require_once "header.php" ?>

        <div id="banner" class="bannerHome" style="text-align:center;">
            <div id="bannerContent">
                <a href="#contentPageIndex">
                    <img src="<?= $config['baseUrl'] ?>/images/icon-scroll.png">
                </a>
            </div>
            <div id="title">
                <h1><img src="<?= $config['baseUrl'] ?>/images/logo.png"></h1>
            </div>
        </div>

        <div id="contentSeparator"></div>

        <div id="navbar">
            <div id="logo2">
                <a href="<?= $config['baseUrl'] ?>">
                    <img src="<?= $config['baseUrl'] ?>/images/logo.png" />
                </a>
            </div>
        </div>

        <!--CONTENT-->
        <div id="contentPageIndex" style="margin-top:0px">
            <div id="content" style="margin-top: 135px;">
                <div id="home">
                    <!--NEWS-->
                    <div id="news-container">
                        <div class="main-video">
                            <iframe width="100%" height="731" src="https://www.youtube.com/embed/AVlNFjWy_SI?rel=0&mute=1&autoplay=1&enablejsapi=1&iv_load_policy=3&controls=1&disablekb=1&egm=1&showinfo=0&loop=1&modestbranding=1&vq=hd1080" frameborder="0" align="center" allowfullscreen></iframe>
                        </div>

                        <div class="news">
                            <div id="playlists">
                                <h1>Playlists</h1>
                                <?php foreach ($playlists as $playlist): ?>
                                    <div class="videoItem">
                                        <a class="venobox-playlist" data-type="iframe" href="<?= $config['baseUrl'] ?>/videos/videobox.php?p=<?= $playlist->getId() ?>">
                                            <img alt="<?= $playlist->getTitle() ?>" src="<?= $playlist->getThumbnail() ?>">
                                        </a>
                                        <a class="venobox-playlist" data-type="iframe" href="<?= $config['baseUrl'] ?>/videos/videobox.php?p=<?= $playlist->getId() ?>">
                                            <?= $playlist->getTitle() ?>
                                        </a><br>
                                        <span><?= $playlist->getTotal() ?> Videos</span>
                                        <span><a href="<?= $config['baseUrl'] ?>/videos/?category=1">PlayLists</a></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div id="news">
                            <?= GetHeader("Latest Videos") ?>

                            <div id="ultimos-videos">
                                <h1><?= TranslateItem("ultimos Vídeos", "Latest Videos","últimos vidéos") ?></h1>
                                <?php if (!empty($latestVideos)): ?>
                                    <?php foreach ($latestVideos as $row): ?>
                                        <?php
                                        $videoCode = strstr($row->Url, "v=");
                                        $videoCode = str_replace("v=", "", $videoCode);
                                        $video = $youtubeHelper->GetVideoDetails($videoCode);
                                        ?>

                                        <div class="videoItem">
                                            <a class="venobox" data-type="iframe" href="<?= $config['baseUrl'] ?>/videos/videobox.php?v=<?=$row->CodigoVideo?>&vq=hd1080">
                                                <img src="https://img.youtube.com/vi/<?=$videoCode?>/hqdefault.jpg">
                                            </a>
                                            <a class="venobox" data-type="iframe" href="<?= $config['baseUrl'] ?>/videos/videobox.php?v=<?=$row->CodigoVideo?>">
                                                <?=$row->TituloVideo?>
                                            </a><br>
                                            <span><?=$video->ViewCount?> views</span>
                                            <span>
                                                <a href="<?= $config['baseUrl'] ?>/videos/?category=<?=$row->CodigoCategoria?>">
                                                    <?=$row->NomeCategoria?>
                                                </a>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div align='center'>
                                        <h3><?= TranslateItem(
                                                "Nenhum vídeo cadastrado no momento.",
                                                "No video available right now",
                                                "No hay videos disponibles en este momento"
                                            ) ?></h3>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div id="stayTuned">
                        <h1><?= TranslateItem("Fica Ligado","Stay Tuned","Quedate Atento") ?></h1>
                        <div id="curator-feed-default-feed-layout">
                            <a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a>
                        </div>
                    </div>

                    <div id="stayTuned" style="display: ;">
                        <h1><?= TranslateItem("Seja patrocinador","Sponsorship","patrocinador") ?></h1>
                        <div class="banner-patrocinio">
                            <div class="banner01">
                                <div class="icon">@lucaspiano</div>
                                <a href="https://www.patreon.com/lucaspiano/creators" class="btn-banner-patrocinio" target="_blank"><?= TranslateItem("Seja um patreon","Become a patreon","Ser uno patreon") ?></a>
                            </div>
                            <div class="banner02">
                                <div class="icon">@lucaspiano</div>
                                <a href="https://www.paypal.com/donate?hosted_button_id=R7FGQ5VRX5LB4" class="btn-banner-patrocinio" target="_blank"><?= TranslateItem("faça uma doação","make a donation","Haz una donación") ?></a>
                            </div>
                        </div>
                        <h2><?= TranslateItem("Voce podê participar da jornada musical do Lucas Piano e fazer parte de um pequeno grupo seleto e privilegiado de pessoas ganhando acesso a livestreams, acessos iniciais a projetos solo, aulas em video, chats e shout-outs personalizados e muito mais!","You can be a sponsor to Lucas Piano's journey and make part of a private and privileged small group of people gaining access to livestreams, early access to solo projects, video lessons, live chats and personalized shout outs and much more!","Puede ser un patrocinador del viaje de Lucas Piano y formar parte de un pequeño grupo privado y privilegiado de personas que obtienen acceso a transmisiones en vivo, acceso temprano a proyectos en solitario, lecciones en video, chats en vivo y gritos personalizados y mucho más.") ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!--FOOTER-->
        <?php require_once "footer.php" ?>

        <script src="<?= $config['baseUrl'] ?>/scripts/toggle.js" type="text/javascript"></script>
        <script src="<?= $config['baseUrl'] ?>/buttons.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/plusone.js"></script>

        <script type="text/javascript">
            $(window).load(function() {
                $('.overlay').fadeOut();
            });

            $(document).ready(function(){
                $(".togglebox1").hide();

                $("div").click(function() {
                    $(this).next(".togglebox1").slideToggle("slow");
                    return true;
                });
            });

            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/platform.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();

            stLight.options({publisher: "6b23f4d5-7a38-47de-9d07-6766dee05178"});

            /* curator-feed-default-feed-layout */
            (function(){
                var i, e, d = document, s = "script";i = d.createElement("script");i.async = 1;
                i.src = "https://cdn.curator.io/published/8917fcaa-cb58-4894-85cb-32299e8ac7d3.js";
                e = d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
            })();

            window.onscroll = function() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                } else {
                    navbar.classList.remove("sticky");
                }
            };

            var gaJsHost = (("https:" === document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            try {
                var pageTracker = _gat._getTracker("UA-6805686-2");
                pageTracker._trackPageview();
            } catch(err) {}

            window.fbAsyncInit = function() {
                FB.init({
                    appId: '<?= $meta['facebook']['app_id'] ?>',
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

            var acc = document.getElementsByClassName("accordion");
            var i;
            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
        </script>
    </body>
</html>