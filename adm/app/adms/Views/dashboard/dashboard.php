<?php

echo "Views/dashboard/dashboard.php <h1> Pagina(view) Dashboard</h1>";

echo $this->data." ".$_SESSION['user_name']."!<br>";
//realiza o logout, url raiz:URLADM + nome da classe:Logout + nome do método:index
// echo "<a href='".URLADM."logout/index'>Sair</a><br>";