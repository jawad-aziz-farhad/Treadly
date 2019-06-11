(function($) {    
    window.page = window.page || {};

    var reader = {};
    var slice_size = 1000 * 1024;

    $(document).ready(function(){      
        console.log('Steps JS ready.')
        init_jQuery_steps();
        bindEvents();        

        page.variables.ratings = {};
        page.variables.uploaded_files = {};
        
    });     
    
    page.variables = {
        ratings : { money_rating : '', frame_rating : '' , comfort_rating : '' , design_rating : '' , gears_rating : '' , 
                    brakes_rating : '' , steering_rating : '' , wheels_rating : '' , saddle_rating : '' } ,
        form : $('#review_form'),
        uploaded_files : { bike : '' , gears : '' , tyres : '' , handlebar : '' , suspension : '' ,review_video : '' },
        allFiles : [],
        allFilesSize: 0,
        allFilesDone: 0,
        prependedTime: 0,
    }
    /*
    |-------------------
    |  BINDING EVENTS
    |-------------------
    */
    function bindEvents() {
        $('label').on('click', giveRating);
        $('input[type="range"]').on('change', handleRangeSlide);
        $('input[type="file"]').on('change', fileSelection);        
    }    
    /*
    |-----------------------------
    | Handling Rane Slider Events
    |-----------------------------
    */
    function handleRangeSlide(){
        $("label[for='"+$(this).attr('id')+"'] span").text($(this).val());
    }
    /*
    |-----------------------
    | GIVING STAR RATING
    |-----------------------
    */
   function giveRating() {
       if( $(this).hasClass('single-post'))
            return;
        console.log('Rating',$(this).text());
        var name = $(this).parent().find("input").attr('name');
        $(this).prevAll().removeClass('selected').addClass('non-selected');
        $(this).nextAll().removeClass('selected').addClass('non-selected');

        if($(this).text() == 1 && $(this).hasClass('selected') && page.variables.ratings[`${name}`] == $(this).text()){
            $(this).removeClass('selected').addClass('non-selected');
            page.variables.ratings[`${name}`] = 0;
        }
        else{
            $(this).removeClass('non-selected').addClass('selected');
            page.variables.ratings[`${name}`] = $(this).text();
        }
        $(this).nextAll().removeClass('non-selected').addClass('selected'); 
    }
    /*
    |------------------------------------------
    |       FILE SELECTION EVENT HANDLER
    |------------------------------------------
    */
   function fileSelection(e) {
        var fileName = e.target.files[0].name;
        var imageId = $(this).attr('imageNum');        
        if(imageId > -1) {
            if(!fileName.match(/.(jpg|jpeg|png|gif)$/i)){
                window.alert('Please select an image file.');
                return;
            }
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();		        
                reader.onload = function (e) {
                    $('#image-'+ imageId).attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);                
            }
        }        
        else {            
            if(!fileName.match(/.(mp4|mov)$/i)){
                window.alert('Please select a video.');
                return;
            }
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();		        
                reader.onload = function (e) {
                    $('#videoDiv').show();
                    $('#demoVideo').hide();
                    // $('#videoTag').attr('src', e.target.result);
                    // $('#videoDiv video')[0].load();
                }
                reader.readAsDataURL(e.target.files[0]);                
            }
        }    
    }
    /*
    |--------------------------
    | Initialzing JQUERY Steps
    |--------------------------
    */
    function init_jQuery_steps() {

        var form = $("#review_form").show();
        $.validator.addMethod('filesize', function (value, element, arg) {
            if(this.optional(element) || (element.files[0].size <= arg)){
                $("span[for="+$(this).attr("id")+"]").remove();
                return true;
            }else{
                return false;
            }
        });

        form.steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            transitionEffectSpeed: 500,
            stepsOrientation: "vertical",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex || currentIndex == 1)
                {
                    return true;
                }
                
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex){},
            onFinishing: function (event, currentIndex)
            {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
                
            },
            onFinished: function (event, currentIndex)
            {
                page.variables.uploaded_files = {};
                uploadFiles();
            }
        }).validate({            
            highlight: function(element) {                
                jQuery(element).closest('.form-control').addClass('is-invalid');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.form-control').removeClass('is-invalid');
            },
            errorElement: 'span',
            errorClass: 'label label-danger invalid-feedback',
            success: function(label) {                
                label.closest('.form-group').children('.is-invalid').removeClass('is-invalid').addClass('is-valid');
                label.remove();                
            },
            errorPlacement: function(error, element) {
                if(error[0].innerHTML == 'Please enter a value between NaN and NaN.') return;
                element.closest('.form-group').children('.invalid-feedback').remove();
                element.closest('.form-group').append(error);
                if($(element).hasClass('is-valid'))
                $(element).removeClass('is-valid');
                $(element).addClass('is-invalid');
                
            },
            rules: {
                review_video:{
                    required:true,
                    accept:"mp4|mov",
                    filesize: 500000000   //max size 500 MB 
                },
                bike :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 100000000
                },
                tyres:  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 100000000
                },
                gears :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 100000000
                },
                handlebar :  {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 100000000
                },
                suspension : {
                    required: true,
                    accept: 'jpeg|jpg|gif|png',
                    filesize: 100000000
                }
                
            },messages: {
                review_video:{
                    filesize: "File size must be less than 300 MB.",
                    accept  : "Please upload .mp4 or .mov file.",
                    required: "Please upload a review video."
                },
                bike : { filesize: 'File size must be less than 80 MB.', accept  : "Please upload image file."},
                tyres: { filesize: 'File size must be less than 80 MB.', accept  : "Please upload image file."},
                gears: { filesize: 'File size must be less than 80 MB.', accept  : "Please upload image file."},
                handlebar : { filesize: 'File size must be less than 80 MB.', accept  : "Please upload image file."},
                suspension: { filesize: 'File size must be less than 80 MB.', accept  : "Please upload image file."},

            },
        });        
    }

    function putAllFilesintoOne() {    
        page.variables.allFiles = [];   
        page.variables.allFilesSize = 0;
        page.variables.allFilesDone = 0;
        page.variables.prependedTime = new Date().getTime();

        var files = ['bike', 'gears', 'tyres', 'handlebar', 'suspension' , 'review_video'];
        for(var i=0; i<files.length; i++) {
            var file_data = $('input[name="'+files[i]+'"]')[0].files[0];
            file_data['name'] = new Date().getMilliseconds() + file_data['name'];
            page.variables.allFiles.push({ name: files[i], data: file_data }); 
            page.variables.allFilesSize = (page.variables.allFilesSize + file_data.size);
        }
        
    }

    function uploadFiles(){
        console.log('Uploading Files.');
        page.variables.uploaded_files = {};
        showLoader();
        putAllFilesintoOne();
        startUpload();
     }
 
    function startUpload() {
        reader = new FileReader();
        uploadFile( 0 );
    }
    
    function uploadFile( start ) {
        
        var next_slice = start + slice_size + 1;
        var file = page.variables.allFiles[0].data;
        var blob = file.slice( start, next_slice );
        
        reader.onloadend = function( event ) {
            
            if ( event.target.readyState !== FileReader.DONE ) {
                return;
            }
    
           $.ajax( {
				url: reviewForm.review_url,
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {
					action: 'upload_file',
					file_data: event.target.result,
					file: page.variables.prependedTime + file.name,
					file_type: file.type,
					nonce: reviewForm.upload_file_nonce
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					console.log( jqXHR, textStatus, errorThrown );
				},
				success: function( data ) {
				    //console.log('Data',data);
				    var size_done    = start + slice_size;
					var percent_done = Math.floor( ( size_done / file.size ) * 100 );
                    
                    page.variables.allFilesDone = parseInt(page.variables.allFilesDone) + parseInt(blob.size);
                    var total_percent_done = Math.floor( ( page.variables.allFilesDone / page.variables.allFilesSize ) * 100 );
                    var percentage_text = total_percent_done == 100 ? '<strong>we are almost done.</strong>' : '<strong>'+ total_percent_done +' %</strong>';
                    $('#loading-content span').html(percentage_text);
					
					if ( next_slice < file.size ) {
						// Update upload progress
						console.log( 'Uploading File - ' + percent_done + '%' );
						// More to upload, call function recursively
						uploadFile( next_slice );
					} else {
						// Update upload progress
                        var key = page.variables.allFiles[0].name;
                        console.log( 'Upload Completed!' , key , file.name);
                        page.variables.uploaded_files[key] = file.name;
                        page.variables.allFiles.splice(0,1);

                        if(page.variables.allFiles.length > 0)
                            startUpload();
                        else
                            submitForm();
					}
				}
			} );
        };

        reader.readAsDataURL( blob );
    }

    
   /*
   |-------------------
   |  SUBMITTING FORM
   |-------------------
   */
   function submitForm(){

        var form_data = new FormData();

        var form = $('#review_form').serializeArray();
        $.each(form , function (index, input) {
            //console.log(input.name, input.value);
            form_data.append(`${input.name}`, `${input.value}`);
        });
        
        var country = $("#country option:selected").val();
        form_data.append('country', country );
        
        Object.keys(page.variables.uploaded_files).forEach(file => {
            console.log(file, page.variables.uploaded_files[file]);
            form_data.append(file, page.variables.uploaded_files[file]);
        });

        
        for ( var rating in page.variables.ratings ) {
            var val = page.variables.ratings[rating] ? page.variables.ratings[rating] : 0;
            form_data.append(rating, val);
        }

        form_data.append('like_level', $('input[type="range"]').val());

        form_data.append('action', 'submitReviewForm');  
        form_data.append('query_vars', reviewForm.query_vars);  
        form_data.append('nonce', reviewForm.upload_file_nonce);  
        
        $.ajax({
            type: "POST",
            url: reviewForm.review_url,
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: onReviewSuccess,
            error: onReviewError
        });
    }
    /*
    |-----------------
    |  SHOW LOADER
    |-----------------
    */
    function showLoader() {         
        $("#loading").removeClass('hide'); 
        $('#loading-content span').html('<strong>0 %</strong>');
        
    }
    
    function hideLoader(){
        $("#loading").addClass('hide')
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
    |------------------------------------------
    |  HANDLING RESPONSE AFTER FORM SUBMISSION
    |------------------------------------------
    */
   function onReviewSuccess(response) {
       
       hideLoader();
       
       response = jQuery.parseJSON(response);
       console.log('Response', response);
       if(response['post']['success']){
            $('#success-message').show();
            resetForm();
       }
       else
         $('#error-message').show();
    }

    function onReviewError(error){
        hideLoader();
        $('#error-message').show();
        console.error('Error', error);
    }

    /*
    |---------------------------------------
    |  RESETTING FORM TO DEFAULT CONDITION
    |---------------------------------------
    */
    function resetForm() {
       $('#review_form').steps('reset');
       $('#review_form').get(0).reset();
    
        for(var i=1; i<6; i++) {
           $('#image-'+i+'').attr('src','http://localhost:8888/trbr/wp-content/uploads/2019/03/placeholder-image.png');        
        }
        var video = $('#videoDiv video')[0];
        video.src = '';
        video.load();
        $('div.starrating').children('label').css("color", "rgb(204, 204, 204)");
    }

})(jQuery);
