(function($) {
    window.page = window.page || {};
    
    $(document).ready(function(){
        console.log('document is Ready.')
        bindEvents();    
    });    
    /*
    |---------------------
    |  Defining Variables
    |---------------------
    */
    page.variables = {    
        $container : $('.container'),
        $column1   : $('.col-sm'),
        $column2   : $('.col-sm-12'),
        $filterBtn : $('#filterBtn'),
        $searchBtn : $('#searchBtn'),
        $main_contaier: $('#main_container'),
        $navItem: $('.nav-item'),
        $wishListItem: $('.wish-list-item'),
        $filterContainer: $('#filterContainer'),
        levelTitle : '.level_title_',
    
        base_url: 'http://localhost:8888/treadly/wp-content/themes/treadly/',
        surface: [],
        use : [],
        level: [],
        gender: [],
        price: [],
        products: [],
        filteredProducts: [],
        

        owl_options: { loop:true,  margin:30, nav:true, autoplay:false, responsive:{ 0:{ items:1},600:{items:2},1000:{items:2} } },
        
        on_road_surfaces : ['All Rounder' , 'Recreation', 'Cross Country' ],
        off_road_surfaces: ['All Rounder' , 'Dirt Roads' , 'Dirt Jump' , 'Enduro' , 'Trail'],
        
        features : [
            { title: 'Suspension',  name: 'suspension_feature',image : 'suspension.png' , options : [ { text: 'Hardtail', value: 'hardtail' }, { text : 'Full', value: 'full' }] },
            { title: 'Breaks',   name: 'breaks_feature' , image : 'break.png' , options :[ { text:'Disc - Piston', value: 'disc_piston'} ,  {text:'Disc - Mechanical' , value: 'disc_mechanical'}, {text:'Disc - Hydraulic', value: 'disc_hydraulic'}] },
            { title: 'Frame',    name: 'frame_feature' ,  image : 'frame.png' , options : [ { text:'Aluminium', value: 'aluminium' }, { text: 'Carbon', value: 'carbon' }] },
            { title: 'Wheel Size',    name: 'wheel_size_feature' , image : 'wheel.png' , options : [ { text:'27.5 Inch', value: '27.5' } , {text:'29.0 Inch', value: '29.0' } , { text:'Fat / Plus ', value: 'fat/plus' }] },
            { title: 'Drive Train Quality',  name: 'drive_train_quality_feature' ,      image : 'drivertrain.png' , options : [ { text:'Short', value: 'short' }, { text: 'Medium', value: 'medium' }, { text: 'High', value: 'high' }, { text: 'Race', value: 'race' }] },
            { title: 'Crankset Quantity',    name: 'crankset_quantity_feature' ,       image : 'crankset.png' , options : [ { text: 0 , value: 0 } , { text: 1 , value: 1 }, { text: 2, value: 2 }, { text: 3, value: 3 }] },
            { title: 'Suspension Lockout Quantity' , name: 'suspension_lockout_quantity_feature' , image : 'suspension.png' , options : [ { text: 0 , value: 0 } , { text: 1, value: 1 }, { text: 2, value: 2 }, { text: 3, value: 3 }] },
            { title: 'Suspension Travel',         name: 'suspension_travel_feature' , image : 'suspension.png' , options : [ { text:'Short (80-120 mm)', value: 'short' }, { text: 'Medium (120 - 140 mm)', value: 'medium' }, { text: 'Long (140 - 170 mm)', value: 'long' }] },
            { title: 'Remote Suspension',    name: 'remote_suspension_feature' ,      image : 'rc.png' , options : [ { text:'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
            { title: 'Carry Basket', name: 'carray_basket_tray_feature' , image : 'basket.png' , options : [ { text:'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
            { title: 'Remote Seat',       name: 'remote_seat_feature'   , image : 'seat.png' , options : [ { text:'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
            { title: 'Kid Seat',   name: 'kid_seat_feature'   , image : 'baby.png' , options : [ { text:'Yes', value: 'yes' }, { text: 'No', value: 'no' }] },
            
        ], 
        attributes: [ { text: 'Frame' ,     custom_field: 'frame' }, { text: 'Fork', custom_field: 'fork' }, { text: 'Rear Shock', custom_field: 'rear_shock' }, 
                    { text: 'Remote System', custom_field: 'remote_system' }, { text:'Head Set', custom_field: 'headset' }, { text:'Rear Derailleur', custom_field: 'rear_derailleur' }, 
                    { text:'Shifters' , custom_field: 'shifters'}, { text:'Breaks', custom_field: 'breaks' }, { text:'Break Levers', custom_field: 'break_levers' }, 
                    { text:'Crank Set', custom_field: 'crankset' }, { text:'BB Set' , custom_field: 'bb_set' }, { text:'Handlebar', custom_field: 'handlebar' } ,
                    { text:'H\'stem',   custom_field: 'hstem' }, { text:'Pedals', custom_field: 'padals' }, { text:'Seat Post', custom_field: 'seat_post' }, 
                    { text:'Seat',      custom_field: 'seat' } , { text:'Hub Front', custom_field: 'hub_front' } , { text:'Hub Rear', custom_field: 'hub_rear' },
                    { text:'Chain',     custom_field: 'chain' } , { text:'Chain Guide', custom_field: 'chain_guide' }, { text:'Cassete', custom_field: 'cassette' } ,
                    { text:'Spokes',    custom_field: 'spokes' } , { text:'Wheel Set', custom_field: 'wheel_set' }, { text:'Rims', custom_field: 'rims' } , 
                    { text:'Tires' ,     custom_field: 'tires' }, { text:'Extras', custom_field: 'extras' } , { text:'Accessories', custom_field: 'accessories' }, 
                    { text:'Weight in KG', custom_field: 'weight_in_kg' }, { text:'Weight in LB', custom_field: 'weight_in_lb'},
                    { text:'System Weight', custom_field: 'system_weight'}] ,

        

    }
    /*
    |--------------------------------
    |  BINDING EVENTS (hover, click)
    |--------------------------------
    */
    function bindEvents(){
        var variables = page.variables;
    
        variables.$column1.hover(classToggle,  classToggle); 
        variables.$column2.hover(classToggle,  classToggle);
    
        variables.$column1.click('multipleColumn', classToggle);
        variables.$column2.click('singleColumn', classToggle);

        variables.$navItem.click(function(event){
            event.preventDefault();
            $('.nav-link').removeClass('active-text').addClass('text-light');
            
            $(this).find('a').removeClass('text-light').addClass('active-text');
            var item = $(this).find('a').text();
            if(item == 'Home'){
                variables.$column1.children('.card').removeClass('selected-card').addClass('bg-secondary');
                variables.$column2.children('.card').removeClass('selected-card').addClass('bg-secondary');
                variables.$filterContainer.show();
                if(variables.$filterContainer.find('i').hasClass('fa-chevron-up'))
                variables.$filterContainer.find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                resetAllProducts();
            }
            else {
                $('#filterSection').collapse('hide');
                variables.$filterContainer.hide();
                showWishList();
            }            
        });  
    
        variables.$filterBtn.click('togglebtn', classToggle);
    
        variables.$searchBtn.click(variables, getProducts);

        $('select').on('change', handlePrices);  
        
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:0,
            autoplay:true,
            nav:false,
            dots:false,
            autoplayHoverPause: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    }
    /*
    |------------------------------------------
    | CLASS TOGGLING ON HOVER AND CLICK EVENTS
    |------------------------------------------
    */
    function classToggle(event){
        var variables = page.variables;
        /* HOVER EFFECT */
        if(!event.data){
            $(this).find('.card').toggleClass('border-dark border-danger'); 
            $(this).find('div').toggleClass('text-dark text-danger');
        }
        /* SINGLE OPTION SELECTION SURFACE AND GENDER  */
        else if(event.data === 'singleColumn') {
            var section = $(this).attr('section');
            var value   = $(this).find('h6').attr('value');
            if(section === 'gender') {
                $('#gender').find('div').removeClass('selected-card');
                variables.gender.push(value);
            }
            else{
                $('#surface').find('div').removeClass('selected-card');
                variables.surface.push(value);
            }
            $(this).children('.card').toggleClass('selected-card bg-secondary');        
        }
        /* MULTIPLE OPTION SELECTION LEVELS AND USES  */
        else if(event.data === 'multipleColumn') {
            $(this).children('.card').toggleClass('selected-card bg-secondary');
            var section = $(this).attr('section');
            var value   = $(this).find('h6').attr('value');
            if(section === 'usages'){
                var index = variables.use.indexOf(value);
                if(index === -1)
                    variables.use.push(value);
                else
                    variables.use.splice(index,1);
            }
            else {
                var index = page.variables.level.indexOf(value);
                if(index === -1)
                    variables.level.push(value);
                else
                   variables.level.splice(index,1);
            }
        }
        else if(event.data === 'togglebtn')
          $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    }    
    
    /* HANDLING PRICE CHANGE EVENT */
    function handlePrices(){
        var variables = page.variables;
        var price = $(this).children("option:selected").val();
        if($(this).attr('id') === 'minPrice'){
            $.each($("#maxPrice option"), function(){
                var value = $(this).val();           
                if(parseInt(value)){
                    if(parseInt(price) >= parseInt(value))
                        $('#maxPrice option[value="'+value+'"]').attr('disabled','disabled');
                    else 
                        $("#maxPrice option[value=" + value + "]").removeAttr('disabled');            
                }
            });
            variables.price[0] = parseInt(price);
        }
        else
            variables.price[1] = parseInt(price);
    }    
    /*
    |----------------------
    |  MAKING LOADER
    |---------------------
    */
    function getLoader(){
        var loaderMarkUp = '<div id="loader">';
        loaderMarkUp     += '<div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="dot"></div>';
        loaderMarkUp     += '<div class="dot"></div><div class="dot"></div><div class="dot"></div><div class="lading"></div></div>';
        return loaderMarkUp;
    }
    /*
    |---------------------
    |  SHOWING WISH LIST
    |---------------------
    */
    function showWishList() {
        var products = JSON.parse(localStorage.getItem('wishList'));
         
        var variables = page.variables , result$ = '';
        if(products && products.length > 0)
            result$ += '<div class="col-sm" id="products">'+ products_MarkUp(products) +'</div>';
        else
            result$ += '<div class="col-sm" id="products">'+ notFoundMarkUp() +'</div>';
        page.variables.$main_contaier.html(result$);
        if(products && products.length > 0) 
            wishListScript(products);
    }
    /*
    |---------------------
    |  WISH LIST SCRIPT
    |---------------------
    */ 
    function wishListScript(products) {
        for(var i=0 ; i<products.length; i++ ) {
            $("#add_to_wishlist"+i).click(function() {  
                var id      = $(this).attr('id');
                var index   = id.substring( (id.length - 1) );
                var product = products[index];
                console.log(id, index, product);
                var wishList = JSON.parse(window.localStorage.getItem('wishList'));
                if(!wishList) wishList = [];
                var productIndex = wishList.map(function(item) { return item.id; }).indexOf(product.id);;
                if(productIndex == -1){    
                    wishList.push(product);
                    $(this).find('i').removeClass('non-active').addClass('active');
                    $(this).html("<i class='fa fa-star fa-fw active mr-2' aria-hidden='true'></i>Remove from wishlist");
                }
                else{
                    wishList.splice(productIndex, 1);
                    $(this).find('i').removeClass('active').addClass('non-active');
                    $(this).html("<i class='fa fa-star fa-fw non-active mr-2' aria-hidden='true'></i> Add to  wishlist");
                }
                console.log('Wish List' , wishList)
                window.localStorage.setItem('wishList', JSON.stringify(wishList));                                    
            });
        }
        
        $(".summary-comparison, .summary-comparison-caption").hide();
        $("#summary-toggle").click(function(){
            $(".summary-comparison, .summary-comparison-caption").slideToggle();
            $(this).children().toggleClass("fa-chevron-down fa-chevron-up");
        });
        $('.owl-carousel').owlCarousel(page.variables.owl_options);         
    }
     
    /*
    |--------------------------
    |  Resetting All Products
    |--------------------------
    */
    function resetAllProducts(){
        var variables = page.variables;
        var payload = {
            action: 'allPosts',
            query_vars: ajaxFunc.query_vars,
            page: 100,
            status: 'publish',
            type: 'post',
            posts_per_page: 100,
        };
        
        $.ajax({
            url: ajaxFunc.ajaxurl,
            type: 'post',
            data: payload,
            beforeSend: function() {
                $(document).scrollTop();
                variables.$main_contaier.html('');
                variables.$main_contaier.append(getLoader());
            },
            success: function(result) {              
                $('#main_container #loader').remove();
                var products = jQuery.parseJSON(result);
                variables.products = products.products;
                if(!variables.products || variables.products.length == 0){
                    console.error("No Products Found.");
                    var result$ = '<div class="col-12">'+ notFoundMarkUp() +'</div>'
                    variables.$main_contaier.html(result$);
                    return;
                }
                else{
                    variables.$main_contaier.html(getAllProductsMarkUp());
                }
               
            },
            error : function(error){
                console.error("ERROR " , error);
                $('#main_container #loader').remove();
            }
        });
    }
    
    function getAllProductsMarkUp(){
        var html = '';
        for(var i=0; i<page.variables.products.length; i++ ){
           var product = page.variables.products[i];
           html += '<div class="col-md-3">';
           html += '<div class="top product" data-toggle="tooltip" title="'+product.title+'">';
           html += '<div class="prod-img"><img src="'+product.image+'" alt="'+product.title+'"></div>';
           var title = product.title;
           if(title.length < 27 )
             title = title;
           else
             title = title.substring(0 ,24) + '...';
           html += '<div class="prod-name"> <span>'+title+'</span> </div>';
           html += '<div class="prod-price">'; 
           html += '<span>$ '+product.price+'</span> </div>';                        
           html += '</div></div>';
        }
        
        return html;
    }
    
    /*
    |---------------------
    |  GETTING PRODUCTS
    |---------------------
    */
    function getProducts(){
        var variables = page.variables;
        console.log('surface', variables.surface)
        if(variables.surface == 'both')
            variables.surface = ['on_road' , 'off_road'];
        else
            variables.surface = variables.surface.length > 0 ? (variables.surface == 'on_road' ? ['on_road'] : ['off_road'] ) : [];
        
        var payload = {
            action: 'fetchProducts',
            query_vars: ajaxFunc.query_vars,
            page: 100,
            status: 'publish',
            type: 'post',
            posts_per_page: 100,
            
            use: variables.use,
            level: variables.level,                
            surface: variables.surface ,
            gender: variables.gender ,
            price: variables.price           
        };
        console.log('Payload', payload);
        $.ajax({
            url: ajaxFunc.ajaxurl,
            type: 'post',
            data: payload,
            beforeSend: function() {
                $(document).scrollTop();
                $('#main_container').html('');
                $('#filterSection').collapse('toggle');
                $('#main_container').append(getLoader());
            },
            success: function(result) {              
                $('#main_container #loader').remove();
                //console.log("Result", result);
                var products = jQuery.parseJSON(result);
                variables.products = products.products;
                if(!variables.products || variables.products.length == 0){
                    console.error("No Products Found.");
                    var result$ = '<div class="col-12">'+ notFoundMarkUp() +'</div>'
                    variables.$main_contaier.html(result$);
                    return;
                }
                console.log('Products', variables.products);
                variables.products.sort((a, b) => countReviews(a) > countReviews(b) ? -1 : countReviews(a) < countReviews(b) ? 1 : 0);
                makeMarkUp(variables.products);
            },
            error : function(error){
                console.error("ERROR " , error);
                $('#main_container #loader').remove();
            }
        });
    }
    /*
    |---------------------------
    |   APPLYING SECOND FILTER
    |---------------------------
    */
    function applySecondFilter(){
        $('#products').html('');
        var secondFilterValues =  {};
        page.variables.features.forEach(feature => { secondFilterValues[feature.name] = $('select#'+feature.name).children("option:selected").val(); });
        console.log("Selected Filters ", secondFilterValues);
        page.variables.filteredProducts = [];
        page.variables.filteredProducts = page.variables.products.filter(product => {
           var isExist = false;
           isExist = product.custom_fields['suspension_feature'].value == secondFilterValues['suspension_feature'] &&
                    product.custom_fields['breaks_feature'].value     == secondFilterValues['breaks_feature'] &&
                    product.custom_fields['frame_feature'].value      == secondFilterValues['frame_feature'] &&
                    product.custom_fields['crankset_quantity_feature'].value      == secondFilterValues['crankset_quantity_feature'] &&
                    product.custom_fields['suspension_lockout_quantity_feature'].value == secondFilterValues['suspension_lockout_quantity_feature'] &&
                    product.custom_fields['suspension_travel_feature'].value  == secondFilterValues['suspension_travel_feature'] &&
                    product.custom_fields['remote_suspension_feature'].value  == secondFilterValues['remote_suspension_feature'] &&
                    product.custom_fields['carray_basket_tray_feature'].value == secondFilterValues['carray_basket_tray_feature'] &&
                    product.custom_fields['remote_seat_feature'].value        == secondFilterValues['remote_seat_feature'] &&
                    product.custom_fields['kid_seat_feature'].value           == secondFilterValues['kid_seat_feature'];

            if(isExist){
                var wheelsize  = product.custom_fields['wheel_size_feature'].value;
                var trainQuality = product.custom_fields['drive_train_quality_feature'].value;
                for(var i=0 ; i< wheelsize.length; i++){
                    if ( wheelsize[i] == secondFilterValues['wheel_size_feature']) {
                        isExist = true;
                        break;
                    }
                    else
                        isExist = false;
                }
                for(var i=0 ; i< trainQuality.length; i++){
                    if ( trainQuality[i] == secondFilterValues['drive_train_quality_feature']) {
                        isExist = true;
                        break;
                    }
                    else
                        isExist = false;
                }
            }
            return isExist;

        });
        var result$ = '';
        if(page.variables.filteredProducts.length > 0)
            result$ = products_MarkUp(page.variables.filteredProducts);
        else
            result$ = notFoundMarkUp();
        
        $('#products').html(result$);
        $('.owl-carousel').owlCarousel(page.variables.owl_options);
        init_Scripts();
    }
    /*
    |-------------------------
    |  Applying Second Filter
    |-------------------------
    */
    function secondFilter(){
        var variables = page.variables;
        var features = '' , feature_row = ''; 
        for(var i=0; i<variables.features.length; i++){
            var feature = variables.features[i];
            features += '<div class="row vertical-align mt-3">';
            features += '<div class="col-2 d-flex justify-content-center align-items-center">';
            features += '<div class="icon-lable"><img class="img-fluid" src="'+ variables.base_url + 'images/' +feature.image+'" alt="'+feature.title+'">';
            features += '<span>'+ feature.title +'</span>';
            features += '</div>';
            features += '</div>';
    
            features += '<div class="col-10 d-flex justify-content-center align-items-center">';
            features += '<select id="'+feature.name+'" class="w-100">';
            var options ='';
            for(var j=0; j<feature.options.length; j++){  options += '<option value="'+feature.options[j].value+'">'+feature.options[j].text+'</option>';}
            features += options;
            features += '</select>';
            features += '</div>';
            features += '</div>';
        }
        features += '<div class="row vertical-align mt-3"><div class="col"><button class="btn btn-block full-specs" id="secondFilterBtn">Apply Second Filter</button></div></div>';
        feature_row = '<div class="col">' + features + '</div>';
        return feature_row;
    }    
    /*
    |----------------------------------------
    |   MAKING MARK-UP FOR FILTERED PRODUCTS
    |----------------------------------------
    */
    function makeMarkUp(products) {
        var variables = page.variables;
        var result$ = '<div class="row mt-2 w-100">'+ secondFilter();
        if(products.length > 0)
            result$ += '<div class="col-9 ml-10" id="products">'+ products_MarkUp(products) +'</div>';
        else
            result$ += '<div class="col-9" id="products" style="margin-left:20px;">'+ notFoundMarkUp() +'</div>'
        
        result$ +='</div>';

        variables.$main_contaier.html(result$);
        init_Scripts();
        $('.owl-carousel').owlCarousel(variables.owl_options);
        
    }
    /*
    |---------------------------
    |   MAKING PRODUCTS MARK-UP
    |---------------------------
    */
    function productsMarkUp(products){

        var html = '', variables = page.variables;

        for(i=0; i< products.length; i++) {     
            var product = products[i];
            
            html += '<div class="item">';
            html += '<div class="top product">';

            html += '<div class="percentage-match"><div class="section-sum mt-3" style="font-size: 30px;"> 93 % </div></div>';

            html += '<hr><div class="prod-name"> <span>'+product.title+'</span></div>'; 

            html += '<hr><div class="prod-img"> <img src="'+product.image+'" alt="'+product.title+'"></div>';
            html += doComparison(products, i);  
            
            html += '<hr style="margin-top:40px;">';
            html += '<div class="row vertical-align">';
            
            html += '<div class="col-6 text-left">';
            html += '<ul>';
            var formatted = function(value){ return value.substring(0,1).toUpperCase() + value.substring(1); }
            html += '<li>'+ formatted(product.custom_fields.suspension_feature.value)+'</il>';
            html += '<li>'+ formatted(product.custom_fields.frame_feature.value) +'</il>';
            var sex = '';
            var gender = product.custom_fields.gender_feature;
            if(gender.value.length > 0){                
                for(var j=0 ; j<gender.value.length; j++){ 
                    sex += gender.choices[gender.value[j]];
                    if(gender.value.length > (j + 1)) sex += ' , ';
                }
            }
            html += '<li>'+ sex +'</il>';
            html += '</ul>';
            html += '</div>';
        
            html += '<hr>';
            html += '<div class="col-6"><div class="border-dark"> ';
            html += '<div class="prod-price">$ <span>'+product.price+'</span></div>';
            html += '</div></div>';
            
            html += '</div>';
            // 1st Row Ends
            html += '<hr>';
        
            // 2nd Row Starts
            html += '<div class="row vertical-align">';
            
            html += '<div class="col-6">';
            html += '<h6>Level: </h6>';
            html += '</div>';
            html += '<hr>';
            html += '<div class="col-6 text-center level-rating">';
            for(var j=1; j<6;j++){   
                var class_name =  product.custom_fields.bike_level_feature  ? ( j <= parseInt(product.custom_fields.bike_level_feature.value) ? 'active' : 'non-active' ) : 'non-active' ;    
                html += '<i class="fa fa-star p-1 '+class_name+'"></i>';
            }
            html += '</div>';
            
            html += '</div>';
            // 2nd Row Ends
            html += '<hr>';
        
            // 3rd Row Starts
            if(product.custom_fields.surface_value1_feature && product.custom_fields.surface_value1_feature.value){
                
                html += '<div class="row vertical-align">';
                html += '<div class="col-6">';
                html += '<h6> Surface: </h6> ';
                html += '</div>';
                html += '<div class="col-6 text-left">';
                html += '<ul>';
                for(var j=1; j < 6; j++){ 
                    if(product.custom_fields["surface_value"+ j + "_feature"] && product.custom_fields["surface_value"+ j + "_feature"].value) {
                    var value = product.custom_fields["surface_value"+ j + "_feature"].value;
                     html += '<li>'+ value +'</il>';
                    }
                }
                html += '</ul>';
                html += '</div>';
                
                html += '</div>';
                
                html += '<hr>';
            }
            // 3rd Row Ends
        
            // 4th Row Starts
            html += '<div class="row vertical-align">';
            
            html += '<div class="col-7">';
        
            html += '<div class="level-rating wish-list-item" id="add_to_wishlist'+i+'" index="'+i+'">';
            if(isAlreadyInWishList(product))
                html += '<i class="fa fa-star fa-fw active mr-2"></i>Remove from wishlist';
            else
                html += '<i class="fa fa-star fa-fw non-active mr-2"></i>Add to wishlist';
            html += '</div></div>';
            
            html += '<div class="col-5">';
            html += '<div>';
            html += '<button class="btn full-specs" id="fullSpecs'+i+'" data-target="#descSection'+i+'" data-toggle="collapse" aria-expanded="false" aria-controls="descSection'+i+'">Full Specs</button>';
            html += '</div></div>';
            
            html += '</div>';
            // 4th Row Ends
            html += '<hr>';            

            //description section starts
            html += '<div class="collapse" id="descSection'+i+'">';
            html += '<div class="description">';
            for(var j=0; j<variables.attributes.length; j++){
                var attribute$ = variables.attributes[j];
                var details$   = attribute$.custom_field + '_details';
                var rating$    = attribute$.custom_field + '_rating';
                if(product.custom_fields[`${details$}`] && product.custom_fields[`${details$}`].value) {
                    html += appendMore(attribute$.text , product.custom_fields[`${details$}`].value.substring(0,100),  product.custom_fields[`${details$}`].value.substring(100));
                    var rating = product.custom_fields[rating$] ? product.custom_fields[rating$].value : '0';
                    html += appendStars(rating , rating$ , product.id);
                }                
            }
            html += '</div></div>'; //description section ends
            html += '</div>';
            html += '</div>';
        }
        
        function headings() {
            var headings = ['Frame', 'Componentry' ,'Tires'];
            var headingsHtml = '';
            for(var i=0; i< headings.length; i++){ headingsHtml += '<div class="section-sum"><h5>'+ headings[i]+'</h5></div>'; }
            return headingsHtml;
        }    
        var compar_html = '';
        compar_html +='<div class="summary-toggle">Quick Comparison';
        compar_html +='<button id="summary-toggle"><i class="fa fa-chevron-down" aria-hidden="true"></i></button></div>';
        compar_html +='<div class="summary-comparison-caption">' + headings() + '</div>';
        
        var result =  compar_html + '<div class="container div-pos"><div class="owl-carousel" id="products-carousel">'+  html + '</div></div>';

        return result;
    }

    function products_MarkUp(products){

        var html = '<div class="row">';

        html += '<div class="col-12">';
        
        html +='<div class="match-toggle">Match';
       //html +='<button id="match-toggle"><i class="fa fa-chevron-down" aria-hidden="true"></i></button></div>';
        html += '</div>';

        html += '<div class="w-100"></div>';

        html += '<div class="col text-center">';
        html += productsMarkUp(products);
        html += '</div>';

        html += '</div>';

       return html;
    }
    /*
    |------------------------------------
    |   MAKING NO-PRODUCTS FOUND MARK-UP
    |------------------------------------
    */
    function notFoundMarkUp(){
        var html = '<hr><div class="prod-img"> <img src="'+page.variables.base_url+'images/empty_product.svg" alt="No_Product"></div>'; 
            html += '<hr><div class="prod-name"> <span>Sorry! No Product Found.</span></div>'; 
        return html;
    }    
    /*
    |----------------------
    |   Appending Stars
    |----------------------
    */
    function appendStars(rating, custom_field, product_id) {
        var _class = custom_field === 'test' ? ' small-fa' : '';
        var stars = '<div class="" custom-field="'+custom_field+'">';
        stars += '<div class="rating-stars">';
        stars += '<ul id="stars">';
        for(var i=1; i<6; i++){
            stars += '<li class="'+getClass(rating, i)+'" title="Poor" data-value="1" custom-field="'+custom_field+'" product-id="'+product_id+'">';
            stars += '<i class="fa fa-star fa-fw'+ _class +'"></i></li>';
        }    
        stars += '</ul>';
        stars += '</div></div>';
        
        return stars;
    }  
    /*
    |-----------------------------------------
    |   Adding Class base on the Given Rating
    |----------------------------------------
    */
    function getClass(rating , index){
        rating = parseInt(rating);
        index  = parseInt(index);
        return rating === 0 ? 'star' : ( index <= rating ? 'star selected' : 'star');
    }    
    /*
    |----------------------
    |   Appending More
    |----------------------
    */
    function appendMore(heading, value1, value2) {
        var more = "<h4>"+ heading +"</h4>";
            more += "<p>"+ value1;
        if(value2)
            more += '<span>'+ value2 +'</span><a href="javascript:void(0)" class="rmore">Read More <i class="fa fa-angle-down" aria-hidden="true"></i></a></p>';
        else
            more += '</p>';
        return more;
    }    
    /*
    |----------------------
    |  Counting Reviews
    |----------------------
    */
    function countReviews(product){
        var count = 0;
        custom_fields = product.custom_fields;
        if(custom_fields) {
            for(var i=0; i<page.variables.attributes.length; i++){
            var custom_field = page.variables.attributes[i].custom_field;
            if(custom_fields[custom_field])
                count += custom_fields[custom_field].value ? parseInt(custom_fields[custom_field].value) : parseInt(0) ;            
            }         
        }
        else 
            count = parseInt(-1);              
        return count;
    }    
    /*
    |--------------------------------------------------------------------
    |   INITIALIZING SCRIPTS FOR DYNAMIC-MARK-UP
    |--------------------------------------------------------------------
    */
    function init_Scripts() {
        if( $("#products").offset()){
            var x =  $("#products").offset().left;
            $(".summary-comparison, .summary-comparison-caption").hide();

            $("#summary-toggle").click(function(){
                $(".summary-comparison, .summary-comparison-caption").slideToggle();
                $(this).children().toggleClass("fa-chevron-down fa-chevron-up");
            });
            /*
            $("#match-toggle").children().toggleClass("fa-chevron-down fa-chevron-up");
            $("#match-toggle").click(function(){
                var top = $('.summary-toggle').css('top');
                var newtop = ( top == '255px' ) ? 310 : 255;
                $(".percentage-match").slideToggle();
                $('.summary-toggle').animate({'top' : newtop + 'px'});
                $(this).children().toggleClass("fa-chevron-down fa-chevron-up");
            });
            */
        }

        $(".wrapper p span").hide();	
        
        page.variables.$wishListItem.click(function(){
            console.log('wisht List item clicked');
            alert($(this).attr('index'));
        });
    

        page.variables.$filterBtn.find('i').toggleClass('fa-chevron-down fa-chevron-up');
        
        $("a.rmore").click(function(){
            if($(this).text().trim() === 'Read More')
                $(this).html('Read Less <i class="fa fa-angle-up" aria-hidden="true"></i>');
            else
                $(this).html('Read More  <i class="fa fa-angle-down" aria-hidden="true"></i>');
            $(this).prev('p').children('span').fadeToggle();
        });

        $("#secondFilterBtn").click(function(){  applySecondFilter(); });

        for(var i=0 ; i<page.variables.products.length; i++ ) {
            $("#add_to_wishlist"+i).click(function() {  
                var id      = $(this).attr('id');
                var index   = id.substring( (id.length - 1) );
                var product = page.variables.products[index];
                var wishList = JSON.parse(window.localStorage.getItem('wishList'));
                if(!wishList) wishList = [];
                var productIndex = wishList.map(function(item) { return item.id; }).indexOf(product.id);;
                if(productIndex == -1){    
                    wishList.push(product);
                    $(this).find('i').removeClass('non-active').addClass('active');
                    $(this).html("<i class='fa fa-star fa-fw active mr-2' aria-hidden='true'></i>Remove from wishlist");
                }
                else{
                    wishList.splice(productIndex, 1);
                    $(this).find('i').removeClass('active').addClass('non-active');
                    $(this).html("<i class='fa fa-star fa-fw non-active mr-2' aria-hidden='true'></i> Add to  wishlist");
                }
                window.localStorage.setItem('wishList', JSON.stringify(wishList));                                    
             });
            
        }
    }
    
    function isAlreadyInWishList(post){
        var wishList = JSON.parse(window.localStorage.getItem('wishList'));
        if(!wishList) return false;
        var postIndex = wishList.map(function(item) { return item.id; }).indexOf(post.id);;
        if(postIndex == -1) return false
        else return true;
    }
    /*
    |--------------------------------------------------------------------
    |   DOING COMPARISON OF ALL PRODUCTS WITH THE HIGHEST RATED PRODUCT
    |--------------------------------------------------------------------
    */
    function doComparison(products,index) {
        var highestRatingProduct = products[0];
        var currentProduct = products[index];
        var custom_fields  = ['frame_rating', 'tires_rating', 'extras_rating' ];
        var comparisonHtml = '';
        if(currentProduct.custom_fields) {
            for(var i=0; i < custom_fields.length; i++) {
                if(index === 0)
                    comparisonHtml += '<div class="section-sum">' + highestRatingProduct.custom_fields[custom_fields[i]].value + '</div>';
                else {
                    if(currentProduct.custom_fields[custom_fields[i]].value > highestRatingProduct.custom_fields[custom_fields[i]].value)
                        comparisonHtml += '<div class="section-sum"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>';
                    else if(currentProduct.custom_fields[custom_fields[i]].value < highestRatingProduct.custom_fields[custom_fields[i]].value)
                        comparisonHtml += '<div class="section-sum"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>';
                    else
                        comparisonHtml += '<div class="section-sum">same</div>';
                    }
            }
        }    
        else
            for(var i=0; i < 3; i++){ comparisonHtml += '<div class="section-sum">N/A</div>'; }    

        return '<div class="summary-comparison col-sm mt-5" style="max-width: 70%;">' + comparisonHtml + '</div>';
    }    
    })(jQuery);