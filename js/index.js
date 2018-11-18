$(document).ready(function() {
	// $('#part-1').on('click', function(event) {
	// 	event.preventDefault();
		
	// 	$('html, body').animate({scrollTop: 1500},400);
	// });

	$('.nav a').click(function(event) {
		event.preventDefault();
		console.log("CHAY CHUA CAI DA");
		part = $(this).attr('href'); // lấy id của thẻ h2 tương ứng
		 console.log(part);

		position = $(part).offset().top; // tìm vị trí thẻ h2
		
		// $('#part-1').offset().top;
		// hiệu ứng
		$('html, body').animate({scrollTop: position},1400,'easeOutCubic');
		
	});
});

$(document).ready(function() {
	$('.nav .active').click(function(event) {
		/* Act on the event */
		myWindow = window.open("login.php", "_self");
	});
});
$(document).ready(function() {
	$('.nav .myprofile').click(function(event) {
		/* Act on the event */
		myWindow = window.open("card.php", "_self");
	});
});

$(document).ready(function() {
	$(window).scroll(function(event) {
		var pos_body = $('html,body').scrollTop();
		// console.log(pos_body);
		
		if(pos_body>200){
			$('.back-to-top').addClass('hien-ra');
		}
		else{
			$('.back-to-top').removeClass('hien-ra');
		}
	});
	$('.back-to-top').click(function(event) {
		$('html,body').animate({
			scrollTop: 0},
			1400);
	});
});