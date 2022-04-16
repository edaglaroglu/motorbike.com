<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #container { margin: 30px auto; padding: 10px;}
            td { border-bottom:1px solid #666; padding: 10px;}
            .profile { width: 400px; }
            .thumbnail { width: 90px; margin-right: 15px;}
            table { border-collapse: collapse; }
            td:first-child { font-weight: bold;}
            .border { border:2px solid blue; }
            .center { text-align: center;}
            
        </style>
    </head>
    <body>
         <?php
        require_once 'db.php';
        $id = $_GET["id"] ;
        $photo_index = isset( $_GET["photo"]) ? $_GET["photo"] : 0 ;
        
        try {
            $stmt = $db->prepare("select * from motorbikes where id = ?") ;
            $stmt->execute([$id]) ;
            $bike = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $db->prepare("select * from motorbike_photo where bike_id = ?") ;
            $stmt->execute([$id]) ;
            $photos = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
            //var_dump($photos);
        } catch (Exception $ex) {
            echo "Wrong id" ;
        }
        ?>
        
        <table id="container">
            <tr>
                <td colspan="2"><h2><?= $bike["title"]; ?></h2></td>
            </tr>  
            <tr>
                <td><img src="images/<?= $photos[$photo_index]['path'] ?>" class="profile"> </td>
                <td rowspan="2" valign="top">
                    <h3><?= $bike["price"] . " TL"; ?></h3>
                    <table>
                        <tr><td>Brand</td><td><?= $bike["brand"]; ?></td></tr>                     
                        <tr><td>Model</td><td><?= $bike["model"]; ?></td></tr>                     
                        <tr><td>Year</td><td><?= $bike["year"]; ?></td></tr>                     
                        <tr><td>Km</td><td><?= $bike["km"]; ?></td></tr>                     
                        <tr><td>Color</td><td><?= $bike["color"]; ?></td></tr>                     
                        <tr><td>Engine</td><td><?= $bike["engine"]; ?></td></tr>                     
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                      $i = 0 ;
                      foreach( $photos as $photo) {
                          if ( $i == $photo_index) {
                          echo "<a href='?id=$id&photo=$i'><img src='images/{$photo['path']}' class='thumbnail border'></a>" ;    
                          } else {
                          echo "<a href='?id=$id&photo=$i'><img src='images/{$photo['path']}' class='thumbnail'></a>" ;
                          }
                          $i++;
                      }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <a href="index.php">BACK</a> 
                    <?php
                      if ( $bike["status"] == 0 ) {
                          echo " | <a href='buy.php?id=$id'>BUY</a>" ;
                      }
                    ?>
                  
                </td>
            </tr>
        </table>
        
    </body>
</html>
