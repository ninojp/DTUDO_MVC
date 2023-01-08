<?php

namespace App\adms\Models\helper;

if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}

/** Classe genérica para paginar os registros do DB */
class AdmsPagination
{
    private int $page;
    private int $limitResult;
    private int $offset;
    private string $query;
    private string|null $parseString;
    private array $resultBd;
    private string|null $result;
    private int $totalPages;
    private int $maxLinks = 2;
    private string $link;
    private string|null $var;

    /** =============================================================================================
     * @return void     */
    public function getOffset(): int
    {
        return $this->offset;
    }
    /** =============================================================================================
     * @return void     */
    public function getResult(): string|null
    {
        return $this->result;
    }
    /** =============================================================================================
     * @param string $link  -  @param string|null|null $var     */
    function __construct(string $link, string|null $var = null)
    {
        $this->link = $link;
        $this->var = $var;
        // var_dump($this->link);
        // var_dump($this->var);
    }
    /** ==============================================================================================
     * @param integer $page
     * @param integer $limitResult
     * @return void     */
    public function condition(int $page, int $limitResult): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->limitResult = (int) $limitResult;
        // var_dump($this->page);
        // var_dump($this->limitResult);

        //(pg atual)x(limitResult pg)=(resultado pg)-(limitResult pg)=(...)
        $this->offset = (int) ($this->page * $this->limitResult) - $this->limitResult;
        // var_dump($this->offset);
    }
    /** ==============================================================================================
     * @param string $query
     * @param string|null|null $parseString
     * @return void     */
    public function pagination(string $query, string|null $parseString = null): void
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        // var_dump($this->query);
        // var_dump($this->parseString);
        $count = new \App\adms\Models\helper\AdmsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->resultBd = $count->getResult();
        $this->pageInstruction();
    }
    /** ==============================================================================================
     * @return void      */
    private function pageInstruction(): void
    {
        // (if)para resolver o erro de paginação quando não existe dados na tabela
        if(!$this->resultBd[0]['num_result'] == 0 ){
            // var_dump($this->resultBd[0]['num_result']);
            $this->totalPages = (int) ceil($this->resultBd[0]['num_result'] / $this->limitResult);
            // var_dump($this->totalPages);
            if ($this->totalPages >= $this->page) {
                $this->layoutPagination();
            } else {
                header("Location: {$this->link}");
            }
        } else {
            $this->result = 0;
        }
    }
    /** =========================================================================================
     * @return void     */
    private function layoutPagination(): void
    {
        $this->result = "<div class='content_pagination'>";
        $this->result .= "<div class='pagination'>";
        $this->result .= "<a href='{$this->link}{$this->var}'>Primeira</a>";

        for ($beforePage = $this->page - $this->maxLinks; $beforePage <= $this->page - 1; $beforePage++) {
            if ($beforePage >= 1) {
                $this->result .= "<a href='{$this->link}/$beforePage{$this->var}'>$beforePage</a>";
            }
        }
        $this->result .= "<a href='#' class='active'> {$this->page}</a>";

        for ($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage++) {
            if ($afterPage <= $this->totalPages) {
                $this->result .= "<a href='{$this->link}/$afterPage{$this->var}'>$afterPage</a>";
            }
        }
        $this->result .= "<a href='{$this->link}/{$this->totalPages}{$this->var}'>Ultima</a>";
        $this->result .= "</div>";
        $this->result .= "</div>";
    }
}
