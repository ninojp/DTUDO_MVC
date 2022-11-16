<?php
namespace Sts\Models;

use PDO;
use Sts\Models\helper\StsConn;
use Sts\Models\helper\StsRead;

if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
class StsDtudo
{
    /** Recebe os registros do Banco de Dados
     * @var array */
    private array $data;
    /** Recebe os registros do Banco de Dados
     * @var object */
    private object $connection;

    /** ============================================================================================
     *
     * @return void  */
    public function index():array
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

        $viewDtudo = new StsRead();
        $viewDtudo->exeRead("anime","WHERE id_anime=:id LIMIT :limite", "id=1&limite=1");
        $this->data = $viewDtudo->getResult();

        var_dump($this->data);

        // $this->data= [];
       
        return $this->data;
    }
}
