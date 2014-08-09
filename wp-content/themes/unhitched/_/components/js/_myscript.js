$(function() {
			// highlight the current nav
		$("#home a:contains('Home')").parent().addClass('active');
		$("#thriving a:contains('Thriving')").parent().addClass('active');
		$("#exfiles a:contains('Ex Files')").parent().addClass('active');
		$("#nycunhitched a:contains('NYC Unhitched')").parent().addClass('active');
		$("#queenmum a:contains('Queen Mum')").parent().addClass('active');
		$("#topten a:contains('Top 10')").parent().addClass('active');

	//make menus drop automatically
	$('ul.nav li.dropdown').hover(function() {
		$('.dropdown-menu', this).fadeIn();
	}, function() {
		$('.dropdown-menu', this).fadeOut('fast');
	}); //hover
	
	// show tool tips
	$("[data-toggle='tooltip']").tooltip({ animation: true});
	
	// Show modal
	$('.modalphotos img').on('click', function() {
		$('#modal').modal({
			show:true,
		});
		var mysrc = this.src.substr(0, this.src.length-7) + '.jpg';
		$('#modalimage').attr('src', mysrc);
		$('#modalimage').on('click', function() {
			$('#modal').modal('hide');
		}); //hide modal
	}); //show modal
	
}); // jQuery is loaded
