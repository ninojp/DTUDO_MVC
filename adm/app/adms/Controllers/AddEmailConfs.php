<?php
// echo "adms/Controller/AddEmailConfs.php:<h1>Página(controller) Novo E-mail de Configurção</h1>";
namespace App\adms\controllers;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){
    // Redireciona para a pagina escolhida
    // header("Location: /");
    header("Location: https://localhost/dtudo/public/");
    // Ou termina a execução e exibe a mensagem de erro
    // die("Erro! Página não encontrada<br>");
}
use Core\ConfigView;
/** Classe(controller) para adicionar novo e-mail de configuração */
class AddEmailConfs
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

        if (!empty($this->dataForm['SendAddEmailConfs'])) {
            // var_dump($this->dataForm);
            unset($this->dataForm['SendAddEmailConfs']);
            $createEmailConfs = new \App\adms\Models\AdmsAddEmailConfs();
            $createEmailConfs->createEmailConfs($this->dataForm);
            //Verifica ee o resultado da QUERY é TRUE, se for faz o redirecionamento para:list-users
            if($createEmailConfs->getResult()){
                $urlRedirect = URLADM."list-email-confs/index";
                header("Location: $urlRedirect");
            }else{
                // Se o resultado for FALSE, cria uma nova posição dentro do array $dataForm e mantém os dados no formulário
                $this->data['form'] = $this->dataForm;
                $this->loadViewAddEmailConfs();
            }
        }else{
            $this->loadViewAddEmailConfs();
        }
    } 

    /** ============================================================================================
     * @return void     */
    private function loadViewAddEmailConfs():void
    {
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-email-confs";
        
        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadViewAddEmailConfs = new ConfigView("adms/Views/emailConfs/addEmailConfs", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadViewAddEmailConfs->loadView();
    }
}
