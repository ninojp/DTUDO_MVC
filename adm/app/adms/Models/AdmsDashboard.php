<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDashboard, Pagina inicial do sistema administrativo "Dashboard" */
class AdmsDashboard
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os dados   @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * Méodo para retornar os dados para o Dashboard
     * Retorna False se houver algun erro    */
    public function countUsers():void
    {
        $countUsers = new \App\adms\Models\helper\AdmsRead();
        $countUsers->fullRead("SELECT COUNT(id) AS qntUsers FROM adms_users");

        $this->resultBd = $countUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
}
