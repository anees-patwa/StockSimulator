<?php

    // configuration
    require("../includes/config.php"); 
    
    //query portfolios with id for user
    $id = $_SESSION["id"];
    $stocks = CS50::query("SELECT * FROM portfolio WHERE user_id=$id");
    if($stocks == NULL)
    {
        apologize("Go buy some stocks. You don't own any yet!");
    }
    
    $cash_array = CS50::query("SELECT cash FROM users WHERE id=$id");
    
    //loop through array that contains all stocks that were queried from portfolio
    foreach($stocks as $stock)
    {
        //lookup price
        $stock_price = lookup($stock['symbol']);
        if($stock_price !== false)
        {
            //create array to pass with render to portfolio.php
            $stocks_owned[] =
            [
                "name" => $stock_price['name'],
                "price" => $stock_price['price'],
                "symbol" => $stock['symbol'],
                "shares" => $stock['shares']
            ];
        }
    }
    
    //dump($stocks_owned);
    //dump($cash);
    
    $cash = $cash_array[0]["cash"];
    
    //dump($cash);
    
    /*$cash_spent = 0;
    $cash_net;
    foreach($stocks_owned as $stock_owned)
    {
        $cash_spent += ($stock_owned["shares"]*$stock_owned["price"]);
    }
    $cash_net = $cash - $cash_spent;*/
    $cash = number_format($cash,2);
    //CS50::query("UPDATE users SET cash = $cash_net WHERE id=$id");

    // render portfolio
    render("portfolio.php", ["stocks_owned" => $stocks_owned, "title" => "Portfolio", "cash_net" => $cash]);
    
    

?>
