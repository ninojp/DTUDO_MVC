<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Confirmar a chave atualizar senha. Cadastrar nova senha */
class AdmsUpdatePassword
{
    /** @var string - Recebe da URL a chave para atualizar a senha  */
    private string $key;
    /** @var boolean - Recebe do método:getResult() o valor:(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail  */
    private array $resultBd;
    /** @var array - Recebe os valores q devem ser salvos no banco de dados  */
    private array $dataSave;
    /** @var array|null - recebe as informações do formulário    */
    private array|null $data;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function valKey(string $key):bool
    {
        $this->key = $key;
        // var_dump($this->key);
        $viewKeyUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewKeyUpPass->fullRead("SELECT id FROM adms_users WHERE recover_password=:recover_password LIMIT :limit", "recover_password={$this->key}&limit=1");
        $this->resultBd = $viewKeyUpPass->getResult();
        if($this->resultBd){
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link inválido, Solicite um novo Link <a href='".URLADM."recover-password/index'>Clique aqui</a></p>";
            $this->result = false;
            return false;
        }
    }
    /** =============================================================================================
     * @param array|null $data
     * @return void     */
    public function editPassword(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if($valEmptyField->getResult()){
            $this->valInput();
        }else{
            $this->result = false;
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function valInput():void
    {
        $valPasword = new \App\adms\Models\helper\AdmsValPassword(); 
        $valPasword->validatePassword($this->data['password']); 
        if($valPasword->getResult()){
            if($this->valKey($this->data['key'])){
                $this->updatePassword();
            }else{
                $this->result = false;
            }
        }else{
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function updatePassword():void
    {
        $this->dataSave['recover_password'] = null;
        $this->dataSave['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");

        $upPassword = new \App\adms\Models\helper\AdmsUpdate();
        $upPassword->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");
        if($upPassword->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>OK! Senha atualizada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível atualiazr a senha</p>";
            $this->result = false;
        }
    }
}
