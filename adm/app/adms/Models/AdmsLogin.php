<?php
namespace App\adms\Models;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){
    // Redireciona para a pagina escolhida
    // header("Location: /");
    header("Location: https://localhost/dtudo/public/");
    // Ou termina a execução e exibe a mensagem de erro
    // die("Erro! Página não encontrada<br>");
}
/** Classe:AdmsLogin, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsLogin
{
    private array|null $data;
    // Atributo q recebe o resultado da query ao DB, table adms_users
    private $resultBd;
    // Recebe true quando executar o processo com sucesso e false quando houver erro
    private $result;

    /** ===========================================================================================
     * Método q atribui ao atributo o valor true ou false 
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null - recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * @return void 
     * Este método recupera as informações do usuário no banco de dados:$viewUser->fullRead
     * Quando encontrar o usuário no DB, instancia o método:$this->valPassword(), para validadar
     * a senha, retornando true se não encontrar retorna false */
    public function login(array $data=null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        $viewUser = new \App\adms\Models\helper\AdmsRead();

        //Retorna somente as colunas indicadas e Faz a verificação:WHERE através do USER OR EMAIL
        $viewUser->fullRead("SELECT usr.id, usr.name, usr.nickname, usr.email, usr.password, usr.image, usr.adms_sits_user_id, usr.access_level_id, lev.order_levels FROM adms_users AS usr INNER JOIN adms_access_levels AS lev ON lev.id=usr.access_level_id WHERE usr.user =:user OR usr.email =:email LIMIT :limit", "user={$this->data['user']}&email={$this->data['user']}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->valEmailPerm();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }        
    }
    /** ==============================================================================================
     * @return void     */
    private function valEmailPerm():void
    {
        if($this->resultBd[0]['adms_sits_user_id'] == 1) {
            $this->valPassword();
        }elseif($this->resultBd[0]['adms_sits_user_id'] == 3){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário confirmar o E-mail, Solicite um novo:<a href='".URLADM."new-conf-email/index'> link aqui!</a></p>";
            $this->result = false;
        }elseif($this->resultBd[0]['adms_sits_user_id'] == 5){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail Descadastrado(foi removido), entre em contato com a empresa!</p>";
            $this->result = false;
        }elseif($this->resultBd[0]['adms_sits_user_id'] == 2){
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! E-mail INATIVO, entre em contato com a empresa!</p>";
            $this->result = false;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! E-mail Spam!, entre em contato com a empresa!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void  */
    private function valPassword()
    {   
        //verifica se o password q está no atributo:$data e o mesmo do atributo:$resultDB
        if(password_verify($this->data['password'], $this->resultBd[0]['password'])){
            // $_SESSION['msg'] = "<p class='alert alert-success'>Login realizado com sucesso</p>";
            //coloca na constante global:$_SESSION os seguintes valores do usuário
            $_SESSION['user_id'] = $this->resultBd[0]['id'];
            $_SESSION['user_name'] = $this->resultBd[0]['name'];
            $_SESSION['user_nickname'] = $this->resultBd[0]['nickname'];
            $_SESSION['user_email'] = $this->resultBd[0]['email'];
            $_SESSION['user_image'] = $this->resultBd[0]['image'];
            $_SESSION['access_level_id'] = $this->resultBd[0]['access_level_id'];
            $_SESSION['order_levels'] = $this->resultBd[0]['order_levels'];
            $this->result = true;
            // echo $_SESSION['msg'];
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Senha não incorreta</p>";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário ou Senha incorreta</p>";
            $this->result = false;
            // echo $_SESSION['msg'];
        }
    }
    //=============================================================================================
    // método LOGIN, feito no começo do projeto...
    // public function login(array $data=null)
    // {
        //atribui o parametro:$data para o atributo:$this->data
        // $this->data = $data;
        // var_dump($this->data);
        // $viewUser = new \App\adms\Models\helper\AdmsRead();
        // Retorna TODAS as colunas da TABELA
        // $viewUser->exeRead("adms_users", "WHERE user =:user LIMIT :limit", "user={$this->data['user']}&limit=1");

        //instanciar o método:connectDb() da classe:AdmsConn()pai como abtract e cria o objeto:$connect
        // $this->conn = $this->connectDb();
        // // var_dump($conn);
        // $query_val_login = "SELECT id, name, nickname, email, password, image FROM adms_users WHERE user=:user LIMIT 1";
        // $result_val_login = $this->conn->prepare($query_val_login);
        // $result_val_login->bindParam(':user',$this->data['user'], PDO::PARAM_STR);
        // $result_val_login->execute();

        // $this->resultBd = $result_val_login->fetch();
        // if($this->resultBd){
        //     // var_dump($this->resultDB);
        //     $this->valPassword();
        // }else{
        //     // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário ou Senha incorreta</p>";
        //     $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Usuário não encontrado</p>";
        //     $this->result = false;
        //     // echo $_SESSION['msg'];
        // } 
        // // instanciar a classe quando ERA public
        // // $connect = new AdmsConn();
        // // $conn = $connect->connectDb();
        // // var_dump($conn);
    // }
}