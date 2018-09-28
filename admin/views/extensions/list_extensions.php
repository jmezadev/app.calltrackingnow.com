<!-- ==========================CONTENT STARTS HERE ========================== -->

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

<!-- ==========================CONTENT ENDS HERE ========================== -->

<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var out = [];
        var jqgrid_data;

        fetch('../admin/controllers/extensions/extensions_controller.php')
            .then(res => res.json())
            .then((out) => {
            console.log('Output: ', out[0]);
                jqgrid_data = out[0];
                jQuery("#jqgrid").jqGrid({
                data: jqgrid_data,
                datatype: 'local',
                height: 'auto',
                colNames: ['Actions', 'Ext', 'ExtID', 'Context', 'Login', 'Password', 'Date Created'],
                colModel: [
                    {name: 'act', index: 'act', sortable: false},
                    {name: 'extension', index: 'extension'},
                    {name: 'ext_id', index: 'ext_id', hidden: true, editable: true, editrules: { edithidden: false }, hidedlg: true},
                    {
                        name: 'ext_context', index: 'ext_context', editable: true, formatter: 'select',
                        edittype: 'select',
                        editoptions: {value: "default:DEFAULT"}
                    },
                    {name: 'ext_login', index: 'ext_login', editable: false},
                    {name: 'ext_password', index: 'ext_password', editable: true, formatter: 'password'},
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
                        be = "<button class='btn btn-xs btn-default' data-toedit=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#editExtensionsModal\" data-original-title='Edit Row' \"><i class='fa fa-pencil'></i></button>";
                        //be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                        de = "<button class='btn btn-xs btn-default' data-todelete=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#deleteModal\" data-original-title='Delete Row' \"><i class='fa fa-trash'></i></button>";
                        se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                        ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                        //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                        //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                        jQuery("#jqgrid").jqGrid('setRowData', ids[i], {act: be + de});
                    }
                },
                editurl: "../admin/controllers/extensions/extensions_controller.php?action=upd_ext",
                caption: "Extensions",
                multiselect: false,
                autowidth: true

        });
        jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid",
            { edit: false, add: false, del: false },
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    alert("YES");
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, action: 'upd_ext'};
                }
            }, // edit options
            {}, // add options
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    var rowdata = jQuery('#jqgrid').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, action: 'del_ext_simple'};
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

        modal.find('#ext_number').val(idToDelete.ext_id);

    });

    $("#deleteButton").on('click', function (event) {

        var form = $('#formDelete');

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?action=del_ext_simple',
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
                        url: '../admin/controllers/extensions/extensions_controller.php',
                        type: 'POST',
                        success: function (response) {
                            extensionData = response;

                            $("#jqgrid").clearGridData();
                            $("#jqgrid").jqGrid('setGridParam', {data: extensionData[0]});
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
    
    $('#editExtensionsModal').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var button = $(event.relatedTarget);
        var rowData = button.data('toedit');
        var modal = $(this);

        var idExtension = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        $.ajax({
            url: '../admin/controllers/extensions/extensions_controller.php?action=get_extension_info',
            type: 'POST',
            data: {'id_extension': idExtension.extension},
            success: function (response) {
                data = response;

                modal.find('#ext_id').val(data[0].ext_id);
                modal.find('#ext_password').val(data[0].ext_password);
                modal.find('#ext_login').val(data[0].ext_login);

            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    var form = $("#formEditBridge");
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#formEditExtensions").validate({
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
            ext_login: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            ext_password: {
                required: true
            },
            ext_context: {
                required: true
            }
        },

        // Messages for form validation
        messages: {
            ext_id: {
                required: 'Please enter your extension number'
            },
            ext_login: {
                required: 'Please enter your username'
            },
            ext_password: {
                required: 'Please enter a password'
            },
            ext_context: {
                required: 'Please select the context'
            }
        },

        submitHandler: function (form) {

            var extensionsData;

            $.ajax({
                url: '../admin/controllers/extensions/extensions_controller.php?action=upd_ext',
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
                            url: '../admin/controllers/extensions/extensions_controller.php',
                            type: 'POST',
                            success: function (response) {
                                extensionsData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: extensionsData[0]});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

                        $('#editExtensionsModal').modal("hide");

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

<div class="modal fade" id="editExtensionsModal" tabindex="-1" role="dialog" aria-labelledby="editExtensionsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEditExtensions">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Edit Extension</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ext_id">Extension:</label>
                        <input type="number" readonly="readonly" class="form-control" id="ext_id" name="ext_id">
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
	title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Extensions / List</span></h1>";
</script>
