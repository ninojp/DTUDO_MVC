<?php
namespace Core;

use App\adms\controllers\Login;
use App\adms\controllers\Users;

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParameter;
    private string $classLoad;

    /** =============================================================================================
     * Este método se autoexecuta quando a classe é instanciada */
    public function __construct()
    {
        //instanicia o método:configAdm() da classe pai:Config
        $this->configAdm();
        // Verifica se esta recebendo algo na URL
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            var_dump($this->url);
            // Se receber, divide a string:url em três partes e cria um array:$urlArray
            $this->urlArray = explode("/", $this->url);
            var_dump($this->urlArray);
            // 1 parte, é a controller:$urlController
            if(isset($this->urlArray[0])){
                $this->urlController = $this->urlArray[0];
            }else{
                $this->urlController = CONTROLLER;
            }
            // 2 parte, é o método:$urlMetodo
            if(isset($this->urlArray[1])){
                $this->urlMetodo = $this->urlArray[1];
            }else{
                $this->urlMetodo = METODO;
            }
            // 3 parte, é um parametro/valor(ira receber um id por exemplo):$urlParameter
            if(isset($this->urlArray[2])){
                $this->urlParameter = $this->urlArray[2];
            }else{
                $this->urlParameter = "";
            }
        }else{
            // Se não receber valores na URL, então use o padrão a seguir, nesta ordem
            $this->urlController = CONTROLLERERRO;
            $this->urlMetodo = METODO;
            $this->urlParameter = "";
        }
        echo "Controller: {$this->urlController}<br>";
        echo "Método: {$this->urlMetodo}<br>";
        echo "Parametro: {$this->urlParameter}<br>";
    }
    /** ============================================================================================
     * 
     * @return void */
    public function loadPage()
    {
        echo "(core/configController/loadPage:) Carregar pagina: {$this->urlController}<br>";

        /* Se estiver UTILIZANDO LINUX pode gerar erro, pois no linux a primeira LETRA da classe precisa sempre estar em maiúculo. Para isso não acontecer...*/
        $this->urlController = ucwords($this->urlController);
        echo " Carregar pagina CORRIGIDA: {$this->urlController}<br>";

        // Cria o endereço dinamico e atribiu para o endereço:$classLoad
        // Atribui(pega) o que está dentro deste atributo:$urlController,
        // concatena com o que está nesta controller com este endereço:\\App\\adms\\Controllers\\
        // E depois Atribui tudo para o atributo:$classLoad 
        $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
        
        // instancio a classe q esta em:classLoad, E atribui para um OBJETO:$classPage
        // $classPage = new $this->classLoad;
        //Desta forma também Funciona, pois está instanciando uma classe através do atributo.
        $classPage = new $this->classLoad();
        //usa o objeto para instaciar o MÉTODO q está no atributo:$urlMetodo
        $classPage->{$this->urlMetodo}();

        // Exemplo: carregado de forma estática
        // require './app/adms/Controllers/Login.php';
        // $login = new Login();
        // $login->index();

        // require './app/adms/Controllers/Users.php';
        // $users = new Users();
        // $users->index();
    }

}
