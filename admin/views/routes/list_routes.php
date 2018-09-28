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

<style>
    .ui-jqdialog {
        background-color: #1171C3 !important;
        color: #FFFFFF !important;
        min-height: 200px !important;
        min-width: 420px !important;
    }
    .ui-jqdialog .CaptionTD {
        color: #FFFFFF !important;
        text-align: right !important;
        font-weight: bold !important;
    }
    .FormElement {
        padding: 1% !important;
        border: 2px solid #dbdbdb !important;
        line-height: 20px !important;
        width: 97% !important;
        margin: 8px 0 4px !important;
        background-color: #ffffff !important;
        -webkit-border-radius: 3px !important;
        -moz-border-radius: 3px !important;
        border-radius: 3px !important;
        font-weight: bold !important;
        font-size: 16px !important;
        color: #353b49 !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {

        var out = [];
        var jqgrid_data;

        fetch('..//admin/controllers/routes/routes_controller.php')
            .then(res => res.json())
    .then((out) => {
            //console.log('Output: ', out.routes);

        var didsArray = [];
        var count = out.length;

        for (var i = 0; i < count; i++){
            didsArray.push(out[0][i].exten_num);
        }

        jqgrid_data = out.routes;
        jQuery("#jqgrid").jqGrid({
            data: jqgrid_data,
            datatype: 'local',
            height: 'auto',
            colNames: ['Actions', 'ExtID', 'ExtNum', 'IDDID', 'DID', 'Bridge', 'Campaign'],
            colModel: [
                {name: 'act', index: 'act', sortable: false, width: 40},
                {name: 'id', index: 'id', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                {name: 'exten_num', index: 'exten_num', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                {name: 'id_did', index: 'id_did', editable: true, hidden: true, editrules: { edithidden: false }, hidedlg: true},
                {name: 'exten', index: 'exten',
                    editable: true,
                    edittype: 'select',
                    editoptions: { dataInit: function( elem )
                        {
                            var selr = jQuery('#jqgrid').jqGrid('getGridParam', 'selrow');
                            var celValue = jQuery('#jqgrid').jqGrid('getCell', selr, 'exten');

                            var count = out.dids.length;
                            var selected = '';

                            for (var i = 0; i < count; i++){

                                if(celValue === out.dids[i].did) {
                                    selected = 'selected';
                                } else {
                                    selected = '';
                                }

                                $(elem).append("<option role='option' value='" + out.dids[i].did + "' " + selected +">" + out.dids[i].did + "</option>");
                            }
                        }
                    }
                },
                {name: 'bridge', index: 'bridge', editable: true},
                {name: 'name_campaign', index: 'name_campaign', editable: true}
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
                    be = "<button class='btn btn-xs btn-default' data-toedit=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#editBridgeModal\" data-original-title='Edit Row' \"><i class='fa fa-pencil'></i></button>";
                    //be = "<button class='btn btn-xs btn-default' data-toggle=\"modal\" data-target=\"#editBridgeModal\" data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editGridRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                    de = "<button class='btn btn-xs btn-default' data-todelete=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-original-title='Delete Row' \"><i class='fa fa-trash'></i></button>";
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#jqgrid").jqGrid('setRowData', ids[i], {act: be + de });
                }
            },
            editurl: "../admin/controllers/routes/routes_controller.php?action=upd_route",
            caption: "Bridges",
            multiselect: false,
            autowidth: true,
            cellsubmit: 'remote',
            cellurl : '../admin/controllers/routes/routes_controller.php?action=upd_route'
        });

        jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid",
            { edit: false, add: false, del: false },
            {
                mtype: "POST",
                reloadAfterComplete: true,
                closeAfterEdit: true,
                closeAfterSubmit: true,
                serializeDelData: function (postdata) {
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {did: rowdata.extension, action: 'upd_ext'};
                },
                afterComplete: function(response, postdata, formid){
                    if (response.responseJSON.code === 0) {

                        var routesData = [];

                        $.ajax({
                            url: '../admin/controllers/routes/routes_controller.php?list=did',
                            type: 'POST',
                            success: function (response) {
                                routesData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: routesData.routes});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

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
            }, // edit options
            {}, // add options
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    console.log(postdata);
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {id: rowdata.id, ext_number: rowdata.ext_number, action: 'del_route'};
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

        $(".ui-icon.ui-icon-seek-prev" ).wrap("<div class='btn btn-sm btn-default'></div>");
        $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

        $(".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

        $(".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

        $(".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
        $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

    }).catch(err => console.error(err)
    );
    })

    $(window).on('resize.jqGrid', function () {
        $("#jqgrid").jqGrid('setGridWidth', $("#content").width());
    });

    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var modal = $(this);
        var rowData = button.data('todelete');

        var idToDelete = jQuery('#jqgrid').jqGrid ('getRowData', rowData);
        console.log(idToDelete);
        modal.find('#id').val(idToDelete.id);
        modal.find('#id_did').val(idToDelete.id_did);

    });

    $("#deleteButton").on('click', function (event) {

        var form = $('#formDelete');

        $.ajax({
            url: '../admin/controllers/routes/routes_controller.php?action=del_route',
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
                        url: '../admin/controllers/routes/routes_controller.php?list=did',
                        type: 'POST',
                        success: function (response) {
                            routeData = response;

                            $("#jqgrid").clearGridData();
                            $("#jqgrid").jqGrid('setGridParam', {data: routeData.routes});
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

    $('#editBridgeModal').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var campaignID;
        var button = $(event.relatedTarget);
        var idRoute = button.data('toedit');
        var modal = $(this);

        $.ajax({
            url: '../admin/controllers/routes/routes_controller.php?action=get_route',
            type: 'POST',
            data: {'id_route': idRoute},
            success: function (response) {
                data = response;

                var count = data.dids.length;
                var countCampaigns = data.campaigns.length;
                var selected = '';
                celValue = data.routes[0].did_number;
                campaignID = data.routes[0].id_campaign;

                for (var i = 0; i < count; i++){

                    if(celValue === data.dids[i].did_number) {
                        selected = 'selected';
                    } else {
                        selected = '';
                    }

                    $("#did").append("<option role='option' value='" + data.dids[i].did_number + "' " + selected +">" + data.dids[i].did_number + "</option>");
                }

                for (var j = 0; j < countCampaigns; j++){

                    if(campaignID === data.campaigns[j].id) {
                        selected = 'selected';
                    } else {
                        selected = '';
                    }

                    $("#campaign_id").append("<option role='option' value='" + data.campaigns[j].id + "' " + selected +">" + data.campaigns[j].camp_name + "</option>");
                }

                modal.find('#bridge').val(data.routes[0].bridge);
                modal.find('#id').val(data.routes[0].id);
            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    $('#editBridgeModal').on('hidden.bs.modal', function (event) {
        $("#did").empty();
        $("#campaign_id").empty();
    });

    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#formEditBridge").validate({
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
            did: {
                required: true
            },
            bridge: {
                required: true
            }
        },

        // Messages for form validation
        messages: {
            did: {
                required: 'Please select the DID'
            },
            bridge: {
                required: 'Please enter the bridge number'
            }
        },

        submitHandler: function (form) {

            var routesData;

            $.ajax({
                url: '../admin/controllers/routes/routes_controller.php?action=upd_route',
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
                            url: '../admin/controllers/routes/routes_controller.php?list=did',
                            type: 'POST',
                            success: function (response) {
                                routesData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: routesData.routes});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

                        $('#editBridgeModal').modal("hide");

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
                    console.log("An error occurred: ------------- ");
                    console.error(error);
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

<div class="modal fade" id="editBridgeModal" tabindex="-1" role="dialog" aria-labelledby="editBridgeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEditBridge">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Edit Bridge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="did">DID:</label>
                        <select id="did" name="exten_num" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bridge">Bridge to:</label>
                        <input type="text" class="form-control" id="bridge" name="bridge">
                    </div>
                    <div class="form-group">
                        <label for="campaign_id">Campaign:</label>
                        <select id="campaign_id" name="campaign_id" class="form-control">
                        </select>
                    </div>
                    <input type="hidden" name="id" id="id">
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
            <form id="formDelete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Are you sure you want to delete this record?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="id_did" name="id_did">
            </form>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="deleteButton">Accept</button>
            </div>
        </div>
    </div>
</div>
<!-- DEFINE THE TITLE HERE ON EVERY PAGE -->
<script defer>
	title = document.getElementById("contentMainTitle");
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Bridges / List</span></h1>";
</script>
