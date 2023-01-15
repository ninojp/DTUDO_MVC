<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\helper\AdmsCreate;
use App\adms\Models\helper\AdmsValEmail;
use App\adms\Models\helper\AdmsValEmptyField;
/** Classe:AdmsNewUser, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsNewUser
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var string - Recebe o e-mail do remetente    */
    private string $fromEmail;

    /** @var string - Recebe o primeiro nome(digitado) do usuário    */
    private string $firstName;

    /** @var string - Recebe a URL com o endereço para o usuário confirmar o e-mail   */
    private string $url;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $emailData;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * Recebe os valores do fomulário.   -  @param array|null $data
     * Instância o Helper:AdmsValEmptyField para verificar se todos os campos foram preenchidos
     * Instância o método:valInput para validar os dados dos campos. 
     * Retorna false quando algun campo está vazio  -  @return void    */
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
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:AdmsValEmail para verificar se o e-mail é válido
     * Instânciar o Helper:AdmsValEmailSingle para verificar se o e-mail não está cadastrado no DB, não permitido cadastro com e-mail duplicado.
     * Instânciar o Helper:validatePassword para validar a senha
     * Instânciar o Helper:validateUserSingleLogin para verificar se o usuário não está cadastrado no DB, não permitido cadastro duplicado
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna flase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        //instancia a classe para Validar se o email já existe no banco de dados
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        //instancia a classe para Validar a senha
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        //instancia a classe para validadr se o usuário já existe no DB
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        //no caso o parametro é EMAIL, pois foi utilizado para cadastrar o NOME do USER
        $valUserSingleLogin->validateUserSingleLogin($this->data['email']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult()) and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function add(): void
    {
        if($this->accessLevel()){
            // Criptografar a senha
            $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
            $this->data['user'] = $this->data['email'];
            $this->data['conf_email'] = password_hash($this->data['password'].date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
            $this->data['created'] = date("Y-m-d H:i:s");
            var_dump($this->data);

            $createUser = new \App\adms\Models\helper\AdmsCreate();
            $createUser->exeCreate("adms_users", $this->data);

            //verifica se existe o ultimo ID inserido
            if ($createUser->getResult()) {
                // $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
                // $this->result = true;
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o usuário</p>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (accessLevel())! Não foi possível cadastrar o usuário</p>";
            $this->result = false;
        }
    }
    /** -------------------------------------------------------------------------------------------
     * Pesquisar no banco de dados o nivel de acesso e a situação que deve ser utilizada no formulário cadastrar usuário na pagina de login
     * @return bool - verdadeiro ou false    */
    private function accessLevel(): bool
    {
        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT adms_access_level_id, adms_sits_user_id FROM adms_levels_forms ORDER BY id ASC LIMIT :limit", "limit=1");
        $this->resultBd = $viewAccessLevel->getResult();
        var_dump($this->resultBd);
        if($this->resultBd){
            //ERRO MEU... na tabela adms_users DEVERIA ser:adms_access_level_id eu colquei:access_level_id
            $this->data['access_level_id'] = $this->resultBd[0]['adms_access_level_id'];
            $this->data['adms_sits_user_id'] = $this->resultBd[0]['adms_sits_user_id'];
            return true;
        } else {
            return false;
        }
        
    }
    /** =============================================================================================
     * Médoto responsável por enviar o e-mail    -  @return void     */
    private function sendEmail(): void
    {
        $this->contentEmailHtml();
        $this->contentEmailText();
        
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $sendEmail->sendEmail($this->emailData, 2);

        //faz a notificação se conseguiu ou não enviar o email
        if($sendEmail->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso, acesse sua caixa de e-mail para confirmar o e-mail!</p>";
            $this->result = true;
        }else{
            //instancia o método:getFromEmail(), para receber o email de quem está enviando
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert alert-warning'>Usuário cadastrado com sucesso. Mas houve um erro ao enviar o e-mail de confirmação, entre em contado com {$this->fromEmail}</p>";
            $this->result = true;
        }
    }
    /** =============================================================================================
     * Método para criação do conteúdo HTML do e-mail
     * @return void     */
    private function contentEmailHtml():void
    {
        $name = explode(" ", $this->data['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = "Confirme seu E-mail!";
        $this->url = URLADM."conf-email/index?key=".$this->data['conf_email'];

        $this->emailData['contentHtml'] = "Prezado Sr(a) {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos sua solicitação de cadastro em nosso site!.<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicando no link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta menssagem foi enviado a você pela empresa XXX.<br>Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...<br><br>";
    }
    /** =============================================================================================
     * Método para criação do conteúdo TXT do e-mail
     * @return void     */
    private function contentEmailText():void
    {
        $this->emailData['contentText'] = "Prezado Sr(a) {$this->firstName}.\n\n";
        $this->emailData['contentText'] .= "Agradecemos sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail. COPIE e COLE o endereço abaixo, na barra de endereço do seu navegador de internet.\n\n";
        $this->emailData['contentText'] .= $this->url."\n\n ";
        $this->emailData['contentText'] .= "Esta menssagem foi enviado a você pela empresa XXX.\n Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...\n\n";
    }
    /* ==========================================================================================
     * USADO DURANTE O COMEÇO DO DESENVOLVIMENTO DO PROJETO NAS AULAS
     * este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
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
