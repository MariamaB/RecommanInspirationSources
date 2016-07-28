<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Recommandation</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>

     body{
       display: flex;
       background-color: 	#FFE4E1;
     }
     img{
          width:150px;
     }

     #ausgabe{
        flex :1;
        border-right: 200px;
        border-left: 200px;
        border-color: #000000;
        background-color: #FFC0CB;
     }

     #phpTag{
       flex: 5;

     }
     .form-group{
       align-items: center;
       text-align: center;

     }
     .thumbnail{
       display: inline-block;
       margin: 1em;
       align-items: center;
       /*align-content: center;*/
       /*display:table-cell;*/
       vertical-align:middle;
       text-align: center;
       background-color: 	#DC143C;
     }
    </style>
  </head>
  <body>

<div id="ausgabe">
  <h1>Formular</h1>
  <form role="form" action="recom.php" method="get">
    <div class="form-group">

      <img src="http://images1.dawandastatic.com/Product3/71829/71829775/big/1415225809-785.jpg" alt="http://images1.dawandastatic.com/Product3/71829/71829775/big/1415225809-785.jpg" width="300px">
      <img src="https://images2.dawandastatic.com/ad/1c/8c/3d/57/19/4b/2a/99/43/dc/99/4e/0d/ed/57/big.JPEG" alt="https://images2.dawandastatic.com/ad/1c/8c/3d/57/19/4b/2a/99/43/dc/99/4e/0d/ed/57/big.JPEG" width="300px">
    </div>
  </form>
</div>

    <div id="phpTag">

      <?php
      $product;
      $productInfo = "https://de.dawanda.com/core/mobile/product_details/";
      $recommandationAdress = "http://de.dawanda.com/core/mobile/product_to_product_recommendations/";

      if(isset($_GET['id'])){
        $product = $_GET['id'];
      }else {
        $product ="71829775";
      }
        // $response2 = file_get_contents("http://de.dawanda.com/core/mobile/product_to_product_recommendations/86468079");

        $recommandationAdress = $recommandationAdress.$product;
        $productInfo = $productInfo.$product;

        $productInfoRequest = file_get_contents("$productInfo");
        $productInfoRequestJ = json_decode($productInfoRequest);

        $response = file_get_contents("$recommandationAdress");
        $responseJ = json_decode($response);
        $max = sizeof($responseJ);
        $id;

/////////////////WILL NICHT KLAPPPEN!!!!!!!!!!!!!!!!!!!!!!!!!!
          // $titel = $productInfoRequestJ[0]->title;
          // echo ''.sizeof($productInfoRequest).'';
          // echo ' json: '.sizeof($productInfoRequestJ).'';


        //  echo '<h1> Empfehlung für das Produkt'.$productInfoRequestJ[0]->title.'</h1>';

                      for ($i=0; $i <$max ; $i++) {
                        $id = $responseJ[$i]->id;
                        $recommandationAdress = $recommandationAdress.$id;

                        echo '
                          <div class="thumbnail" id="'.$responseJ[$i]->id.'">
                          <a href="'.$_SERVER['PHP_SELF'].'?id='.$id.'">
                            <img class="img-thumbnail" src="'.$responseJ[$i]->default_image->big.'" alt="'.$responseJ[$i]->default_image->big.'">
                          </a>
                          </div>
                          ';
                      }



       ?>
    </div>
  </body>
</html>
