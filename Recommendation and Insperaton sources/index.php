<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
	background-color: #76B900;
	font-family: Verdana;
}

.flex-container {
	display: -webkit-flex;
	display: flex;
	width: 100%;
}

.flex-item {
	
}

#header {
	background-color: #AFAFAF;
	text-align: center;
}

h1 {
	color: white;
}

#wrapper {
	width: 100%;
}

#links {
	width: 50%;
	float: left;
	background-color: #FF5F00;
}

#rechts {
	width: 50%;
	background-color: #0082D1;
}

#footer {
	background-color: #AFAFAF;
	color: white;
	text-align: center;
}

.imgside {
	width: 80px;
}

table, td {
	margin: 10px 20px;
	padding: 10px 20px;
}

a {
	color: black;
}
</style>
</head>
<body>
	<div id="header">
		<h1>Probeklausur 1</h1>
	</div>
	<div id="wrapper" class="flex-container">
		<div id="links" class="flex-item">
		<?php
		if (empty ( $_GET )) {
			?>
	<h4>Übersicht</h4>
			Gegeben ist die Datei "staedte.txt". Diese sieht so aus:<br />
			<p
				style='border: 1px solid black; font-family: Courier; font-weight: normal;'>

  		<?php
			$fp = fopen ( "./staedte.txt", "r" );
			while ( ! feof ( $fp ) ) {
				$gruendung = fgets ( $fp );
				$stadt = fgets ( $fp );
				$link = fgets ( $fp );
				echo $gruendung . "<br/>";
				echo $stadt . "<br/>";
				echo $link . "<br/>";
			}
			fclose ( $fp );
			?>
			</p>
			<p>
				<a href="index.php?command=formular">Formular</a>
			</p>
  
	  	<?php
		} else if ($_GET ['command'] == 'formular') {
			
			?>
			<h4>Formular (PHP)</h4>

			<form action="index.php?command=formular" method="post">
				<fieldset>
					<legend>Zahleingabe:</legend>
					<br />
					<table>
						<tr>
							<td>Gründungsjahr:</td>
							<td><input type="number" name="zahl" placeholder="0"
								<?php if($_POST) echo 'value="'.$_POST["zahl"].'"'?>
								class="text"></td>
						</tr>
						<tr>
							<td><input type="reset" value="Löschen" class="buttonr"></td>
							<td><input type="submit" value="Suchen" class="buttons"></td>
						</tr>
					</table>
				</fieldset>
			</form>

			<h4>Geben Sie ein Gründungsjahr ein und klicken Sie auf "Suchen"</h4>
		
			<?php
			if ($_POST) {
				$fehler = "";
				$zahl = isset ( $_POST ['zahl'] ) ? filter_var ( $_POST ['zahl'], FILTER_SANITIZE_NUMBER_INT ) : "";
				if (empty ( $zahl )) {
					$fehler .= "<li>Bitte geben Sie eine Zahl ein !</li>";
				}
				
				if (empty ( $fehler )) {
					$fp = fopen ( "staedte.txt", "r" );
					$found = false;
					while ( ! feof ( $fp ) ) {
						$gruendung = fgets ( $fp );
						$stadt = fgets ( $fp );
						$link = fgets ( $fp );
						$bild = fgets ( $fp );
						if (trim ( $gruendung ) == $zahl) {
							echo "<p>Die Stadt <span  style='color:black;'>" . $stadt . "</span> wurde " . $zahl . " gegründet.</p>";
							echo "<p>Ihr Wappen sieht so aus: <img class='imgside' src='" . $bild . "' alt='" . $stadt . "'/>";
							$found = true;
						}
					}
					if (! $found) {
						echo "<p style='color:black;'>Keine Stadt in der Liste mit Gründungsjahr " . $zahl . "</p>";
					}
					fclose ( $fp );
				} else {
					echo '<ul style="color:red; background-color: yellow; font-weight:bold">';
					echo $fehler;
					echo '</ul>';
				}
			}
		}
		
		?>
		
		</div>
		<div id="rechts" class="flex-item">
			<h3>Tabellenübersicht</h3>
			<table>
				<tr>
					<th>Gründung</th>
					<th>Stadt</th>
					<th>Flagge / Wappen</th>
				</tr>
  				<?php
						$fp = fopen ( "./staedte.txt", "r" );
						while ( ! feof ( $fp ) ) {
							$gruendung = fgets ( $fp );
							$stadt = fgets ( $fp );
							$link = fgets ( $fp );
							$bild = fgets ( $fp );
							echo "<tr>";
							echo "<td>" . $gruendung . "</td>";
							echo "<td> <a href='" . $link . "'>" . $stadt . "</a>";
							echo "<td> <img class='imgside' src='" . $bild . "' alt='" . $stadt . "' onclick='insDiv(this)'/> </td>";
							echo "</tr>";
						}
						fclose ( $fp );
						?>
  			</table>
		</div>
	</div>
	<div id="footer">
		<a href="htw-berlin.de">Der Link zu Ihrer WT15-Seite</a>
	</div>
</body>
</html>