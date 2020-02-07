<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Medic_sis</title>
	<link rel= "icon" href="imga/logo2.png">

</head>
    
<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">


<div class="interface">
		<nav>
			<ul class="menu">
				<li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
				<li><a href="acesso.html">Acesso</a></li>
			</ul>
		</nav>

		<header style="background-color: rgba(0, 0, 0, 0.483);">
				<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Checar histórico de consultas de um paciente</h3>
		</header>

			<div style = "margin-left:30%;" class="formulario">
			<form method="post" action="">
				<legend style="margin-left: 20%; font-weight: bold;">Consultar Histórico do Paciente</legend>
					<label>
						Nome do Paciente<span class="req"></span>
					</label>
					<input type="text" name="cname" size="20"/>

					<label>
						CPF do Paciente<span class="req"></span>
					</label>
					<input type="text" name="cid" size="20"/>
                    <p><input type="submit" value="Pesquisar" name="ok" /></p>
            </form>
		</div>

	<div style>
    <table id="#tabela-cima">
		<tr>
			<th>Cliente </th>
			<th>CPF </th>
			<th>Medico </th>
			<th>Data </th>
			<th>Hora </th>
			<th>Observação </th>
         </tr>

         
            <?php
				session_start();
				$error = false;
				
                if(isset($_POST['ok'])){
					$cid = $_POST['cid'];
					$crm = $_SESSION['crm'];
                    $cname = preg_replace('/[^A-Za-z]/', '', $_POST['cname']);


                $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");
                        
                        foreach($xmldata->children() as $consult) {         
                
                            
                            if(($cid == $consult->clientid) && ($cname == $consult->clientname) && ($crm == $consult->medcrm)){

                            echo"
                            <tr>
                            <td>".$consult->clientname."</td>
                            <td>".$consult->clientid."</td>
                            <td>".$consult->medname."</td>
                            <td>".$consult->dat."</td>
                            <td>".$consult->hora."</td>
                            <td>".$consult->obs."</td>
                            </tr>

                            "; 
                            
                        } 
                    }      
                        
                } 
                    $error = true;
            ?>

	</table>

	</div>

</body> 

</html>