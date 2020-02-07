<?php

session_start();

$errors = array();


if(isset($_POST['change'])){
    $newname = preg_replace('/[^A-Za-z]/', '', $_POST['newname']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $ende = $_POST['ende'];
    $espec = $_POST['espec'];
    $tele = $_POST['tele'];




    if($newname == '') {
        $errors[] = 'nome vazio';
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
    

    $xml = new SimpleXMLElement('labs/' . $_SESSION['cnpj'] .'.xml' , 0 , true);

            $xml->labname = $newname;
            $xml->password = md5($password);
            $xml->email = $email;
            $xml->ende = $ende;
            $xml->$espec = $espec;
            $xml->tele = $tele;


            $xml->asXML('labs/' . $_SESSION['cnpj'] . '.xml');
            header('Location: logout.php');
            die;




}

}

?>




<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Atualizar Exame</title>
	<link rel= "icon" href="imga/logo2.png">

	
</head>



<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">

    <div class="interface">
    		<nav>
    			<ul class="menu">
    				<li style="margin-left: 1%;"><a class="active" href="index_client.php" >Home</a></li>
                    <li><a href="acesso.html">Acesso</a></li>
                 <li><a href="sobre.html">Sobre</a></li>
		        <li><a href="portal.html">FAQ</a></li>
    			</ul>
    		</nav>

    		<header style="background-color: rgba(0, 0, 0, 0.483);">
            <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Alterar registro de Laboratório</h3>
    		</header>



   

   <div class="rform">
   <form method="post" action="">

        <p>Nome de Laboratório <input type="text" name="newname" size="20" /></p>
        <p>Email <input type="text" name="email" size="20" /></p>
        <p>Senha <input type="password" name="password" size="20" /></p>
        <p>Confirmar Senha <input type="password" name="c_password" size="20" /></p>
        <p>Endereço <input type="text" name="ende" size="40" /></p>
        <p>Tipo de exame <input type="text" name="espec" size="20" /></p> <!-- mudar para opção em vez de escrever -->
        <p>Telefone <input type="number" name="tele" size="20" /></p> <!-- arrumar front disso aqui -->





   <p> <input type="submit" name="change" value="Atualizar" /></p>
   </form>

   <?php
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }
    ?>


 </div>
  




</body>

</html>
