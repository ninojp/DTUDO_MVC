<?php
//indica q esta classe pertence ao namespace CORE
namespace Core;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
/** @author Nino JP <meu.sem@gmail.com>
 * Esta classe recebe a URL e manipula a mesma. Carrega a CONTROLLER 
 * esta também é uma classe filha da classe abstrata (Config) */
class ConfigController extends Config
{
    /** @var string - $url, recebe a URL do arquivo .HTACCESS  */
    private string $url;
    /** @var array - $urlArray, Recebe o URL q foi convertida para um array */
    private array $urlArray;
    private string $urlController;
    // private string $urlParameter;
    private string $urlSlugController;
    private array $format;

    //=============================================================================================
    /** Recebe via _GET a URL do .htaccess
     * Validar a URL */
    public function __construct()
    {
        //instanciando o método da classe mãe(Config) 
        $this->config();

        // echo "carregar a pagina<br>";
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            //instancia o método clearUrl()
            $this->clearUrl();
            //dividade a url e a converte para um array
            $this->urlArray = explode("/",$this->url);
            //verifica se está definido a controller nesta parte do array
            if(isset($this->urlArray[0])){
                $this->urlController = $this->slugController($this->urlArray[0]);
            }else{
                //se não estiver direciona para pagina ERRO!
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }
        }else{
            // echo "Acessa a página inicial<br>";
            $this->urlController = $this->slugController(CONTROLLER);
        }
    }
    //========================================================================================
    /** Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
     * @return void - pois não retorna valores */
    private function clearUrl():void
    {
        //Eliminar as Tag
        $this->url = strip_tags($this->url);
        //Eliminar os espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da url
        $this->url= rtrim($this->url, '/');
        //Eliminar caracteres(faz a substituição) 
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']),$this->format['b']);
    }
    //===========================================================================================
     /** Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa" */
    private function slugController($slugController):string
    {
        //Converter para minúsculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traço por espaço em branco
        $this->urlSlugController = str_replace("-"," ",$this->urlSlugController);
        //Converter a primeira letra de cada palavra em maiúscula
        $this->urlSlugController = ucwords($this->urlSlugController);
        //retirar o espaço em branco
        $this->urlSlugController = str_replace(" ","",$this->urlSlugController);
        return $this->urlSlugController;
    }
    //==========================================================================================
    /** Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     * @return void */
    public function loadPage()
    {
        // echo 'Carregar a pagina/controller<br>';
        $classLoad = "\\Sts\\Controllers\\".$this->urlController;
        $classPage = new $classLoad();
        $classPage->index();
    }

}
