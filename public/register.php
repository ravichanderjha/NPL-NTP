<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if the username is not set, apologize
        if (empty($_POST["username"]))
	    {
	        apologize("You didn't enter a username!");
	        break;
	    }
	    
	    // if the password is not set, apologize
	    if (empty($_POST["password"]))
	    {
	        apologize("You didn't enter a password!");
	        break;
	    }
	    
	    // if the confirmation password is not set, apologize
	    if (empty($_POST["confirmation"]))
	    {
	        apologize("You didn't confirm your password!");
	        break;
	    }
	    
	    // if the passwortd and the confirmation password do not match, apologize
	    if ($_POST["password"] != $_POST["confirmation"])
	    {
	        apologize("Your password and password confirmation do not match!");
	        break;
	    }

        else
        {
            $reg_results = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));

            if ($reg_results === false)
            {
                apologize("Registration failed!");
                break;
            }
            
            else
            {
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                redirect("/");
            }
        }
    }

?>
