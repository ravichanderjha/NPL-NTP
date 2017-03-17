<div>
    <span><a href="index.php">Portfolio</a></span>
    <span><a href="quote.php">Quote</a></span>
    <span><a href="buy.php">Buy</a></span>
    <span><a href="sell.php">Sell</a></span>
    <span><a href="history.php">History</a></span>
    <span><a href="deposit.php">Deposit</a></span>
</div>

<h3>
    Cash reserves: $<?= number_format($cash, 2) ?>
</h3>

<table>
    <tr>
        <th>Transaction type</th>
        <th>Date/Time</th>
        <th>Symbol</th>
        <th>Shares</th>  
        <th>Share price</th>
        <th>Total</th>                  
    </tr>
    
    <?php foreach ($transrecord as $row): ?>
        <tr>
            <td><?= $row["transtype"] ?></td>
            <td><?= $row["time"] ?></td>
            <td><?= $row["symbol"] ?></td>
            <td><?= number_format($row["shares"], 2) ?></td>
            <td><?= number_format($row["shareprice"], 2) ?></td>
            <td><?= number_format($row["shareprice"] * $row["shares"], 2) ?></td></td>
        </tr>    
    <?php endforeach ?>
    
</table>

<div>
    <a href="logout.php">Log Out</a>
</div>
