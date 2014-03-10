
$(document).ready(
    /* This is the function that will get executed after the DOM is fully loaded */
    function () {
        
        /* Next part of code handles hovering effect and submenu appearing */
        $('.nav li').hover(
            function () {
                
                $('ul', this).stop(true, true).slideDown();
            },
            function () {
                $('ul', this).stop(true, true).slideUp();
            }
        );

        $('#content').on('mouseover', '.mediaimg', function() {
            var url = $(this).data('url');
            $('#video').remove();
            $('#mainmedia').html("<img id='mainimg' src='" + url + "'>");
        });

        $('#content').on('mouseover', '.mediavid', function() {
            var url = $(this).data('url');
            console.log('vid');
            $('#mainimg').remove();
            $('#mainmedia').html('<iframe width="300" height="300" id="video" src="//www.youtube.com/embed/' + url + '" frameborder="0" allowfullscreen></iframe>');
        });

        //test code
		$('#about').click(function(){
			$('#content').empty();
			$('#content').load('pages/product.php',{id: '1'});
		});


    }
);	