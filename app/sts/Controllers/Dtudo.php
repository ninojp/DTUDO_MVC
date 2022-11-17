<?php
namespace Sts\Controllers;
if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
// use Core\ConfigView;

/** Controller da página INICIAL dtudo */
class Dtudo
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null */
    private array|string|null $data;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View
    * @return void */
    public function index():void
    {
        //instancia a classe StsDtudo e criar o objeto $dtudo
        //dessa vez eu coloquei o endereço da CLASSE(normalmente eu uso o USE)
        $dtudo = new \Sts\models\StsDtudo();
        $this->data = $dtudo->index(); 
        
        //continua apresentando erro no $this->data, mas está funcionando o resultado 
        $loadView = new \Core\ConfigView("sts/Views/dtudo/dtudo", $this->data);
        $loadView->loadView();
    }
}