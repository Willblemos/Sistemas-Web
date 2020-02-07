<?php
session_start();
if(!file_exists('medicos/' . $_SESSION['crm'] . '.xml')){
    header('Location: acesso.html');
    die;
}

	$xml2 = new SimpleXMLElement('medicos/' . $_SESSION['crm'] . '.xml' , 0, true);
	$username = preg_replace('/[^A-Za-z]/', '', $xml2->username);

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
  				<li style="margin-left: 1%;"><a class="" href="index.php" >Home</a></li>
				  <li><a href="acesso.html">Acesso</a></li>
				  
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
		<legend style="margin-left: 30%; font-weight: bold;">Atualizar Consulta</legend>
		<p>ID consulta <input type="text" name="id" size="20" /></p>

		<p><input type ="submit" name="ok" value="Atualizar Consulta" /></p>
    </form>

   
	<?php

if(isset($_POST['ok'])){
$id = $_POST['id'];

	$xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");
	foreach($xmldata->children() as $consult) {
		if($id == $consult->id){
			
		if($_SESSION['crm'] != $consult->medcrm) {
			echo  "<script>alert('Você não pode alterar Consultas de outros Médicos');</script>";			
			} else {
				session_start();
				$_SESSION['id'] = $id;
				header('Location: edit_consulta.php');
				die;
			}
		}
	}
}

?>
	</div>

	<div>

		<a href="check_hist.php">
			<button class= "cons-but">
				<legend class="hero-leg">Histórico de Paciente</legend>
			</button>
		</a>

		<a href="consulta.php">
			<button class= "registrar-but">
				<legend class="hero-leg">Registrar consulta</legend>
			</button>
		</a>

		<a href="changepassword_medic.php">
			<button class= "alterar-but">
				<legend class="hero-leg">Alterar Cadastro</legend>
			</button>
		</a>

</body>

</html>
