<?php
namespace App\sts\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar o conteudo da pagina Home*/
class StsViewPageHome
{
    /** @var array|null - Recebe os resultados da busca na tabela:sts_homes_tops    */
    private array|null $resultBdTop;

    /** @var array|null - Recebe os resultados da busca na tabela:sts_homes_services    */
    private array|null $resultBdServ;

    /** @var array|null - Recebe os resultados da busca na tabela:sts_homes_premiums    */
    private array|null $resultBdServPrime;

    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdTop(): array|null
    {
        return $this->resultBdTop;
    }

    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdServ(): array|null
    {
        return $this->resultBdServ;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdServPrime(): array|null
    {
        return $this->resultBdServPrime;
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
    /** ==========================================================================================
     * @return void      */
    public function viewPageHomeServ(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$viewPageHomeTop
        $viewPageHomeServ = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPageHomeServ->fullRead("SELECT id, serv_title, serv_icon_one, serv_title_one, serv_desc_one, serv_icon_two, serv_title_two, serv_desc_two, serv_icon_three, serv_title_three, serv_desc_three, created, modified FROM sts_homes_services LIMIT :limit", "limit=1");

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdServ = $viewPageHomeServ->getResult();
    }
    /** ==========================================================================================
     * @return void      */
    public function viewPageHomeServPrime(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$viewPageHomeTop
        $viewPageHomeServPrime = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPageHomeServPrime->fullRead("SELECT id, prem_title, prem_subtitle, prem_desc, prem_btn_text, prem_btn_link, prem_image, created, modified FROM sts_homes_premiums LIMIT :limit", "limit=1");

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdServPrime = $viewPageHomeServPrime->getResult();
    }
}
