

<?php
// conf
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbols = CS50::query("SELECT symbol FROM Portfolio WHERE user_id = ?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
         
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["symbol"]=='symbols')
        {
            apologize("Please enter the stock symbol.");
        }
        
        $stock = lookup($_POST["symbol"]);
        $shares = CS50::query("SELECT shares FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        // if mas ni negativo
        $shares_n = $_POST["sharess"];
        
        if ($_POST["shares_n"] == NULL)
        {
            apologize("Enter a number of shares");
        }
        else if ($_POST["shares_n"] < 0)
        {
            apologize("Enter a positive amount");
        }
        else if ($_POST["shares_n"] > $shares[0]["Shares"])
        {
            apologize("Not enough shares to sell");
        }
        $earn = $shares[0]["shares"] * $stock["price"];
        
       
        if ($_POST["shares_n"] < $shares[0]["shares"])
        {
            $rows = CS50::query("UPDATE Portfolio SET Shares = (Shares - ".$shares_n.") WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        else if ($_POST["shares_n"] == $shares[0]["shares"])
        {
            $rows = CS50::query("DELETE FROM Portfolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
         CS50::query("UPDATE users SET cash = (cash + ".$earn.") WHERE id = ?", $_SESSION["id"]);
        $type = 'Sell';
        CS50::query("INSERT INTO History (user_id, Transaction, Datetime, Symbol, Shares, Price) VALUES (?,'Sell',NOW(), ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        
        redirect("/");    
    }    
?>