<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Controllers) para Alterar a ordem do Nivel de acesso
class OrderAccessNivels
{
    private array|null $data;
    private int|string|null $id;

    /** =============================================================================================
     * Alterar a ordem do Nivel de acesso
     * @param integer|string|null|null $id
     * @return void     */
    public function index(int|string|null $id = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id)) {
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id = (int) $id;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewAccessNivels = new \App\adms\Models\AdmsOrderAccessNivels();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewAccessNivels->orderAccessNivels($this->id);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewAccessNivels->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                // $this->data['viewColors'] = $viewAccessNivels->getResultBd();
                // var_dump($viewAccessNivels->getResultBd());

            } else {
                $urlRedirect = URLADM."list-access-nivels/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de acesso não encontrada!</p>";
            $urlRedirect = URLADM."list-access-nivels/index";
            header("Location: $urlRedirect");
        }
    }
}