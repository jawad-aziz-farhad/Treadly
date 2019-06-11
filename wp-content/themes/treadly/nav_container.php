<div class="information">
	<div class="container">
    	<div class="row">
    		<div class="col-md-3">
            	<div class="catagories">
            		<h3>Find a Bike</h3>
                </div>
        </div>
    		<div class="col-md-9">
          <nav class="navbar navbar-inverse">
                  <div class="row">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bicycle" aria-hidden="true"></i> Why a new bike? <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li>
                                <label class="con test">Transport (Daily Ride)
                                  <input type="checkbox" class="useForCheckBox" value="Transport (daily ride)">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Compete/Race
                                  <input type="checkbox" class="useForCheckBox" value="Compete">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Recreation/Leisure
                                  <input type="checkbox" class="useForCheckBox" value="Recreation / Leasure">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Ride with Family
                                  <input type="checkbox" class="useForCheckBox" value="Ride with family">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">General Health and Fitness
                                  <input type="checkbox" class="useForCheckBox" value="General Health and Fitness">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Hit the Trails
                                  <input type="checkbox" class="useForCheckBox" value="Hit the trails">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">A new hobby
                                  <input type="checkbox" class="useForCheckBox" value="A new hobby">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-smile-o" aria-hidden="true"></i> Level <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li>
                                <label class="con">It's my first time
                                  <input type="checkbox" class="levelCheckBox" value="Its my First Time">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Just getting back into it
                                  <input type="checkbox" class="levelCheckBox"  value="Just getting back into it">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Weekend Warrier
                                  <input type="checkbox" class="levelCheckBox" value="Weekend Warrier">
                                  <span class="checkmark"></span>
                                </label>
                            </li> 
                            <li>
                                <label class="con">A bit serious
                                  <input type="checkbox" class="levelCheckBox" value="A bit Serious">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Serious
                                  <input type="checkbox" class="levelCheckBox" value="Serious">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">Very serious
                                  <input type="checkbox" class="levelCheckBox" value="Very Serious">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con">It's in my blood
                                  <input type="checkbox" class="levelCheckBox" value="It'sin my blood">
                                  <span class="checkmark"></span>
                                </label>
                            </li>
                          </ul>
                        </li>
                        <?php 
                          $uploads = wp_upload_dir(); 
                          $baseUrl = esc_url($uploads['baseurl']) . '/2018/10/';
                        ?>

                        
                        <!-- DROW DOWN FOR SURFACE -->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-sliders" aria-hidden="true"></i> Surface <span class="caret"></span></a>
                          <ul class="dropdown-menu bc-type container">
                              
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'cat1.jpg')?>" alt="">
                                        <span>ON-ROAD</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> Race Endurance
                                      <input type="checkbox" class="onRoad" value="Race Endurance">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con"> Triathlon
                                      <input type="checkbox" class="onRoad" value="Triathlon">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con"> City/Bike Path 
                                      <input type="checkbox" class="onRoad" value="City/Bike PathAll-Rounder">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> All-Rounder 
                                      <input type="checkbox" class="onRoad" value="City/Bike PathAll-Rounder">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> Recreation 
                                      <input type="checkbox" class="onRoad" value="Recreation">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                            
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'cat2.jpg')?>" alt="OFF-ROAD">
                                        <span>OFF-ROAD</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> Country & Dirt Roads
                                      <input type="checkbox" class="off_road" value="Country & Dirt Roads">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con"> Trail
                                      <input type="checkbox" class="off_road" value="Trail">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> Downhill / Dirt Jump
                                      <input type="checkbox" class="off_road" value="DOWNHILL / DIRT JUMP">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con"> Cross Country
                                      <input type="checkbox" class="off_road" value="CROSS-COUNTRY">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con"> Recreation
                                      <input type="checkbox" class="off_road" value="Recreation">
                                      <span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                          </ul>
                        </li>


                        
                        <!-- DROP DOWN FOR GENDER-->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-male" aria-hidden="true"></i> Sex <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li>
                                <label class="con rad"><i class="fa fa-male" aria-hidden="true"></i> Male
                                  <input type="radio" name="gender" value="Male">
                                  <span class="checkmark rad"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con rad"><i class="fa fa-female" aria-hidden="true"></i> Female
                                  <input type="radio" name="gender" value="FeMale">
                                  <span class="checkmark rad"></span>
                                </label>
                            </li>
                            <li>
                                <label class="con rad"><i class="fa fa-male" aria-hidden="true"></i> <i class="fa fa-female" aria-hidden="true"></i> I don't mind
                                  <input type="radio" name="gender" value="Unisex">
                                  <span class="checkmark rad"></span>
                                </label>
                            </li>
                          </ul>
                        </li>
                        
                        <!-- DROP DOWN FOR BUDGET -->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-usd" aria-hidden="true"></i> Budget <span class="caret"></span></a>
                          <ul class="dropdown-menu b-range">
                             
                            <div class="rangeslider">
                                <input class="min" name="range_1" type="range" min="300" max="11000" value="500" />
                                <input class="max" name="range_1" type="range" min="300" max="11000" value="9000" />
                                <span class="range_min light left">$ 500 </span>
                                <span class="range_max light right">$ 9000 </span>
                            </div>
                            
                          </ul>
                        </li>
                        
                        <!-- DROP DOWN FOR FEATURES -->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-road" aria-hidden="true"></i> Features <span class="caret"></span></a>
                          <ul class="dropdown-menu bc-surface container">
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'suspension.png')?>" alt="Suspension">
                                        <span>Susspension</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Hard Tail
                                      <input type="radio" name="suspension" value="Hardtail">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> Full
                                      <input type="radio" name="suspension" value="Full">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="suspension" value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'break.png')?>" alt="Breaks">
                                        <span>Breaks</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Disc - Piston
                                      <input type="radio" name="break" value="Disc - Piston">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> Disc - Mechanical
                                      <input type="radio" name="break" value="Disc- Mechanical">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Disc - Hydraulic
                                      <input type="radio" name="break" value="Disc - Hydraulic">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="break" value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'frame.png')?>" alt="Frame">
                                        <span>Frame</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Aluminium
                                      <input type="radio" name="frame" value="Aluminium">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> Carbon
                                      <input type="radio" name="frame" value="Carbon">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="frame" value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'wheel.png')?>" alt="Wheel">
                                        <span>Wheel</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 26 Inch
                                      <input type="radio" name="wheel" value="26.0">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> 27.5 Inch
                                      <input type="radio" name="wheel" value="27.5">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 29 Inch
                                      <input type="radio" name="wheel" value="29.0">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Fat / Plus
                                      <input type="radio" name="wheel" value="Fat/Plus">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="wheel"  value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                <div class="icon-lable">
                                  <img src="<?php echo ($baseUrl . 'drivertrain.png')?>" alt="drivetrainquality">
                                  <span>Drive Train Quality</span>
                                </div>
                              </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Intro Level
                                      <input type="radio" name="drivertrain" value="Intro Level">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> Medium
                                      <input type="radio" name="drivetrainquality" value="Medium">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> High
                                      <input type="radio" name="drivetrainquality" value="High">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Race
                                      <input type="radio" name="drivetrainquality" value="Race">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="drivetrainquality" value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                      <img src="<?php echo ($baseUrl . 'crankset.png')?>" alt="crankset">
                                      <span>Crankset Quantity</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 1
                                      <input type="radio" name="crankset" value="1">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> 2
                                      <input type="radio" name="crankset" value="2">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 3
                                      <input type="radio" name="crankset" value="3">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="crankset" value="I don't mind">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                <div class="icon-lable">
                                  <img src="<?php echo ($baseUrl . 'suspension.png')?>" alt="crankset">
                                  <span>Suspension Lockout Quantity</span>
                                </div>
                              </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 1
                                      <input type="radio" name="slquntity" value="1">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> 2
                                      <input type="radio" name="slquntity" value="2">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> 3
                                      <input type="radio" name="slquntity" value="3">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio"  name="slquntity" value="0">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'suspension.png')?>" alt="stravel">
                                        <span>Suspension Travel</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Short (80-120mm)
                                      <input type="radio" name="stravel" value="Short">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> Medium (120-140mm)
                                      <input type="radio" name="stravel" value="Medium">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Long (140-170mm)
                                      <input type="radio" name="stravel" value="Long">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="stravel" value="">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'rc.png')?>" alt="remote">
                                        <img src="<?php echo ($baseUrl . 'suspension.png')?>" alt="rc suspension">
                                        <span>Remote Suspension</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Yes
                                      <input type="radio" name="remotesusp" value="Yes">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> No
                                      <input type="radio" name="remotesusp" value="No">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio"  name="remotesusp" value="">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'rc.png')?>" alt="remote">
                                        <img src="<?php echo ($baseUrl . 'seat.png')?>" alt="rc seat">
                                        <span>Remote Seat</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Yes
                                      <input type="radio" name="remoteseat" value="Yes">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> No
                                      <input type="radio" name="remoteseat" value="No">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="remoteseat" value="">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'basket.png')?>" alt="basket">
                                        <span>Attach a carry basket/rear tray?</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Yes
                                      <input type="radio" name="carry_basket" value="Yes">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> No
                                      <input type="radio" name="carry_basket" value="No">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="carry_basket" value="">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="clearfix">
                            	<div class="col-md-2">
                                	<div class="icon-lable">
                                        <img src="<?php echo ($baseUrl . 'baby.png')?>" alt="baby seat">
                                        <span>Attach a kid seat?</span>
                                    </div>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> Yes
                                      <input type="radio" name="kidseat" value="Yes">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>                                
                            	<div class="col-md-2">
                                    <label class="con rad"> No
                                      <input type="radio" name="kidseat" value="No">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            	<div class="col-md-2">
                                    <label class="con rad"> I don't mind
                                      <input type="radio" name="kidseat" value="">
                                      <span class="checkmark rad"></span>
                                    </label>
                                </div>
                            </li>
                          </ul>
                        </li>
                        
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
        </div>
    	</div>
    </div>
</div>