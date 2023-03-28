$(window).on('load', function () {
    "use strict";
    $("body").css("overflow", "auto");
    
    $(".loadingOverLay").fadeOut(500, function () {
        $(this).remove();
    });
    
    new WOW().init();
});

// nice scroll plugin يغير شكل السكرول

if (window.innerWidth > 768) {
  
  $("body").niceScroll({
      cursorcolor: "#7d1921",
      cursoropacitymin: 0.2,
      cursorwidth: "8px",
      cursorborder: "0",
      cursorborderradius: "5px",
      zindex: 99998,
  });
    
  $(".timeline-Viewport").niceScroll({
      cursorcolor: "#7d1921",
      cursoropacitymin: 0.2,
      cursorwidth: "8px",
      cursorborder: "0",
      cursorborderradius: "5px",
      zindex: 99998,
  });
  
}


// smooth sroll plugin يخلي حركة الصفحة ناعمة

var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 900,
    speedAsDuration: true,
});

(function($){
	var canvas = $('#bg').children('canvas'),
		background = canvas[0],
		foreground1 = canvas[1],
		foreground2 = canvas[2],
		config = {
			circle: {
				amount: 18,
				layer: 3,
				color: [0, 0, 0],
				alpha: 0.3
			},
			line: {
				amount: 12,
				layer: 3,
				color: [255, 255, 255],
				alpha: 0.3
			},
			speed: 0.5,
			angle: 20
		};

	if (background.getContext){
		var bctx = background.getContext('2d'),
			fctx1 = foreground1.getContext('2d'),
			fctx2 = foreground2.getContext('2d'),
			M = window.Math, // Cached Math
			degree = config.angle/360*M.PI*2,
			circles = [],
			lines = [],
			wWidth, wHeight, timer;
		
		requestAnimationFrame = window.requestAnimationFrame || 
			window.mozRequestAnimationFrame ||
			window.webkitRequestAnimationFrame ||
			window.msRequestAnimationFrame ||
			window.oRequestAnimationFrame ||
			function(callback, element) { setTimeout(callback, 1000 / 60); };

		cancelAnimationFrame = window.cancelAnimationFrame ||
			window.mozCancelAnimationFrame ||
			window.webkitCancelAnimationFrame ||
			window.msCancelAnimationFrame ||
			window.oCancelAnimationFrame ||
			clearTimeout;

		var setCanvasHeight = function(){
			wWidth = $(window).width();
			wHeight = $(window).height(),

			canvas.each(function(){
				this.width = wWidth;
				this.height = wHeight;
			});
		};

		var drawCircle = function(x, y, radius, color, alpha){
			var gradient = fctx1.createRadialGradient(x, y, radius, x, y, 0);
			gradient.addColorStop(0, 'rgba('+color[0]+','+color[1]+','+color[2]+','+alpha+')');
			gradient.addColorStop(1, 'rgba('+color[0]+','+color[1]+','+color[2]+','+(alpha-0.1)+')');

			fctx1.beginPath();
			fctx1.arc(x, y, radius, 0, M.PI*2, true);
			fctx1.fillStyle = gradient;
			fctx1.fill();
		};

		var drawLine = function(x, y, width, color, alpha){
			var endX = x+M.sin(degree)*width,
				endY = y-M.cos(degree)*width,
				gradient = fctx2.createLinearGradient(x, y, endX, endY);
			gradient.addColorStop(0, 'rgba('+color[0]+','+color[1]+','+color[2]+','+alpha+')');
			gradient.addColorStop(1, 'rgba('+color[0]+','+color[1]+','+color[2]+','+(alpha-0.1)+')');

			fctx2.beginPath();
			fctx2.moveTo(x, y);
			fctx2.lineTo(endX, endY);
			fctx2.lineWidth = 3;
			fctx2.lineCap = 'round';
			fctx2.strokeStyle = gradient;
			fctx2.stroke();
		};

		var drawBack = function(){
			bctx.clearRect(0, 0, wWidth, wHeight);

			var gradient = [];
			
			gradient[0] = bctx.createRadialGradient(wWidth*0.3, wHeight*0.1, 0, wWidth*0.3, wHeight*0.1, wWidth*0.9);
			gradient[0].addColorStop(0, 'rgb(49, 8, 12)');

			bctx.translate(wWidth, 0);
			bctx.scale(-1,1);
			bctx.beginPath();
			bctx.fillStyle = gradient[0];
			bctx.fillRect(0, 0, wWidth, wHeight);
		};

		var animate = function(){
			var sin = M.sin(degree),
				cos = M.cos(degree);

			if (config.circle.amount > 0 && config.circle.layer > 0){
				fctx1.clearRect(0, 0, wWidth, wHeight);
				for (var i=0, len = circles.length; i<len; i++){
					var item = circles[i],
						x = item.x,
						y = item.y,
						radius = item.radius,
						speed = item.speed;

					if (x > wWidth + radius){
						x = -radius;
					} else if (x < -radius){
						x = wWidth + radius
					} else {
						x += sin*speed;
					}

					if (y > wHeight + radius){
						y = -radius;
					} else if (y < -radius){
						y = wHeight + radius;
					} else {
						y -= cos*speed;
					}

					item.x = x;
					item.y = y;
					drawCircle(x, y, radius, item.color, item.alpha);
				}
			}

			if (config.line.amount > 0 && config.line.layer > 0){
				fctx2.clearRect(0, 0, wWidth, wHeight);
				for (var j=0, len = lines.length; j<len; j++){
					var item = lines[j],
						x = item.x,
						y = item.y,
						width = item.width,
						speed = item.speed;

					if (x > wWidth + width * sin){
						x = -width * sin;
					} else if (x < -width * sin){
						x = wWidth + width * sin;
					} else {
						x += sin*speed;
					}

					if (y > wHeight + width * cos){
						y = -width * cos;
					} else if (y < -width * cos){
						y = wHeight + width * cos;
					} else {
						y -= cos*speed;
					}
					
					item.x = x;
					item.y = y;
					drawLine(x, y, width, item.color, item.alpha);
				}
			}

			timer = requestAnimationFrame(animate);
		};

		var createItem = function(){
			circles = [];
			lines = [];

			if (config.circle.amount > 0 && config.circle.layer > 0){
				for (var i=0; i<config.circle.amount/config.circle.layer; i++){
					for (var j=0; j<config.circle.layer; j++){
						circles.push({
							x: M.random() * wWidth,
							y: M.random() * wHeight,
							radius: M.random()*(20+j*5)+(20+j*5),
							color: config.circle.color,
							alpha: M.random()*0.2+(config.circle.alpha-j*0.1),
							speed: config.speed*(1+j*0.5)
						});
					}
				}
			}

			if (config.line.amount > 0 && config.line.layer > 0){
				for (var m=0; m<config.line.amount/config.line.layer; m++){
					for (var n=0; n<config.line.layer; n++){
						lines.push({
							x: M.random() * wWidth,
							y: M.random() * wHeight,
							width: M.random()*(20+n*5)+(20+n*5),
							color: config.line.color,
							alpha: M.random()*0.2+(config.line.alpha-n*0.1),
							speed: config.speed*(1+n*0.5)
						});
					}
				}
			}

			cancelAnimationFrame(timer);
			timer = requestAnimationFrame(animate);
			drawBack();
		};

		$(document).ready(function(){
			setCanvasHeight();
			createItem();
		});
		$(window).resize(function(){
			setCanvasHeight();
			createItem();
		});
	}
})(jQuery); 

