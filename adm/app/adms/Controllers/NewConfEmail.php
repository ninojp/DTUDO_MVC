<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\AdmsNewConfEmail;
use Core\ConfigView;

/** ==================================================================================================
 * Controller da pagina receber um novo Link para confirmar e-mail  */
class NewConfEmail
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
    * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index():void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if(!empty($this->dataForm['SendNewConfEmail'])){
            unset($this->dataForm['SendNewConfEmail']);

            $newConfEmail = new AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);
            if($newConfEmail->getResult()){
                $urlRedirect = URLADM."login/index";
                header("Location: $urlRedirect");
            }else{
                //se não, mantém os dados no formulário
                $this->data['form'] = $this->dataForm;
                $this->viewNewConfEmail();
            }

        }else{
            $this->viewNewConfEmail();
        }
    }
    /** =============================================================================================
     * @return void     */
    private function viewNewConfEmail():void
    {
        $loadView = new ConfigView("adms/Views/login/newConfEmail", $this->data);
        $loadView->loadViewLogin();
    }
}