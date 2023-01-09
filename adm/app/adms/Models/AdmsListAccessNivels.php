<?php

namespace App\adms\Models;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class AdmsListAccessNivels
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 4;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** @var string|null -  - Recebe o nome do nivel a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null -  - Recebe o Nivel a ser pesquisado  */
    private string|null $searchaccessesNivels;

    /** @var string|null - Recebe o nome a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchNameValue;

    /** @var string|null - Recebe o Nivel a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchaccessesNivelsValue;

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
     * Método para pesquisar Niveis de acesso na tabela:adms_access_levels e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado    */
    public function listAccessNivels(int $page = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-access-nivels/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_access_levels WHERE order_levels >:order_levels", "order_levels=".$_SESSION['order_levels']);
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listAccessesNivels = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listAccessesNivels->fullRead("SELECT id, name, order_levels FROM adms_access_levels WHERE order_levels > :order_levels ORDER BY order_levels ASC LIMIT :limit OFFSET :offset", "order_levels=".$_SESSION['order_levels']."&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAccessesNivels->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum Nivel de Acesso encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar(formulario de pesquisa) Niveis de acesso na tabela:adms_access_levels e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado    */
    public function listSeachAccessesNivels(int $page = null, string|null $search_name, string|null $accesses_Nivels): void
    {
        //atribui os parametros recebidos para os devidos atributos
        $this->page = (int) $page ? $page : 1;
        //usa o trim para retirar os espaços em branco
        $this->searchName = trim($search_name);
        $this->searchaccessesNivels = trim($accesses_Nivels);
        // var_dump($this->searchName);
        // var_dump($this->searchEmail);

        //define que a variavel q vai ser usada na query de pesquisa pode ter valores antes e depois
        $this->searchNameValue = "%" . $this->searchName . "%";
        $this->searchaccessesNivelsValue = "%" . $this->searchaccessesNivels . "%";
        // var_dump($this->searchNameValue);
        // var_dump($this->searchEmailValue);

        //verifica se está recebendo os dois campos de pesquisa, nome e email
        if ((!empty($this->searchName)) and (!empty($this->searchaccessesNivels))) {
            $this->searchAccessNameNivels();
            //verifica se está recebendo o NOME
        } elseif ((!empty($this->searchName)) and (empty($this->searchaccessesNivels))) {
            $this->searchAccessName();
            //verifica se está recebendo o E-MAIL
        } elseif ((empty($this->searchName)) and (!empty($this->searchaccessesNivels))) {
            $this->searchAccessNivels();
        } else {
            $this->searchAccessNameNivels();
        }
    }
    /** ============================================================================================
     * Método para pesquisar pelo NOME do Nivel e o numero do nivel    */
    public function searchAccessNameNivels(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-access-nivels/index', "?search_name={$this->searchName}&search_access_nivels={$this->searchaccessesNivels}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_access_levels WHERE name LIKE :search_name OR order_levels LIKE :search_access_nivels", "search_name={$this->searchNameValue}&search_access_nivels={$this->searchaccessesNivelsValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listNivelsAccess = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listNivelsAccess->fullRead("SELECT id, name, order_levels FROM adms_access_levels WHERE name LIKE :search_name OR order_levels LIKE :search_access_nivels ORDER BY id DESC LIMIT :limit OFFSET :offset",
         "search_name={$this->searchNameValue}&search_access_nivels={$this->searchaccessesNivelsValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listNivelsAccess->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum Nivel de acesso encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar somente pelo NOME do Nivel    */
    public function searchAccessName(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-access-nivels/index', "?search_name={$this->searchName}&search_access_nivels={$this->searchaccessesNivels}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_access_levels WHERE name LIKE :search_name OR order_levels LIKE :search_access_nivels", "search_name={$this->searchNameValue}&search_access_nivels={$this->searchaccessesNivelsValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listNivelsName = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listNivelsName->fullRead("SELECT id, name, order_levels FROM adms_access_levels WHERE name LIKE :search_name OR order_levels LIKE :search_access_nivels ORDER BY id DESC LIMIT :limit OFFSET :offset",
        "search_name={$this->searchNameValue}&search_access_nivels={$this->searchaccessesNivelsValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listNivelsName->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum Nome de nivel encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar somente pelo E-Mail    */
    public function searchAccessNivels(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-access-nivels/index', "?search_name={$this->searchName}&search_access_nivels={$this->searchaccessesNivels}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(aal.id) AS num_result FROM adms_access_levels AS aal WHERE aal.order_levels LIKE :search_access_nivels", "search_access_nivels={$this->searchaccessesNivelsValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------

        $listAccessNivels = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listAccessNivels->fullRead("SELECT aal.id, aal.name, aal.order_levels FROM adms_access_levels AS aal WHERE aal.name LIKE :search_name ORDER BY aal.id DESC LIMIT :limit OFFSET :offset",
        "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAccessNivels->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum Nivel de acesso encontrado!</p>";
            $this->result = false;
        }
    }
}
