<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-7 col-md-7 col-lg-7 col-lg-offset-1 margin-top-forms" id="form-add-ext">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false"
                 data-widget-custombutton="false">
                <header class="background-header">
                    <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-phone"></i> </span>

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
                        <form id="add-extension" class="smart-form" method="post">
                            <header>
                                Add Extension
                            </header>
                            <fieldset>
                                <div class="row">
                                <section class="col col-6">
                                    <label class="col col-4 ">Username</label>
                                    <label class="input col col-8 "> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="ext_username">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                                <section class="col col-6">
                                    <label class=" col col-4">Extension Number</label>
                                    <label class=" input col col-8"> <i class="icon-append fa fa-hashtag"></i>
                                        <input type="number" name="ext_number">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the
                                            website</b> </label>
                                </section>
                                </div>
                                <div class="row">
                                <section class="col col-6">
                                    <label class=" col col-4">Password</label>
                                    <label class=" input col col-8"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="ext_password"
                                               id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your
                                            password</b> </label>
                                </section>
                                <section class="col col-6">
                                    <label class=" col col-4">Confirm Password</label>
                                    <label class=" input col col-8"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="passwordConfirm"
                                               >
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                    <label class=" col col-4">Context</label>
                                    <label class=" select col col-8">
                                        <select name="ext_context">
                                            <option value="default" selected>default</option>
                                        </select> <i></i> </label>
                                </section>
                                <section class="col col-6">
                                    <label class=" col col-4">Transport</label>
                                    <label class=" select col col-8">
                                        <select name="ext_transport">
                                            <option value="0" selected="" disabled="">Transport</option>
                                            <option value="transport-udp-nat">transport-udp-nat</option>
                                            <option value="transport-wss">transport-wss</option>
                                        </select> <i></i> </label>
                                </section>
                            </div>
                                <input type="hidden" name="action" value="add_ext">
                            </fieldset>
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
              <p class="texto">Define the access data to your new extension (username / number and password).</p>
            </li>
            <li>
              <div class="circulo"></div>
              <div>
              <p class="texto">Define the settings profile of your new extension:</p>
              <p class="texto"><strong>Context:</strong><br>
                It is the behavior protocol of an extension after connecting with it (redirect, voicemail, etc).
              </p>
              <p class="texto"><strong>Transport:</strong><br>
                It is about the way that the connection is going to take place.
              </p>
              </div>
            </li>
          </ul>

        </div>

        </article>
    </div>
    <!-- END ROW -->
</section>

<?php
//include required scripts
include("/inc/scripts.php");

?>
<!-- DEFINE THE TITLE HERE ON EVERY PAGE -->
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Extensions / Add</span></h1>";
</script>

<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $registerForm = $("#add-extension").validate({
            errorClass: errorClass,
            errorElement: errorElement,
            highlight: function (element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function (element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },

            // Rules for form validation
            rules: {
                ext_number: {
                    required: true
                },
                ext_username: {
                    required: true
                },
                ext_password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                passwordConfirm: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                    equalTo: '#password'
                },
                ext_context: {
                    required: true
                },
                ext_transport: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {
                ext_number: {
                    required: 'Please enter your extension number'
                },
                ext_username: {
                    required: 'Please enter your username'
                },
                ext_password: {
                    required: 'Please enter your password'
                },
                passwordConfirm: {
                    required: 'Please enter your password one more time',
                    equalTo: 'Please enter the same password as above'
                },
                ext_context: {
                    required: 'Please select the context',
                },
                ext_transport: {
                    required: 'Please select the transport',
                }
            },

            submitHandler: function (form) {
                $.ajax({
                    url: '../admin/controllers/extensions/extensions_controller.php',
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function (response) {

                        if (response.code === 0) {
                            $.smallBox({
                                title: response.title,
                                content: response.msg,
                                color: "#27ae60",
                                iconSmall: "fa fa-check",
                                timeout: 8000
                            });

                            $('#add-extension').trigger("reset");

                        } else {
                            $.smallBox({
                                title: response.title,
                                content: response.msg,
                                color: "#c0392b",
                                iconSmall: "fa fa-close",
                                timeout: 8000
                            });
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.appendTo(element.parent());
            }
        });
    })
</script>
