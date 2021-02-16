<?
require_once("./classes/connection.php");

echo "<body bgcolor='#000'>";

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

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}


//Recupera o Modulo e a açao do Form (inclusao ou alteracao) e define a ação do SQL

$nome = anti_injection($_POST['txtNome']);
$email = anti_injection($_POST['txtEmail']);

if (empty($nome) or empty($email) or $nome == "Seu nome" or $email == "Seu e-mail") {
	echo "<script>alert('Preencha seu nome e email corretamente!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/'>";
	exit();
}

if (!isValidEmail($email)) {
	echo "<script>alert('O email digitado não é válido!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/'>";
	exit();
}

$sql = "SELECT Email FROM Newsletter WHERE Email = '$email'";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
	echo "<script>alert('Email já existe em nossa base de dados!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/'>";
	exit();
}



// Define a Query para inclusão no bd

$sql = "INSERT INTO Newsletter  (Codigo,
								 Nome,
								 Email
							    )
					 VALUES    ('',
					 			'$nome',
								'$email'
					 		 	)";



// Executa a Query

if(mysql_query($sql))
{
	mysql_close($con);
	echo "<script>alert('Seu email foi cadastrado com sucesso!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/'>";
	exit();
}
else
{
	echo "<script>alert('Ocorreu um erro ao cadastrar seus dados. Por favor, tente novamente mais tarde!');</script>";
	echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=http://www.lucaspiano.com/'>";
	exit();
}

?>