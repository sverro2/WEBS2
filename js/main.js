
$(document).ready(
    /* This is the function that will get executed after the DOM is fully loaded */
    function () {
        
        /* Next part of code handles hovering effect and submenu appearing */
        $('.nav li').hover(
            function () {
                
                $('ul', this).slideDown();
            },
            function () {
                $('ul', this).slideUp();
            }
        );

        //test code
		$('#about').click(function(){
			$('#content').empty();
			$('#content').load('pages/product.php',{id: '1'});
		});


    }
);	