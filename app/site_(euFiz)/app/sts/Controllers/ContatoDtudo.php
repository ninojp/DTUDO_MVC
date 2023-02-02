<?php
namespace Sts\Controllers;
if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
use Core\ConfigView;
use Sts\Models\StsContatoDtudo;

/** Controller da página ContatoDtudo
 * aqui vai ficar as informações sobre o site(ou sobre min curriculo), informações de contato
 * depois eu tranfiro estas descrições para a pagina em si
 * https://localhost/DTUDO_MVC/app/sts/Controllers/ContatoDtudo.php
 */
class ContatoDtudo
//======================================================
/////////  NO CURSO ESTA É A CONTROLER CONTATO   ///////
//======================================================
{
    /** $data - Recebe os dados que devem ser enviados para VIEW
     * @var array|string|null
     * no php 8(foi adicionado a união, pode colocar mais de uma tipagem) pode se usar o |PAIPE(ou) para indicar q pode ser ARRAY ou|STRING ou|NULL */
    private array|string|null $data = null;

    /** $dataForm Recebe os dados da view e os insere no DB através da Models
     * @var array|string|null */
    private array|string|null $dataForm;
    //=============================================================================================
    /** Instanciar a classe responsável por carregar a View
    * @return void */
    public function index():void
    {
        //Receber os dados q vem do formulário da view Contatodtudo
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        //verifica se foi feito a submissão do form, através do botão:addContMsg
        if(!empty($this->dataForm['addContMsg'])){
            //limpa os dados:addContMsg
            unset($this->dataForm['addContMsg']);
            $createContatoMsg = new StsContatoDtudo();
            if($createContatoMsg->create($this->dataForm)){
                // echo "Cadastrado!<br>";
            }else{
                // echo "NÃO! Cadastrado!<br>";
                $this->data['form'] = $this->dataForm;
            }
        }
        
        // $this->data = "Mensagem enviada com sucesso!<br>";
        $loadView = new ConfigView("sts/Views/contatodtudo/Contatodtudo",$this->data);
        $loadView->loadView();
    }
}