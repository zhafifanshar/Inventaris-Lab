<?php
session_start();
session_destroy();
header("location:/inventaris_lab/auth/login.php");
exit;
