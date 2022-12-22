<?php
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// echo "Views/sitsUsers/addSitsUsers.php <h1> Pagina(view) Adicionar Situação</h1>";

//verifica, se contém dados no array:$this->data['form']
if(isset($this->data['form'])){
    //se contiver, atribui para variável:$valorForm
    $valorForm = $this->data['form'];
} 
//na posição [0] e quando os dados vem do banco de dados
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
} ?>
<h1 class="text-center mt-2">Editar Cor</h1>
<?php
echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."list-colors/index'> Listar </a> ";
if (isset($valorForm['id'])){
    echo "<a class='btn btn-sm btn-outline-primary ms-4' href='".URLADM."view-colors/index/".$valorForm['id']."'> Visualizar </a><br><hr>";
}
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} 
// var_dump($this->data['selectCor']['cor']);
// var_dump($this->data['form']);
// var_dump($valorForm['name']);
?>
<span id="msg"></span>
<form action="" method="POST" id="form-add-colors">
    <div class="row m-2">
        <div class="col-12 m-2">
            <!-- input oculto pra enviar o id, via post -->
            <input class="form-control" type="hidden" name="id" id="id" value="<?php if(isset($valorForm['id'])){echo $valorForm['id'];} ?>" required>

            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="name">Editar Nome Cor:<span style="color:#f00;">*</span></label>
                <input class="form-control" type="text" name="name" id="name" value="<?php if(isset($valorForm['name'])){echo $valorForm['name'];}?>" required>
            </div>
            
            <div class="col-md-4 offset-md-4 mb-3">
                <?php $color="";
                if(isset($valorForm['color'])){
                    $color = $valorForm['color'];} ?>
                    <label class="form-label" for="color">Código da Cor (Hexadecimal):<span style="color:#f00;">*</span></label>
                    <input class="form-control" type="color" name="color" id="color" value="<?php echo $color; ?>" placeholder="Código da Cor">
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendEditColors" value="Editar">Editar</button>
            </div>
        </div>
    </div>
</form>