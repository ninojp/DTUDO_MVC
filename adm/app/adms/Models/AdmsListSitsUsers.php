<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

class AdmsListSitsUsers
{
    //recebe o resultado true|fasse e os retorna quando solicitado
    private bool $result;
    //Recebe o resultado da query ao DB
    private array|null $resultBd;

    /** =============================================================================================
     * Método que atribui o true ou false para o atributo:$result
     * @return boolean     */
    public function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     *  Método que recebe os dados da query ao DB e os atribui para o atributo:$resultBd 
     * @return array|null
     */
    public function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** =============================================================================================
     * @return void     */
    public function listSitsUsers()
    {
        $listSitUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitUsers->fullRead("SELECT sits.id, sits.name AS sitsname, col.name AS colname, col.color FROM adms_sits_users AS sits INNER JOIN adms_colors AS col ON col.id=sits.adms_color_id ORDER BY sits.id DESC");

        $this->resultBd = $listSitUsers->getResult();

        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhuma informação(Situação) encontrada na DB!</p>";
            $this->result - false;
        }
    }
}