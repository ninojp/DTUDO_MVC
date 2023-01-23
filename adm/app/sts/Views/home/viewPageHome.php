<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
} ?>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<div class="top-list">
    <span class="title-content">Detalhes do topo</span>
    <div class="top-list-right">
    <?php if (!empty($this->data['viewHomeTop'])) {
        echo "<a href='".URLADM."edit-home-top/index' class='btn-warning'>Editar</a>";
        echo "<a href='".URLADM."edit-home-top-img/index' class='btn-warning'>Editar Imagem</a>";
    } ?>
    </div>
</div>
<div class="content-adm">
    <?php if (!empty($this->data['viewHomeTop'])) {
        extract($this->data['viewHomeTop'][0]); ?>

        <div class="view_det">
        <span class="view_det_title">Foto:</span>
        <?php 
            if ((!empty($image_top)) and (file_exists("app/sts/assets/imgs/home_top/$image_top"))) {
                echo "<img src='" . URLADM . "app/sts/assets/imgs/home_top/$image_top' width='250' ><br><br>";
            } else {
                echo "<img src='" . URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png' width='250'><br><br>";
            } ?>
        </div>

        <div class="view_det">
            <span class="view_det_title">ID:</span>
            <span class="view_det_info"><?= $id; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">title_one_top:</span>
            <span class="view_det_info"><?= $title_one_top; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">title_two_top:</span>
            <span class="view_det_info"><?= $title_two_top; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">title_three_top:</span>
            <span class="view_det_info"><?= $title_three_top; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">link_btn_top:</span>
            <span class="view_det_info"><?= $link_btn_top; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">txt_btn_top:</span>
            <span class="view_det_info"><?= $txt_btn_top; ?></span>
        </div>
        <div class="view_det">
            <span class="view_det_title">image_top:</span>
            <span class="view_det_info"><?= $image_top; ?></span>
        </div>

        <div class="view_det">
            <span class="view_det_title">Data Criação:</span>
            <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($created)); ?></span>
        </div>
        <?php if (!empty($modified)) { ?>
            <div class="view_det">
                <span class="view_det_title">Modificado:</span>
                <span class="view_det_info"><?= date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
</div>
<?php } ?>

<?php var_dump($this->data['viewHomeTop']);  ?>
