<?php
    // configuration
    require("../includes/config.php");
    
    // else if user reached page via POST (as by submitting a form via POST)
     if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       
        $stock = lookup($_POST["symbol"]);
        if (lookup($_POST["symbol"]) === false)
        {
            apologize("invalid");
        }
        
        if(preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            apologize("Not valid, retry");
        }
        
        $cost = $stock["price"] * $_POST["shares"];
        
        $cash_rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $cash_rows[0]["cash"];
        $type='Buy';
        if ($cash < $cost)
        {
            apologize("insufficient funds");
        }
        
        $_POST["symbol"] = strtoupper($_POST["symbol"]);
    
        CS50::query("INSERT INTO Portfolio (user_id, symbol, shares) VALUES(?, ?, ?)
        ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $_POST["shares"]);
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
        CS50::query("INSERT INTO History (user_id, Transaction, Datetime, Symbol, Shares, Price) VALUES(?,'Buy',NOW(), ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $stock["price"]);
        
        redirect("/");        
         
    }        
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "buy"]);
    }
    
        
    

?>

