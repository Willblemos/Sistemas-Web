<?php
session_start();
$medcrm = $_SESSION['crm'];

if(!file_exists('medicos/' . $_SESSION['crm'] . '.xml')){
  header('Location: acesso.html');
  die;
}


$xml2 = new SimpleXMLElement('medicos/' . $medcrm . '.xml' , 0, true);
$medname = preg_replace('/[^A-Za-z]/', '', $xml2->username);

$errors = array();

if(isset($_POST['ok'])){
  
  


  $clientid = $_POST['clientid'];
  $clientname = preg_replace('/[^A-Za-z]/', '', $_POST['clientname']);
  $dat =  $_POST['dat'];
  $hora  =  $_POST['hora'];

  $errors = array();
}


if(file_exists('users/' . $clientid . '.xml') == false){
  $errors[] = 'CPF nao cadastrado';
}

if(file_exists('users/' . $clientid . '.xml')){
  $xml2 = new SimpleXMLElement('users/' . $clientid . '.xml' , 0, true);
  if(($clientname == $xml2->username) == false){
    $errors[] = 'Nome de cliente nao cadastrado';
  }
}


$xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");               
foreach($xmldata->children() as $consult) {         
    if(($dat == $consult->dat) && ($hora == $consult->hora) && ($medname == $consult->medname)){
      $errors[] = 'Horário indisponível: Médico não pode fazer 2 consultas no mesmo horário';
    } 
}


$xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");               
foreach($xmldata->children() as $consult) {         
    if(($dat == $consult->dat) && ($hora == $consult->hora) && ($clientname == $consult->clientname)){
      $errors[] = 'Horário indisponível: Cliente não pode fazer 2 consultas no mesmo horário';
    } 
}


?>




<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	
	<link rel= "icon" href="imga/logo2.png">


</head>

<body style="background-image:url('imga/consulta.jpg'); background-size: 100%">

<?php


if(count($errors) == 0){
 
  
    
    $xml = new DomDocument("1.0", "UTF-8");
    $xml -> load("consulta.xml");


    $rootTag = $xml->getElementsByTagName("user") ->item(0);


    $dataTag = $xml->createElement("consulta");

    $idTag = $xml->createElement("id", mt_rand(1, 300));
    $medcrmTag = $xml->createElement("medcrm", $medcrm);
    $mednameTag = $xml->createElement("medname", $medname);
    $clientidTag = $xml->createElement("clientid", $_REQUEST['clientid']);
    $clientnameTag = $xml->createElement("clientname", $_REQUEST['clientname']);
    $datTag = $xml->createElement("dat", $_REQUEST['dat']);
    $horaTag = $xml->createElement("hora", $_REQUEST['hora']);
    $obsTag = $xml->createElement("obs", $_REQUEST['obs']);

      $dataTag->appendChild($idTag);
      $dataTag->appendChild($medcrmTag);
      $dataTag->appendChild($mednameTag);
      $dataTag->appendChild($clientidTag);
      $dataTag->appendChild($clientnameTag);
      $dataTag->appendChild($datTag);
      $dataTag->appendChild($horaTag);
      $dataTag->appendChild($obsTag);
  
      $rootTag->appendChild($dataTag);
  
      $xml->save("consulta.xml");

    //header('Location: index.php');
    //die;



}


?>


  <div class="interface">
      <nav>
        <ul class="menu">
          <li style="margin-left: 1%;"><a class="active" href="index.php" >Home</a></li>
          <li><a href="acesso.html">Acesso</a></li>
          <li><a href="sobre.html">Sobre</a></li>
				  <li><a href="portal.html">FAQ</a></li>
        </ul>
      </nav>

      <header style="background-color: rgba(0, 0, 0, 0.483);">
          <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar Consulta</h3>
      </header>

     

      <div style = "margin-left:2%;" class="consform">

      <legend style="margin-left: 30%; font-weight: bold;">Registrar Consulta</legend>

    <form method="post" action="consulta.php">

      
        <p>ID Paciente(CPF) <input type="number" name="clientid" size="20" /></p>
        <p>Nome do Paciente <input type="text" name="clientname" size="20" /></p>
        <p>Data <input type="text" name="dat" size="40" /></p>
        <p>Hora <input type="text" name="hora" size="20" /></p> 
        <p>Obs <input type="text" name="obs" size="20" /></p> 
        

        <p><input type ="submit" name="ok" value="Registrar" /></p>
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

  <div style = "margin-left:66%;">
    <table id="#tabela-baixo">
		<tr>
		<th>ID </th>
		<th>Medico </th>
		<th>Data </th>
		<th>Hora </th>
		<th>Cliente </th>  
     </tr>

         
            <?php
                        $xmldata = simplexml_load_file("consulta.xml") or die("Failed to load");
                        
                        foreach($xmldata->children() as $consult) {         
                            echo"
                            <tr>
                            <td>".$consult->id."</td>
                            <td>".$consult->medname."</td>
                            <td>".$consult->dat."</td>
                            <td>".$consult->hora."</td>
                            <td>".$consult->clientname."</td>
                            </tr>
                            "; 
                    }      
            ?>
	  </table>
	</div>
</body>

</html>
