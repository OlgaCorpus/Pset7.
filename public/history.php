<?php
    require("../includes/config.php");
    $history = CS50::query("SELECT * FROM History WHERE user_id = ?", $_SESSION["id"]);
    
    render("history_form.php",["title" => "History","history"  => $history]);
?>
 