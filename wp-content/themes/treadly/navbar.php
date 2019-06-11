
<div class="bg-info mb-0">
	<div class="container">
     <!--<div class="row">-->
     <!--<div class="col"><hr style="border: 0px !important;"></div>-->
     <!--   </div> -->
  <?php $url = 'http://getwebsite.com.pk/jawad/treadly/'; ?>     
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <a class="navbar-brand text-light" href="#">
    <img src="http://getwebsite.com.pk/jawad/treadly/wp-content/themes/treadly/images/frame.png" width="30" height="30" class="d-inline-block align-top text-light" alt="">
    Treadly
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link active-text" href="#">Home</span></a>
      </li>
      <li class="nav-item" id="wishlist">
        <a class="nav-link text-light" href="#">Wish List</a>
      </li>
    </ul>
    
  </div>
</nav>
    </div>
</div>

<div class="container mb-3"  id="filterContainer">
    <div class="row" id="filterRow">
        <div class="col text-center">
            <button type="button" class="btn btn-block full-specs" data-target="#filterSection"
            data-toggle="collapse" aria-expanded="false" aria-controls="filterSection" id="filterBtn" style="font-size: 16px;">
            <i class="fa fa-chevron-down pull-right"></i>
            Find out your bike
            </button>            
        </div>
    </div>
</div>

<!-- START COLLAPSE SECTION -->
<div class="collapse" id="filterSection">
    <?php get_template_part('filter-section'); ?>
</div>
<!-- END COLLAPSE SECTION -->