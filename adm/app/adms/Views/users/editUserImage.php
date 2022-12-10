<?php
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
<h1 class="text-center mt-5">Editar Imagem do Usuário</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-users/index'> Listar </a> ";
if(isset($valorForm['id'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-users/index/".$valorForm['id']."'> Visualizar </a><br><hr>";
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<span id="msg"></span>
<!--OBRIGATóRIO o enctype="multipart/form-data", para trabalhar com imagens dentro de formulários-->
<form action="" method="POST" id="form-edit-user" enctype="multipart/form-data">
    <div class="row m-5">
        <div class="col-12 m-5">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="col-md-6 offset-md-2 mb-3">
                <label class="form-label" for="image">Imagem:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="file" name="new_image" id="new_image">
                <span style="color:#f00;">* Campo obrigatório</span><br>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="SendEditUserImage" value="Salvar">Salvar</button>
                
            </div>
        </div>
    </div>
</form>



