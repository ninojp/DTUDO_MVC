<?php
namespace App\adms\Models\helper;

/** Classe genérica para fazer UPLOAD */
class AdmsUpload
{
    private string $directory;
    private string $tmpName;
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
     * @param string $directory
     * @param string $tmpName
     * @param string $name
     * @return void     */
    public function upload(string $directory, string $tmpName, string $name):void
    {
        $this->directory = $directory;
        $this->tmpName = $tmpName;
        $this->name = $name;

        // se a validação do diretório:valDirectory() retornar true, prossegue.  
        if ($this->valDirectory()){
            //e instância o método para fazer o upload do arquivo
            $this->uploadFile();
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return boolean     */
    private function valDirectory():bool
    {
        // Se Não existir um arquivo ou diretório com este nome:$this->directory
        if((!file_exists($this->directory)) and (!is_dir($this->directory))){
            //Função:mkdir para criar o diretório, com as seguintes PERMISSÕES 0755(o default é 0777)
            mkdir($this->directory, 0755);
            //verifica se conseguiu criar o diretório, se não conseguiu retorna false e apresenta uma menssagem
            if((!file_exists($this->directory)) and (!is_dir($this->directory))){
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Upload não realizado com sucesso! Tente novamente</p>";
                return false;
            } else {
                return true;
            }
        } else {
            return true;
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
