<?php
$error = false;
if(isset($_POST['login'])){
	$labname = preg_replace('/[^A-Za-z]/', '', $_POST['labname']);
	$cpf = $_POST['cpf'];
    $cnpj=  $_POST['cnpj'];
    $password = md5($_POST['password']);
    if(file_exists('labs/' . $cnpj. '.xml')){
        $xml = new SimpleXMLElement('labs/' . $cnpj . '.xml' , 0, true);
        if(($password == $xml->password) && ($labname == $xml->labname)){
            session_start();
            $_SESSION['cnpj'] = $cnpj;
            header('Location: index_lab.php');
            die;
        }

    }
}

$error = true;

?>




<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Medic_sis</title>
	<link rel= "icon" href="imga/logo2.png">

	
</head>




<body style="background-image:url('imga/tema5.jpg'); background-size: 100%">

<div class="interface">
		<nav>
			<ul class="menu">
				<li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
				<li><a href="acesso.html">Acesso</a></li>
			</ul>
		</nav>

		<header style="background-color: rgba(0, 0, 0, 0.483);">
				<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Login</h3>
		</header>



			<div style = "margin-left:35%;" class="eform">
			<form method="post" action="">
				<p><legend style="margin-left: 40%; font-weight: bold;">Login</legend></p>
				
					<label>
						Nome do Laboratório<span class="req"></span>
					</label>
					<input type="text" name="labname" size="20"/>

					<label>
						CNPJ<span class="req"></span>
					</label>
					<input type="text" name="cnpj" size="20"/>

					<label>
						Senha<span class="req"></span>
					</label>
					<input type="password" name="password" size="20"/>

					<p><input type="submit" value="Login" name="login" /></p>
					
					
            </form>


			</div>

</div>
</body>

</html>
