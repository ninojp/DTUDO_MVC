<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;

class ListPermission
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var array|null - Recebe os dados do formulário de pesquisa   */
    private array|null $dataForm;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;
    
    /** @var string|integer|null - Recebe o id do nivel de acesso  */
    private string|int|null $level;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchName;

    /** @var string|null -  - Recebe o E-mail a ser pesquisado  */
    private string|null $searchEmail;

    /** ===========================================================================================
     * Método para listar as permições
     * Instância a models q ira buscar os registros no DB
     * Se encontrar registros, os envia para a view. Se não envia um array vazio
     * Passa o parametro:$page, para fazer a paginação
     * @return void   */
    public function index(string|int|null $page = null)
    {
        //recebe da view:listAccessNivels, o nivel de acesso(level), via url
        $this->level = filter_input(INPUT_GET, 'level', FILTER_SANITIZE_NUMBER_INT);
        // var_dump($this->level);

        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);

        //Recebe os dados do formulário de pesquisa:form_pesquisar
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);

        $listPermission = new \App\adms\Models\AdmsListPermission();
        
        //envia para a models a pagina atual e o nivel de acesso
        $listPermission->listPermission($this->page, $this->level);
        
        if($listPermission->getResult()){
            $this->data['listPermission'] = $listPermission->getResultBd();
            // var_dump($this->data['listPermission']);
            $this->data['viewAccessLevel'] = $listPermission->getResultBdLevel();
            // var_dump($this->data['viewAccessLevel']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listPermission->getResultPg();
            
            $this->data['pag'] = $this->page;

            $this->loadViewPermission();
        }else{
            // $this->data['listPermission'] = [];
            // $this->data['pagination'] = null;
            $urlRedirect = URLADM."list-access-nivels/index";
            header("Location: $urlRedirect");
        }
        
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewPermission():void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-access-nivels";

        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigView("adms/Views/permission/listPermission",$this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}