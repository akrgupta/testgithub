<?php
session_start();
include_once("admin/crud.php");
$obj = new  Crud();
if(!empty($_POST['service_id']))
{
$service_id=$_POST['service_id'];
$categs_id=$_POST["categs_id"];
$categs_name=$_POST["categs_name"];
//var_dump($service_id);
$dwnldSessionRecords=NULL;
$dwnldSessionRecords = $obj->downloadSessionRecord($service_id,$categs_id);
?>
<div class="main_heading">
	  <h1><?php echo $categs_name;?></h1>
</div>
<?php
if(!empty($dwnldSessionRecords))
{?>
<div class="clearfix"></div>
<div class="row_spacing"></div>
<?php
foreach($dwnldSessionRecords[$service_id] as $dwnldSessionRecord)
{
?>
<div class="row">
  <div class="col-md-3">
		<?php 
		if(!empty($dwnldSessionRecord["type"]))
		{
			$type=explode("/",$dwnldSessionRecord["type"]);
			$formate = $type[0];
			if($formate == 'image')
			{
				?>
				<img src="http://localhost/music/admin/uploads/services/<?php echo $dwnldSessionRecord["image"];?>" alt="" style="margin:0 0 10px 0;" />
				<?php
			}
			elseif($formate=='video')
			{
		
			?>
				<video width="225" controls >
				  <source src="http://localhost/music/admin/uploads/services/<?php echo $dwnldSessionRecord['image']; ?>" type="<?php echo $dwnldSessionRecord['type']; ?>">
				</video>
			<?php
			}
			elseif($formate=='audio')
			{
			?>	
				<audio width="200" controls>
					<source src="http://localhost/music/admin/uploads/services/<?php echo $dwnldSessionRecord['image']; ?>" type="<?php echo $dwnldSessionRecord['type']; ?>">
				</audio> 
			<?php
			}
		}
		?>
  </div>
  <div class="col-md-7">
		<h2 style="font-weight:bold;margin:0 0 10px 0;font-size:18px;"><?php echo $dwnldSessionRecord["title"];?></h2>
		<p class="details"><?php echo $dwnldSessionRecord["description"];?></p>
  </div>
  <div class="col-md-2">
		<?php
		if(!empty($dwnldSessionRecord["type"]))
		{
		/*
		<a href='our-services.php?service-id=<?php echo $dwnldSessionRecord['service_id'];?>&f=<?php echo $dwnldSessionRecord['image'];?>'>Dwonload<a>
		*/
		?>
		<div id="dwnload" onclick="downloadMedia('<?php echo $dwnldSessionRecord['service_id'];?>','<?php echo $dwnldSessionRecord['image'];?>','<?php echo $dwnldSessionRecord['id'];?>');" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="font-size:14px;color:#FFFFFF;padding:10px 15px;border:none;background:rgba(0,0,0,0.9);margin:15px 0 0 0;">
		Download
		</div>
		<?php
		}?>
		<input type="submit" value="Download" style="font-size:14px;color:#FFFFFF;padding:10px 15px;border:none;background:rgba(0,0,0,0.9);margin:15px 0 0 0;" />	
  </div>
</div>
<div class="clearfix"></div>
<div class="row_spacing"></div>
<?php
 }
 }
 ?>
 <script type="text/javascript">
  function downloadMedia($service_id,$media,$dwnld_session_id)
  {
	$("#service_id").val($service_id);
	$("#media").val($media);
	$("#dwnld_session_id").val($dwnld_session_id);
	$(document).ready(function(){
	$("#downlod").on('click', function(event) {
		var dataString = $("#email_form_id").serialize();
		$.ajax({
			type: "POST",
			url: "downloadmedia.php",
			data: dataString,
			cache: false,
			beforeSend:function()
			{	
					var email = $("#email-id").val();
					var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if(email == "")
					{
						$("#erroremial").show();
						$("#erroremial").html("Enter an email");
						setTimeout(function(){
						$("#erroremial").hide();
						},2000);
						return false;
					}
					if(!regex.test(email)){
						$("#erroremial").show();
						$("#erroremial").html("Enter a correct email");
						setTimeout(function(){
						$("#erroremial").hide();
						},2000);
						return false;
					}
					return true;
			},
			success: function(html)
			{
				if(html==2)
				{
					var url='our-services.php?service-id=' + $service_id + '&f=' + $media;
					$(location).attr('href', url);
					$("#close").click();
				}
				if(html==1)
				{
					var url='our-services.php?service-id=' + $service_id + '&f=' + $media;
					$(location).attr('href', url);
					$("#close").click();
				}
				
			}});
			});
			});
  }
 </script>
<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<form method="post"  id="email_form_id">
			<div class="modal-content" style="background-color: #5A7F9E;">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Music</h4>
			  </div>
			 <div style="color:#252020;font-size:25px;text-align:center;"> Please Enter an Email Id-</div>
			  <div class="modal-body">
				 <div style="text-align:center;"> <input type="text" name="email-id" placeholder="please enter an email-id" required id="email-id" value="<?php if(!empty($_SESSION["email_id"])){echo $_SESSION["email_id"];}?>"></div>
				<input type="hidden" name="service_id" placeholder="please enter an email-id" required id="service_id" value="">
				<input type="hidden" name="media" placeholder="please enter an email-id" required id="media" value="">
				<input type="hidden" name="dwnld_session_id" placeholder="please enter an email-id" required id="dwnld_session_id" value="">
			 </div>
			  <div class="modal-footer">
			  <div id="erroremial" style="display:none;color:red;font-size:12px;text-align:center;"></div>
				<button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="downlod" class="btn btn-primary">Save</button>
			  </div>
			</div>
			</form>
		  </div>
		</div>
		<!-- Button trigger modal -->

 
 <?php
 }
?>