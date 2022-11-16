<?php
namespace Sts\Controllers;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
use Core\ConfigView;

/** Controller da página SobreDtudo
 * aqui vai ficar as informações sobre o site(ou sobre min curriculo), informações de contato
 * depois eu tranfiro estas descrições para a pagina em si
 * https://localhost/DTUDO_MVC/app/sts/Controllers/SobreDtudo.php
 */
class SobreDtudo
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null
     * no php 8(foi adicionado a união, pode colocar mais de uma tipagem) pode se usar o |PAIPE(ou) para indicar q pode ser ARRAY ou|STRING ou|NULL */
    private array|string|null $data;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View
    * @return void */
    public function index()
    {
        //ESTA CONTROLLER NÃO VAI RECEBER $DADOS
        // $this->data=[];
        // $this->data=null;
        $this->data = "Mensagem enviada com sucesso!<br>";
        $loadView = new ConfigView("sts/Views/sobredtudo/sobredtudo",$this->data);
        $loadView->loadView();
    }
}