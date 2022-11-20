<?php
namespace Core;

/** Carregar as paginas da view */
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
     * Método q verifica se existe e carrega(executa) a URL(string) recebida pela comtroller
     * @return void */
    public function loadView():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro 501! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
}
