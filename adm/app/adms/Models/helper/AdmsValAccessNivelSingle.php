<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para validar o usuário único, somente um cadastro pode utilizar o usuário */
class AdmsValAccessNivelSingle
{
    /** @var string - Recebe o usuário q deve ser validado    */
    private string $name;

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
    public function validateAccessNivelsSingle(string $name, int|null $id=null):void
    {
        $this->name = $name; 
        // var_dump($this->user);
        $this->id = $id; 

        $valAccessNivelsSingle = new \App\adms\Models\helper\AdmsRead();
        if((!empty($this->name)) and (!empty($this->id))){
            $valAccessNivelsSingle->fullRead("SELECT id, name, order_levels FROM adms_access_levels WHERE name =:name AND id <>:id LIMIT :limit", "name={$this->name}&id={$this->id}&limit=1");
        }else{
            $valAccessNivelsSingle->fullRead("SELECT id FROM adms_access_levels WHERE name =:name LIMIT :limit", "name={$this->name}&limit=1");
        }
        $this->resultBd = $valAccessNivelsSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Este Nivel de Acesso já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
