<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //If any fields in register are null then apologize
        if($_POST["username"] == null || $_POST["password"] == null || $_POST["confirmation"] == null)
        {
            apologize("you missed a spot!");
        }
        //If Password doesn't match confirmation apologize
        else if($_POST["password"] != $_POST["confirmation"]) 
        {
            apologize("Passwords don't match!");
        }
        else {
            //Add user to database if query is successful
            if(CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) != 0)
            {
                //Get id of newly registered user
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                //Log user in automatically
                $_SESSION["id"] = $id;
                redirect("index.php");
            }
            //Apologize to user if adding user to table fails
            else
            {
                apologize("username is already in use");
            }
            
        }
    }

?>