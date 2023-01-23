<?php
namespace App\sts\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar o conteudo da pagina Home*/
class StsViewPageHome
{
    private array|null $resultBdTop;

    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdTop(): array|null
    {
        return $this->resultBdTop;
    }

    /** ==========================================================================================
     * @return void      */
    public function viewPageHomeTop(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$viewPageHomeTop
        $viewPageHomeTop = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPageHomeTop->fullRead("SELECT id, title_one_top, title_two_top, title_three_top, link_btn_top, txt_btn_top, image_top, created, modified FROM sts_homes_tops LIMIT :limit", "limit=1");

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdTop = $viewPageHomeTop->getResult();
    }
}
