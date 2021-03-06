<?php
$errors = array();
if(isset($_POST['login'])){
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
}
if(file_exists('adms/' . $username . '.xml')){
        $errors[] = 'username já cadastrado';
}
if($username == '') {
    $errors[] = 'username vazio';
}

    if($email == '') {
        $errors[] = 'Email vazio';
    }

    if($password == '' || $c_password == '') {
        $errors[] = 'Senha vazia';
    }

    if($password != $c_password) {
        $errors[] = 'Senhas diferentes';
    }

    if(count($errors) == 0){
        $xml = new SimpleXMLElement('<user></user>');
        $xml->addChild('password', md5($password));
        $xml->addCHILD('email', $email);
        $xml->asXML('adms/' . $username . '.xml');
        header('Location: index.php');
        die;
    }

?>

<!DOCTYPE html>



<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Medic_sis</title>
	<link rel= "icon" href="imga/logo2.png">


</head>

<body>

  <div class="interface">
  		<nav>
  			<ul class="menu">
  				<li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
  				<li><a href="acesso.html">Acesso</a></li>
  			</ul>
  		</nav>

  		<header style="background-color: rgba(0, 0, 0, 0.483);">
  				<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar</h3>
  		</header>


    <div class="formulario">
    <form method="post" action="logout.php" >


    <?php
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }
    ?>


		<h1>Registrar</h1>
        <p>Username <input type="text" name="username" size="20" /></p>
        <p>Email <input type="text" name="email" size="20" /></p>
        <p>Senha <input type="password" name="password" size="20" /></p>
        <p>Confirmar Senha <input type="password" name="c_password" size="20" /></p>
        <p><input type ="submit" name="login" value="Registrar" /></p>
		<input type="submit" value="Logout" />
    </form>

</body>

</html>
