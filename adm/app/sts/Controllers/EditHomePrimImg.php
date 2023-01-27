<?php
namespace App\sts\controllers;

use App\sts\core\ConfigViewSts;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina de editar Imagem do Topo da pagina Home */
class EditHomePrimImg
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
        if (!empty($this->dataForm['SendEditHomePrimeImg'])) {
            // var_dump($this->dataForm['SendEditHomePrimeImg']);
            $this->editHomePrimImg();
        } else {
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewHomePrimImg = new \App\sts\Models\StsEditHomePrimImg();
            //método:viewProfile() q vai solicitar as informações no db
            $viewHomePrimImg->viewHomePrimImg();
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewHomePrimImg->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM
                $this->data['form'] = $viewHomePrimImg->getResultBd();
                $this->viewEditHomePrimImg();
            } else {
                $urlRedirect = URLADM."view-page-home/index";
                header("Location: $urlRedirect");
            }
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditHomePrimImg(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-page-home";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigViewSts("sts/Views/home/editHomePrimImg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * Método para editar a imagem do serviço Premium da View Home
     * Se o usuario clicou no botão, instâcia a Models responsavel em receber os dados e editar no DB
     * Verificar se editou corretamente a imagem no DB
     * Se o usuario Não clicou no botão, redireciona  para a pagina visualizar detalhes
     * @return void     */
    private function editHomePrimImg():void
    {
        if(!empty($this->dataForm['SendEditHomePrimeImg'])){
            unset($this->dataForm['SendEditHomePrimeImg']);
            // Operador ternário, se for (verdadeiro)true utiliza a própria imagem se não atribui null
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            // var_dump($this->dataForm);
            $editHomePrimImg = new \App\sts\Models\StsEditHomePrimImg();
            $editHomePrimImg->update($this->dataForm);
            if($editHomePrimImg->getResult()){
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditHomePrimImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editHomePrimImg(Controller))! Imagem do topo da pagina Home  não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}
