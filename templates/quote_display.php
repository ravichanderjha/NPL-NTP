<?php require("../templates/quote_form.php"); ?>

<div style="margin-top: 35px;">Name: <?= $stockinfo["name"] ?></div>
<div>Symbol: <?= strtoupper($stockinfo["symbol"]) ?></div>
<div>Price: <?= $stockprice ?></div>
