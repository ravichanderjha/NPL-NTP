<?php

    require_once("../includes/config.php");
    
    $id = $_SESSION["id"];
    
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $cash = $userquery[0]["cash"];
    
    if (empty($_POST["symbol"]))
    {
        render("../templates/quote_form.php", ["title" => "Get Quote", "cash" => $cash]);
    }
    
    else
    {
        $stockinfo = lookup($_POST["symbol"]);

        if ($stockinfo["name"] == "N/A")
        {
            apologize("The stock symbol you entered does not exist!");
            break;
        }

        $stockprice = $stockinfo["price"];
        $stockprice = number_format($stockprice, 2);
        
        render("../templates/quote_display.php", ["title" => "Quote", "stockprice" => $stockprice, "stockinfo" => $stockinfo, "cash" => $cash]);
    }
    
?>
