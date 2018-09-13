<?php
session_start();
require '../config.php';

class Usuarios{  

  public function cadastrar($nome,$email,$login,$senha){
    global $db;
    $response = [];    

    if(empty($nome) || empty($email) || empty($login) || empty($senha)){

      $response['mensagem'] = 'Campo obrigatório!';      
      $response['status'] = false;      

      return $response;

    }else{

      // Verificar se email ou login informados já estão cadastrados
      $sql = "SELECT login, email FROM users WHERE login = :login OR email = :email";
      $sql = $db->prepare($sql);
      $sql->bindValue(':login', $login);
      $sql->bindValue(':email', $email);
      $sql->execute();

      if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        
        return $sql;

      }else{
        // Salvar dados no banco

        $sql = "INSERT INTO users SET nome = :nome, login = :login, email = :email, senha = :senha";
        $sql = $db->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':login', $login);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        // Gerando link de confirmação
        $id = $db->lastInsertId();
        $md5 = md5($id);
        $response['link'] = "https://beta.saulo.bonom.com.br/webroot/my_test/site/confirmar.php?h=".$md5;        

        $response['mensagem'] = 'Parabéns! Seu cadastro foi realizado com sucesso!';      
        $response['status'] = true;

        return $response;
      }

    }

    return $response; 

  }

  public function login($login, $senha){
    global $db;
    $response = [];    

    if(empty($login) || empty($senha)){

      $response['mensagem'] = 'Campo obrigatório!';      
      $response['status'] = false;      

      return $response;

    }else{

      $sql = "SELECT id FROM users WHERE login = :login AND senha = :senha AND ativo = 1";
      $sql = $db->prepare($sql);
      $sql->bindValue(':login', $login);
      $sql->bindValue(':senha', md5($senha));
      $sql->execute();

      if($sql->rowCount() > 0){
        $sql = $sql->fetch();        
        
        $_SESSION['login'] = $sql['id'];        
        $response['status'] = true;

        return $response;

      }else{

        $response['mensagem'] = 'Usuário ou Senha Inválidos!';      
        $response['status'] = false;   
        $response['erro'] = true;

        return $response;
      }
    }

  }

  public function ativarUsuario($h){
    global $db;

    $db->query("UPDATE users SET ativo = 1 WHERE MD5(id) = '$h'");

    return true;
  }

  public function getUsuario($id){
    global $db;
    $array = array();

    $sql = "SELECT nome as usuario, login, email
            FROM users             
            WHERE id = :id";

    $sql = $db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch();
    }
      
    return $array;

  }

  public function getFotoPeril($id){
    global $db;
    $array = array();

    $sql = "SELECT nome as nome_foto
            FROM foto_perfil            
            WHERE id_user = :id";

    $sql = $db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();

    if($sql->rowCount() > 0){
      $array = $sql->fetch();
    }
      
    return $array;

  }

  public function updateFoto($foto, $idUser){  
    global $db;

    $sql = "SELECT id FROM foto_perfil WHERE id_user = :id_user";
    $sql = $db->prepare($sql);
    $sql->bindValue(':id_user', $idUser);    
    $sql->execute();

    if($sql->rowCount() > 0){ // Atualizar foto
      $id = $sql->fetch();

      $novoNome = md5(time().rand(0,99));
      move_uploaded_file($foto['tmp_name'],'../assets/perfil/'.$novoNome);

      $sql = "UPDATE foto_perfil SET id_user = :id_user, nome = :nome WHERE id = :id";
      $sql = $db->prepare($sql);
      $sql->bindValue(':id_user', $idUser);
      $sql->bindValue(':nome', $novoNome);
      $sql->bindValue(':id', $id['id']);
      $sql->execute();

      return $novoNome;

    }else{ // Salvar nova foto

      $novoNome = md5(time().rand(0,99));
      move_uploaded_file($foto['tmp_name'],'../assets/perfil/'.$novoNome);

      $sql = "INSERT INTO foto_perfil SET id_user = :id_user, nome = :nome";
      $sql = $db->prepare($sql);
      $sql->bindValue(':id_user', $idUser);
      $sql->bindValue(':nome', $novoNome);
      $sql->execute();
      
      return $novoNome;
    }    

  }

  public function updatePerfil($idUser, $senha){
    global $db;    

    $sql = "UPDATE users SET senha = :senha WHERE id = :id";
    $sql = $db->prepare($sql);
    $sql->bindValue(':senha', md5($senha));      
    $sql->bindValue(':id', $idUser);
    $sql->execute();          

    return true;    

  }

}
