<?php 
$countries = array("Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas"
		,"Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands"
		,"Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica"
		,"Cote D Ivoire","Croatia","Cruise Ship","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea"
		,"Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana"
		,"Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India"
		,"Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kuwait","Kyrgyz Republic","Laos","Latvia"
		,"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mauritania"
		,"Mauritius","Mexico","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Namibia","Nepal","Netherlands","Netherlands Antilles","New Caledonia"
		,"New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal"
		,"Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Satellite","Saudi Arabia","Senegal","Serbia","Seychelles"
		,"Sierra Leone","Singapore","Slovakia","Slovenia","South Africa","South Korea","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","St. Lucia","Sudan"
		,"Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia"
		,"Turkey","Turkmenistan","Turks & Caicos","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Venezuela","Vietnam","Virgin Islands (US)"
        ,"Yemen","Zambia","Zimbabwe");

        
$categories = array("Road Bike", "Mountain Bike" , "Cruiser", "Hybrid/Comfort Bike" , "Triathlon/Time Trial Bike",
                    "BMX/Trick Bike", "Commuting Bike" , "Cyclocross Bike", "Track Bike / Fixed Gear", "Tandem",
                    "Folding Bike", "Kids Bike", "Recumbent", "I'm not sure, help me!");

$url = esc_url( $_SERVER['REQUEST_URI']);
$placeholder = site_url() . '/wp-content/uploads/2019/03/placeholder-image.png';

$userName  = is_user_logged_in() ? um_user('display_name') : '';
$userEmail = is_user_logged_in() ? um_user('email') : '';

$disabled  = ($userName && $userEmail) ? 'readonly' : '';

