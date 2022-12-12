<?php
namespace App\adms\Models\helper;

/** Classe genérica para converter o SLUG (otimizar ou modificar o nome) */
class AdmsSlug
{
    /** @var string - Recebe o texto que deve ser convertido para SLUG    */
    private string $text;
    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;

    /** =========================================================================================
     * @return string|null     */
    function slug(string $text):string|null
    {
        $this->text = $text;
        // var_dump($this->text);
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:,\\\'<>°ºª';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-----------------------------------------------------------------------------------------------';
        $this->text = strtr(utf8_decode($this->text), utf8_decode($this->format['a']), $this->format['b']);
        $this->text = str_replace(" ", "-", $this->text);
        $this->text = str_replace(array("-----", "----", "---", "--"), "-", $this->text);
        $this->text = strtolower($this->text);
        // var_dump($this->text);
        return $this->text;
    }

}
