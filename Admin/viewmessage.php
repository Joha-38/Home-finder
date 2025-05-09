<?php
	include"inc/header.php";
	
	/*========================
	Access Control
	========================*/
	if(Session::get("userLevel") != 3){
		echo"<script>window.location='../index.php'</script>";
	}
	
	if(!isset($_GET['msgid']) && isset($_GET['nftmsg'])){
		if($_GET['nftmsg'] == NULL){
			echo"<script>window.location='../index.php'</script>";
		} else{
			$nftMsg  = $_GET['nftmsg'];
		}
	} else{
		if(!isset($_GET['nftmsg']) && isset($_GET['msgid'])){
			if($_GET['msgid'] == NULL){
				echo"<script>window.location='../index.php'</script>";
			} else{
				$msgId  = $_GET['msgid'];
			}
		}
	}
?>


<!--Dashboard Section Start------------->
<div class="container">
	<div class="mcol_12 admin_page_title">
		<div class="page_title overflow">
			<h1 class="sub-title">message</h1>
			<h4><a href="?action=logout"><i class="fa-solid fa-right-from-bracket"></i><span>sign out</span></a></h4>
		</div>
	</div>
	
	<div class="responsive_mcol_small mcol_12">
		<?php include"inc/sidebar.php";?>
		
		<div class="responsive_mcol responsive_mcol_small mcol_8">
		<!--Admin Content Start------------->
			<div class="admin_content overflow">
				<div class="responsive_mcol_small user_profile">
					<div class="profile_body tbl_msg">
					<form action="" method="POST">
					
					<!-- For notification ---------->
					<?php
						if(isset($_GET['nftmsg'])){
						$getNtf = $ntf->getNotificationById($nftMsg);
						if($getNtf){
							while($notification = $getNtf->fetch_assoc()){ 
					?>	
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>from</p></div>
							<div class="msg_field_box"><input type="email" value="<?php echo $notification['notfEmail'];?>"readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>name</p></div>
							<div class="msg_field_box"><input type="text" value="<?php echo $notification['notfName'];?>" readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>phone</p></div>
							<div class="msg_field_box"><input type="phone" value="<?php echo $notification['notfPhone'];?>" readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>message</p></div>
							<div class="msg_field_box"><textarea class="tinymce"><?php echo $notification['notfMsg'];?></textarea></div>
						</div>
						
						<div class="action_button msg_button">
							<a class="btn_update" href="replymessage.php?msgid=<?php echo $notification['notfId'];?>">reply</a>
						</div>
					<?php } } else{ ?>
						<div class="dashboard_lower_part overflow">
							<div class="overflow">
								<p>No Message Available</p>
							</div>
						</div>
					<?php } } ?>
					
					
					<!--For general message ---------->
					<?php
						if(isset($_GET['msgid'])){
						$getMsg = $ibx->getMessageById($msgId);
						if($getMsg){
							while($msg = $getMsg->fetch_assoc()){ 
					?>	
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>from</p></div>
							<div class="msg_field_box"><input type="email" value="<?php echo $msg['msgEmail'];?>"readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>name</p></div>
							<div class="msg_field_box"><input type="text" value="<?php echo $msg['msgName'];?>" readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>phone</p></div>
							<div class="msg_field_box"><input type="phone" value="<?php echo $msg['msgPhone'];?>" readonly /></div>
						</div>
						
						<div class="msg_block_body overflow">
							<div class="msg_field_box"><p>message</p></div>
							<div class="msg_field_box"><textarea class="tinymce"><?php echo $msg['msgText'];?></textarea></div>
						</div>
						
						<div class="action_button msg_button">
							<a class="btn_update" href="replymessage.php?msgid=<?php echo $msg['msgId'];?>">reply</a>
						</div>
					<?php } } else{ ?>
						<div class="dashboard_lower_part overflow">
							<div class="overflow">
								<p>No Message Available</p>
							</div>
						</div>
					<?php } } ?>
					</form>
					</div>
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