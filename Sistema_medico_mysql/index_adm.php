<?php
  include_once 'db_connect.php';
  session_start();
  $cpf = $_SESSION['cpf'];
  $err = $DB->verifica_adm($cpf);
  if($err == null){
    echo "deu ruim";
    header('Location:login_adm.php');
    die;
  } 
  $username = $err;
  $cont_pacientes = $DB->contador_pacientes();
  $cont_medicos = $DB->contador_medicos();
  $cont_labs = $DB->contador_laboratorios();
  $cont_consultas = $DB->contador_consultas();
  $cont_exames = $DB->contador_exames();
?>

<!DOCTYPE html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Seção do Administrador</title>

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
<header style="background:linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 30%, rgba(0, 0, 0, 0.6) 100%), url(../img/admin_login.jpg); background-position:center; background-repeat:no-repeat; background-attachment:scroll; background-size:cover; height:92vh; padding-top:0px;" class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-12 align-self-center">
        <h1 class="text-white font-weight-bold" style="font-size:50px; margin-top:-30px; padding-bottom:3.5%">Seja bem-vindo, <?php echo $username;?>.</h1>
        <div class="login-form">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-5">
                <div class="card">
                  <div style="font-size:18px;" class="card-header">O que deseja fazer?</div>
                  <div class="card-body">
                    <div style="padding-bottom:10%;">
                      <a href="cadastra_paciente.php">
                        <button class="btn2 btn-primary" name="reg_paciente">Registrar paciente</button>
                      </a>
                      <a href="cadastra_medico.php">
                        <button class="btn2 btn-primary" name="reg_medico">Registrar médico</button>
                      </a>
                    </div>

                    <div>
                      <a href="cadastra_lab.php">
                        <button class="btn2 btn-primary" name="reg_laboratorio">Registrar laboratório</button>
                      </a>
                      <a href="edit_adm.php">
                        <button class="btn2 btn-primary" name="alt_cadastro">Alterar cadastro</button>
                      </a>
                    </div>

                    <div style="padding-top:3%; margin-top:5%" class="card-header">
                      <table align = "center" cellpadding="5" id="#tabela-cima">
                        <tr>
                          <th>Pacientes Cadastrados </th>
                          <td><?php echo $cont_pacientes?></td>
                        </tr>

                        <tr>
                          <th>Medicos Cadastrados</th>
                          <td><?php echo $cont_medicos?></td>
                        </tr>

                        <tr>
                          <th>Laboratórios Cadastrados </th>
                          <td>     <?php echo $cont_labs  ?>     </td>
                        </tr>

                        <tr>
                          <th>Consultas Cadastradas </th>
                          <td>     <?php echo $cont_consultas?>     </td>
                        </tr>

                        <tr>
                          <th>Exames Cadastrados </th>
                          <td>    <?php echo $cont_exames?>     </td>
                        </tr>
                      </table>
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
