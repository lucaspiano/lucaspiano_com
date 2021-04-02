<?php

echo "<body bgcolor='#000'>";

//enviando o email

$to = "lucaspiano@gmail.com";
$subject = "LucasPiano.com | Contato através do Site";
$remetente = "lucaspiano@lucaspiano.com";
$html = "

<html>
<head>
</head>

<body>
<table width='500' style='border:1px solid #666666;' cellspacing='0' cellpadding='0'>
  <tr style='font-weight:bold; font-family: Tahoma, Verdana, Arial, sans-serif; font-size:12px; color:#FFF; background-color:#00569D;'>
    <td style='padding:10px;'>Contato através do Site | ".date("d-m-Y")."</td>
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


?>