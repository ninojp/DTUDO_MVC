<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para fazer a validação de mimeType(tipo de arquivo, extensão) */
class AdmsValExtImg
{
    /** @var string - Recebe o mimeType da imagem   */
    private string $mimeType;
    private bool $result;
    /** ==============================================================================================
     * @return boolean   */
    function getResult(): bool
    {
        return $this->result;
    }
    /** ==============================================================================================
     * Validar a extensão da imagem. Recebe a extensão da imagem que deve ser validada.
     * Retorna TRUE quando a extenção da imagem for válida e FALSE quando não.
     * @param string Recebe o $mimeType da imagem  -  @return void - True - False    */
    function validateExtImg(string $mimeType): void
    {
        $this->mimeType = $mimeType;
        // var_dump($this->mimeType);
        // Pode-se utilizar - switch (): e o endswitch; para finalizar. ou {} como no exemplo abaixo
        switch ($this->mimeType) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->result = true;
                break;
            case 'image/png':
            case 'image/x-png':
                $this->result = true;
                break;
            default:
        $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma imagem JPEG ou PNG!</p>";
        $this->result = false;
        }
    }
}
