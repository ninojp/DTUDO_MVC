<?php

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

// Acessa o IF quando encontrou algum registro no banco de dados
if (!empty($this->data['footer'][0])) {
    //Ler o registro da página home retornado do banco de dados
    //A função extract é utilizado para extrair o array e imprimir através do nome da chave
    extract($this->data['footer'][0]);
?>
    <footer>
        <span><?php echo $footer_desc; ?> <a href="<?php echo $footer_link; ?>"><?php echo $footer_text_link; ?></a></span>
    </footer>
<?php
} else {
    echo "<p style='color: #f00;'>Erro: Nenhum rodapé encontrado!</p>";
}

?>

<!-- incluir o JavaScript -->
<script src="<?php echo URL; ?>app/sts/assets/js/custom.js"></script>

</body>

</html>