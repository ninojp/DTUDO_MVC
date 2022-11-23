<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

/** Classe genérica para selecionar registros no banco de dados */
class AdmsRead extends AdmsConn
{
    private string $select;
    private array $values = [];
    private array|null $result;
    private object $query;
    private object $conn;

    function getResult(): array|null
    {
        return $this->result;
    }

    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        // var_dump($table);
        // var_dump($terms);
        // var_dump($parseString);
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            // var_dump($this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        // var_dump($this->select);
        $this->exeInstruction();
    }

    public function fullRead(string $query, string|null $parseString=null):void
    {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
            // var_dump($this->values);
        }
        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->exeParameter();
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }
    private function connection()
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function exeParameter(): void
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                // var_dump($link);
                // var_dump($value);
                if(($link == 'limit') or ($link == 'offset') or ($link == 'id')){
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
