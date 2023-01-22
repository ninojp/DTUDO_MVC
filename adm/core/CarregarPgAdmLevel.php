<?php
namespace Core;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Verificar se existe a classe e Carregar a CONTROLLER
 * @author Nino JP <meu.sem@gmail.com>  */
class CarregarPgAdmLevel
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;

    /** @var array - $resultPage: Recebe os dados da pagina do DB */
    private array|null $resultPage;

    /** @var array - $resultPage: Recebe os dados da permissão do DB */
    private array|null $resultLevelPage;

    /** ==========================================================================================
     * Método para verificar se existe a classe   -  @return void
     * @param string|null $urlController
     * @param string|null $urlMetodo
     * @param string|null $urlParameter */
    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter):void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        // var_dump($this->urlController);

        $this->searchPage();
    }
    /** ===========================================================================================
     * @return void     */
    private function searchPage():void
    {
        $searchPage = new \App\adms\Models\helper\AdmsRead();
        $searchPage->fullRead("SELECT pag.id, pag.publish, typ.type FROM adms_pages AS pag 
        INNER JOIN adms_types_pgs AS typ ON typ.id=pag.adms_types_pgs_id
        WHERE pag.controller =:controller AND pag.metodo =:metodo
        AND pag.adms_sits_pgs_id=:adms_sits_pgs_id LIMIT :limit",
        "controller={$this->urlController}&metodo={$this->urlMetodo}&adms_sits_pgs_id=1&limit=1");
        $this->resultPage = $searchPage->getResult();

        if($this->resultPage){
            // var_dump($this->resultPage);
            if($this->resultPage[0]['publish'] == 1){
                $this->classLoad = "\\App\\".$this->resultPage[0]['type']."\\Controllers\\".$this->urlController;
                $this->loadMetodo();
            } else {
                // echo "Verificar se o user está logado <br>";
                $this->verifyLogin();
            }
        }else{
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (searchPage()): Página não encontrada!</p>";
            // $urlRedirect = URLADM."login/index";
            // header("Location: $urlRedirect");

            // Ao invés de fazer o redirecionamento pode se usar o DIE() para finalizar
            die("Erro 006 - (searchPage())! Tente Novamente ou entre em contato: ".EMAILADM);
        }
    }
    /** ============================================================================================
     * Verificar se existe o método e carregar a página(controller)
     * @return void    */
    private function loadMetodo():void
    {
        $classLoad = new $this->classLoad();
        if(method_exists($classLoad, $this->urlMetodo)){
            //passando a parametro recebido no atributo:$this->urlParameter
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        }else{
            die("Erro 004 - (loadMetodo())! Tente Novamente ou entre em contato: ".EMAILADM);
        }
    } 
    /** ===========================================================================================
     * Método para verificar se foi feito o LOGIN
     * @return void    */
    private function verifyLogin():void
    {
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email'])) and (isset($_SESSION['access_level_id'])) and (isset($_SESSION['order_levels']))) {
            // $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
            $this->searchLevelPage();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (verifyLogin()): Para acessar a Página realize o login!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect"); 
        }
    }
    /** ------------------------------------------------------------------------------------------
     * @return void     */ 
    private function searchLevelPage():void
    {
        $searchLevelPage = new \App\adms\Models\helper\AdmsRead();
        $searchLevelPage->fullRead("SELECT id, permission FROM adms_levels_pages WHERE adms_page_id  =:adms_page_id AND adms_access_level_id=:adms_access_level_id AND permission=:permission LIMIT :limit", "adms_page_id={$this->resultPage[0]['id']}&adms_access_level_id=".$_SESSION['access_level_id']."&permission=1&limit=1");

        $this->resultLevelPage = $searchLevelPage->getResult();
        if($this->resultLevelPage){
            $this->classLoad = "\\App\\".$this->resultPage[0]['type']."\\Controllers\\".$this->urlController;
            $this->loadMetodo();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (searchLevelPage()): Necessário permissão para acessar a página!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }
    }
}
