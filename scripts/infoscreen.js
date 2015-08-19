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

var contentsArray = new Array();
var slideAt = 0;
var nextImage = "";
var imageArray = new Array("BF01", "BF02", "BF03", "BF04", "cod01", "cod02", "cod03", "cod04", "ghost_recon01", "MOH01", "sniper01");
var version_id = 2; //Used for updating live

$(document).ready(function() {
	setInterval(function() {
		updateSlides();
	}, 1000*15);

	setInterval(function() {
		updateImage();
	}, 1000*5*60);

	prepareNextImage(); //Preload next image
	updateImage();
	loadPage();
});

function loadPage() {
	slideAt = 0;
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
		$.each(data.slides, function(index, slide) {
			contentsArray.push('<h1>' + slide.title + "</h1>" + slide.content);
		});
	});
	updateSlides();
}

//Image handling
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

function updateSlides() {
	var shouldUpdate = false;

	//Fix for less repetition
	if(contentsArray.length % 2 == 0) { //Is it an even number?
		if(slideAt == ( contentsArray.length *2) - 2) {
			shouldUpdate = true;
		}
	} else {
		if(slideAt == (contentsArray.length*2)) {
			shouldUpdate = true;
		}
	}

	if (shouldUpdate) {
		$.getJSON('version.txt', function(data) {
			if(data.version != version_id) {
				location.reload();
			} else {
				loadPage();
			}
		});
	} else {
		$("#slideContainer").fadeOut('slow', function(){
			$("#slideContainer").empty();
			$("#slideContainer").append(contentsArray[(slideAt)%contentsArray.length]);
			$("#slideContainer").fadeIn('slow');
		});

		$("#slideContainerTwo").fadeOut('slow', function(){
			$("#slideContainerTwo").empty();
			$("#slideContainerTwo").append(contentsArray[(slideAt+1)%contentsArray.length]);
			$("#slideContainerTwo").fadeIn('slow');
		});
		slideAt += 2;
	}
}
