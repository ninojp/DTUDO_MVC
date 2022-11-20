<?php

namespace App\adms\controllers;

use App\adms\Models\AdmsLogin;
use Core\ConfigView;

class Login
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index(): void
    {
        // echo "adms/Controller/Login.php: <h1> Página(controller) de Login</h1>";

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendLogin'])) {
            // var_dump($this->dataForm);

            $valLogin = new AdmsLogin();
            $valLogin->login($this->dataForm);

            //cria uma nova posição dentro do array $dataForm
            $this->data['form'] = $this->dataForm;
        }

        // $this->data = null;
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/login/login", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}
