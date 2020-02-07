<?php
  session_start();
  $errors = array();
  include_once 'db_connect.php';
  session_start();
  $cpf = $_SESSION['cpf'];
  $err = $DB->verifica_paciente($cpf);
    if($err == null){
      echo "deu ruim";
      header('Location: login_paciente.php');
      die;
    } 
  $username = $err;

  $error = false;

  if(isset($_POST['change'])){
    $nome = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmar_senha = $_POST['c_password']; 
    $endereco = $_POST['ende'];
    $telefone = $_POST['tele'];
    $genero = $_POST['genero'];
    $idade = $_POST['idade'];

    if($senha != $confirmar_senha) {
      $errors[] = 'Senhas não coincidem.';
  }

  if(count($errors) == 0) {
    $err = $DB->edita_paciente($id, $cpf, $nome, $senha, $email, $endereco,$telefone,$genero,$idade);
    if($err == true) {
      header('Location: login_paciente.php');
    } else {
      echo  "<script>alert('Edição Invalida!');</script>";
    } 
   }
  }
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Alteração do Cadastro</title>

	<!-- Font Awesome Icons -->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

	<!-- Plugin CSS -->
	<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

	<!-- Theme CSS - Includes Bootstrap -->
	<link href="css/creative.css" rel="stylesheet">
  <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"> -->

	<link rel= "icon" href="imga/logo2.png">
</head>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light py-3" id="mainNav">
	<div class="container">
		<i style="font-style:normal;color:black;" class="navbar-brand">Hospital Lifeline</i>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto my-2 my-lg-0">
        <li class="nav-item">
          <a style="color:black" class="nav-link js-scroll-trigger" href="index_paciente.php">Voltar ao Menu Anterior</a>
        </li>
				<li class="nav-item">
					<a style="color:black" class="nav-link js-scroll-trigger" href="logout.php">Sair</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Masthead -->
<header style="background:linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 30%, rgba(0, 0, 0, 0.6) 100%), url(../img/paciente_login.jpg); background-position:center; background-repeat:no-repeat; background-attachment:scroll; background-size:cover; height:92vh; padding-top:0px;" class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-12 align-self-center">
        
        <div class="login-form">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card">
                  <div style="font-size:16px;" class="card-header">Alteração do Cadastro</div>
                  <div class="card-body">
                    <form action="" method="post"><input type="hidden" name="login" value="login" />

                      <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-right">Nome</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="username" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">E-mail</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="email" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-right">Senha</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" name="password" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="c_password" class="col-md-3 col-form-label text-md-right">Confirmar senha</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" name="c_password" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="ende" class="col-md-3 col-form-label text-md-right">Endereço</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="ende" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="tele" class="col-md-3 col-form-label text-md-right">Telefone</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="tele" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="tele" class="col-md-3 col-form-label text-md-right">Gênero</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="genero" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="tele" class="col-md-3 col-form-label text-md-right">Idade</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="idade" required>
                        </div>
                      </div>

                      <div style="margin-left:27.5%;" class="form-group row">
                        <button type="submit" class="btn btn-primary" name="change">Confirmar</button>
                        <label style ="color:red" class="col-md-7 col-form-label text-md-left"><?php if(isset($_POST['change'])){if(count($errors)>0){echo'<ul>';foreach($errors as $e){echo('<li>'.$e.'</li>');}echo '</ul>';}} ?></label>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</header>

</body>

</html>
