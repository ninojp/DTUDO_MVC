<?php
namespace App\adms\controllers;

// use App\adms\Models\AdmsRecoverPassword;
use Core\ConfigView;

class RecoverPassword
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
     * Método para instanciar a classe responsável em carregar a View e enviar os dados para a View.
     * @return void */
    public function index():void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dataForm['SendRecoverPass'])){
            unset($this->dataForm['SendRecoverPass']);
            $recoverPass = new \App\adms\Models\AdmsRecoverPassword();
            $recoverPass->recoverPassword($this->dataForm);

            if($recoverPass->getResult()){
                $this->data['form'] = $this->dataForm;
            }else{
                $this->viewRecoverPass();
            }
        }else{
            $this->viewRecoverPass();
        }
    }
    /** ==========================================================================================
     * 
     */
    private function viewRecoverPass():void
    {
       $loadView = new ConfigView("adms/Views/login/recoverPassword", $this->data);
       $loadView->loadView();
    }
}