<?
require_once("../classes/connection.php");
require_once("../YoutubeHelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
 <head>
 	<title>LucasPiano.com | Aulas on-line, Piano cl&aacute;ssico e partituras</title>
	<meta name="description" content="Encontre aqui tudo sobre piano cl&aacute;ssico. Video-aulas, Partituras, materias e muito mais!" />
 	<meta name="keywords" content="piano, online learning, ensino a distancia, piano classico, classical piano, materias, videos, aprendizado, video-aula, mozart, chopin, aprenda piano, aprender piano, tutorial piano" />
	<meta name="author" content="TY Interactive" />

	<link rel="shortcut icon" type="image/ico" href="https://www.lucaspiano.com/images/lucaspiano_logo.ico.png" />
        
	<link rel="shortcut icon" type="image/ico" href="https://www.lucaspiano.com/images/favicon.ico" />

	<!-- Estilos -->
	<link rel="stylesheet" href="../css/common.css" type="text/css" media="all" />
	<link rel="stylesheet" href="../css/videos.css" type="text/css" media="all" />

	<!-- Scripts -->
	<?require("../scripts.php"); ?>

 </head>

<body>

<!--HEADER-->
<? require("../header.php"); ?>

<div id="bannerInternals">
	<div id="bannerContent">
		<img src="../images/h_piano.jpg" />
	</div>
</div>

<!--CONTENT-->
<div id="contentPageOthers">
	<div id="content">
		<div id="videos">

		<div id="search">
			<h1 class="<?=$GLOBALS['LANG']?>"><?=TranslateItem("Busca", "Search", "Búsqueda")?></h1>

			<fieldset>
				<form action="search.php" method="GET">
					<label><?=TranslateItem("Assunto", "Subject", "Tema")?>:</label>
					<div class="container">
					<select name="category" class="inpSelect">
					<option value="ALL"><?=TranslateItem("Todos", "All", "Todos")?></option>
					<?
						$query = "SELECT
									Codigo,
									Nome_".$GLOBALS['LANG']." as Nome
								  FROM
								  	Categoria
								  WHERE Codigo <> 1";
						
						$result = mysql_query($query);
						while($row = mysql_fetch_object($result)){
							if ($row->Codigo != 1)
							{
							?>
								<option value="<?=$row->Codigo?>"><?=$row->Nome?></option>
							<?
							}
						}
						
					?>
					</select>
					</div>
					<label><?=TranslateItem("Palavra-chave", "Keyword", "Palabra-clave")?>:</label><input type="text" name="keywords" size="20"><br/>
					<input type="submit" value="buscar" class="button">
				</form>
			</fieldset>
			<div id="categories">

				<h1 class="<?=$GLOBALS['LANG']?>"><?=TranslateItem("Categorias", "Categories", "Categorías")?></h1>

				<ul>
				<?
				$result = mysql_query($query);
				while($row = mysql_fetch_object($result)){
				?>
					<li><a href="https://www.lucaspiano.com/videos/?category=<?=$row->Codigo?>"><?=$row->Nome?></a></li>
				<?
				}
				?>
				</ul>

			</div>


		</div>

		<div id="videosContent">

				<div class="videoBox">
					<h2><? TranslateItem("Resultados da busca", "Search results", "Resultados de la búsqueda"); ?></h2>

					<?
					$youtube = new YoutubeHelper();
					$category = $_GET['category'];

					if (empty($category)) {
						$category = "ALL";
					}
					$keywords = $_GET['keywords'];
					$whereKeys = "WHERE 1=1 ";

					if (!empty($keywords)) {
						$whereKeys .= " AND v.Titulo_".$GLOBALS['LANG']." LIKE '%".$keywords."%'";
					}
					if ($category != "ALL") {
						$whereKeys .= " AND v.CodigoCategoria = ".$category." ";
					}

					$query = "SELECT
								  v.Codigo as CodigoVideo,
								  v.Url_".$GLOBALS['LANG']." as UrlVideo,
								  v.Views,
								  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,
								  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,
								  c.Codigo as CodigoCategoria
								FROM
								  Video v
								  INNER JOIN Categoria c
								  	ON c.Codigo = v.CodigoCategoria
								".$whereKeys."
								ORDER BY
								  v.Views DESC";

					$result = mysql_query($query);
					if (mysql_num_rows($result) == 0) {
                                            
						echo "<div align='center'><h3>";
						TranslateItem("Nenhum v&iacute;deo encontrado.","No videos found.","No se encontraron videos.");
						echo "</h3></div>";                      				
					}
					else
					{
					while ($row = mysql_fetch_object($result))
					{
						$videoCode = strstr($row->UrlVideo, "v=");
						$videoCode = str_replace("v=", "", $videoCode);
						$video = $youtube->GetVideoDetails($videoCode);
					?>

						<div class="videoItem">
	                        <a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><img src="https://img.youtube.com/vi/<?=$videoCode?>/2.jpg"></a>
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

		</div>
	</div>

</div>

<!--FOOTER-->
<?require("../footer.php"); ?>


<!--Google analytics-->

</body>