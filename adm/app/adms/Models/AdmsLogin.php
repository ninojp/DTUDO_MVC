<?php
namespace App\adms\Models;

class AdmsLogin
{
    private array|null $data;
    //este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function login(array $data=null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        var_dump($this->data);
    }
}