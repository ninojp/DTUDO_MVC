<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para sincronizar o nivel de acesso e as paginas */
class AdmsSyncPagesNivels
{
    private bool $result;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBd;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdNivels;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdPages;

    /** @var array|null - Recebe as informações q devem ser salvas no DB     */
    private array|null $resultBdNivelsPage;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdLastOrder;

    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $resultBdNivelDefault;
    
    /** @var array|null - Recebe os registros do banco de dados(DB)     */
    private array|null $dataNivelPage;

    /** @var integer|string|null - Recebe o Id do Nivel de acesso   */
    private int|string|null $nivelId;

    /** @var integer|string|null - Recebe o Id da pagina   */
    private int|string|null $pageId;

    /** @var integer|string|null - Recebe o tipo de permissão da página */
    private int|string|null $publish;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * Método para recuperar os niveis de acesso no DB
     * @return void - Retorna false se houver algun erro   */
    public function syncPagesNivels(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listNivels = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listNivels->fullRead("SELECT id FROM adms_access_levels");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBdNivels = $listNivels->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBdNivels) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdNivels);
            $this->listPages();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de acesso não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void - Recuperar as paginas no DB     */
    private function listPages():void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listPages = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listPages->fullRead("SELECT id, publish FROM adms_pages");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdPages = $listPages->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBdPages) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdPages);
            $this->readNivels();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (listPages())! Nenhuma página encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void - Ler os niveis de acesso no DB     */
    private function readNivels():void
    {
        foreach($this->resultBdNivels as $nivel){
            // var_dump($nivel);
            extract($nivel);
            // echo "ID do nivel de acesso: $id <br>";
            $this->nivelId = $id;
            $this->readPages();
        }
    }
    /** =============================================================================================
     * @return void - Ler as paginas de acesso no DB     */
    private function readPages():void
    {
        foreach($this->resultBdPages as $page){
            // var_dump($page);
            extract($page);
            // echo "ID da Página: $id <br>";
            $this->pageId = $id;
            $this->publish = $publish;
            $this->searchNivelsPage();
        }
    }
    /** =============================================================================================
     * @return void - Recuperar as paginas no DB     */
    private function searchNivelsPage():void
    {
        //instância a classe:AdmsRead() e cria o objeto:$listNivels
        $listNivelsPage = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $listNivelsPage->fullRead("SELECT id FROM adms_levels_pages WHERE adms_access_level_id =:adms_access_level_id AND adms_page_id =:adms_page_id", "adms_access_level_id={$this->nivelId}&adms_page_id={$this->pageId}");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBdNivelsPage
        $this->resultBdNivelsPage = $listNivelsPage->getResult();
        //verifica se atributo:$this->resultBd Não for true, precisa cadastrar pois não encontrou no Db
        if ($this->resultBdNivelsPage) {
            // var_dump($this->resultBd);
            // $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
            // var_dump($this->resultBdPages);
            // $this->readNivels();
            // echo "O nivel de acesso tem cadastro para a pagina: {$this->pageId} <br>";
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Todas as Permissões estão sincronizadas com sucesso!</p>";
            $this->result = true;
        } else {
            // echo "O nivel de acesso NÃO tem cadastro para a pagina: {$this->pageId} <br>";
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (listPages())! Nenhuma página encontrada!</p>";
            // $this->result = false;
            $this->addNivelPermission();
        }
    }
    /** ============================================================================================
     * @return void - Método para cadastrar na tabela:adms_levels_pages     */
    private function addNivelPermission():void
    {
        $this->searchLastOrder();
        // Se o nivel de acesso for 1(super adm) OU a página for publica (publish=1), ? = 1, por padrão tem permissão de acessar. Se não : = 2, não tem permissão
        $this->dataNivelPage['permission'] = (($this->nivelId==1) or ($this->publish==1)) ? 1 : 2;
        // Método para Procurar, se econtrar executa o nivel(LEVEL) de acesso PADRÃO 
        $this->searchNivelDefault();

        $this->dataNivelPage['order_level_page'] = $this->resultBdLastOrder[0]['order_level_page'] +1;
        $this->dataNivelPage['adms_access_level_id'] = $this->nivelId;
        $this->dataNivelPage['adms_page_id'] = $this->pageId;
        $this->dataNivelPage['created'] = date("Y-m-d H:i:s");

        $addAccessNivel = new \App\adms\Models\helper\AdmsCreate();
        $addAccessNivel->exeCreate("adms_levels_pages", $this->dataNivelPage);

        if($addAccessNivel->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Permissões sincronizadas com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possivel sincronisar as permissões!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void - Método para se ha página está cadastrada para o nivel de acesso na tabela:adms_levels_pages      */
    private function searchLastOrder():void
    {
        $viewLastOrder = new \App\adms\Models\helper\AdmsRead();
        $viewLastOrder->fullRead("SELECT order_level_page, adms_access_level_id FROM adms_levels_pages WHERE adms_access_level_id =:adms_access_level_id ORDER BY order_level_page DESC LIMIT :limit", "adms_access_level_id={$this->nivelId}&limit=1");

        $this->resultBdLastOrder = $viewLastOrder->getResult();

        if(!$this->resultBdLastOrder){
            $this->resultBdLastOrder[0]['order_level_page'] = 0;
        }
        // var_dump($this->resultBdLastOrder);
    }
    /** =======================================================================================
     * Método para verificar se existe o nivel(LEVEL) de acesso DEFAULT(padrão, ID=7)
     * Se existir usa os dados do mesmo como padrão para a criação do novo nivel(quando sincronizar)
     * @return void      */
    private function searchNivelDefault():void
    {
        $viewNivelDefault = new \App\adms\Models\helper\AdmsRead();
        $viewNivelDefault->fullRead("SELECT permission, print_menu, dropdown, adms_items_menu_id  
        FROM adms_levels_pages WHERE adms_page_id=:adms_page_id AND adms_access_level_id=7
        LIMIT :limit",
        "adms_page_id={$this->pageId}&limit=1");

        $this->resultBdNivelDefault = $viewNivelDefault->getResult();
        // Verifica, se existir usa os dados do nivel de acesso padrão
        if($this->resultBdNivelDefault){
            $this->dataNivelPage['permission'] = $this->resultBdNivelDefault[0]['permission'];
            $this->dataNivelPage['print_menu'] = $this->resultBdNivelDefault[0]['print_menu'];
            $this->dataNivelPage['dropdown'] = $this->resultBdNivelDefault[0]['dropdown'];
            $this->dataNivelPage['adms_items_menu_id'] = $this->resultBdNivelDefault[0]['adms_items_menu_id'];
        }
    }
}
