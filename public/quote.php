<?php
    //Config
    require("../includes/config.php");
    
    //render quote-finding form but not if from form:quote_form.php
    /*if($_SERVER["REQUEST_METHOD"] != "POST")
    {
        render("quote_form.php", ["title" => "Quote Search"]);
    }*/
    
    
    //lookup stock
    $symbol = $_POST["symbol"];
    $symbol = strtoupper($symbol);
    $stock = lookup($symbol);
    if(!$stock)
    {
        apologize("Stock symbol was invalid");
        //render("get_quote_form.php", []);
    }
    else
    {
        //$name = $stock['name'];
        //$price = number_format($stock['price'],3);
        render("show_quote.php", $stock);
        
    }
    
    
    
    
?>
