<?php
namespace App\sts\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar o conteudo da pagina Home*/
class StsViewFooter
{
    /** @var array|null - Recebe os resultados da busca na tabela:sts_homes_tops    */
    private array|null $resultBdFooter;

    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdFooter(): array|null
    {
        return $this->resultBdFooter;
    }
   /** ==========================================================================================
     * @return void      */
    public function viewFooter(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$viewFooter
        $viewFooter = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewFooter->fullRead("SELECT id, footer_desc, footer_text_link, footer_link, created, modified FROM sts_footers LIMIT :limit", "limit=1");

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdFooter = $viewFooter->getResult();
    }
    }
