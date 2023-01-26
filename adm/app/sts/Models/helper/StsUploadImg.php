<?php
namespace App\sts\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para fazer UPLOAD */
class StsUploadImg
{
    private string $directory;

    private string $tmpName;

    /** @var array  - Recebe as informações da imagem     */
    private array $imageData;

    private string $name;

    /** @var boolean - Recebe true quando executar com sucesso e False caso contrário    */
    private bool $result;

    /** ============================================================================================
     * Retorna true quando executar o processo com sucesso e false caso contrário
     * @return boolean    */
    function getResult():bool
    {
        return $this->result;
    }
    /** ===========================================================================================
     * Método para receber da controller, todos os dados via parametros 
     * @param string $directory
     * @param string $tmpName
     * @param string $name
     * @return void     */
    public function upload(string $directory, array $imageData, string $name):void
    {
        $this->directory = $directory;
        $this->tmpName = $imageData['tmp_name'];
        $this->imageData = $imageData;
        $this->name = $name;
        $this->valFile();
    }
    /** =============================================================================================
     * Método para verificar o tipo da imagem JPEG ou PNG
     * Chama o método:valDirectory() caso a imagem seja JPEG
     * Chama o método:valDirectory() caso a imagem seja PNG
     * Retorna falso se houver erro
     * @return void     */
    private function valFile():void
    {
        switch ($this->imageData['type']) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->valDirectory();
                break;
            case 'image/png':
            case 'image/x-png':
                $this->valDirectory();
                break;
            default:
        $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma imagem JPEG ou PNG!</p>";
        $this->result = false;
        }
        // $_SESSION['msg'] = "<p class='alert alert-info'>Acessou o helper redimencionar imagem</p>";
        // $this->result = false;
    }
    /** ============================================================================================
     * @return void     */
    private function valDirectory():void
    {
        // Se Não existir um arquivo ou diretório com este nome:$this->directory
        if((!file_exists($this->directory)) and (!is_dir($this->directory))){
            //Função:mkdir para criar o diretório, com as seguintes PERMISSÕES 0755(o default é 0777)
            mkdir($this->directory, 0755);
            //verifica se conseguiu criar o diretório, se não conseguiu retorna false e apresenta uma menssagem
            if((!file_exists($this->directory)) and (!is_dir($this->directory))){
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload não realizado com sucesso! Tente novamente</p>";
                $this->result = false;
            } else {
                $this->uploadFile();
            }
        } else {
            $this->uploadFile();
        }
    }
    /** =============================================================================================
     * @return void     */
    private function uploadFile()
    {
        if(move_uploaded_file($this->tmpName, $this->directory . $this->name)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload não realizado com sucesso! Tente novamente</p>";
            $this->result = false;
        }
    }

}
