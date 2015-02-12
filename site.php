<?php
require_once 'settings.php';

class Site {
	public function __construct() {
		
	}
	
	// Execute the site.
	public function execute() {
		?>
		<html>
			<head>
				<title>Infected Screen</title>
				<meta name="description" content="<?php echo Settings::description; ?>">
				<meta name="keywords" content="<?php echo Settings::keywords; ?>">
				<meta name="author" content="halvors and petterroea">
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="styles/style.css">
				<script src="../api/scripts/jquery-1.11.1.min.js"></script>
				<script src="scripts/instafeed.min.js"></script>
				<script src="scripts/infoscreen.js"></script>
			</head>
			<body>
				<div id="container">
					<section id="colRight"> <!-- Skejmamenyen til høyre -->
						<div id="agendaPadding">
							<div id="agendaContainer">
								<i>Laster data...</i>
							</div>
						</div>
					</section>
					<section id="colMid1"> <!-- infoboksen -->
						<div id="slideContainer">
							<i>Laster data...</i>
						</div>
					</section>
					<section id="colMid2"> <!-- infoboksen -->
						<div id="slideContainerTwo">
							<i>Laster data...</i>
						</div>
					</section>
					<!-- Right -->
					<section id="colFoot"> <!-- footerboksen for meny, sponsorlogoer og butikktekst -->
						<a href="http://infected.no/"><img src="images/infected_logo_hvit_medium.png" alt="Infected" height="90%"></a>
						<div id="footerContainer"></div>
					</section>
				</div>
			</body>
		</html>
		<?php
	}
}
?>
