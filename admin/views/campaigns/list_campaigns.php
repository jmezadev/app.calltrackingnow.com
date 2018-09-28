<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="jqgrid"></table>
            <div id="pjqgrid"></div>
            <br>
        </article>
        <!-- WIDGET END -->
    </div>
    <!-- end row -->
</section>
<!-- end widget grid -->

<!-- </div> -->
<!-- END MAIN CONTENT -->

<!-- </div> -->
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        var out = [];
        var jqgrid_data;

        function setIcons (cellvalue, options, rowObject)
        {
            var returnVal ='<a href="#play"><i class="fa fa-play-circle fa-2x"></i></a> &nbsp;&nbsp; <a href="#stop"><i class="fa fa-stop-circle fa-2x"></i></a> &nbsp;&nbsp; <a href="#download"><i class="fa fa-download fa-2x"></i></a>';
            return returnVal;
        }

        fetch('../admin/controllers/campaigns/campaigns_controller.php')
            .then(res => res.json())
    .then((out) => {
        console.log("OK.");
        jqgrid_data = out;
        jQuery("#jqgrid").jqGrid({
            data: jqgrid_data,
            datatype: 'local',
            height: 'auto',
            colNames: ['Actions', 'CampID', 'Name', 'Description', 'DID', 'Start Date', 'End Date'],
            colModel: [
                {name: 'act', index: 'act', sortable: false},
                {name: 'id', index: 'id', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                {name: 'camp_name', index: 'camp_name', editable: true},
                {name: 'camp_description', index: 'camp_description', editable: true},
                {name: 'did', index: 'did', editable: true, width: '80'},
                {name: 'camp_start', index: 'camp_start', width: '90'},
                {name: 'camp_end', index: 'camp_end', width: '90'}
                /*{name: 'multim', index: 'multim', align:"center", editable: true, formatter: setIcons },*/
            ],
            rowNum: 10,
            rowList: [10, 20, 30],
            pager: '#pjqgrid',
            sortname: 'id',
            toolbarfilter: true,
            viewrecords: true,
            sortorder: "asc",
            gridComplete: function () {
                var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    be = "<button class='btn btn-xs btn-default' data-toedit=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#editCampaignsModal\" data-original-title='Edit Row' \"><i class='fa fa-pencil'></i></button>";
                    de = "<button class='btn btn-xs btn-default' data-todelete=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-original-title='Delete Row' \"><i class='fa fa-trash'></i></button>";
                    //be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#jqgrid").jqGrid('setRowData', ids[i], {act: be + de });
                }
            },
            editurl: "../admin/controllers/campaigns/campaigns_controller.php?action=upd_campaigns",
            caption: "Campaigns",
            multiselect: false,
            autowidth: true
        });

        jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid",
            { edit: false, add: false, del: false },
            {
                mtype: "POST",
                serializeDelData: function (postdata) {
                    alert("YES");
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, ext_num: rowdata.ext_num, action: 'upd_ext'};
                },
                afterComplete: function(response, postdata, formid){
                    alert(response.responseText);
                }
            }, // edit options
            {}, // add options
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    console.log(postdata);
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {id: rowdata.id, action: 'del_route'};
                },
                afterComplete: function(response, postdata, formid){
                    if (response.responseJSON.code === 0) {

                        $.smallBox({
                            title: response.responseJSON.title,
                            content: response.responseJSON.msg,
                            color: "#27ae60",
                            iconSmall: "fa fa-check",
                            timeout: 8000
                        });
                    } else {
                        $.smallBox({
                            title: response.responseJSON.title,
                            content: response.responseJSON.msg,
                            color: "#c0392b",
                            iconSmall: "fa fa-close",
                            timeout: 8000
                        });
                    }
                }
            } // del options
        );

        /* Add tooltips */
        $('.navtable .ui-pg-button').tooltip({
            container: 'body'
        });

        // remove classes
        $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
        $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
        $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
        $(".ui-jqgrid-pager").removeClass("ui-state-default");
        $(".ui-jqgrid").removeClass("ui-widget-content");

        // add classes
        $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
        $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");


        $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
        $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
        $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
        $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
        $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
        $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
        $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
        $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

        $( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

        $( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

        $( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

        $( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

    }).catch(err => console.error(err)
    );
    })

    $(window).on('resize.jqGrid', function () {
        $("#jqgrid").jqGrid('setGridWidth', $("#content").width());
    })

    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var modal = $(this);
        var rowData = button.data('todelete');

        var idCampaign = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        modal.find('#campaignID').val(idCampaign.id);

    });

    $("#deleteCampaignButton").on('click', function (event) {

        var form = $('#formDeleteCampaigns');

        $.ajax({
            url: '../admin/controllers/campaigns/campaigns_controller.php?action=delete_campaign',
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                data = response;

                if (response.code === 0) {
                    $.smallBox({
                        title: response.title,
                        content: response.msg,
                        color: "#27ae60",
                        iconSmall: "fa fa-check",
                        timeout: 8000
                    });

                    $.ajax({
                        url: '../admin/controllers/campaigns/campaigns_controller.php',
                        type: 'POST',
                        success: function (response) {
                            campaignData = response;

                            $("#jqgrid").clearGridData();
                            $("#jqgrid").jqGrid('setGridParam', {data: campaignData});
                            $("#jqgrid").trigger("reloadGrid");

                        }
                    });

                    $('#deleteModal').modal("hide");

                } else {
                    $.smallBox({
                        title: response.title,
                        content: response.msg,
                        color: "#c0392b",
                        iconSmall: "fa fa-close",
                        timeout: 8000
                    });
                }

            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });

    });

    $('#editCampaignsModal').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var button = $(event.relatedTarget);
        var rowData = button.data('toedit');
        var modal = $(this);

        var idCampaign = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        $.ajax({
            url: '../admin/controllers/campaigns/campaigns_controller.php?action=get_campaign_info',
            type: 'POST',
            data: {'id_campaign': idCampaign.id},
            success: function (response) {
                data = response;
                console.log(data[0]);

                modal.find('#camp_name').val(data[0].camp_name);
                modal.find('#camp_description').val(data[0].camp_description);
                modal.find('#id_campaign').val(data[0].id);

            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    $('#editCampaignsModal').on('hidden.bs.modal', function (event) {

    });

    var form = $("#formEditCampaign");
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#formEditCampaigns").validate({
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
            camp_did: {
                required: true
            },
        },

        // Messages for form validation
        messages: {
            camp_name: {
                required: 'Please enter the campaign name'
            },
            camp_did: {
                required: 'Please select a DID'
            },
        },

        submitHandler: function (form) {

            var campaignData;

            $.ajax({
                url: '../admin/controllers/campaigns/campaigns_controller.php?action=upd_campaign',
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

                        $.ajax({
                            url: '../admin/controllers/campaigns/campaigns_controller.php',
                            type: 'POST',
                            success: function (response) {
                                campaignData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: campaignData});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

                        $('#editCampaignsModal').modal("hide");

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



</script>

<style>
    .invalid {
        color: darkred !important;
    }
</style>

<div class="modal fade" id="editCampaignsModal" tabindex="-1" role="dialog" aria-labelledby="editCampaignsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEditCampaigns">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Edit Extension</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="camp_name">Name:</label>
                        <input type="text" class="form-control" id="camp_name" name="camp_name">
                    </div>
                    <div class="form-group">
                        <label for="camp_description">Description:</label>
                        <textarea name="camp_description" class="form-control" id="camp_description" cols="30" rows="10"></textarea>
                    </div>
                    <input type="hidden" name="id_campaign" id="id_campaign">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formDeleteCampaigns">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Are you sure you want to delete this record?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="campaignID" name="campaignID">
            </form>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="deleteCampaignButton">Accept</button>
            </div>
        </div>
    </div>
</div>
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-phone\"></i> Call Center / <span> Campaigns / List</span></h1>";
</script>
