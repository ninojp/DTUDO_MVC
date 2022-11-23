<?php
namespace App\adms\Models\helper;

/**  */
class AdmsValEmailSingle
{
    private string $email;
    private bool|null $edit;
    private int|null $id;
    private bool $result;
    private $resultBd;

    function getResult():bool
    {
        return $this->result;
    }

    function validateEmailSingle(string $email, bool|null $edit=null, int|null $id=null):void
    {
        $this->email = $email; 
        $this->edit = $edit; 
        $this->id = $id; 

        new AdmsRead();
    }

}
