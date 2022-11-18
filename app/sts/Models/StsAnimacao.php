<?php
namespace Sts\Models;

use Sts\Models\helper\StsRead;

if(!defined('C7E3L8K9E5')){
    die ('Erro! Página não encontrada');       
}
/** LISTAR MAIS DE UM REGISTRO - classe Models responsável em buscar os dados */
class StsAnimacao
{
    /** Recebe os registros do Banco de Dados
     * @var array */
    // private array $data;
    private array $data;

    /** ============================================================================================
     * Instancia a classe genérica no helper, responsável em buscar os regisro no banco de dados.
     * Possui a Query responsavel em buscar os registros no DB
     * @return array Retorna o registro do DB com informações para pagina animacao */
    public function index(): array
    {

        //instancia a classe: StsRead() e cria o objeto: $viewDtudo
        $viewAnimacao = new StsRead();
        //instancia o fullRead(), q faz uma query de apenas os campos no select
        $viewAnimacao->fullRead("SELECT id,nome,email,assunto FROM sts_sobre_dtudo_msgs WHERE id=:id LIMIT :limite", "id=1&limite=1");
        $this->data = $viewAnimacao->getResult();
        

        // var_dump($this->data);
        // $this->data = [];
        return $this->data;
        // echo "Mensagem de teste...<br>";
    }
}
