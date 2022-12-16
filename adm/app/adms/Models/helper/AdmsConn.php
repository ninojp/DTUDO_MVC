<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use PDO;
use PDOException;
//a classe abstract não pode ser instanciada só pode ser herdada
abstract class AdmsConn
{
    private string $host=HOST;
    private string $user=USER;
    private string $pass=PASS;
    private string $dbname=DBNAME;
    private int|string $port=PORT;
    private object $connect;

    //o método protected só pode ser instanciado pela própria classe ou pela classe filha
    protected function connectDb():object
    {
        try{
            //Realizar a conexão com a porta, com a Base de Dados - DB
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=".$this->dbname,$this->user,$this->pass);

            // echo "OK! Conexão com sucesso";
            return $this->connect;
        }catch(PDOException $err){
            die("Erro - 001! Tente Novamente ou entre em contato com: ".EMAILADM);
        }
    }
    
}