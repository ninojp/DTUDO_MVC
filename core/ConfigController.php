<?php

namespace Core;

class ConfigController
{
    private string $url;

    //=============================================================================================
    public function __construct()
    {
        echo "carregar a pagina<br>";
        if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            var_dump($this->url);
            
            
            //apenas testes
            // $situacao = filter_input(INPUT_GET, 'situacao', FILTER_DEFAULT);
            // var_dump($situacao);
            // $origem = filter_input(INPUT_GET, 'origem', FILTER_DEFAULT);
            // var_dump($origem);
        }else{
            echo "Acessa a página inicial<br>";
        }
        
    }

}
