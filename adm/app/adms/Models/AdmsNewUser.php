<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use App\adms\Models\helper\AdmsCreate;
use App\adms\Models\helper\AdmsValEmptyField;
use PDO;

/** Classe:AdmsNewUser, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsNewUser extends AdmsConn
{
    private array|null $data;
    private object $conn;
    //atributo com o resultado da query ao DB, table adms_users
    private $resultDB;
    private $result;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function create(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new AdmsValEmptyField();

        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);

        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {

            // Criptografar a senha
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            $this->data['user'] = $this->data['email'];
            $this->data['created'] = date("Y-m-d H:i:s");
            // var_dump($this->data);

            $createUser = new AdmsCreate();
            $createUser->exeCreate("adms_users", $this->data);

            //verifica se existe o ultimo ID inserido
            if($createUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o usuário</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /* ==========================================================================================
     * @param array|null $data
     * @return void   
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function create(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new AdmsValEmptyField();
        
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            //instanciar o método:connectDb() da classe:AdmsConn()pai como abtract e cria o objeto:$conn
            $this->conn = $this->connectDb();

            // Criptografar a senha
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            // var_dump($this->data);

            $query_new_user = "INSERT INTO adms_users (name, email, user, password, created) VALUE (:name, :email, :user, :password, NOW())";

            //Prepara a query e atribui para o OBJETO(atributo):$this->conn, em forma de string e depois coloca no objeto:$add_new_user
            $add_new_user = $this->conn->prepare($query_new_user);
            // var_dump($this->conn);

            //bindvalue(':link', 'valor'), para atribuir um valor ESTÁTICO ao :LINK,
            //PDO::PARAM_STR para forçar que seja uma string
            //bindParam(':link', '$variavel'), para atribuir um valor DINÂMICO ao :LINK
            $add_new_user->bindParam(':name', $this->data['name'], PDO::PARAM_STR);
            $add_new_user->bindParam(':email', $this->data['email'], PDO::PARAM_STR);
            $add_new_user->bindParam(':user', $this->data['email'], PDO::PARAM_STR);
            $add_new_user->bindParam(':password', $this->data['password'], PDO::PARAM_STR);
            // var_dump($add_new_user);

            $add_new_user->execute();
            //verifica se a query foi executada com sucesso:rowCount(), confirma se foi alterado alguma linha na tabela através do objeto:$add_new_user
            if ($add_new_user->rowCount()) {
                $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o usuário</p>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
    } */
}
