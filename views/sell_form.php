<form action="sell.php" method="post">
<body style="background-color:cornsilk"/>
    
    <img src="/img/sell.jpg"  width="350" height="300" />
    <hr>
    <fieldset>
        <div class="form-group">
            <select class ="form-control" name="symbol">
                <option value="Symbols">Symbols </option>
                <?php
                foreach ($symbols as $symbol)
                {
                    echo '<option value="'.$symbol["symbol"].'">'.$symbol["symbol"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="shares_n" placeholder="No. of Shares" type="int"/>
        </div>  
        <div class="form-group">
            <button class="btn btn_default" type="submit"> Sell </button>
        </div>
    </fieldset>
</form>