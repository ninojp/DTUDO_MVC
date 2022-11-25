<?php
namespace App\adms\Models\helper;

/** Classe genérica para fazer a validação da SENHA via PHP */
class AdmsValPassword
{
    /** @var string - $password: Recebe a senha q dever ser validada */
    private string $password;
    /** @var boolean - $result: Recebe true quando executar o processo com sucessoe false quando houver erro  */
    private bool $result;

    /** =============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return boolean     */
    function getResult():bool
    {
        return $this->result;
    }

    public function validatePassword(string $password):void
    {
        //Atribui o parametro $password para o atributo:$this->password, para poder utilizado fora do escopo do método:validatePassword(), como atributo pode ser usado em qualquer lugar na classe 
        $this->password = $password;

        if(stristr($this->password, "'")){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Caracter (') utilizado na senha, é inválido!</p>";
            $this->result=false;
        }else {
            if(stristr($this->password, " ")){
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Proibido utilizar caracter em branco no campo senha!</p>";
                $this->result=false;
            }else{
                $this->result = true;
            }
        }
    }

}
