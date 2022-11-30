<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

/** Classe genérica para editar registros no banco de dados */
class AdmsUpdate extends AdmsConn
{
    private string $table;
    private string|null $terms;
    private array $data;
    private array $value = [];
    private string|null|bool $result;
    private object $update;
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
    public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;
        // var_dump($this->table);
        // var_dump($this->data);
        // var_dump($this->terms);
        // var_dump($parseString);
        parse_str($parseString, $this->value);
        // var_dump($this->value);

        $this->exeReplaceValues();
    }
    /** ==========================================================================================
     * @return void     */
    private function exeReplaceValues(): void
    {
        foreach ($this->data as $key => $value) {
            // var_dump($key);
            $values[] = $key . "=:" . $key;
        }
        // var_dump($values);
        $values = implode(', ',$values);
        // var_dump($values);

        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";
        // var_dump($this->query);

        $this->exeInstruction();
    }
    /** =============================================================================================
     * @return void     */
    private function exeInstruction():void
    {
        $this->connection();
        try{
            $this->update->execute(array_merge($this->data, $this->value));
            $this->result = true;
        }catch(PDOException $err){
            $this->result = null;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function connection():void
    {
        //faz conexão com o DB
        $this->conn = $this->connectDb();
        //prepara a query e atribui para o atributo:$this->insert
        $this->update = $this->conn->prepare($this->query);
    }

}
