<?php

namespace Sts\Controllers;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Controller da página SobreEmpresa
 *
 * @author Cesar <cesar@celke.com.br>
 */
class SobreEmpresa
{

    /** @var array|string|null $dados Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instantiar a classe responsável em carregar a View
     * 
     * @return void
     */
    public function index()
    {

        $aboutCompany = new \Sts\Models\StsSobreEmpresa();
        $this->data['about-company'] = $aboutCompany->index();

        $footer = new \Sts\Models\StsFooter();
        $this->data['footer'] = $footer->index();
        
        $loadView= new \Core\ConfigView("sts/Views/sobreEmpresa/sobreEmpresa", $this->data);
        $loadView->loadView();
    }
}
