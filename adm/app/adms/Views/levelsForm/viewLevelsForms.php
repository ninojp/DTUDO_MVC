<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); } ?>
<!-- Inicio do conteudo do Visualizar ADM  -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Detalhes da Cor</h2>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
        if (isset($_SESSION['msg'])) { 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); }
        echo "</div>";
        if (!empty($this->data['viewLevelsForm'])) {
            extract($this->data['viewLevelsForm'][0]); 
            // var_dump($this->data['viewLevelsForm'][0]);
            ?>
        <div class="content_adm">
            <div class="view_det">
                <span class="view_det_title">ID:</span>
                <span class="view_det_info"><?=$id;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Nivel de Acesso:</span>
                <span class="view_det_info"><?=$name_aal;?></span>
            </div>
            <div class="view_det">
                <span class="view_det_title">Situação do cadastro:</span>
                <span class="view_det_info"><?=$name_asu;?></span>
            </div>
            
            <div class="view_det">
                <span class="view_det_title">Data Criação:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($created));?></span>
            </div>
            <?php if(!empty($modified)) { ?>
            <div class="view_det">
                <span class="view_det_title">Modificado:</span>
                <span class="view_det_info"><?=date('d/m/Y H:i:s', strtotime($modified)); ?></span>
            </div> <?php } ?>
        </div>
        <div class="col-12 text-center p-4">
            <a class="btn btn-sm btn-outline-warning mx-1" href="<?=URLADM;?>edit-levels-forms/index/<?=$id;?>"><i class='fa-solid fa-pen-to-square'></i> Editar</a>
        </div>
        <?php } ?>
    </div>
</div>
<!-- FIM do conteudo do ADM -->