<?php

namespace Sts\Models;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Models responsável em cadastrar no BD
 *
 * @author Celke
 */
class StsContato
{

    /** @var array $data Recebe os dados que devem ser inseridos no BD */
    private array $data;

    /**
     * Cadastrar nova mensagem no banco de dados
     * 
     * @param array $data Recebe os dados que devem ser inseridos no BD
     * @return bool Retorna true quando o cadatro é realizado com sucesso e false quando houver erro
     */
    public function create(array $data): bool
    {
        $this->data = $data;
        $this->data['created'] = date("Y-m-d H:i:s");
        //var_dump($this->data);

        $createContactMsg = new \Sts\Models\helper\StsCreate();
        $createContactMsg->exeCreate("sts_contacts_msgs", $this->data);

        if ($createContactMsg->getResult()) {
            // Recuperar o último id inserido
            //var_dump($createContactMsg->getResult());
            $_SESSION['msg'] = "<p class='alert-success'>Mensagem enviada com sucesso!</p>";
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem não enviada com sucesso!</p>";
            return false;
        }
    }
}
