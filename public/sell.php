<?php

    require_once("../includes/config.php");
    
    $id = $_SESSION["id"];
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $cash = $userquery[0]["cash"];

    if (empty($_POST["symbol"]) || empty($_POST["sellshares"]))
    {
        render("../templates/sell_form.php", ["title" => "Get Quote", "cash" => $cash]);
    }
    
    else
    {
        $stocksym = strtoupper($_POST["symbol"]);
        $stocklook = lookup($stocksym);
        $shareprice = $stocklook["price"];
        $sellshares = $_POST["sellshares"];
        $transtype = "SELL";
        
        if ($stocklook["name"] == "N/A")
        {
            apologize("The stock symbol you entered does not exist!");
            break;
        }
        
        if(!is_numeric($sellshares))
        {
            apologize("Please enter the number of shares you want to sell!");
            break;
        }
        
        $idquery = query("SELECT * FROM stocks WHERE id  = ? AND symbol = ?", $id, $stocksym);
        $sharesowned = $idquery[0]["shares"];
        
        // If query finds no rows w/ this id and stocksym, apologize
        if (empty($idquery))
        {
            apologize("You don't own that stock!");
            break;
        }
        
        // If you're trying to sell more shares than you own
        else if ($sellshares > $sharesowned)
        {
            apologize("You don't own that many shares!");
            break;
        }
        
        // If you're selling all of your shares in a company
        else if ($_POST["sellshares"] == $idquery[0]["shares"])
        {
            query("DELETE FROM stocks WHERE id = ? AND symbol = ?", $id, $stocksym);
            query("UPDATE users SET cash = (cash + ($sellshares * $shareprice)) WHERE id = ?", $id);
            query("INSERT INTO history (id, transtype, symbol, shares, shareprice) VALUES (?, ?, ?, ?, ?)", $id, $transtype, $stocksym, $sellshares, $shareprice);
            redirect("index.php");
        }
        
        // If you're only selling some of your shares in a company
        else
        {
            query("UPDATE stocks SET shares = (shares - $sellshares) WHERE id = ? AND symbol = ?", $id, $stocksym);
            query("UPDATE users SET cash = (cash + ($sellshares * $shareprice)) WHERE id = ?", $id);
            query("INSERT INTO history (id, transtype, symbol, shares, shareprice) VALUES (?, ?, ?, ?, ?)", $id, $transtype, $stocksym, $sellshares, $shareprice);
            redirect("index.php");
        }
    }

?>
