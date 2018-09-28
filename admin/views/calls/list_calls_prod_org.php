<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="callsTable"></table>
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

<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">

    function playFunc(audioToRep, spanTime){
        audioToRep.play();
        audioToRep.addEventListener("timeupdate", function(){
            write(audioToRep, spanTime);
        });
    }
    function write(audioToRep, spanTime){
        var ceroSeg;
        var ceroMin;
        var durationMin = Math.trunc(audioToRep.duration / 60);
        var durationSec = Math.trunc(audioToRep.duration % 60);
        var minutes = Math.trunc(audioToRep.currentTime / 60);
        var seconds = Math.trunc(audioToRep.currentTime % 60);
        if(seconds<10){
            ceroSeg = "0";
        }else {
            ceroSeg = "";
        }
        if(minutes<10){
            ceroMin = "0";
        }else {
            ceroMin = "";
        }
        spanTime.innerHTML= ceroMin+minutes+":"+ceroSeg+seconds+"/"+durationMin+":"+durationSec;
        if(audioToRep.currentTime==0 || audioToRep.currentTime == audioToRep.duration){
            spanTime.innerHTML="";
        };
    }
    function forward(b){
        var duration = Number(b.duration);
        var currentTime = Number(b.currentTime);
        var timeToGo = currentTime+3;
        if (timeToGo >= duration){
            alert("end of call");
            b.load();
        }else{
            b.currentTime = timeToGo;
        }
    }
    function back(b){
        var currentTime = Number(b.currentTime);
        var timeToGo = currentTime-3;
        if (timeToGo <= 0){
            b.load();
        }else{
            b.currentTime = timeToGo;
        }
    }

    function getCalls() {

        function setIcons (cellvalue, options, rowObject, audioSRC)
        {
            var audio_id = "audio_" + rowObject.id;
            var file_recording = rowObject.file_recording;

            var returnVal = "<div class=\"containerAudio\">\n" +
                "<div class=\"audioReproducer\">\n" +
                "  <audio id=" + audio_id + " src=\"http://app.calltrackingnow.com"+ file_recording + "\"></audio>\n" +
                "    <a href=\"javascript:;\" onclick=\"document.getElementById('" + audio_id + "').pause()\"><i class=\"color- fa fa-pause-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"playFunc(document.getElementById('" + audio_id + "'), document.getElementById('" +"showTime_"+ audio_id + "'))\"><i class=\"color- fa fa-play-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"document.getElementById('" + audio_id + "').load()\"><i class=\"color- fa fa-stop-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"back(document.getElementById('" + audio_id + "'))\"><i class=\"color- fa fa-backward\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"forward(document.getElementById('" + audio_id + "'))\"><i class=\"color- fa fa-forward\"></i></a>\n" +
                "    <span id="+ "showTime_"+ audio_id +" class=\"showTime\"></span>"+
                "</div></div>";
            return returnVal;
        }

        fetch('http://app.calltrackingnow.com/admin/controllers/calls/calls_controller.php')
            .then(res => res.json())
    .then((out) => {
            console.log("OK");
        jqgrid_data = out;
        jQuery("#callsTable").jqGrid({
            data: jqgrid_data,
            datatype: 'local',
            height: 'auto',
            colNames: ['<i class="fa fa-lg fa-fw fa fa-file-text-o"></i> ID', '<i class="fa fa-lg fa-fw fa-phone"></i> Contact', '<i class="fa fas fa-hashtag"></i> Number', '<i class="fa fa-lg fa-fw fa-user"></i> Name', '<i class="fa fa-lg fa-fw fa-phone"></i> Bridge To', '<i class="fa fa-lg fa-fw fa-briefcase"></i> Campaign', '<i class="fa fas fa-calendar"></i> Date', '<center><i class="fa fa-lg fa-fw fa fa-clock-o"></i> Duration</center>', '<center><i class="fa fas fa-volume-up"></i> Audio</center>'],
            colModel: [
                { name : 'id', index : 'id' , width: 50},
                { name : 'from', index : 'from', editable : true },
                { name : 'to', index : 'to', editable : true },
                { name : 'name', index : 'name', editable : true },
                { name : 'bridge', index:'bridge'},
                { name : 'campaign', index:'campaign'},
                { name : 'date_created', index:'date_created'},
                { name : 'duration', index:'duration', width: 70},
                { name : 'audio', index:'audio', title: false, align: 'center', formatter: setIcons }
            ],
            rowNum: 10,
            rowList: [10, 20, 30],
            pager: '#pjqgrid',
            sortname: 'date_created',
            toolbarfilter: true,
            viewrecords: true,
            sortorder: "desc",
            gridComplete: function () {
                var ids = jQuery("#callsTable").jqGrid('getDataIDs');
                for (var i = 0; i < ids.length; i++) {
                    var cl = ids[i];
                    be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#callsTable').editRow('" + cl + "');\"><i class='fa fa-pencil'></i></button>";
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#callsTable').saveRow('" + cl + "');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#callsTable').restoreRow('" + cl + "');\"><i class='fa fa-times'></i></button>";
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#callsTable').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
                    //jQuery("#callsTable").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#callsTable").jqGrid('setRowData', ids[i], {act: be + se + ca});
                }
            },
            editurl: "../admin/controllers/calls/calls_controller.php?action=upd_ext",
            caption: "Call Incoming",
            multiselect: true,
            autowidth: true

        });
        jQuery("#callsTable").jqGrid('navGrid', "#pjqgrid",
            { edit: false, add: false, del: true },
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    alert("YES");
                    var rowdata = jQuery('#callsTable').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, action: 'upd_ext'};
                }
            }, // edit options
            {}, // add options
            {
                mtype: "POST",
                reloadAfterSubmit: true,
                serializeDelData: function (postdata) {
                    var rowdata = jQuery('#callsTable').getRowData(postdata.id);
                    return {ext_number: rowdata.extension, action: 'del_ext'};
                }
            } // del options
        );
        jQuery("#callsTable").jqGrid('inlineNav', "#pjqgrid");
        /* Add tooltips */
        $('.navtable .ui-pg-button').tooltip({
            container: 'body'
        });

        jQuery("#m1").click(function () {
            var s;
            s = jQuery("#callsTable").jqGrid('getGridParam', 'selarrrow');
            alert(s);
        });
        jQuery("#m1s").click(function () {
            jQuery("#callsTable").jqGrid('setSelection', "13");
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

        $(".ui-icon.ui-icon-seek-prev").wrap("<div class='btn btn-sm btn-default'></div>");
        $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

        $(".ui-icon.ui-icon-seek-first").wrap("<div class='btn btn-sm btn-default'></div>");
        $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");

        $(".ui-icon.ui-icon-seek-next").wrap("<div class='btn btn-sm btn-default'></div>");
        $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

        $(".ui-icon.ui-icon-seek-end").wrap("<div class='btn btn-sm btn-default'></div>");
        $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

    }).catch(err => console.error(err)
    );

    }

    var refreshTable;

    $(document).ready(function () {

        if(refreshTable) {
            clearInterval(refreshTable);
        }

        var out = [];
        var jqgrid_data;

        getCalls();

        /*refreshTable = setInterval(function () {
            console.log("LLAMADO");
            $.ajax({
                url: '../admin/controllers/calls/calls_controller.php',
                type: 'POST',
                success: function (response) {
                    callsData = response;

                    $("#callsTable").clearGridData();
                    $("#callsTable").jqGrid('setGridParam', {data: callsData});
                    $("#callsTable").trigger("reloadGrid");

                }
            });

            //getCalls();
        }, 3000);*/
    });

    $(window).on('resize.jqGrid', function () {
        $("#callsTable").jqGrid('setGridWidth', $("#content").width());
    })

</script>

<script defer>
    title = document.getElementById("contentMainTitle");
    title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-book\"></i> Calls / <span> Traffic</span></h1>";
</script>
