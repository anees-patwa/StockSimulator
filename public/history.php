<?php
    //Config
    require("../includes/config.php");
    
    //get user id
    $id = $_SESSION["id"];
    
    $history = CS50::query("SELECT symbol, shares, buy, time FROM history WHERE user_id = $id");
    $i = 0;
    foreach($history as $stock)
    {
        $stock_price_array = lookup($stock["symbol"]);
        $stock_price = $stock_price_array["price"];
        $stock["price"] = $stock_price;
        $history[$i] = $stock;
        $i++;
    }
    
    //dump($history);

    render("history_view.php", ["title" => "History", "history" => $history]);
?>