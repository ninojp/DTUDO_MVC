// alert("Carregou o arquivo JS!");
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
    });
}

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