<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;

/** Classe(controller): para editar os dados da página  */
class EditPages
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsEditPages responsável em editar o registro no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id)) and (empty($this->dataForm['SendEditPages']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $viewPages = new \App\adms\Models\AdmsEditPages();
            $viewPages->viewPages($this->id);
            //verifica se a query obteve resultado(true, false)
            if($viewPages->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewPages->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditPages();
            } else {
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário enviar o ID)Usuário não encontrado!</p>";
            // $urlRedirect = URLADM . "list-users/index";
            // header("Location: $urlRedirect");
            $this->editPage();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditPages(): void
    {
        $listSelect = new \App\adms\Models\AdmsEditPages();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data);

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-pages";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/pages/editPages", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editPage():void
    {
        if(!empty($this->dataForm['SendEditPages'])){
            unset($this->dataForm['SendEditPages']);
            $editPage = new \App\adms\Models\AdmsEditPages();
            $editPage->updatePage($this->dataForm);
            if($editPage->getResult()){
                $urlRedirect = URLADM . "view-pages/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditPages();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Página não encontrado!</p>";
            $urlRedirect = URLADM . "list-pages/index";
            header("Location: $urlRedirect");
        }
    }
}
