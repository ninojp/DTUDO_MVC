<?php

namespace Sts\Models;

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

/**
 * Models responsável em buscar os dados da página sobre empresa
 *
 * @author Celke
 */
class StsSobreEmpresa
{
    /** @var array|null $data Recebe os registros do banco de dados */
    private array|null $data;

    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array Retorna o registro do banco de dados com informações para página sobre empresa
     */
    public function index(): array|null
    {    
        $viewSobreEmpresa = new \Sts\Models\helper\StsRead();
        $viewSobreEmpresa->fullRead("SELECT id, title, description, image 
                            FROM sts_abouts_companies 
                            WHERE sts_situation_id=:sts_situation_id
                            ORDER BY id DESC  
                            LIMIT :limit", "sts_situation_id=1&limit=10");
        $this->data = $viewSobreEmpresa->getResult();
        //var_dump($this->data);

        return $this->data;
    }
}
