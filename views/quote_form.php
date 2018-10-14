<html>
    <head>
        <title>Find Stock</title>
    </head>
    <body>
        <form action = "quote.php" method="post">
            <fieldset>
                <div class="form-group">
                    <input class="form-control" type = "text" name = "symbol" placeholder="Stock Symbol">
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">
                        <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                        Find
                    </button>
                </div>
            </fieldset>
        </form>
    </body>
</html>