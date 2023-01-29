<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina editar detalhes do artigo */
class EditAboutPg
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
        if ((!empty($id)) and (empty($this->dataForm['SendEditAboutPg']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $viewEditAboutPg = new \App\sts\Models\StsEditAboutPg();
            $viewEditAboutPg->viewEditAboutPg($this->id);
            //verifica se a query obteve resultado(true, false)
            if($viewEditAboutPg->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewEditAboutPg->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewAboutPg();
            } else {
                $urlRedirect = URLADM . "list-about-pg/index";
                header("Location: $urlRedirect");
            }
        } else {

            $this->editAboutPg();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewAboutPg(): void
    {
        $listSelect = new \App\sts\Models\StsEditAboutPg();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();


        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-about-pg";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/about/editAboutPg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * @return void     */
    private function editAboutPg():void
    {
        if(!empty($this->dataForm['SendEditAboutPg'])){
            unset($this->dataForm['SendEditAboutPg']);
            $editAboutPg = new \App\sts\Models\StsEditAboutPg();
            $editAboutPg->updateAboutPg($this->dataForm);
            if($editAboutPg->getResult()){
                $urlRedirect = URLADM . "view-about-pg/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewAboutPg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Artigo não encontrado!</p>";
            $urlRedirect = URLADM . "list-about-pg/index";
            header("Location: $urlRedirect");
        }
    }
}
