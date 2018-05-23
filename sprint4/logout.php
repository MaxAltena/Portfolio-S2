<?php
session_start();
session_destroy();
header('Location: /sprint4/');
exit();
?>