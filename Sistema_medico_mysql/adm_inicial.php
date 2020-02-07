<?php
    include_once 'db_connect.php';

      //CADASTRA ADM com senha "adm"
     $err = $DB->cadastra_adm(1, 98765, "Adm1", "adm", "adm@hotmail.com", "Rua Borges De Medeiros", "97514191");
     if($err == true) {
         echo "Criado com sucesso! <br> Email: adm@hotmail.com <br> Senha: adm"; 
     } else {
         echo "<br>Falha ao criar";
     }

    ?>
