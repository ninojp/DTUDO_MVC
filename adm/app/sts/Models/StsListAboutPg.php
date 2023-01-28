<?php

namespace App\sts\Models;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class StsListAboutPg
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 5;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null - Recebe o nome a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchNameValue;

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
     * @return string|null  - Retorna a paginação   */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    /** ============================================================================================
     * Método para pesquisar usuários na tabela:adms_users e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado    */
    public function listAboutPg(int $page = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-about-pg/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_users AS usr INNER JOIN adms_access_levels AS lev ON lev.id=access_level_id 
        WHERE lev.order_levels >:order_levels", "order_levels=".$_SESSION['order_levels']);
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id, sit.name AS name_sit, col.name AS name_col, col.color 
        FROM adms_users AS usr INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id INNER JOIN adms_colors AS col ON sit.adms_color_id=col.id
        INNER JOIN adms_access_levels AS lev ON lev.id=access_level_id 
        WHERE lev.order_levels >:order_levels
        ORDER BY usr.id DESC LIMIT :limit OFFSET :offset", "order_levels=".$_SESSION['order_levels']."&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (listUsers())! Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar(formulario de pesquisa) usuários na tabela:adms_users e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado
     * Recebe o parametro:search_name para que seja feita a pesquisa pelo nome
     * Recebe o parametro:search_email para que seja feita a pesquisa pelo e-mail    */
    public function listSearchUsers(int $page = null, string|null $search_name): void
    {
        //atribui os parametros recebidos para os devidos atributos
        $this->page = (int) $page ? $page : 1;

        //usa o trim para retirar os espaços em branco
        $this->searchName = trim($search_name);
        // $this->searchName = $search_name;
        // var_dump($this->searchName);

        //define que a variavel q vai ser usada na query de pesquisa pode ter valores antes e depois
        $this->searchNameValue = "%".$this->searchName."%";
        // var_dump($this->searchNameValue);

        //verifica se está recebendo os dois campos de pesquisa, nome e email
        if ((!empty($this->searchName))) {
            $this->searchUserNameEmail();
        }
    }
    /** ============================================================================================
     * Método para pesquisar pelo NOME e E-Mail    */
    public function searchUserNameEmail(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_users AS usr
        INNER JOIN adms_access_levels AS lev ON lev.id=usr.access_level_id
        WHERE (lev.order_levels >:order_levels) AND ((usr.name LIKE :search_name) OR (usr.email LIKE :search_email))",
        "order_levels=".$_SESSION['order_levels']."&search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listUsersNameEmail = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listUsersNameEmail->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id, sit.name AS name_sit, col.name AS name_col, col.color 
        FROM adms_users AS usr
        INNER JOIN adms_access_levels AS lev ON lev.id=usr.access_level_id
        INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
        INNER JOIN adms_colors AS col ON sit.adms_color_id=col.id
        WHERE (lev.order_levels >:order_levels)
        AND ((usr.name LIKE :search_name) OR (usr.email LIKE :search_email))
        ORDER BY usr.id DESC LIMIT :limit OFFSET :offset",
        "order_levels=".$_SESSION['order_levels']."&search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}" );

        $this->resultBd = $listUsersNameEmail->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (searchUserNameEmail())! Nenhum usuário ou e-mail encontrado!</p>";
            $this->result = false;
        }
    }

}
