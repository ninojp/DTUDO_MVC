<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

class AdmsListSitsUsers
{
    //recebe o resultado true|fasse e os retorna quando solicitado
    private bool $result;

    //Recebe o resultado da query ao DB
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 10;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** =============================================================================================
     * Método que atribui o true ou false para o atributo:$result
     * @return boolean     */
    public function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     *  Método que recebe os dados da query ao DB e os atribui para o atributo:$resultBd 
     * @return array|null
     */
    public function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg():string|null
    {
        return $this->resultPg;
    }
    /** =============================================================================================
     * @return void     */
    public function listSitsUsers(int $page = null):void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM.'list-sits-users/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(sit.id) AS num_result FROM adms_sits_users AS sit");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listSitUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitUsers->fullRead("SELECT sits.id, sits.name AS sitsname, col.name AS colname, col.color FROM adms_sits_users AS sits INNER JOIN adms_colors AS col ON col.id=sits.adms_color_id ORDER BY sits.id DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSitUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhuma informação(Situação) encontrada na DB!</p>";
            $this->result - false;
        }
    }
}