<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
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
<!-- <h1 class="text-center mt-5">Editar Imagem</h1> -->
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='" . URLADM . "view-profile/index'>Perfil</a>";
// if (isset($_SESSION['msg'])) {
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Imagem do Perfil</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) {
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>";
        } ?>
        <!--OBRIGATóRIO o enctype="multipart/form-data", para trabalhar com imagens dentro de formulários-->
        <form class="form_adms" action="" method="POST" id="form-edit-prof-img" enctype="multipart/form-data">
            <div class="text-center">
            <?php if ((!empty($valorForm['image'])) and (file_exists("app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/" . $valorForm['image']))) {
                    $old_img = URLADM . "app/adms/assets/imgs/users/" . $_SESSION['user_id'] . "/" . $valorForm['image'];
                } else {
                    $old_img = URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png";
                }
                ?>
                <span id="preview-img">
                    <img src="<?=$old_img;?>" alt="Imagem" style="width: 300px;height: 300px;">
                </span>
            </div>
            <div class="row_edit">
                <label class="" for="image">Selecione a Imagem: (300x300px)</label>
                <i class="fa-solid fa-image"></i>
                <input class="form-control" type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditProfImage" value="Salvar">Salvar Mudança</button>
            </div>
            <div class="button_center">
                <a class="btn btn-sm btn-outline-primary" href="<?= URLADM; ?>view-profile/index">Perfil</a>
            </div>
        </form>
    </div>
</div>