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

<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var out = [];
        var jqgrid_data;

        fetch('../admin/controllers/extensions/extensions_controller.php?list=trunks')
            .then(res => res.json())
    .then((out) => {
            console.log('Output: ', out[0]);
        jqgrid_data = out[0];
        jQuery("#jqgrid").jqGrid({
            data: jqgrid_data,
            datatype: 'local',
            height: 'auto',
            colNames: ['Actions', 'Trunk', 'Endpoint', 'Server', 'ExtID', 'Context', 'Login', 'Password', 'Transport', 'Date Created'],
            colModel: [
                {name: 'act', index: 'act', sortable: false},
                {name: 'trunk_name', index: 'trunk_name'},
                {name: 'extension', index: 'extension', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                {name: 'ext_proxy', index: 'ext_proxy', editable: true},
                {name: 'ext_id', index: 'ext_id', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                {
                    name: 'ext_context', index: 'ext_context', editable: true, formatter: 'select',
                    edittype: 'select',
                    editoptions: {value: "default:DEFAULT"}
                },
                {name: 'ext_login', index: 'ext_login', editable: false},
                {name: 'ext_password', index: 'ext_password', editable: true, formatter: 'password'},
                {
                    name: 'ext_transport', index: 'ext_transport', editable: true, formatter: 'select',
                    edittype: 'select',
                    editoptions: {value: "transport-udp-nat:TRANSPORT-UDP-NAT; transport-wss:TRANSPORT-WSS"}
                },
                {name: 'ext_date_created', index: 'ext_date_created', editable: false}],
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
                    be = "<button class='btn btn-xs btn-default' data-toedit=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#editTrunkModal\" data-original-title='Edit Row' \"><i class='fa fa-pencil'></i></button>";
                    //be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                    de = "<button class='btn btn-xs btn-default' data-todelete=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-original-title='Delete Row' \"><i class='fa fa-trash'></i></button>";
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#jqgrid").jqGrid('setRowData', ids[i], {act: be + de});
                }
            },
            editurl: "../admin/controllers/extensions/extensions_controller.php?action=upd_did_ext",
            caption: "Trunks",
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
                    return {ext_number: rowdata.extension, action: 'upd_ext'};
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
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, action: 'del_ext'};
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
    });

    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var modal = $(this);
        var rowData = button.data('todelete');

        var idToDelete = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        modal.find('#ext_number').val(idToDelete.extension);

    });

    $("#deleteButton").on('click', function (event) {

        var form = $('#formDelete');

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?action=del_trunk',
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
                        url: '../admin/controllers/extensions/extensions_controller.php?list=trunks',
                        type: 'POST',
                        success: function (response) {
                            didData = response;

                            $("#jqgrid").clearGridData();
                            $("#jqgrid").jqGrid('setGridParam', {data: didData[0]});
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

    $('#editTrunkModal').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var button = $(event.relatedTarget);
        var rowData = button.data('toedit');
        var modal = $(this);

        var idTrunk = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?action=get_trunk_info',
            type: 'POST',
            data: {'id_trunk': idTrunk.ext_id},
            success: function (response) {
                data = response;

                modal.find('#trunk_name').val(data[0].trunk_name);
                modal.find('#ext_id').val(data[0].ext_id);
                modal.find('#ext_proxy').val(data[0].ext_proxy);
                modal.find('#ext_login').val(data[0].ext_login);
                modal.find('#ext_password').val(data[0].ext_password);
                modal.find('#ext_number').val(data[0].ext_id);
                modal.find('#ext_username').val(data[0].ext_id);

            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    var form = $("#formEditBridge");
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#formEditTrunk").validate({
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
            ext_id: {
                required: true
            },
            trunk_name: {
                required: true
            },
            ext_proxy: {
                required: true
            },
            ext_login: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            ext_password: {
                required: true,
                minlength: 3,
                maxlength: 20
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
            ext_id: {
                required: 'Please enter your extension number'
            },
            trunk_name: {
                required: 'Please enter the trunk name'
            },
            ext_proxy: {
                required: 'Please enter the server URL'
            },
            ext_login: {
                required: 'Please enter your username'
            },
            ext_password: {
                required: 'Please enter a password'
            },
            ext_context: {
                required: 'Please select the context'
            },
            ext_transport: {
                required: 'Please select the transport'
            }
        },

        submitHandler: function (form) {

            var trunkData;

            $.ajax({
                url: '../admin/controllers/extensions/extensions_controller.php?action=upd_trunk',
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
                            url: '../admin/controllers/extensions/extensions_controller.php?list=trunks',
                            type: 'POST',
                            success: function (response) {
                                trunkData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: trunkData[0]});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

                        $('#editTrunkModal').modal("hide");

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

<div class="modal fade" id="editTrunkModal" tabindex="-1" role="dialog" aria-labelledby="editTrunkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEditTrunk">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Edit Trunk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="trunk_name">Trunk Name:</label>
                        <input type="text" class="form-control" id="trunk_name" name="trunk_name">
                    </div>
                    <div class="form-group">
                        <label for="ext_id">Endpoint:</label>
                        <input type="number" readonly="readonly" class="form-control" id="ext_id" name="ext_id">
                    </div>
                    <div class="form-group">
                        <label for="ext_proxy">Server:</label>
                        <input type="text" class="form-control" id="ext_proxy" name="ext_proxy">
                    </div>
                    <div class="form-group">
                        <label for="ext_login">Login:</label>
                        <input type="text" readonly="readonly" class="form-control" id="ext_login" name="ext_login">
                    </div>
                    <div class="form-group">
                        <label for="ext_password">Pasword:</label>
                        <input type="password" class="form-control" id="ext_password" name="ext_password">
                    </div>
                    <div class="form-group">
                        <label for="ext_context">Context:</label>
                        <select id="context" name="ext_context" class="form-control">
                            <option value="default" selected>default</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ext_transport">Transport:</label>
                        <select id="ext_transport" name="ext_transport" class="form-control">
                            <option value="transport-udp-nat">transport-udp-nat</option>
                        </select>
                    </div>
                    <input type="hidden" id="ext_number" name="ext_number">
                    <input type="hidden" id="ext_username" name="ext_username">
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
                <input type="hidden" id="ext_number" name="ext_number">
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
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Trunks / List</span></h1>";
</script>
