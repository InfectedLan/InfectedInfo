<?php
/**
 * This file is part of InfectedInfo.
 *
 * Copyright (C) 2015 Infected <http://infected.no/>.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3.0 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 */

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
