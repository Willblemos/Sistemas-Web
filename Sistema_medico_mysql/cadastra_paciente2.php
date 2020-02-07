




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
          <li><a href="sobre.html">Sobre</a></li>
				  <li><a href="portal.html">FAQ</a></li>
        </ul>
      </nav>

      <header style="background-color: rgba(0, 0, 0, 0.483);">
          <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar Consulta</h3>
      </header>

     
      <div style = "width:35%; height:15%;" class="rform">
      <legend style="margin-left: 30%; font-weight: bold;">Registrar Paciente</legend>

    <form method="post" action="cadastra_paciente.php">
        <p>Nome do paciente <input type="text" name="username" size="20" /></p>
        <p>Email <input type="text" name="email" size="20" /></p>
        <p>Senha <input type="password" name="password" size="20" /></p>
        <p>Confirmar Senha <input type="password" name="c_password" size="20" /></p>
        <p>Genero <input type="text" name="genero" size="20" /></p> <!-- mudar para opção de marcar ao inves de escrever -->
        <p>Idade <input type="number" name="idade" size="20" /></p>  <!--arrumar front do campo -->
        <p>CPF <input type="number" name="cpf" size="20" /></p>  <!--arrumar front do campo -->
        <p>Endereço <input type="text" name="ende" size="40" /></p>
        <p>Telefone <input type="number" name="tele" size="20" /></p> <!--arrumar front do campo -->
        <p><input type ="submit" name="ok" value="Registrar" /></p>
    </form>

    <?php
include_once 'db_connect.php';
// session_start();
// $cpf = $_SESSION['cpf'];

$errors = array();

if(isset($_POST['ok'])){
    $nome = $_POST['username'];
    $email = $_POST['email']; 
    $senha = $_POST['password'];
    $confirmar_senha = $_POST['c_password'];
    $genero = $_POST['genero'];
    $idade = $_POST['idade'];
    $cpf = $_POST['cpf']; //cpf unico
    $endereco = $_POST['ende'];
    $telefone = $_POST['tele'];
    $id = mt_rand(1,300);
  $errors = array();
}

$err = $DB->verifica_paciente($cpf);
  if($err != null){
    $errors[] = 'CPF já cadastrado.';
  } 

if($nome == '') {
    $errors[] = 'username vazio';
}

    if($email == '') {
        $errors[] = 'Email vazio';
    }

    if($senha == '' || $confirmar_senha == '') {
        $errors[] = 'Senha vazia';
    }

    if($senha != $confirmar_senha) {
        $errors[] = 'Senhas não coincidem';
    }


      if(count($errors) == 0){
        $err = $DB->cadastra_paciente($id, $cpf, $nome, $senha, $email,$endereco, $telefone,$genero,$idade);
        if ($err == true){
          header('Location: index_adm.php');
          die;
        } else {
          echo "deu ruim";
        }
      }

?>

      <!-- BOTAR ESSE PHP DENTRO DE UM DIV(BLOCO DE ERROS) -->
      <?php
        if(isset($_POST['ok'])){

        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }

    }
    ?>


  
</body>

</html>
