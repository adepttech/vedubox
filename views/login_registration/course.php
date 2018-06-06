<?php 	
do_action('tscore_plugin_course_page_action');

global $wpdb;
$execute1 = $wpdb->get_results("select * from lms_setting");
$api_url = $execute1[0]->url;
$token = $execute1[0]->token;
$api_full_url = $api_url.'/api/veduApi/getPackagesByTags?token='.$token.'&tags=&packageType=1';


$abc = wp_remote_get($api_full_url);

$response = $abc['body'];

$response1 = json_decode($response);

$response1_count = count($response1);


if($response1_count <= 0){
	?>
	<div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list" style="margin-bottom: 30px;
    color: #fff;"><h3>Course List</h3></div>
	</div>
	<center><h3><span>Not any data come from API.Please contact to admin or check API and Token.</span></h3></center>
	</div>
	<br/>
	<br/>
	<br/>
	</div>
	<?php
	exit;
}
$total_items = $response1_count;
?>
<section class="pen">
	<div class="panel top">
	  <!--search start here-->
	<div class="search">
		<i> </i>
		<div class="s-bar">		 
		  <form class="form-wrapper12" action="" method="post" >
			<div class="search-box">
				<input type="text" autocomplete="off" name="S_course" id="search"  />
				<input type="submit" name="submit" value="Search" id="submit">
				<div class="result"></div>
			</div>
			<!--<input type="text" id="search" name="S_course" placeholder="Search for..." required>-->
			
		</form>
		</div>
		
	</div>
		<!--search end here-->	
	</div>

</section><br/>
<div class="container">
	<div class="row login_btn">
		<?php echo do_shortcode( '[L_BUTTON]' ); ?>
	</div>
</div>
<?php
$execute1 = $wpdb->get_results("select * from lms_setting");
$course_list  = $execute1[0]->course_list ;
?>
    <!-- slider -->
    <div class="carousel-reviews broun-block">
        <div class="container">
		<div class"t_list" style="margin-bottom: 30px;
    color: #4CAF50;margin-top:10%"><h3><?php if(isset($course_list)){echo $course_list;}else{ echo "Course List";}?></h3></div>
		
					<div class="row<?php echo $a; ?>">                
						<br>
                
					   <?php 
					   
							for($i = 0;$i<$response1_count;$i++){
								$packageDetails_count = count($response1[$i]->packageDetails);
								if($packageDetails_count > 0){
								
					   
					   ?>
                        
						<!-- do daynimic from here start -->
                            <div class="col-md-3 col-xs-12">
                                <div class="example-1 card">
                                    <div class="wrapper">
                                        <div class="date">
                                            <span class="day"><?php echo $response1[$i]->description.'    '; echo $response1[$i]->packageDetails[0]->id; ?></span>
                                        </div>
										<?php if($response1[$i]->packageDetails[0]->imgUrl == null){?>
										<a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>" target="_blank"><img class="media-object" src="<?php echo TSCORE_ASSETS_URL.'/images_111.jpg'; ?>" style="width:100%"></a>
										<?php }else{?>
										<a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>"><img class="media-object" src="<?php echo $response1[$i]->packageDetails[0]->imgUrl; ?>"></a>
										<?php } ?>
                                        <div class="data">
										  <div class="content">
										<span class="btn btn-info btn-sm c_price"><?php echo '$'.$response1[$i]->packageDetails[0]->amount; ?></span>
											<span class="author"><?php echo $response1[$i]->packageDetails[0]->description; ?></span>			<center><a href="http://demo.vedubox.net/public/packageDetails/<?php echo $response1[$i]->packageDetails[0]->id; ?>" target="_blank"><button type="button" class="btn btn-info btn-sm">Get this course</button></a></center>									
										 </div>
									 </div>
                                    </div>
                                </div>
                            </div>	
								<?php }} ?>
						</div>	
				</div>
		</div>
	
    <!-- slider -->
	<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/jquery.min.js'; ?>"></script>
	<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/bootstrap.min.js'; ?>"></script>

