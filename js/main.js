
$(document).ready(
    /* This is the function that will get executed after the DOM is fully loaded */
    function () {
        
        /* Next part of code handles hovering effect and submenu appearing */
        $(document).ready(
            /* This is the function that will get executed after the DOM is fully loaded */
            function () {
                
                /* Next part of code handles hovering effect and submenu appearing */
                $('.nav li').hover(
                    function () {
                        
                        $('ul', this).stop(true).slideDown("fast");
                    },
                    function () {
                        $('ul', this).stop(true).slideUp("fast");
                    }
                );
            }
            );

        $('#content').on('click', '.mediaimg', function() {
            var url = $(this).data('url');
            $('#video').remove();
            $('#mainmedia').html("<img id='mainimg' src='" + url + "'>");
        });

        $('#content').on('click', '.mediavid', function() {
            var url = $(this).data('url');
            console.log('vid');
            $('#mainimg').remove();
            $('#mainmedia').html('<iframe width="300" height="300" id="video" src="//www.youtube.com/embed/' + url + '" frameborder="0" allowfullscreen></iframe>');
        });

        /*
        $('#content').on('click', '.productlink', function() {
            var id = $(this).data('product');
            console.log('vid');
            $('#content').empty();
            $('#content').load('pages/product.php',{id: id})
        });
        //test code
		$('.menuitem').click(function(){
            var page = $(this).data('page');
            var param = $(this).data('parameter');
			$('#content').empty();
			$('#content').load(page, {'parameter': param});
		});
        */

    }
);	