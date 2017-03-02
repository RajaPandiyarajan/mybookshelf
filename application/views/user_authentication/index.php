<?php  $this->load->helper('html');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Facebook</title>
<?php  $base_url=base_url(); ?>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<style>
.display_user {
font-size:20px;
float:left;margin-left:550px;
}
.user {color:green;}
</style>
</head>
<body>
<?php
if(empty($userData))   { 
echo img(array('src'=>$base_url.'assets/images/flogin.png','id'=>'facebook','style'=>'cursor:pointer;float:left;margin-left:550px;'));
 }  else{
	
 echo "<div class='display_user'>Welcome <span class='user'>". $userData['first_name'].'</span><img src="https://graph.facebook.com/'. $userData['id'] .'/picture" width="30" height="30"/><div>'.$userData['first_name'].'</div>';	
	echo '<a href="'.$logout_url.'">Logout</a>';
		
}
	?>
<div id="fb-root"></div>
   <script type="text/javascript">
  window.fbAsyncInit = function() {
     FB.init({ 
       appId:'<?php echo $this->config->item('appID'); ?>', cookie:true, 
       status:true, xfbml:true,oauth : true 
     });
   };
   (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
 $('#facebook').click(function(e) {
    FB.login(function(response) {
	  if(response.authResponse) {
		  //parent.location ='<?php echo $base_url; ?>fbci/fblogin';
		  parent.location ='https://rajapandiyarajan16.000webhostapp.com/bookshelf/index.php/user_authentication';
	 }
 },{scope: 'email'});
});
   </script>
</body>
</html>