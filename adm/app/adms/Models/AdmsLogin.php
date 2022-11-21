<?php
namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use PDO;
/** Classe:AdmsLogin, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsLogin extends AdmsConn
{
    private array|null $data;
    private object $conn;
    //atributo com o resultado da query ao DB, table adms_users
    private $resultDB;
    private $result;

    /** ===========================================================================================
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void */
    //este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function login(array $data=null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //instanciar o método:connectDb() da classe:AdmsConn()pai como abtract e cria o objeto:$connect
        $this->conn = $this->connectDb();
        // var_dump($conn);
        $query_val_login = "SELECT id,name,user,nickname,email,password,image FROM adms_users WHERE user=:users LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(':users',$this->data['user'], PDO::PARAM_STR);
        $result_val_login->execute();

        $this->resultDB = $result_val_login->fetch();
        if($this->resultDB){
            // var_dump($this->resultDB);
            $this->valPassword();
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário ou Senha incorreta<p>";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário não encontrado<p>";
            $this->result = false;
            // echo $_SESSION['msg'];
        } 
        // instanciar a classe quando ERA public
        // $connect = new AdmsConn();
        // $conn = $connect->connectDb();
        // var_dump($conn);
    }
    /** ===========================================================================================
     * @return void  */
    private function valPassword()
    {   
        //verifica se o password q está no atributo:$data e o mesmo do atributo:$resultDB
        if(password_verify($this->data['password'], $this->resultDB['password'])){
            // $_SESSION['msg'] = "<p class='alert alert-success'>Login realizado com sucesso<p>";
            //coloca na constante global:$_SESSION os seguiuntes valores
            $_SESSION['user_id'] = $this->resultDB['id'];
            $_SESSION['user_name'] = $this->resultDB['name'];
            $_SESSION['user_user'] = $this->resultDB['user'];
            $_SESSION['user_nickname'] = $this->resultDB['nickname'];
            $_SESSION['user_email'] = $this->resultDB['email'];
            $_SESSION['user_image'] = $this->resultDB['image'];
            $this->result = true;
            // echo $_SESSION['msg'];
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Senha não incorreta<p>";
            // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário ou Senha incorreta<p>";
            $this->result = false;
            // echo $_SESSION['msg'];
        }
    }
}