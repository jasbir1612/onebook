  <!-- Code start for Educator/Publisher Dashboard -->
  <?php include "cs/config.php"; ?>
  <div class="navmenu navmenu-default navmenu-fixed-left offcanvas leftUserDetail">
	<div class="userDetail">
	   <!-- Code Start for check the session -->
	   <?php 
		    //session_start();
		    if(isset($_COOKIE['useremailid']))
			{
				?>		
				<div class="userName"><a href="#"><?php echo $_COOKIE['username']?></a></div>
				<div><a href="#"><?php echo $_COOKIE['useremailid']?></a></div>
				<?php 
			}
			else
			{
				$WebSite_URL="location:".$SiteURL;
			    header($WebSite_URL);
			}
		?>
	  <!-- Code End for check the session -->
		
		<a href="#" class="userLoginIcon transform1 transEase"><span class="fa fa-lock" aria-hidden="true"></span></a>
		<ul class="nav navmenu-nav sideMenu1">
		
		   <!-- Header Start Here -->
		   <?php 
		    if(isset($_COOKIE['useremailid']))
			{
			    if($_COOKIE['roleid']=="0")
				{
				?>		
				<li><a href="<?php echo $SiteURL;?>admin/admin_modify_booknotes.html" class="dropdown-toggle"><span class="icoR1"><img src="<?php echo $SiteURL;?>img/readerIcons/books.png" alt="Bookshelf" /></span> Manage Books/Notes</a>
				</li>
				<li><a href="<?php echo $SiteURL;?>admin/modify_user.html" class="dropdown-toggle"><span class="icoR1"><img src="<?php echo $SiteURL;?>img/readerIcons/educators.png" alt="Manage Educators" /></span> Manage Educators</a>
				</li>
				<li><a href="<?php echo $SiteURL;?>admin/modify_student.html" class="dropdown-toggle"><span class="icoR1"><img src="<?php echo $SiteURL;?>img/readerIcons/students.png" alt="Bookshelf"  /></span> Manage Students</a>
				</li>
				<?php 
				}
				if($_COOKIE['roleid']=="2")
				{
				?>		
			    <li><a href="<?php echo $SiteURL;?>manageBooks.html"><img src="<?php echo $SiteURL;?>img/readerIcons/upload_content.png" alt="Upload Content" class="menuImg" />Upload Content</a></li>
				<li><a href="<?php echo $SiteURL;?>modify_booknotes.html"><img src="<?php echo $SiteURL;?>img/readerIcons/bookshelf.png" alt="Bookshelf" class="menuImg" />Manage Books/Notes</a></li>
				<li><a href="<?php echo $SiteURL;?>manageGroups.html"><img src="<?php echo $SiteURL;?>img/readerIcons/subscribers.png" alt="Subscribers" class="menuImg" />Manage Groups</a></li>
				<?php 
				}
				if($_COOKIE['roleid']=="3")
				{
				?>		
			    <li><a href="<?php echo $SiteURL;?>manageBooks.html"><img src="<?php echo $SiteURL;?>img/readerIcons/upload_content.png" alt="Upload Content" class="menuImg" />Upload Content</a></li>
				<li><a href="<?php echo $SiteURL;?>modify_booknotes.html"><img src="<?php echo $SiteURL;?>img/readerIcons/bookshelf.png" alt="Bookshelf" class="menuImg" />Manage Books/Notes</a></li>
				<li><a href="<?php echo $SiteURL;?>subscriber_details.html"><img src="<?php echo $SiteURL;?>img/readerIcons/subscribers.png" alt="Subscribers" class="menuImg" />Manage Subscribers</a></li>
				<?php 
				}
			}
		    ?>
			<!-- Header end Here -->
			
		</ul>
		<ul class="nav navmenu-nav sideMenu2">
		    <?php 
		       if($_COOKIE['roleid']=="2" || $_COOKIE['roleid']=="3")
				{
				?>
				<li style="display:none;"><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/profile.png" alt="Profile" class="menuImg" />My Profile</a></li>
				<li style="display:none;"><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/comment.png" alt="Comments" class="menuImg" /> Rating/Comments</a></li>
				<li style="display:none;"><a href="#"><img src="<?php echo $SiteURL;?>img/readerIcons/invite_frnd.png" alt="Invite A Friend" class="menuImg" /> Send Notification</a></li>
				<li><a href="<?php echo $SiteURL;?>analytics/analytics_overview.html"><img src="<?php echo $SiteURL;?>img/readerIcons/statistics.png" alt="Statistics" class="menuImg" />Sales Report & Analytics</a></li>
				<li><a href="<?php echo $SiteURL;?>payment_agreement.html" target="_blank"><img src="<?php echo $SiteURL;?>img/readerIcons/agreement.png" alt="Payment Agreement" title="Payment Agreement" class="menuImg" />Publishing Terms & Conditions</a></li>
				<li><a href="<?php echo $SiteURL;?>payment_terms.html" target="_blank"><img src="<?php echo $SiteURL;?>img/readerIcons/terms.png" alt="Payment Terms" title="Payment Terms" class="menuImg" />Payment Terms</a></li>
				<li><a href="<?php echo $SiteURL;?>bank_details.html"><img src="<?php echo $SiteURL;?>img/readerIcons/terms.png" alt="Payment & Banking" title="Payment & Banking" class="menuImg" />Payment & Banking</a></li>
				<?php 
				}
		  ?>
		</ul>
	</div>
	<ul class="nav navmenu-nav sideMenu3">
		<li><a href="<?php echo $SiteURL;?>bookshelf.html"><img src="<?php echo $SiteURL;?>img/readerIcons/library.png" alt="Library" class="menuImg" /> Bookstore</a></li>
		<!--<li><a href="#"><img src="img/readerIcons/support.png" alt="support" class="menuImg" /> Support</a></li>
		<li><a href="#"><img src="img/readerIcons/about_us.png" alt="About Us" class="menuImg" /> About Us</a></li>
		<li><a href="#"><img src="img/readerIcons/contact_us.png" alt="Contact Us" class="menuImg" /> Contact Us</a></li>-->
		<li><a href="<?php echo $SiteURL;?>feedback.html"><img src="<?php echo $SiteURL;?>img/readerIcons/feedback.png" alt="Feedback" class="menuImg" /> Feedback</a></li>
		<?php 
		   if(isset($_COOKIE['useremailid']))
			{
				?>		
				<li><a href="<?php echo $SiteURL;?>logout.php"><img src="<?php echo $SiteURL;?>img/readerIcons/sign_out.png" alt="Sign Out" class="menuImg" />Sign Out</a></li>
				<?php 
			}
		?>
	</ul>
