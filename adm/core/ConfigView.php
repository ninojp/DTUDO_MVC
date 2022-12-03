<?php
namespace Core;

/** Classe:ConfigView que contém os métodos para carregar as paginas(view) pré definidas no método,
* E mais a VIEW que estiver recebendo via parametro pelo método:__construct */
class ConfigView
{
    // Apartir do PHP 8, pode colocar este atributo:$nameView direto dentro do método:__construct()
    // private string $nameView;

    /** ==============================================================================================
     * Método:__construct()(roda automaticamente quanto se instacia esta classe)
     * @param string $nameView - Recebe da controller o endereço e nome da view que deve ser carregada
     * @param array|string|null $data - Recebe da controller os DADOS q a view deve receber */
    public function __construct(private string $nameView, private array|string|null $data)
    {
    }
    /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a URL(string) recebida pela comtroller.
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadView():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adms/Views/include/head.php';
            //inclui o arquivo com o MENU
            include 'app/adms/Views/include/menu.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adms/Views/include/footer.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 002! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
    /** =============================================================================================
     * Método q verifica se existe e carrega(executa) a View Login, sem o MENU
     * Não existindo apresenta a menssagem de erro!     * @return void */
    public function loadViewLogin():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo head.php com o cabeçalho html para todas as Paginas(Views)
            include 'app/adms/Views/include/head.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo footer.php com o rodapé html para todas as Paginas(Views)
            include 'app/adms/Views/include/footer.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - 005! Por Favor Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
}
