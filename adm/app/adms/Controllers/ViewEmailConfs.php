<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use Core\ConfigView;
/** Classe(Controlllers) para visualizar os detalhes das configurações de e-mail */
class ViewEmailConfs
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
            $viewEmailConf = new \App\adms\Models\AdmsViewEmailConfs();
            $viewEmailConf->ViewEmailConfs($this->id);
            if ($viewEmailConf->getResult()) {
                $this->data['viewEmailConf'] = $viewEmailConf->getResultBd();
                $this->loadViewEmailConfs();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-email-confs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum E-mail(registro) encontrado!</p>";
            $urlRedirect = URLADM."list-email-confs/index";
            header("Location: $urlRedirect");
        }
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function loadViewEmailConfs():void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-email-confs";
        
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigView("adms/Views/emailConfs/viewEmailConfs", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}
