<?php
namespace Sts\Controllers;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
use Core\ConfigView;
use Sts\Models\StsAnimacao;

/** Controller da página Animacao 
 * a idéia agora é colocar informação sobre os animes aqui
 * depois fazer um site somente para DOWNLOAD usando o mesmo banco de dados
*/
class Animacao
//===========================================================
/////////  NO CURSO ESTA É A CONTROLER SOBREEMPRESA   ///////
//===========================================================
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null */
    private array|string|null $data;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View:loadView()
    * @return void */
    public function index()
    {
        //instanciar a models:StsAnimacao
        $aboutAnimacao = new \Sts\Models\StsAnimacao;
        //instaciar o método:index() da classe models:StsAnimacao
        $this->data['about-company'] = $aboutAnimacao->index();
        // var_dump($this->data['about-company']);
        // die('AQUI CONTROLLER Animacao');

        // $this->data=[];
        $loadView = new ConfigView("sts/Views/animacao/animacao",$this->data);
        $loadView->loadView();
    }
}