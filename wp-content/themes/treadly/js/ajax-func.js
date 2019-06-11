(function($) {
    useForValues = [];
    levelValues  = [];
    typeValues   = [];
    suspension   = '';
    brake = '';
    frame = '';
    wheelSize = '';
    divertainQuality = '';
    crankSetQuantity = '';
    suspensionLockOutQuantity = '';
    suspensionTravel = '';
    remoteSuspension = '';
    remoteSeat = '';
    kidSeat = '';
    carryBasketTray = '';
    surfaces = [];
    gender = '';
    prices = [300 , 5000];
    owl_carousel_init = false;
    
    var owl_options = {
    		loop:true,
    		margin:30,
    		nav:true,
    		autoplay:false,
    		responsive:{
    			0:{
    				items:1
    			},
    			600:{
    				items:3
    			},
    			1000:{
    				items:3
    			}
		    }
        };

	$(document).on('ready', function( event ) {
		event.preventDefault();
    });
    
    // STOPPING PROPOGATION OF DROP DOWN MENU
    $('.dropdown-menu').on("click", function(e){
      e.stopPropagation();
    });
    		
    // USE FOR CHECK BOXES
    $("input.useForCheckBox").on("click", function(e){
        useForValues = [];
	  	  $("input.useForCheckBox:checked").each(function(){
            console.log(" USE FOR VALUE: " , $(this).val());
            useForValues.push($(this).val())
        });
        
        getProducts();
        //update_UI();
    });
    // USE FOR CHECK BOXES
    $("input.levelCheckBox").on("click", function(e){
        levelValues = [];
	  	  $("input.levelCheckBox:checked").each(function(){
            console.log("LEVEL VALUE: " , $(this).val());
            levelValues.push($(this).val())
        });
        console.log("LEVEL Values: " , levelValues, useForValues , typeValues);
        getProducts();
    });
    // TYPE CHECK BOXES
    $("input.typeCheckBox").on("click", function(e){
      typeValues = [];
      $("input.typeCheckBox:checked").each(function(){
          console.log("TYPE VALUE: " , $(this).val());
          typeValues.push($(this).val())
      });
      console.log("Type Values: " , typeValues, levelValues, useForValues);
      getProducts();
    });

    //HANDLING SUSPENSION OPTION CHANGE EVENT
    $('input[type=radio][name=suspension]').change(function() {
      suspension = '';
      if ($(this).is(':checked')) {
        suspension   = $(this).val();
      }
      console.log("Suspension" , suspension);
      getProducts();
    });

    //HANDLING SUSPENSION OPTION CHANGE EVENT
    $('input[type=radio][name=break]').change(function() {
      brake = '';
      if ($(this).is(':checked')) {
        brake   = $(this).val();
      }
      console.log("Brake" , brake);
      getProducts();
    });

    //HANDLING FRAME OPTION CHANGE EVENT
    $('input[type=radio][name=frame]').change(function() {
      frame = '';
      if ($(this).is(':checked')) {
        frame   = $(this).val();
      }
      console.log("Frame" , frame);
      getProducts();
    });

    //HANDLING WHEEL OPTION CHANGE EVENT
    $('input[type=radio][name=wheel]').change(function() {
      wheel = '';
      if ($(this).is(':checked')) {
        wheel   = $(this).val();
      }
      console.log("Wheel" , wheel);
      getProducts();
    });
    
    //HANDLING WHEEL OPTION CHANGE EVENT
    $('input[type=radio][name=drivetrainquality]').change(function() {
      divertainQuality = '';
      if ($(this).is(':checked')) {
        divertainQuality   = $(this).val();
      }
      console.log("Divertain Quality" , divertainQuality);
      getProducts();
    });

    //HANDLING CRANK SET OPTION CHANGE EVENT
    $('input[type=radio][name=crankset]').change(function() {
      crankSetQuantity = '';
      if ($(this).is(':checked')) {
        crankSetQuantity   = $(this).val();
      }
      console.log("Crank Set" , crankSetQuantity);
      getProducts();
    });

    //HANDLING SUSPENSION LOCK OUT QUANTITY OPTION CHANGE EVENT
    $('input[type=radio][name=slquntity]').change(function() {
      suspensionLockOutQuantity = '';
      if ($(this).is(':checked')) {
        suspensionLockOutQuantity   = $(this).val();
      }
      console.log("Suspension LockOut Quantity" , suspensionLockOutQuantity);
      getProducts();
    });
    

    //HANDLING SUSPENSION TRAVEL OPTION CHANGE EVENT
    $('input[type=radio][name=stravel]').change(function() {
      suspensionTravel = '';
      if ($(this).is(':checked')) {
        suspensionTravel   = $(this).val();
      }
      console.log("Suspension Travel" , suspensionTravel);
      getProducts();
    });   

    //HANDLING REMOTE SUSPENSION OPTION CHANGE EVENT
    $('input[type=radio][name=remotesusp]').change(function() {
      remoteSuspension = '';
      if ($(this).is(':checked')) {
        remoteSuspension   = $(this).val();
      }
      console.log("Remote Suspension" , remoteSuspension);
      getProducts();
    });
    //HANDLING REMOTE SEAT OPTION CHANGE EVENT
    $('input[type=radio][name=remoteseat]').change(function() {
      remoteSeat= '';
      if ($(this).is(':checked')) {
        remoteSeat   = $(this).val();
      }
      console.log("Remote Seat" , remoteSeat);
      getProducts();
    });

    //HANDLING CARRY BASKET OPTION CHANGE EVENT
    $('input[type=radio][name=carry_basket]').change(function() {
      carryBasketTray= '';
      if ($(this).is(':checked')) {
        carryBasketTray = $(this).val();
      }
      console.log("Carry Basket Tray" , carryBasketTray);
      getProducts();
    });

    //HANDLING KID SEAT OPTION CHANGE EVENT
    $('input[type=radio][name=kidseat]').change(function() {
      kidSeat= '';
      if ($(this).is(':checked')) {
        kidSeat = $(this).val();
      }
      console.log("Kid Seat" , kidSeat);
      getProducts();
    });

    //HANDLING GENDER OPTION CHANGE EVENT
    $('input[type=radio][name=gender]').change(function() {
      gender= '';
      if ($(this).is(':checked')) {
        gender = $(this).val();
      }
      console.log("Gender" , gender);
      getProducts();
    });
    
    //HANDLING ON-ROAD CHANGE EVENT
    $("input.onRoad").on("click", function(e){
        surfaces = [];
	  	$("input.onRoad:checked").each(function(){
            surfaces.push($(this).val())
        });
        
        $("input.off_road:checked").each(function(){
            surfaces.push($(this).val())
        });
       console.log("SURFACES ", surfaces);
       getProducts();
    });
    
    //HANDLING OFF-ROAD CHANGE EVENT
    $("input.off_road").on("click", function(e){
        surfaces = [];
	  	$("input.off_road:checked").each(function(){
            surfaces.push($(this).val())
        });
        
        $("input.on_road:checked").each(function(){
            surfaces.push($(this).val())
        });
       
       getProducts();
    });

    
    function rangeInputChangeEventHandler(e) {
        //$("input[type="range"]").unbind('change');
        e.stopImmediatePropagation();
        var rangeGroup = $(this).attr('name'),
        minBtn = $(this).parent().children('.min'),
        maxBtn = $(this).parent().children('.max'),
        range_min = $(this).parent().children('.range_min'),
        range_max = $(this).parent().children('.range_max'),
        minVal = parseInt($(minBtn).val()),
        maxVal = parseInt($(maxBtn).val()),
        origin = $(this).context.className;

        if(origin === 'min' && minVal > maxVal-5){
            console.log('Min Value', maxVal-5);
            $(minBtn).val(maxVal-5);
        }
        var minVal = parseInt($(minBtn).val());
        $(range_min).html('$ ' + minVal);
        
        if(origin === 'max' && maxVal-5 < minVal){
            console.log('Max Value', 5 + minVal);
            $(maxBtn).val(5 + minVal);
        }
        var maxVal = parseInt($(maxBtn).val());
        $(range_max).html('$ ' + maxVal);
        
      setTimeout(() => {
          console.log(prices[0] ,prices[1]);
        if( (minVal > (prices[0] + 5) || minVal < (prices[0] - 5)) || (maxVal > (prices[1] + 5) || maxVal < (prices[1] + 5) )  ) {
            prices[0] = minVal;
            prices[1] = maxVal;
            getProducts();
        }
      }, 500);
    }

    $('input[type="range"]').on( 'change', rangeInputChangeEventHandler);

    
    
    /*
    |----------------------
    |   Appending Stars
    |----------------------
    */
    function appendStars(rating, custom_field, product_id) {
      var stars = '<div class="" custom-field="'+custom_field+'">';
          stars += '<div class="rating-stars">';
          stars += '<ul id="stars">';
           
          stars += '<li class="'+getClass(rating, 1)+'" title="Poor" data-value="1" custom-field="'+custom_field+'" product-id="'+product_id+'">';
          stars += '<i class="fa fa-star fa-fw"></i></li>';
          
          stars += '<li class="'+getClass(rating, 2)+'" title="Fair" data-value="2" custom-field="'+custom_field+'" product-id="'+product_id+'">';
          stars += '<i class="fa fa-star fa-fw"></i></li>';
          
          stars += '<li class="'+getClass(rating, 3)+'" title="Good" data-value="3" custom-field="'+custom_field+'" product-id="'+product_id+'">';
          stars += '<i class="fa fa-star fa-fw"></i></li>';
          
          stars += '<li class="'+getClass(rating, 4)+'" title="Excellent" data-value="4" custom-field="'+custom_field+'" product-id="'+product_id+'">';
          stars += '<i class="fa fa-star fa-fw"></i></li>';
          
          stars += '<li class="'+getClass(rating, 5)+'" title="WOW!!!" data-value="5" custom-field="'+custom_field+'" product-id="'+product_id+'">';
          stars += '<i class="fa fa-star fa-fw"></i></li>';
          
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
    
    
    function countReviews(product){
        var count = 0;
        custom_fields = product.custom_fields;
        if(custom_fields) {
            count += custom_fields.frame.value ? parseInt(custom_fields.frame.value) : parseInt(0) ;
            count += custom_fields.fork.value  ? parseInt(custom_fields.fork.value) : parseInt(0) ;
            count += custom_fields.remote_system.value ? parseInt(custom_fields.remote_system.value) : parseInt(0) ;
            count += custom_fields.bb_set.value ? parseInt(custom_fields.bb_set.value) : parseInt(0) ;
            count += custom_fields.head_set.value ? parseInt(custom_fields.head_set.value) : parseInt(0) ;
            count += custom_fields.hstem.value ? parseInt(custom_fields.hstem.value) : parseInt(0) ;
            count += custom_fields.rear_derailleur.value ? parseInt(custom_fields.rear_derailleur.value) : parseInt(0) ;
            count += custom_fields.shifters.value ? parseInt(custom_fields.shifters.value) : parseInt(0) ;
            count += custom_fields.brakes.value ? parseInt(custom_fields.brakes.value) : parseInt(0) ;
            count += custom_fields.brake_levers.value ? parseInt(custom_fields.brake_levers.value) :parseInt(0) ;
            count += custom_fields.seatpost.value ? parseInt(custom_fields.seatpost.value) : parseInt(0) ;
            count += custom_fields.seat.value ? parseInt(custom_fields.seat.value) : parseInt(0) ;
            count += custom_fields.hub_front.value ? parseInt(custom_fields.hub_front.value) : parseInt(0) ;
            count += custom_fields.hub_rear.value ? parseInt(custom_fields.hub_rear.value) : parseInt(0) ;
            count += custom_fields.chain.value ? parseInt(custom_fields.chain.value) : parseInt(0) ;
            count += custom_fields.chain_guide.value ? parseInt(custom_fields.chain_guide.value) : parseInt(0) ;
            count += custom_fields.cassette.value ? parseInt(custom_fields.cassette.value) : parseInt(0) ;
            count += custom_fields.spokes.value ? parseInt(custom_fields.spokes.value) : parseInt(0) ;
            count += custom_fields.wheel_set.value ? parseInt(custom_fields.wheel_set.value) : parseInt(0) ;
            count += custom_fields.rim.value ? parseInt(custom_fields.rim.value) : parseInt(0) ;
            count += custom_fields.tires.value ? parseInt(custom_fields.tires.value) : parseInt(0) ;
            count += custom_fields.extras.value ? parseInt(custom_fields.extras.value) : parseInt(0) ;
            count += custom_fields.accessories.value ? parseInt(custom_fields.accessories.value) : parseInt(0) ;
            count += custom_fields.weight_in_kg.value ? parseInt(custom_fields.weight_in_kg.value) : parseInt(0) ;
            count += custom_fields.weight_in_lb.value ? parseInt(custom_fields.weight_in_lb.value) : parseInt(0) ;
            count += custom_fields.system_weight.value ? parseInt(custom_fields.system_weight.value) : parseInt(0) ;
            count;
        }
        else 
            count = parseInt(-1);
        
        return count;
    }
    
    /*
    |----------------------
    |  MAKING LOADER
    |---------------------
    */
    function getLoader(){
        var loaderMarkUp = '<div id="loader">';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="dot"></div>';
        loaderMarkUp += '<div class="lading"></div>';
        loaderMarkUp += '</div>';
        return loaderMarkUp;
    }
    
    /*
        =========================================
                GETTING PRODUCTS
        =========================================
    */
    function getProducts(){
       var data = {
        action: 'getProducts',
        query_vars: ajaxFunc.query_vars,
        page: 100,
        status: 'publish',
        type: 'product',
        posts_per_page: 100,
        use_for: useForValues,
        level: levelValues,                
        types: typeValues,
        suspension: suspension,
        brake: brake,
        frame: frame,
        wheelSize: wheelSize,
        divertainQuality: divertainQuality,
        crankSetQuantity: crankSetQuantity,
        suspensionLockOutQuantity: suspensionLockOutQuantity,
        suspensionTravel: suspensionTravel,
        remoteSuspension: remoteSuspension,
        remoteSeat: remoteSeat,
        kidSeat: kidSeat,
        carryBasketTray: carryBasketTray,
        surfaces: surfaces,
        gender: gender ,
        price: prices             
      };
      
     
      
      $.ajax({
            url: ajaxFunc.ajaxurl,
            type: 'post',
            data: data,
            beforeSend: function() {
                $(document).scrollTop();
                $('#allProducts').html('');
                $('#allProducts').append(getLoader());
            },
            success: function(result) {
                
                $('#allProducts #loader').remove();
                
                if($('#allProducts').hasClass('owl-carousel')) {
                    $('#allProducts').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
                    $('#allProducts').find('.owl-stage-outer').children().unwrap();
                    
                    $('#allProducts').addClass('owl-carousel owl-loaded');
                }
                
                var products = jQuery.parseJSON(result);
                var allProducts = products.products;
                
                var html = '';
                allProducts.sort((a, b) => countReviews(a) > countReviews(b) ? -1 : countReviews(a) < countReviews(b) ? 1 : 0);
                
                for(i=0; i< allProducts.length; i++){
                    
                    var product = allProducts[i];
                    /*
                        Frame
                        Fork
                        Rear Shock
                        Remote System
                        Headset
                        Rear Derailleur
                        Shifters
                        Brakes
                        Brake Levers
                        Crankset
                        BB-Set
                        Handlebar
                        H'stem
                        Pedals
                        Seatpost
                        Seat
                        Hub (Front)
                        Chain
                        chainguide
                        Casssete
                        Spokes
                        wheelset
                        Rim
                        Tire
                        Extras
                        accessories
                        Weight in kg
                        Approx. weight in LBS
                        System weight
                    */
                    
                     
                    var frame  = product.description[0];
                    var frame1 = frame.substring(0 , 100);
                    var frame2 = frame.substring(100);
                    
                    var fork  = product.description[1];
                    var fork1 = fork.substring(0 , 100);
                    var fork2 = fork.substring(100);
                    
                    var rear_shock = product.description[2];
                    var rear_shock1 = rear_shock.substring(0 , 100);
                    var rear_shock2 = rear_shock.substring(100);
                    
                    var remote_system= product.description[3];
                    var remote_system1 = remote_system.substring(0 , 100);
                    var remote_system2 = remote_system.substring(100);
                    
                    var headset = product.description[4];
                    var headset1 = headset.substring(0 , 100);
                    var headset2 = headset.substring(100);
                    
                    var rear_derailler  = product.description[5];
                    var rear_derailler1 = rear_derailler.substring(0 , 100);
                    var rear_derailler2 = rear_derailler.substring(100);
                    
                    var shifters  = product.description[6];
                    var shifters1 = shifters.substring(0 , 100);
                    var shifters2 = shifters.substring(100);
                    
                    var brakes   = product.description[7];
                    var brakes1  = brakes.substring(0 , 100);
                    var brakes2  = brakes.substring(100);
                    
                    var brake_levers   = product.description[8];
                    var brake_levers1 = "", brake_levers2 = "";
                    
                    if(brake_levers) {
                        brake_levers1  = brake_levers.substring(0 , 100);
                        brake_levers2  = brake_levers.substring(100);
                    }
                    var crank_set  = product.description[9];
                    var crank_set1 = "", crank_set2 = "";
                    if(crank_set){
                        crank_set1  = crank_set.substring(0 , 100);
                        crank_set2  = crank_set.substring(100);
                    }
                    var bb_set   = product.description[10];
                    var bb_set1 = "" , bb_set2 = "";
                    if(bb_set){
                        bb_set1  = bb_set.substring(0 , 100);
                        bb_set2  = bb_set.substring(100);
                    }
                    
                    var handlebar   = product.description[11];
                    var handlebar1  = "",  handlebar2 = "";
                    if(handlebar){
                        handlebar1  = handlebar.substring(0 , 100);
                        handlebar2  = handlebar.substring(100);
                    }
                    
                    var h_stem   = product.description[12];
                    var h_stem1  = "", h_stem2 = "";
                    if(h_stem){
                        h_stem1  = h_stem.substring(0 , 100);
                        h_stem2  = h_stem.substring(100);
                    }
                    
                    var pedals   = product.description[13];
                    if(pedals){
                        var pedals1  = pedals.substring(0 , 100);
                        var pedals2  = pedals.substring(100);
                    }
                    
                    var seat_post   = product.description[14];
                    var seat_post1  = "" , seat_post2 = "";
                    if(seat_post){
                        seat_post1  = seat_post.substring(0 , 100);
                        seat_post2  = seat_post.substring(100);
                    }
                    
                    var seat   = product.description[15];
                    var seat1  = "", seat2 = "";
                    if(seat){
                        seat1  = seat.substring(0 , 100);
                        seat2  = seat.substring(100);
                    }
                    
                    var hub_front   = product.description[15];
                    var hub_front1 = "", hub_front2 = "";
                    if(hub_front){
                        hub_front1  = hub_front.substring(0 , 100);
                        hub_front2  = hub_front.substring(100);
                    }
                    
                    
                    var hub_rear    = product.description[16];
                    var hub_rear1 = "", hub_reart2 = "";
                    if(hub_rear){
                        hub_rear1   = hub_rear.substring(0 , 100);
                        hub_rear2  = hub_rear.substring(100);
                    }
                    
                    var chain    = product.description[17];
                    var chain1 = "", chain2 = "";
                    if(chain){
                        chain1   = chain.substring(0 , 100);
                        chain2   = chain.substring(100);
                    }
                    
                    var chain_guide    = product.description[18];
                    var chain_guide1 = "" , chain_guide2 = "";
                    if(chain_guide){
                        chain_guide1   = chain_guide.substring(0 , 100);
                        chain_guide2   = chain_guide.substring(100);
                    }
                    
                    var cassete    = product.description[19];
                    var cassete1 = "", cassete2 = "";
                    if(cassete){
                        cassete1   = cassete.substring(0 , 100);
                        cassete2   = cassete.substring(100);
                    }
                    
                    var spokes    = product.description[20];
                    var spokes1 = "", spokes2 = "";
                    if(spokes){
                        spokes1   = spokes.substring(0 , 100);
                        spokes2   = spokes.substring(100);
                    }
                    
                    var wheel_set    = product.description[21];
                    var wheel_set1 = "", wheel_set2 = "";
                    if(wheel_set){
                        wheel_set1   = wheel_set.substring(0 , 100);
                        wheel_set2   = wheel_set.substring(100);
                    }
                    
                    var rim    = product.description[22];
                    var rim1  = "",  rim2 = "";
                    if(rim){
                        rim1   = rim.substring(0 , 100);
                        rim2   = rim.substring(100);
                    }
                    
                    var tire    = product.description[23];
                    var tire1  = "", tire2 = "";
                    if(tire){
                        tire1   = tire.substring(0 , 100);
                        tire2   = tire.substring(100);
                    }
                    
                    var extras    = product.description[24];
                    var extras1  = "", extras2 = "";
                    if(extras){
                       extras1   = extras.substring(0 , 100);
                       extras2   = extras.substring(100);
                    }
                    
                    var accessories    = product.description[25];
                    var accessories1 = "", accessories2 = "";
                    if(accessories){
                        accessories1   = accessories.substring(0 , 100);
                        accessories2   = accessories.substring(100);
                    }
                    
                    var weight_kg    = product.description[26];
                    var weight_kg1 = "", weight_kg2 = "";
                    if(weight_kg){
                        weight_kg1   = weight_kg.substring(0 , 100);
                        weight_kg2   = weight_kg.substring(100);
                    }
                    
                    var weight_lbs    = product.description[27];
                    var weight_lbs1 = "", weight_lbs2 = "";
                    if(weight_lbs){
                        weight_lbs1   = weight_lbs.substring(0 , 100);
                        weight_lbs2   = weight_lbs.substring(100);
                    }
                    
                    var system_weight    = product.description[28];
                    var system_weight1  = "", system_weight2 = "";
                    if(system_weight){
                        system_weight1   = system_weight.substring(0 , 100);
                        system_weight2   = system_weight.substring(100);
                    }
                    
                    var frameRating = 0 , forkRating = 0 , rearShockRating = 0 , remoteSystemRating = 0 , headSetRating = 0 , hStemRating = 0 ,
                        rearDerailleurRating = 0 , shiftersRating = 0 , brakesRating = 0 , brakeLeversRating = 0 ,
                        crankSetRating = 0 , bbSetRating = 0 , handleBarRating = 0 , hstemRating = 0 , pedalsRating = 0 ,
                        seatPostRating = 0 , seatRating = 0 , hubFrontRating = 0 , hubRearRating = 0 , chainRating = 0 ,
                        chainGuideRating = 0 , cassetteRating = 0 , spokesRating = 0 , wheelSetRating = 0 , rimRating = 0 ,
                        tiresRating = 0 , extrasRating = 0 , accessoriesRating = 0 , weightinKGRating = 0 , weightinLBRating = 0 ,
                        systemWeightRating = 0 ;
                        
                    var custom_fields = '';
                    
                    if(product.custom_fields){
                        custom_fields         = product.custom_fields;
                        frameRating           = custom_fields.frame.value;
                        forkRating            = custom_fields.fork.value;
                        remoteSystemRating    = custom_fields.remote_system.value;
                        bbSetRating           = custom_fields.bb_set.value;
                        headSetRating         = custom_fields.head_set.value;
                        hStemRating           = custom_fields.hstem.value;    
                        rearDerailleurRating  = custom_fields.rear_derailleur.value;
                        shiftersRating        = custom_fields.shifters.value;
                        brakesRating          = custom_fields.brakes.value;
                        brakeLeversRating     = custom_fields.brake_levers.value;
                        seatPostRating        = custom_fields.seatpost.value;
                        seatRating            = custom_fields.seat.value;
                        hubFrontRating        = custom_fields.hub_front.value;
                        hubRearRating         = custom_fields.hub_rear.value;
                        chainRating           = custom_fields.chain.value;
                        chainGuideRating      = custom_fields.chain_guide.value;
                        cassetteRating        = custom_fields.cassette.value;
                        spokesRating          = custom_fields.spokes.value;
                        wheelSetRating        = custom_fields.wheel_set.value;
                        rimRating             = custom_fields.rim.value;
                        tiresRating           = custom_fields.tires.value;
                        extrasRating          = custom_fields.extras.value;
                        accessoriesRating     = custom_fields.accessories.value;
                        weightinKGRating      = custom_fields.weight_in_kg.value;
                        weightinLBRating      = custom_fields.weight_in_lb.value;
                        systemWeightRating    = custom_fields.system_weight.value;
                    }
                    
                     html += '<div class="item">';
                     html += '<div class="top product">';
                     html += '<div class="prod-img"> <img src="'+product.image+'" alt="'+product.title+'"></div>';
                     html += '<div class="prod-price">$ <span>'+product.price+'</span></div>';
                     html += '<div class="prod-name"> <span>'+product.title+'</span></div>';
                     html += doComparison(allProducts, i);
                     html += '<div class="description">';
                     
                     if(frame1) {
                        html += appendMore('Frame', frame1, frame2);
                        html += appendStars(frameRating , 'frame' , product.id);
                     }
                     
                     if(fork1){
                         html += appendMore('Fork', fork1, fork2);
                         html += appendStars(forkRating , 'fork' , product.id);
                     }
                      
                     if(rear_shock1){
                        html += appendMore('Rear Shock', rear_shock1, rear_shock2);
                        //html += appendStars(rearShockRating, 'rear_shock');
                     } 
                     
                     if(remote_system1){ 
                        html += appendMore('Remote System', remote_system1, remote_system2);
                        html += appendStars(remoteSystemRating, 'remote_system' , product.id);
                     }
                    
                     if(headset1){  
                         html += appendMore('Headset', headset1, headset2); 
                         html += appendStars(headSetRating, 'head_set' , product.id);
                     }
                      
                     if(rear_derailler1){ 
                         html += appendMore('Rear Derailleur', rear_derailler1, rear_derailler2); 
                         html += appendStars(rearDerailleurRating, 'rear_derailleur' , product.id);
                     }
                      
                     if(shifters1) {
                         html += appendMore('Shifters', shifters1, shifters2); 
                         html += appendStars(shiftersRating, 'shifters' , product.id);
                     }
                      
                    if(brakes1){ 
                        html += appendMore('Brakes', brakes1, brakes2); 
                        html += appendStars(brakesRating, 'brakes' , product.id); 
                    }
                    
                    if(brake_levers1){ 
                        html += appendMore('Brake Leveres', brake_levers1, brake_levers2); 
                        html += appendStars(brakeLeversRating, 'brake_levers' , product.id);
                    }
                    
                    if(crank_set1){ 
                        html += appendMore('Crankset', crank_set1, crank_set2);
                        html += appendStars(crankSetRating, 'crank_set' , product.id); 
                    }
                    
                    if(bb_set1){ 
                        html += appendMore('BB Set', bb_set1, bb_set2); 
                        html += appendStars(bbSetRating, 'bb_set' , product.id); 
                    }
                    
                    if(handlebar1){ 
                        html += appendMore('Handlebar', handlebar1, handlebar2); 
                        html += appendStars(handleBarRating, 'handlebar' , product.id); 
                    }
                    
                    if(h_stem1){ 
                        html += appendMore('H\'stem', h_stem1, h_stem2); 
                        html += appendStars(hStemRating, 'hstem' , product.id); 
                    }
                    
                    if(pedals1){ 
                        html += appendMore('Pedals', pedals1, pedals2); 
                        html += appendStars(pedalsRating, 'pedals' , product.id); 
                    }
                    
                    if(seat_post1){ 
                        html += appendMore('Seatpost', seat_post1, seat_post2); 
                        html += appendStars(seatPostRating, 'seat_post' , product.id); 
                    }
                    
                    if(seat1){ 
                        html += appendMore('Seat', seat1, seat2); 
                        html += appendStars(seatRating, 'seat' , product.id);  
                    }
                    
                    if(hub_front1){ 
                        html += appendMore('Head Front', hub_front1, hub_front2); 
                        html += appendStars(hubFrontRating, 'hub_front' , product.id);  
                    }
                    
                    if(hub_rear1){ 
                       html += appendMore('Hub Rear', hub_rear1, hub_rear2); 
                       html += appendStars(hubRearRating, 'hub_rear' , product.id);   
                    }
                    
                    if(chain1){ 
                        html += appendMore('Chain', chain1, chain2); 
                        html += appendStars(chainRating , 'chain' , product.id);  
                    }
                    
                    if(chain_guide1){ 
                       html += appendMore('Chain Guide', chain_guide1, chain_guide2); 
                       html += appendStars(chainGuideRating , 'chain_guide' , product.id);   
                    }
                    
                    if(cassete1){ 
                       html += appendMore('Cassette', cassete1, cassete2); 
                       html += appendStars(cassetteRating , 'cassette' , product.id);   
                    }
                    
                    if(spokes1){ 
                        html += appendMore('Spokes', spokes1, spokes2); 
                        html += appendStars(spokesRating , 'spokes' , product.id);  
                    }
                    
                    if(wheel_set1){ 
                        html += appendMore('Wheel Set', wheel_set1, wheel_set2); 
                        html += appendStars(wheelSetRating , 'wheel_set' , product.id);  
                    }
                    
                    if(rim1){ 
                        html += appendMore('Rims', rim1, rim2); 
                        html += appendStars(rimRating , 'rim' , product.id);  
                    }
                    
                    if(tire1){ 
                        html += appendMore('Tires', tire1, tire2); 
                        html += appendStars(tiresRating , 'tires' , product.id);  
                    }
                    
                    if(extras1){ 
                        html += appendMore('Extras', extras1, extras2); 
                        html += appendStars(extrasRating , 'extras' , product.id);  
                    }
                    
                     if(accessories1){ 
                        html += appendMore('Accessories', accessories1, accessories2); 
                        html += appendStars(accessoriesRating , 'accessories' , product.id);  
                    }
                    
                    if(weight_kg1){ 
                        html += appendMore('Weight in KG', weight_kg1, weight_kg2); 
                        html += appendStars(weightinKGRating, 'weight_in_kg' , product.id);  
                    }
                    
                    if(weight_lbs1){ 
                        html += appendMore('Weight in LBs', weight_lbs1, weight_lbs2); 
                        html += appendStars(weightinLBRating , 'weight_in_lb' , product.id);  
                    }
                    
                    if(system_weight1){ 
                        html += appendMore('System Weight', system_weight1, system_weight2); 
                        html += appendStars(systemWeightRating, 'system_weight' , product.id);  
                    }

                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                
                function ratingHeadings(){
                    var headings = ['Frame','Fork', 'RemoteSystem', 'BB Set', 'HeadSet','H\'stem', 'Rearderailleur', 'Shifters', 'Brakes', 'Brakelevers', 'Seatpost', 'Seat', 'Hubfront', 'HubRear', 'Chain', 'Chainguide',
                                    'Cassette', 'Spokes', 'Wheelset', 'Rim', 'Tires', 'Extras', 'Accessories', 'Weight-KG', 'Weight-LB', 'System Weight'];
                    var headingsHtml = '';
                    for(var i=0; i< 26; i++){ headingsHtml += '<div class="section-sum">'+ headings[i]+'</div>'; }
                    return headingsHtml;
                }
                
                  var compar_html = '';
            	  compar_html +='<div class="summary-toggle">Comparison Summary';
                  compar_html +='<button id="summary-toggle"><i class="fa fa-chevron-down" aria-hidden="true"></i></button></div>';
                  compar_html +='<div class="summary-comparison-caption">' + ratingHeadings() + '</div>';
                  compar_html +='<div class="container div-pos">';
                  compar_html +='<div class="owl-carousel">';
                  
                
                var result = compar_html + html + '</div></div></div>';
                $("#allProducts").html(result);
                $('.owl-carousel').owlCarousel(owl_options);
                init_Scripts();
                
            },
            error : function(error){
                console.error("ERROR " , error);
                $('#allProducts #loader').remove();
            }
        });
    }
    
    /*
    |--------------------------------------------------------------------
    |   INITIALIZING SCRIPTS FOR DYNAMIC-MARK-UP
    |--------------------------------------------------------------------
    */
    function init_Scripts() { 
      var x = $(".div-pos").offset().left;
      $(".summary-comparison-caption").css('width', x+25)
      $(".summary-comparison, .summary-comparison-caption").hide();
      $("#summary-toggle").click(function(){
      $(".summary-comparison, .summary-comparison-caption").slideToggle();
      $(this).children().toggleClass("fa-chevron-down fa-chevron-up");
      });
      
      $(".wrapper p span").hide();		
      
      $("a.rmore").click(function(){
        console.log("TEXT ", $(this).text().trim());
         if($(this).text().trim() === 'Read More')
            $(this).html('Read Less <i class="fa fa-angle-up" aria-hidden="true"></i>');
        else
            $(this).html('Read More  <i class="fa fa-angle-down" aria-hidden="true"></i>');
            
		$(this).prev('p').children('span').fadeToggle();
	  });
       
      
      
    }
    /*
    |--------------------------------------------------------------------
    |   DOING COMPARISON OF ALL PRODUCTS WITH THE HIGHEST RATED PRODUCT
    |--------------------------------------------------------------------
    */
    function doComparison(products,index) {
        var highestRatingProduct = products[0];
        var currentProduct       = products[index];
        var custom_fields        = ['frame','fork', 'remote_system', 'bb_set', 'head_set', 'hstem', 'rear_derailleur', 'shifters', 'brakes', 'brake_levers', 'seatpost', 'seat', 'hub_front', 'hub_rear', 'chain', 'chain_guide',
                                    'cassette', 'spokes', 'wheel_set', 'rim', 'tires', 'extras', 'accessories', 'weight_in_kg', 'weight_in_lb', 'system_weight' ];
        var comparisonHtml = '';
        if(currentProduct.custom_fields){
            for(var i=0; i < 26; i++){
              if(index === 0){
                comparisonHtml += '<div class="section-sum">' + highestRatingProduct.custom_fields[custom_fields[i]].value + '</div>';
              }
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
            for(var i=0; i < 26; i++){ comparisonHtml += '<div class="section-sum">N/A</div>'; }
            
        return '<div class="summary-comparison">' + comparisonHtml + '</div>';
    }
    
})(jQuery);