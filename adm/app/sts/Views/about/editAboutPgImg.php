<?php
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
//na posição [0] e quando os dados vem do banco de dados
if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
// var_dump($this->data['form'][0]);
?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Imagem do Artigo (Sobre Empresa)</h2>
        </div>
        <div class="button_center">
            <?php if (isset($valorForm['id'])) {
            echo "<a class='btn btn-sm btn-outline-info mx-4' href='" . URLADM . "view-about-pg/index/" . $valorForm['id'] . "'> Visualizar </a> "; } ?>
        </div>
        <?php echo "<div id='msg' class='msg_alert'>";
            if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        echo "</div>"; ?>
        <!--OBRIGATóRIO o enctype="multipart/form-data", para trabalhar com imagens dentro de formulários-->
        <form class="form_adms" action="" method="POST" id="form-edit-about-pg-img" enctype="multipart/form-data">
            <!-- input oculto pra enviar o id, via post -->
            <?php $id = "";
            if(isset($valorForm['id'])){
                $id = $valorForm['id']; } ?>
            <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $id; ?>">

            <?php $name = "";
            if (isset($valorForm['name'])) {
                $name = $valorForm['name']; } ?>
            <div class="row_edit">
                <label class="" for="new_image">Imagem:</label>
                <i class="fa-solid fa-image"></i>
                <input class="form-control" type="file" name="new_image" id="new_image" onchange="inputFileValImgSts()">
            </div>
            <div class="view-det-adm">
                <span class="view-det-title">Foto:</span>
                <?php
                if ((!empty($valorForm['image'])) and (file_exists("app/sts/assets/imgs/about/".$valorForm['id']."/".$valorForm['image']))) {
                    $old_img = URLADM."app/sts/assets/imgs/about/".$valorForm['id']."/".$valorForm['image'];
                } else {
                    $old_img = URLADM . "app/sts/assets/imgs/Logo_Dtudo_2022-300p.png";
                } ?>
                <span id="preview-img">
                    <img src="<?=$old_img;?>" alt="Imagem" style="width: 300px;height: 300px;">
                </span>
            </div>

            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditAboutPgImg" value="Salvar">Salvar Mudança</button>
            </div>
        </form>
        <?php var_dump($valorForm); ?>
    </div>
</div>