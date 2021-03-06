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
<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php echo $this->element('sidebar'); ?>
			<!-- end: Main Menu -->
			
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="/cofetch/Users/dashboard">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="/cofetch/Customers/customer_list">customer listing</a></li>
			</ul>
               <div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customers</h2>
						<div class="box-icon">
						
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table">
							  <thead>
								  <tr>
									   <th><?php echo $this->Paginator->sort('Customer.firstname','first name');?></th>
								  <th><?php echo $this->Paginator->sort('Customer.firstname','last name');?></th>
								  <th><?php echo $this->Paginator->sort('Customer.firstname','email');?></th>
								  <th><?php echo $this->Paginator->sort('Customer.firstname','contact');?></th>
								  <th>Actions</th>
								  
							  </tr>
							  <?php  if(count($resultData)>0){
												$i = 1;
												foreach($resultData as $result):
													?>	
							  </thead>   
							  <tbody>
								<tr>
									<td><?php echo $result['Customer']['firstname']; ?></td>
								<td class="center"><?php echo $result['Customer']['lastname']; ?></td>
								<td class="center"><?php echo $result['Customer']['email']; ?></td>
								<td class="center">
									<?php echo $result['Customer']['contact']; ?>
								</td> 
<td class="center">
												<?php
						echo $this->Html->link("",
						array('controller'=>'customers','action'=>'customer_edit',$result['Customer']['id']),
						array('class'=>'icon-edit','title'=>'edit')
					); 
						?>
									
									<?php
						echo $this->Html->link("",
						array('controller'=>'customers','action'=>'del_customer',$result['Customer']['id']),
						array('class'=>'icon-trash','title'=>'Delete')
					);
						?>
										
									
								</td>
							</tr>
							                               </tr><?php $i++ ;
				endforeach; ?>
				<?php } else { }?>
															
								</tr>
								           
							  </tbody>
						 </table>  
						     
					</div>
				</div><!--/span-->
			
			
			
			
		
				
		
    

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<?php echo $this->element('footer');?>
	</body>
</html>