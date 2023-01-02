<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewAccessNivels
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewAccessNivels(int $id):void
    {
        $this->id = $id;

        $viewAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $viewAccessNivels->fullRead("SELECT id, name, order_levels, created, modified FROM adms_access_levels WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewAccessNivels->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de acesso não encontrado!</p>";
            $this->result = false;
        }
    }
}
