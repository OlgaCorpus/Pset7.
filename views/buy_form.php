<body style="background-color:cornsilk"/>
<form action = "buy.php" method="post">
    <fielset>
        <div class="form-group">
            <img src="/img/buy.jpg"  width="300" height="200" />
            <hr>
        </div>
        <div class ="form-group">
            <input value="<?= $symbol ?>" class="form-control" name="symbol" placeholder="Stock Symbol" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="shares" placeholder="Shares to buy" type="text"/>
        </div>
        <div class ="form-group">
            <button type="submit" class="btn">
                Buy
            </button>    
        
        </div>
    
    </fielset>
</form>
</body>