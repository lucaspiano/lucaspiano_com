<?php
/** @var StaticDataHelper $staticData */
/** @var YoutubeHelper $youtubeHelper */
/** @var array $config */

require_once __DIR__ . "/../bootstrap.php";

$meta = $staticData->get('meta');

$current_url = $_SERVER['REQUEST_URI'];
$current_url = str_replace('?lang=pt','',$current_url);
$current_url = str_replace('?lang=en','',$current_url);
$current_url = str_replace('?lang=es','',$current_url);
$current_url = str_replace('&lang=pt','',$current_url);
$current_url = str_replace('&lang=en','',$current_url);
$current_url = str_replace('&lang=es','',$current_url);

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
} else {
    $GLOBALS['LANG'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
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
    echo "<h1 class=\"".$GLOBALS['LANG']."\">{$text}</h1>";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="description" content="<?= $meta['description'] ?>" />
    <meta name="keywords" content="<?= implode(",", $meta['keywords']) ?>" />
    <meta name="author" content="TY Interactive" />

    <meta property="fb:app_id" content="<?= $meta['facebook']['app_id'] ?>" />
    <meta property="fb:admin" content="<?= $meta['facebook']['fb_admin'] ?>" />
    <meta property="og:title" content="<?= $meta['facebook']['og_title'] ?>" />
    <meta property="og:description" content="<?= $meta['facebook']['og_description'] ?>" />
    <meta property="og:type" content="<?= $meta['facebook']['og_type'] ?>" />
    <meta property="og:url" content="<?= $meta['facebook']['og_url'] ?>" />
    <meta property="og:image" content="<?= $meta['facebook']['og_image'] ?>" />

    <link rel="shortcut icon" type="image/ico" href="<?= $config['baseUrl'] ?>/images/lucaspiano_logo.ico.png" />

    <!-- Estilos -->
    <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/common.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/css/videobox.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/yt-master/ytv.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/venobox/venobox.css" type="text/css" media="all" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= $config['baseUrl'] ?>/yt-master/ytv.js" type="text/javascript"></script>
    <script src="<?= $config['baseUrl'] ?>/venobox/venobox.min.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/plusone.js"> </script>
</head>
<body>

<!--CONTENT-->
<div id="videos">
    <div class="videosContent">
        <h1 class="<?=$GLOBALS['LANG']?>">
            <?= TranslateItem("V&iacute;deos", "Videos", "V&iacute;deos") ?>
        </h1>

        <?php
        $codigoVideo = $_GET['v'];
        $codigoPlaylist = $_GET['p'];

        if (isset($codigoPlaylist)) {
            $playlist = $youtubeHelper->GetPlayListById($codigoPlaylist);
        ?>

            <h5><?= $playlist->getTitle() ?></h5>
            <title>Lucas Piano - <?= $playlist->getTitle() ?></title>

            <h6>PlayLists</h6>

            <div id="playlist-frame"></div>
            <script>
                window.onload = function(){
                    window.controller = new YTV('playlist-frame', {
                        playlist: '<?= $playlist->getId() ?>',
                        accent: '#FFAC00',
                        autoplay: true
                    });
                };
            </script>

            <!--span class="right"><!-?$video->ViewCount?> views</span-->
        <?
        }
        else {

        if (empty($codigoVideo)) {
            echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL={$config['baseUrl']}/videos/'>";
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
            echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL={$config['baseUrl']}/videos/'>";
            exit();
        }

        while ($row = mysql_fetch_object($result)):
            $videoCode = strstr($row->Url, "v=");
            $videoCode = str_replace("v=", "", $videoCode);

            // Views
            $video = $youtubeHelper->getVideoDetails($videoCode);

            ?>
            <h5><?= $row->TituloVideo ?></h5>
            <title>Lucas Piano - <?= $row->TituloVideo ?></title>
            <h6><?= $row->NomeCategoria ?></h6>

            <object width="700" height="400">
                <meta property="og:video" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?=$codigoVideo?>" />
                <meta property="og:url" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?=$codigoVideo?>" />
                <meta property="og:image" content="http://i1.ytimg.com/vi/<?=$codigoVideo?>/hqdefault.jpg" />
                <meta property="og:site_name" content="/videos/video.php?v=<?=$codigoVideo?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" />
                <meta property="og:description" content="Lucas Piano - <?=$row->TituloVideo?>" />
                <meta property="og:url" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?=$codigoVideo?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" />

                <param name="allowFullScreen" value="true">
                <param name="allowscriptaccess" value="always">
                <iframe width="700" height="400" src="https://www.youtube.com/embed/<?=$videoCode?>?rel=0&autoplay=1&mute=1&enablejsapi=1&iv_load_policy=3&controls=1&disablekb=1&egm=1&showinfo=0&loop=1&modestbranding=1&vq=hd1080" frameborder="0" allowfullscreen"></iframe>
            </object>

            <span class="right"><?= $video->getViewCount()?> views</span>

            <?php if (!empty($row->FileName)): ?>
                <div id="anexos" style="float:right; margin-right:5px; clear:both;">
                    <span><strong><?=TranslateItem("Partitura", "Music Sheet", "Partitura")?>:&nbsp;</strong></span><a href="<?= $config['baseUrl'] ?>/content/files/<?=$row->FileName?>" target="_blank">download</a>
                </div>

            <?php endif; ?>

            <?php if (!empty($row->FileName2)): ?>
                <div id="anexos" style="float:right; margin-right:5px; clear:both;">
                    <span><strong><?=TranslateItem("�udio", "Audio", "Audio")?>:&nbsp;</strong></span><a href="<?= $config['baseUrl'] ?>/content/files/<?=$row->FileName2?>" target="_blank">download</a>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php  mysql_free_result($result) ?>
    <?php } ?>

        <br> </br><br></br> <br> </br>

        <h4><?= TranslateItem("Coment&aacute;rios", "Comments", "Coment&aacute;rios") ?></h4>

        <div class="fb-comments" data-href="<?= $config['baseUrl'] ?>/videos/videobox.php?v=<?=$codigoVideo?>" data-num-posts="50" data-width="540" send_notification_uid="727291632" data-notify="true" data-colorscheme="light"></div>

        <div class="cutOffStripesContainer greyBg">
            <div class="cutOffStripeTop"></div>&nbsp;
            <div class="cutOffStripeBottom"></div>
        </div>

        <div class="wrappedContent">
            <!--h2>Comments</h2-->
            <script type= "text/javascript">
                function getYouTubeInfo() {
                    $.ajax({
                        url: "http://gdata.youtube.com/feeds/api/videos/<?= $videoCode ?>?v=2&alt=json",
                        dataType: "jsonp",
                        success: function (data) { parseresults(data); }
                    });
                }

                function parseresults(data) {
                    var title = data.entry.title.$t;
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
            <dl id="comments"></dl>
        </div>

        <div class="cutOffStripesContainer greyBg">
            <div class="cutOffStripeTop"></div>&nbsp;
            <div class="cutOffStripeBottom"></div>
        </div>
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
</html>