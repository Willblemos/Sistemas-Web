<?php
  error_reporting(E_ERROR | E_PARSE);
  include 'includes/sidenav.php';
  
?>

<div class="container-fluid" style="padding: 30px 20px;">
    <div id="registros">
        <table class="table table-hover table-bordered table-striped table-dark text-center">
            <tr>
                <th>Id </th>
                <th>Paciente </th>
                <th>Cpf </th>
                <th>Laboratorio </th>
                <th>Cnpj </th>
                <th>Data </th>
                <th>Hora </th>
                <th>Resultado </th>
             </tr>
            
             <?php

            $cpf = "cpf_novo";
            $cnpj = "123456789";
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

                $stmt = $database->prepare("SELECT id,paciente,cpf,laboratorio,cnpj,dat,hora,resultado FROM exame WHERE cpf = :cpf AND cnpj = :cnpj"); 
                $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                    echo $v;
                }


               
             ?>

    </div>

<?php  include_once 'includes/footer.php'; ?>

