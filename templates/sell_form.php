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

<form action="sell.php" method="post">
    <formset>
        <div class="form-group">
            <input class="form-control" name="symbol" placeholder="Stock symbol" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="sellshares" placeholder="Shares to sell" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell shares</button>
        </div>
    </formset>
</form>

<div>
    <a href="logout.php">Log Out</a>
</div>
