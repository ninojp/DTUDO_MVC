<?php

namespace App\sts\Models;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class StsListMsgContact
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** @var int -  - Recebe o numero da pagina atual   */
    private int $page;

    /** @var integer - Recebe a quantidade de registros que deve retornar do DB    */
    private int $limitResult = 10;

    /** @var string|null -  - Recebe a paginação  */
    private string|null $resultPg;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchSubject;

    /** @var string|null - Recebe o nome a ser pesquisado, que pode conter caracteres antes e depois  */
    private string|null $searchSubjectValue;

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
    public function listMsgContact(int $page = null): void
    {
        //------------------------------ PAGINAÇÂO -------------------------------------------
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-msg-contact/index');
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination("SELECT COUNT(scm.id) AS num_result FROM sts_contacts_msgs AS scm");
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------
        $listAboutPg = new \App\adms\Models\helper\AdmsRead();
        $listAboutPg->fullRead("SELECT scm.id, scm.name, scm.email, scm.subject, scm.content FROM sts_contacts_msgs AS scm ORDER BY scm.id DESC LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listAboutPg->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (listMsgContact())! Nenhuma Mensagem encontrado!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Método para pesquisar(formulario de pesquisa) usuários na tabela:adms_users e listar as informações na view
     * Recebe o parametro:$page para que seja feita a paginação do resultado
     * Recebe o parametro:search_name para que seja feita a pesquisa pelo nome
     * Recebe o parametro:search_email para que seja feita a pesquisa pelo e-mail    */
    public function listSearchMsgContact(int $page = null, string|null $subject): void
    {
        //atribui os parametros recebidos para os devidos atributos
        $this->page = (int) $page ? $page : 1;

        //usa o trim para retirar os espaços em branco
        $this->searchSubject = trim($subject);
        // $this->searchSubject = $search_name;
        // var_dump($this->searchSubject);

        //define que a variavel q vai ser usada na query de pesquisa pode ter valores antes e depois
        $this->searchSubjectValue = "%".$this->searchSubject."%";
        // var_dump($this->searchSubjectValue);
        $this->searchMsgContact();
    }
    /** ============================================================================================
     * Método para pesquisar pelo NOME e E-Mail    */
    public function searchMsgContact(): void
    {
        //instância a classe:AdmsPagination, cria o objeto:$pagination 
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-msg-contact/index', "?subject={$this->searchSubject}");
        //instância o método para fazer a paginação
        $pagination->condition($this->page, $this->limitResult);
        //cria a query, buscar quantidade total de registros da tabela:adms_users
        $pagination->pagination("SELECT COUNT(scm.id) AS num_result FROM sts_contacts_msgs AS scm
        WHERE scm.subject LIKE :subject OR scm.content LIKE :content", "subject={$this->searchSubjectValue}&content={$this->searchSubjectValue}");
        //recebe o resultado do método:getResult() e atribui para:$this->resultPg
        $this->resultPg = $pagination->getResult();
        // var_dump($this->resultPg);
        //-------------------------------------------------------------------------------------
        $listsearchMsgContact = new \App\adms\Models\helper\AdmsRead();
        //INNER JOIN, é obrigátorio(para retornar o registro) q a chave EXTRANGEIRA:adms_sits_user_id exista na tabela outra tabela, a qual está se fazendo o inner join(adms_sits_users)
        $listsearchMsgContact->fullRead("SELECT scm.id, scm.name, scm.email, scm.subject, scm.content FROM sts_contacts_msgs AS scm 
        WHERE scm.subject LIKE :subject OR scm.content LIKE :content
        ORDER BY scm.id DESC LIMIT :limit OFFSET :offset",
        "subject={$this->searchSubjectValue}&content={$this->searchSubjectValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listsearchMsgContact->getResult();
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (searchMsgContact())! Nenhuma Mensagem encontrado!</p>";
            $this->result = false;
        }
    }

}
