<?php
namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;

class AdmsLogin extends AdmsConn
{
    private array|null $data;
    //este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function login(array $data=null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        var_dump($this->data);

        //instanciar o método:connectDb() da classe:AdmsConn()pai como abtract e cria o objeto:$connect
        $conn = $this->connectDb();
        var_dump($conn);

        // instanciar a classe quando ERA public
        // $connect = new AdmsConn();
        // $conn = $connect->connectDb();
        // var_dump($conn);
    }
}