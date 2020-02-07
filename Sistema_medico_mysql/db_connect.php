<?php
    // session_start();
    //  $key = $_SESSION['key'];
    //echo "recebi por sessão: $key";
 
    $DB = new DB;
    $database = $DB::_conectaDB();

    //$err = $DB->verifica($key);

    #Conecta ao banco de dados e associa à classe DB.
    class DB{   
        public static $database;
        public static $e;
        public static function _conectaDB(){
            try{
                self::$database = new PDO('mysql:host=localhost;dbname=medic_sis;charset=utf8mb4','root','root');
                self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $e = self::$e;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return self::$database;
        }

        ###################### <VERIFICAÇÕES> ##########################

        ###### VERIFICA SE JÁ HÁ UM MÉDICO COM AQUELE CRM CADASTRADO.
        public function verifica_medico($crm){
            $query = self::$database->prepare("SELECT nome FROM medico WHERE crm = ?");
            $query->bindParam(1, $crm);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }         
        }

        ###### VERIFICA SE JÁ HÁ UM PACIENTE COM AQUELE CPF CADASTRADO.
        public function verifica_paciente($cpf){
            $query = self::$database->prepare("SELECT nome FROM paciente WHERE cpf = ?");
            $query->bindParam(1, $cpf);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
        
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }        
        }

        ###### VERIFICA SE JÁ HÁ UM ADM COM AQUELE CPF CADASTRADO.
        public function verifica_adm($cpf){
            $query = self::$database->prepare("SELECT nome FROM adm WHERE cpf = ?");
            $query->bindParam(1, $cpf);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }        
        }

        ###### VERIFICA SE JÁ HÁ UM LABORATÓRIO COM AQUELE CNPJ CADASTRADO
        public function verifica_lab($cnpj){
            $query = self::$database->prepare("SELECT nome FROM laboratorio WHERE cnpj = ?");
            $query->bindParam(1, $cnpj);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->nome;
            }        
        }

        ###### VERIFICA SE AQUELE PACIENTE JÁ ESTÁ MARCADO PARA UMA CONSULTA NAQUELA DATA/HORA
        public function consulta_cpf($cpf,$dat,$hora){
            $query = self::$database->prepare("SELECT cpf,dat,hora FROM consulta WHERE cpf = :cpf AND dat = :dat AND hora = :hora");
            $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $query->bindParam(':dat', $dat, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return true; 
            }        
        }

        ######VERIFICA SE AQUELE MEDICO JÁ ESTÁ MARCADO PARA UMA CONSULTA NAQUELA DATA/HORA
        public function consulta_crm($crm,$dat,$hora){
            $query = self::$database->prepare("SELECT crm,dat,hora FROM consulta WHERE crm = :crm AND dat = :dat AND hora = :hora");
            $query->bindParam(':crm', $crm, PDO::PARAM_STR);
            $query->bindParam(':dat', $dat, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return true; 
            }        
        }

           #VERIFICA SE UM MÉDICO OU UM PACIENTE JÁ POSSUI UMA CONSULTA NO MESMO HORARIO
           public function verifica_consulta($crm, $cpf,$dat, $hora){
            if (($this->consulta_cpf($cpf,$dat,$hora) == true) AND ($this->consulta_crm($crm,$dat,$hora) == true)){
                return 4;
            }
            else if (($this->consulta_cpf($cpf,$dat,$hora) == true) AND ($this->consulta_crm($crm,$dat,$hora) == false) ){
                return 1;
            }
            else if (($this->consulta_cpf($cpf,$dat,$hora) == false) AND ($this->consulta_crm($crm,$dat,$hora) == true)){
                return 2;
            }
            else if (($this->consulta_cpf($cpf,$dat,$hora) == false) AND ($this->consulta_crm($crm,$dat,$hora) == false)){
                return 3;
            }     
        }


        ###### VERIFICA SE AQUELE PACIENTE JÁ TEM UM EXAME MARCADO NAQUELA DATA/HORA
        public function exame_cpf($cpf,$dat,$hora){
            $query = self::$database->prepare("SELECT cpf,dat,hora FROM exame WHERE cpf = :cpf AND dat = :dat AND hora = :hora");
            $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $query->bindParam(':dat', $dat, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return true; 
            }        
        }
        ###################### </Verificações> ##########################



       
       ###################### <CADASTROS> ##########################
       

        public function cadastra_lab($id, $cnpj, $nome, $senha, $email,$endereco, $especialidade, $telefone){ 
            if ($this->verifica_lab($cnpj) == null){
                $query = self::$database->prepare("INSERT INTO laboratorio (id,cnpj,nome,senha,email,endereco,especialidade,telefone) VALUES (:id, :cnpj, :nome, :senha, :email, :endereco, :especialidade, :telefone)");
                $query->execute(array(":id" => $id, ":cnpj" => $cnpj, ":nome" => $nome, ":senha" => $senha, ":email" => $email, ":endereco" => $endereco, ":especialidade" => $especialidade, ":telefone" => $telefone));
                return true; // CADASTRADO
            }
            else{
                echo("USUARIO JÁ EXISTE");
                return false; // USUARIO JA EXISTE
            }
            
        }

        public function cadastra_medico($id, $crm, $nome, $senha, $email,$endereco, $especialidade, $telefone){
            if ($this->verifica_medico($crm) == null){
                $query = self::$database->prepare("INSERT INTO medico (id,crm,nome,senha,email,endereco,especialidade,telefone) VALUES (:id, :crm, :nome, :senha, :email, :endereco, :especialidade, :telefone)");
                $query->execute(array(":id" => $id, ":crm" => $crm, ":nome" => $nome, ":senha" => $senha, ":email" => $email, ":endereco" => $endereco, ":especialidade" => $especialidade, ":telefone" => $telefone));
                return true; // CADASTRADO
            }
            else{
                echo("USUARIO JÁ EXISTE");
                return false; // USUARIO JA EXISTE
            }
            
        }

        public function cadastra_paciente($id, $cpf, $nome, $senha, $email,$endereco, $telefone,$genero,$idade){ 
            if ($this->verifica_paciente($cpf) == null){
                $query = self::$database->prepare("INSERT INTO paciente (id,cpf,nome,senha,email,endereco,telefone,genero,idade) VALUES (:id, :cpf, :nome, :senha, :email, :endereco, :telefone, :genero, :idade)");
                $query->execute(array(":id" => $id, ":cpf" => $cpf, ":nome" => $nome, ":senha" => $senha, ":email" => $email, ":endereco" => $endereco, ":telefone" => $telefone, ":genero" => $genero, ":idade" => $idade));
                return true; // CADASTRADO
            }
            else{
                echo("USUARIO JÁ EXISTE");
                return false; // USUARIO JA EXISTE
            }
            
        }

        public function cadastra_adm($id, $cpf, $nome, $senha, $email,$endereco, $telefone){
            if ($this->verifica_adm($cpf) == null){
                $query = self::$database->prepare("INSERT INTO adm (id,cpf,nome,senha,email,endereco,telefone) VALUES (:id, :cpf, :nome, :senha, :email, :endereco, :telefone)");
                $query->execute(array(":id" => $id, ":cpf" => $cpf, ":nome" => $nome, ":senha" => $senha, ":email" => $email, ":endereco" => $endereco, ":telefone" => $telefone));

                return true; // CADASTRADO
            }
            else{
                echo("USUARIO JÁ EXISTE");
                return false; // USUARIO JA EXISTE
            }   
        }

        public function cadastra_consulta($id, $paciente, $cpf, $medico, $crm,$dat, $hora, $obs){
            if ($this->verifica_consulta($crm,$cpf,$dat,$hora) == 1){
                echo "Paciente Já possui consulta neste horário";
            }

            if ($this->verifica_consulta($crm,$cpf,$dat,$hora) == 2){
                echo "Medico Já possui consulta neste horário";
            }

            if ($this->verifica_consulta($crm,$cpf,$dat,$hora) == 4){
                echo "Medico e Paciente Já possuem consulta neste horário";
            }

            if ($this->verifica_consulta($crm,$cpf,$dat,$hora) == 3){
                
                $query = self::$database->prepare("INSERT INTO consulta (id,paciente,cpf,medico,crm,dat,hora,obs) VALUES (:id, :paciente, :cpf, :medico, :crm, :dat, :hora, :obs)");
                $query->execute(array(":id" => $id, ":paciente" => $paciente, ":cpf" => $cpf, ":medico" => $medico, ":crm" => $crm, ":dat" => $dat, ":hora" => $hora, ":obs" => $obs ));
                return true; // CADASTRADO
            }        
        
        }

        public function cadastra_exame($id, $paciente, $cpf, $laboratorio, $cnpj,$dat, $hora, $resultado){
            if ($this->exame_cpf($cpf,$dat,$hora) == true){
                echo "Paciente Já possui exame neste horário";
                return false;
            }
            else {
                $query = self::$database->prepare("INSERT INTO exame (id,paciente,cpf,laboratorio,cnpj,dat,hora,resultado) VALUES (:id, :paciente, :cpf, :laboratorio, :cnpj, :dat, :hora, :resultado)");
                $query->execute(array(":id" => $id, ":paciente" => $paciente, ":cpf" => $cpf, ":laboratorio" => $laboratorio, ":cnpj" => $cnpj, ":dat" => $dat, ":hora" => $hora, ":resultado" => $resultado ));
                return true; // CADASTRADO
            }
        }

        ###################### </CADASTROS> ##########################


         ###################### <EDITAR> ##########################

         public function edita_paciente($id, $cpf, $nome, $senha, $email,$endereco, $telefone){ 
            if ($this->verifica_paciente($cpf) != null){
                
                $query = self::$database->prepare("UPDATE paciente SET nome = :nome,senha = :senha, email = :email, endereco = :endereco, telefone = :telefone WHERE cpf = :cpf ");
               
                $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $query->bindParam(':nome', $nome, PDO::PARAM_STR);
                $query->bindParam(':senha', $senha, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                $query->execute();
                return true; // EDITADO
            }
            else{
                echo("USUARIO NÃO EXISTE");
                return false; // USUARIO NAO EXISTE
            }
            
        }

        public function edita_medico($id, $crm, $nome, $senha, $email,$endereco,$especialidade, $telefone){ 
            if ($this->verifica_medico($crm) != null){
                
                $query = self::$database->prepare("UPDATE medico SET nome = :nome,senha = :senha, email = :email, endereco = :endereco,especialidade = :especialidade, telefone = :telefone WHERE crm = :crm ");
               
                $query->bindParam(':crm', $crm, PDO::PARAM_STR);
                $query->bindParam(':nome', $nome, PDO::PARAM_STR);
                $query->bindParam(':senha', $senha, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $query->bindParam(':especialidade', $especialidade, PDO::PARAM_STR);
                $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                $query->execute();
                return true; // EDITADO
            }
            else{
                echo("USUARIO NÃO EXISTE");
                return false; // USUARIO NAO EXISTE
            }
            
        }

        public function edita_adm($id, $cpf, $nome, $senha, $email,$endereco, $telefone){ 
            if ($this->verifica_adm($cpf) != null){
                
                $query = self::$database->prepare("UPDATE adm SET nome = :nome,senha = :senha, email = :email, endereco = :endereco, telefone = :telefone WHERE cpf = :cpf ");
               
                $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $query->bindParam(':nome', $nome, PDO::PARAM_STR);
                $query->bindParam(':senha', $senha, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                $query->execute();
                return true; // EDITADO
            }
            else{
                echo("USUARIO NÃO EXISTE");
                return false; // USUARIO NAO EXISTE
            }
            
        }

        public function edita_lab($id, $cnpj, $nome, $senha, $email,$endereco,$especialidade, $telefone){ 
            if ($this->verifica_lab($cnpj) != null){
                
                $query = self::$database->prepare("UPDATE laboratorio SET nome = :nome,senha = :senha, email = :email, endereco = :endereco,especialidade = :especialidade, telefone = :telefone WHERE cnpj = :cnpj ");
               
                $query->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
                $query->bindParam(':nome', $nome, PDO::PARAM_STR);
                $query->bindParam(':senha', $senha, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $query->bindParam(':especialidade', $especialidade, PDO::PARAM_STR);
                $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                $query->execute();
                return true; // EDITADO
            }
            else{
                echo("USUARIO NÃO EXISTE");
                return false; // USUARIO NAO EXISTE
            }
            
        }
    
        public function checa_id_consulta($id){
            $query = self::$database->prepare("SELECT id FROM consulta WHERE id = ?");
            $query->bindParam(1, $id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->id;
            }        
        }

        public function checa_id_crm($id,$crm){
            $query = self::$database->prepare("SELECT id,crm FROM consulta WHERE id = :id AND crm = :crm");
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->bindParam(':crm', $crm, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->id;
            }        
        }

        public function checa_id_exame($id){
            $query = self::$database->prepare("SELECT id FROM exame WHERE id = ?");
            $query->bindParam(1, $id);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
           
            if ($row==null){
                return null;
            } else {
                return $row->id;
            }        
        }

    
        public function edita_consulta($id,$cpf, $paciente,$dat,$hora, $obs){ 
                $query = self::$database->prepare("UPDATE consulta SET cpf = :cpf, paciente = :paciente, dat = :dat, hora = :hora, obs = :obs WHERE id = :id ");
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
                $query->bindParam(':paciente', $paciente, PDO::PARAM_STR);
                $query->bindParam(':hora', $hora, PDO::PARAM_STR);
                $query->bindParam(':dat', $dat, PDO::PARAM_STR);
                $query->bindParam(':obs', $obs, PDO::PARAM_STR);
                $query->execute();
                return true; // EDITADO
        } 

        
        public function edita_exame($id,$cpf, $paciente,$dat,$hora, $resultado){ 
            $query = self::$database->prepare("UPDATE exame SET cpf = :cpf, paciente = :paciente, dat = :dat, hora = :hora, resultado = :resultado WHERE id = :id ");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $query->bindParam(':paciente', $paciente, PDO::PARAM_STR);
            $query->bindParam(':dat', $dat, PDO::PARAM_STR);
            $query->bindParam(':hora', $hora, PDO::PARAM_STR);
            $query->bindParam(':resultado', $resultado, PDO::PARAM_STR);
            $query->execute();
            return true; // EDITADO
    } 
         ###################### </EDITAR> ##########################




         ###################### <LOGIN> ##########################

        public function login_medico($email,$senha){
            $query = self::$database->prepare("SELECT email,senha,crm FROM medico WHERE email = :email AND senha = :senha");
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            // $query->bindParam(':crm', $crm, PDO::PARAM_STR);
            $query->bindParam(':senha', $senha, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->crm; 
            }  
        }

        public function login_paciente($email,$senha){
            $query = self::$database->prepare("SELECT email,senha,cpf FROM paciente WHERE email = :email AND senha = :senha");
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':senha', $senha, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->cpf; 
            }  
        }

        public function login_adm($email,$senha){
            $query = self::$database->prepare("SELECT email,senha,cpf FROM adm WHERE email = :email AND senha = :senha");
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':senha', $senha, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->cpf; 
            }  
        }

        public function login_lab($email,$senha){
            $query = self::$database->prepare("SELECT email,cnpj,senha FROM laboratorio WHERE email = :email AND senha = :senha");
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':senha', $senha, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_OBJ);
            if ($row==null){
                return null;
            } else {
                return $row->cnpj; 
            }  
        }
         ###################### </LOGIN> ##########################


         
    public function contador_consultas(){
        $query = self::$database->prepare("SELECT cpf FROM consulta");
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_exames(){
        $query = self::$database->prepare("SELECT cpf FROM exame");
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_pacientes(){
        $query = self::$database->prepare("SELECT cpf FROM paciente");
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_medicos(){
        $query = self::$database->prepare("SELECT crm FROM medico");
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_laboratorios(){
        $query = self::$database->prepare("SELECT cnpj FROM laboratorio");
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_consultas_medico($crm){
        $query = self::$database->prepare("SELECT crm FROM consulta WHERE crm = ?");
        $query->bindParam(1, $crm);
        $query->execute();
        $count = $query->rowCount();
        return $count;
    }

    public function contador_consultas_paciente($cpf){
        $query = self::$database->prepare("SELECT cpf FROM consulta WHERE cpf = ?");
        $query->bindParam(1, $cpf);
        $query->execute();
        $count = $query->rowCount();
        return $count;
    } 




    }







 ?>




