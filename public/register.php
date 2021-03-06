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
        //TODO
        if (empty ($_POST["username"]))
        {
           apologize ("Please provide a username");
        }
        else if (empty ($_POST["password"]))
        {
            apologize  ("Please provide a password");
        }
        else if( $_POST["confirmation"] != $_POST["password"])
        {
            apologize ("Verifacate your password, confirmation and password do not match");
        }
        
        else if ( empty($_POST["name"]) || empty($_POST["lastname"]) )
        {
            apologize("You must enter your name");
        }
        
        if (CS50::query("INSERT IGNORE INTO users (username, hash, cash, name, lastname) 
        VALUES(?, ?, 10000.0000, ?, ?)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST['name'], $POST['lastname'])==0)
        {
            apologize ("The username already exists");
        }
        else if( $rows = CS50::query("SELECT LAST_INSERT_ID() AS id") )
        {
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
    }   

?>