<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;

/** Classe(controllers) para editar a senha do E-mail */
class EditEmailConfsPass
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id)) and (empty($this->dataForm['SendEditEmailPass']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $viewAtualEmailPass = new \App\adms\Models\AdmsEditEmailConfsPass();
            $viewAtualEmailPass->viewAtualEmailPass($this->id);
            //verifica se a query obteve resultado(true, false)
            if($viewAtualEmailPass->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM]}
                $this->data['form'] = $viewAtualEmailPass->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditEmailPass();
            } else {
                $urlRedirect = URLADM . "list-email-confs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editEmailPass();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditEmailPass(): void
    {
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/emailConfs/editEmailConfsPass", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    private function editEmailPass():void
    {
        if(!empty($this->dataForm['SendEditEmailPass'])){
            unset($this->dataForm['SendEditEmailPass']);
            $editEmailConfsPass = new \App\adms\Models\AdmsEditEmailConfsPass();
            $editEmailConfsPass->updateEmailPass($this->dataForm);
            if($editEmailConfsPass->getResult()){
                $urlRedirect = URLADM . "view-email-confs/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditEmailPass();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Registro(E-mail) não encontrado!</p>";
            $urlRedirect = URLADM . "list-email-confs/index";
            header("Location: $urlRedirect");
        }
    }
}
