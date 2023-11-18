<?php

session_start();

// Eliminar la sesión
session_destroy();

header("Location: login.php");
