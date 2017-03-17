<?php

    require_once("../includes/config.php");

    $id = $_SESSION["id"];
    
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $cash = $userquery[0]["cash"];
    $transtype = "DEPOSIT";
    
    if (empty($_POST["deposit"]))
    {
        render("../templates/deposit_form.php", ["title" => "History", "cash" => $cash]);
    }
    
    else
    {
        $deposit = $_POST["deposit"];
        
        query("UPDATE users SET cash = (cash + $deposit) WHERE id = ?", $id);
        
        redirect("deposit.php");
    }
?>
