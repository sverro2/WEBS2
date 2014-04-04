
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

        $('#content').on('change', '#cat_edit_namefield', function() {
            var title = $('#cat_edit_namefield').val();
            $('#cat_title').attr('data-title', title);
            $('#cat_title').text(title);
        });

        $('#content').on('click', '#catimg_submit', function() {
            var img = $('#catimg').val();

            img = (img.replace(/^.*[\\\/]/, ''));
            $('#catimg_form').ajaxForm(function(){
                if(img !== ""){
                    $('.categoryimage').attr('data-img', img);
                    $('.categoryimage').attr('style', 'background-image: url("img/' + img + '")');
                }
            }).submit();
        });

        $('#content').on('click', '#aboutedit', function() {
            var text = $('#abouttext').html();
            var regex = /<br\s*[\/]?>/gi;
            text = text.replace(regex, "\n");
            text = text.trim();
            $('#abouttext').html("<textarea id='abouteditor'>" + text + "</textarea>");
            $('#abouttext').append("<input type='submit' value='Cancel' id='aboutcancel'/>");
            $('#abouttext').append("<input type='submit' value='Save' id='aboutsave'/>");
        });
        $('#content').on('click', '#aboutsave', function() {
            var text = $('#abouteditor').val();
            text = text.trim();
            $.ajax(
            {    
                url: 'application/models/save_about.php',
                data: {text: text},           
                type: 'post',
                success: function(output) 
                {
                    location.reload();
                    //alert("The item is added to your shoppingcart!" + output);
                    //location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });

        });
        $('#content').on('click', '#aboutcancel', function() {
            location.reload();
        });



        $('#content').on('click', '#cat_save', function() {
            console.log();
            var title = $('#cat_title').attr('data-title');
            var img = $('.categoryimage').attr('data-img');
            var id = $('.categoryimage').attr('data-id');
            img = (img.replace(/^.*[\\\/]/, ''));
            var url = $('#cat_edit_urlfield').val();
            $.ajax(
            {    
                url: 'application/models/save_category.php',
                data: {title: title, image: img, url: url, id: id},                                //set article amount to one.
                type: 'post',
                success: function(output) 
                {
                    //alert(output);
                    window.location.href = "index.php?route=admin/edit_category/" + output;
                    //alert("The item is added to your shoppingcart!" + output);
                    //location.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError);
                }
            });
        });

        $('#content').on('click', '#cat_delete', function() {
            var id = $('#cat_delete').attr("data-id");
             window.location.href="index.php?route=admin/delete_category/" + id;
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
            if(($(this).text() === "Add to shoppingcart")){
                
                $(this).fadeOut(function(){
                    var id = $(this).data('product');
                    var data = {};
                    data[id] = 1;
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
        
        //all javascript to edit a product
        
        /*code for button events*/
        $('#information_submit').click(function(){
            var save_product = {};
            save_product['upload_info'] = upload_information($(this).data('id'));
            console.log(save_product);
            console.log(JSON.stringify(save_product));  
            $.ajax(
            {    
                url: 'application/models/save_product.php',
                data: {save_product:JSON.stringify(save_product)},                                //set article amount to one.
                type: 'post',
                success: function(output) 
                {
                    alert(output);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Could not save product information: " + thrownError);
                }
            });
        });
        
        $('#submit_description').click(function(){
            var save_product = {};
            save_product['upload_description'] = upload_description($('#submit_description').data('id'));
            console.log(save_product);
            console.log(JSON.stringify(save_product));  
            $.ajax(
            {    
                url: 'application/models/save_product.php',
                data: {save_product:JSON.stringify(save_product)},                                //set article amount to one.
                type: 'post',
                success: function(output) 
                {
                    alert(output);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Could not save description: " + thrownError);
                }
            });
        });
        
        $('#spec_submit').click(function(event){
            event.preventDefault();
            var save_product = {};
            save_product['set_specification'] = upload_spec($(this).data('id'));
            console.log(save_product);
            console.log(JSON.stringify(save_product));  
            $.ajax(
            {    
                url: 'application/models/save_product.php',
                data: {save_product:JSON.stringify(save_product)},                                //set article amount to one.
                type: 'post',
                success: function(output) 
                {
                    alert(output);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Could not save specification: " + thrownError);
                }
            });
        });
        
        /*code to upload stuff*/
        function upload_information(product_id){
            var upload_info = {};
            upload_info['title'] = $('#title_input').val();
            upload_info['fullName'] = $('#full_name_input').val();
            upload_info['category'] = $('#category_input').val();
            upload_info['price'] = $('#price_input').val();
            upload_info['id'] = product_id;
            
            console.log(upload_info);
            return upload_info;
        }
        
        function upload_description(product_id){
            var upload_info = {};
            upload_info['description'] = $('#description').val();
            upload_info['id'] = product_id;
            
            console.log(upload_info);
            return upload_info;
        }
        
        function upload_spec(product_id){
            var upload_info = {};
            upload_info['spec'] = $('#spec_input').val();
            upload_info['value'] = $('#spec_value_input').val();
            upload_info['id'] = product_id;
            
            console.log(upload_info);
            return upload_info;
        }
        

    }
);	

    
function print_crumbs(crumbs){
    $('menu').append('<div id="breadcrumb"></div>');
    for(var i in crumbs)
    {
        var crumb = crumbs[i];
        var url = crumb.url;
        var text = crumb.text;
        if(!url)
        {
            $('#breadcrumb').append('<div class="selected">&gt; ' + crumb.text + '</div>');
        }else{
          $('#breadcrumb').append('<a href="' + crumb['url'] + '"><div class="unselected">&gt; ' + crumb['text'] + '</div></a>');
        }
    }
}