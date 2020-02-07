<?php
$error = false;
if(isset($_POST['login'])){
	$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $crm = $_POST['crm'];
    $password = md5($_POST['password']);
    if(file_exists('medicos/' . $crm . '.xml')){
        $xml = new SimpleXMLElement('medicos/' . $crm . '.xml' , 0, true);
        if(($password == $xml->password) && ($username == $xml->username)){
            session_start();
            $_SESSION['crm'] = $crm;
            header('Location: index_medic.php');
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
				<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Bem vindo!</h3>
		</header>

			<div style = "margin-left:35%;" class="eform">
			<form method="post" action="">
				<legend style="margin-left: 40%; font-weight: bold;">Login</legend>
				<label>
						Nome de Médico<span class="req"></span>
					</label>
					<input type="text" name="username" size="20"/>


					<label>
						CRM<span class="req"></span>
					</label>
					<input type="text" name="crm" size="20"/>

					<label>
						Senha<span class="req"></span>
					</label>
					<input type="password" name="password" size="20"/>

                    <p><input type="submit" value="Login" name="login" /></p>
					
            </form>
</body> 

</html>