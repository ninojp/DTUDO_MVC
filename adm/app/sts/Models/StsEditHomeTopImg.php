<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:StsEditHomeTopImg, para para editar Imagem do Topo da pagina Home */
class StsEditHomeTopImg
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var array - Recebe os dados da view, como um parametro    */
    private array|null $data;

    /** @var array|string|null - ...    */
    private array|string|null $dataImagem;

    /** @var array|string - ...    */
    private array|string|null $nameImg;

    /** @var array|string - ...    */
    private array|string|null $directory;
    
    /** @var array|string - ...    */
    private array|string|null $delImg;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** =========================================================================================  */
    public function viewHomeTopImg():bool
    {
        $viewHomeTopImg = new \App\adms\Models\helper\AdmsRead();
        $viewHomeTopImg->fullRead("SELECT id, image_top FROM sts_homes_tops LIMIT :limit", "&limit=1");

        $this->resultBd = $viewHomeTopImg->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewHomeTopImg())! Imagem do topo da pagina Home  não encontrado!</p>";
            $this->result = false;
            return false;
        }
    }
     /** ===========================================================================================
     * @param array|null $data
     * @return void    */
    public function update(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);

        $this->dataImagem = $this->data['new_image'];
        //destroi estes dados do array
        unset($this->data['new_image']);
        // var_dump($this->data);
        
        // instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            if(!empty($this->dataImagem['name'])){
                // $this->result = false;
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma imagem</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Verificar se existe o usuário com o id Logado
     * Retorna false quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        $valExtImg = new \App\adms\Models\helper\AdmsValExtImg();
        $valExtImg->validateExtImg($this->dataImagem['type']);

        if(($this->viewHomeTopImg()) and ($valExtImg->getResult())){
            // $this->result = false;
            $this->upload();
        } else {
            $this->result = false;
        }
    }

    /** ===========================================================================================
     * @return void     */
    private function upload()
    {
        //instancia a classe responsável por alterar o NOME da imagem
        $slugImg = new \App\adms\Models\helper\AdmsSlug();
        $this->nameImg = $slugImg->slug($this->dataImagem['name']);
        // var_dump($this->nameImg);

        //Diretório onde ficaram as imagens do usuário(criada dinamicamente com o ID do usuário)
        $this->directory = "app/sts/assets/imgs/home_top/";

        // Upload de imagem COM Redimencionamento
        // $uploadImgRes = new \App\adms\Models\helper\AdmsUploadImgRes();
        // $uploadImgRes->upload($this->dataImagem, $this->directory, $this->nameImg, 1300, 600);

        // Upload de imagem SEM Redimencionamento
        $uploadImg = new \App\sts\Models\helper\StsUploadImg();
        $uploadImg->upload($this->directory, $this->dataImagem, $this->nameImg);

        if($uploadImg->getResult()){
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
    * @return void     */
    private function edit():void
    {
        $this->data['image_top'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("sts_homes_tops", $this->data, "WHERE id=:id", "id={$this->data['id']}");
        if($upUser->getResult()){
            $this->deleteImage();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro edit(models)! Imagem Não Editada com sucesso</p>";
            $this->result = false;
        }
    }
    /** =========================================================================================
     * @return void     */
    private function deleteImage():void
    {
        if(((!empty($this->resultBd[0]['image_top'])) or ($this->resultBd[0]['image_top'] != null)) and ($this->resultBd[0]['image_top'] != $this->nameImg)){
            $this->delImg = "app/sts/assets/imgs/home_top/".$this->resultBd[0]['image_top'];
            if(file_exists($this->delImg)){
            unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Imagem Editada com sucesso! </p>";
        $this->result = true;
    }
}
