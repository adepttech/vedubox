<?php
do_action('tscore_plugin_teacherPhoto_page_action');
global $wpdb;
$execute1 = $wpdb->get_results("select * from lms_setting");
$api_url = $execute1[0]->url;
$token = $execute1[0]->token;
$api_full_url = $api_url.'/api/veduApi/getTeachersPictures?token='.$token;



$abc = wp_remote_get($api_full_url);

$response = $abc['body'];

//$response = callAPI('GET', 'http://demo.vedubox.net/api/veduApi/getTeachersPictures?token=3353143f92');

$response = json_decode($response);

$response_counter = count($response);

if($response_counter <= 1){
	?><div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list" ><h3> Teachers Photos</h3></div>
	</div>
	<center><h3><span>Not any data come from API.Please contact to admin or check API and Token.</span></h3></center>
	</div>
	<br/>
	<br/>
	<br/>
	</div><?php
	exit;
}
/* echo '<pre>';
print_r($response);
echo '</pre>'; */

$total_teachers = count($response);
$page = empty( $_REQUEST['set'] ) ? 1 : $_REQUEST['set'];
$limit = 8;
$offset = ($page - 1) * $limit;
?><?php $newArray = array_slice($response, $offset, $limit, true); ?>
<div class="col-md-12 col-xs-12 back_">
 <div class="wrapper">
  <div class="wrapper_inner">
  <div class="t_list"><h3> Teachers Photos</h3></div>
    <!-- Gallery -->
    <section class="gallery">
      <!-- Gallery  item Start from here -->   
	  <?php $i=1; foreach($newArray as $result) {  ?>
	  <div class="gallery_item">
        <!-- Gallery  item preview -->
        <span class="gallery_item_preview">
          <a href="#" data-js="<?php echo $i; ?>">
            <?php if($result->pictureUrl == null){?>
			<img src="<?php echo TSCORE_ASSETS_URL.'/teachers_photo_dummy.jpg'; ?>" alt="" /><?php }else{?>
			<img src="<?php echo $result->pictureUrl; ?>" alt="" />
			<?php } ?>
			<span>
            <h3><?php echo $result->fullName; ?></h3>
            </span></a>

        </span>
        <!-- Gallery  item full -->
        <div data-lk="<?php echo $i; ?>" class="gallery_item_full">
          <div class="box">
            <?php if($result->pictureUrl == null){?>
			<img src="<?php echo TSCORE_ASSETS_URL.'/teachers_photo_dummy.jpg'; ?>" alt="" /><?php }else{?>
			<img src="<?php echo $result->pictureUrl; ?>" alt="" />
			<?php } ?>
            <h3><?php echo $result->fullName; ?></h3>
           
		  </div>
        </div>
      </div>
	   <?php $i++;} ?>
	   <!-- pagination -->
     	 <nav aria-label="Page navigation"> 
			<ul class="pagination">
					<?php echo tscore_plugin_backend_pagination($total_teachers, $limit, $page); ?>
		    </ul>
		  </nav>
	           <!-- End pagination -->
<!-- Gallery  item End from here -->
	</section>
  </div>
</div>
</div>

<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/jquery.min.js'; ?>"></script>
<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/index_teachers_photos.js'; ?>"></script>
<?php
add_action('wp_footer','myscript_in_footer');
function myscript_in_footer(){
?>
<script  src="<?php echo TSCORE_ASSETS_URL.'/js/plugin/index_teachers_photos.js'; ?>"></script>
<?php
}
?>