<?php
session_start();

// Remove all the session variables
session_unset();

// Destroy the session
session_destroy();

// Go to Login page
header("Location: /");
?>
