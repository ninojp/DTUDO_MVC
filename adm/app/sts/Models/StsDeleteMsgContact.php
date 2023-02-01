<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteUsers, Apagar o Artigo da pagina Sobre Empresa no banco de dados */
class StsDeleteMsgContact
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
    public function deleteMsgContact(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewMsgContact()){
            $deleteMsgContact = new \App\adms\Models\helper\AdmsDelete();
            $deleteMsgContact->exeDelete("sts_contacts_msgs", "WHERE id=:id", "id={$this->id}");

            if($deleteMsgContact->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Mensagem(Pg Contato) APAGADA com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (deleteMsgContact(Model))! Mensagem(Pg Contato) Não APAGADA com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewMsgContact():bool
    {
        $viewMsgContact = new \App\adms\Models\helper\AdmsRead();
        $viewMsgContact->fullRead("SELECT scm.id FROM sts_contacts_msgs AS scm WHERE scm.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewMsgContact->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewMsgContact(Model))! Artigo não encontrado!</p>";
            return false;
        }
    }
}
