<?php

namespace App\adms\controllers;

use Core\ConfigView;

/** Classe Controller da pagina editar nova senha */
class UpdatePassword
{
    /** @var string|null - recebe a key q está vindo na URL, para cadastrar nova senha     */
    private string|null $key;
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index(): void
    {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        // var_dump($this->key);
        if (!empty($this->key)) {
            $this->validateKey();
        } else {
            echo "Sem chave<br>";
        }
        
    }
    private function validateKey(): void
    {
        $valKey = new \App\adms\Models\AdmsUpdatePassword();
        $valKey->valKey($this->key);
        if($valKey->getResult()) {
            // instancia a classe, cria o objeto e passa o parametro:$this->data
            $loadView = new ConfigView("adms/Views/login/updatePassword",$this->data);
            // Instancia o método:loadView() da classe:ConfigView
            $loadView->loadView();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}
