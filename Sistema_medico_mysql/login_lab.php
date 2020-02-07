<!DOCTYPE html>
<html lang="en">

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Acesso - Laboratório</title>

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

<?php
include_once 'db_connect.php';

if(isset($_POST['login']) && $_POST['login'] == "login") {
	$email = $_POST['email'];
  $password = $_POST['password'];

	$err = $DB->login_lab($email,$password);

  if($err == null) {
		echo  "<script>alert('Dados incorretos!');</script>";
		//javascrip com alert aqui.
        
  } else {
		session_start();
    $_SESSION['cnpj'] = $err;
    header('Location: index_lab.php');
    die;
  }	
}
?>

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
						<a style="color:black" class="nav-link js-scroll-trigger" href="http://localhost/">Página Principal</a>
					</li>
					<li class="nav-item">
						<a style="color:black" class="nav-link js-scroll-trigger" href="http://localhost/#services">Acesso</a>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Masthead -->
	<header style="background:linear-gradient(to bottom, rgba(0, 0, 0, 0.6) 30%, rgba(0, 0, 0, 0.6) 100%), url(../img/lab_login.jpg); background-position:center; background-repeat:no-repeat; background-attachment:scroll; background-size:cover; height:92vh; padding-top:0px;" class="masthead">
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
				<div class="col-lg-12 align-self-center">
					
					<div class="login-form">
  					<div class="container">
    					<div class="row justify-content-center">
      					<div class="col-md-5">
        					<div class="card">
          					<div style="font-size:16px;" class="card-header">Autenticação do Laboratório</div>
          					<div class="card-body">
            					<form action="" method="post"><input type="hidden" name="login" value="login" />

              					<div class="form-group row">
                					<label for="email_address" class="col-md-3 col-form-label text-md-right">E-mail</label>
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

												<div style="margin-left:14.2%;" class="col-md-6">
													<button type="submit" class="btn btn-primary" name="Submit" value="login">Entrar</button>
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