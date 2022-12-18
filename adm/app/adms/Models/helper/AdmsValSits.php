<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para fazer a validação da Situação */
class AdmsValSits
{
    private string $sits;
    private bool $result;

    /** ==============================================================================================
     * @return boolean     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==============================================================================================
     * @param string $sits
     * @return void     */
    function validateSits(string $sits):void
    {
        $this->sits = $sits;
        if(filter_var($this->sits, FILTER_DEFAULT)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Situação inválida</p>";
            $this->result = false;
        }
    }

}
