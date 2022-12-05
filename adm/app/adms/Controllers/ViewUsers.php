<?php

namespace App\adms\controllers;

use Core\ConfigView;

class ViewUsers
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE|
     * @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
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
            $viewUsers = new \App\adms\Models\AdmsViewUsers();
            $viewUsers->viewUsers($this->id);
            if ($viewUsers->getResult()) {
                $this->data['viewUsers'] = $viewUsers->getResultBd();
                $this->viewUser();
                // var_dump($this->data['viewUsers']);
            } else {
                $urlRedirect = URLADM."list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário enviar o ID)Usuário não encontrado!</p>";
            $urlRedirect = URLADM."list-users/index";
            header("Location: $urlRedirect");
        }
        // echo "adms/Controller/ViewUsers.php: <h1> Página(controller) de ViewUsers</h1>";
        // $this->data = [];
    }
    /** ======================================================================================
     * método para carregar a VIEW - @return void     */
    private function viewUser():void
    {
        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigView("adms/Views/users/viewUser", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}
