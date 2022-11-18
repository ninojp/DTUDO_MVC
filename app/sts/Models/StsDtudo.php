<?php
namespace Sts\Models;

use Sts\Models\helper\StsRead;

if(!defined('C7E3L8K9E5')){
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
/** classe Models responsável em buscar os dados da página home */
class StsDtudo
{
    /** Recebe os registros do Banco de Dados
     * @var array */
    // private array|string|null $data;
    private array|string|null $data;

    /** ============================================================================================
     *
     * @return void  */
    public function index()
    {
        /* $this->data = ['title'=>'Topo da Página', 'description'=>'Descrição do Serviço'];
        // instancia a classe:StsConn e cria o objeto:$connection, para fazer a conexão
        $connection = new StsConn();
        $this->connection = $connection->connecDb();
        $queryAnime = ("SELECT * FROM anime WHERE id_anime=:id LIMIT :limite");
        $resultAnime = $this->connection->prepare($queryAnime);
        $resultAnime->bindValue(':limite',1, PDO::PARAM_INT);
        $resultAnime->bindValue(':id',13, PDO::PARAM_INT);
        $resultAnime->execute();
        $this->data = $resultAnime->fetch(); */

        //instancia a classe: StsRead() e cria o objeto: $viewDtudo
        $viewDtudo = new StsRead();
        // instancia o método exeRead(), q faz uma query completa com todos oas dados
        // $viewDtudo->exeRead("anime","WHERE id_anime=:id LIMIT :limite", "id=1&limite=1");

        //instancia o fullRead(), q faz uma query de apenas os campos no select
        $viewDtudo->fullRead("SELECT id,nome,email,assunto FROM sts_sobre_dtudo_msgs WHERE id=:id LIMIT :limite", "id=1&limite=1");//
        $this->data = $viewDtudo->getResult();
        

        // var_dump($this->data);
        // $this->data = [];
        return $this->data;
        // echo "Mensagem de teste...<br>";
    }
}
