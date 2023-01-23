<?php
namespace Sts\Models;

use Sts\Models\helper\StsRead;

if(!defined('C7E3L8K9E5')){
    die ('Erro! Página não encontrada');       
}
/** LISTAR MAIS DE UM REGISTRO - classe Models responsável em buscar os dados */
class StsAnimacao
//==============================================================
/////////  NO CURSO ESTA É A CONTROLER StsSOBREEMPRESA   ///////
//==============================================================
{
    /** Recebe os registros do Banco de Dados
     * @var array|null */
    // private array $data;
    private array|null $data;

    /** ============================================================================================
     * Instancia a classe genérica no helper, responsável em buscar os regisro no banco de dados.
     * Possui a Query responsavel em buscar os registros no DB
     * @return array Retorna o registro do DB com informações para pagina animacao */
    public function index():array|null
    {
        //instancia a classe: StsRead() e cria o objeto: $viewDtudo
        $viewAnimacao = new \Sts\Models\helper\StsRead();
        //instancia o método:fullRead(), q faz uma query de apenas os campos no select
        $viewAnimacao->fullRead("SELECT id,title,description,image FROM sts_abouts_companies WHERE sts_situation_id=:sts_situation_id ORDER BY id DESC LIMIT :limit", "sts_situation_id=1&limit=10");
        //usado para testes - funcionou
        // $viewAnimacao->fullRead("SELECT id,title,description,image FROM sts_abouts_companies");
        $this->data = $viewAnimacao->getResult();
        // var_dump($this->data);
        // die('AQUI MODELs StsAnimacao!!!');
        
        // $this->data = [];
        return $this->data;
    }
}
