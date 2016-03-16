<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //TODO
        if (empty($_POST["symbol"]))
        {
            apologize ("You must enterate a symbol,please.");
        }
    }
        $stock = lookup($_POST["symbol"]);
        if ($stock == 0)
        {
            apologize ("Invalid symbol");
        }
        render("quote.php", ["title" => "Quote", "stock" => $stock]);
?>