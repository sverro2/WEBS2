
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
        
        $('#content').on('click', '#backbutton', function() {
            history.go(-1);
        });

        //action when clicking the commit button on the shoppingcart page
        $('input[name=commit]').click(function(){
            var data = {};
            $('input[type=number]').each(function() { 
                var value = $(this).val();
                var key = $(this).data('product');
                data[key] = value;
            });
            console.log(data);
            
            $.ajax(
            {    
                url: 'application/models/cart_actions.php',
                data: data,                                //set article amount to one.
                type: 'post',
                success: function(output) 
                {
                    //alert("The item is added to your shoppingcart!" + output);
                    location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Could not add the item to your cart: " + thrownError);
                }
            });
        });
        
        //animations and acions shoppingcard button
        $('.add_item_to_shoppingcart').click(function(event){
            event.preventDefault();
            var url = document.location.toString();
            var article_id = url.substring(url.lastIndexOf('/') + 1);         //extract article id from url
            if(($(this).text() === "Add to shoppingcart")){
                
                $(this).fadeOut(function(){
                    var data = {};
                    data[article_id] = 1;
                    $.ajax(
                    {    
                        url: 'application/models/cart_actions.php',
                        data: data,                                //set article amount to one.
                        type: 'post',
                        success: function(output) 
                        {
                            //alert("The item is added to your shoppingcart!" + output);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("Could not add the item to your cart: " + thrownError);
                        }
                    });
                    $(this).text("Item is added").fadeIn();
                });
            }else{
                alert("Item has already been added to cart!");
            }
        });

        $('#searchbar').keyup(function(e){
            if(e.keyCode == 13)
            {
                var pat = $('#searchbar').val();
                window.location.replace('index.php?route=category/search/' + pat);

            }
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