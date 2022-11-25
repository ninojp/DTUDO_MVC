<?php
namespace App\adms\Models\helper;

/** Classe genérica para validar o usuário único, somente um cadastro pode utilizar o usuário */
class AdmsValUserSingle
{
    /** @var string - Recebe o usuário q deve ser validado    */
    private string $email;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * o usuario para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do usuário q deve ser ignorado quando estiver validando o usuário para edição     */
    private int|null $id;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro*/
    private bool $result;
    
    /** ============================================================================================ 
     * Retorna true quando executtar o processo com sucesso e false quando houver erro
     * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *
     * @param string $email
     * @param boolean|null|null $edit
     * @param integer|null|null $id
     * @return void
     */
    public function validateEmailSingle(string $email, bool|null $edit=null, int|null $id=null):void
    {
        $this->email = $email; 
        // var_dump($this->email);
        $this->edit = $edit; 
        $this->id = $id; 

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
        }else{
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }
        $this->resultBd = $valEmailSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Este email já está cadastrado!</p>";
            $this->result = false;
        }

    }

}
