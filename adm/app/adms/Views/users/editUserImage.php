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
// var_dump($valorForm);
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
<form action="" method="POST" id="form-edit-user-img" enctype="multipart/form-data">
    <div class="row m-2">
        <div class="col-12 m-2">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>">

            <div class="col-md-6 offset-md-2 mb-3">
                <label class="form-label" for="image">Imagem:(300x300px)<span style="color:#f00;">*</span></label>
                <input class="form-control" type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required>
                <span style="color:#f00;">* Campo obrigatório</span><br>
                <?php
                    if ((!empty($valorForm['image'])) and (file_exists("app/adms/assets/imgs/users/" . $valorForm['id'] . "/" . $valorForm['image']))) {
                        $old_img = URLADM . "app/adms/assets/imgs/users/" . $valorForm['id'] . "/" . $valorForm['image'];
                    } else {
                        $old_img = URLADM . "app/adms/assets/imgs/users/Logo_Dtudo_2022-300p.png";
                    }
                ?>
                <span id="preview-img">
                    <img src="<?=$old_img;?>" alt="Imagem" style="width: 200px;height: 100px;">
                </span>
            </div>
            <div class="col-md-4 offset-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="SendEditUserImage" value="Salvar">Salvar</button>
                
            </div>
        </div>
    </div>
</form>



