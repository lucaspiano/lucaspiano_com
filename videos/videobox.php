<?php
/** @var StaticDataHelper $staticData */
/** @var YoutubeHelper $youtubeHelper */
/** @var MySQLConnection $dbConnection */
/** @var array $clientSecret */
/** @var array $config */

require_once __DIR__ . "/../bootstrap.php";

$sess_lang = $_REQUEST['lang'];

if (isset($sess_lang)) {
    $_SESSION['LUCASPIANO_LANG'] = $sess_lang;
}

if (isset($_SESSION['LUCASPIANO_LANG'])) {
    $GLOBALS['LANG'] = $_SESSION['LUCASPIANO_LANG'];
} else {
    $GLOBALS['LANG'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$codigoVideo = filter_input(INPUT_GET, 'v', FILTER_SANITIZE_STRING);
$codigoPlaylist = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_STRING);

$playlist = null;
$videoList = [];

if ($codigoPlaylist) {
    $playlist = $youtubeHelper->getPlayListById($codigoPlaylist);

    $sql = "
        SELECT
            v.Codigo as CodigoVideo,
            v.Url_{$GLOBALS['LANG']} as Url,
            v.Titulo_{$GLOBALS['LANG']} as TituloVideo,  
            v.FileName,
            v.FileName2,
            c.Nome_{$GLOBALS['LANG']} as NomeCategoria,
            c.Codigo as CodigoCategoria
        FROM Video AS v
        INNER JOIN Categoria c ON c.Codigo = v.CodigoCategoria
    ";

    $i = 0;

    foreach ($playlist->getVideosCode() as $videoCode) {
        $clause = ($i === 0 ? "WHERE" : "OR");
        $sql .= " {$clause} v.Url_{$GLOBALS['LANG']} LIKE '%{$videoCode}%'";
        $i++;
    }

    $videoList = $dbConnection
        ->execute($sql)
        ->fetchAll();

    if (!$codigoVideo) {
        $codigoVideo = (int)$videoList[0]->CodigoVideo;
    }
}

if (!$codigoVideo) {
    echo 'Bad request.';
    die;
}

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

$sql = "
    SELECT
      v.Codigo as CodigoVideo,
      v.Url_{$GLOBALS['LANG']} as Url,
      v.Titulo_{$GLOBALS['LANG']} as TituloVideo,  
      v.FileName,
      v.FileName2,
      c.Nome_{$GLOBALS['LANG']} as NomeCategoria,
      c.Codigo as CodigoCategoria
    FROM Video AS v
    INNER JOIN Categoria c ON c.Codigo = v.CodigoCategoria
    WHERE v.Codigo = :codigoVideo
    AND v.Url_{$GLOBALS['LANG']} IS NOT NULL
";

$currentVideo = $dbConnection->execute($sql, [':codigoVideo' => $codigoVideo])->fetchOne();

if (!$currentVideo) {
    header("Location: {$config['baseUrl']}");
    die;
}

$videoCode = strstr($currentVideo->Url, "v=");
$videoCode = str_replace("v=", "", $videoCode);
$video = $youtubeHelper->getVideoDetails($videoCode);
$comments = $video->getComments();
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
    <link rel="stylesheet" href="<?= $config['baseUrl'] ?>/venobox/venobox.css" type="text/css" media="all" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= $config['baseUrl'] ?>/venobox/venobox.min.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/plusone.js"></script>
    <script src="https://apis.google.com/js/api.js"></script>
</head>
<body onload="handleClientLoad()">
<div id="videos">
    <div class="videosContent">
        <h1 class="<?= $GLOBALS['LANG'] ?>">
            <?= TranslateItem("Vídeos", "Videos", "Vídeos") ?>
        </h1>

        <div class="container">
            <div class="player">
                <h5><?= $currentVideo->TituloVideo ?></h5>
                <title>Lucas Piano - <?= $currentVideo->TituloVideo ?></title>
                <h6><?= $currentVideo->NomeCategoria ?></h6>

                <div class="addthis_inline_share_toolbox_45mf"></div>

                <object width="700" height="400">
                    <meta property="og:video" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?= $codigoVideo ?>" />
                    <meta property="og:url" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?= $codigoVideo ?>" />
                    <meta property="og:image" content="http://i1.ytimg.com/vi/<?= $codigoVideo ?>/hqdefault.jpg" />
                    <meta property="og:site_name" content="/videos/video.php?v=<?= $codigoVideo ?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" />
                    <meta property="og:description" content="Lucas Piano - <?=$currentVideo->TituloVideo?>" />
                    <meta property="og:url" content="<?= $config['baseUrl'] ?>/videos/video.php?v=<?= $codigoVideo ?>&hl=pt-br&fs=1&color1=0xe1600f&color2=0xfebd01" />

                    <param name="allowFullScreen" value="true">
                    <param name="allowscriptaccess" value="always">
                    <iframe width="700" height="400" src="https://www.youtube.com/embed/<?= $videoCode ?>?rel=0&autoplay=1&mute=1&enablejsapi=1&iv_load_policy=3&controls=1&disablekb=1&egm=1&showinfo=0&loop=1&modestbranding=1&vq=hd1080" frameborder="0" allowfullscreen"></iframe>
                </object>

                <div class="view-like-container">
                    <div><?= $video->getViewCount()?> views</div>
                    <div>
                        <a href="#" style="display: none" id="btn-login">Login</a>
                        <a href="#" style="display: none" id="btn-logout">Logout</a>
                        <a href="#" style="display: none" id="btn-like">Like</a>
                        <a href="#" style="display: none" id="btn-dislike">Dislike</a>
                    </div>
                </div>

                <?php if (!empty($currentVideo->FileName)): ?>
                    <div id="anexos" style="float:right; margin-right:5px; clear:both;">
                        <span><strong><?=TranslateItem("Partitura", "Music Sheet", "Partitura")?>:&nbsp;</strong></span><a href="<?= $config['baseUrl'] ?>/content/files/<?=$currentVideo->FileName?>" target="_blank">download</a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($currentVideo->FileName2)): ?>
                    <div id="anexos" style="float:right; margin-right:5px; clear:both;">
                        <span><strong><?=TranslateItem("áudio", "Audio", "Audio")?>:&nbsp;</strong></span><a href="<?= $config['baseUrl'] ?>/content/files/<?=$currentVideo->FileName2?>" target="_blank">download</a>
                    </div>
                <?php endif; ?>

                <div class="comment-form" style="display: none">
                    <textarea id="comment-text" placeholder="Escreva um comentário público..."></textarea>
                    <div class="comment-buttons">
                        <button type="button" id="btn-comment">Comentar</button>
                        <a href="https://www.youtube.com/channel/UCR2dv_znZ_o5GO8tUMGZZUg?sub_confirmation=1" target="_blank" id="subscribe-link">Inscrever-se</a>
                    </div>
                </div>

                <h4><?= TranslateItem("Coment&aacute;rios", "Comments", "Coment&aacute;rios") ?></h4>

                <div class="cutOffStripesContainer greyBg">
                    <div class="cutOffStripeTop"></div>&nbsp;
                    <div class="cutOffStripeBottom"></div>
                </div>

                <div class="wrappedContent">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="video-comment">
                                <div class="comment-avatar">
                                    <img src="<?= $comment->getAvatar() ?>" alt="<?= $comment->getAuthor() ?>">
                                    <h3><?= $comment->getAuthor() ?> (<?= $comment->getLikes() ?> likes)</h3>
                                </div>
                                <p><?= $comment->getComment() ?></p>
                            </div>
                            <?php if (!empty($comment->getReplies())): ?>
                                <?php foreach ($comment->getReplies() as $reply): ?>
                                    <div class="video-comment replies">
                                        <div class="comment-avatar">
                                            <img src="<?= $reply->getAvatar() ?>" alt="<?= $reply->getAuthor() ?>">
                                            <h3><?= $reply->getAuthor() ?> (<?= $reply->getLikes() ?> likes)</h3>
                                        </div>
                                        <p><?= $reply->getComment() ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Seja o primeiro a comentar no vídeo.</p>
                    <?php endif; ?>
                </div>

                <div class="cutOffStripesContainer greyBg">
                    <div class="cutOffStripeTop"></div>&nbsp;
                    <div class="cutOffStripeBottom"></div>
                </div>
            </div>
            <div class="playlist">
                <?php if ($playlist): ?>
                    <title>Lucas Piano - <?= $playlist->getTitle() ?></title>
                    <h5><?= $playlist->getTitle() ?></h5>
                    <h6>Playlist</h6>

                    <ul class="playlist-video-list">
                        <?php foreach ($videoList as $row): ?>
                            <li>
                                <a href="<?= $config['baseUrl'] ?>/videos/videobox.php?p=<?= $playlist->getId() ?>&v=<?= $row->CodigoVideo ?>">
                                    <?= $row->TituloVideo ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-606f7b975dc74136"></script>
