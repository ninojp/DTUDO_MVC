<?php
namespace App\adms\controllers;

use Core\ConfigView;

class ListUsers
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** ===========================================================================================
     * @return void   */
    public function index()
    {
        $listUsers = new \App\adms\Models\AdmsListUsers();
        $listUsers->listUsers();
        if($listUsers->getResult()){
            $this->data['listUsers'] = $listUsers->getResultBd();
            // var_dump($this->data['listUsers']);
        }else{
            $this->data['listUsers'] = [];
        }
        
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigView("adms/Views/users/listUsers",$this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();

    }
}