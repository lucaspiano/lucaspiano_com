<?
require_once("../classes/MySQLConnection.php");
require_once("../YoutubeHelper.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-BR">
 <head>
 	<title>LucasPiano.com | Aulas on-line, Piano cl&aacute;ssico e partituras</title>
	<meta name="description" content="Encontre aqui tudo sobre piano cl&aacute;ssico. Video-aulas, Partituras, materias e muito mais!" />
 	<meta name="keywords" content="piano, online learning, ensino a distancia, piano classico, classical piano, materias, videos, aprendizado, video-aula, mozart, chopin, aprenda piano, aprender piano, tutorial piano" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
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


<div id="contentSeparator">
</div>

<!--CONTENT-->
<div id="contentPageOthers">
	<div id="content">
		<div id="videos">

		<div id="search">
			<h1 class="<?=$GLOBALS['LANG']?>"><?=TranslateItem("Busca", "Search", "B�squeda")?></h1>
			
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
                                                                  ORDER BY 
                                                                        Nome ASC";
						
						$result = mysql_query($query);
						while($row = mysql_fetch_object($result)){
							if ($row->Codigo != 10)
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
					<input type="submit" value="<?=TranslateItem("buscar", "search", "buscar")?>" class="button">
				</form>
			</fieldset>
			<div id="categories">

				<h1 class="<?=$GLOBALS['LANG']?>"><?=TranslateItem("Categorias", "Categories", "Categor�as")?></h1>

				<ul>
				<?
				$result = mysql_query($query);
				while($row = mysql_fetch_object($result)){
				?>
					<li><a href="?category=<?=$row->Codigo?>"><?=$row->Nome?></a></li>
				<?
				}
				?>
				</ul>

			</div>


		</div>

		<div id="videosContent">

				<?

				$youtube = new YoutubeHelper();
				$category = $_GET['category'];

				if ($category == 1) //Categoria => Playlists
				{
				?>
				<div class="videoBox">
				<h2>Playlists</h2>
				<? 

					$youtube = new YoutubeHelper();
					$result = $youtube->GetPlaylists();
			
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
				<?
				}
				else if ($category != 1 && $category > 0) {  //Categoria Normal
				?>
				<div class="videoBox">
					<?
					$query = "SELECT
								Nome_".$GLOBALS['LANG']."
							  FROM
							  	Categoria
							  WHERE
							  	Codigo = '$category'
							  LIMIT 1";

					$result = mysql_query($query);
					$obj = mysql_fetch_row($result);
					?>
					<h2><?=$obj[0]?></h2>

					<?
					
					// Paginacao
					$total_reg = "12"; // n�mero de registros por p�gina
					if (!$pagina) {
						$pc = "1";
					} else {
						$pc = $pagina;
					}

					$inicio = $pc - 1;
					$inicio = $inicio * $total_reg;
				
					$query = "  SELECT
								  v.Codigo as CodigoVideo,
								  v.Url_".$GLOBALS['LANG']." as Url,
								  v.Views,								  
								  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,
								  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,								  
								  c.Codigo as CodigoCategoria
								FROM
								  Video v
								  INNER JOIN Categoria c
								  	ON c.Codigo = v.CodigoCategoria
								WHERE
									c.Codigo = '$category'
								AND v.Url_".$GLOBALS['LANG']." IS NOT NULL
								AND v.Url_".$GLOBALS['LANG']." <> ''
								ORDER BY
								  Data DESC
								";
					//echo($query);
					$result = mysql_query("$query LIMIT $inicio, $total_reg");
					$todos = mysql_query($query);
					
					$totalRegistros = mysql_num_rows($todos); //total registros
					$totalPaginas = ceil($totalRegistros / $total_reg); //total paginas
									
					if ($totalRegistros == 0) {
						echo "<div align='center'><h3>";
						TranslateItem("Nenhum v&iacute;deo nesta categoria.","There is no videos in this category.","No hay videos en esta categor�a.");
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
	                        <a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><img src="https://img.youtube.com/vi/<?=$videoCode?>/hqdefault.jpg"></a>
							<a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><?=$row->TituloVideo?></a><br>
							<span><?=$video->ViewCount?> views</span>
							<span><a href="https://www.lucaspiano.com/videos/?category=<?=$row->CodigoCategoria?>"><?=$row->NomeCategoria?></a></span>
						</div>
					<?
					}
					?>
                                        
 					<strong>Number of results: <?=$totalRegistros?></strong>
					<div id="paginacao">
						<?
						$anterior = $pc -1;
						$proximo = $pc + 1;
						if ($pc > 1) {
							echo " <a href='?pagina=$anterior&category=".$category."'><- Previous</a> ";
						}
						
						for($i=1; $i <= $totalPaginas; $i++) {
							if($i != $pc) {
								echo " <a class='page-number' href=".$_SERVER['PHP_SELF']."?pagina=".($i)."&category=".$category.">$i</a>";
							} else {
								echo " <span><strong>".$i."</strong></span>";
							}
						}

						if ($pc < $totalPaginas) {
							echo " <a href='?pagina=$proximo&category=".$category."'>Next -></a>";
						}
					}

				mysql_free_result($result);
				?>
				</div>
				
				</div>
				<?
				}else{
				?>
				<div class="videoBox">

					<h2><?=TranslateItem("V&iacute;deos em destaque","Featured Videos","Los videos del momento")?></h2>
					<?

					

					$query = "  SELECT
								  v.Codigo as CodigoVideo,
								  v.Url_".$GLOBALS['LANG']." as Url,
								  v.Views,								  
								  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,
								  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,
								  c.Codigo as CodigoCategoria
								FROM
								  Video v
								  INNER JOIN Categoria c
								  	ON c.Codigo = v.CodigoCategoria
								WHERE
								  v.Destaque = 0
								AND v.Url_".$GLOBALS['LANG']." IS NOT NULL
								AND v.Url_".$GLOBALS['LANG']." <> ''
								ORDER BY
									RAND()
								--  v.Views DESC
								LIMIT 4";

					$result = mysql_query($query);
					$rows = mysql_num_rows($result);
					if ($rows == 0) {
						echo "<div align='center'><h3>";
						TranslateItem("Nenhum v&iacute;deo em destaque no momento","There is no featured videos at moment.","No hay v�deos destacados en momento.");
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
	                        <a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><img src="https://img.youtube.com/vi/<?=$videoCode?>/default.jpg"></a>
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

				<div class="videoBox">
					<h2><?=TranslateItem("As pessoas tamb�m assistiram","People also watched","Las personas tambi�n vieron")?></h2>

					<?

					function sortVideos($item1,$item2){
						if ($item1->ViewCount == $item2->ViewCount) return 0;
    					return ($item1->ViewCount < $item2->ViewCount) ? 1 : -1;
					}


					$query = "  SELECT
								  v.Codigo as CodigoVideo,
								  v.Url_".$GLOBALS['LANG']." as Url,
								  v.Views,								  
								  v.Titulo_".$GLOBALS['LANG']." as TituloVideo,
								  c.Nome_".$GLOBALS['LANG']." as NomeCategoria,
								  c.Codigo as CodigoCategoria
								FROM
								  Video v
								  INNER JOIN Categoria c
								  	ON c.Codigo = v.CodigoCategoria
								WHERE 
									v.Url_".$GLOBALS['LANG']." IS NOT NULL
									AND v.Url_".$GLOBALS['LANG']." <> ''
								ORDER BY
								  rand()
								LIMIT 8";

					$result = mysql_query($query);
					$rows = mysql_num_rows($result);
					if ($rows == 0) {
						echo "<div align='center'><h3>";
						TranslateItem("Nenhum v&iacute;deo em destaque no momento","There is no featured videos at moment.","No hay v�deos destacados en momento.");
						echo "</h3></div>";
					}
					else
					{
						$vList = array();
						while ($row = mysql_fetch_object($result))
						{
							$videoCode = strstr($row->Url, "v=");
							$videoCode = str_replace("v=", "", $videoCode);
							
							$video = $youtube->GetVideoDetails($videoCode);
							$row->ViewCount = $video->ViewCount;
							$row->VideoCode = $videoCode;
							
							array_push($vList, $row);
						}

						//usort($vList, 'sortVideos');

						foreach($vList as $row) 
						{
						
						?>
						<div class="videoItem">
	                        <a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><img src="https://img.youtube.com/vi/<?=$row->VideoCode?>/default.jpg"></a>
							<a class="venobox" data-type="iframe" href="https://www.lucaspiano.com/videos/videobox.php?v=<?=$row->CodigoVideo?>"><?=$row->TituloVideo?></a><br>
							<span><?=$row->ViewCount?> views</span>
							<span><a href="https://www.lucaspiano.com/videos/?category=<?=$row->CodigoCategoria?>"><?=$row->NomeCategoria?></a></span>
						</div>

						<?
						}
						mysql_free_result($result);
					}
					?>

				</div>
				<?
				}
				?>

			</div>

		</div>

		</div>
	</div>

</div>

<!--FOOTER-->
<?require("../footer.php"); ?>


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
