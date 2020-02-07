<?php

session_start();
$id = $_SESSION['id'];

$errors = array();


if(isset($_POST['change'])){
    $newname = preg_replace('/[^A-Za-z]/', '', $_POST['newname']);
    $clientid = $_POST['clientid'];
    $dat2 =  $_POST['dat2'];
    $hora2  =  $_POST['hora2'];
    $obs = $_POST['obs'];
  

  
  if(file_exists('users/' . $clientid . '.xml') == false){
    $errors[] = 'CPF nao cadastrado';
  }
  
  if(file_exists('users/' . $clientid . '.xml')){
    $xml2 = new SimpleXMLElement('users/' . $clientid . '.xml' , 0, true);
    if(($newname == $xml2->username) == false){
      $errors[] = 'Nome de cliente nao cadastrado';
    }
  }
  
  $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");               
  foreach($xmldata->children() as $consult) {         
      if(($dat2 == $consult->dat) && ($hora2 == $consult->hora) && ($newname == $consult->clientname)){
        $errors[] = 'Horário indisponível: Cliente não pode fazer 2 consultas no mesmo horário';
      } 
  }

  $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");               
foreach($xmldata->children() as $consult) {         
    if(($dat2 == $consult->dat) && ($hora2 == $consult->hora) && ($newname == $consult->medname)){
      $errors[] = 'Horário indisponível: Médico não pode fazer 2 consultas no mesmo horário';
    } 
}


  if(count($errors) == 0){
    $id = $_SESSION['id'];
        $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");
        foreach($xmldata->children() as $consult) {         

            if($id == $consult->id) {
                $consult->clientname = $newname;
                $consult->clientid = $clientid;
                $consult->dat = $dat2;
                $consult->hora = $hora2;
                $consult->obs = $obs;
                $xmldata->asXML('consulta.xml');
                header('Location: index.php');
                die;
            }     
    }      
        
 

}
    
}

?>


<?php





?>

<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Atualizar Consulta</title>
	<link rel= "icon" href="imga/logo2.png">

	
</head>



<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">

    <div class="interface">
    		<nav>
    			<ul class="menu">
    				<li style="margin-left: 1%;"><a class="active" href="index_client.php" >Home</a></li>
    				<li><a href="acesso.html">Acesso</a></li>
    			</ul>
    		</nav>

    		<header style="background-color: rgba(0, 0, 0, 0.483);">
    				<h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Editar Consulta</h3>
    		</header>




  
   <div style = "margin-left:35%;" class="eform">
   <form method="post" action="">
   
     <p>Nome do Paciente <input type="text" name="newname" size="20" /></p>
     <p>ID Paciente(CPF) <input type="number" name="clientid" size="20" /></p>
     <p>Data <input type="text" name="dat2" size="40" /></p>
     <p>Hora <input type="text" name="hora2" size="20" /></p> 
     <p>Observação <input type="text" name="obs" size="20" /></p> 


  
   <p> <input type="submit" name="change" value="Atualizar" /></p>
   </form>
   <?php
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $e){
                echo ('<li>' . $e . '</li>');
            }
            echo '</ul>';
        }
    ?>


 </div>
   

   


</body>

</html>
