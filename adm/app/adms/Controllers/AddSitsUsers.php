<?php
namespace App\adms\Controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Controller cadastrar situação usuário  */
class AddSitsUsers
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**     
     * Método cadastrar situação usuário 
     * Receber os dados do formulário.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página nova situação usuário. Acessa o IF e instância a classe "AdmsAddSitsUsers" responsável em cadastrar asituação usuário no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     *  @return void     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddSitUser'])){
            unset($this->dataForm['SendAddSitUser']);
            $createSitUser = new \App\adms\Models\AdmsAddSitsUsers();
            $createSitUser->createAddSitsUsers($this->dataForm);
            if($createSitUser->getResult()){
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddSitUser();
            }   
        }else{
            $this->viewAddSitUser();
        }  
    }

    /**
     * Instanciar a MODELS e o método "listSelect" responsável em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddSitUser(): void
    {
        $listSelect = new \App\adms\Models\AdmsAddSitsUsers();
        $this->data['selectCor'] = $listSelect->listSelectCor();

        $loadView = new \Core\ConfigView("adms/Views/sitsUsers/addSitUsers", $this->data);
        $loadView->loadView();
    }
}
