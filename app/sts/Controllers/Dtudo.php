<?php
namespace Sts\Controllers;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
use Core\ConfigView;

/** Controller da página INICIAL dtudo */
class Dtudo
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null */
    private array|string|null $data;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View
    * @return void */
    public function index()
    {
        $this->data=[];
        $loadView = new ConfigView("sts/Views/dtudo/dtudo",$this->data);
        $loadView->loadView();
    }
}