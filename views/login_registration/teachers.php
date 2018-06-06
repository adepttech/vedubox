<?php
do_action('tscore_plugin_teacher_page_action');
global $wpdb;
$execute1 = $wpdb->get_results("select * from lms_setting");
$api_url = $execute1[0]->url;
$token = $execute1[0]->token;
$api_full_url = $api_url.'/api/veduApi/getTeachers?token='.$token;



$abc = wp_remote_get($api_full_url);

$response = $abc['body'];

//http://demo.vedubox.net/api/veduApi/getTeachers?token=3353143f92


$inner_arrays = json_decode($response);
/* echo '<pre>';
print_r($inner_arrays); */
$total_teachers = count($inner_arrays);
if($total_teachers > 1){
$page = empty( $_REQUEST['set'] ) ? 1 : $_REQUEST['set'];
$limit = 5;
$offset = ($page - 1) * $limit;
?>
<?php
$execute1 = $wpdb->get_results("select * from lms_setting");
$teacher_list = $execute1[0]->teacher_list;
?>
<div class="col-md-12 col-xs-12 back_" >
<div class="col-md-10 col-xs-12">
<div class="t_list" ><h3><?php if(isset($teacher_list)){echo $teacher_list;}else{ echo "Teachers List";}?></h3></div>
<?php  $newArray = array_slice($inner_arrays, $offset, $limit, true); ?>
 
 
		<?php foreach ($newArray as $result) {  ?>
		
		<div class="well">
      <div class="media">
      	<a class="pull-left" href="#"target="_blank">
		 <?php if($result->pictureUrl == null){?>
    		<img class="media-object" src="<?php echo TSCORE_ASSETS_URL.'/images_111.jpg'; ?>" alt="">
		 <?php }else{?>
			<img class="media-object" src="<?php echo $result->pictureUrl; ?>" alt="">
		 <?php } ?>
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">First Name : <?php echo $result->fullName; ?><span> | User Name : <?php echo ' '.$result->userName; ?></span></h4>
              
          <p><?php if($result->description == ''){ echo "Description not available here..."; }else{ echo $result->description; } ?></p>
          <ul class="list-inline list-unstyled">
  			<li><span class="user-info"><i class="glyphicon glyphicon-envelope"></i> &nbsp; <?php echo $result->email; ?> </span></li>
            <li>|</li>
            <span class="user-info"><i class="glyphicon glyphicon-phone"></i> &nbsp; <?php if($result->phoneNumber == ''){ echo "Phone Number not available here..."; }else{ echo $result->phoneNumber; } ?></span>
           
			</ul>
       </div>
    </div>
  </div>   
		   
		<?php }  ?> 
     
 </div> 
	 	  	     <!-- pagination -->
     	 <nav aria-label="Page navigation"> 
			<ul class="pagination">
					<?php echo tscore_plugin_backend_pagination($total_teachers, $limit, $page); ?>
		    </ul>
		  </nav>
	           <!-- End pagination -->
<div class="col-md-2 col-xs-12"></div>
</div>
<?php }else{?>
<div class="col-md-12 col-xs-12 back_">
<div class="col-md-10 col-xs-12">
<div class="t_list" ><h3> Teachers List</h3></div>
	<div><center><h3>Not any data come from API.Please contact to admin or check API and Token.</h3></center></div>
	<br/>
	<br/>
	<br/>
</div>
</div>
<?php }?>