<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\adms\controllers;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/");}
use Core\ConfigView;
/** Classe da controller da pagina de novo usuário */
class AddAccessNivels
{
    /** Apartir do PHP 8, posso definir a TIPAGEM de varios tipos para o mesmo atributo, usando o PIPE| @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data = [];
    //Recebe os dados do formulario
    private array|null $dataForm;
    /** ===================================================================================
    * Método GENÉRICO q instancia a classe:ConfigView() para carregar a View da pagina, 
     * e enviar os dados para a view, através do método:loadView()
     * Quando o usuário clicar no botão cadastrar do formulário da view novo usuário. Acessa o IF e instancia a classe:AdmsAddUsers responsável em cadastrar o usuário no DB.
     * Usuário cadastrado com sucesso, redireciona para a página de listar Registros, senão, instância a classe responsável em carregar a View e enviar os dados para view.  - @return void */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendAddAccessNivels'])) {
            var_dump($this->dataForm);
            unset($this->dataForm['SendAddAccessNivels']);
            $createAccessNivels = new \App\adms\Models\AdmsAddAccessNivels();
            $createAccessNivels->createAccessNivels($this->dataForm);
            //Verifica ee o resultado da QUERY é TRUE, se for faz o redirecionamento para:list-users
            if($createAccessNivels->getResult()){
                $urlRedirect = URLADM."list-access-nivels/index";
                header("Location: $urlRedirect");
            }else{
                // Se o resultado for FALSE, cria uma nova posição dentro do array $dataForm e mantém os dados no formulário
                $this->data['form'] = $this->dataForm;
                $this->loadViewAddUser();
            }
        }else{
            $this->loadViewAddUser();
        }
    } 

    /** ============================================================================================
     * @return void     */
    private function loadViewAddUser():void
    {
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-access-nivels";
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new ConfigView("adms/Views/accessNivels/addAccessNivels", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
}
