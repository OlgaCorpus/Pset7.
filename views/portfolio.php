<body style="background-color:cornsilk"/>
<div class="jumbotron">
    <h1> Welcome, <?= $name["Name"]?><?= $name["Lastname"]?> </h1>
     <img src="/img/negocios.jpg"  width="300" height="300" /> 
</div>
<h1 style= "font-family: verdana; font-size: 50px; color: red;">Current cash: $<?= number_format($cash) ?>
</h1>

<table class= "table table-striped">
    <thead>

    <tr> 
        <th>symbol</th>
        <th>name</th>
        <th>shares</th>
        <th>price</th>
        <th>total</th>
    
    </tr>
     </thead>
<tbody>
    <?php
        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>". $position["symbol"]. "</td>");
            print("<td>". $position["name"]. "</td>");
            print("<td>". $position["shares"]. "</td>");
            print("<td>$". number_format($position["price"],2). "</td>");
            print("<td>$". number_format($position["total"],2). "</td>");

            print("</tr>");
        }

    ?>
    </tbody>
</table>
