<?php

namespace Sts\Controllers;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Controller da página Contato
 * http://localhost/celke/app/sts/Controllers/Contato.php
 * @author Cesar <cesar@celke.com.br>
 */
class Contato
{

    /** @var array|string|null $dados Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = null;

    /** @var array|null $dataForm Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $dataForm;

    /**
     * Instantiar a classe responsável em carregar a View
     * 
     * @return void
     */
    public function index(): void
    {



        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['AddContMsg'])) {
            unset($this->dataForm['AddContMsg']);
            $createContactMsg = new \Sts\Models\StsContato();
            if ($createContactMsg->create($this->dataForm)) {
                //echo "Cadastrado!<br>";
            } else {
                //echo "Não cadastrado!<br>";
                $this->data['form'] = $this->dataForm;
            }
        }

        $contentContact = new \Sts\Models\StsContentContact();
        $this->data['content'] = $contentContact->index();

        $footer = new \Sts\Models\StsFooter();
        $this->data['footer'] = $footer->index();

        $loadView = new \Core\ConfigView("sts/Views/contato/contato", $this->data);
        $loadView->loadView();
    }
}
