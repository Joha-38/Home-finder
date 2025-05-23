<?php 
	include"inc/header.php";

/*===========================
* Property list view process
* Page Access Control
===========================*/
	if(!isset($_GET['userid']) || $_GET['userid'] == NULL || Session::get("userLevel") != 2){
		echo"<script>window.location='../index.php'</script>";
	} else{
		$userId = $_GET['userid'];
		$getAd = $pro->propertyByUser($userId);
	}
	
/*Property remove process*/
	if(isset($_GET['delad'])){
		if($_GET['delad'] == NULL){
			echo"<script>window.location='../index.php'</script>";
		} else{
			$delAdId = $_GET['delad'];
			$deleteAdMsg = $pro->deletePropertyById($delAdId);
		}
	}
?>


<!--Dashboard Section Start------------->
<div class="container">
	<div class="mcol_12 admin_page_title">
		<div class="page_title overflow">
			<h1 class="sub-title">your ad(s)</h1>
			<h4><a href="?action=logout"><i class="fa-solid fa-right-from-bracket"></i><span>sign out</span></a></h4>
		</div>
	</div>
	
	<div class="responsive_mcol_small mcol_12">
		<?php include"inc/sidebar.php";?>
		
		<div class="responsive_mcol responsive_mcol_small mcol_8">
		<!--Admin Content Start------------->
			<div class="admin_content overflow">
			<?php
				if(isset($deleteAdMsg)){
					echo $deleteAdMsg;
				}
			?>
				<div class="admin_property_table small_display_table">
					<table id="example">
					<?php
						if($getAd){
							while($adlist = $getAd->fetch_assoc()){ ?>	
						<tr>
							<td width="20%">
								<img src="../<?php echo $adlist['adImg'];?>"/>
								<p><?php echo $adlist['adTitle'];?></p>
							</td>
							<td width="20%"><h3><?php echo $adlist['catName'];?></h3></td>
							<td width="25%"><p>Posted on: <?php echo $fm->formatDate($adlist['adDate']);?></p></td>
							<td width="12%"><p><img class="taka_sign" style="position:relative;top:-.4em;" src="../images/taka.png" alt="taka"/><?php echo $adlist['adRent']+$adlist['gasBill']+$adlist['electricBill']+$adlist['sCharge'];?>/<?php echo $adlist['rentType'];?></p></td>
							<td width="23%" class="admin_small_screen_td">
							<?php
								if($adlist['adStatus'] == 1){
							?>	
								<p class="published">published</p>
							<?php } ?>
							
								<a href="editproperty.php?adid=<?php echo $adlist['adId'];?>"><button class="btn_update"><i class="fa fa-pencil"></i></button></a>
								
								<a onclick="return confirm('Are you sure to delete this ad?')" href="?userid=<?php echo $adlist['userId']?>&&delad=<?php echo $adlist['adId'];?>"><button class="btn_delete"><i class="fa-solid fa-trash-can"></i></button></a>
							</td>
						</tr>
					<?php } } else{ ?>
						<div class="dashboard_lower_part overflow">
							<div class="overflow">
								<p>You have no posted property</p>
							</div>
							<div class="action_button overflow">
								<a style="display:inline-block !important" href="add_property.php"><button style="width:fit-content;padding:0 1em;">post your ad now</button></a>
							</div>
						</div>
					<?php } ?>
					</table>
				</div>
			</div>
		<!--Admin Content End------------->
		
		</div>
	</div>
</div>
<!--Dashboard Section End------------->


<!--Footer Section Start------------->		
<?php include"inc/footer.php";?>
<!--Footer Section End------------->