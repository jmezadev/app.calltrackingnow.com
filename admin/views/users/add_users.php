		<div class="alert alert-block alert-success" id="div-alert-success" hidden>
			<a class="close" data-dismiss="alert" href="#">×</a>
			<h4 class="alert-heading"><i class="fa fa-check-circle-o"></i> User Added correctly!</h4>
			<p>
				The User was created correctly.
			</p>
		</div>
		<div class="alert alert-block alert-danger" id="div-alert-error" hidden>
			<a class="close" data-dismiss="alert" href="#">×</a>
			<h4 class="alert-heading"><i class="fa fa-times-circle-o"></i>The User Was Not Created!</h4>
			<p id="p-error-message"></p>
		</div>

		<!-- widget grid -->
		<section id="widget-grid" class="">


			<!-- START ROW -->

			<div class="row">

				<!-- NEW COL START -->
				<article class="col-sm-7 col-md-7 col-lg-7 col-lg-offset-1" id="form-add-user">

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
						<!-- widget options:
							usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

							data-widget-colorbutton="false"
							data-widget-editbutton="false"
							data-widget-togglebutton="false"
							data-widget-deletebutton="false"
							data-widget-fullscreenbutton="false"
							data-widget-custombutton="false"
							data-widget-collapsed="true"
							data-widget-sortable="false"

						-->
						<header class="background-header">
							<span class="widget-icon"> <i class="fa fa-user"></i> </span>


						</header>

						<!-- widget div-->
						<div>

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding">

								<form id="create-user-form" class="smart-form">
									<header>
										Add User
									</header>

									<fieldset>
										<div class="row">
											<section class="col col-6">
												<label class="col col-4">First Name</label>
												<label class="input col col-8"> <i class="icon-append fa fa-user"></i>
													<input type="text" id="txt-first-name" name="first_name">
													<b class="tooltip tooltip-top-right">The User's first name [*]</b> </label>
											</section>
											<section class="col col-6">
												<label class="col col-4">Last Name</label>
												<label class="input col col-8"> <i class="icon-append fa fa-user"></i>
													<input type="text" id="txt-last-name" name="last_name">
													<b class="tooltip tooltip-top-right">The User's last name [*]</b> </label>
											</section>
										</div>
										<div class="row">
											<section class="col col-6">
												<label class="col col-4">Email</label>
												<label class="input col col-8"> <i class="icon-append fa fa-envelope-o"></i>
													<input type="text" id="txt-email" name="email">
													<b class="tooltip tooltip-top-right">The User's email [*]</b> </label>
											</section>
											<section class="col col-6">
												<label class="col col-4">Phone Number</label>
												<label class="input col col-8"> <i class="icon-append fa fa-phone"></i>
													<input type="text" id="txt-phone" name="phone">
													<b class="tooltip tooltip-top-right">The User's phone number [*]</b> </label>
											</section>
										</div>
										<div class="row">
											<section class="col col-6">
												<label class="col col-4">Password</label>
												<label class="input col col-8">
													<i class="icon-append fa fa-lock"></i>
													<input type="password" id="txt-password" name="password" class="pass">
													<b class="tooltip tooltip-bottom-right">The User's password [*]</b>
												</label>
											</section>
											<section class="col col-6">
												<label class="col col-4">Confirm Password</label>
												<label class="input col col-8">
													<i class="icon-append fa fa-lock"></i>
													<input type="password" id="txt-c-password" class="pass">
													<b class="tooltip tooltip-bottom-right">Don't forget the password [*]</b>
												</label>
											</section>
										</div>
									</fieldset>

									<footer>
										<button type="button" class="btn btn-primary" id="btn-register" onclick="create_user();">
											Add
										</button>
										<button type="button" class="btn btn-default" onclick="clear_form();">
											Clean
										</button>
									</footer>
								</form>

							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->


				</article>
				<!-- END COL -->

				<!-- NEW COL (POSTER) -->

				<article class="col-sm-3 col-md-3 col-lg-3 col-lg-offset-1" id="poster-add-user">
					<div class="container-right-panel">


					<img src="<?php echo ASSETS_URL; ?>/../../../img/img_form.png" class="img-fluid" alt="Responsive image">
					<ul>
						<li>
							<div class="circulo"></div>
							<p class="texto">Enter the personal information of your new user.</p>
						</li>
						<li>
							<div class="circulo"></div>
							<p class="texto">Assign a password to your new user and confirm it.</p>
						</li>
					</ul>

				</div>

				</article>

				<!-- END NEW COL (POSTER) -->


			</div>

			<!-- END ROW -->

		</section>
		<!-- end widget grid -->

<!-- DEFINE THE TITLE HERE ON EVERY PAGE -->
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Users / Add</span></h1>";
</script>

		<script src="/js/app/users/create_user.js"></script>
