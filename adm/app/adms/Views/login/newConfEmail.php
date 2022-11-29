<?php
        
    if(isset($this->data['form'])){
        // var_dump($this->data['form']);
        $valorForm = $this->data['form'];
    }
?>
<h1 class="text-center mt-5">Novo Link</h1>
<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<span id="msg"></span>
<form action="" method="POST" id="form-new-conf-email">
    <div class="row m-5">
        <div class="col-12 m-5">
            <div class="col-md-4 offset-md-4 mb-3">
                <label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($valorForm)){echo $valorForm['email'];} ?>" placeholder="Digite o seu Email" required>
            </div>
            <div class="col-md-2 offset-5 mb-3">
                <button class="btn btn-primary" type="submit" name="SendNewConfEmail" value="Enviar">Enviar</button>
            </div>
        </div>
    </div>
</form>
<!-- <div class="m-5"> -->
    <!-- Para direcionar para o endereço, URL:URLADM, nome da CONTROLLER:NewUser precisa ter um SEPARADOR entre os termos(espaço ou traço)e depois o nome do método usado:index(dentro da controller) -->
    <a class="offset-md-6 btn btn-info" href="<?=URLADM?>">Clique aqui</a> Para acessar
<!-- </div> -->


