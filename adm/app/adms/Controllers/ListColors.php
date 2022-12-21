<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(controller) para LISTAR as cores da DB
class ListColors
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

        //Instância a classe:$AdmsListColors e cria o objeto:$listColors
       $listColors = new \App\adms\Models\AdmsListColors();
       // Usa o objeto para instanciar o método:listColors() da classe:$AdmsListColors 
       //envia para a models a pagina atual:$this->page
       $listColors->listColors($this->page);
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listColors->getResult()){
            $this->data['listColors'] = $listColors->getResultBd();
            // var_dump($this->data['listColors']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listColors->getResultPg();
       } else {
            $this->data['listColors'] = [];
       }
       $loadlistColors = new \Core\ConfigView("adms/Views/colors/listColors", $this->data);
       $loadlistColors->loadView();
    }
}