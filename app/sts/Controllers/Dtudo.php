<?php
namespace Sts\Controllers;

use Sts\Models\StsDtudo;

if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
use Core\ConfigView;

/** Controller da página INICIAL dtudo */
class Dtudo
//======================================================
/////////  NO CURSO ESTA É A CONTROLER HOME   ///////
//======================================================
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null */
    private array|string|null $data;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View
    * @return void */
    public function index()
    {
        //instancia a classe StsDtudo e criar o objeto $dtudo
        //dessa vez eu coloquei o endereço da CLASSE(normalmente eu uso o USE)
        $objDtudo = new StsDtudo();
        // var_dump($objDtudo);
        $this->data = $objDtudo->index(); 
        // var_dump($this->data);
        
        //continua apresentando erro no $this->data, mas está funcionando o resultado 
        // $this->data=null;
        $loadView = new ConfigView("sts/Views/dtudo/dtudo", $this->data);
        $loadView->loadView();
    }
}