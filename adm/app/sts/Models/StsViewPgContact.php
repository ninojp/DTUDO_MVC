<?php
namespace App\sts\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar o conteudo da pagina Home*/
class StsViewPgContact
{
    /** @var array|null - Recebe os resultados da busca na tabela:sts_homes_tops    */
    private array|null $resultBdContact;

    /** ==========================================================================================
     * @return array|null         */
    public function getResultBdContact(): array|null
    {
        return $this->resultBdContact;
    }
   /** ==========================================================================================
     * @return void      */
    public function viewPgContact(): void
    {
        //instância a classe:AdmsRead() e cria o objeto:$viewPgContact
        $viewPgContact = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPgContact->fullRead("SELECT id, title_contact, desc_contact, icon_company, title_company, desc_company, icon_address, title_address, desc_address, icon_email, title_email, desc_email, title_form, created, modified FROM sts_contents_contacts LIMIT :limit", "limit=1");

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBdContact = $viewPgContact->getResult();
    }
    }
