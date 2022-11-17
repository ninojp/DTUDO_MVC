<?php
namespace Sts\Models\helper;

use PDO;
use PDOException;

if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
/** Conexão com o banco de dados */
abstract class StsConn
{
    private string $host = HOST;
    private string $dbname = DBNAME;
    private string $user = USER;
    private string $pass = PASS;
    private object $connect;

    public function connecDb():object
    {
        try{
            $this->connect = new PDO("mysql:host={$this->host};dbname=".$this->dbname,$this->user,$this->pass);
            // echo "OK! Conectado";
            return $this->connect;

        }catch(PDOException $erro){
            die ('Não foi possivel CONECTAR! Tente novamente ou entre em contato com: '.EMAILADM.'<br>'.$erro);
        }
        
    }
}
