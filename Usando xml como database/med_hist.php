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
		<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Histórico de consultas de <?php echo $username; ?></h3>

		</header>
</div>

	<div style = "padding-top: 10px; margin-top: 4%; margin-left: 35%;">
    <table id="#tabela-baixo">
		<tr>
			<th>Cliente </th>
			<th>CPF </th>
			<th>Medico </th>
			<th>Data </th>
			<th>Hora </th> <!--cliente não vê a observação -->
         </tr>

         
            <?php
			session_start();
			$cid= $_SESSION['cpf'];
				$error = false;
				
     
             
                	   $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");
                        
                        foreach($xmldata->children() as $consult) {         
                
                    
                            
                            if(($cid == $consult->clientid)){
                    
                    
                    
                            echo"
                            <tr>
                            <td>".$consult->clientname."</td>
                            <td>".$consult->clientid."</td>
                            <td>".$consult->medname."</td>
                            <td>".$consult->dat."</td>
                            <td>".$consult->hora."</td>
                            </tr>

                            "; 
                            
                        } 
                        
                            
                            
                    }      
                        
             
                    $error = true;
            ?>


		

	</table>

	</div>

			



</body> 

</html>