<?php
  session_start();
  $errors = array();
  include_once 'db_connect.php';
  session_start();
  $crm = $_SESSION['crm'];

  $err = $DB->verifica_medico($crm);
  if($err == null) {
  echo "deu ruim";
    header('Location: teste.php');
    die;
  } 

  $username = $err;
  $error = false;

  if(isset($_POST['change'])) {
    $nome = $_POST['username'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirmar_senha = $_POST['c_password']; 
    $especialidade = $_POST['espec'];
    $endereco = $_POST['ende'];
    $telefone = $_POST['tele'];

    if($senha != $confirmar_senha) {
      $errors[] = 'Senhas não coincidem.';
  }

  if(count($errors) == 0) {
    $err = $DB->edita_medico($id, $crm, $nome, $senha, $email, $endereco,$especialidade, $telefone);
    if($err == true) {
      session_start();
      $_SESSION['crm'] = $crm;
      header('Location: index_medic.php');
    } else {
      echo "Valores inválidos!";
    } 
  }
}
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Alteração de Registro</title>

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
  
	<link rel= "icon" href="imga/logo2.png">
</head>

<body>

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
          <a style="color:black" class="nav-link js-scroll-trigger" href="index_medic.php">Voltar ao Menu Anterior</a>
        </li>
				<li class="nav-item">
					<a style="color:black" class="nav-link js-scroll-trigger" href="logout.php">Sair</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- Masthead -->
<header style="background:linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 30%, rgba(0, 0, 0, 0.6) 100%), url(../img/admin_login.jpg); background-position:center; background-repeat:no-repeat; background-attachment:scroll; background-size:cover; height:92vh; padding-top:0px;" class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-12 align-self-center">
        
        <div class="login-form">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card">
                  <div style="font-size:16px;" class="card-header">Alterar Cadastro de Médico</div>
                  <div class="card-body">
                    <form action="" method="post"><input type="hidden" name="login" value="login" />

                      <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-right">Nome de Usuário</label>
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
                          <input type="text" class="form-control" name="password" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="c_password" class="col-md-3 col-form-label text-md-right">Confirmar senha</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="c_password" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="ende" class="col-md-3 col-form-label text-md-right">Endereço</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="ende" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="espec" class="col-md-3 col-form-label text-md-right">Especialidade</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="espec" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="tele" class="col-md-3 col-form-label text-md-right">Telefone</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="tele" required>
                        </div>
                      </div>

                      <div style="margin-left:27.5%;" class="form-group row">
                        <button type="submit" class="btn btn-primary" name="change">Alterar</button>
                        <label style ="color:red" class="col-md-7 col-form-label text-md-left"><?php if(count($errors) > 0){echo'<ul>';foreach($errors as $e){echo('<li>'.$e.'</li>');}echo'</ul>';}?></label>
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
