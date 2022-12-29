<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/login/login.php <h1> Pagina(view) para fazer o login</h1>";
// Manter os dados no formulário     
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} 
// var_dump($this->data['form'][0]);
?>
<!-- <h1 class="text-center mt-5">Editar Perfil</h1> -->
<?php
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-profile/index'>Perfil</a>";

// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } ?>
<!-- <span id="msg"></span> -->
<div class="container-adms">
    <div class="wrapper-adms">
        <div class="title">
            <span>Editar Perfil</span>
        </div>
        <div class="msg-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
        </div>
        <div class="msg-alert">
            <span id="msg"></span>
        </div>
        <form class="form-adms" action="" method="POST" id="form-edit-profile">
            <div class="row">
                <!-- <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="row">
                <!-- <label class="form-label" for="nickname">Apelido:</label> -->
                <i class="fa-brands fa-square-odnoklassniki"></i>
                <input class="form-control" type="text" name="nickname" id="nickname" value="<?php if(isset($valorForm['nickname'])){echo $valorForm['nickname'];} ?>" placeholder="Digite um Apelido">
            </div>
            <div class="row">
                <!-- <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="row">
                <!-- <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label> -->
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm['user'])){echo $valorForm['user'];} ?>" placeholder="Digite o usuário para acessar o administrativo" required>
            </div>
            <!-- <span style="color:#f00;">* Campos obrigatórios</span><br> -->
            <div class="button text-center mt-3">
                <button class="btn btn-primary" type="submit" name="SendEditProfile" value="Salvar">Salvar</button><br>
            </div>
            <div class="signup-link text-center mt-3">
                <?= "<a class='btn btn-sm btn-outline-info' href='".URLADM."view-profile/index'>Perfil</a>"; ?>
            </div>
        </form>
    </div>
</div>



