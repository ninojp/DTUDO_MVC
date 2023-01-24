<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// use Core\ConfigView;

/** Classe Controller da pagina editar nova senha */
class UpdatePassword
{
    /** @var string|null - recebe a key q está vindo na URL, para cadastrar nova senha     */
    private string|null $key;
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ============================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void */
    public function index(): void
    {
        //Receber a key q está na URL
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        //receber todos os dados do Formulário:form-update-pass 
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        // var_dump($this->key);
        if((!empty($this->key)) and (empty($this->dataForm['SendUpPass']))) {
            $this->validateKey();
        } else {
            $this->updatePassword();
        }
    }
    /** =============================================================================================
     * @return void     */
    private function validateKey(): void
    {
        $valKey = new \App\adms\Models\AdmsUpdatePassword();
        $valKey->valKey($this->key);
        if($valKey->getResult()) {
            $this->viewUpdatePassword();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
    /** ============================================================================================
     * @return void     */
    private function updatePassword():void
    {
        if(!empty($this->dataForm['SendUpPass'])){
            unset($this->dataForm['SendUpPass']);
            $this->dataForm['key'] = $this->key;
            $upPassword = new \App\adms\Models\AdmsUpdatePassword();
            $upPassword->editPassword($this->dataForm);
            if($upPassword->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }else{
                $this->viewUpdatePassword();
            }
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link inválido, Solicite um novo Link <a href='".URLADM."recover-password/index'>Clique aqui</a></p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
    private function viewUpdatePassword():void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "update-password";

        // instancia a classe, cria o objeto e passa o parametro:$this->data
        $loadView = new \Core\ConfigView("adms/Views/login/updatePassword", $this->data);
        // Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewLogin();
    }
}
