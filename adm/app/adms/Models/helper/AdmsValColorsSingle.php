<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Models\Helper) para verificar se já existe uma cor cadastrada com o mesmo nome */
class AdmsValColorsSingle
{
    /** @var string - Recebe o nome da COR q deve ser validada    */
    private string $cor;
    /** @var boolean|null - Recebe a informação que é utilizada para verificar se é para validar
     * a situação para cadastro ou edição     */
    private bool|null $edit;
    /** @var integer|null - Recebe o id do registro q deve ser ignorado quando estiver validando a situação para edição     */
    private int|null $id;
    /** @var array|null - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var boolean - Recebe true quando executar o processo com sucesso e false quando houver erro*/
    private bool $result;
    
    /** ============================================================================================= 
     * Retorna true quando executtar o processo com sucesso e false quando houver erro
     * @return boolean */
    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * Método para validar se o nome da COR é única
     * Recebe a COR que deve ser verificado se o mesmo já existe no DB
     * Acessa o IF quando estiver validado a COR para o fomulário editar
     * Acessa o ELSE quando estiver validado a COR para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro, nenhum usuário utilizando o nome da COR em questão
     * Retorna FALSE quando o nome da COR já está sendo utilizado.
     * @param string $cor - Recebe o sits q deve ser validado
     * @param boolean|null|null $edit - Recebe TRUE quando deve validar o nome da COR para o formulário editar.
     * @param integer|null|null $id - Recebe o ID do registro quando deve validar o nome da COR para o formulário editar
     * @return void   */
    public function validateColorsSingle(string $cor, bool|null $edit=null, int|null $id=null):void
    {
        $this->cor = $cor; 
        // var_dump($this->cor);
        $this->edit = $edit; 
        $this->id = $id; 

        $valColorsSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valColorsSingle->fullRead("SELECT id FROM adms_colors WHERE (name =:name) AND id <>:id LIMIT :limit", "name={$this->cor}&id={$this->id}&limit=1");
        }else{
            $valColorsSingle->fullRead("SELECT id FROM adms_colors WHERE name =:name LIMIT :limit", "name={$this->cor}&limit=1");
        }
        $this->resultBd = $valColorsSingle->getResult();
        // var_dump($this->resultBd);
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Este Nome de Cor já está cadastrado!</p>";
            $this->result = false;
        }
    }

}
