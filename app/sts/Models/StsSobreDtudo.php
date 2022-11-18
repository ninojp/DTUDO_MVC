<?php
namespace Sts\Models;

use Sts\Models\helper\StsCreate;

if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
/** classe Models responsável por cadastrar as informações do formulario no DB */
class StsSobreDtudo
{
    /** Recebe os registros do Banco de Dados
     * @var array */
    private array $data;
    /** Recebe os registros do Banco de Dados
     * @var object */
    private object $connection;

    /** ============================================================================================
     *
     * @return bool  */
    public function create(array $data):bool
    {
        //recebe os dados q vieram do formulário da view
        $this->data = $data;
        //adiciona o campo created(q não veio do form), no formato correto: date("Y-m-d H:i:s")
        $this->data['created'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        //instancia a classe:StsCreate do Models:helper, e cria o objeto:$createSobreDtudoMsg
        $createSobreDtudoMsg = new StsCreate();
        //instancia o método:exeCreate, e passa para ele o nome da tabela e os dados
        $createSobreDtudoMsg->exeCreate("sts_sobre_dtudo_msgs",$this->data);

        if($createSobreDtudoMsg->getResult()){
            //recupera(apresenta) o ultimo ID inserido 
            // var_dump($createSobreDtudoMsg->getResult());
            $_SESSION['msg'] = "<p class='alert alert-success'>Mensagem enviada com Sucesso(salvou no DB)</p>";
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>ERRO! Mensagem não enviada (Não salvou no DB)</p>";
            return false;
        }

    }
}
