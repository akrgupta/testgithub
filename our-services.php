<!--header-start----->
<?php
	include("header.php");
?>
<!--header---end---->
<main>  
  <div class="container nav_pills">
      <div class="row">
            <div class="col-md-12">
                <div class="main_heading">
                    <a href="#" class="inactive_link">Home</a><span>&nbsp;&nbsp;&gt;&nbsp;&nbsp;</span><a class="active_link" href="#">Jazz</a>
                </div>
            </div>
      </div>
  </div>
  
  <div class="container main_content">
    <div class="row">
      <!--category-------start-->
		<div class="col-lg-3 col-md-3 col-sm-3">
			<?php
				include("category.php");
			?>
			<?php
				include("new-release.php");
			?>
		</div>
		<!--category-------end-->
		<!--our-services-detail------start---->
		<div class="col-md-9" id="our_services">
		<?php
			include("our-services-detail.php");
		?>
		</div>
       <!--our-services-detail--end--> 
    </div>
  </div>
</main>
<!--header-----start--->
<?php
if(!empty($_GET['f']))
{
@$f=$_GET['f'];
	if($f)
	{
		$urldecode = urldecode($f);
		$file = ("uploads/services/$urldecode");
		$filetype=filetype($file);
		$filename=basename($file);
		header ("Content-Type: $filetype");
		header ("Content-Length: ".filesize($file));
		header ("Content-Disposition: attachment; filename=".$filename);
		readfile($file);
		fclose($file);
	}
}
	
	include("footer.php");
?>
<!--header----end----->