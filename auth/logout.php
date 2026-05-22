<?php

session_start();
session_destroy();

header("Location: /blogspot/auth/login.php");
exit;
