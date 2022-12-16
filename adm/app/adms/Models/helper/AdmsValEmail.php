<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para fazer a validação de Email */
class AdmsValEmail
{
    private string $email;
    private bool $result;

    /** ==============================================================================================
     * @return boolean     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==============================================================================================
     * @param string $email
     * @return void     */
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
