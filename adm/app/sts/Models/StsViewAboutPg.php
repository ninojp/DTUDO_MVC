<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:StsViewAboutPg, Visualizar os dados do registro da tabela:sts_abouts_companies no DB */
class StsViewAboutPg
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
    public function viewAboutPg(int $id):void
    {
        $this->id = $id;
        $viewUsers = new \App\adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT sac.id, sac.title, sac.description, sac.image, sac.created, sac.modified, sit.name FROM sts_abouts_companies AS sac
        INNER JOIN sts_situations AS sit ON sit.id=sac.sts_situation_id
        WHERE sac.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewAboutPg(Models))! Registro não encontrado!</p>";
            $this->result = false;
        }
    }
}
