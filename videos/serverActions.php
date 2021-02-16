<?php
  require_once('recaptchalib.php');
  $privatekey = "6LfaMMISAAAAAMYo6nXzhKk7lCPsxmK-SZk8I1LW";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
  }

require_once("../classes/connection.php");

echo "<body bgcolor='#000'>";

//enviando o email

$to = "lucaspiano@gmail.com";
$subject = "LucasPiano.com | Comentário postado no Site";
$remetente = "lucaspiano@lucaspiano.com";
$html = "

<html>
<head>
</head>

<body>
<table width='500' style='border:1px solid #666666;' cellspacing='0' cellpadding='0'>
  <tr style='font-weight:bold; font-family: Tahoma, Verdana, Arial, sans-serif; font-size:12px; color:#FFF; background-color:#00569D;'>
    <td style='padding:10px;'>Comentário postado no Site | ".date("d-m-Y")."</td>
  </tr>
  <tr>
    <td align='center' style='padding:10px;'><table width='480' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='169' align='right' bgcolor='#F9F9F9'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 11px; font-weight: bold; padding-right:10px;'>Nome:</span></td>
        <td width='311' bgcolor='#F9F9F9'><span style='font-size: 11px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".$_POST['txtNome']."</span></td>
      </tr>
      <tr>
        <td align='right' bgcolor='#DDE4FF'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 11px; font-weight: bold; padding-right:10px;'>Email:</span></td>
        <td bgcolor='#DDE4FF'><span style='font-size: 11px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".$_POST['txtEmail']."</span></td>
      </tr>
      <tr>
        <td align='right' bgcolor='#F9F9F9'><span style='font-family: Tahoma, Verdana, Arial, sans-serif; font-size: 11px; font-weight: bold; padding-right:10px;'>Mensagem:</span></td>
        <td bgcolor='#F9F9F9'><span style='font-size: 11px; font-family:Tahoma, Verdana, Arial, sans-serif; color:#000;'>".nl2br($_POST['txtMensagem'])."</span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>";

$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
$headers.="From:".$remetente."";

if (mail($to, $subject, $html, $headers)) {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/contact/?success=1'>";
} else {
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/contact/?error=1'>";
}


 function anti_injection($sql)
 {
	 // remove palavras que contenham sintaxe sql
	 $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
	 $sql = trim($sql);//limpa espaços vazio
	 $sql = strip_tags($sql);//tira tags html e php
	 $sql = addslashes($sql);//Adiciona barras invertidas a uma string
 	 $sql = mysql_real_escape_string($sql);
	 return $sql;
 }


//Recupera o Modulo e a açao do Form (inclusao ou alteracao) e define a ação do SQL

$codigoVideo = $_POST['codigoVideo'];
$nome = anti_injection($_POST['txtNome']);
$email = anti_injection($_POST['txtEmail']);
$website = anti_injection($_POST['txtWebsite']);
$comentario = anti_injection($_POST['txtMensagem']);
$data = date("Y-m-d");//implode(preg_match("~\/~", $txtData) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $txtData) == 0 ? "-" : "/", $txtData)));

if (empty($nome) or empty($comentario) or empty($email)) {
	echo "<script>alert('Nome, email e comentário devem ser preenchidos!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=video.php?codigo=".$codigoVideo."'>";
	exit();
}

if (empty($codigoVideo)) {
	echo "<script>alert('Ocorreu um erro ao postar seu comentário. Por Favor, tente mais tarde.');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/videos/'>";
	exit();
}




// Define a Query para inclusão no bd

$sql = "INSERT INTO Comentario  (Codigo,
								 CodigoVideo,
								 CodigoPartitura,
								 CodigoMateria,
								 Data,
								 Nome,
								 Email,
								 Website,
								 Mensagem
							    )
					 VALUES    ('',
					 			'$codigoVideo',
								null,
								null,
								'$data',
								'$nome',
								'$email',
								'$website',
								'$comentario'
					 		 	)";



// Executa a Query

if(mysql_query($sql))
{
	mysql_close($con);
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/videos/video.php?comment=1&v=".$codigoVideo."'>";
	exit();
}
else
{
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/videos/video.php?comment=2&v=".$codigoVideo."'>";
	exit();
}

?>