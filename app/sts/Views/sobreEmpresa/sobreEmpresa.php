<?php

if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }

?>
<section class="about">
    <div class="max-width">
        <h2 class="title">Sobre Empresa</h2>
        <?php
        // Acessa o IF quando encontrou algum registro no banco de dados
        if (!empty($this->data['about-company'])) {
            foreach ($this->data['about-company'] as $about_company) {
                extract($about_company);
        ?>
                <div class="about-content">
                    <div class="column left">
                        <img src="<?php echo URL . 'app/sts/assets/images/about/' . $id . "/" . $image; ?>" alt="Sobre Empresa">
                    </div>
                    <div class="column right">
                        <div class="text"><?php echo $title; ?></div>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p style='color: #f00;'>Erro: Nenhum registro encontrado</p>";
        }
        ?>
    </div>
</section>
