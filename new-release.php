<div class="clearfix"></div>
<div style="height:25px;"></div>
<?php
$releaseRecords=null;
$releaseRecords = $obj->releaseRecords(2);

	if(!empty($releaseRecords))
	{ 
		foreach($releaseRecords as $releaseRecord)
		{
		?>
			<div class="advertisement">
				<img src="<?php echo $siteUrl;?>admin/uploads/<?php echo $releaseRecord["release_img"];?>" style="width:100%;height:auto;" alt="<?php echo $releaseRecord["release_img"];?>" title="<?php echo $releaseRecord["release_img"];?>">
				<div class="desc">
					<h2>
					<?php
						if(!empty($releaseRecord["title_name"]))
						{
							echo $releaseRecord["title_name"];
						}					
					?>
					</h2>
					<p>
					<?php
						if(!empty($releaseRecord["description"]))
						{
							echo $releaseRecord["description"];
						}					
					?>
					</p>
				</div>
			</div>
			<div class="clearfix"></div>
			<div style="height:25px;"></div>
	<?php
		}
	} ?>