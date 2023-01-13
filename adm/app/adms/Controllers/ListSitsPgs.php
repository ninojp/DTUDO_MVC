<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class ListSitsPgs
{
    /** @var array|string|null - Atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** ==============================================================================================
     * @return void     */
    public function index(string|int|null $page = null):void
    {
          //Atribui o parametro recebido:$page para o atributo:$this->page
          //converte para inteiro e verifica se possui valor, se não atribui o valor 1
          $this->page = (int) $page ? $page : 1;
          // var_dump($this->page);

        //Instância a classe:$AdmsListSitsPgs e cria o objeto:$listSitsUsers
       $listSitsPgs = new \App\adms\Models\AdmsListSitsPgs();
       // Usa o objeto para instanciar o método:listSitsUsers() da classe:$AdmsListSitsUsers 
       //envia para a models a pagina atual:$this->page
       $listSitsPgs->listSitsPgs($this->page);
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listSitsPgs->getResult()){
            $this->data['listSitsPgs'] = $listSitsPgs->getResultBd();
            // var_dump($this->data['listSitsUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listSitsPgs->getResultPg();
       } else {
            $this->data['listSitsPgs'] = [];
       }
       // implementação da apresentação dinâmica do menu sidebar
       $listMenu = new \App\adms\Models\helper\AdmsMenu();
       $this->data['menu'] = $listMenu->itemMenu();
       
       // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
       $this->data['sidebarActive'] = "list-sits-pgs";

       $loadSitsUsers = new \Core\ConfigView("adms/Views/pages/listSitsPgs", $this->data);
       $loadSitsUsers->loadView();
    }
}