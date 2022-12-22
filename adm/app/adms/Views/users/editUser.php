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
<h1 class="text-center mt-5">Editar Usuário</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar </a> ";
if(isset($valorForm['id'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-danger ms-4' href='".URLADM."delete-users/index/".$valorForm['id']."' onclick='return confirm(\"Tem certeza que deseja excluir o registro?\")'> Apagar </a><br><hr>";
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-edit-user">
    <div class="row m-2">
        <div class="col-12 m-2">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="nickname">Apelido:</label>
                <input class="form-control" type="text" name="nickname" id="nickname" value="<?php if(isset($valorForm['nickname'])){echo $valorForm['nickname'];} ?>" placeholder="Digite um Apelido(nickname)">
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="user">Usuário:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="user" id="user" value="<?php if(isset($valorForm['user'])){echo $valorForm['user'];} ?>" placeholder="Digite o usuário para acessar o administrativo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="adms_sits_user_id">Situação:<span style="color:#f00;">*</span></label>
                <select name="adms_sits_user_id" id="adms_sits_user_id">
                    <option value="">Selecione</option>
                    <?php foreach($this->data['select']['sit'] as $sit){
                        extract($sit);
                        if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                            echo "<option value='$id_sit' selected>$name_sit</option>";
                        } else {
                            echo "<option value='$id_sit'>$name_sit</option>";
                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-4 offset-4 mb-3 text-center">
                <button class="btn btn-primary" type="submit" name="SendEditUser" value="Salvar">Salvar</button><br>
                <span style="color:#f00;">* Campo obrigatório</span>
            </div>
        </div>
    </div>
</form>



