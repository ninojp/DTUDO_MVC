<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class AddSitsUsers
{
    private array|string|null $data = [];

    private array|null $dataForm;

    /** =============================================================================================
     * Método para cadastrar uma nova situação do usuário.
     * Instância a classe responsável em carregar a View e enviar os dados para a mesma.
     * Quando o usuário clicar no botão cadastrar do formulário da View:addSitsUser. Acessa o IF e instância a classe:AdmsAddStisUsers, responsável em cadastrar a nova situação, no DB.
     * Situação cadastrada com sucesso, redireciona para a pagina listar situações. 
     * Senão, instância a classe responsável em carregar a view e enviar os dados para a view.
     * @return void     */
    public function index():void
    {
        //recebe os dados do formulário da view, via post, filtra e os atribui para:$this->dataForm
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //verifica, se a posição:['SendAddSitUser'] do array:$this->dataForm for diferente de vazio
        if(!empty($this->dataForm['SendAddSitUser'])){
            //limpa a posição:['SendAddSitUser'] do array:$this->dataForm
            unset($this->dataForm['SendAddSitUser']);

            //instância a classe:AdmsAddStisUsers()  e cria o Objeto:$addSitsUsers
            $addSitsUsers = new \App\adms\Models\AdmsAddStisUsers();
            //instância o método q vai criar(add) o novo registro no DB
            $addSitsUsers->createAddSitsUsers($this->dataForm);
            //verifica, se o método:createAddSitsUsers(), retornou true para:getResult()
            if($addSitsUsers->getResult()){
                //se sim, redireciona para view:listSitsusers
                $urlRedirect = URLADM."list-sits-users/index";
                header("Location: $urlRedirect");
            } else {
                //se não, mantém os dados no formulário da view:addSitsUsers
                $this->data['form'] = $this->dataForm;
                $this->loadViewAddSitsUsers();
            }
        } else {
            $this->loadViewAddSitsUsers();
        }
    }
    /** =================================================================================================
     * @return void     */
    private function loadViewAddSitsUsers():void
    {
        //Cria o objeto:$listSelectCor e instância a classe:AdmsAddStisUsers() 
        $listSelectCor = new \App\adms\Models\AdmsAddStisUsers();
        //cria uma nova posição no atributo(array):$this->data['selectCor']
        $this->data['selectCor'] = $listSelectCor->listSelectCor();

        //Cria o objeto:$loadViewAddSitsUsers e instância a classe:ConfigView() 
        $loadViewAddSitsUsers = new \Core\ConfigView("adms/Views/sitsUsers/addSitsUsers", $this->data);
        //Instância o método:loadView(), para carregar a view e enviar os dados para a mesma
        $loadViewAddSitsUsers->loadView();
    }
}