<?php
session_start();
if(!file_exists('medicos/' . $_SESSION['crm'] . '.xml')){
    header('Location: login_medic.php');
    die;
}

$error = false;

if(isset($_POST['change'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $espec = $_POST['espec'];
    $ende = $_POST['ende'];
    $tele = $_POST['tele'];

    $xml = new SimpleXMLElement('medicos/' . $_SESSION['crm'] .'.xml' , 0 , true);

            $xml->username = $username;
            $xml->email = $email;
            $xml->password = $password;
            $xml->ende = $ende;
            $xml->tele = $tele;
            $xml->espec = $espec;
            $xml->asXML('medicos/' . $_SESSION['crm'] . '.xml');
            header('Location: logout.php');
            die;
       
   
    $error = true;
}

?>




<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Mudar Cadastro:Medico</title>
	<link rel= "icon" href="imga/logo2.png">

</head>

<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">


  <div class="interface">
      <nav>
        <ul class="menu">
          <li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
          <li><a href="acesso.html">Acesso</a></li>
          <li><a href="sobre.html">Sobre</a></li>
		 <li><a href="portal.html">FAQ</a></li>
        </ul>
      </nav>

      <header style="background-color: rgba(0, 0, 0, 0.483);">
      <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Alterar registro de Médico</h3>
      </header>





   

    <div class="rform">
	    <form method="post" action="">
	 

			<p>Username <input type="text" name="username" size="20" /></p>
			<p>Email <input type="text" name="email" size="20" /></p>
			<p>Senha <input type="password" name="password" size="20" /></p>
			<p>Endereço <input type="text" name="ende" size="40" /></p>
			<p>Especialidade <input type="text" name="espec" size="20" /></p> <!-- mudar para opção em vez de escrever -->
			<p>Telefone <input type="number" name="tele" size="20" /></p> <!-- arrumar front disso aqui -->
			


	    <p> <input type="submit" name="change" value="Mudar" /></p>
	    </form>
	</div>
  

   


</body>

</html>
