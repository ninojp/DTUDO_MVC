<?php

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

            //instância a classe:  e cria o Objeto:
            $addSitsUsers = new \App\adms\Models\AdmsAddStisUsers();
            $addSitsUsers->getResult();
        }
    }
}