<table class="table">
    <tr>
        <th style="text-align:center;">Name</th>
        <th style="text-align:center;">Symbol</th>
        <th style="text-align:center;">Shares</th>
        <th style="text-align:center;">Price per Stock</th>
        <th style="text-align:center;">Total</th>
    </tr>
    <?php foreach($stocks_owned as $stock_owned)
    {
        $stock_owned["price"] = number_format($stock_owned["price"],2);
        $stock_total = number_format($stock_owned["price"]*$stock_owned["shares"],2);
        if($stock_owned["shares"] == 0)
        {
            
        }
        else
        {
            echo
            "<tr>
                <td>  {$stock_owned["name"]}</td>
                <td>  {$stock_owned["symbol"]}</td>
                <td>  {$stock_owned["shares"]}</td>
                <td>  {$stock_owned["price"]}</td>
                <td>  {$stock_total}</td>
            </tr>";
        }
    }
    ?>
    <tr>
        <td  >Total Cash</td>
        <td  ></td>
        <td  ></td>
        <td  ></td>
        <td><?= $cash_net ?></td>
        
    </tr>
</table>
