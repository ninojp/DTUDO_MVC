<?php
namespace App\sts\core;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:ConfigView, para carregar as Views(paginas) do STS, pré definidas no método,
* E mais a VIEW que estiver recebendo via parametro pelo método:__construct */
class ConfigViewSts
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
    public function loadViewSts():void
    {
        //verifica se existe o arquivo(indicado pela controller) a ser carregado 
        if(file_exists('app/'.$this->nameView.'.php')){
            // var_dump($this->data);
            //inclui o arquivo:headSts.php, cabeçalho html para todas as Paginas(Views) (EXCLUSIVO PARA O PACOTE STS) 
            include 'app/sts/Views/include/headSts.php';
            //inclui o arquivo:navbar.php, (NAVBAR DO PACOTE ADMS), O MESMO DO ADMINISTRATIVO!
            include 'app/adms/Views/include/navbar.php';
            //inclui o arquivo:menu.php, (MENU DO PACOTE ADMS), O MESMO DO ADMINISTRATIVO!
            include 'app/adms/Views/include/menu.php';
            //se existir, inclui o arquivo(indicado pela controller)
            include 'app/'.$this->nameView.'.php';
            //inclui o arquivo:footer.php com o rodapé html para todas as Paginas(Views) (EXCLUSIVO PARA O PACOTE STS)
            include 'app/sts/Views/include/footerSts.php';
        }else{
            //pode-se criar uma tabela com codigos de erros, para uso interno:Erro 501
            die("Erro - (loadView(sts))! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }

}
