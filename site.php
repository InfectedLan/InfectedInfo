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
				<meta name="description" content="<?php echo Settings::description; ?>">';
				<meta name="keywords" content="<?php echo Settings::keywords; ?>">';
				<meta name="author" content="halvors and petterroea">';
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="styles/style.css">
				<script src="../api/scripts/jquery-1.11.1.min.js"></script>
				<script src="scripts/instafeed.min.js"></script>
				
			</head>
			<body>
				<div id="container">
					<!--Instafeed script. Plz dont steal our client id. -->
					<script>
						var feed = new Instafeed({
							get: 'tagged',
							tagName: 'infectedlan',
							clientId: '922e04dec98849259347d27d1704d43a',
							resolution: 'standard_resolution',
							limit: '1',
							sortBy: 'random'
						});
					</script>
					<script>
						var contentsArray = new Array();
						var contentsTwoArray = new Array();
						var slideAt = 0;
						var slideTwoAt = 0;
						var nextImage = "";
						var imageArray = new Array("BF01", "BF02", "BF03", "BF04", "cod01", "cod02", "cod03", "cod04", "ghost_recon01", "MOH01", "sniper01");
						
						$(document).ready(function() {
							setInterval(function() {
								updateSlide();
							}, 1000*15);
							
							setInterval(function() {
								updateImage();
							}, 1000*5*60);
							
							prepareNextImage();
							updatePage();
						});
						
						function updatePage() {
							// Get json for agenda
							$.getJSON('api/json/agenda/getPublishedNotHappendAgendas.php', function(data) {	
								if (data.agendaList.length >= 1) {
									$("#agendaContainer").empty();
									
									$.each(data.agendaList, function(index, agenda) {
										if (agenda.isHappening) {
											$('#agendaContainer').append('<div class="happeningAgenda">' + 
												'<h3>' + agenda.startTime + '</h3>' + 
												'<h1><b>' + agenda.title + '</b></h1>' +
												'<h4>' + agenda.description + '</h4>' +
											'</div>');
										} else {
											$('#agendaContainer').append('<div class="pendingAgenda">' + 
												'<h3>' + agenda.startTime + '</h3>' + 
												'<h1><b>' + agenda.title + '</b></h1>' +
												'<h4>' + agenda.description + '</h4>' +
											'</div>');
										}
									});
								}
							});
							
							// Get JSON for slides
							$.getJSON('api/json/slide/getPublishedSlides.php', function(data) {
								$.each(data.slideList, function(index, slide) {
									if (i%2 == 0) {
										contentsArray.push('<h1>' + slide.title + "</h1>" +
														   slide.content);
									} else {
										contentsTwoArray.push('<h1>' + slide.title + '</h1>' + 
															  slide.content);
									}
								});
							});
						}
						
						function preloadImage (url) {
							try {
								var _img = new Image();
								_img.src = url;
							} catch (e) {
								
							}
						}
						
						function prepareNextImage() {
							var r = Math.floor((Math.random()*(imageArray.length - 1)) + 1);
							nextImage = "../images/backgrounds/"+ imageArray[r] +".jpg";
							preloadImage(nextImage);
						}
						
						function updateImage() {
							//Change background
							$("html").css('background-image', 'url('+ nextImage +')');
							prepareNextImage();
						}
						
						function updateSlide() {
							$("#slideContainer").fadeOut('slow', function(){
								$("#slideContainer").empty();
								$("#slideContainer").append(contentsArray[slideAt]);
								$("#slideContainer").fadeIn('slow');
							});
							
							$("#slideContainerTwo").fadeOut('slow', function(){
								$("#slideContainerTwo").empty();
								$("#slideContainerTwo").append(contentsTwoArray[slideTwoAt]);
								$("#slideContainerTwo").fadeIn('slow');
							});
							
							var shouldUpdate = false;
							slideAt++;
							
							if (slideAt == contentsArray.length) {
								shouldUpdate = true;
								slideAt=0;
							}
							
							slideTwoAt++;
							
							if (slideTwoAt == contentsTwoArray.length) {
								shouldUpdate = true;
								slideTwoAt=0;
							}
							
							if (shouldUpdate) {
								updatePage();
							}
						}
					</script>
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
