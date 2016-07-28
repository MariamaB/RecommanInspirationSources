<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Klausur PZ1</title>
<link rel="stylesheet"	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
body {
	font-family: Verdana;
}

#kopf {
	background-color: lightgray;
	text-align: center;
	margin-bottom: 20px;
}

#links {
	background-color: orange;
	align: center;
	flex: 1;
}

#rechts {
	background-color: lightblue;
	align: center;
	flex: 5;
}

#main {
	display: flex;
}

#fuss {
	background-color: darkgray;
	text-align: center;
	clear: both;
	margin-top: 10px;
}

#fuss a {
	text-decoration: none;
	color:black;
}

img {
	width: 80px;
}

.abstand{
margin:10px;
}
</style>
</head>
<body>
	<div class="container-fluid">
		<div id='kopf'>
			<h1>Klausur PZ1</h1>
		</div>
		<div id='main'>
			<div id='links'>
	<?php
	if ($_GET) {
		$von = filter_var ( $_GET ['von'], FILTER_SANITIZE_NUMBER_INT );
		$bis = filter_var ( $_GET ['bis'], FILTER_SANITIZE_NUMBER_INT );
		if(!$von || !$bis) $inputok=false;
		else
		{
			$von = intval($von);
			$bis = intval($bis);
			$inputok = true;
		}

	}
	?>
	<div id="info">

	</div>
			<form role="form" class="form-horizontal"
				action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
				method="GET">

				<div class="form-group abstand">
					<label class="control-label col-sm-4 col-md-4" for="von">von :</label>
					<div class="col-sm-6 col-md-6">
						<input class="form-control" type="text" name="von" <?php if(isset($_GET['von'])) echo 'value="' .$_GET["von"].'";'?>
							placeholder="1" />
					</div>
					<div class="col-sm-2 col-md-2">
						<label class="control-label"></label>
					</div>
				</div>
    <?php
	if ($_GET && !$von) {
		echo '<p class="col-sm-offset-4 col-sm-8" style="color:red;">Bitte eine Zahl eingeben!</p></br>';
	}
	?>
				<div class="form-group abstand">
					<label class="control-label col-sm-4 col-md-4" for="bis">bis :</label>
					<div class="col-sm-6 col-md-6">
						<input class="form-control" type="text" name="bis" <?php if(isset($_GET['bis'])) echo 'value="' .$_GET["bis"].'";'?>
							placeholder="40" />
					</div>
					<div class="col-sm-2 col-md-2">
						<label class="control-label"></label>
					</div>
				</div>
	<?php
	if ($_GET && !$bis) {
		echo '<p class="col-sm-offset-4 col-sm-8" style="color:red;">Bitte eine Zahl eingeben!</p></br>';
	}
	?>
				<div class="form-group abstand">
				    <div class="col-sm-offset-4 col-sm-8">
					<button type="submit" class="btn btn-primary">Filtern</button>
				</div>
				</div>
			</form>
			<form role="form" >
				<div class="form-group abstand">
					<div class="col-sm-12">
						<input id="inp1" class="form-control" type="text" placeholder="1" onkeyup="removeDiv()"/>
					</div>
				</div>
			</form>
		</div>
		<div id='rechts'>
		<?php
		$fp = fopen ( "./images.txt", "r" );

		$i = 1;
		while ( ! feof ( $fp ) ) {
			$bild = fgets ( $fp );
			if($_GET && $inputok && ($i<$von || $i>$bis))
			{

			}
			else
			{
			$divid = $i;
			echo '<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
                     <div id='.$divid.' class="thumbnail" style="height:150px; margin-top:5px;" onclick="visibilityOnOff('.$divid.')">
      					<h4> ' . $i . ' </h4>
      		 			<img src="' . $bild . '" alt="' . $bild . '"/>

                     </div>
                  </div>';
			}
			$i ++;
		}

		fclose ( $fp );
		?>
		</div>
		</div>
		<div id='fuss'>
			<h4><a href='http://studi.f4.htw-berlin.de/~freiheit/WT15/index.php'>Ihr Name</a></h4>
		</div>
	</div>
<script>
function visibilityOnOff(divid)
{

	var myDiv = document.getElementById(divid.toString());
	var info = document.getElementById("info");

	var he = myDiv.getElementsByTagName("H4")[0];
	var ie = myDiv.getElementsByTagName("IMG")[0];

	if(he.style.visibility=="hidden")
	{
		he.style.visibility="visible";
		ie.style.visibility="visible";
		myDiv.style.backgroundColor="white";
	}
	else{
		he.style.visibility="hidden";
		ie.style.visibility="hidden";
		myDiv.style.backgroundColor="#76B900 ";
	}
}

function removeDiv()
{
	var wert = document.getElementById('inp1').value;
	if(!isNaN(wert) && wert>0 && wert<=40)
	{
		document.getElementById(wert.toString()).parentNode.removeChild(document.getElementById(wert.toString()));
if(wert>9)
{
		document.getElementById('inp1').value="";
		document.getElementById('inp1').focus();
}
	}
}
</script>
</body>
</html>
