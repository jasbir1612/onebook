 <!-- Code start for End User Dashboard -->
 <?php include "cs/config.php"; ?>
<div class="navmenu navmenu-default navmenu-fixed-left offcanvas leftUserDetail">
  <div class="userDetail">
		<?php 
		   session_start();
		    if(isset($_COOKIE['useremailid']))
			{
				?>		
				<div class="userName"><a href="#"><?php echo $_COOKIE['username']?></a></div>
				<div><a href="#"><?php echo $_COOKIE['useremailid'] ?></a></div>
				<?php 
			}
			else
			{
			    $WebSite_URL="location:".$SiteURL;
			    header($WebSite_URL);
			}
		?>
	<div class="buttonPart mtop10 hidden">
		<button type="button" class="btn btn-default transEase">Launch App</button>
		<button type="button" class="btn btn-default transEase">Install App</button>
	</div>
	<a href="#" class="userLoginIcon transform1 transEase"><span class="fa fa-lock" aria-hidden="true"></span></a>
	<ul class="nav navmenu-nav sideMenu1">
	    <?php 
		if($_COOKIE['roleid']=="1") 
		{
		?>
		<li><a href="<?php echo $SiteURL;?>mybookshelf.html"><img src="<?php echo $SiteURL;?>img/readerIcons/bookshelf.png" alt="Bookshelf" class="menuImg" /> Dashboard</a></li>
		<?php 
		}
		 else if($_COOKIE['roleid']=="2" || $_COOKIE['roleid']=="3")
		{
		?>
		<li><a href="<?php echo $SiteURL;?>modify_booknotes.html"><img src="<?php echo $SiteURL;?>img/readerIcons/bookshelf.png" alt="Bookshelf" class="menuImg" /> Dashboard</a></li>
		<?php 
		}
		?>
		<li style="display:none"><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/highlighter.png" alt="Highlighters" class="menuImg" /> Highlighters</a></li>
		<li style="display:none"><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/notification.png" alt="Notification" class="menuImg" /> Notifications</a></li>
	</ul>
	<ul style="display:none" class="nav navmenu-nav sideMenu2">
		<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/profile.png" alt="Profile" class="menuImg" /> My Profile</a></li>
		<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/book_sharing.png" alt="Book Sharing" class="menuImg" /> Book(s) Sharing</a></li>
		<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/redeem.png" alt="redeem" class="menuImg" /> Redeem</a></li>
		<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/invite_frnd.png" alt="Invite A Friend" class="menuImg" /> Invite a Friend</a></li>
		<li><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/device.png" alt="Refresh" class="menuImg" /> Devices</a></li>
	</ul>
 </div>
<ul class="nav navmenu-nav sideMenu3">
	<li><a href="<?php echo $SiteURL."bookshelf.html";?>"><img src="<?php echo $SiteURL;?>img/readerIcons/library.png" alt="Library" class="menuImg" /> Bookstore</a></li>
	<!--<li><a href="#"><img src="img/readerIcons/support.png" alt="support" class="menuImg" /> Support</a></li>
	<li><a href="#"><img src="img/readerIcons/about_us.png" alt="About Us" class="menuImg" /> About Us</a></li>
	<li><a href="#"><img src="img/readerIcons/contact_us.png" alt="Contact Us" class="menuImg" /> Contact Us</a></li>-->
	<li><a href="feedback.html"><img src="<?php echo $SiteURL;?>img/readerIcons/feedback.png" alt="Feedback" class="menuImg" /> Feedback</a></li>
	<?php 
	   if(isset($_COOKIE['useremailid']))
		{
			?>		
			<li><a href="logout.php"><img src="<?php echo $SiteURL;?>img/readerIcons/sign_out.png" alt="Sign Out" class="menuImg" />Sign Out</a></li>
			<?php 
		}
	?>
</ul>
</div>
<div class="navbar navbar-default navbar-fixed-top resNav">
	<div class="navbar-toggle leftNavFixed">
		<div class="resPullLeft">
			<div><span class="fa fa-bars barToggle faSlideIcons transEase" aria-hidden="true" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-autohide="false"></span></div>
			<div><a href="<?php echo $SiteURL;?>index.html"><span class="fa fa-home faSlideIcons transEase" aria-hidden="true"></span></a></div>
		</div>
		<div class="resPullRight mtop120">
			<div style="display:none"><span class="fa fa-search reset faSlideIcons transEase" aria-hidden="true"></span></div>
			<div style="display:none"><span class="faSlideIcons transEase"><span class="fa fa-font bigA" aria-hidden="true"></span><span class="fa fa-font smallA" aria-hidden="true"></span></span></div>
			<div><span class="fa fa-search-minus zoom-out faSlideIcons transEase" aria-hidden="true"></span></div>
			<div><span class="fa fa-search-plus zoom-in faSlideIcons transEase" aria-hidden="true"></span></div>
			<div style="display:none"><span class="fa fa-list-ul faSlideIcons transEase" aria-hidden="true"></span></div>
			<div style="display:none"><span class="fa fa-file-text faSlideIcons transEase" aria-hidden="true"></span></div>
		</div>
	</div>
</div>

 <!-- Code end for End User Dashboard -->

