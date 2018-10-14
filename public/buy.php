<?php
    //Config
    require("../includes/config.php");
    
    //render sell form if not sent by sell button
    if($_SERVER["REQUEST_METHOD"] != "POST")
    {
        render("buy_form.php", ["title" => "Sell"]);
    }
    
    //get data about buy from form 
    $id = $_SESSION["id"];
    $symbol = "'" . $_POST["symbol"] . "'";
    $symbol = strtoupper($symbol);
    $shares = $_POST["shares"];
    
    if($symbol == NULL || $shares == NULL)
    {
        apologize("You missed a spot!");
    }
    
    //get amount of cash that user owns
    $cash_array = CS50::query("SELECT cash FROM users WHERE id = $id");
    $cash = $cash_array[0]['cash'];
    
    //lookup price of stock to buy
    $stock_price_array = lookup($symbol);
    //dump($stock_price_array);
    $stock_price = $stock_price_array["price"];
    
    //calculate value of buy
    $buying_value = $stock_price * $shares;
    
    //check if valid buy i.e. if user has enough money to buy selected amount of shares
    if($cash - $buying_value < 0)
    {
        apologize("You don't have enough money to buy this stock");
    }
    else
    {
        //update portfolio table with info
        CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES($id, $symbol, $shares) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)");
        
        //update users amount of cash
        CS50::query("UPDATE users SET cash = cash - $buying_value WHERE id = $id");
        
        //update history with purchase
        CS50::query("INSERT INTO history (user_id, symbol, shares, buy, time) VALUES($id, $symbol, $shares, 1, NOW())");
        
        //go back to home page
        redirect("index.php");
    }
    
    
    
?>