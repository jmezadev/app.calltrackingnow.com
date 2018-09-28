<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-7 col-md-7 col-lg-7 col-lg-offset-1 margin-top-forms" id="form-add-dids">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false"
                 data-widget-custombutton="false">
                <header class="background-header">
                    <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-exchange"></i> </span>
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
                              action="../admin/controllers/routes/routes_controller.php">
                            <header>
                                Add DID Bridge
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="col col-4">Campaign</label>
                                        <label class="select col col-8">
                                            <select name="camp_id" id="camp_id">
                                            </select>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4 ">From DID</label>
                                        <label class="select col col-8">
                                            <select name="did_from" id="did_from">
                                                <option value="0" selected="" disabled="">Select DID</option>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4 ">To</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-hashtag"></i>
                                            <input type="text" name="did_to">
                                            <b class="tooltip tooltip-bottom-right">Please insert extension number</b>
                                        </label>
                                    </section>
                                </div>
                                <input type="hidden" name="action" value="add_route">
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
                        <p class="texto">A DID Bridge is a defined redirection from one extension to another. To add a new DID Bridge, select an DID extension and a destiny extension.</p>
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

    function getCampaigns() {

        var campaignSelector = document.getElementById("camp_id");

        $.ajax({
        url: '../admin/controllers/campaigns/campaigns_controller.php',
        success: function (response) {

                var count = response.length;


                for (var i = 0; i < count; i++) {
                    var option = document.createElement("option");

                    option.text = response[i].did;
                    campaignSelector.append( new Option(response[i].camp_name, response[i].id));
                }
            }
        });
    }

    function getDIDs() {

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?list=simple',
            success: function (response) {

                var count = response[0].length;

                for (var i = 0; i < count; i++) {
                    var fromDIDSelector = document.getElementById("did_from");
                    var option = document.createElement("option");

                    option.text = response[0][i].ext_id;
                    fromDIDSelector.add(option);
                }


                // if (response.code === 0) {
                //     $.smallBox({
                //         title: response.title,
                //         content: response.msg,
                //         color: "#27ae60",
                //         iconSmall: "fa fa-check",
                //         timeout: 8000
                //     });
                //
                //     $('#add-did-extension').trigger("reset");
                //
                // } else {
                //     $.smallBox({
                //         title: response.title,
                //         content: response.msg,
                //         color: "#c0392b",
                //         iconSmall: "fa fa-close",
                //         timeout: 8000
                //     });
                // }
            }
        });

    }

    $(document).ready(function () {

        getDIDs();
        getCampaigns();

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
                did_from: {
                    required: true
                },
                did_to: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {
                did_from: {
                    required: 'Please select the DID extension from route'
                },
                did_to: {
                    required: 'Please enter the DID extension to route'
                }
            },

            submitHandler: function (form) {
                $.ajax({
                    url: '../admin/controllers/routes/routes_controller.php',
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
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Bridges / Add</span></h1>";
</script>
