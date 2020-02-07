<?php
session_start();
$cnpj = $_SESSION['cnpj'];
$xml2 = new SimpleXMLElement('labs/' . $cnpj . '.xml' , 0, true);

$labname = preg_replace('/[^A-Za-z]/', '', $xml2->labname);
$errors = array();

if(isset($_POST['ok'])){

  

  $clientid = $_POST['clientid'];
  $clientname = preg_replace('/[^A-Za-z]/', '', $_POST['clientname']);
  $dat =  $_POST['dat'];
  $hora  =  $_POST['hora'];

}

if(file_exists('labs/' . $cnpj . '.xml')){
  $xml2 = new SimpleXMLElement('labs/' . $cnpj . '.xml' , 0, true);
  if($labname != $xml2->labname){
    $errors[] = 'laboratório nao cadastrado';
  }
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

$xmldata = simplexml_load_file("exame.xml") or die("Failed to load");               
foreach($xmldata->children() as $consult) {         
    if(($dat == $consult->dat) && ($hora == $consult->hora) && ($clientname == $consult->clientname)){
      $errors[] = 'Horário indisponível: Cliente não pode fazer 2 exames no mesmo horário';
    } 
}




?>




<<!DOCTYPE html>


<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
	<title>Registro de Exame</title>
	<link rel= "icon" href="imga/logo2.png">


</head>

<body style="background-image:url('imga/exame.png'); background-size: 100%">

<?php


if(count($errors) == 0){
 
  
    
    $xml = new DomDocument("1.0", "UTF-8");
    $xml -> load("exame.xml");


    $rootTag = $xml->getElementsByTagName("user") ->item(0);


    $dataTag = $xml->createElement("exame");

    $idTag = $xml->createElement("id", mt_rand(1, 300));
    $labnameTag = $xml->createElement("labname", $labname);
    $clientidTag = $xml->createElement("clientid", $_REQUEST['clientid']);
    $clientnameTag = $xml->createElement("clientname", $_REQUEST['clientname']);
    $datTag = $xml->createElement("dat", $_REQUEST['dat']);
    $horaTag = $xml->createElement("hora", $_REQUEST['hora']);
    $resultTag = $xml->createElement("result");

    
      $dataTag->appendChild($idTag);
      $dataTag->appendChild($labnameTag);
      $dataTag->appendChild($clientidTag);
      $dataTag->appendChild($clientnameTag);
      $dataTag->appendChild($datTag);
      $dataTag->appendChild($horaTag);
      $dataTag->appendChild($resultTag);
  
      $rootTag->appendChild($dataTag);
  
      $xml->save("exame.xml");

    header('Location: index_lab.php');
    die;



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
          <h3 style="color:white; font-size: 40px; text-align: center; padding-top: 10px; margin-top: 4%;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;">Registrar Exame</h3>
      </header>



    
      <div style = "margin-left:20%;" class="eform">
    <form method="post" action="exame.php" >

       
       
        <p>ID Paciente(CPF) <input type="number" name="clientid" size="20" /></p>
        <p>Nome do Paciente <input type="text" name="clientname" size="20" /></p>
        <p>Data <input type="text" name="dat" size="40" /></p>
        <p>Hora <input type="text" name="hora" size="20" /></p> 
        
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


  <div style = "margin-left:78%;">
    <table id="#tabela-baixo">
		<tr>
      <th>ID </th>
			<th>Laboratório </th>
			<th>Data </th>
			<th>Hora </th>
      <th>Cliente </th>  
     </tr>

         
            <?php
                
                        $xmldata = simplexml_load_file("exame.xml") or die("Failed to load");
                        
                        foreach($xmldata->children() as $consult) {         
                            echo"
                            <tr>
                            <td>".$consult->id."</td>
                            <td>".$consult->labname."</td>
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
