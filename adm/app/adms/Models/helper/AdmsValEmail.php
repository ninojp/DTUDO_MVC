<?php
namespace App\adms\Models\helper;

/** Classe genérica para fazer a validação de Email */
class AdmsValEmail
{
    private string $email;
    private bool $result;

    function getResult():bool
    {
        return $this->result;
    }

    function validateEmail(string $email):void
    {
        $this->email = $email;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail inválido</p>";
            $this->result = false;

        }
    }

}
