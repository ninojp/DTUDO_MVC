<?php
    if(isset($this->data['form'])){
        // var_dump($this->data['form']);
        $valorForm = $this->data['form'];
    }
?>
<h1 class="text-center mt-5">Nova senha</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>
<form action="" method="POST" id="form-update-pass">
    <div class="row m-5">
        <div class="col-5 m-5">
            <div class="mb-3">
                <label class="form-label" for="password">Senha Nova:</label>
                <input class="form-control" type="password" name="password" id="password" value="<?php if(isset($valorForm)){echo $valorForm['password'];} ?>" placeholder="Digite a Nova Senha do usuário">
            </div>
            <div class="mb-4">
                <button class="btn btn-primary" type="submit" name="SendUpPass" value="Salvar">Salvar</button>
            </div>
        </div>
    </div>
</form>
<div class="m-3">
<a class="offset-md-6 btn btn-info" href="<?=URLADM?>">Clique aqui</a> Para acessar
</div>
