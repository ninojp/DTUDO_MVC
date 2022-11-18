<?php
namespace Sts\Models\helper;

use PDOException;

if(!defined('C7E3L8K9E5')){
    die ('Erro! Página não encontrada');       
}
class StsCreate extends StsConn
{
//--------------------------------------------------------------------------------------------------
    private string $table;
    private array $data;
    private string|null $result = null;
    private object $insert;
    private string $query;
    private object $conn;
//--------------------------------------------------------------------------------------------------

    function getResult() :string|null
    {
        return $this->result;
    }
    /** ============================================================================================
     * método reponsável por receber os dados da controler, atribuir aos atributos
     * E instancia o método:exeReplaceValues()
     * @param string $table
     * @param array $data
     * @return void */
    public function exeCreate(string $table, array $data):void
    {
        //recebe o nome da tabela e atribui a o atributo:$table
        $this->table = $table;
        //recebe os dados da controler e atribui para o atributo:$data
        $this->data = $data;
        // var_dump($this->data);

        $this->exeReplaceValues();
    }

    /** ===========================================================================================
     *
     * @return void */
    private function exeReplaceValues():void
    {
        //converter as chaves do array para Strings
        $coluns = implode(',',array_keys($this->data));
        // var_dump($coluns);

        $values = ':'.implode(',:',array_keys($this->data));
        // var_dump($values);

        $this->query = "INSERT INTO {$this->table} ($coluns) VALUES($values)";
        // var_dump($this->query);

        $this->exeInstruction();
    }

    private function exeInstruction():void
    {
        $this->connection();
        try{
            $this->insert->execute($this->data);
            $this->result = $this->conn->lastInsertId();
        }catch(PDOException $err){
            $this->result = null;
        }
    }

    private function connection():void
    {
        $this->conn = $this->connecDb();
        $this->insert = $this->conn->prepare($this->query);
    }
}