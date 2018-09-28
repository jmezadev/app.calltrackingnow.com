<?php
//initilize the page
// require_once '/init.web.php';

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

// $page_title = "JQuery Grid";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
// $page_css[] = "your_style.css";
//include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
// $page_nav["tables"]["sub"]["jqgrid"]["active"] = true;
//include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<!-- <div id="main" role="main"> -->

<?php
//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
//$breadcrumbs["New Crumb"] => "http://url.com"
// $breadcrumbs["Tables"] = "";
//include("inc/ribbon.php");
?>

<!-- MAIN CONTENT -->
<!-- <div id="content"> -->

<!-- row -->
<!-- <div class="row"> -->

<!-- col -->
<!-- <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
    <h1 class="page-title txt-color-blueDark"> -->

<!-- PAGE HEADER -->
<!-- <i class="fa-fw fa fa-home"></i>
    Page Header
<span>>
    Subtitle
</span>
</h1>
</div> -->
<!-- end col -->

<!-- right side of the page with the sparkline graphs -->
<!-- col -->
<!-- <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8"> -->
<!-- sparks -->
<!-- <ul id="sparks">
    <li class="sparks-info">
        <h5> My Income <span class="txt-color-blue">$47,171</span></h5> -->
<!-- <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
    1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
</div>
</li>
<li class="sparks-info">
<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5> -->
<!-- <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
    110,150,300,130,400,240,220,310,220,300, 270, 210
</div>
</li>
<li class="sparks-info">
<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5> -->
<!-- <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
    110,150,300,130,400,240,220,310,220,300, 270, 210
</div>
</li>
</ul> -->
<!-- end sparks -->
<!-- </div> -->
<!-- end col -->

<!-- </div> -->
<!-- end row -->

<!--
    The ID "widget-grid" will start to initialize all widgets below
    You do not need to use widgets if you dont want to. Simply remove
    the <section></section> and you can use wells or panels instead
    -->

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <table id="jqgrid"></table>
            <div id="pjqgrid"></div>

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

<?php
// include page footer
//include("inc/footer.php");
?>

<?php
//include required scripts
//include("inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="..."></script>-->

<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

        var out = [];
        var jqgrid_data;

        fetch('http://app.calltrackingnow.com/admin/controllers/users/users_controller.php')
            .then(res => res.json())
    .then((out) => {
            console.log('Output: ', out[0]);
        jqgrid_data = out[0];
        jQuery("#jqgrid").jqGrid({
            data : jqgrid_data,
            datatype : 'local',
            height : 'auto',
            colNames : ['Actions', 'Id', 'First Name', 'Last Name', 'Phone', 'Email', 'Date'],
            colModel : [
                { name : 'act', index:'act', sortable:false },
                { name : 'user_id', index : 'user_id' },
                { name : 'first_name', index : 'first_name', editable : true  },
                { name : 'last_name', index : 'last_name', editable : true },
                { name : 'phone', index : 'phone', editable : true },
                { name : 'email', index : 'email', editable : true },
                { name : 'created_date', index : 'created_date', align : "right", editable : true }],
            rowNum : 10,
            rowList : [10, 20, 30],
            pager : '#pjqgrid',
            sortname : 'id',
            toolbarfilter: true,
            viewrecords : true,
            sortorder : "asc",
            gridComplete: function(){
                var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    be = "<button class='btn btn-xs btn-default' data-toedit=\"" + cl + "\" data-id=\"" + cl + "\" data-toggle=\"modal\" data-target=\"#editUserModal\" data-original-title='Edit Row' \"><i class='fa fa-pencil'></i></button>";
                    //be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('"+cl+"');\"><i class='fa fa-pencil'></i></button>";
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('"+cl+"');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ca});
                    console.log(ids[i]);
                }
            },
            editurl : "dummy.html",
            caption : "SmartAmind jQgrid Skin",
            multiselect : true,
            autowidth : true,

        });
        jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
            edit : true,
            add: true,
            cancel: true,
            del : false
        });
        /* Add tooltips */
        $('.navtable .ui-pg-button').tooltip({
            container : 'body'
        });

        jQuery("#m1").click(function() {
            var s;
            s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
            alert(s);
        });
        jQuery("#m1s").click(function() {
            jQuery("#jqgrid").jqGrid('setSelection', "13");
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

    }).catch(err => console.error(err));

    })

    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var modal = $(this);
        var rowData = button.data('todelete');

        var idToDelete = jQuery('#jqgrid').jqGrid ('getRowData', rowData);

        modal.find('#id').val(idToDelete.id);

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

    $('#editUserModal').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var button = $(event.relatedTarget);
        var idUser = button.data('toedit');
        var modal = $(this);

        $.ajax({
            url: 'http://app.calltrackingnow.com/admin/controllers/users/users_controller.php?action=get_user_info',
            type: 'POST',
            data: {'id_user': idUser},
            success: function (response) {
                data = response;

                console.log(data);

                var count = data.dids.length;
                var selected = '';
                celValue = data.routes[0].exten;

                modal.find('#bridge').val(data.routes[0].bridge);
                modal.find('#id').val(data.routes[0].id);
            },
            error: function (error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    $(window).on('resize.jqGrid', function () {
        $("#jqgrid").jqGrid( 'setGridWidth', $("#content").width() );
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
                            url: 'http://app.calltrackingnow.com/admin/controllers/routes/routes_controller.php?list=did',
                            type: 'POST',
                            success: function (response) {
                                routesData = response;

                                $("#jqgrid").clearGridData();
                                $("#jqgrid").jqGrid('setGridParam', {data: routesData.routes});
                                $("#jqgrid").trigger("reloadGrid");

                            }
                        });

                        $('#editUserModal').modal("hide");

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

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
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
                        <label for="first_name">First name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Email:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="password">Email:</label>
                        <input type="password" class="form-control" id="password" name="password">
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
    title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-cog\"></i> Settings / <span> Users / List</span></h1>";
</script>
