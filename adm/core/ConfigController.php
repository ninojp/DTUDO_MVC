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
    private array $format;
    private string $urlSlugController;
    private string $urlSlugMetodo;

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
            //instancia o método:clearUrl() para executar(automaticamente), junto com este método
            $this->clearUrl();
            // Se receber, divide a string:url em três partes e cria um array:$urlArray
            $this->urlArray = explode("/", $this->url);
            var_dump($this->urlArray);
            // 1 parte, é a controller:$urlController
            if(isset($this->urlArray[0])){
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else{
                $this->urlController = $this->slugController(CONTROLLER);
            }
            // 2 parte, é o método:$urlMetodo
            if(isset($this->urlArray[1])){
                $this->urlMetodo = $this->slugMetodo($this->urlArray[1]);
            }else{
                $this->urlMetodo = $this->slugMetodo(METODO);
            }
            // 3 parte, é um parametro/valor(ira receber um id por exemplo):$urlParameter
            if(isset($this->urlArray[2])){
                $this->urlParameter = $this->urlArray[2];
            }else{
                $this->urlParameter = "";
            }
        }else{
            // Se não receber valores na URL, então use o padrão a seguir, nesta ordem
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
        }
        echo "Controller: {$this->urlController}<br>";
        echo "Método: {$this->urlMetodo}<br>";
        echo "Parametro: {$this->urlParameter}<br>";
    }
    /** ===========================================================================================
     * Método para fazer a limpeza da URL
     * @return void */
    private function clearUrl():void
    {
        // Eliminar as tags
        $this->url = strip_tags($this->url);
        // Eliminar os espaços em branco
        $this->url = trim($this->url);
        // Eliminar a barra no final da url
        $this->url = rtrim($this->url, "/");
        //Eliminar os caracteres especiais(faz a substituição) 
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']),$this->format['b']);
    }
    /** =========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de classe
     * @param [type] $slugController
     * @return string */
    private function slugController($slugController):string
    {
        $this->urlSlugController = $slugController;
        //Converter tudo para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        //Converter o traço para o espaço em branco
        $this->urlSlugController = str_replace("-"," ",$this->urlSlugController);
        //Converter a primeira letra de cada palavra para Maiúscula(evitar erro no linux) 
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar o espaço em branco
        $this->urlSlugController = str_replace(" ","",$this->urlSlugController);

        var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }
    /** ==========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de MÉTODO
     * @return string */
    private function slugMetodo($urlSlugMetodo):string
    {
        //faz todo o tratamento com o Método:slugController() e depois atribui para: $urlSlugMetodo
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter a primeira letra da frase em Minúsculo
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
    /** ============================================================================================
     * Método responsável pelo controle de carregamento das views
     * @return void */
    public function loadPage():void
    {
        echo "(configController/loadPage:) Carregar pagina: {$this->urlController}<br>";

        /* Se estiver UTILIZANDO LINUX pode gerar erro, pois no linux a primeira LETRA da classe precisa sempre estar em maiúculo. será feito acima no método:slugController( */
        // $this->urlController = ucwords($this->urlController);
        // echo " Carregar pagina CORRIGIDA: {$this->urlController}<br>";

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
