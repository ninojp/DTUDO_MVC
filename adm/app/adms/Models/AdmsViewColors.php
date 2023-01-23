<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar os detalhes do registro Cor*/
class AdmsViewColors
{
    private bool $result = false;
    private array|null $resultBd;
    private int|string|null $id;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * @param integer $id -  @return void      */
    public function viewColors(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewColors = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewColors->fullRead("SELECT id, name, color, created, modified FROM adms_colors WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        //ESTE VAR_DUMP MOSTRA TUDO INCLUSIVE OS DADOS DE CONEXAO COM O DB (SENHA)
        // var_dump($viewSitUser); ME PARECE UMA FALHA DE SEGURANÇA

        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd
        $this->resultBd = $viewColors->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Cor não encontrada!</p>";
            $this->result = false;
        }
    }
}
