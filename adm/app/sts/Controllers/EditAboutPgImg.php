<?php
namespace App\sts\controllers;

use App\sts\core\ConfigViewSts;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina de editar Imagem dos Artigos da pagina Sobre Empresa */
class EditAboutPgImg
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /** ===================================================================================
     * Metodo editar imagem sobre empresa.
     * Receber os dados do formulario.
     * 
     * Se o parametro ID e diferente de vazio e o usuario não clicou no botao editar, instancia a MODELS para recuperar as informacoes sobre empresa no banco de dados, se encontrar instancia o metodo "viewEditAboutCompImage". Se nao existir redireciona para o listar sobre empresa.
     * 
     * Se nao existir sobre empresa clicar no botao acessa o ELSE e instancia o metodo "editAboutCompImage". Empresa  - @return void */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id)) and (empty($this->dataForm['SendEditAboutPgImg']))) {
            // var_dump($this->dataForm);
            $this->id = (int) $id;
            //instância a classe:AdmsEditProfile e cria o objeto para instanciar o método
            $viewAboutPgImg = new \App\sts\Models\StsEditAboutPgImg();
            //método:viewProfile() q vai solicitar as informações no db
            $viewAboutPgImg->viewAboutPgImg($this->id);
            //verifica se existe resultado da query, através do método:getResult()=true
            if($viewAboutPgImg->getResult()){
                //se existir, pega os resultados no método:getResultBd() e os coloca no atributo:$this->data['form'], com a posição FORM
                $this->data['form'] = $viewAboutPgImg->getResultBd();
                $this->loadViewEditAboutPgImg();
            } else {
                $urlRedirect = URLADM."list-about-pg/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editAboutPgImg();
        }
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditAboutPgImg(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-about-pg";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigViewSts("sts/Views/about/editAboutPgImg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * * Editar imagem sobre empresa.
     * Se o usuario clicou no botao, instancia a MODELS responsavel em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente sobre empresa no banco de dados.
     * Se o usuario nao clicou no botao redireciona para pagina listar sobre empresa.
     * @return void     */
    private function editAboutPgImg():void
    {
        if(!empty($this->dataForm['SendEditAboutPgImg'])){
            unset($this->dataForm['SendEditAboutPgImg']);
            // Operador ternário, se for (verdadeiro)true utiliza a própria imagem se não atribui null
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            // var_dump($this->dataForm);
            $editAboutPgImg = new \App\sts\Models\StsEditAboutPgImg();
            $editAboutPgImg->updateAboutPg($this->dataForm);
            if($editAboutPgImg->getResult()){
                $urlRedirect = URLADM . "view-about-pg/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditAboutPgImg();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editAboutPgImg())! Imagem do topo da pagina Home  não encontrado!</p>";
            $urlRedirect = URLADM . "list-about-pg/index";
            header("Location: $urlRedirect");
        }
    }
}
