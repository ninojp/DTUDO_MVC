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
// var_dump($valorForm);
?>
<h1 class="text-center mt-5">Editar as Configurações do E-mail</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-email-confs/index'> Listar </a> ";
if(isset($valorForm['id'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-email-confs/index/".$valorForm['id']."'> Visualizar </a>";
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."edit-email-confs-pass/index/".$valorForm['id']."'> Editar senha </a><br><hr>";
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<form action="" method="POST" id="form-edit-email-confs">
    <div class="row m-2">
        <div class="col-12 m-2">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="email">Email:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email'];} ?>" placeholder="Digite o Email" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="title">Titulo:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="title" id="title" value="<?php if(isset($valorForm['title'])){echo $valorForm['title'];} ?>" placeholder="Digite o Titulo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Nome:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];} ?>" placeholder="Digite o nome Completo" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="host">Host:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="host" id="host" value="<?php if(isset($valorForm['host'])){echo $valorForm['host'];} ?>" placeholder="Digite o host" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="username">username:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="username" name="username" id="username" value="<?php if(isset($valorForm['username'])){echo $valorForm['username'];} ?>" placeholder="Digite o username" required>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="smtpsecure">smtpsecure:</label>
                <input class="form-control" type="text" name="smtpsecure" id="smtpsecure" value="<?php if(isset($valorForm['smtpsecure'])){echo $valorForm['smtpsecure'];} ?>" placeholder="Digite o usuário para acessar o administrativo">
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="port">port:</label>
                <input class="form-control" type="text" name="port" id="port" value="<?php if(isset($valorForm['port'])){echo $valorForm['port'];} ?>" placeholder="Digite a porta">
            </div>
            <div class="col-md-4 offset-4 mb-3 text-center">
                <button class="btn btn-primary" type="submit" name="SendEditEmailConfs" value="Salvar">Salvar</button><br>
                <span style="color:#f00;">* Campo obrigatório</span>
            </div>
        </div>
    </div>
</form>



