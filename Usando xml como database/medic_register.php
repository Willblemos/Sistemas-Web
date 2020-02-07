<?php
$errors = array();
if(isset($_POST['login'])){
    $username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $ende = $_POST['ende'];
    $espec = $_POST['espec'];
    $tele = $_POST['tele'];
    $crm =  $_POST['crm']; //crm unico

}
if(file_exists('medicos/' . $crm . '.xml')){
        $errors[] = 'CRM já cadastrado';
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
        $xml->addChild('username', $username);
        $xml->addChild('password', md5($password));
        $xml->addCHILD('email', $email);
        $xml->addCHILD('ende', $ende);
        $xml->addCHILD('espec', $espec);
        $xml->addCHILD('tele', $tele);
        $xml->addCHILD('crm', $crm);

        $xml->asXML('medicos/' . $crm . '.xml');
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
      <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar Médico</h3>
      </header>



    
      <div class="rform">
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
        <p>Endereço <input type="text" name="ende" size="40" /></p>
        <p>Especialidade <input type="text" name="espec" size="20" /></p> <!-- mudar para opção em vez de escrever -->
        <p>Telefone <input type="number" name="tele" size="20" /></p> <!-- arrumar front disso aqui -->
        <p>CRM <input type="number" name="crm" size="20" /></p>  <!--Não sei qual o conteudo do crm, se é texto + num ou só numero -->


        <p><input type ="submit" name="login" value="Registrar" /></p>
    </form>
  </div>

    <hr />
   
</body>

</html>
