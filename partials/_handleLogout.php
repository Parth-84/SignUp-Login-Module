<?php
include './_dbConnect.php';

session_start();
session_unset();
session_destroy();
header("location: /Module/index.php?clientLoggedOut=true");
exit;
?>