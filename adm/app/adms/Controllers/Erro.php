<?php
namespace App\adms\controllers;

use Core\ConfigView;

class Erro
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index():void
    {
        echo "adms/Controller/Erro.php: <h1> Página(controller) de ERRO!</h1>";

        $this->data = "<p class='alert alert-danger'>Página não encontrada</p>";
        // $this->data = [];

        //instancia a classe, cria o objeto e passa o parametro:$this->data
        $loadView = new ConfigView("adms/Views/erro/erro",$this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();

    }
}