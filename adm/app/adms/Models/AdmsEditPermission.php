<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Models):AdmsEditColors, para editar uma Cor no banco de dados */
class AdmsEditPermission
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    private array|null $data;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * O Método recebe como parametro o ID que será usado para verificar se tem o registro no DB  */
    public function editPermission(int $id):void
    {
        $this->id = $id;
        // var_dump($this->id);

        $viewPermission = new \App\adms\Models\helper\AdmsRead();
        $viewPermission->fullRead("SELECT lev_pag.id, lev_pag.permission 
        FROM adms_levels_pages AS lev_pag 
        INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
        LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
        WHERE lev_pag.id=:id AND lev.order_levels >:order_levels
        AND (((SELECT permission FROM adms_levels_pages WHERE adms_page_id =lev_pag.adms_page_id 
        AND adms_access_level_id ={$_SESSION['access_level_id']}) = 1) OR (publish = 1))
        LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBd = $viewPermission->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            // $this->result = true;
            $this->edit();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (editPermission())! Necessário selecionar uma página válida!</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     * @return void     */
    private function edit():void
    {
        // var_dump($this->resultBd);
        if($this->resultBd[0]['permission'] == 1){
            $this->data['permission'] = 2;
        } else {
            $this->data['permission'] = 1;
        }
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upPermission = new \App\adms\Models\helper\AdmsUpdate();
        $upPermission->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->id}");
        if($upPermission->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Permissão Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível Editar a Permissão</p>";
            $this->result = false;
        }
    }

}
