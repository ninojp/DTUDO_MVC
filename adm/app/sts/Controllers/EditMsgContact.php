<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina editar detalhes do artigo */
class EditMsgContact
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
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
        if ((!empty($id)) and (empty($this->dataForm['SendEditMsgContact']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $viewEditMsgContact = new \App\sts\Models\StsEditMsgContact();
            $viewEditMsgContact->viewEditMsgContact($this->id);
            //verifica se a query obteve resultado(true, false)
            if($viewEditMsgContact->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewEditMsgContact->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewMsgContact();
            } else {
                $urlRedirect = URLADM . "list-msg-contact/index";
                header("Location: $urlRedirect");
            }
        } else {

            $this->editMsgContact();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewMsgContact(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();


        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-msg-contact";
        
        //Instancio a classe:ConfigViewSts() e crio o objeto:$loadView
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contact/editMsgContact", $this->data);
        //Instancia o método:loadViewSts() da classe:ConfigViewSts
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * @return void     */
    private function editMsgContact():void
    {
        if(!empty($this->dataForm['SendEditMsgContact'])){
            unset($this->dataForm['SendEditMsgContact']);
            $editMsgContact = new \App\sts\Models\StsEditMsgContact();
            $editMsgContact->updateMsgContact($this->dataForm);
            if($editMsgContact->getResult()){
                $urlRedirect = URLADM . "view-msg-contact/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewMsgContact();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Mensagem não encontrado!</p>";
            $urlRedirect = URLADM . "list-msg-contact/index";
            header("Location: $urlRedirect");
        }
    }
}
