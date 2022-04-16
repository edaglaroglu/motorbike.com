<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>

    h1 { text-align: center;}
    
    table {
        border-collapse: collapse;
        margin:0 auto;
        border:1px solid black;
    }

    tr,td,th { border:1px solid black; padding: 10px;}

    th {background-color: yellow;}

    img { width : 200px;}



    </style>

</head>
<body>

    <h1>Moto-Market.com</h1>
    <table>    
    <tr>
        <th></th>
        <th>Brand</th>
        <th>Model</th>
        <th>Title</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Status</th>
    </tr>
   

    <?php

    require_once "db.php";
    $list=$db->query("select * from motorbikes")->fetchAll(PDO::FETCH_ASSOC);
    foreach($list as $row){
        echo "<tr>";
        echo "<td>
        <a href='detail.php?id={$row['id']}'><img src='./images/{$row['profile']}'></a>
        </td>";
        echo "<td>{$row['brand']}</td>";
        echo "<td>{$row['model']}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['price']}</td>";
        $discount=preg_match('/^[A-Z]{2}\d{3}-\d{2}$/',$row['coupon'])? "<b>YES</b>":"NO";
        echo "<td>$discount</td>";
        $status=$row['status']? "SOLD" : "ON SALE";
        echo "<td> $status</td>";
        echo "</tr>";
        

    }
  

    ?>

</table>
    
</body>
</html>