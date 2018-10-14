<form action = "sell.php" method="post">
    <select name="symbol" class="form-group">
        <?php foreach($stocks_owned_array as $stock_owned)
        {
            if($stock_owned["shares"] != 0)
            {
                echo "<option value={$stock_owned["symbol"]}>{$stock_owned["symbol"]}</option>";
            }
        }
        ?>
    </select>
    <div class="form-group">
        <input name="shares" type="number" placeholder="# of Shares" class="form-control" min="1"/>
    </div>
    <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Sell
            </button>
        </div>
</form>