<?php 
namespace Sts\Models\helper;

use PDO;
use PDOException;

if(!defined('C7E3L8K9E5')){
    //DEVE SER USADO APENAS UMA DAS OPÇÕES
    // header('Location: /'); 
    die ('Erro! Página não encontrada');       
}
/** Helper(arquivo auxiliar) - responsavel por buscar informações na DB
 * esta é uma classe filha da classe: StsConn
 * @author Nino JP */
class StsRead extends StsConn
{
    private string $select;
    private array $values = [];
    private array|null $result = [];
    private object $query;
    private object $conn;

    /** ============================================================================================
     *
     * @return array|null */
    function getResult():array|null
    {
        return $this->result;
    }

    /** ============================================================================================
     * @param [type] $table - nome da tabela q será usada
     * @param [type] $terms - os parametros :LINK, termos do (BindParam ou BindValue)
     * @param [type] $parseString
     * @return void */
    public function exeRead(string $table, string|null $terms=null, string|null $parseString=null )
    {
        var_dump($table);
        var_dump($parseString);
        if(!empty($parseString)){
            parse_str($parseString, $this->values);
            var_dump($this->values);
        }
        $this->select = "SELECT * FROM {$table} {$terms}";
        var_dump($this->select);

        $this->exeInstruction();
    }
    /** =============================================================================================
     *
     * @return void
     */
    private function exeInstruction()
    {
        $this->connection();
        
        try{
            
            $this->exeParameter();
            var_dump($this->query);
            $this->query->execute();
            $this->result = $this->query->fetchAll();

        }catch(PDOException $err){
            $this->result = null;
        }
    }

    private function connection()
    {
        $this->conn = $this->connecDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function exeParameter()
    {
        if($this->values){
            var_dump($this->values);
            foreach($this->values as $link => $value){
                var_dump($link);
                var_dump($value);
                if(($link == 'limite') || ($link == 'offset') || ($link == 'id')){
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}