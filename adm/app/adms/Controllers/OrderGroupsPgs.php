<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Controllers) para Alterar a ordem do Nivel de acesso
class OrderGroupsPgs
{
    /**  @var integer|string|null - Recebe como parametro o ID   */
    private int|string|null $id;

    /** @var integer|string|array|null - Recebe o numero da pagina    */
    private int|string|array|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Nivel de acesso
     * Recebe como parametro o id que será usado na pesquisa das informações no DB e instância a Models:AdmsOrderAccessNivels(), Após editado retorna MSG e redireciona para o listar Niveis 
     * @param integer|string|null|null $id,  @return void     */
    public function index(int|string|null $id = null):void
    {
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        //verifica se existe um ID, se existir prossegue
        if((!empty($id) and (!empty($this->pag)))) {
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id = (int) $id;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewGroupsPgs = new \App\adms\Models\AdmsOrderGroupsPgs();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewGroupsPgs->orderGroupsPgs($this->id);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewGroupsPgs->getResult()){
                // se for true, redireciona para o listar niveis e apresenta a MSG
                // var_dump($viewAccessNivels->getResultBd());
                $urlRedirect = URLADM."list-groups-pgs/index/{$this->pag}";
                header("Location: $urlRedirect");
            } else {
                $urlRedirect = URLADM."list-groups-pgs/index/{$this->pag}";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Grupo de pagina não encontrada!</p>";
            $urlRedirect = URLADM."list-groups-pgs/index";
            header("Location: $urlRedirect");
        }
    }
}