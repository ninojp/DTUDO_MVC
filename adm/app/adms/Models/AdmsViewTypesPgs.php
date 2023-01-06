<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewTypesPgs
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
    public function viewTypesPgs(int $id):void
    {
        $this->id = $id;

        $viewTypesPgs = new \App\adms\Models\helper\AdmsRead();
        $viewTypesPgs->fullRead("SELECT atp.id, atp.type, atp.name, atp.order_type_pg, atp.obs, atp.created, atp.modified FROM adms_types_pgs AS atp WHERE atp.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewTypesPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Typo da pagina não encontrado!</p>";
            $this->result = false;
        }
    }
}
