<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Recommandation</title>
    <style>
     img{
          width:80px;
     }
    </style>
  </head>
  <body> 
    <div id="main">

    	<div id="profile">
      <?php 
         echo'<h2>Profile</h2>';
        $verz=opendir('Users/'); 

        while($file = readdir($verz)){ 
        if($file != '.' && $file != '..'){ 
          $info = getimagesize($file); 
          echo "<div><img src=\"Users/$file\" alt=\"\">

                </div>"; 
      } 
    } 
    closedir($verz);

      ?>


    	</div>

    	<div id="vorschläge">
    		
    	</div>
    </div>
  </body>
</html>