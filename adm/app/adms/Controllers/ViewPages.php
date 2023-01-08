<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;

class ViewPages
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
            // var_dump($id);
            $this->id = (int) $id;
            // echo "Existe o ID: {$this->id}<br>";
            $viewPages = new \App\adms\Models\AdmsViewPages();
            $viewPages->viewPages($this->id);
            if ($viewPages->getResult()) {
                $this->data['viewPages'] = $viewPages->getResultBd();
                $this->loadViewPages();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)pagina não encontrado!</p>";
            $urlRedirect = URLADM."list-pages/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewPages():void
    {
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-pages";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigView("adms/Views/pages/viewPages", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}
