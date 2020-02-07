
<?php
include_once 'db_connect.php';
session_start();
$cnpj = $_SESSION['cnpj'];
$err = $DB->verifica_lab($cnpj);
    if($err == null){
		echo "deu ruim";
        header('Location:login_lab.php');
    	die;
    } 
	 $username = $err;
	 

?>

<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Medic_sis</title>
	<link rel= "icon" href="imga/logo2.png">
</head>

<body style="background-image:url('imga/medfundo.jpg'); background-size: 100%">

  <div class="interface">
  		<nav>
  		<ul class="menu">
			<li><a href="index.html">Home</a></li>
        </ul>
  		</nav>

		  <header style="background-color: rgba(0, 0, 0, 0.483);">
		  
		  <a href="logout.php">
			<button class= "logout-but">
			
			</button>
		</a>	

		<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Bem vindo, <?php echo $username; ?> </h3>
  		</header>

	<div class="aconsulta">
	<form method="post" action=""> 
		<legend style="margin-left: 30%; font-weight: bold;">Atualizar Exane</legend>
		<p>ID Exame <input type="text" name="id" size="20" /></p>

		<p><input type ="submit" name="ok" value="Atualizar Exame" /></p>
    </form>

   
	<?php

if(isset($_POST['ok'])){
$id = $_POST['id'];
session_start();
$cnpj = $_SESSION['cnpj'];


//CHECA ID CONSULTA
   $err = $DB->checa_id_exame($id);
     if($err == null) {
        echo "Exame Inválido";
     } else {
		session_start();
	 	$_SESSION['id'] = $id;
		header('Location: edit_exame.php');
		die;

     }

}

?>
	</div>

	<div>

		<a href="check_hist_exame.php">
			<button class= "cons-but">
				<legend class="hero-leg">Histórico de Paciente</legend>
			</button>
		</a>

		<a href="exame.php">
			<button class= "registrarE-but">
				<legend class="hero-leg">Registrar Exame</legend>
			</button>
		</a>

		<a href="edit_lab.php">
			<button class= "alterar-but">
				<legend class="hero-leg">Alterar Cadastro</legend>
			</button>
		</a>

</body>

</html>



<a href="exame.php">
			<button class= "registrarE-but">
				<legend class="hero-leg">Registrar Exame</legend>
			</button>
		</a>