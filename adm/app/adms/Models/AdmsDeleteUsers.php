<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeleteUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var string - Recebe o endereço para apagar o diretório    */
    private string $delDirectory;

    /** @var string - Recebe o endereço para apagar a imagem    */
    private string $delImg;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deleteUsers(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewUsers()){
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_users", "WHERE id =:id", "id={$this->id}");

            if($deleteUser->getResult()){
                $this->deleteImg();
                $_SESSION['msg'] = "<p class='alert alert-danger'>OK! Usuário APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewUsers():bool
    {
        $viewUsers = new \App\adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT usr.id, usr.image FROM adms_users AS usr INNER JOIN adms_access_levels AS lev ON lev.id=usr.access_level_id WHERE usr.id=:id AND lev.order_levels >:order_levels LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário não encontrado!</p>";
            return false;
        }
    }
    /** ==========================================================================================
     * Método responsável por DELETAR o diretório e a imagem
     * @return void     */
    private function deleteImg():void
    {
        if((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)){
            //Atribui o endereço do diretório onde está a imagem, para o atributo:$this->delDirectory
            $this->delDirectory = "app/adms/assets/imgs/users/".$this->resultBd[0]['id'];
            //Atribui o endereço do diretório e da imagem, para o atributo:$this->delImg
            $this->delImg = $this->delDirectory."/".$this->resultBd[0]['image'];
            //verifica se existe a imagem, se existir apaga
            if(file_exists($this->delImg)){
                unlink($this->delImg);
            }
            //verifica se existe o diretório, se existir apaga 
            if(file_exists($this->delDirectory)){
                rmdir($this->delDirectory);
            }
        }
    }
}
