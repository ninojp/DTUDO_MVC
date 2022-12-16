<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use PDOException;
/**  */
class AdmsCreate extends AdmsConn
{
    private string $table;
    private array $data;
    private string|null $result;
    private object $insert;
    private string $query;
    private object $conn;

    /** ==============================================================================================
     * @return string     */
    function getResult(): string
    {
        return $this->result;
    }
    /** ==============================================================================================
     * @param string $table
     * @param array $data
     * @return void     */
    function exeCreate(string $table, array $data): void
    {
        $this->table = $table;
        $this->data = $data;
        // var_dump($this->table);
        // var_dump($this->data);
        $this->exeReplaceValues();
    }
    /** ==============================================================================================
     * @return void     */
    private function exeReplaceValues()
    {
        //converte todas as chaves(keys) do array em uma string
        $coluns = implode(', ', array_keys($this->data));
        // var_dump($coluns);
        //converte todas as chaves(keys) do array em uma string com :link para ser usada como :link
        $values = ':' . implode(', :', array_keys($this->data));
        // var_dump($values);
        //cria a query com os valores dinamicos e atribui para o atributo:$this->query
        $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
        // var_dump($this->query);
        $this->exeInstruction();
    }
    /** ==============================================================================================
     * @return void     */
    private function exeInstruction(): void
    {
        $this->connection();
        try{
            //usa a query preparada q está no atributo:$this->insert para executar o que está no atributo:$this->data, os respectivos valores, nos respectivos :links 
            $this->insert->execute($this->data);
            //retorna para o atributo:$this->result, o ultimo ID inserido
            $this->result = $this->conn->lastInsertId();
        }catch(PDOException $err){
            $this->result = null;
        }
    }
    /** ==============================================================================================
     * @return void     */
    private function connection():void
    {
        //faz conexão com o DB
        $this->conn = $this->connectDb();
        //prepara a query e atribui para o atributo:$this->insert
        $this->insert = $this->conn->prepare($this->query);
    }
}
