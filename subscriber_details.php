<!DOCTYPE html>
<?php ob_start(); ?>
<html lang="en">
	<head>
		<title>1Book</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $SiteURL;?>css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/subscriber_details.css">
		<link rel="stylesheet" href="css/responsive.css">
	</head>
	<body>
		<div class="mainWrap">
			<div class="navmenu navmenu-default navmenu-fixed-left offcanvas leftUserDetail">
				<div class="userDetail">
					<div class="userName"><a href="#">Rajat Nandwani</a></div>
					<div><a href="#">rajatnandwani1991@gmail.com</a></div>
					<a href="#" class="userLoginIcon transform1 transEase"><span class="fa fa-lock" aria-hidden="true"></span></a>
					<ul class="nav navmenu-nav sideMenu1">
						<li><a href="#"><img src="img/readerIcons/bookshelf.png" alt="Bookshelf" class="menuImg" /> Manage Books/Notes</a></li>
						<li><a href="#"><img src="img/readerIcons/upload_content.png" alt="Upload Content" class="menuImg" /> Upload Content</a></li>
					</ul>
					<ul class="nav navmenu-nav sideMenu2">
						<li><a href="#"><img src="img/readerIcons/profile.png" alt="Profile" class="menuImg" /> My Profile</a></li>
						<li><a href="#"><img src="img/readerIcons/comment.png" alt="Comments" class="menuImg" /> Rating/Comments</a></li>
						<li><a href="#"><img src="img/readerIcons/subscribers.png" alt="Subscribers" class="menuImg" /> Manage Subscribers</a></li>
						<li><a href="#"><img src="img/readerIcons/invite_frnd.png" alt="Invite A Friend" class="menuImg" /> Send Notification</a></li>
						<li><a href="#"><img src="img/readerIcons/statistics.png" alt="Statistics" class="menuImg" /> Statistics(Usage & Download)</a></li>
					</ul>
				</div>
				<ul class="nav navmenu-nav sideMenu3">
					<li><a href="#"><img src="img/readerIcons/library.png" alt="Library" class="menuImg" /> Bookshelf(Shop Now)</a></li>
					<li><a href="#"><img src="img/readerIcons/support.png" alt="support" class="menuImg" /> Support</a></li>
					<li><a href="#"><img src="img/readerIcons/about_us.png" alt="About Us" class="menuImg" /> About Us</a></li>
					<li><a href="#"><img src="img/readerIcons/contact_us.png" alt="Contact Us" class="menuImg" /> Contact Us</a></li>
					<li><a href="#"><img src="img/readerIcons/feedback.png" alt="Feedback" class="menuImg" /> Feedback</a></li>
					<li><a href="#"><img src="img/readerIcons/sign_out.png" alt="Sign Out" class="menuImg" /> Sign Out</a></li>
				</ul>
			</div>
			<div class="navbar navbar-default navbar-fixed-top resNav">
				<div class="navbar-toggle leftNavFixed mbpadd515">
					<div class="resPullLeft">
						<div><span class="fa fa-bars barToggle faSlideIcons transEase" aria-hidden="true" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" data-autohide="false"></span></div>
						<div><span class="fa fa-home faSlideIcons transEase" aria-hidden="true"></span></div>
					</div>
					<div class="resPullRight">
						<div class="resOuterDiv">
							<div class="resInnerDiv">Publisher Dashboard</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container wrapMB">
				<div class="col-xs-12 padd0 mbHeadDiv">
					<div class="pull-left">
						<img src="img/readerIcons/subscribers_big.png" alt="Bookshelf Logo" class="img-responsive mbBshelf"/>
						<div class="mbManage">
							<div class="mBooksTxt">Manage Subscribers</div>
							<ul class="list-inline">
								<li><a href="#">Subscriber Details</a></li>
								<li><a href="#">Manage Groups</a></li>
								<li><a href="#">Send Notification</a></li>
								<li><a href="#">Free Subscription</a></li>
							</ul>
						</div>
					</div>
					<div class="pull-right">
						<form class="mtop19">
							<a href="#"><img src="img/readerIcons/subscribers_mid.png" alt="Subscriber Logo" class="img-responsive rightIcons1 mRight10" /></a>
							<a href="#" data-toggle="modal" data-target="#notifModal"><img src="img/readerIcons/invite_frnd_mid.png" alt="Invite Friend Logo" class="img-responsive rightIcons1" /></a>
						</form>
					</div>
				</div>
				<!-- Start Modal -->
				<div class="modal fade" id="notifModal" role="dialog">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header modHead1">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">SEND NOTIFICATION(S)</h4>
							</div>
							<div class="modal-body modBody1">
								<form class="form-horizontal modForm1">
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">To</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput1" type="text" value="">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Subject</label>
										<div class="col-sm-10 paddL10R0">
											<input class="form-control mgForm1" id="focusedInput2" type="text" value="">
										</div>
									</div>
									<div class="form-group margin0 mbottom8">
										<label class="col-sm-2 control-label padd0 fWeight">Message</label>
										<div class="col-sm-10 paddL10R0">
											<textarea class="form-control mgForm1 mgTextArea1" id="focusedInput3" rows="5"></textarea>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer modFoot1 text-left">
								<div class="col-xs-10 col-xs-offset-2 paddL10R0">
									<form class="goBtnForm2">
										<button type="button" class="btn npBtn1 npBtn3 btn-default">SEND</button>
									</form>
									<button type="button" class="btn btn-default npBtn4" data-dismiss="modal">CANCEL</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->
				<div class="col-xs-12 padd0 ndEco">
					<div class="mgLeftPart">
						<div class="npDivWidth1">
							<select class="form-control user_drop_dwn selectGroup">
								<option>By Group</option>
								<option>Group 1</option>
								<option>Group 2</option>
								<option>Group 3</option>
								<option>Group 4</option>
							</select>
						</div>
						<div id="datetimepicker1" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="From Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<div id="datetimepicker2" class="input-append date npDivWidth1">
							<input data-format="dd/MM/yyyy" type="text" class="form-control user_drop_dwn border_radius4" placeholder="To Date">
							<span class="add-on input-group-addon no_css">
							<i class="fa fa-calendar clrOrange"></i>
							</span>
						</div>
						<form class="goBtnForm1">
							<button type="button" class="btn npBtn1 btn-default">Go</button>
						</form>
						<!-- <button type="button" class="btn btn-success npBtn2" data-toggle="modal" data-target="#mgModal">+ NEW GROUP</button> -->
					</div>
					<div class="mgRightPart">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 padd0">
					<div class="table-responsive">
						<table class="table mgTable2">
							<thead>
								<tr>
									<th><input type="checkbox" value="" id="checkAll" /></th>
									<th>#</th>
									<th>SUBSCRIBER NAME</th>
									<th>EMAIL</th>
									<th>MORE DETAILS</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>1</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>2</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>3</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>4</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>5</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>6</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>7</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>8</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>9</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>10</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>11</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>12</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>13</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>14</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>15</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>16</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>17</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>18</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>19</td>
									<td>Rajat Nandwani</td>
									<td>rajatnandwani1991@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="toggleCheck" /></td>
									<td>20</td>
									<td>Ranjeet Singh</td>
									<td>ranjeet3681@gmail.com</td>
									<td><a href="#" class="linkClr">Click Here..</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xs-12 padd0">
					<div class="mgRightPart mgRightPart2">
						<ul class="pagination">
							<li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-12 footer2a">
				<div class="pull-left xs_100">Copyrights @ 2016 1Book All Right Reserved</div>
				<div class="pull-right xs_100">Designed by <a href="http://www.4cplus.com" target="_blank">4C Plus</a></div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/jasny-bootstrap.min.js"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<script src="js/index.js"></script>
		<script>
			/* Date Time Function Start */
			$(function() {
				$('#datetimepicker1, #datetimepicker2').datetimepicker({
				pickTime: false
				});
			});
			/* End */
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>