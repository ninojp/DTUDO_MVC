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
   private string $resul;
   private object $update;
   private object $query;
   private object $conn;

   function getResult():string
   {
        return $this->result;
   }

   public function exeUpdate(string $table, array $data, string|null $terms=null, string|null $parseString=null):void
   {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;
        var_dump($this->table);
        var_dump($this->data);
        var_dump($this->terms);

        var_dump($parseString);
        parse_str($parseString, $this->value);
        var_dump($this->value);

   }
}
