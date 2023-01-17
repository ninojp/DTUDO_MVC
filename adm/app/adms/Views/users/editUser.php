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
} // var_dump($this->data['form'][0]); ?>
<!-- <h1 class="text-center mt-5">Editar Usuário</h1> -->
<?php
// echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar </a> ";
// if(isset($valorForm['id'])){
//     echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a>";
//     echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-users/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
// }
// if(isset($_SESSION['msg'])){
//     echo $_SESSION['msg'];
//     unset($_SESSION['msg']);
// } ?>
<!-- <span id="msg"></span> -->
<div class="wrapper_form">
    <div class="row_form">
        <div class="title_form">
            <h2>Editar Usuário</h2>
        </div>
        <?php if (isset($_SESSION['msg'])) { 
            echo "<div id='msg' class='msg_alert'>";
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            echo "</div>"; } ?>
        <div id='msg' class='msg_alert'></div>
        <form class="form_adms" action="" method="POST" id="form-edit-user">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="row_edit">
                <label class="" for="name">Nome:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="row_edit">
                <label class="" for="nickname">Apelido:</label>
                <i class="fa-solid fa-file-signature"></i>
                <input class="form-control" type="text" name="nickname" id="nickname" value="<?php if(isset($valorForm['nickname'])){echo $valorForm['nickname'];} ?>" placeholder="Digite um Apelido(nickname)">
            </div>
            <div class="row_edit">
                <label class="" for="email">Email:</label>
                <i class="fa-solid fa-envelope"></i>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Edite o E-mail" required>
            </div>
            <div class="row_edit">
                <label class="" for="user">Usuário:</label>
                <i class="fa-solid fa-user"></i>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm['user'])){echo $valorForm['user'];} ?>" placeholder="Edite o usuário(login)" required>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="adms_sits_user_id"> Situação: </label>
                    <select name="adms_sits_user_id" id="adms_sits_user_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['sit'] as $sit){
                            extract($sit);
                            //verifica se existe, E SE É IGUAL ao valor do id
                            if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                                echo "<option value='$id_sit' selected>$name_sit</option>";
                            } else {
                                echo "<option value='$id_sit'>$name_sit</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="row_input">
                <i class="fa-solid fa-hand-pointer"></i>
                <div class="select_input">
                    <label class="mx-3" for="access_level_id">Nivel de Acesso:</label>
                    <select name="access_level_id" id="access_level_id">
                        <option value="">Selecione</option>
                        <?php foreach($this->data['select']['lev'] as $lev){
                            extract($lev);
                            if((isset($valorForm['access_level_id'])) and ($valorForm['access_level_id'] == $id_lev)){
                                echo "<option value='$id_lev' selected>$name_lev</option>";
                            } else {
                                echo "<option value='$id_lev'>$name_lev</option>";
                            } } ?>
                    </select>
                </div>
            </div>
            <div class="button_center">
                <button class="btn btn-primary" type="submit" name="SendEditUser" value="Salvar">Salvar</button><br>
            </div>
            <div class="button_center">
                 <a class="btn btn-sm btn-outline-success mx-2" href="<?=URLADM;?>list-users/index"> Listar  Usuários </a>
                 <?php if(isset($valorForm['id'])){
                    echo "<a class='btn btn-sm btn-outline-warning mx-2' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a>";
                    echo "<a class='btn btn-sm btn-outline-danger mx-2' href='".URLADM."delete-users/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar</a>"; } ?>
            </div>
        </form>
    </div>
</div>



