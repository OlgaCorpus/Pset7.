<body style="background-color:cornsilk"/>
<fieldset> 
  <div >
               <img src="/img/history.jpg"  width="350" height="300" />   
               <hr>
        </div>
        
</fieldset>
<table class = "table table_striped">
    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th> 
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($history as $position)
            {
                echo("<tr>");
                echo("<td>" . $position["Transaction"] . "</td>");
                echo("<td>" . date('j-M-y h:i:s A', strtotime($position["Datetime"])) . "</td>");
                echo("<td>" . $position["Symbol"] . "</td>");
                echo("<td>" . $position["Shares"] . "</td>");
                echo("<td>" . number_format($position["Price"],2) . "</td>");
                echo("</tr>");
            }
        ?>
    </tbody>
</table>
