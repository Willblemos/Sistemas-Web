<?php
$errors = array();
if(isset($_POST['login'])){
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $genero = $_POST['genero'];
    $idade = $_POST['idade'];
    $cpf = $_POST['cpf']; //cpf unico
    $ende = $_POST['ende'];
    $tele = $_POST['tele'];
    
     

}
if(file_exists('users/' . $cpf . '.xml')){
        $errors[] = 'cpf já cadastrado';
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
        $xml->addCHILD('username', $username);
        $xml->addChild('password', md5($password));
        $xml->addCHILD('email', $email);
        $xml->addCHILD('genero',$genero);
        $xml->addCHILD('idade',$idade);
        $xml->addCHILD('cpf', $cpf);
        $xml->addCHILD('ende', $ende);
        $xml->addCHILD('tele', $tele);
        
        $xml->asXML('users/' . $cpf . '.xml');
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


<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">

  <div class="interface">
  		<nav>
  			<ul class="menu">
  				<li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
                  <li><a href="acesso.html">Acesso</a></li>
  			</ul>
  		</nav>

  		<header style="background-color: rgba(0, 0, 0, 0.483);">
  			<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar Paciente</h3>
  		</header>







    
    <div style = "width:35%; height:15%;" class="rform">
    <form method="post" action="">


    <?php
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }
    ?>

        <p>Username <input type="text" name="username" size="20" /></p>
        <p>Email <input type="text" name="email" size="20" /></p>
        <p>Senha <input type="password" name="password" size="20" /></p>
        <p>Confirmar Senha <input type="password" name="c_password" size="20" /></p>
        <p>Genero <input type="text" name="genero" size="20" /></p> <!-- mudar para opção de marcar ao inves de escrever -->
        <p>Idade <input type="number" name="idade" size="20" /></p>  <!--arrumar front do campo -->
        <p>CPF <input type="number" name="cpf" size="20" /></p>  <!--arrumar front do campo -->
        <p>Endereço <input type="text" name="ende" size="40" /></p>
        <p>Telefone <input type="number" name="tele" size="20" /></p> <!--arrumar front do campo -->
        <p><input type ="submit" name="login" value="Registrar" /></p>
		
		
    </form>
  </div>

</body>

</html>
