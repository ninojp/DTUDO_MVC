<?php
namespace App\adms\controllers;

use Core\ConfigView;

/** Classe da controller da pagina de editar Imagem do Perfil */
class EditProfileImage
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
        if (!empty($this->dataForm['SendEditProfImage'])) {
            // var_dump($this->dataForm);
            $this->editProfImage();
        } else {
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewProfImg = new \App\adms\Models\AdmsEditProfileImage();
            //método:viewProfile() q vai solicitar as informações no db
            $viewProfImg->viewProfile();
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewProfImg->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM
                $this->data['form'] = $viewProfImg->getResultBd();
                $this->viewEditProfileImage();
            } else {
                $urlRedirect = URLADM."login/index";
                header("Location: $urlRedirect");
            }
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditProfileImage(): void
    {
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/users/editProfileImage", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editProfImage():void
    {
        if(!empty($this->dataForm['SendEditProfImage'])){
            unset($this->dataForm['SendEditProfImage']);
            // Operador ternário, se for (verdadeiro)true utiliza a própria imagem se não atribui null
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editProfImg = new \App\adms\Models\AdmsEditProfileImage();
            $editProfImg->update($this->dataForm);
            if($editProfImg->getResult()){
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditProfileImage();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Perfil não encontrado!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}
