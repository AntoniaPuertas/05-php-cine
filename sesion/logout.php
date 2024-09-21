<?php
//hay que utilizar session_start() en todos los archivos dónde quiera utilizar $_SESSION
session_start();

//cierro la sesion
session_destroy();
header('Location: ../index.php');
exit();