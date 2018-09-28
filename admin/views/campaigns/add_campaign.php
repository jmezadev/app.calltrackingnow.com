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
                                Add Campaign
                            </header>
                            <fieldset>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="col col-md-4">Name</label>
                                        <label class="input col col-md-12 "> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="camp_name" id="camp_name">
                                            <b class="tooltip tooltip-bottom-right">This field is required</b> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-md-12">
                                        <label class="col col-md-4">Description</label>
                                        <label class="input col col-md-12 textarea"> <i class="icon-append fa fa-comment"></i>
                                            <textarea name="camp_description" id="camp_description" cols="30" rows="10"></textarea>
                                        </label>
                                    </section>
                                </div>
                                <hr>
                                <br>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="col col-4">Start Date</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="camp_start_date" id="camp_start_date" data-dateformat="YYY/mm/dd HH:ss">
                                            <b class="tooltip tooltip-bottom-right">This field is required</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="col col-4">End Date</label>
                                        <label class="input col col-8"> <i class="icon-append fa fa-calendar"></i>
                                            <input type="text" name="camp_end_date" id="camp_end_date" data-dateformat="YYY/mm/dd HH:ss">
                                            <b class="tooltip tooltip-bottom-right">This field is required</b> </label>
                                    </section>
                                </div>
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

<script type="text/javascript">

    function getDIDs() {

        var fromDIDSelector = document.getElementById("camp_did");

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?list=dids_for_campaigns',
            success: function (response) {

                var count = response[0].length;

                for (var i = 0; i < count; i++) {
                    var option = document.createElement("option");

                    option.text = response[0][i].did;
                    fromDIDSelector.add(option);
                }
            }
        });
    }


    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {

        $("#camp_did").empty();

        getDIDs();

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
                camp_name: {
                    required: true
                },
                camp_start_date: {
                    required: true
                },
                camp_end_date: {
                    required: true
                },
                camp_did: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {
                camp_name: {
                    required: 'Please enter the campaign name'
                },
                camp_start_date: {
                    required: 'Please select the start date of the campaign'
                },
                camp_end_date: {
                    required: 'Please select the end date of the campaign'
                },
                camp_did: {
                    required: 'Please select the DID for the campaign'
                }
            },

            submitHandler: function (form) {
                $.ajax({
                    url: '../admin/controllers/campaigns/campaigns_controller.php?action=add_campaign',
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
    });

    $('#camp_start_date').datepicker({
        dateFormat : 'mm/dd/yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            $('#camp_end_date').datepicker('option', 'minDate', selectedDate);
        }
    });

    $('#camp_end_date').datepicker({
        dateFormat : 'mm/dd/yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            $('#camp_start_date').datepicker('option', 'minDate', selectedDate);
        }
    });

</script>
<!-- DEFINE THE TITLE HERE ON EVERY PAGE -->
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-phone\"></i> Call Center / <span> Campaigns / Add</span></h1>";
</script>
