<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT symbol, shares, id FROM Portfolio WHERE user_id=?", $_SESSION["id"]);
    $cash = CS50::query("SELECT username, cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $cash[0]["cash"];
    $positions = [];
    
    foreach ($rows as $row)
    {
        $stock = lookup ($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "symbol" => $stock["symbol"],
                "name" => $stock["name"], 
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "total" => $row["shares"]*$stock["price"]
                ];
        }
    }
    // render portfolio
    render("portfolio.php", ["cash" => $cash, "positions" => $positions, "title" => "Portfolio"]);

?>
