<?php
session_start();
session_unset();
if (isset($_SESSION)) {
    session_destroy();
}
header("Location: ../../");
exit;
