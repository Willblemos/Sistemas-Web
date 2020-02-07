<?php
  error_reporting(E_ERROR | E_PARSE);
  session_start();
  $cpf = $_SESSION['cpf'];
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="author" content="Saulo Pinedo">

	<title>Histórico de Exames</title>

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
					<a style="color:black" class="nav-link js-scroll-trigger" href="index_paciente.php">Voltar ao Menu Anterior</a>
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
        <div class="login-form">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="card">
                  <div style="font-size:18px" class="card-header">Histórico de Exames</div>
                  <div class="card-body">
                    <div style="padding-bottom:0%;">

                    <div style="padding-top:0%">
                      <table width="90%" align="center" border="1px" cellpadding="5" id="#tabela-cima">
                        <tr>
                          <th width="8%" height="35px">ID </th>

                          <th width="15.3%">Paciente </th>

                          <th width="15.3%">CPF </th>

                          <th width="15.3%">Laboratório </th>

                          <th width="15.3%">Data </th>

                          <th width="15.3%">Hora </th>

                          <th width="15.3%">Resultado </th>
                        </tr>

                        <?php
                        session_start();
                        $cpf = $_SESSION['cpf'];
                                    
                        class TableRows extends RecursiveIteratorIterator { 
                          function __construct($it) { 
                            parent::__construct($it, self::LEAVES_ONLY); 
                          }

                          function current() {
                            return "<td height='35px'>" . parent::current(). "</td>";
                          }

                          function beginChildren() { 
                            echo "<tr>"; 
                          } 

                          function endChildren() { 
                            echo "</tr>" . "\n";
                          } 
                        } 

                        include_once 'db_connect.php';
                        $stmt = $database->prepare("SELECT id,paciente,cpf,laboratorio,dat,hora,resultado FROM exame WHERE cpf = :cpf"); 
                        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                          echo $v;
                        }
                        ?>

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