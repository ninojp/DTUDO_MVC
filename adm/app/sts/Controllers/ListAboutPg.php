<?php
namespace App\sts\controllers;

use App\sts\core\ConfigViewSts;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
class ListAboutPg
{
    /** @var array|string|null - Define que o atributo:$data pode receber(da view) os dados(parametros) de diversos tipos, q devem ser enviados novamente para serem exibidos pela view */
    private array|string|null $data;

    /** @var array|null - Recebe os dados do formulário de pesquisa   */
    private array|null $dataForm;

    /** @var string|integer|null - Recebe o numero da pagina atual   */
    private string|int|null $page;

    /** @var string|null -  - Recebe o nome a ser pesquisado  */
    private string|null $searchTitle;

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

        $this->searchTitle = filter_input(INPUT_GET, 'title', FILTER_DEFAULT);
        // var_dump($this->searchName);

        $listAboutPg = new \App\sts\Models\StsListAboutPg();

        //verifica se foi clicado no botão de pesquisar, se foi executa o codigo abaixo
        if (!empty($this->dataForm['SendSearchTitle'])) {
            //sempre quando clicar no pesquisar, redireciona para pagina 1
            $this->page = 1;

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listAboutPg->listSearchAboutPg($this->page, $this->dataForm['title']);

            //para manter os dados no formulário, na view
            $this->data['form'] = $this->dataForm;

            // verifica se está recebendo via GET na url
        } elseif ((!empty($this->searchTitle))) {

            //instância o método que fara a pesquisa e passa como parametro a pagina e os dados que estão nas posições do array:$this->dataForm['']
            $listAboutPg->listSearchAboutPg($this->page, $this->searchTitle);

            //para manter os dados no formulário, na view
            $this->data['form']['title'] = $this->searchTitle;


            //Se não foi clicado carrega os dados do listar normalmente
        } else {
            //envia para a models a pagina atual
            $listAboutPg->listAboutPg($this->page);
        }
        if ($listAboutPg->getResult()) {
            $this->data['listAboutPg'] = $listAboutPg->getResultBd();
            // var_dump($this->data['listUsers']);
            // PAGINAÇÃO - cria a POSIÇÃO:['pagination'] no array:$this->data
            $this->data['pagination'] = $listAboutPg->getResultPg();
        } else {
            $this->data['listAboutPg'] = [];
            $this->data['pagination'] = "";
        }
        // ----------- Exibir ou ocultar botões conforme o nivel de acesso -------------------
        // Cria o array e suas devidas posições
        $button = [ 'add_about_pg' => ['menu_controller' => 'add-about-pg', 'menu_metodo' => 'index'], 'view_about_pg' => ['menu_controller' => 'view-about-pg', 'menu_metodo' => 'index'], 'edit_about_pg' => ['menu_controller' => 'edit-about-pg', 'menu_metodo' => 'index'], 'delete_about_pg' => ['menu_controller' => 'delete-about-pg', 'menu_metodo' => 'index']
        ];
        // Instância a classe:AdmsButton() e cria o objeto:$listButton
        $listButton = new \App\adms\Models\helper\AdmsButton();
        // Passa como parametro o array:$button criado acima, para o método:buttonPermission()
        // E Atribui o resultado para o atributo:$this->data['button'], criando esta posição
        $this->data['button'] = $listButton->buttonPermission($button);
        // var_dump($this->data['button']);

        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "list-about-pg";

        //instancia a classe, cria o objeto e passa o parametro:$this->data, recebido da VIEW
        $loadView = new ConfigViewSts("sts/Views/about/listAboutPg", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadViewSts();
    }
}
