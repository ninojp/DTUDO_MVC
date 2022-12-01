// alert("Carregou o arquivo JS!");
// ===============================================================================================
//Calcular a foça da senha
function passwordStrength(){
    var password = document.getElementById('password').value;
    console.log(password);
}
// ================================================================================================
const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async (e) => {
        //Receber o valor do campo NAME
        var name = document.querySelector("#name").value;
        // Verificar se o campo está vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo NOME!</p>";
            return;
        }
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL!</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA!</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo 6 caracteres!</p>";
            return;
        }
        // Verificar se o campo senha não possui numeros repetidos
        // PARA APRENDER MAIS SOBRE EXPRESSÕES REGULARES
        //https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Guide/Regular_Expressions
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha Não pode conter números repetidos!</p>";
            return;
        }
        // Verificar se o campo senha possui Letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-warning'>A Senha deve ter no minímo uma letra!</p>";
            return;
        }
    });
}
//=================================================================================================
const formLogin = document.getElementById("form-login");
if (formLogin) {
    formLogin.addEventListener("submit", async (e) => {
        //Receber o valor do campo USER
        var user = document.querySelector("#user").value;
        // Verificar se o campo está vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo USUÁRIO!</p>";
            return;
        }
        //Receber o valor do campo PASSWORD
        var password = document.querySelector("#password").value;
        // Verificar se o campo está vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo SENHA!</p>";
            return;
        }
    });
}
// ===============================================================================================
const formNewConfEmail = document.getElementById("form-new-conf-email");
if (formNewConfEmail) {
    formNewConfEmail.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL!</p>";
            return;
        }
    });
}
// ===============================================================================================
const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
    formRecoverPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo EMAIL
        var email = document.querySelector("#email").value;
        // Verificar se o campo está vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger'>Erro! Necessário preencher o campo EMAIL!</p>";
            return;
        }
    });
}