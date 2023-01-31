<?php
namespace App\sts\controllers;

use App\sts\core\ConfigViewSts;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
class ListMsgContact
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var array|null - Recebe os dados do formulário de pesquisa   */
    private array|null $dataForm;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchSubject;

    /** ===========================================================================================
     * Método para listar os artigos da pagina Home
     * Instância a models q ira buscar os registros no DB
     * Se encontrar registros, os envia para a view. Se não envia um array vazio
     * Passa o parametro:$page, para fazer a paginação
     * @return void   */
    public function index(string|int|null $page = null)
    {
        //Atribui o parametro recebido:$page para o atributo:$this->page
        //converte para inteiro e verifica se possui valor, se não atribui o valor 1
        $this->page = (int) $page ? $page : 1;
        // var_dump($this->page);

        //Recebe os dados do formulário de pesquisa:form_pesquisar
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);

        $this->searchSubject = filter_input(INPUT_GET, 'subject', FILTER_DEFAULT);
        // var_dump($this->searchName);

        $listMsgContact = new \App\sts\Models\StsListMsgContact();

        //verifica se foi clicado no botão de pesquisar, se foi executa o codigo abaixo
        if (!empty($this->dataForm['SendSearchSubject'])) {
            //sempre quando clicar no pesquisar, redireciona para pagina 1
            $this->page = 1;

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listMsgContact->listSearchMsgContact($this->page, $this->dataForm['subject']);

            //para manter os dados no formulário, na view
            $this->data['form'] = $this->dataForm;

            // verifica se está recebendo via GET na url
        } elseif ((!empty($this->searchSubject))) {

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listMsgContact->listSearchMsgContact($this->page, $this->searchSubject);

            //para manter os dados no formulário, na view
            $this->data['form']['subject'] = $this->searchSubject;


            //Se não foi clicado carrega os dados do listar normalmente
        } else {
            //envia para a models a pagina atual
            $listMsgContact->listMsgContact($this->page);
        }
        if ($listMsgContact->getResult()) {
            $this->data['listMsgContact'] = $listMsgContact->getResultBd();
            // var_dump($this->data['listUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listMsgContact->getResultPg();
        } else {
            $this->data['listMsgContact'] = [];
            $this->data['pagination'] = "";
        }
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-msg-contact";

        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigViewSts("sts/Views/contact/listMsgContact", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
}
