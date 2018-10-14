<?php
    //Config
    require("../includes/config.php");
    
    //get user id
    $id = $_SESSION["id"];
    
    //render sell form if not sent by sell button
    if($_SERVER["REQUEST_METHOD"] != "POST")
    {
        $stocks_owned_array = CS50::query("SELECT symbol, shares FROM portfolio WHERE user_id = $id");
        render("sell_form.php", ["title" => "Sell", "stocks_owned_array" => $stocks_owned_array]);
    }
    
    //get symbol and format as uppercase string
    $symbol = "'" . $_POST["symbol"] . "'";
    $symbol = strtoupper($symbol);
    
    //get number of shares to sell
    $shares_to_sell =  $_POST["shares"];
    
    if($symbol == NULL || $shares_to_sell == NULL)
    {
        apologize("You missed a spot!");
    }
    //lookup price of stock to sell
    $stock_price_array = lookup($symbol);
    $stock_price = $stock_price_array["price"];
    
    
    //calculate value of sell
    $selling_value = $stock_price*$shares_to_sell;
   
    //get number of shares owned and use to check if valid sale i.e. if user owns enough shares for number they are selling
    $shares_owned_array = CS50::query("SELECT shares FROM portfolio WHERE user_id=$id AND symbol=$symbol");
    $shares_owned = $shares_owned_array[0]['shares'];
    if($shares_owned == 0)
    {
        apologize("Sorry you don't own any shares of this stock");
    }
    else if($shares_owned - $shares_to_sell < 0)
    {
        apologize("Sorry you don't own that many shares of this stock");
    }
    //update database and redirect
    else
    {
        //update cash amount in users table
        CS50::query("UPDATE users SET cash = cash + $selling_value WHERE id=$id");
    
        //update number of shares in portfolio database
        CS50::query("UPDATE portfolio SET shares = shares - $shares_to_sell WHERE user_id=$id AND symbol=$symbol");
    
        //update history 
        CS50::query("INSERT INTO history (user_id, symbol, shares, buy, time) VALUES($id, $symbol, $shares_to_sell, 0, NOW())");
        
        //go back to home page
        redirect("index.php"); 
    }
   
    
        
        
        
    
    
    
?>