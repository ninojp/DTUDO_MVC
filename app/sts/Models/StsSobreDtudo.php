<?php
namespace Sts\Models;

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
        $this->data = $data;
        // var_dump($this->data);
        $_SESSION['msg'] = "<p class='alert alert-success'>Salvar Mensagem</p>";
        return false;
    }
}
