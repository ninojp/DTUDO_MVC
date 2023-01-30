<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteUsers, Apagar o Artigo da pagina Sobre Empresa no banco de dados */
class StsDeleteAboutPg
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
    public function deleteAboutPg(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewAboutPg()){
            $deleteAboutPg = new \App\adms\Models\helper\AdmsDelete();
            $deleteAboutPg->exeDelete("sts_abouts_companies", "WHERE id=:id", "id={$this->id}");

            if($deleteAboutPg->getResult()){
                $this->deleteImg();
                $_SESSION['msg'] = "<p class='alert alert-danger'>OK! Artigo(Sobre Empresa) APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (deleteAboutPg(Model))! Registro Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAboutPg():bool
    {
        $viewAboutPg = new \App\adms\Models\helper\AdmsRead();
        $viewAboutPg->fullRead("SELECT sac.id, sac.image FROM sts_abouts_companies AS sac WHERE sac.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewAboutPg->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewAboutPg(Model))! Artigo não encontrado!</p>";
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
            $this->delDirectory = "app/sts/assets/imgs/about/".$this->resultBd[0]['id'];
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
