<?php
session_start();
if(!file_exists('labs/' . $_SESSION['cnpj'] . '.xml')){
    header('Location: acesso.html');
    die;
}

		$xml2 = new SimpleXMLElement('labs/' . $_SESSION['cnpj'] . '.xml' , 0, true);
		$labname = preg_replace('/[^A-Za-z]/', '', $xml2->labname);

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
  				<li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
				  <li><a href="acesso.html">Acesso</a></li>
  			</ul>
  		</nav>

		  <header style="background-color: rgba(0, 0, 0, 0.483);">
		  <h1 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Bem vindo, <?php echo $labname; ?> </h1>


		  <a href="logout.php">
			<button class= "logout-but">
			
			</button>
		</a>	

  		</header>




	
	<div class="aconsulta">
	<form method="post" action="">
	<legend style="margin-left: 30%; font-weight: bold;">Atualizar Exame</legend>
	<p>ID exame <input type="text" name="id" size="20" /></p>

	<p><input type ="submit" name="ok" value="Atualizar Exame" /></p>
    </form>

	</div>

	<?php
	session_start();
	$cnpj = $_SESSION['cnpj'];


		$xml2 = new SimpleXMLElement('labs/' . $cnpj . '.xml' , 0, true);
		$labname = preg_replace('/[^A-Za-z]/', '', $xml2->labname);
	  

	if(isset($_POST['ok'])){
	$id = $_POST['id'];

		$xmldata = simplexml_load_file("exame.xml") or die("Failed to load");
		foreach($xmldata->children() as $consult) {
			if($id == $consult->id){	
				if($labname != $consult->labname) {
					echo  "<script>alert('Você não pode alterar Exames de outros Laboratórios!');</script>";
					
					
					} 
				else {
					session_start();
           			 $_SESSION['id'] = $id;
					header('Location: edit_exam.php');
					die;
				}
			}

		}

	}

	?>

	<!-- <p> <input type = "submit" name = "change" value="Editar laboratório" /></p> -->

	<div>
	
	<a href="exame_hist.php">
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