?>
<div class="container" id="reviewForm">
    
    <!--<div class="loading">Loading&#8230;</div>-->    
    <div id="loading" class="hide">
      <div id="loading-content">
         Your review is being uploaded. Depending on the size of the images and video and your internet connection, <br/>
            this may take some time. The screen will change and you will see a confirmation message if successful.<br />
            <span></span>
      </div>
    </div>
    
    <div class="row">
        <div class="col-sm text-center">
            <legend>Review Form</legend>
            <small><?php if(!is_user_logged_in() ) echo '<a href="'. site_url() . '/login">Login</a> or <a href="'. site_url() . '/register">Register</a> to share'; else echo 'Share '; ?> your experience about any bike you have used.</small>
        </div>
    </div>
    <hr>
    <!-- SUCCESS MESSAGE -->
    <div class="row" id="success-message" style="display: none;">        
        <div class="col-sm">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <span class="glyphicon glyphicon-ok"></span> <strong>Success Message</strong>
                <hr class="message-inner-separator">
                <p>Thank you for your review. <br /> 
                Our team is currently out riding, but they have been notified of your very important contribution. <br/>
                Safety is very important here, so a few red lights, and a few crazy drivers, may contribute to a slight delay, 
                but you will be notified by email once your review is approved. <br />
                Thanks and Happy Riding</p>
            </div>
        </div>
    </div>
    <!--./ SUCCESS MESSAGE -->

    <!-- ERROR MESSAGE -->
    <div class="row" id="error-message" style="display: none;">        
        <div class="col-sm" >
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
                <span class="glyphicon glyphicon-hand-right"></span> <strong>Failure Message</strong>
                <hr class="message-inner-separator">
                <p>
                    Sorry! Something went wrong. Please try again. Thanks</p>
            </div>
        </div>            
    </div>
    <!--./ ERROR MESSAGE -->

    <form id="review_form" action="#">
        <h3>Basic Information</h3>
        <section>
            <!-- Brand and Model -->
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="brand">Bike Brand *</label>
                        <input id="brand" name="brand" type="text" class="form-control required" placeholder="Enter brand" value="" <?php if(!$userName && !$userEmail) echo 'readonly'; ?>>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="model">Bike Model *</label>
                        <input id="model" name="model" type="text" class="form-control required" placeholder="Enter model"  value="" <?php if(!$userName && !$userEmail) echo 'readonly'; ?>>
                    </div>
                </div>
            </div>
            <!--./ Brand and Model -->

            <!-- Price and Model -->
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="price">Price (AUD) *</label>
                        <input id="price" name="price" type="number" class="form-control required" placeholder="Enter price you paid new"  value="" <?php if(!$userName && !$userEmail) echo 'readonly'; ?>>
                    </div>
                </div>                
            </div>
            <!--./ Brand and Model -->

            <!-- Category  -->
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select class="custom-select required" id="category" name="category" <?php if(!$userName && !$userEmail) echo 'disabled'; ?>>
                            <?php 
                            echo '<optoin value="select category" disabled selected>Select Category</option>'; 
                            foreach ($categories as $category) {
                                echo '<option value="' . $category . '" $selected>' . $category . '</option>';
                            }
                            
                            ?>
                            
                        </select>
                    </div>
                </div>
            </div>
            <!--./ Category  -->

            
            <!-- Country -->
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="country">Country *</label>
                        <select class="custom-select required" id="country" name="" <?php if(!$userName && !$userEmail) echo 'disabled'; ?>>
                        <?php 
                            echo '<optoin value="select country" disabled selected>Select Country</option>'; 
                            foreach ($countries as $country) {
                                echo '<option value="' . $country . '" $selected>' . $country . '</option>';
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--./ Country -->

            <!-- PostCode -->
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="post_code">Post Code *</label>
                        <input id="post_code" name="post_code" type="text" class="form-control required" placeholder="Enter post code"  value="" <?php if(!$userName && !$userEmail) echo 'readonly'; ?>>
                    </div>
                </div>
            </div>
            <!--./PostCode -->
        </section>
        
        <!-- Rating section -->
        <h3>Rating</h3>
        <section>

            <!-- Bike ratings -->
            <div class="row w-100 mt-3 pl-2">
                <div class="col-sm">
                    <legend for="customRange1">Rate this bike against these categories:</legend>                
                </div>            
            </div>
            
            <!-- Money, Frame, Comfort ratings row starts -->
            <div class="row w-100 mt-1">
        
                <div class="col-sm border-dark border-right">
                    <div class="row ">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Value for money:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="money_star5" name="money_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="money_star4" name="money_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="money_star3" name="money_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="money_star2" name="money_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="money_star1" name="money_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div> 
                        
                    </div>
                </div>
        
                <div class="col-sm border-dark border-right">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Frame:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="frame_star5" name="frame_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="frame_star4" name="frame_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="frame_star3" name="frame_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="frame_star2" name="frame_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="frame_star1" name="frame_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Comfort:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                                <input type="radio" id="comfort_star5" name="comfort_rating" value="5" /><label for="star5" title="5 star">5</label>
                                <input type="radio" id="comfort_star4" name="comfort_rating" value="4" /><label for="star4" title="4 star">4</label>
                                <input type="radio" id="comfort_star3" name="comfort_rating" value="3" /><label for="star3" title="3 star">3</label>
                                <input type="radio" id="comfort_star2" name="comfort_rating" value="2" /><label for="star2" title="2 star">2</label>
                                <input type="radio" id="comfort_star1" name="comfort_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Money, Frame, Comfort ratings row row ends -->
            <hr>
            <!-- Design, Gears, Steering row starts -->
            <div class="row w-100 mt-2">
            
                <div class="col-sm border-dark border-right">
                    <div class="row ">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Design:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="design_star5" name="design_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="design_star4" name="design_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="design_star3" name="design_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="design_star2" name="design_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="design_star1" name="design_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm border-dark border-right">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Gears:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="gears_star5" name="gears_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="gears_star4" name="gears_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="gears_star3" name="gears_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="gears_star2" name="gears_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="gears_star1" name="gears_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                    </div>
                </div>
        
                <div class="col-sm">
                    <div class="row ">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Steering:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="steering_star5" name="steering_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="steering_star4" name="steering_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="steering_star3" name="steering_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="steering_star2" name="steering_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="steering_star1" name="steering_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Design, Gears, Steering row ends -->
            <hr>
            <!-- Wheels, Saddle row starts -->
            <div class="row w-100 mt-2">
        
                <div class="col-sm border-dark border-right">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Wheels:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="wheels_star5" name="wheels_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="wheels_star4" name="wheels_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="wheels_star3" name="wheels_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="wheels_star2" name="wheels_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="wheels_star1" name="wheels_rating" value="1" /><label for="star1" title="1 star">1</label>                   
                        </div>
                    </div>
                </div>

                <div class="col-sm border-dark border-right">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Brakes:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="brakes_star5" name="brakes_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="brakes_star4" name="brakes_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="brakes_star3" name="brakes_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="brakes_star2" name="brakes_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="brakes_star1" name="brakes_rating" value="1" /><label for="star1" title="1 star">1</label>                   
                        </div>
                    </div>
                </div>
        
                <div class="col-sm">
                    <div class="row">
                        
                        <div class="col-sm text-center">
                            <label for="positiveFeedback3">Saddle:</label>
                        </div>
        
                        <div class="w-100"></div>
        
                        <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                            <input type="radio" id="saddle_star5" name="saddle_rating" value="5" /><label for="star5" title="5 star">5</label>
                            <input type="radio" id="saddle_star4" name="saddle_rating" value="4" /><label for="star4" title="4 star">4</label>
                            <input type="radio" id="saddle_star3" name="saddle_rating" value="3" /><label for="star3" title="3 star">3</label>
                            <input type="radio" id="saddle_star2" name="saddle_rating" value="2" /><label for="star2" title="2 star">2</label>
                            <input type="radio" id="saddle_star1" name="saddle_rating" value="1" /><label for="star1" title="1 star">1</label>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Wheels, Saddle row ends -->
            <hr>   

            <!-- Like Slider starts -->
            <div class="row w-100 mt-2 p-1">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="like_level">Overall rating ?</label>
                        <input type="range" class="form-control-range w-100" id="like_level" min="1" max="10" value="1">
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-sm w-100">
                    <span class="pull-left">Hate It</span>
                    <span class="pull-right">Loved It</span>
                </div>
            </div>
            <!-- Like Slider ends -->

        </section>
        <!-- ./ Rating section ends -->

        <!-- Feedback section starts -->
        <h3>Feedback</h3>
        <section>
            <!-- 1st Positive feedback starts -->
            <div class="row w-100 mt-1 pl-2">                
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback1">1st Positive</label>
                        <textarea type="text" class="form-control" id="positiveFeedback1" name="1st_positive_feedback" aria-describedby="feedback1" placeholder="Enter 1st positive feedback"></textarea>
                        <small id="feedback1" class="form-text text-muted">tell us what you liked about this bike.</small>
                    </div>
                </div>
            </div>
            <!-- 1st Positive feedback ends -->

            <!-- 2nd , 3rd Positive Feedback starts -->
            <div class="row w-100 mt-1 pl-2">
                
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback2">2nd Positive</label>
                        <textarea type="text" class="form-control" id="positiveFeedback2" name="2nd_positive_feedback" aria-describedby="feedback2" placeholder="Enter 2nd positive feedback"></textarea>
                        <small id="feedback2" class="form-text text-muted">tell us what you liked about this bike.</small>
                    </div>
                </div>
        
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback3">3rd Positive</label>
                        <textarea type="text" class="form-control" id="positiveFeedback3" name="3rd_positive_feedback" aria-describedby="feedback3" placeholder="Enter 3rd positive feedback"></textarea>
                        <small id="feedback3" class="form-text text-muted">tell us what you liked about this bike.</small>
                    </div>
                </div>
                
            </div>
            <!-- 2nd , 3rd Positive Feedback ends -->
            
            <!-- 1st Negative feedback starts -->
            <div class="row w-100 mt-3 pl-2">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback1">1st Negative</label>
                        <textarea type="text" class="form-control" id="positiveFeedback1" name="1st_negative_feedback" aria-describedby="feedback1" placeholder="Enter 1st negative feedback"></textarea>
                        <small id="feedback1" class="form-text text-muted">tell us what you didn't like about this bike.</small>
                    </div>
                </div>
            </div>
            <!-- 1st Negative feedback ends -->
            
            <!-- 2nd, 3rd Negative feedback starts -->
            <div class="row w-100 mt-3 pl-2">
            
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback2">2nd Negative</label>
                        <textarea type="text" class="form-control" id="positiveFeedback2" name="2nd_negative_feedback" aria-describedby="feedback2" placeholder="Enter 2nd negative feedback"></textarea>
                        <small id="feedback2" class="form-text text-muted">tell us what you didn't like about this bike.</small>
                    </div>
                </div>
        
                <div class="col-sm">
                    <div class="form-group">
                        <label for="positiveFeedback3">3rd Negative</label>
                        <textarea type="text" class="form-control" id="positiveFeedback3" name="3rd_negative_feedback" aria-describedby="feedback3" placeholder="Enter 3rd negative feedback"></textarea>
                        <small id="feedback3" class="form-text text-muted">tell us what you didn't like about this bike.</small>
                    </div>
                </div>

            </div>
            <!-- 2nd, 3rd Negative feedback ends -->
        </section>
        <!-- ./Feedback section ends -->

        <!-- Images section starts -->
        <h3>Images</h3>
        <section>

            <!-- Description of this Section -->
            <div class="row d-flex text-center">
                <div class="col-sm">
                    <h4>Review Images</h4>
                    <p class="text-muted">Please attach 5 photos of your bike using the following sections as a guide. </p>
                </div>
            </div>

            <!-- Bike , Tyres Images -->
            <div class="row">

                <div class="form-group col-sm mr-1">
                    <label class="custom-file-label" for="bike">Full Bike Image</label>
                    <input type="file" class="custom-file-input" id="bike" imageNum="1" name="bike" accept='image/*'>
                    <figure class="figure mt-1 text-center">
                        <img src="<?php echo $placeholder ?>" id='image-1' class="figure-img img-fluid rounded" alt="Suspension">
                        <figcaption class="figure-caption" id="caption-1">Upload full bike image here.</figcaption>
                    </figure>
                </div>
                
                        
                <div class="form-group col-sm ml-1">
                    <label class="custom-file-label" for="tyres">Tyres Image</label>
                    <input type="file" class="custom-file-input" id="tyres" imageNum="2" name="tyres" accept='image/*'>
                    <figure class="figure mt-1">
                        <img src="<?php echo $placeholder ?>" id='image-2' class="figure-img img-fluid rounded" alt="Tyres">
                        <figcaption class="figure-caption" id="caption-5">Upload tyres image here.</figcaption>
                    </figure>
                </div>

            </div>
            <!-- Bike , Tyres Images -->
            <!-- Gears, Handlarbar , Suspension Images -->
            <div class="row">

                <div class="form-group col-sm mr-1">
                    <label class="custom-file-label" for="gears">Gears Image</label>
                    <input type="file" class="custom-file-input" id="gears" imageNum="3" name="gears" accept='image/*'>
                    <figure class="figure mt-1">
                        <img src="<?php echo $placeholder ?>" id='image-3' class="figure-img img-fluid rounded" alt="Suspension" >
                        <figcaption class="figure-caption" id="caption-3">Upload gears image here.</figcaption>
                    </figure>
                </div>    
                
                <div class="form-group col-sm mr-1">
                    <label class="custom-file-label" for="handlebar">Handlebar Image</label>
                    <input type="file" class="custom-file-input" id="handlebar" imageNum="4" name="handlebar" accept='image/*'>
                    <figure class="figure mt-1">
                        <img src="<?php echo $placeholder ?>" id='image-4' class="figure-img img-fluid rounded" alt="Suspension">
                        <figcaption class="figure-caption" id="caption-4">Upload handlebar image here.</figcaption>
                    </figure>
                </div>
                
                <div class="form-group col-sm ml-1">
                    <label class="custom-file-label" for="suspension">Suspension Image</label>
                    <input type="file" class="custom-file-input" id="suspension" imageNum="5" name="suspension" accept='image/*'>
        
                    <figure class="figure mt-1">
                        <img src="<?php echo $placeholder ?>" id='image-5' class="figure-img img-fluid rounded" alt="Suspension">
                        <figcaption class="figure-caption" id="caption-5">Upload suspension image here.</figcaption>
                    </figure>
                </div> 
                
            </div>
            <!-- ./ Gears, Handlarbar , Suspension Images -->
        </section>
        <!-- ./Images section ends -->

        <!-- Video section starts -->
        <h3>Video</h3>
        <section>
            <div class="row w-100 m-2">
                
                <div class="form-group col-sm">
                    <small class="form-text text-muted">Your review must not be longer than 90 seconds. You must cover the following points in this order:
                        <span>
                            <ul>
                                <li>Start your video with the make and model of your bike (“This is my review of the (Brand) (Model)</li>
                                <li>What I don't like</li>
                                <li>What I like</li>
                                <li>Who would this bike be perfect for</li>
                            </ul>
                        </span>
                    </small>
                </div>
                <!-- /. 1st-Col-End -->
                
                <div class="w-100"></div>
                
                <div class="form-group col-sm" id="videoSelection-Col">
                    <label class="custom-file-label" for="review_video">Upload video </label>
                    
                    <input type="file" class="custom-file-input" id="review_video" name="review_video" aria-describedby="" placeholder="Enter bike brand">
                    
                    <div class="text-center" id="demoVideo">
                        <iframe src="https://www.youtube.com/embed/VTjONRThn8s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <br>
                        <small>Not sure what to do? Watch an example here</small>
                    </div>

                    <div class="text-center" id="videoDiv" style="display: none">
                        <video class="img-fluid mt-1" id="videoTag" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" controls="controls">
                            <source src="" type="video/*">
                        </video>
                    </div>
                    
                </div>
                <!-- /. 2nd-Col-End -->
            </div>
            <!-- /. Row-End -->
        </section>
        <!-- ./Video section ends -->

        <!-- Hidden Fields-->
        
        <!-- User's Info starts -->
        <?php                
            $current_user = wp_get_current_user();
        ?>
        <input type="hidden" id="name"  name="name"  value="<?php echo $current_user->display_name; ?>">
        <input type="hidden" id="email" name="email" value="<?php echo $current_user->user_email; ?>">
        <!-- ./User's Info ends -->
        
        <input type="hidden" id="review_likes" name="review_likes" value="0" />
        <input type="hidden" id="review_dislikes" name="review_dislikes" value="0" />
        <!-- /. Hidden Fields-->


    </form>
</div>
		
<?php ?>