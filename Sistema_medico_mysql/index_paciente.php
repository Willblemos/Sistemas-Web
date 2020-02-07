<?php
	include_once 'db_connect.php';
	session_start();
	$cpf = $_SESSION['cpf'];
	$err = $DB->verifica_paciente($cpf);
  if($err == null){
    echo "deu ruim";
    header('Location:login_paciente.php');
    die;
  } 
	 $username = $err;
?>

<!DOCTYPE html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Seção do Paciente</title>

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
					<a style="color:black" class="nav-link js-scroll-trigger" href="index.html">Voltar à Página Principal</a>
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
        <h1 class="text-white font-weight-bold" style="font-size:50px; margin-top:-140px; padding-bottom:9.5%">Seja bem-vindo, <?php echo $username;?>.</h1>
        <div class="login-form">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-7">
                <div class="card">
                  <div style="font-size:18px;" class="card-header">O que deseja fazer?</div>
                  <div class="card-body">
                    <div style="padding-bottom:0%;">
                      <a href="paciente_historico_consultas.php">
                        <button style="font-size:19px" class="btn2 btn-primary" name="reg_paciente">Consultar o histórico de consultas</button>
                      </a>
                      <a href="paciente_historico_exames.php">
                        <button style="font-size:19px"class="btn2 btn-primary" name="reg_medico">Consultar o histórico de exames</button>
                      </a>
                      <a href="edit_paciente.php">
                        <button style="font-size:19px"class="btn2 btn-primary" name="reg_laboratorio">Alterar o cadastro de paciente</button>
                      </a>
                    </div>
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
