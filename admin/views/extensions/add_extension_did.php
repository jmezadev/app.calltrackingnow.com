<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-7 col-md-7 col-lg-7 col-lg-offset-1 margin-top-forms" id="form-add-dids">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false"
                 data-widget-custombutton="false">
                <header class="background-header">
                    <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-phone"></i> </span>
                    <h2></h2>
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
                        <form id="add-did-extension" class="smart-form" method="post"
                              action="../admin/controllers/extensions/extensions_controller.php">
                            <header>
                                Add DID Extension
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">Trunk</label>
                                        <label class="select col col-8">
                                            <select name="id_trunk" id="id_trunk">
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4 ">DID Number</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="did_number">
                                            <b class="tooltip tooltip-bottom-right">Required</b> </label>
                                    </section>
                                </div>
                                <input type="hidden" name="action" value="add_did_to_trunk">
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary" id="btn_submit">
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
                        <p class="texto">Enter the server conexion info (proxy and port).</p>
                    </li>
                    <li>
                        <div class="circulo"></div>
                        <p class="texto">Define the access data to your new DID extension (username and password).</p>
                    </li>
                    <li>
                      <div class="circulo"></div>
                      <div>
                      <p class="texto">Define the settings profile of your new DID extension:</p>
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

<script type="text/javascript">

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    function getTrunks() {

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?list=trunks',
            success: function (response) {

                var count = response[0].length;

                for (var i = 0; i < count; i++) {
                    var fromTrunkSelector = document.getElementById("id_trunk");
                    var option = document.createElement("option");

                    option.text = response[0][i].trunk_name;
                    //fromTrunkSelector.add(option);
                    fromTrunkSelector.append( new Option(response[0][i].trunk_name, response[0][i].id_trunk));
                }
            }
        });

    }

    $(document).ready(function () {

        getTrunks();

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $registerForm = $("#add-did-extension").validate({
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
                did_number: {
                    required: true
                },
                id_trunk: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {
                did_number: {
                    required: 'Please enter the DID number to be associate'
                },
                id_trunk: {
                    required: 'Please select the trunk'
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

                            $('#add-did-extension').trigger("reset");

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
<!-- DEFINE THE TITLE HERE ON EVERY PAGE -->
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> DIDs / Add</span></h1>";
</script>
