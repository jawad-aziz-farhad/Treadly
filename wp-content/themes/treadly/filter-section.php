  <?php 
  
  $sectionA = array();

  array_push($sectionA , array('title'=> 'Power Assisted' , 'value' => 'power_assisted'));
  array_push($sectionA , array('title'=> 'Recreation / Leisure' , 'value' => 'recreation' ));
  array_push($sectionA , array('title'=> 'Basic Trails' , 'value' => 'basic_trails'));
  array_push($sectionA , array('title'=> 'Hard Trails'  , 'value' => 'hard_core_trails'));
  array_push($sectionA , array('title'=> 'Transport (daily ride)' , 'value' => 'transport'));
  array_push($sectionA , array('title'=> 'Cruising' , 'value' => 'cruising'));
  array_push($sectionA , array('title'=> 'Road'     , 'value' => 'road'));
  array_push($sectionA , array('title'=> 'Gravel'   , 'value' => 'gravel'));

  $sectionB = array();
  array_push($sectionB , array('title'=> 'Fun' , 'value'=> 'fun'));
  array_push($sectionB , array('title'=> 'Fitness' , 'value'=> 'fitness'));
  array_push($sectionB , array('title'=> 'Performance' , 'value'=> 'performance'));

  $prices = [ 300, 500 , 1000 , 1500 , 2000 , 2500 , 3000 , 5000 , 8000 , 10000, 12500, 15000, 17000, 20000, 23000, 25000, 28000, 30000 ];
  
  $baseUrl = 'http://localhost:8888/treadly/wp-content/themes/treadly/images/'; ?>
  
  <!-- Blocks Container Starts-->
  <div class="container mt-4 mb-2">

    
    <div class="row">

      <!-- 1st Section Starts -->
      <div class="col-12">
          <div class="container">

              <div class="row mt-4">
                <div class="col">        
                  <div class="section-title">
                    <h5>Step1: What's your style ?<span style="font-size: 16px; "> (select as many as you like)</span></h5>
                    
                  </div>
                </div>
              </div>

            <!-- Section A Starts -->
            <div class="row text-center mt-4">
              <?php  for($i = 0; $i < count($sectionA); $i++) { ?>
                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 cards-padding mb-4" section="usages">
                  <div class="card bg-light border-dark mx-sm-1 p-3 card-block">
                    <div class="card border-dark shadow text-dark p-3 small-card"><span class="fa fa-bicycle" aria-hidden="true"></span></div>
                    <div class="text-dark text-center mt-4"><h6 class="" value="<?php echo $sectionA[$i]['value']; ?>"><?php echo $sectionA[$i]['title']; ?> </h6></div>
                    <div class="text-dark p-3"><span class="icon-bike-<?php echo ($i + 1); ?>" aria-hidden="true"></span></div>
                  </div>
                </div>
              <?php }?>
            </div>    
            <!-- Section A Ends -->
        </div>
      </div>
      <!-- 1st Section Ends -->

      <!-- 2nd Section Starts -->
      <div class="col-12">

          <div class="container">

              <div class="row mt-4">
                <div class="col">        
                  <div class="section-title">
                    <h5>Step2: Why do you ride?</h5>
                  </div>
                </div>
              </div>

              <!-- Section B Starts -->
              <div class="row text-center mt-4" section="levels">
                <?php  for($i = 0; $i < count($sectionB); $i++) { ?>
                  <div class="col-sm cards-padding mb-4" section="levels">
                    <div class="card bg-light border-dark mx-sm-1 p-3 card-block">
                      <div class="card border-dark shadow text-dark p-3 small-card"><span class="fa fa-bicycle" aria-hidden="true"></span></div>
                      <div class="text-dark text-center mt-4"><h6 class="" value="getting_back_into_it"><?php echo $sectionB[$i]['title']?></h6></div>
                      <div class="text-dark p-3"><span class="icon-bike-10" aria-hidden="true"></span></div>
                    </div>
                  </div>
                <?php }?>
              </div>
              <!-- Section B Ends -->
          </div>
      </div>
      <!-- 2nd Section Ends -->

      <!-- 3rd Section Starts -->
      <div class="col-12">
        <div class="container">          
          
          <div class="row mt-4">
            <div class="col">        
              <div class="section-title">
                <h5>Step3 :  What is your budget?</h5>
              </div>
            </div>
          </div>                  
          
          <div class="row text-center mt-1">
            <!-- Min Price Starts -->
            <div class="col-sm">
              <div class="form-group">
                <select class="border-dark form-control" id="minPrice">
                  <option selected disabled>Price (Min)</option>
                  <?php for($i=0;$i < count($prices); $i++) { ?>
                  <option value="<?php echo $prices[$i]; ?>"><?php echo $prices[$i]; ?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <!-- Min Price Ends -->

            <!-- Max Price Starts -->
            <div class="col-sm">
              <div class="form-group">
                <select class="border-dark form-control" id="maxPrice">
                  <option selected disabled>Price (Max)</option>
                  <?php for($i=0;$i < count($prices); $i++) { ?>
                  <option value="<?php echo $prices[$i]; ?>"><?php echo $prices[$i]; ?></option>
                  <?php }?>
                </select>
              </div>
            </div>     
            <!-- Max Price Ends -->

          </div>
        </div>
      </div>
      <!-- ./ 3rd Sectino Ends-->
  </div>

</div>
<!-- Blocks Container Ends-->

<!-- Search Button -->
<div class="container justify-content-center mb-3">
  <button type="button" class="btn btn-block" id="searchBtn">
    Search
  </button> 
</div>
