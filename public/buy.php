<?php

    require_once("../includes/config.php");
    
    $id = $_SESSION["id"];
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $cash = $userquery[0]["cash"];
    
    if (empty($_POST["symbol"]) || empty($_POST["buyshares"]))
    {
        render("../templates/buy_form.php", ["title" => "Get Quote", "cash" => $cash]);
    }
    
    else
    {
        $stocksym = strtoupper($_POST["symbol"]);
        $stocklook = lookup($stocksym);
        $shareprice = $stocklook["price"];
        $buyshares = $_POST["buyshares"];
        $totcost = $buyshares * $shareprice;
        $transtype = "BUY";
        
        $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
        $usercash = $userquery[0]["cash"];
        if ($totcost > $usercash)
        {
            apologize("You don't have enough money to purchase that much stock!");
            break;
        }
        
        $stockquery = query("SELECT * FROM stocks WHERE id = ? AND symbol = ?", $id, $stocksym);

        if ($stocklook["name"] == "N/A")
        {
            apologize("The stock symbol you entered does not exist!");
            break;
        }
        
        if(!is_numeric($buyshares))
        {
            apologize("Please enter the number of shares you want to buy!");
            break;
        }
        
        // If $stockquery is empty, you don't already own this stock. Insert accordingly
        if (empty($stockquery))
        {
            query("INSERT INTO stocks (symbol, id, shares) VALUES (?, ?, ?)", $stocksym, $id, $buyshares);
            query("UPDATE users SET cash = (cash - ($buyshares * $shareprice)) WHERE id = ?", $id);
            query("INSERT INTO history (id, transtype, symbol, shares, shareprice) VALUES (?, ?, ?, ?, ?)", $id, $transtype, $stocksym, $buyshares, $shareprice);
            redirect("index.php");
        }
        
        // Else if it's not empty, you do own this stock. Update accordingly
        else
        {
            query("UPDATE stocks SET shares = (shares + $buyshares) WHERE id = ? AND symbol = ?", $id, $stocksym);
            query("UPDATE users SET cash = (cash - ($buyshares * $shareprice)) WHERE id = ?", $id);
            query("INSERT INTO history (id, transtype, symbol, shares, shareprice) VALUES (?, ?, ?, ?, ?)", $id, $transtype, $stocksym, $buyshares, $shareprice);
            redirect("index.php");
        }
    }
    
?>
