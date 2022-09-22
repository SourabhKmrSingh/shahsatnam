    <!--================================
         START HERO AREA
=================================-->

<?php
    $sliderResult = $db->view('sliderid,title,title_id,url,url_target,imgName,tagline,description', 'rb_sliders', 'sliderid', " and status='active' and priority = '1'", 'order_custom asc');

    
    if($sliderResult['num_rows'] >= 1)
    {

        
?>

<section class="hero-area">
    <div class="hero-slider owl-action-styled">

<?php   
    foreach($sliderResult['result'] as $sliderRow)
    {
        if($sliderRow['url'] != "http://www." and $sliderRow['url'] != "")
        {
            $slider_url = $sliderRow['url'];
            $slider_target = $sliderRow['url_target'];;
        }
        else
        {
            $slider_url = "";
            $slider_target = "";
        }
?>


    <div class="hero-slider-item" style="padding-top:0px!important; padding-bottom: 0px!important">
        <img src="<?php echo BASE_URL . IMG_MAIN_LOC .$sliderRow['imgName'];?>">
        <div class="container">
        <div class="hero-content">
            <!-- end hero-btn-box -->
        </div>
        <!-- end hero-content -->
        </div>
        <!-- end container -->
    </div>
    <!-- end hero-slider-item -->
    <!-- end hero-slider-item -->

    <?php 
    }?>

    </div>
    <!-- end hero-slide -->
</section>

<?php }?>
  
    <!-- end hero-area -->
    <!--================================
        END HERO AREA
=================================-->