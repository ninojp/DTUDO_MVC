<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
//Classe(Controllers) para verificar se já existe, senão, cadastrar uma nova Cor
class AddColors
{
    private array|string|null $data = [];

    private array|null $dataForm;

    /** =============================================================================================
     * Método para cadastrar uma nova Cor.
     * Instância a classe responsável em carregar a View e enviar os dados para a mesma.
     * Quando o usuário clicar no botão cadastrar do formulário da View:addCor. Acessa o IF e instância a classe:AdmsAddColors, responsável em cadastrar a nova Cor, no DB.
     * Cor cadastrada com sucesso, redireciona para a pagina listar situações. 
     * Senão, instância a classe responsável em carregar a view e enviar os dados para a view.
     * @return void     */
    public function index():void
    {
        //recebe os dados do formulário da view, via post, filtra e os atribui para:$this->dataForm
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //verifica, se a posição:['SendAddSitUser'] do array:$this->dataForm for diferente de vazio
        if(!empty($this->dataForm['SendAddColors'])){
            //limpa a posição:['SendAddSitUser'] do array:$this->dataForm
            unset($this->dataForm['SendAddColors']);

            //instância a classe:AdmsAddColors()  e cria o Objeto:$addColors
            $addColors = new \App\adms\Models\AdmsAddColors();
            //instância o método q vai criar(add) o novo registro no DB
            $addColors->createAddColors($this->dataForm);
            //verifica, se o método:createAddColors(), retornou true para:getResult()
            if($addColors->getResult()){
                //se sim, redireciona para view:listColors
                $urlRedirect = URLADM."list-colors/index";
                header("Location: $urlRedirect");
            } else {
                //se não, mantém os dados no formulário da view:addColors
                $this->data['form'] = $this->dataForm;
                $this->loadViewAddColors();
            }
        } else {
            $this->loadViewAddColors();
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function loadViewAddColors():void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-colors";
        
        //Cria o objeto:$loadViewAddColors e instância a classe:ConfigView() 
        $loadViewAddColors = new \Core\ConfigView("adms/Views/colors/addcolors", $this->data);
        //Instância o método:loadView(), para carregar a view e enviar os dados para a mesma
        $loadViewAddColors->loadView();
    }
}