</div>
<div class="navbar navbar-default navbar-fixed-top resNav">
	<div class="navbar-toggle leftNavFixed mbpadd515">
		<div class="resPullLeft">
			<div><span class="fa fa-bars barToggle faSlideIcons transEase" aria-hidden="true" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-autohide="false"></span></div>
			<div><a href="<?php echo $SiteURL;?>"><span class="fa fa-home faSlideIcons transEase" aria-hidden="true"></span></a></div>
		</div>
		<div class="resPullRight">
			 <div class="resOuterDiv">
			 <!-- Code Start for check the user(Educator/Publisher)-->
			 <?php 
			    if($_COOKIE['roleid']=="0")
				{
				?>		
				 <div class="resInnerDiv">Admin's Dashboard</div>
				<?php 
				}
			    if($_COOKIE['roleid']=="2")
				{
				?>		
				 <div class="resInnerDiv">Educator's Dashboard</div>
				<?php 
				}
				else if($_COOKIE['roleid']=="3")
				{
				  ?>		
				 <div class="resInnerDiv">Publisher's Dashboard</div>
				  <?php 
				}
		      ?>
			  <!-- Code end for check the user(Educator/Publisher)-->
			</div>
		</div>
	</div>
</div>

<!-- Code end for Educator/Publisher Dashboard -->