<?php
    include_once 'db_connect.php';
    $id = 1;
    $crm = "123456";
    $nome = "Saulo";
    $nome2 = "Will";
    $senha = "123456";
    $email = "saulo@hotmail.com";
    $endereco = "vargas";
    $telefone = "987654321";
    $especialidade = "pediatra";
    $oi = "aaaaaaa";
    $cpf = "987654";
    $cnpj = "123456789";
    $paciente = "lucas";
    $medico = "carlos";
    $dat = "11/01/2029";
    $hora = "12:00";
    $obs = "seila";
    $genero = "Masculino";
    $idade = 23;

    $laboratorio = "medic_center";
    $cpf2 = 123321;
    $crm2 = 98765;

    // //CADASTRA MEDICO
    // $err = $DB->cadastra_medico($id, $crm, $nome, $senha, $email,$endereco, $especialidade, $telefone);
    // if($err == true) {
    //     echo "deu bom";
    // } else {
    //     echo "deu ruim";
    // }

    //  //CADASTRA PACIENTE
    //  $err = $DB->cadastra_paciente($id, $cpf2, $nome, $senha, $email, $endereco, $telefone,$genero, $idade);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //   //CADASTRA ADM
    //  $err = $DB->cadastra_adm(1, 98765, "Willian", 123456, "willianlemos.b@hotmail.com", "Rua Borges De Medeiros", "97514191");
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //     //CADASTRA LAB
    //  $err = $DB->cadastra_lab($id, $cnpj, $nome, $senha, $email, $endereco, $especialidade, $telefone);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    // $id = mt_rand(1,300);
    
    // //CADASTRA CONSULTA
    // // $err = $DB->cadastra_consulta($id, $paciente, $cpf, $medico, $crm2, $dat, $hora, $obs);
    // $err = $DB->cadastra_consulta($id, "Saulo", "98765", "joao", "98765", "13/04/1920", "13:01", $obs);
    // if($err == true) {
    //     echo "deu bom";
    // } else {
    //     echo "\ndeu ruim";
    // }

     //CADASTRA EXAME
    $err = $DB->cadastra_exame($id, $paciente, $cpf2, $laboratorio, $cnpj, $dat, $hora, $obs);
    if($err == true) {
        echo "\ndeu bom";
    } else {
        echo "\ndeu ruim";
    }

    // //Consulta_cpf
    // $err = $DB->consulta_cpf($cpf,$dat,$hora);
    // if($err == null){
    //     echo "cpf não encontrado";
    // } else {
    //     echo "Consulta existente:";
    //     echo($err);
    // }

    //  //Consulta_crm
    //  $err = $DB->consulta_crm($crm,$dat,$hora);
    //  if($err == null){
    //      echo "crm não encontrado";
    //  } else {
    //      echo "Consulta existente:";
    //      echo($err);
    //  }


 


    // //VERIFICA CONSULTA
    // $err = $DB->verifica_consulta($crm,$cpf,$dat,$hora);
    // if($err == 1){
    //     echo "Paciente Já possui consulta neste horário";
    // }
    // else if($err == 2) {
    //     echo "Medico Já possui consulta neste horário";
    // }

    // else if($err == 4) {
    //     echo "Medico e Paciente já possuem consulta neste horário";
    // }

    // else {
    //     echo "Tá safe";
    // }


    //VERIFICA MEDICO
    // $err = $DB->verifica_medico($crm);
    // if($err == null){
    //     echo "Medico não encontrado";
    // } else {
    //     echo "Usuário encontrado e seu nome eh:";
    //     echo($err);
    // }


    $nomenovo = "nome_novo";
    $cpf_novo = "9999999";
    $senha_nova = "senha_nova";
    $email_novo = "email_novo";
    $endereco_novo = "endereco_novo";
    $telefone_novo = "telefone_novo";
    $especialidade_nova = "especialidade_nova";
    


    //       //EDITA PACIENTE
    //  $err = $DB->edita_paciente($id, $cpf, $nomenovo, $senha_nova, $email_novo, $endereco_novo, $telefone_novo);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //         //EDITA MEDICO
    //  $err = $DB->edita_medico($id, $crm, $nomenovo, $senha_nova, $email_novo, $endereco_novo,$especialidade_nova, $telefone_novo);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //        //EDITA ADM
    //  $err = $DB->edita_adm($id, $cpf, $nomenovo, $senha_nova, $email_novo, $endereco_novo, $telefone_novo);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //       //EDITA LAB
    //  $err = $DB->edita_lab($id, $cnpj, $nomenovo, $senha_nova, $email_novo, $endereco_novo,$especialidade_nova, $telefone_novo);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    $paciente_novo = "paciente_novoaaaa";
    $cpf_novo = "cpf_novo";
    $medico_novo = "medico_novo";
    $crm_novo = "crm_novo";
    $dat_nova = "data_nova";
    $hora_nova = "hora_novaaaaaa";
    $obs_nova = "observação novaaaa";

    //     //EDITA CONSULTA (ESSE ID EU VOU PASSAR POR SESSION DEPOIS DE FAZER UMA VERIFICAÇÃO PREVIA(BUSCA POR ID DE CONSULTA))
    //  $err = $DB->edita_consulta($id, $cpf_novo, $paciente_novo, $dat_nova, $hora_nova, $obs_nova);
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

   //  //CHECA ID CONSULTA
//    $err = $DB->checa_id_consulta(1);
//      if($err == null) {
//         echo "deu ruim";
//      } else {
//          echo ($err);
//      }

    //Protótipo edição de consulta 
    //1- receber id
    //2- pesquisar id com metodo checa_id_consulta($id)
    //3.5 --> verificar algo com crm do medico da consulta e o do medico utilizando a sessão (não alterar consulta de outros medicos) -> dica: retornar crm ao inves de id na checa_id_consulta
    //3- ir para pagina de edição de consulta carregando o ID na session
    //4 - receber valores novos(forms) na pagina de edição de consulta
    //5 - chamar edita_consulta(campos do forms)
    //6 -> algumas verificações de validação na edição de consulta. (cpf e nome?)

    
    //     //EDITA EXAME
    //  $err = $DB->edita_exame($id, $cpf_novo, $paciente_novo, $dat_nova, "hora_nova", "seila_men");
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

         //LOGIN MEDICO
    //  $err = $DB->login_medico("abcde@hotmail.com","123456");
    //  if($err == null) {
    //      echo "deu ruim";
    //  } else {
    //      echo $err;
    //  }

    //  //LOGIN PACIENTE
    //  $err = $DB->login_paciente("saulo@hotmail.com","123456");
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //  //LOGIN ADM
    //  $err = $DB->login_adm("email_novo","senha_nova");
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

    //  //LOGIN LAB
    //  $err = $DB->login_lab("123456789","senha_nova");
    //  if($err == true) {
    //      echo "deu bom";
    //  } else {
    //      echo "deu ruim";
    //  }

      //CHECA ID CONSULTA
//    $err = $DB->checa_id_crm("1", "11111");
//      if($err == null) {
//         echo "deu ruim";
//      } else {
//          echo ($err);
//      }

    
    // session_start();
    // $crm3 = $_SESSION['crm'];
    // echo $crm3;

    // $id = mt_rand(1,300);
    //     echo $id;

?>