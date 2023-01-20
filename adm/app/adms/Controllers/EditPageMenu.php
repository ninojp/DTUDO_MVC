<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Controllers) para editar a página no Item de menu(sidebar)
class EditPageMenu
{
    //Recebe da models:AdmsEditPageMenu, os dados e os envia para serem editados na view
    private array|string|null $data = [];

    //Recebe o id do registro a ser editado
    private int|string|null $id;

    //Recebe(via url) o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Item de menu
     * Recebe como parametro o id que será usado na pesquisa das informações no DB e instância a Models:...(), Após editado retorna MSG e redireciona para o ... 
     * @param integer|string|null|null $id,  @return void     */
    public function index(int|string|null $id = null):void
    {
        $this->id = (int) $id;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        $this->dataForm;

        //verifica se recebeu o ID, nivel de acesso(level) e pagina atual(pag) se recebeu prossegue
        if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){
            $viewPageMenu = new \App\adms\Models\AdmsEditPageMenu();
            $viewPageMenu->viewPageMenu($this->id);

            if($viewPageMenu->getResult()) {
                // var_dump($viewPageMenu->getResultBd());
                $this->data['form'] = $viewPageMenu->getResultBd();
                $this->viewEditPageMenu();
            } else {
                $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
                header("Location: $urlRedirect");
            }
            
        } else {
            // $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (index(controller))! Necessário selecionar Item de Menu</p>";
            // $urlRedirect = URLADM."list-access-nivels/index";
            // header("Location: $urlRedirect");
        }
    }
    private function viewEditPageMenu():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = ['list_permission' => ['menu_controller' => 'list-permission', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \App\adms\Models\helper\AdmsButton();
        // Passa como parametro o array:$button criado acima, para o método:buttonPermission()
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // atribui para posição:data['btnLevel'], o nivel de acesso(level), para enviar pra view 
        $this->data['btnLevel'] = $this->level;

        // Instância a classe e o método para listar os item para o campo SELECT da view 
        $listSelect = new \App\adms\Models\AdmsEditPageMenu();
        $this->data['select'] = $listSelect->listSelect();
        // var_dump($this->data['select']);
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-access-nivels";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/permission/editPageMenu", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}