<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para validar o usuário único, somente um cadastro pode utilizar o usuário */
class AdmsValUserSingleLogin
{
    /** @var string - Recebe o usuário q deve ser validado    */
    private string $user;
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
     * Método para validar se o usuário já existe no banco de dados
     * @param string $email
     * @param boolean|null|null $edit
     * @param integer|null|null $id
     * @return void    */
    public function validateUserSingleLogin(string $user, bool|null $edit=null, int|null $id=null):void
    {
        $this->user = $user; 
        // var_dump($this->user);
        $this->edit = $edit; 
        $this->id = $id; 

        $valUserSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:user id <>:id LIMIT :limit", "user={$this->email}&id={$this->id}&limit=1");
        }else{
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:user LIMIT :limit", "user={$this->user}&limit=1");
        }
        $this->resultBd = $valUserSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Este email já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
