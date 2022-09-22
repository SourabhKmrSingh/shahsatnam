<style></style>
<!--======================================
        START HEADER AREA
    ======================================-->
<header class="header-menu-area bg-white">
  <div class="header-top  border-bottom border-bottom-gray py-1">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-lg-12" style="background-color:#a53692;">
          <div class="header-widget">
            <marquee>
              <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray">
                  <i class="la la-phone mr-1" style="color:#fefefe;"></i>
                  <a href="tel:01666-238620" style="color:#fefefe;"> 01666-238620, 01666-238520</a>
                </li>
                <li class="d-flex align-items-center">
                  <i class="la la-map mr-1" style="color:#fefefe;"></i>
                  <a href="#" style="color:#fefefe;"> Near Shah Satnam Ji Pura, Shah Satnam JI Dham Nejia Khera, Sirsa (125055), Haryana India </a>
                </li>
              </ul>
            </marquee>
          </div>
          <!-- end header-widget -->
        </div>
        <!-- end col-lg-6 -->
        <!-- end col-lg-6 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container-fluid -->
  </div>
  <!-- end header-top -->
  <div class="header-menu-content px-5  bg-white">
    <div class="container-fluid">
      <div class="main-menu-content">
        <a href="#" class="down-button">
          <i class="la la-angle-down"></i>
        </a>
        <div class="row align-items-center">
          <div class="col-lg-4">
            <div class="logo-box">
              <a href="index.php" class="logo">
                <img src="images/logo.png" alt="logo" width="100px;">
              </a>
              <h4 style="font-size:24px; font-weight:700; color: #a53692;" class='px-3'>Shah Satnam ji Girls School Sirsa</h4>
              <div class="user-btn-action">
                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                  <i class="la la-bars"></i>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-lg-2 -->
          <div class="col-lg-8">
            <div class="menu-wrapper">
              <nav class="main-menu">
                <ul>
                  <li class="
                  
											
											<?php 
                  if($menu=="index.php"){
                      echo "active-1";
                  }
                  ?>
                  ">
                    <a href="index.php">Home </a>
                  </li>
                  <li class="
											
											<?php 
                  if($menu=="about.php" || $menu=="inspiration.php" || $menu=="principal.php"
                  || $menu=="location.php" || $menu =="inception.php" || $menu =="humanity.php"
                  || $menu=="faculty.php" || $menu =="sufarnama.php" || 
                    $menu =="motivation.php" || $menu =="education.php" || $menu =="fee.php" ||$menu=="whychooseus.php"
                  ){
                    echo "active-1";
                  }
                  ?>">
                    <a href="about.php">About <i class="la la-angle-down fs-12"></i>
                    </a>
                    <ul class="dropdown-menu-item">
                      <li class="
													
													<?php 
                      if($menu=="location.php")
                      {
                        echo "active-1";
                      }
                      
                      ?>">
                        <a href="location.php">Location</a>
                      </li>
                      <li class="
                      
													
													<?php 
                      if($menu =="inception.php"){
                        echo "active-1";
                      }
                      ?>">
                        <a href="Inception.php">Inception</a>
                      </li>
                      <li class="
                      
													
													<?php
                      if($menu=="inspiration.php"){
                          echo "active-1";
                      }
                      ?>">
                        <a href="inspiration-vision-mission.php">Our Vision & Mission</a>
                      </li>
                      <li class="
													
													<?php 
                      if($menu=="principal.php")
                      {
                        echo "active-1";
                      }
                      
                      ?>">
                        <a href="principal’s-message.php">Principal’s Message </a>
                      </li>
                      <li class=" 
                      
													
													<?php 
                      if($menu =="humanity.php"){
                        echo "active-1";
                      }
                      ?>">
                        <a href="humanity-is-religion.php">Humanity is Religion</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="whychooseus.php"){echo "active-1";}?>">
                        <a href="why_choose_us.php">Why choose us?</a>
                      </li>
                    </ul>
                  </li>
                  <li class="
                  
											
											<?php
                  if($menu=="facilities.php" ||  $menu=="assembly.php"
                  || $menu =="transport.php" ||  $menu =="language.php" || $menu=="geography-lab.php"
                  || $menu =="scout.php" ||  $menu =="buliding.php" || $menu=="science.php"|| $menu =="computer.php"
                  || $menu=="music_room.php" || $menu=="art-&-craft.php" || $menu=="school.php"  || $menu=="kinder-garten.php"
                  || $menu=="boarding-system.php"
                  ){
                      echo "active-1";
                  }
                  ?>">
                    <a href="facilities.php">Facilities <i class="la la-angle-down fs-12"></i>
                    </a>
                    <ul class="dropdown-menu-item">
                      <li class="
													
													<?php if($menu=="buliding.php"){ echo "active-1";}?>">
                        <a href="building.php">Building</a>
                      </li>
                      <li class="
													
													<?php if($menu=="assembly.php"){echo "active-1";}?>">
                        <a href="assembly.php">Assembly</a>
                      </li>
                      <li class="
													
													<?php if($menu=="science.php"){echo "active-1";}?>">
                        <a href="science-lab.php">Science Lab</a>
                      </li>
                      <li class="
													
													<?php if($menu =="computer.php"){echo "active-1";}?>">
                        <a href="computer.php">Computer Lab</a>
                      </li>
                      <li class="
													
													<?php if($menu=="geography-lab.php"){echo "active-1";}?>">
                        <a href="geography-lab.php">Geography Lab</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="language.php"){ echo "active-1";}?>">
                        <a href="language.php">Language Lab</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="music_room.php"){ echo "active-1";}?>">
                        <a href="music_room.php">Music Room</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="art-&-craft.php"){ echo "active-1";}?>">
                        <a href="art-&-craft.php">Art & Craft</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="school.php"){ echo "active-1";}?>">
                        <a href="school.php">School Library</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="kinder-garten.php"){ echo "active-1";}?>">
                        <a href="kinder-garten.php">Kindergarten</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="medical.php"){ echo "active-1";}?>">
                        <a href="medical.php">Medical Room</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="boarding-system.php"){ echo "active-1";}?>">
                        <a href="boarding-system.php">Boarding system</a>
                      </li>
                      <li class=" 
													
													<?php if($menu=="transport.php"){echo "active-1";}?>">
                        <a href="transport.php">Trasport Facilities</a>
                      </li>
                    </ul>
                  </li>
                  <li class="
                  <?php
                  if($menu=="facility.php" || $menu=="pgt-1.php" ||  $menu=="pgt-2.php" || $menu=="tgt-1.php" ||
                  $menu=="tgt-2.php" || $menu=="prt.php" ||  $menu=="support-staff.php"
                  ){
                      echo "active-1";
                  }
                  ?>
                  ">
                    <a href="faculty.php">faculty<i class="la la-angle-down fs-12"></i>
                    </a>
                    <ul class="dropdown-menu-item">
                      <li class=" 
													
													<?php if($menu=="pgt-1.php"){echo "active-1";}?>">
                        <a href="pgt-1.php">PGT I</a>
                      </li>
                      <li class="<?php if($menu=="pgt-2.php"){echo "active-1";}?>">
                        <a href="pgt-2.php">PGT II</a>
                      </li>
                      <li class="<?php if($menu=="tgt-1.php"){echo "active-1";}?>">
                        <a href="tgt-1.php"> TGT I </a>
                      </li>
                      <li class="<?php if($menu=="tgt-2.php"){echo "active-1";}?>">
                        <a href="tgt-2.php"> TGT II </a>
                      </li>
                      <li class="<?php if($menu=="prt.php"){echo "active-1";}?>">
                        <a href="prt.php">PRT</a>
                      </li>
                      <li class="<?php if($menu=="support-staff.php"){echo "active-1";}?>">
                        <a href="supports-staff.php">SUPPORT STAFF</a>
                      </li>
                    </ul>
                  </li>
                  <li class="<?php if($menu =="curriculum.php" ||  $menu=="admision.php"   ||  $menu=="learning.php" || $menu=="conferences.php"
                  || $menu=="results.php" || $menu=="roll.php" ){
                echo "active-1";

              } ?>">
                    <a href="academic.php">Academics <i class="la la-angle-down fs-12"></i>
                    </a>
                    <ul class="dropdown-menu-item">
                      <li class="<?php if($menu=="curriculum.php"){echo "active-1";}?>">
                        <a href="curriculum.php">Curriculum </a>
                      </li>
                      <li class="<?php if($menu=="admision.php"){echo "active-1";}?>">
                        <a href="admission.php">Admission & Fee Procedure</a>
                      </li>
                      <li class="<?php if($menu=="learning.php"){echo "active-1";}?>">
                        <a href="learning.php">E-Learning </a>
                      </li>
                      <li class="<?php if($menu=="conferences.php"){echo "active-1";}?>">
                        <a href="confreence.php">Conferences & Seminars </a>
                      </li>
                     
                    </ul>
                  <li class="<?php
                  if($menu=="activity-plan.php"  || $menu=="kinder-garten2.php" || $menu=="primary-school-ativity.php" || $menu=="s_school.php"
                  || $menu =="tours-&-ecursion.php"  || $menu=="scouts-&-guides.php" || $menu=="co-curricular.php"
                  ){
                      echo "active-1";
                  }
                  ?>" >
                    <a href="co-curricular.php">Co-Curricular <i class="la la-angle-down fs-12"></i>
                    </a>
                    <ul class="dropdown-menu-item">
                      <li class="<?php if($menu=="activity-plan.php"){echo "active-1";}?>">
                        <a href="activity-plan.php">Full acivity calander</a>
                      </li>
                      <li class="<?php if($menu=="kinder-garten2.php"){echo "active-1";}?>">
                        <a href="kinder-garten-2.php">Cultural Activities for Kindergarten</a>
                      </li>
                      <li class="<?php if($menu=="primary-school-ativity.php"){echo "active-1";}?>">
                        <a href="primary-school-activity.php">Primary School Activity </a>
                      </li>
                      <li class="<?php if($menu=="s_school.php"){echo "active-1";}?>">
                        <a href="seccondary_school.php">Secondary School Activity</a>
                      </li>
                      <li class="<?php if($menu =="tours-&-ecursion.php"){echo "active-1";}?>">
                        <a href="tours.php">Tours & Excursions</a>
                      </li>
                      <li class="<?php if($menu=="scouts-&-guides.php"){echo "active-1";}?>"  >
                        <a href="scouts-&-guides.php">Scouts & Guide</a>
                      </li>
                      
                    </ul>
                  </li>
                 
                  <li class="">
                  <a href="contact.php">Awards<i class="la la-angle-down fs-12"></i> </a>
                  <ul class="dropdown-menu-item">
                    <li><a href="award-principal.php">Recognitions to Principal</a> </li>
                    <li><a href="">Recognitions to School</a> </li>
                  </ul>
                  </a>
                </li>
                <li class="
										
                    <?php 
                if($menu=="contact.php"){
                  echo "active-1";
                }
                ?>">
                  <a href="contact.php">Contact Us </i>
                  </a>
                </li>
                </ul>
                <!-- end ul -->
              </nav>
              <!-- end main-menu -->
              <!-- end shop-cart -->
              <!-- end nav-right-button -->
            </div>
            <!-- end menu-wrapper -->
          </div>
          <!-- end col-lg-10 -->
        </div>
        <!-- end row -->
      </div>
    </div>
    <!-- end container-fluid -->
  </div>
  <!-- end header-menu-content -->
  <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
    <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
      <i class="la la-times"></i>
    </div>
    <!-- end off-canvas-menu-close -->
    <ul class="generic-list-item off-canvas-menu-list pt-90px">
      <li>
        <a href="index.php">Home</a>
      </li>
      <li>
        <a href="about.php">About us</a>
        <ul class="sub-menu">
          <li>
            <a href="inspiration-vision-mission.php">Inspiration, Vision & Mission</a>
          </li>
          <li>
            <a href="location.php">Location</a>
          </li>
          <li>
            <a href="inception.php">Inception</a>
          </li>
          <li>
            <a href="humanity-is-religion.php">Humanity is Religion</a>
          </li>
          <li>
            <a href="principal’s-message.php">Principal’s Message </a>
          </li>
          <li>
            <a href="inspiration-vision-mission.php">Inspiration, Vision & Mission</a>
          </li>
        </ul>
      </li>
      <li>
      <a href="facilities.php">Facilities</a>
        <ul class="sub-menu">
          <li class="#">
            <a href="buiding.php">Buiding</a>
          </li>
          <li class="#">
            <a href="assembly.php">Assembly</a>
          </li>
          <li class="#">
            <a href="science-lab.php">Science Lab</a>
          </li>
          <li class="#">
            <a href="computer.php">Computer Lab</a>
          </li>
          <li class="#">
            <a href="geography-lab.php">Geography Lab</a>
          </li>
          <li class="#">
            <a href="language.php">Language Lab</a>
          </li>
          <li class="#">
            <a href="music_room.php">Music Room</a>
          </li>
          <li class="#">
            <a href="art-&-craft.php">Art & Craft</a>
          </li>
          <li class="#">
            <a href="school.php">School Library</a>
          </li>
          <li class="#">
            <a href="kinder-garten.php">Kinder Garten</a>
          </li>
          <li class="#">
            <a href="medical.php">Medical Room</a>
          </li>
          <li class="#">
            <a href="boarding-system.php">Boarding system</a>
          </li>
          <li class="#">
            <a href="transport.php">Trasport Facilities</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="faculty.php">Faculty</a>
        <ul class="sub-menu">
          <li class="#">
            <a href="pgt-1.php">PGT 1</a>
          </li>
          <li class="#">
            <a href="pgt-2.php">PGT 2</a>
          </li>
         
          <li class="#">
            <a href="tgt-1.php">TGT 1</a>
          </li>
          <li class="#">
            <a href="tgt-2.php">TGT 2</a>
          </li>
          <li class="#">
            <a href="prt.php">PRT</a>
          </li>
          <li class="#">
            <a href="supports-staff.php">Supports Staff</a>
          </li>
          
        </ul>
      </li>
      <li>
      <a href="co-curricular.php">Co-Curricular </a>
        <ul class="sub-menu">
          <li class="#">
            <a href="activity-plan.php">Full acivity calander</a>
          </li>
          <li class="#">
            <a href="kinder-garden.php">Cultural Activities for Kinder Garden </a>
          </li>
         
          <li class="#">
            <a href="primary-school-activity.php">Primary School Activity </a>
          </li>
          <li class="#">
            <a href="seccondary_school.php">Secondary School Activity</a>
          </li>
          <li class="#">
            <a href="tours.php">Tours & Excursions</a>
          </li>
          <li class="#">
            <a href="scouts-&-guides.php">Scouts & Guide</a>
          </li>
          
        </ul>
      </li>
    
    </ul>
  </div>
</header>
<!--======================================
        END HEADER AREA
======================================-->