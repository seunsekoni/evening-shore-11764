<?php
    
    $con = new mysqli("localhost", "root", "", "myecommerce");
    if ($con -> connect_error) {
        trigger_error('Database Connection failed: ' . $con -> connect_error, E_USER_ERROR);
    }
?>