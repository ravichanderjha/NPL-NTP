<div>
    <span><a href="index.php">Portfolio</a></span>
    <span><a href="quote.php">Quote</a></span>
    <span><a href="buy.php">Buy</a></span>
    <span><a href="sell.php">Sell</a></span>
    <span><a href="history.php">History</a></span>
    <span><a href="deposit.php">Deposit</a></span>
</div>

<h3>
    Cash reserves: $<?= number_format($userport[0]["cash"], 2) ?>
</h3>

<div>
    <table>
        <tr>
            <th>Name</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Share price</th>
            <th>Total value</th>
        </tr>
        
        <?php foreach ($userport as $value): ?>
        
        <tr>
            <td><?= $value["name"] ?></td>
            <td><?= $value["symbol"] ?></td>
            <td><?= $value["shares"] ?></td>
            <td>$<?= number_format($value["price"], 2) ?></td>
            <td>$<?= number_format($value["totval"], 2) ?></td>
        </tr>
        
        <?php endforeach ?>
        
    </table>
</div>

<div>
    <a href="logout.php">Log Out</a>
</div>
