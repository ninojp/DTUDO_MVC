<?php
namespace App\adms\Models\helper;


/** Classe genérica para REDIMENSIONAR imagem */
class AdmsUploadImgRes
{
    private array $imageData;
    private string $directory;
    private string $name;
    private int $width;
    private int $height;
    private $newImage;
    private bool $result;
    private $imgResize;

    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * @param array $imageData -  @param string $directory -  @param string $name -  @param integer $width -  @param integer $height  -  @return void     */
    public function upload(array $imageData, string $directory, string $name, int $width, int $height):void
    {
        $this->imageData = $imageData;
        $this->directory = $directory;
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        var_dump($this->imageData);

        $this->valDirectory();
    }
    /** ============================================================================================
     * @return void     */
    private function valDirectory():void
    {
        if((file_exists($this->directory)) and (!is_dir($this->directory))){
            $this->createDir();
        } elseif(!file_exists($this->directory)) {
            $this->createDir();
        } else {
            $this->uploadFile();
        }
    }
    /** =============================================================================================
     * @return void     */
    private function createDir():void
    {
        mkdir($this->directory, 0755);
        if(!file_exists($this->directory)){
            $_SESSION['msg'] = "<p class='alert alert-info'>Erro! Uplçoad da imagem não realizado com sucesso</p>";
        $this->result = false;
        } else {
            $this->uploadFile();
        }
    }

    /** =============================================================================================
     * @return void     */
    private function uploadFile():void
    {
        switch ($this->imageData['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->uploadFileJpeg();
                break;
            case 'image/png':
            case 'image/x-png':
                $this->uploadFilePng();
                break;
            default:
        $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma imagem JPEG ou PNG!</p>";
        $this->result = false;
        }
        // $_SESSION['msg'] = "<p class='alert alert-info'>Acessou o helper redimencionar imagem</p>";
        // $this->result = false;
    }
    /** =============================================================================================
     * @return void     */
    private function uploadFileJpeg():void
    {
        $this->newImage = imagecreatefromjpeg($this->imageData['tmp_name']);

        $this->redImg();

        // Enviar a imagem para o servidor - 100 refere-se a qualidade da imagem
        if(imagejpeg($this->imgResize, $this->directory.$this->name, 100)){
            $_SESSION['msg'] = "<p class='alert alert-success'>Upload da imagem relalizado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload da imagem não realizado com sucesso, tente novamente</p>";
            $this->result = false;
        }

    }
    /** =============================================================================================
     * @return void     */
    private function uploadFilePng():void
    {
        $this->newImage = imagecreatefrompng($this->imageData['tmp_name']);

        $this->redImg();

        // Enviar a imagem para o servidor - fator de compressão de 0 a 9
        if(imagepng($this->imgResize, $this->directory.$this->name, 0)){
            $_SESSION['msg'] = "<p class='alert alert-success'>Upload da imagem relalizado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload da imagem não realizado com sucesso, tente novamente</p>";
            $this->result = false;
        }

    }
    private function redImg():void
    {
        //obter a largura da imgem
        $width_original = imagesx($this->newImage);
        
        //obter a altura da imgem
        $height_original = imagesy($this->newImage);

        //Criar uma imgem modelo com as dimensões definidas para nova imagem
        $this->imgResize = imagecreatetruecolor($this->width, $this->height);

        // Copiar e redimensionar parte da imagem enviada pelo usuário e interpola com a imagem tamenho modelo
        imagecopyresampled($this->imgResize, $this->newImage, 0,0,0,0, $this->width, $this->height, $width_original, $height_original);
    }
}
