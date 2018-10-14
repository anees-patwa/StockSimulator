<table class="table">
    <tr>
        <th style="text-align:center;">Date and Time</th>
        <th style="text-align:center;">Symbol</th>
        <th style="text-align:center;">Shares</th>
        <th style="text-align:center;">Total</th>
    </tr>
    <?php foreach($history as $stock): ?>
    <tr>
        <td  ><?= $stock["time"] ?></td>
        <td ><?= $stock["symbol"] ?></td>
        <td ><?php
        if($stock["buy"] == 0)
        {
            echo -1*$stock["shares"];
        }
        else
        {
            echo "+" . $stock["shares"];
        }
        ?></td>
        <td ><?php
        if($stock["buy"] == 0) {
            
            echo "+" . number_format($stock["shares"]*$stock["price"],2);
        }
        else
        {
            echo number_format(-1*$stock["shares"]*$stock["price"],2);
        }
        ?></td>
        
        
    </tr>
    <?php endforeach ?>
</table>