$('.owl-carousel').owlCarousel({
    margin:1,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    },
})

$('.members-carousel').owlCarousel({
    dots:true
})

$('.card-img').hover(function() {
    $(this).find('.card-options').show();
})

$('.card-img').mouseleave(function() {
    $(this).find('.card-options').hide();
})

$('.card-img').hover(function() {
    $(this).find('.overlay').show();
})

$('.card-img').mouseleave(function() {
    $(this).find('.overlay').hide();
})

$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar");
    $nav.toggleClass('bg-dark', $(this).scrollTop() > $nav.height());
  });
});

var buttonScroll = $("scroll-up");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementsByClassName("scroll-up")[0].style.display = "block";
  }  else {
    document.getElementsByClassName("scroll-up")[0].style.display = "none";
  }
}

function signInValidateForm() {
    
    var email = $("#signInEmail"),
        password = $("#signInPassword"),
        
        emailLog = $("#signInEmailLog"),
        passwordLog = $("#signInPasswordLog");
    
    email.removeClass("is-invalid");
    password.removeClass("is-invalid");
    
    
     if (email.val() == "") {

            email.addClass("is-invalid");

            emailLog.text("لا تترك الخانة فاضية");

            return false;

        } if (email.val().length > 40 || email.val().length < 6) {

            email.addClass("is-invalid");

            emailLog.text("بريد الكتروني خاطئ");

            return false;

        } if (password.val() == "") {

            password.addClass("is-invalid");

            passwordLog.text("لا تترك الخانة فاضية");

            return false;

        } if (password.val().length > 100 || password.val().length < 4) {

            password.addClass("is-invalid");

            passwordLog.text("الرمز السري خاطئ");

            return false;

        }
    
}

