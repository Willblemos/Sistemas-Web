<?php
  include_once 'db_connect.php';
  session_start();
  $medcrm = $_SESSION['crm'];

  $err3 = $DB->verifica_medico($medcrm);
  if($err3 == null){
    echo "deu ruim";
    header('Location: login.php');
    die;
  } 

  $medname = $err3;
  $errors = array();

  if(isset($_POST['ok'])) {
    $clientid = $_POST['clientid'];
    $clientname = $_POST['clientname'];
    $dat =  $_POST['dat'];
    $hora  =  $_POST['hora'];
    $obs = $_POST['obs'];
    $errors = array();
  }

  $err = $DB->verifica_paciente($clientid);
  if($err == null){
    $errors[] = 'CPF nao cadastrado.';
  }

  else if($err != null) {
    if(($clientname != $err)) {
      $errors[] = 'Nome de cliente nao compatível com cpf.';
    }
  }

  $err2 = $DB->consulta_cpf($clientid,$dat, $hora);
  if($err2 == true){
    $errors[] = 'Horário indisponível: Cliente não pode fazer 2 consultas no mesmo horário.';
  } 

  $err2 = $DB->consulta_crm($medcrm,$dat, $hora);
  if($err2 == true){
    $errors[] = 'Horário indisponível: Medico não pode fazer 2 consultas no mesmo horário.';
  } 
    
  if(count($errors) == 0) {
    $err = $DB->cadastra_consulta($id, $clientname, $clientid, $err3, $medcrm,$dat, $hora, $obs);
    if ($err == true) {
      header('Location: index_medic.php');
      die;
    } else {
      echo "deu ruim";
    }
  }
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Registro de Consulta</title>

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
                  <div style="font-size:16px;" class="card-header">Registrar Nova Consulta</div>
                  <div class="card-body">
                    <form action="" method="post"><input type="hidden" name="login" value="login" />

                      <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-right">Nome do paciente</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="clientname" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">CPF do paciente</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="clientid" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-right">Data</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="dat" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="c_password" class="col-md-3 col-form-label text-md-right">Hora</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="hora" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="genero" class="col-md-3 col-form-label text-md-right">Observação</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="obs" required>
                        </div>
                      </div>

                      <div style="margin-left:27.5%;" class="form-group row">
                        <button type="submit" class="btn btn-primary" name="ok" value="Registrar">Registrar</button>
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
