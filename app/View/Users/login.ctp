<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="/cofetch/css/bootstrap.min.css" rel="stylesheet">
	<link href="/cofetch/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="/cofetch/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/cofetch/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="/cofetch/img/favicon.ico">
	<!-- end: Favicon -->
	
			<style type="text/css">
			body { background: url(/cofetch/img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<br>
						
						
						
					</div>
					<h2>Login to your account</h2>
					
					<?php echo $this->Form->create('User',array('action'=>'login','method'=>'POST','onsubmit' => '',"class"=>"login form-horizontal",'name'=>"loginform",'id'=>"loginform")); ?> 
						<fieldset>
							
							<div class="input-prepend" title="email">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<?php echo $this->Form->input("email",array("class"=>"input input-large span10","label"=>false,"div"=>false,'id'=>"username",'size'=>"20","placeholder"=>"type email")); ?> 
								
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<?php echo $this->Form->input("password",array("class"=>"input input-large span10","label"=>false,"div"=>false,'size'=>"20",'id'=>"password","placeholder"=>"type password"));?>         
								
							</div>
							<div class="clearfix"></div>
							
						

							<div class="button-login">	
							<?php echo $this->Form->submit('login',array('class'=>"btn btn-primary ",'div'=>false,'id'=>"wp-submit",'name'=>"wp-submit")); ?>
								
							</div>
							<div class="clearfix"></div>
					</form>
					<hr>
										
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="/cofetch/js/jquery-1.9.1.min.js"></script>
	<script src="/cofetch/js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="/cofetch/js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="/cofetch/js/jquery.ui.touch-punch.js"></script>
	
		<script src="/cofetch/js/modernizr.js"></script>
	
		<script src="/cofetch/js/bootstrap.min.js"></script>
	
		<script src="/cofetch/js/jquery.cookie.js"></script>
	
		<script src='/cofetch/js/fullcalendar.min.js'></script>
	
		<script src='/cofetch/js/jquery.dataTables.min.js'></script>

		<script src="/cofetch/js/excanvas.js"></script>
	<script src="/cofetch/js/jquery.flot.js"></script>
	<script src="/cofetch/js/jquery.flot.pie.js"></script>
	<script src="/cofetch/js/jquery.flot.stack.js"></script>
	<script src="/cofetch/js/jquery.flot.resize.min.js"></script>
	
		<script src="/cofetch/js/jquery.chosen.min.js"></script>
	
		<script src="/cofetch/js/jquery.uniform.min.js"></script>
		
		<script src="/cofetch/js/jquery.cleditor.min.js"></script>
	
		<script src="/cofetch/js/jquery.noty.js"></script>
	
		<script src="/cofetch/js/jquery.elfinder.min.js"></script>
	
		<script src="/cofetch/js/jquery.raty.min.js"></script>
	
		<script src="/cofetch/js/jquery.iphone.toggle.js"></script>
	
		<script src="/cofetch/js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="/cofetch/js/jquery.gritter.min.js"></script>
	
		<script src="/cofetch/js/jquery.imagesloaded.js"></script>
	
		<script src="/cofetch/js/jquery.masonry.min.js"></script>
	
		<script src="/cofetch/js/jquery.knob.modified.js"></script>
	
		<script src="/cofetch/js/jquery.sparkline.min.js"></script>
	
		<script src="/cofetch/js/counter.js"></script>
	
		<script src="/cofetch/js/retina.js"></script>

		<script src="/cofetch/js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