function ticketValidateForm() {
    
    var fullname = document.forms["ticket"]["fullname"].value;
    var email = document.forms["ticket"]["email"].value;
    var type = document.forms["ticket"]["type"].value;
    var subject = document.forms["ticket"]["subject"].value;
    var describe = document.forms["ticket"]["describe"].value;
    
    $("#fullname").removeClass("is-invalid");
    $("#email").removeClass("is-invalid");
    $("#type").removeClass("is-invalid");
    $("#subject").removeClass("is-invalid");
    $("#describe").removeClass("is-invalid");
      

    if (fullname == "") {

        $("#fullname").addClass("is-invalid");

        $("#fullNameLog").text("لا تترك الخانة فاضية");

        return false;

    } if (fullname.length > 25 || fullname.length < 5) {

        $("#fullname").addClass("is-invalid");

        $("#fullNameLog").text("يجب ان يكون الإسم ما بين 5 - 25");

        return false;

    } if (!isNaN(fullname)) {
        
        $("#fullname").addClass("is-invalid");
        
        $("#fullNameLog").text("يمكنك فقط كتابة الأحرف");
        
    } if (email == "") {

        $("#email").addClass("is-invalid");

        $("#emailLog").text("لا تترك الخانة فاضية");

        return false;

    } if (email.length > 40 || email.length < 6) {

        $("#email").addClass("is-invalid");

        $("#emailLog").text("يجب أن يكون البريد الإلكتروني ما بين 6 - 40");

        return false;

    } if (type == "") {

        $("#type").addClass("is-invalid");

        return false;

    } if (subject == "") {

        $("#subject").addClass("is-invalid");

        $("#subjectLog").text("لا تترك الخانة فاضية");

        return false;

    } if (subject.length > 60 || subject.length < 8) {

        $("#subject").addClass("is-invalid");

        $("#subjectLog").text("يجب أن يكون الموضوع ما بين 8 - 60");

        return false;

    } if (describe == "") {

        $("#describe").addClass("is-invalid");

        $("#describeLog").text("لا تترك الخانة فاضية");

        return false;

    } if (describe.length > 350 || describe.length < 60) {

        $("#describe").addClass("is-invalid");

        $("#describeLog").text("يجب أن يكون الوصف ما بين 60 - 360");

        return false;

    }

}

function fifaSelect() {
    "use strict";
    
    var value = document.getElementById("fifaSpecialty").value,
        proClub = document.getElementsByClassName("proClub")[0],
        ultimateTeam = document.getElementsByClassName("ultimateTeam"),
        i;
    
    if (value == "Pro Club") {
        
        for (i = 0; i < ultimateTeam.length; i++) {
            ultimateTeam[i].style.display = "none";
        }
        
        proClub.style.display = "block";
        
    } else if (value == "Ultimate Team") {
        
        proClub.style.display = "none";
        
        for (i = 0; i < ultimateTeam.length; i++) {
            ultimateTeam[i].style.display = "block";
        }
        
    }
    
}

var feed = new Instafeed({
    get: 'tagged',
    tagName: 'awesome',
    clientId: '6235425251',
    template: '<a href="{{link}}"><img src="{{image}}" /></a>'
});
feed.run();