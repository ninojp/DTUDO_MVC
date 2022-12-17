<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class ListSitsUsers
{
    /** @var array|string|null - Atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** ==============================================================================================
     * @return void     */
    public function index():void
    {
        //Instância a classe:$AdmsListSitsUsers e cria o objeto:$listSitsUsers
       $listSitsUsers = new \App\adms\Models\AdmsListSitsUsers();
       // Usa o objeto para instanciar o método:listSitsUsers() da classe:$AdmsListSitsUsers 
       $listSitsUsers->listSitsUsers();
        //Verifica, através do método:getResult(), se obteve resultado, atribui para:$data
       if($listSitsUsers->getResult()){
            $this->data['listSitsUsers'] = $listSitsUsers->getResultBd();
            // var_dump($this->data['listSitsUsers']);
       } else {
            $this->data['listSitsUsers'] = [];
       }
       $loadSitsUsers = new \Core\ConfigView("adms/Views/sitsUsers/listSitsUsers", $this->data);
       $loadSitsUsers->loadView();
    }
}