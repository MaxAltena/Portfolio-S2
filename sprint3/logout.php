<?php
session_start();
session_destroy();
header('Location: /sprint3/');
exit();
?>