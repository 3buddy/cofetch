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
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<?php echo $this->element('header'); ?>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
				<?php echo $this->element('sidebar'); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/cofetch/Users/dashboard">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="/cofetch/Users/detail_edit">edit</a>
				</li>
			</ul>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit detail</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
						<?php echo $this->Form->create('Detail',array('controller'=>'Users','action'=>'/./../Users/detail_edit','method'=>'POST','enctype' => 'multipart/form-data',"class"=>"form-horizontal")); ?>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Going to</label>
							  <div class="controls">
					<?php
				 echo $this->Form->input("to",array('controller'=>'Users',"type"=>"text","class"=>"span6 typeahead",'id'=>"typeahead",'data-provide'=>"typeahead",'data-items'=>"4","label"=>false,"div"=>false));
                  ?>    	
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">from where</label>
							  <div class="controls">
							<?php
				 echo $this->Form->input("from",array('controller'=>'Users',"type"=>"text","class"=>"span6 typeahead",'id'=>"typeahead",'data-provide'=>"typeahead",'data-items'=>"4","label"=>false,"div"=>false));
                  ?>    	
           
								
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="fileInput">Total distance</label>
							   <div class="controls">
							<?php
				 echo $this->Form->input("distance_covered",array('controller'=>'Users',"type"=>"text","class"=>"span6 typeahead",'id'=>"typeahead",'data-provide'=>"typeahead",'data-items'=>"4","label"=>false,"div"=>false));
                  ?>    	
           
								
							  </div>
							</div>

							
							<div class="form-actions">
							<?php echo $this->Form->hidden("id");
							echo $this->Form->submit('Update',array('controller'=>'Users','class'=>"btn btn-primary ",'div'=>false,'onclick'=>"location.href='".BASE_URL."Users/detail_list'")); 
			 echo $this->Form->button('close',array('type'=>'submit','class'=>"btn",'div'=>false,'onclick'=>"detail_list'")); ?>
							  
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

			
	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	
	
	
	
	
	
	<!-- start: JavaScript-->
<?php echo $this->element('footer');?>
	<!-- end: JavaScript-->
	
</body>
</html>
