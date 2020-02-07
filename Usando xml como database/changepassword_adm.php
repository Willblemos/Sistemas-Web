<?php
session_start();
if(!file_exists('adms/' . $_SESSION['username'] . '.xml')){
    header('Location: login_adm.php');
    die;
}

$error = false;

if(isset($_POST['change'])){
    $old = md5($_POST['o_password']);
    $new = md5($_POST['n_password']);
    $c_new = md5($_POST['c_n_password']);

    $xml = new SimpleXMLElement('adms/' . $_SESSION['username'] .'.xml' , 0 , true);

    if($old == $xml->password){
        if($new == $c_new){
            $xml->password = $new;
            $xml->asXML('adms/' . $_SESSION['username'] . '.xml');
            header('Location: logout.php');
            die;
        }
    }
    $error = true;
}

?>




<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Mudar Senha:Adm</title>
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
    <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Alterar registro de Administrador</h3>
    </header>




   

   <div class="rform">
   <form method="post" action="">
    <?php
    if($error){
        echo '<p> senhas não combinam </p>';
    }

    ?>

   <p> Senha Antiga <input type="password" name="o_password" /></p>
   <p> Nova Senha <input type="password" name="n_password" /></p>
   <p> Confirmar Senha <input type="password" name="c_n_password" /></p>
   <p> <input type="submit" name="change" value="Mudar senha" /></p>
   </form>
 </div>
  
</body>

</html>
