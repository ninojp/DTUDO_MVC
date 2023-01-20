<?php
namespace App\adms\Models;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe:AdmsListPermission, listar as permissões do nivel de acesso do DB */
class AdmsListPermission
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var array - Recebe o registro do Banco de dados referente ao nivel de acesso   */
    private array|null $resultBdLevel;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;
    
    /** @var int - $level - Recebe o id do nivel de acesso   */
    private int $level;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 40;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** ============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return void     */
    function getResult(): bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os registros(usuários) do DB 
     * @return void     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
     * Retorna os registro do Banco de dados referente ao nivel de acesso
     * @return void     */
    function getResultBdLevel(): array|null
    {
        return $this->resultBdLevel;
    }
    /** ============================================================================================
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * Método para pesquisar Niveis de acesso na tabela:adms_levels_pages e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado e o nivel de acesso   */
    public function listPermission(int $page = null, int $level = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        $this->level = (int) $level;

        if($this->viewAccessNivels()){
            //instância a classe:AdmsPagination, cria o objeto:$pagination 
            $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-permission/index', "?level={$this->level}");
            //instância o método para fazer a paginação
            $pagination->condition($this->page, $this->limitResult);
            //cria a query, buscar quantidade total de registros da tabela:adms_users
            $pagination->pagination("SELECT COUNT(lev_pag.id) AS num_result
            FROM adms_levels_pages AS lev_pag 
            LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id 
            WHERE lev_pag.adms_access_level_id =:adms_access_level_id
            AND (((SELECT permission 
            FROM adms_levels_pages 
            WHERE adms_page_id =lev_pag.adms_page_id 
            AND adms_access_level_id ={$_SESSION['access_level_id']}) = 1)
            OR (publish = 1))",
             "adms_access_level_id={$this->level}");
            //recebe o resultado do método:getResult() e atribui para:$this->resultPg
            $this->resultPg = $pagination->getResult();
            // var_dump($this->resultPg);
            //-------------------------------------------------------------------------------------

            $listPermission = new \App\adms\Models\helper\AdmsRead();
            // CONCEITO NOVO - QUERY dentro de outra QUERY
            $listPermission->fullRead("SELECT lev_pag.id, lev_pag.permission, lev_pag.order_level_page, lev_pag.print_menu, lev_pag.adms_access_level_id, lev_pag.adms_page_id, pag.name_page 
            FROM adms_levels_pages AS lev_pag 
            LEFT JOIN adms_pages AS pag ON pag.id=adms_page_id 
            INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id 
            WHERE lev_pag.adms_access_level_id =:adms_access_level_id
            AND lev.order_levels >=:order_levels
            AND (((SELECT permission FROM adms_levels_pages WHERE adms_page_id = lev_pag.adms_page_id 
            AND adms_access_level_id = {$_SESSION['access_level_id']}) = 1) OR (publish = 1))
            ORDER BY pag.id DESC LIMIT :limit OFFSET :offset", "adms_access_level_id={$this->level}&order_levels=".$_SESSION['order_levels']."&limit={$this->limitResult}&offset={$pagination->getOffset()}");

            $this->resultBd = $listPermission->getResult();
            if ($this->resultBd) {
                // var_dump($this->resultBd);
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhuma permissão para o Nivel de Acesso encontrado!</p>";
                $this->result = false;
            }
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhuma permissão para o Nivel de Acesso encontrado!</p>";
                $this->result = false;
        }
    }
    /** ========================================================================================
    */
    private function viewAccessNivels():bool
    {
        $viewAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $viewAccessNivels->fullRead("SELECT name FROM adms_access_levels WHERE id=:id AND order_levels >=:order_levels LIMIT :limit", "id={$this->level}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBdLevel = $viewAccessNivels->getResult();
        if($this->resultBdLevel){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewAccessNivels())! Nivel de acesso não encontrado!</p>";
            return false;
        }
    }
}
