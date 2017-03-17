<?php

    require_once("../includes/config.php");
    
    $id = $_SESSION["id"];
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $cash = $userquery[0]["cash"];
    
    $transrecord = query("SELECT * FROM history WHERE id = ?", $id);
    
    
    render("../templates/history_form.php", ["title" => "History", "transrecord" => $transrecord, "cash" => $cash]);
    
?>
