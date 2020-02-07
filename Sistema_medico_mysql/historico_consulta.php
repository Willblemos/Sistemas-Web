<?php
  error_reporting(E_ERROR | E_PARSE);
  include 'includes/sidenav.php';
  session_start();
  $crm = $_SESSION['crm'];
  
?>

<div class="container-fluid" style="padding: 30px 20px;">
    <div id="registros">
        <table class="table table-hover table-bordered table-striped table-dark text-center">
            <tr>
                <th>Id </th>
                <th>Paciente </th>
                <th>Cpf </th>
                <th>Médico </th>
                <th>CRM </th>
                <th>Data </th>
                <th>Hora </th>
                <th>Observação </th>
             </tr>
            
             <?php

$cpf = "98765";
$crm = "12345";
            
                //echo "<tr><th>Id</th></tr>";
                class TableRows extends RecursiveIteratorIterator { 
                    function __construct($it) { 
                        parent::__construct($it, self::LEAVES_ONLY); 
                    }

                    function current() {
                        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
                    }

                    function beginChildren() { 
                        echo "<tr>"; 
                    } 

                    function endChildren() { 
                        echo "</tr>" . "\n";
                    } 
                } 

                include_once 'db_connect.php';

                $stmt = $database->prepare("SELECT id,paciente,cpf,medico,crm,dat,hora,obs FROM consulta WHERE cpf = :cpf AND crm = :crm"); 
                $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $stmt->bindParam(':crm', $crm, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                    echo $v;
                }


               
             ?>

    </div>

<?php  include_once 'includes/footer.php'; ?>

