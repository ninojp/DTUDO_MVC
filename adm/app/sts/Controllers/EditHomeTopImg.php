<?php
namespace App\sts\controllers;

use App\sts\core\ConfigViewSts;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina de editar Imagem do Topo da pagina Home */
class EditHomeTopImg
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** ===================================================================================
     * Método para para editar Imagem do Topo da pagina Home  - @return void */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if (!empty($this->dataForm['SendEditHomeTopImg'])) {
            // var_dump($this->dataForm);
            $this->editHomeTopImg();
        } else {
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewHomeTopImg = new \App\sts\Models\StsEditHomeTopImg();
            //método:viewProfile() q vai solicitar as informações no db
            $viewHomeTopImg->viewHomeTopImg();
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewHomeTopImg->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM
                $this->data['form'] = $viewHomeTopImg->getResultBd();
                $this->viewEditHomeTopImg();
            } else {
                $urlRedirect = URLADM."view-page-home/index";
                header("Location: $urlRedirect");
            }
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditHomeTopImg(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-profile";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigViewSts("sts/Views/home/editHomeTopImg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * @return void     */
    private function editHomeTopImg():void
    {
        if(!empty($this->dataForm['SendEditHomeTopImg'])){
            unset($this->dataForm['SendEditHomeTopImg']);
            // Operador ternário, se for (verdadeiro)true utiliza a própria imagem se não atribui null
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            // var_dump($this->dataForm);
            $editHomeTopImg = new \App\sts\Models\StsEditHomeTopImg();
            $editHomeTopImg->update($this->dataForm);
            if($editHomeTopImg->getResult()){
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomeTopImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editHomeTopImg())! Imagem do topo da pagina Home  não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
