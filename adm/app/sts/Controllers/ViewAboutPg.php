<?php
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class ViewAboutPg
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id;
    /** ===================================================================================
     * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView() - @return void 
     * estou passando o ID:$id como parametro, recebido do CORE\CarregarPgAdm.php */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // echo "Existe o ID: {$this->id}<br>";
            $viewAboutPg = new \App\sts\Models\StsViewAboutPg();
            $viewAboutPg->viewAboutPg($this->id);
            if ($viewAboutPg->getResult()) {
                $this->data['viewAboutPg'] = $viewAboutPg->getResultBd();
                $this->loadViewAboutPg();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-about-pg/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (index())! (ID)Registro não encontrado!</p>";
            $urlRedirect = URLADM."list-about-pg/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewAboutPg():void
    {
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // $button = ['list_users' => ['menu_controller' => 'list-users', 'menu_metodo' => 'index'], 
        // 'edit_users' => ['menu_controller' => 'edit-users', 'menu_metodo' => 'index'],
        // 'edit_users_password' => ['menu_controller' => 'edit-users-password', 'menu_metodo' => 'index'],
        // 'edit_users_image' => ['menu_controller' => 'edit-users-image', 'menu_metodo' => 'index'],
        // 'delete_users' => ['menu_controller' => 'delete-users', 'menu_metodo' => 'index']];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        // $listButton = new \App\adms\Models\helper\AdmsButton();
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        // $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-about-pg";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/about/viewAboutPg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
}
