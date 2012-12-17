<?php
require_once('config.php');
$reserved=false;
$error="";
if(isset($_POST['submit'])&&isset($_POST['email'])&&isset($_POST['username'])&&$_POST['submit']!=""&&$_POST['email']!=""&&$_POST['username']!=""){
	$con = mysql_connect($dbHost,$dbUsername,$dbPassword) or die("db connect error");;
	mysql_select_db($dbName, $con) or die("db select error");
	$result = mysql_query("SELECT * FROM user_reserve where email='".$_POST['email']."' or username='".$_POST['username']."'",$con);
	if(mysql_num_rows($result)==0){
		if(mysql_query("INSERT INTO user_reserve (email, username) VALUES ('".$_POST['email']."','".$_POST['username']."')")){
			$reserved=true;
		}
	}elseif($row=mysql_fetch_array($result)){
		if($row['username']==$_POST['username']){
			$error='UE';
		}elseif($row['email']==$_POST['email']){
			$error='EE';
		}
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
		<title>Tinywall - Collaborative educational social networking</title>
		<meta name="description" content="Collaborative educational social networking with online courses and learning from well trained teachers">
		<meta name="keywords" content="tinywall, social education, social networking, online education, online learning, collaborative education, collaborative learning">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
  </head>
  <body>
  
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=168918696455983";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
  
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="" style='color:#ffffff;'>TinyWall</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container-fluid container ">
	<div class="row-fluid">
		<div class="span8">
			<br/><br/><img src="./files/logo-trans.png" alt="TinyWall" ><br/><br/>
			<?php
				if(!$reserved){
				?>
			<form class="form-signin" method='post' action='' id="register-form" onsubmit="return validateForm();">
					<div class="alert" id='username-availability' style='display:none;'>Checking  username availibility...</div>
				<input type="text" class="input-block-level" placeholder="Username" name='username' id='username' onkeyup="if($(this).val().length>=3&&$(this).val().length<=20&&$('#username').val().match(/^[a-zA-Z0-9\_]+$/)!=null){chechUserAvailability($(this).val());}else{$('#username-availability').removeClass('alert-info').removeClass('alert-success').removeClass('alert-error').addClass('alert-info').show().html('Please enter valid username between 3 and 20 charecters');}">
					<input type="text" class="input-block-level" placeholder="Email address" name='email' id='email'>
				
			<input class="btn btn-info" type="submit" name='submit' style='width:100%;' value='Submit' />
		  </form>
		   <?php
	  }else{
	  ?>
	  <h3>Successfully registered.</h3>
	  <?php
	  }
	  ?>
	  <?php
	  if($error=='EE'){
	  ?>
	  <h4 style='color:#f00'>Email already registered.</h4>
	  <?php
	  }elseif($error=='UE'){
	  ?>
	  <h4 style='color:#f00'>Username already registered.</h4>
	  <?php
	  }
	  ?>
			<br/>
			<a href="https://twitter.com/share" class="twitter-share-button" data-via="TheTinywall">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				
				<a href="https://twitter.com/TheTinywall" class="twitter-follow-button" data-show-count="false">Follow @TheTinywall</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="fb-like" data-href="http://tinywall.com" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
		  
		</div>
		<div class="span4">
			<h5>Latest Updates</h5>
		  <div id='ad-tweets'></div>
		</div>
	</div>
	<hr>

      <footer>
		<div class="row-fluid">
		<div class="span4">
		<h5>About Us</h5>TinyWall is a collaborative educational social networking portal to empower the students with online learning.
		</div>
		<div class="span4">
		<h5>Get in touch</h5>
		<a href='https://twitter.com/thetinywall' target='_blank'>Twitter</a><br/>
		<a href='http://www.facebook.com/tinywall' target='_blank'>Facebook</a>
		</div>
		<div class="span4">
		<h5>Our Partners</h5>
		<a href='http://www.tinywall.in/' target='_blank'>Tinywall.in</a><br/>
		<a href='http://www.tinywall.info/' target='_blank'>Tinywall.info</a><br/>
		<a href='http://webshop.tinywall.in/' target='_blank'>Tinywall Domain & Web Hosting</a>
		</div>
		</div>
		<div class="row-fluid">
		<div class="span12">
		<br>Copyright &copy; Tinywall 2012
		</div>
		</div>
	</footer>
	</div>
    <script src="files/jquery-1.8.3.min.js"></script>
	<script src='files/jquery.jtweetsanywhere-1.3.1.min.js'></script>
	<link rel="stylesheet" href="./files/jquery.jtweetsanywhere-1.3.1.css" type="text/css" media="screen">
	<script type="text/javascript">
	$('#ad-tweets').jTweetsAnywhere({
		username: ['ArunMDavid','smartmohi','thetinywall','tinywallinfo'],
		count: 4,
		showTweetFeed:{
			showProfileImages: false,
			showUserScreenNames: false
		}
	});
	</script>
	<style>
	.jta-tweet-list{
	margin:0px;
	}
	.jta-tweet-list-item,.jta-tweet-list-item:first-child {
	background:#ffffff;
	border:none;
	}
	</style>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="files/jquery.validity.min.js"></script><script type="text/javascript">
	function isEmailAddress(str) {
		var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
    return String(str).search (filter) != -1;
	}
	
	function validateForm(){
		if($("#username").val()==""||$("#email").val()==""){
			alert("Please enter username and email id");
			return false;
		}
		if($("#username").val().length<3||$("#username").val().length>20||$('#username').val().match(/^[a-zA-Z0-9\_]+$/)==null){
			alert("Please enter valid username between 3 and 20 charecters");
			return false;
		}
		if(!isEmailAddress($("#email").val())){
			alert("Please enter valid email id");
			return false;
		}
	return true;
	}
	function chechUserAvailability(username){
		$('#username-availability').removeClass('alert-info').removeClass('alert-success').removeClass('alert-error').show().html('Checking username availability.');
		$.getJSON('chechUserAvailability.php?username='+username,function(msg){
			if(username==$('#username').val()){
				if(msg.response.availability){
					$('#username-availability').removeClass('alert-info').removeClass('alert-success').removeClass('alert-error').addClass('alert-success').show().html('Username Available.');
				 }else{
					$('#username-availability').removeClass('alert-info').removeClass('alert-success').removeClass('alert-error').addClass('alert-error').show().html('Username Already Taken.');
				 }	
			}
		});
	}
</script>
  </body>
</html>