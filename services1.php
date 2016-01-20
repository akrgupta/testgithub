<div class="col-lg-9 col-md-9 col-sm-9">
	<div class="main_heading">
	  <h1>Our Services</h1>
	</div>
	<div class="clearfix"></div>
	<div class="row_spacing"></div>
	<div class="row">
	<?php
		$services=$obj->ourServicesRecord(3);
		$index=1;
		if(!empty($services))
		{
			foreach($services as $service)
			{
				?>
				<div class="col-lg-4 col-md-4 col-sm-4">
				<a href="our-services.php?service-id=<?php echo $service["id"];?>">
					<img src="<?php echo $siteUrl;?>admin/uploads/<?php echo $service["img"];?>" alt="<?php echo $service["title_name"];?>" title="<?php echo $service["title_name"];?>"/>
				</a>
				<div class="title">
					<h3><a href="our-services.php?service-id=<?php echo $service["id"];?>" class="services" title="<?php echo $service["title_name"];?>"><?php echo $service["title_name"];?></a></h3>
					<p><a href="our-services.php?service-id=<?php echo $service["id"];?>">View More...</a></p>
				</div>
				</div>
				<?php
				
				if($index % 3 ==0)
				{
				?>
				<div class="clearfix"></div>
				<div class="row_spacing"></div>
				<?php
				}
				$index++;
			}
		}
		?>
	</div>
	
</div>