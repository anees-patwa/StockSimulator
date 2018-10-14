<form action = "buy.php" method="post">
    <div class="form-group">
        <input name="symbol" type="text" placeholder="Stock's Symbol" class="form-control"/>
    </div>
    <div class="form-group">
        <input name="shares" type="number" placeholder="# of Shares" class="form-control" min="1"/>
    </div>
    <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Buy
            </button>
        </div>
</form>