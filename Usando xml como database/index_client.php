<?php
session_start();
if(!file_exists('users/' . $_SESSION['cpf'] . '.xml')){
    header('Location: index.php');
    die;
}

	$xml2 = new SimpleXMLElement('users/' . $_SESSION['cpf'] . '.xml' , 0, true);
	$username = preg_replace('/[^A-Za-z]/', '', $xml2->username);

?>


<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Medic_sis</title>
	<link rel= "icon" href="imga/logo2.png">

	<a href="logout.php">
			<button class= "logout-but">
			
			</button>
		</a>	
	
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
		  <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Bem vindo, <?php echo $username; ?> </h3>

  		</header>




	<div>

	<a href="med_hist.php">
			<button class= "Cpac-but">
			</button>
		</a>

		<a href="client_exam_hist.php">
			<button class= "Epac-but">
			</button>
		</a>

		<a href="changepassword.php">
			<button class= "alterar-but">
			</button>
		</a>

	</div>



</body>

</html>
