<?php
namespace App\adms\Models\helper;

/**  */
class AdmsValEmailSingle
{
    /** @var string - Recebe o email q deve ser validado    */
    private string $email;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * e-mail para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do usuário q deve ser ignorado quando estiver validando o email para edição     */
    private int|null $id;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro*/
    private bool $result;
    
/** Retorna true quando executtar o processo com sucesso e false quando houver erro
 * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** Método para validar se o email é único
     * Recebe o email que deve ser verificado se o mesmo já existe no DB
     * Acessa o IF quando estiver validado o email para o fomulário editar
     * Acessa o ELSE quando estiver validado o email para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro, nenhum usuário utilizando o e-mail em questão
     * Retorna FALSE quando o e-mail já está sendo utilizado por outro usuário
     * @param string $email - Recebe o email q deve ser validado
     * @param boolean|null|null $edit - Recebe TRUE quand deve validar o e-mail para o formulário editar.
     * @param integer|null|null $id - Recebe o ID do usuário quando deve validar o e-mail para o formulário editar
     * @return void   */
    public function validateEmailSingle(string $email, bool|null $edit=null, int|null $id=null):void
    {
        $this->email = $email; 
        // var_dump($this->email);
        $this->edit = $edit; 
        $this->id = $id; 

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE (email =:email OR user =:user) AND id <>:id LIMIT :limit", "email={$this->email}&user={$this->email}&id={$this->id}&limit=1");
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
