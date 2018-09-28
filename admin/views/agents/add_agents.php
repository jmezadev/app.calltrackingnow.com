
<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-7 col-md-7 col-lg-7 col-lg-offset-1 margin-top-forms" id="form-add-agent">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false"
                 data-widget-custombutton="false">
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

                        <form id="smart-form-register" class="smart-form" method="post"
                              action="../../controllers/extensions/extensions_controller.php">
                            <header>
                                Add Agent
                            </header>

                            <fieldset>
                              <div class="row">
                                <section class="col col-6">
                                   <label class="col col-4 ">First Name</label>
                                    <label class="input col col-8"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="addAgentFirstName">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                                <section class="col col-6">
                                   <label class="col col-4 ">Last Name </label>
                                    <label class="input col col-8"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="addAgentLastName">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                              </div>
                              <div class="row">
                                <section class="col col-6">
                                   <label class="col col-4 ">Assign Username</label>
                                    <label class="input col col-8"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="addAgentAssignUsername" >
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                                <section class="col col-6">
                                   <label class="col col-4 ">Assign Password</label>
                                    <label class="input col col-8"> <i class="icon-append fa fa-lock"></i>
                                        <input type="text" name="addAgentAssignPassword" >
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                              </div>
                            </fieldset>
                              <header>
                                Additional Settings
                            </header>

                                <fieldset>

                                  <div class="row">
                                <section class="col col-6">
                                    <label class=" col col-4">Campaign</label>
                                    <label class=" select col col-8">
                                        <select id="select-1">
                                      <option>Amsterdam</option>
                                      <option>Atlanta</option>
                                      <option>Baltimore</option>
                                      <option>Boston</option>
                                      <option>Buenos Aires</option>
                                      <option>Calgary</option>
                                      <option>Chicago</option>
                                      <option>Denver</option>
                                      <option>Dubai</option>
                                      <option>Frankfurt</option>
                                      <option>Hong Kong</option>
                                      <option>Honolulu</option>
                                      <option>Houston</option>
                                      <option>Kuala Lumpur</option>
                                      <option>London</option>
                                      <option>Los Angeles</option>
                                      <option>Melbourne</option>
                                      <option>Mexico City</option>
                                      <option>Miami</option>
                                      <option>Minneapolis</option>
                                    </select> <i></i> </label>
                                </section>
                                <section class="col col-6">
                                    <label class=" col col-4">Extension</label>
                                    <label class=" select col col-8">
                                        <select id="select-1">
                                      <option>+572</option>
                                      <option>+574</option>
                                      <option>+579</option>
                                      <option>+576</option>
                                      <option>+575</option>
                                      <option>+542</option>
                                      <option>+532</option>
                                      <option>+592</option>
                                      <option>+573</option>
                                      <option>+472</option>
                                      <option>+372</option>
                                      <option>+272</option>
                                      <option>+172</option>
                                      <option>+672</option>
                                      <option>+589</option>
                                      <option>+588</option>
                                      <option>+892</option>
                                      <option>+822</option>
                                      <option>+832</option>
                                      <option>+833</option>
                                    </select> <i></i> </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="col col-4 ">Campaign In</label>
                                    <label class="col col-8 ">
                                        <input type="radio" class="radiobox style-0" checked="checked" name="style-0">
                                         <span></span>
                                       </label>
                                </section>
                                <section class="col col-6">
                                    <label class=" col col-4">Campaign Out</label>
                                    <label class="col col-8">
                                        <input type="radio" class="radiobox style-0" name="style-0">
                                        <span></span>
                                         </label>
                                </section>
                                </div>



                                <!-- <div class="form-group">
                                  <label class="col-md-4 control-label"></label>
                                  <div class="col-md-12">
                                    <div class="radio" style="float:left; margin-left:50px;">
                                      <label>
                                        <input type="radio" class="radiobox style-0" checked="checked" name="style-0">
                                        <span>Campaign In</span>
                                      </label>
                                    </div>
                                    <div class="radio" style="float:right; margin-right:50px;">
                                      <label>
                                        <input type="radio" class="radiobox style-0" name="style-0">
                                        <span>Campaign Out</span>
                                      </label>
                                    </div>
                                  </div>
                                </div> -->


                                <!-- <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="extPassword" placeholder="Password"
                                               id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your
                                            password</b> </label>
                                </section>
                                <section>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="passwordConfirm"
                                               placeholder="Confirm password">
                                </section>
                                <section>
                                    <label class="select">
                                        <select name="extContext">
                                            <option value="0" selected="" disabled="">Context</option>
                                            <option value="default">Default</option>
                                        </select> <i></i> </label>
                                </section>
                                <section>
                                    <label class="select">
                                        <select name="extTransport">
                                            <option value="0" selected="" disabled="">Transport</option>
                                            <option value="transport-udp-nat">transport-udp-nat</option>
                                            <option value="transport-wss">transport-wss</option>
                                        </select> <i></i> </label>
                                </section> -->
                                <input type="hidden" name="action" value="add_ext">
                            </fieldset>

                            <!--              <fieldset>
                                              <div class="row">
                                                  <section class="col col-6">
                                                      <label class="input">
                                                          <input type="text" name="firstname" placeholder="First name">
                                                      </label>
                                                  </section>
                                                  <section class="col col-6">
                                                      <label class="input">
                                                          <input type="text" name="lastname" placeholder="Last name">
                                                      </label>
                                                  </section>
                                              </div>

                                              <div class="row">
                                                  <section class="col col-6">
                                                      <label class="select">
                                                          <select name="gender">
                                                              <option value="0" selected="" disabled="">Gender</option>
                                                              <option value="1">Male</option>
                                                              <option value="2">Female</option>
                                                              <option value="3">Prefer not to answer</option>
                                                          </select> <i></i> </label>
                                                  </section>
                                                  <section class="col col-6">
                                                      <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                          <input type="text" name="request"
                                                                 placeholder="Request activation on" class="datepicker"
                                                                 data-dateformat='dd/mm/yy'>
                                                      </label>
                                                  </section>
                                              </div>

                                              <section>
                                                  <label class="checkbox">
                                                      <input type="checkbox" name="subscription" id="subscription">
                                                      <i></i>I want to receive news and special offers</label>
                                                  <label class="checkbox">
                                                      <input type="checkbox" name="terms" id="terms">
                                                      <i></i>I agree with the Terms and Conditions</label>
                                              </section>
                                          </fieldset>-->
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Add
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

        <article class="col-sm-3 col-md-3 col-lg-3 col-lg-offset-1" id="poster-add-user">
          <div class="container-right-panel">


          <img src="<?php echo ASSETS_URL; ?>/../../../img/img_form.png" class="img-fluid" alt="Responsive image">
          <ul>
            <li>
							<div class="circulo"></div>
							<p class="texto">Enter the personal information of your new agent.</p>
						</li>
						<li>
							<div class="circulo"></div>
							<p class="texto">Assign a username and password to your new agent and confirm it.</p>
						</li>
            <li>
              <div class="circulo"></div>
              <p class="texto">Define the campaign and the corresponding extension.</p>
            </li>
            <li>
              <div class="circulo"></div>
              <p class="texto">Define if the agent is it going in to the "Campaign In" or "Campaign Out".</p>
            </li>
          </ul>

        </div>

        </article>

    </div>

    <!-- END ROW -->

</section>
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-phone\"></i> Call Center / <span> Agents / Add</span></h1>";
</script>
