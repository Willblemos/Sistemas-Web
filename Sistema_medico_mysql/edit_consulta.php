<?php
include_once 'db_connect.php';
session_start();
$id = $_SESSION['id'];

$errors = array();


if(isset($_POST['change'])){
    $newname = $_POST['username'];
    $clientid = $_POST['clientid'];
    $dat2 =  $_POST['dat2'];
    $hora2  =  $_POST['hora2'];
    $obs = $_POST['obs'];
  

  
  $err = $DB->verifica_paciente($clientid);
  if($err == null){
    $errors[] = 'CPF nao cadastrado.';
  }
  
  else if($err != null){
    if(($newname != $err)){
      $errors[] = 'Nome de cliente nao compatível com cpf.';
    }
  }
  
      $err2 = $DB->consulta_cpf($clientid,$dat2, $hora2);
      if($err2 == true){
        $errors[] = 'Horário indisponível: Cliente não pode fazer 2 consultas no mesmo horário.';
      } 
  

    // if(){ Checar se medico não tem 2 consultas no mesmo horário: problema: não tem o crm para fazer a verificação.
    //   $errors[] = 'Horário indisponível: Médico não pode fazer 2 consultas no mesmo horário';
    // } 

  if(count($errors) == 0){
    // $id = $_SESSION['id'];
    
    $err = $DB->edita_consulta($id,$clientid, $newname,$dat2,$hora2, $obs);
    header('Location: index_medic.php');

}
    
}

?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Atualizar Consulta</title>

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
                  <div style="font-size:16px;" class="card-header">Editar Consulta</div>
                  <div class="card-body">
                    <form action="" method="post"><input type="hidden" name="login" value="login" />

                      <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-right">Nome do Paciente</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="username" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="clientid" class="col-md-3 col-form-label text-md-right">ID Paciente CPF</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="clientid" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="dat2" class="col-md-3 col-form-label text-md-right">Data</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="dat2" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="hora2" class="col-md-3 col-form-label text-md-right">Hora</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="hora2" required>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="obs" class="col-md-3 col-form-label text-md-right">Observação</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="obs" required>
                        </div>
                      </div>

                      <div style="margin-left:27.5%;" class="form-group row">
                        <button type="submit" class="btn btn-primary" name="change" value="Registrar">Atualizar</button>
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

<?php
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }
    ?>

</body>

</html>