<script>
    var nextinput = 1;
    function AgregarCampos(){
        nextinput++;
       var num = $('.clonedInput').length;
       var newNum = new Number(num + 1); // the numeric ID of the new input field being added

        campo = "<section id=\"trunk_identify_container_"+ newNum +"\" class=\"col col-md-12 clonedInput\">" +
            "<label class=\"col col-4 \"></label>\n" +
            "<label class=\"input col col-8\"> <i class=\"icon-append fa fa-server\"></i>\n" +
            "       <input type=\"text\" name=\"identifies[identify_trunk_" + newNum + "]\" id=\"identify_trunk_" + newNum + "\">\n" +
            "</label>" +
            "</section>";

        //campo = '<li id="rut'+nextinput+'">Campo:<input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
        $("#identifiers_1").append(campo);
    }

    function eliminarCampos(){

        var num = $('.clonedInput').length;
        console.log("----");
        console.log("#trunk_identify_container_" + num);

        $("#trunk_identify_container_" + num).remove();
    }
</script>

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
                                Add Trunk
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="col col-4 ">Trunk Name</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-server"></i>
                                            <input type="text" name="trunk_name">
                                            <b class="tooltip tooltip-bottom-right">Required</b> </label>
                                    </section>
                                </div>
                                <hr>
                                <br>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">Username</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="ext_username">
                                            <b class="tooltip tooltip-bottom-right">Required</b> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">Password</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="ext_password"
                                                   id="password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your
                                                password</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4 ">Confirm Password</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="passwordConfirm"
                                            >
                                    </section>
                                </div>
                                <hr>
                                <br>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">Server</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-server"></i>
                                            <input type="text" name="ext_proxy">
                                            <b class="tooltip tooltip-bottom-right">Required</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4 ">Port</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-hashtag"></i>
                                            <input type="number" name="ext_port">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">Transport</label>
                                        <label class="select col col-8">
                                            <select name="ext_transport">
                                                <option value="0" selected="" disabled="">Transport</option>
                                                <option value="transport-udp-nat">transport-udp-nat</option>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4 ">Context</label>
                                        <label class="select col col-8">
                                            <select name="ext_context">
                                                <option value="default" selected>default</option>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                <hr>
                                <br>
                                <div class="rowk pull-right" style="margin: 5px 0">
                                    <input type="button" class="btn btn-primary" style="padding: 4px" id="btnAdd" onclick="AgregarCampos()" value="Add identify field" />
                                    <input type="button" class="btn btn-danger" style="padding: 4px" id="btnAdd" onclick="eliminarCampos()" value="Remove identify field" />
                                </div>
                                <div class="row" id="identifiers_1">
                                    <section class="col col-md-12 clonedInput">
                                        <label class="col col-4 ">Identify</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-server"></i>
                                            <input type="text" name="identifies[identify_trunk_1]" id="identify_trunk_1">
                                        </label>
                                    </section>
                                </div>
                                <input type="hidden" name="action" value="add_trunk">
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary" id="btn_submit" disabled>
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

    $(document).ready(function () {

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
            onfocusout: function (element) {
                if (element.name === 'ext_username') {
                    $.ajax({
                        url: '../admin/controllers/extensions/extensions_controller.php',
                        type: 'POST',
                        data: 'action=check_did_number&did_number=' + $("input[name=ext_username]").val(),
                        success: function (response) {
                            if (response.code === 1) {
                                $registerForm.showErrors({
                                    "ext_username": "The DID is already used!"
                                });
                                $("#btn_submit").prop('disabled', true);
                            } else {
                                $("#btn_submit").prop('disabled', false);
                            }
                        }
                    });
                }
            },

            // Rules for form validation
            rules: {
                ext_proxy: {
                    required: true
                },
                trunk_name: {
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
                ext_username: {
                    required: 'Please enter your username'
                },
                trunk_name: {
                    required: 'Please enter the trunk name'
                },
                ext_password: {
                    required: 'Please enter your password'
                },
                passwordConfirm: {
                    required: 'Please enter your password one more time',
                    equalTo: 'Please enter the same password as above'
                },
                ext_context: {
                    required: 'Please select the context'
                },
                ext_proxy: {
                    required: 'Please enter the SIP server'
                },
                ext_transport: {
                    required: 'Please select the transport'
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
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Trunks / Add</span></h1>";
</script>
