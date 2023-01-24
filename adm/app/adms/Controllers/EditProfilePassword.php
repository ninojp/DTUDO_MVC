<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;

/** Classe da controller da pagina de editar senha perfil */
class EditProfilePassword
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if (!empty($this->dataForm['SendEditProfPass'])) {
            // var_dump($this->dataForm);
            $this->editProfPass();
        } else {
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewProfPass = new \App\adms\Models\AdmsEditProfilePassword();
            //método:viewProfile() q vai solicitar as informações no db
            $viewProfPass->viewProfile();
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewProfPass->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM, para enviar para View
                $this->data['form'] = $viewProfPass->getResultBd();
                $this->viewEditProfPass();
            } else {
                $urlRedirect = URLADM."login/index";
                header("Location: $urlRedirect");
            }
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditProfPass(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-profile-password";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/users/editProfilePassword", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editProfPass():void
    {
        if(!empty($this->dataForm['SendEditProfPass'])){
            unset($this->dataForm['SendEditProfPass']);
            $editProfPass = new \App\adms\Models\AdmsEditProfilePassword();
            $editProfPass->update($this->dataForm);
            if($editProfPass->getResult()){
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditProfPass();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Perfil não encontrado!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}
