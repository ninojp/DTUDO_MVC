<?php
// echo "adms/Controller/NewUser.php: <h1> Página(controller) Novo usuário</h1>";
namespace App\sts\controllers;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/");}
/** Classe da controller da pagina de novo Artigo */
class AddMsgContact
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
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

        if (!empty($this->dataForm['SendAddMsgContact'])) {
            // var_dump($this->dataForm);
            unset($this->dataForm['SendAddMsgContact']);
            $createMsgContact = new \App\sts\Models\StsAddMsgContact();
            $createMsgContact->createMsgContact($this->dataForm);
            //Verifica ee o resultado da QUERY é TRUE, se for faz o redirecionamento para:list-users
            if($createMsgContact->getResult()){
                $urlRedirect = URLADM."list-msg-contact/index";
                header("Location: $urlRedirect");
            }else{
                // Se o resultado for FALSE, cria uma nova posição dentro do array $dataForm e mantém os dados no formulário
                $this->data['form'] = $this->dataForm;
                $this->loadViewAddMsgContact();
            }
        }else{
            $this->loadViewAddMsgContact();
        }
    } 

    /** ============================================================================================
     * @return void     */
    private function loadViewAddMsgContact():void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-msg-contact";
        
        //Instancio a classe:ConfigViewSts() e crio o objeto:$loadView
        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contact/addMsgContact", $this->data);
        //Instancia o método:loadViewSts() da classe:ConfigViewSts
        $loadView->loadViewSts();
    }
}
