<?php
namespace Core;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}

/** Carregar as páginas da View */
class ConfigView
{
    //forma antiga de declarar os atributos(antes do PHP 8)
    // private string $nome;
    // private array $dados;

    /** ====================================================================================
     * método construtor para ser carregado automaticamente quando a classe for instaciada
     * Recebe o endereço da VIEW e os dados
     * @param string $nameView - Endereço da VIEW que deve ser carregada
     * @param array|string|null $data - Dados q a VIEW deve receber.
     * forma atual declarar os atributos, direto dentro do método(como parametro) */ 
    public function __construct(private string $nameView, private array|string|null $data)
    {
        // forma antiga de instanciar os atributos(antes do PHP 8)
        // $this->nome = $nome;
        // $this->dados = $dados;
        // var_dump($this->nameView);
        // var_dump($this->data);
    }
    /** ===============================================================================
     * Este é o método que Carrega a view das paginas(layout)
     * Verificar se o arquivo existe, e carregar caso exista, não existindo para o carregamento
     * @return void */
    public function loadView():void
    {
        if(file_exists('app/'.$this->nameView.'.php')){
            include 'app/sts/Views/include/header.php';
            include 'app/sts/Views/include/menu.php';
            include 'app/'.$this->nameView.'.php';
            include 'app/sts/Views/include/footer.php';
        }else{
            die ('Não foi possivel encontrar a pagina! Tente novamente ou entre em contato com: '.EMAILADM.'<br>');
        }   
    }

}