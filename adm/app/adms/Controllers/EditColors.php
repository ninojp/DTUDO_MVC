<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "adms/Controller/EditColors.php: <h1> Página(controller) Editar Cor</h1>";
/** Classe(Controlles) para editar uma Cor existente*/
class EditColors
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id;

    public function index(int|string|null $id=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id)) and (empty($this->dataForm['SendEditColors']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $atualColors = new \App\adms\Models\AdmsEditColors();
            $atualColors->viewColorsBd($this->id);
            if($atualColors->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualColors->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditColors();
            }else{
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editColors();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditColors(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-colors";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/colors/editColors", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editColors():void
    {
        if(!empty($this->dataForm['SendEditColors'])){
            unset($this->dataForm['SendEditColors']);
            $editColors = new \App\adms\Models\AdmsEditColors();
            $editColors->updateColors($this->dataForm);
            if($editColors->getResult()){
                $urlRedirect = URLADM . "view-colors/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditColors();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário ID)Cor não encontrado!</p>";
            $urlRedirect = URLADM . "list-colors/index";
            header("Location: $urlRedirect");
        }
    }
}