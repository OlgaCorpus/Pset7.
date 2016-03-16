<?php

    // configuration
    require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"]== "GET")
    {
        $symbols = CS50::query("SELECT symbol FROM Portfolio WHERE user_id = ?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
        
    }
    
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $shares = CS50::query("SELECT shares FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $stock = lookup($_POST["symbol"]);
        $earn = $shares[0]["shares"] * $stock["price"];
        $type = 'sell';
        CS50::query("UPDATE users SET cash = (cash + ".$earn.") WHERE id =?", $_SESSION["id"]);
        
        $rows = CS50::query("DELETE FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        
        CS50::query("INSERT INTO History (user_id, Transaction, Datetime, Symbol, Shares, Price) VALUES (?,'Sell',NOW(), ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        redirect("/");
    }
    
?>