<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

    try {
        var pageTracker = _gat._getTracker("UA-6805686-2");
        pageTracker._trackPageview();
    } catch(err) {}

    const loginButton = document.querySelector("#btn-login");
    const logoutButton = document.querySelector("#btn-logout");
    const likeButton = document.querySelector("#btn-like");
    const dislikeButton = document.querySelector("#btn-dislike");
    const commentContainer = document.querySelector(".comment-form");
    const commentTextarea = document.querySelector("textarea#comment-text");
    const commentButton = document.querySelector("button#btn-comment");

    const scopes = [
        "https://www.googleapis.com/auth/youtube",
        "https://www.googleapis.com/auth/youtube.force-ssl",
        "https://www.googleapis.com/auth/youtubepartner"
    ]

    likeButton.addEventListener('click', function (e) {
        e.preventDefault();
        rateAction('like')
    });

    dislikeButton.addEventListener('click', function (e) {
        e.preventDefault();
        rateAction('dislike')
    });

    commentButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (commentTextarea.value === '') {
            alert('Preencha o campo de comentário para poder continuar.');
            return false;
        }

        commentTextarea.disabled = true;
        commentButton.disabled = true;

        gapi.client.youtube.commentThreads.insert({
            "part": ["snippet"],
            "resource": {
                "snippet": {
                    "videoId": "<?= $video->getCode() ?>",
                    "topLevelComment": {
                        "snippet": {
                            "textOriginal": commentTextarea.value
                        }
                    }
                }
            }
        })
        .then(
            function(response) {
                console.log(`comment action triggered`);
                console.log("Response", response);

                commentTextarea.value = '';
                commentTextarea.disabled = false;
                commentButton.disabled = false;

                window.location = window.location;
            },
            function(err) {
                commentTextarea.disabled = false;
                commentButton.disabled = false;
                commentTextarea.focus();
                console.error("comment action error", err);
            }
        );
    });

    logoutButton.addEventListener('click', function (e) {
        e.preventDefault();
        gapi.auth2.getAuthInstance().signOut();
    });

    function handleClientLoad() {
        gapi.load('client:auth2', initClient);
    }

    function initClient() {
        gapi.client.init({
            discoveryDocs: ["https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest"],
            clientId: "<?= $clientSecret['web']['client_id'] ?>",
            scope: scopes.join(" ")
        }).then(() => {
            gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

            updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());

            loginButton.addEventListener('click', function (e) {
                e.preventDefault();
                gapi.auth2.getAuthInstance().signIn();
            });
        });
    }

    function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
            loginButton.style.display = 'none';
            logoutButton.style.display = 'inline';
            likeButton.style.display = 'inline';
            dislikeButton.style.display = 'inline';
            commentContainer.style.display = 'block';
        } else {
            loginButton.style.display = 'block';
            logoutButton.style.display = 'none';
            likeButton.style.display = 'none';
            dislikeButton.style.display = 'none';
            commentContainer.style.display = 'none';
        }
    }

    function rateAction(action) {
        console.log(`${action} action`);

        gapi.client.youtube.videos.rate({ "id": "<?= $video->getCode() ?>", "rating": action }).then(
            function(response) {
                console.log("Like Success. Response", response);
            },
            function(err) {
                console.error("Like action error", err);
            }
        );
    }
</script>
</body>
</html>