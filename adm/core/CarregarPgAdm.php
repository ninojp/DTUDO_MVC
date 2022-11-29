<?php
namespace Core;

/** Verificar se existe a classe e Carregar a CONTROLLER
 * @author Nino JP <meu.sem@gmail.com>  */
class CarregarPgAdm
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var array - $listPgPublic: Recebe a lista das paginas publicas(acessadas sem login) */
    private array $listPgPublic;
    /** @var array - $listPgPrivate: Recebe a lista das paginas privadas(acessadas com login) */
    private array $listPgPrivate;


    /** ==============================================================================================
     * @param string|null $urlController
     * @param string|null $urlMetodo
     * @param string|null $urlParameter
     * @return void */
    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter):void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        // var_dump($this->urlController);
        // var_dump($this->urlMetodo);
        // var_dump($this->urlParameter);
        //apenas para testes
        // unset($_SESSION['user_id']);
        
        $this->pgPublic();

        if(class_exists($this->classLoad)){
            $this->loadMetodo();
        }else{
            //abaixo pode ser usado o DIE ou a função RECURSIVA para chamar a pagina indica:CONTROLLER
            die("Erro - 003! Tente Novamente ou entre em contato com: ".EMAILADM);
            // $this->urlController = $this->slugController(CONTROLLER);
            // $this->urlMetodo = $this->slugMetodo(METODO);
            // $this->urlParameter = "";
            // //função(método) recursiva:loadPage()
            // $this->loadPage($this->urlController,$this->urlMetodo,$this->urlParameter);
        }
    }
    /** ============================================================================================
     *
     * @return void    */
    private function loadMetodo():void
    {
        $classLoad = new $this->classLoad();
        if(method_exists($classLoad, $this->urlMetodo)){
            $classLoad->{$this->urlMetodo}();
        }else{
            die("Erro - 004! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
    /** ===========================================================================================
     * Método para verificar se a url a ser carregada está na lista de paginas publicas
     * @return void    */
    private function pgPublic():void
    {
        $this->listPgPublic = ["Login", "Erro", "Logout", "NewUser", "ConfEmail", "NewConfEmail"];
        
        if(in_array($this->urlController, $this->listPgPublic)){
            // echo "Página Publica<br>";
            $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
        }else{
            // echo "Página Publica não encontrada<br>";
            $this->pgPrivate();
        }
    }
    /** ===============================================================================================
     * Instacia o método para verificar se foi feito o login e e confere se a url a ser carregada está na lista de paginas Privadas  -  @return void    */
    private function pgPrivate():void
    {
        $this->listPgPrivate = ["Dashboard", "Users"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            // $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
            $this->verifyLogin();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro: Página não encontrada!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect");
        }
    }
    /** ===========================================================================================
     * Método para verificar se foi feito o LOGIN
     * @return void    */
    private function verifyLogin():void
    {
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email'])) ){
            $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro: Para acessar a Página realize o login!</p>";
            $urlRedirect = URLADM."login/index";
            header("Location: $urlRedirect"); 
        }
    }
    /** =========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de classe
     * @return string - @param [string] $slugController */
    private function slugController(string $slugController):string
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

        // var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }
    /** ==========================================================================================
     * Faz o tratamento da url para um formato aceito como nome de MÉTODO
     * @return string - instanciar o método que trata a controller */
    private function slugMetodo(string $urlSlugMetodo):string
    {
        //faz todo o tratamento com o Método:slugController() e depois atribui para: $urlSlugMetodo
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter a primeira letra da frase em Minúsculo
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        // var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
    
}
