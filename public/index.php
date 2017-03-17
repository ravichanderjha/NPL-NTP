<?php

    // Configuration
    require("../includes/config.php"); 
    
    // Get the user's id number, provided to $_SESSION upon login
    $id = $_SESSION["id"];
    
    // Declare a table to load in the data we want from lookup() and query()
    $userport = [];
    
    // Get every row from the stocks table where the id matches the session    
    $portquery = query("SELECT * FROM stocks WHERE id  = ?", $id);
    
    // Query all the user's information to attain cash reserves
    $userquery = query("SELECT * FROM users WHERE id  = ?", $id);
    $username = $userquery[0]["username"];

    // Loop through each row of the portquery
    foreach ($portquery as $row)
    {
        // Perform a lookup on the symbol found in the current row
        $stock = lookup($row["symbol"]);
      
        // If there was no lookup error, i.e. $stock is not false
        if ($stock !== false)
        {
            // Load up the userport table with appropriate key-val pairs
            $userport[] = [
                "name" => $stock["name"],
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => $stock["price"],
                "totval" => $row["shares"] * $stock["price"],
                "cash" => $userquery[0]["cash"]
            ];
        }
    }
?>
    
<?php  
  
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "userport" => $userport, "username" => $username]);

?>
