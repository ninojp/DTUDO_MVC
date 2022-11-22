<?php
namespace App\adms\Models\helper;

/**  */
class AdmsValEmptyField
{
    private array|null $data;
    private bool $result;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function valField(array $data = null)
    {
        $this->data = $data;
        //verificar se possui alguma TAG, se possuir, retire
        $this->data = array_map('strip_tags', $this->data);
        //retirar os espaços em branco
        $this->data = array_map('trim', $this->data);
        //verificar se veio algun campo vazio do formulario
        if(in_array('', $this->data)){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nécessário prencher todos os campos<br>";
            $this->result = false;
        }else{
            $this->result = true;
        }
    }

}
