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
        $searchPage->fullRead("SELECT id, publish 
        FROM adms_pages 
        WHERE controller =:controller AND metodo =:metodo LIMIT :limit", "controller={$this->urlController}&metodo={$this->urlMetodo}&limit=1");

        $this->resultPage = $searchPage->getResult();

        if($this->resultPage){
            // var_dump($this->resultPage);
            if($this->resultPage[0]['publish'] == 1){
                $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
                $this->loadMetodo();
            } else {
                echo "Verificar se o user está logado <br>";
            }
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (pgPrivate()): Página não encontrada!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");

            // Ao invés de fazer o redirecionamento pode se usar o DIE() para finalizar
            // die("Erro 006 - (searchPage())! Tente Novamente ou entre em contato: ".EMAILADM);
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
}
