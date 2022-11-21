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
        $this->classLoad = "\\App\\adms\\Controllers\\".$this->urlController;
        if(class_exists($this->classLoad)){
            $this->loadMetodo();
        }else{
            //abaixo pode ser usado o DIE ou a função RECURSIVA para chamar a pagina indica:CONTROLLER
            // die("Erro - 003! Tente Novamente ou entre em contato com: ".EMAILADM);
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
            //função(método) recursiva:loadPage()
            $this->loadPage($this->urlController,$this->urlMetodo,$this->urlParameter);
        }
    }
    private function loadMetodo():void
    {
        $classLoad = new $this->classLoad();
        if(method_exists($classLoad, $this->urlMetodo)){
            $classLoad->{$this->urlMetodo}();
        }else{
            die("Erro - 004! Tente Novamente ou entre em contato com: ".EMAILADM);
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
