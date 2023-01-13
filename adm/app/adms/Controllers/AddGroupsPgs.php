<?php
namespace App\adms\Controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/** Classe (Controller): cadastrar situação da pagina  */
class AddGroupsPgs
{
 /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** ==========================================================================================   
     * Método cadastrar situação da pagina 
     * Receber os dados do formulário.
     * Quando o da pagina clicar no botão "cadastrar" do formulário da página nova situação da pagina. Acessa o IF e instância a classe "AdmsAddGroupsPgs" responsável em cadastrar a situação da pagina no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     *  @return void     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddGroupsPgs'])){
            unset($this->dataForm['SendAddGroupsPgs']);
            $createSitPg = new \App\adms\Models\AdmsAddGroupsPgs();
            $createSitPg->createAddGroupsPgs($this->dataForm);
            if($createSitPg->getResult()){
                $urlRedirect = URLADM . "list-groups-pgs/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddGroupPg();
            }   
        }else{
            $this->viewAddGroupPg();
        }  
    }
    /** =========================================================================================
     * Instanciar a classe responsável em carregar a View e enviar os dados para View. */
    private function viewAddGroupPg(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "add-groups-pgs";

        $loadView = new \Core\ConfigView("adms/Views/pages/addGroupsPgs", $this->data);
        $loadView->loadView();
    }
}
