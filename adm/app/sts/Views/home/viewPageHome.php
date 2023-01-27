<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<div class="wrapper">
    <div class="row">
        <h1>Pagina home</h1>
        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <h2>Bloco com os dados da viewHomeTop</h2>
        <div class="top-list">
            <span class="title-content">Detalhes do topo</span>
            <div class="top-list-right">
                <?php if (!empty($this->data['viewHomeTop'])) {
                    echo "<a href='" . URLADM . "edit-home-top/index' class='btn btn-warning ms-3'>Editar</a>";
                    echo "<a href='" . URLADM . "edit-home-top-img/index' class='btn btn-warning ms-3'>Editar Imagem</a>";
                } ?>
            </div>
        </div>
        <div class="content-adm">
            <?php if (!empty($this->data['viewHomeTop'])) {
                extract($this->data['viewHomeTop'][0]); ?>
                <div class="view-det-adm">
                    <span class="view-det-title">Foto:</span>
                    <?php
                    if ((!empty($image_top)) and (file_exists("app/sts/assets/imgs/home_top/$image_top"))) {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/home_top/$image_top' width='250' ><br><br>";
                    } else {
                        echo "<img src='" . URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png' width='250'><br><br>";
                    } ?>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">ID:</span>
                    <span class="view-det-info"><?= $id; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_one_top:</span>
                    <span class="view-det-info"><?= $title_one_top; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_two_top:</span>
                    <span class="view-det-info"><?= $title_two_top; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">title_three_top:</span>
                    <span class="view-det-info"><?= $title_three_top; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">link_btn_top:</span>
                    <span class="view-det-info"><?= $link_btn_top; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">txt_btn_top:</span>
                    <span class="view-det-info"><?= $txt_btn_top; ?></span>
                </div>
                <div class="view-det-adm">
                    <span class="view-det-title">image_top:</span>
                    <span class="view-det-info"><?= $image_top; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-det-title">Data Criação:</span>
                    <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>
                <?php if (!empty($modified)) { ?>
                    <div class="view-det-adm">
                        <span class="view-det-title">Modificado:</span>
                        <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
                    </div> <?php } ?>
        </div>
    <?php } else {
                echo "<p class='alert alert-danger'>Erro (viewHomeTop)! Conteudo do TOP não encontrado!</p>";
            }  ?>
    <h2>Bloco com os dados da viewHomeServ</h2>
    <div class="top-list">
        <span class="title-content">Detalhes do Serviço</span>
        <div class="top-list-right">
            <?php if (!empty($this->data['viewHomeServ'])) {
                echo "<a href='" . URLADM . "edit-home-serv/index' class='btn btn-warning ms-3'>Editar</a>";
            } ?>
        </div>
    </div>
    <div class="content-adm">
        <?php if (!empty($this->data['viewHomeServ'])) {
            extract($this->data['viewHomeServ'][0]); ?>
            <div class="view-det-adm">
                <span class="view-det-title">ID:</span>
                <span class="view-det-info"><?= $id; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_title:</span>
                <span class="view-det-info"><?= $serv_title; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_icon_one:</span>
                <span class="view-det-info"><?= $serv_icon_one; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_title_one:</span>
                <span class="view-det-info"><?= $serv_title_one; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_desc_one:</span>
                <span class="view-det-info"><?= $serv_desc_one; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_icon_two:</span>
                <span class="view-det-info"><?= $serv_icon_two; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_title_two:</span>
                <span class="view-det-info"><?= $serv_title_two; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_desc_two:</span>
                <span class="view-det-info"><?= $serv_desc_two; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_icon_three:</span>
                <span class="view-det-info"><?= $serv_icon_three; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_title_three:</span>
                <span class="view-det-info"><?= $serv_title_three; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">serv_desc_three:</span>
                <span class="view-det-info"><?= $serv_desc_three; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">Data Criação:</span>
                <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
            </div>
            <?php if (!empty($modified)) { ?>
                <div class="view-det-adm">
                    <span class="view-det-title">Modificado:</span>
                    <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
                </div> <?php } ?>
    </div>
<?php } else {
            echo "<p class='alert alert-danger'>Erro (viewHomeServ)! Conteudo do Serviços não encontrado!</p>";
        }  ?>
<h2>Bloco com os dados da viewHomeServPrime</h2>
<div class="top-list">
    <span class="title-content">Detalhes do Serviço Premium</span>
    <div class="top-list-right">
        <?php if (!empty($this->data['viewHomeServPrime'])) {
            echo "<a href='" . URLADM . "edit-home-serv-prime/index' class='btn btn-warning ms-3'>Editar</a>";
            echo "<a href='" . URLADM . "edit-home-prim-Img/index' class='btn btn-warning ms-3'>Editar Imagem</a>";
        } ?>
    </div>
</div>
<div class="content-adm">
    <?php if (!empty($this->data['viewHomeServPrime'])) {
        extract($this->data['viewHomeServPrime'][0]); ?>
        <div class="view-det-adm">
            <span class="view-det-title">Foto:</span>
            <?php
            if ((!empty($prem_image)) and (file_exists("app/sts/assets/imgs/home_prem/$prem_image"))) {
                echo "<img src='" . URLADM . "app/sts/assets/imgs/home_prem/$prem_image' width='250' ><br><br>";
            } else {
                echo "<img src='" . URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png' width='250'><br><br>";
            } ?>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">ID:</span>
            <span class="view-det-info"><?= $id; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">prem_title:</span>
            <span class="view-det-info"><?= $prem_title; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">prem_subtitle:</span>
            <span class="view-det-info"><?= $prem_subtitle; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">prem_desc:</span>
            <span class="view-det-info"><?= $prem_desc; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">prem_btn_text:</span>
            <span class="view-det-info"><?= $prem_btn_text; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">prem_btn_link:</span>
            <span class="view-det-info"><?= $prem_btn_link; ?></span>
        </div>
        <div class="view-det-adm">
            <span class="view-det-title">Data Criação:</span>
            <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
        </div>
        <?php if (!empty($modified)) { ?>
            <div class="view-det-adm">
                <span class="view-det-title">Modificado:</span>
                <span class="view-det-info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
</div>
<?php } else {
        echo "<p class='alert alert-danger'>Erro (viewHomeServPrime)! Conteudo do Serviços Premium não encontrado!</p>";
    }  ?>
    </div>
</div>

<!-- <?php
        var_dump($this->data['viewHomeTop']);
        var_dump($this->data['viewHomeServ']);
        var_dump($this->data['viewHomeServPrime']);
        ?> -->