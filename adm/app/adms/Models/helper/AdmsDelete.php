<?php
namespace App\adms\Models\helper;

use PDO;
use PDOException;

/** Classe genérica para APAGAR registro no banco de dados */
class AdmsDelete extends AdmsConn
{
    private string $table;
    private string|null $terms;
    private array $value = [];
    private string|null|bool $result;
    private object $delete;
    private string $query;
    private object $conn;

    /** ===========================================================================================
     * @return string     */
    function getResult():string|null|bool
    {
        return $this->result;
    }
    /** ===========================================================================================
     * @param string $table
     * @param array $data
     * @param string|null|null $terms
     * @param string|null|null $parseString
     * @return void    */
    public function exeDelete(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->terms = $terms;
        // var_dump($this->table);
        // var_dump($this->terms);
        // var_dump($parseString);
        //faz a converção da string para um array
        parse_str($parseString, $this->value);
        // var_dump($this->value);

        $this->query = "DELETE FROM {$this->table} {$this->terms}";

        $this->exeInstruction();
    }
    /** =============================================================================================
     * @return void     */
    private function exeInstruction():void
    {
        $this->connection();
        try{
            $this->delete->execute($this->value);
            $this->result = true;
        }catch(PDOException $err){
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function connection():void
    {
        //faz conexão com o DB
        $this->conn = $this->connectDb();
        //prepara a query e atribui para o atributo:$this->insert
        $this->delete = $this->conn->prepare($this->query);
    }

}
