<?php

echo "Views/dashboard/dashboard.php <h1> Pagina(view) Dashboard</h1>";

echo $this->data." ".$_SESSION['user_name']."!<br>";
echo "<a href='".URLADM."'>Sair</a>";