<!-- widget grid -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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

<!--Acá el botón de descarga "<div class=\"separatorButtons\"></div>"+
"<a href=\"javascript:;\" onclick=\"\"><i class=\"fa fa-download\"></i></a>" +-->

<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>../../../js/plugin/jqgrid/grid.locale-en.min.js"></script>

<script type="text/javascript">
    /*****************BEGIN SHOW TRANSCRIPTION MESSAGES*****************/
    var containerChat = document.getElementById("chatContent");
    function agentShow(personMessage, audioId, audioUrl, accuracy){
        var content =         "<ul class=\'agentUl\'>" +
            "<audio id=\""+audioId+"\" src=\""+audioUrl+"\"></audio>"+
            "<li class=\'messageLi\'>"+
            "<div class=\'bubble\'>"+
            "<span class='\personSay\'>"
            +personMessage+
            "</span>"+
            "</div>"+
            "</li>"+
            "<li class='\actionsLi\'>"+
            "<ul>"+
            "<li>Accuracy: "+accuracy+"</li>"+
            "<li>"+
            "<a class=\'controlsTransFormat\' href=\'javascript:;\' onclick=\'document.getElementById(\""+audioId+"\").play();\'><i class=\'color- fa fa-play-circle\'></i></a>"+
            "<a class=\'controlsTransFormat\' href=\'javascript:;\' onclick=\'document.getElementById(\""+audioId+"\").load();\'><i class=\'color- fa fa-stop-circle\'></i></a>"+
            "</li>"+
            "</ul>"+
            "</li>"+
            "</ul>"
        containerChat.innerHTML += content;
    }
    function callerShow(personMessage, audioId, audioUrl, accuracy){
        var content =
            "<ul class=\'personUl\'>"+
            "<audio id=\""+audioId+"\" src=\""+audioUrl+"\"></audio>"+
            "<li class=\'actionsLi\'>"+
            "<ul>"+
            "<li>Accuracy: "+accuracy+"</li>"+
            "<li>"+
            "<a class=\'controlsTransFormat\' href=\'javascript:;\' onclick=\'document.getElementById(\""+audioId+"\").play();\'><i class=\'color- fa fa-play-circle\'></i></a>"+
            "<a class=\'controlsTransFormat\' href=\'javascript:;\' onclick=\'document.getElementById(\""+audioId+"\").load();\'><i class=\'color- fa fa-stop-circle\'></i></a>"+
            "</li>"+
            "</ul>"+
            "</li>"+
            "<li class=\'messageLi\'>"+
            "<div class=\'bubble_caller\'>"+
            "<span class=\'personSay\'>"
            + personMessage +
            "</span>"+
            "</div>"+
            "</li>"+
            "</ul>"
        containerChat.innerHTML+=content;
    }
    /*agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");
    agentShow("Load of agent message from agentShow function", "audioId", "audioUrl", "95%");
    callerShow("Load of client message from clientShow function", "audioId", "audioUrl", "95%");*/


    // var url = '';
    // var myRequest = new Request(url);
    // var instaContent;
    // var totalFeeds;
    // function loadContent(){
    //   fetch(myRequest)
    //       .then(function(response) {
    //           return response.json();
    //       })
    //       .then(function(transcriptions) {
    //           transcriptions = instaElements.data;
    //           transcriptions.forEach(function(n){
    //             if(){
    //               var accuracy = ;
    //               var audioId = "transc_audio"+n.id;
    //               agentShow(n.message, audioId, n.url, accuracy);
    //             }else{
    //               callerShow(n.message, audioId, n.url, accuracy);
    //             }
    //           });
    //       });
    // }

    var url = '../admin/controllers/transcriptions/transcriptions_controller.php';
    var myRequest = new Request(url);
    var instaContent;
    var totalFeeds;
    var data2 = {recording_id: '187'};
    var options = {
        method: 'POST',
        body: JSON.stringify(data2),
        headers: {
            'Content-Type': 'application/json'
        }
    };
    var data;

    function loadContent(recording_id) {

        var recordingID = {recording_id: recording_id};

        $.ajax({
            url: '../admin/controllers/transcriptions/transcriptions_controller.php',
            type: 'POST',
            data: recordingID,
            success: function (transcriptions) {
                data = transcriptions;

                if(data.length > 0) {
                    data.forEach(function (n) {

                        var accuracy = parseInt(n.confidence * 100) + "%";
                        var audioId = "transc_audio_" + n.transcription_id;
                        var audioUrl = "/recordings/" + n.audio_file_phrase;
                        var phrase = n.phrase;
                        if (n.speaker === 'out') {
                            agentShow(phrase, audioId, audioUrl, accuracy);
                        } else {
                            callerShow(phrase, audioId, audioUrl, accuracy);
                        }

                    });
                } else {
                    document.getElementById("chatContent").innerHTML = "<div class='no-recordings'>No recordings</div>";
                }
            },
            error: function (error) {
                console.log("An error occurred: ------------- ");
                console.error(error);
            }
        });


        /*fetch(myRequest, options)
            .then(function (response) {
                return response.json();
            })
            .then(function (transcriptions) {
                data = transcriptions;
                data.forEach(function (n) {

                    var accuracy = n.confidence;
                    var audioId = "transc_audio_" + n.transcription_id;
                    var audioUrl = "/recordings/" + n.audio_file_phrase;
                    var phrase = n.phrase;

                    if (data.speaker === 'out') {
                        agentShow(phrase, audioId, audioUrl, accuracy);
                    } else {
                        callerShow(phrase, audioId, audioUrl, accuracy);
                    }

                });
            });*/
    }
    /*****************END SHOW TRANSCRIPTION MESSAGES*****************/



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
                "  <audio id=" + audio_id + " src=\"" + file_recording + "\"></audio>\n" +
                "    <a href=\"javascript:;\" onclick=\"document.getElementById('" + audio_id + "').pause()\"><i class=\"color- fa fa-pause-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"playFunc(document.getElementById('" + audio_id + "'), document.getElementById('" +"showTime_"+ audio_id + "'))\"><i class=\"color- fa fa-play-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"document.getElementById('" + audio_id + "').load()\"><i class=\"color- fa fa-stop-circle\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"back(document.getElementById('" + audio_id + "'))\"><i class=\"color- fa fa-backward\"></i></a>\n" +
                "    <a href=\"javascript:;\" onclick=\"forward(document.getElementById('" + audio_id + "'))\"><i class=\"color- fa fa-forward\"></i></a>\n" +
                "    <span id="+ "showTime_"+ audio_id +" class=\"showTime\"></span>"+
                "</div></div>";
            return returnVal;
        }

        function getTranscription(cellvalue, options, rowObject) {

            var transcription_id = rowObject.id;

            var returnVal = "<div class=\"containerAudio\">\n" +
                //"<div class=\"watchTranscrp\">\n" +
                "<a href=\"javascript:;\" onclick=\"\"><img src=\"/img/icon_transcription_5.png\" data-toseedetail=\"" + transcription_id + "\" data-id=\"" + transcription_id + "\" data-toggle=\"modal\" data-target=\"#detailTranscription\" /></a>" +
                "</div>";
            return returnVal;
        }

        fetch('admin/controllers/calls/calls_controller.php')
            .then(res => res.json())
    .then((out) => {
            console.log("OK");
        jqgrid_data = out;
        jQuery("#callsTable").jqGrid({
            data: jqgrid_data,
            datatype: 'local',
            height: 'auto',
            colNames: ['<i class="fa fa-lg fa-fw fa fa-file-text-o"></i> ID', '<i class="fa fa-lg fa-fw fa-phone"></i> Contact', '<i class="fa fas fa-hashtag"></i> Number', '<i class="fa fa-lg fa-fw fa-user"></i> Caller', '<i class="fa fa-lg fa-fw fa-user"></i> Agent', '<i class="fa fa-lg fa-fw fa-phone"></i> Bridge To', '<i class="fa fa-lg fa-fw fa-briefcase"></i> Campaign', '<i class="fa fas fa-calendar"></i> Date', '<center><i class="fa fa-lg fa-fw fa fa-clock-o"></i> Duration</center>', '<center><i class="fa fas fa-volume-up"></i> Audio</center>', '<center><img src=\"/img/icon_transcription_5.png\" height=\"18px\" width:\"auto\" /> Transcription</center>'],
            colModel: [
                { name : 'id', index : 'id' , width: 50},
                { name : 'from', index : 'from', width:100, editable : true },
                { name : 'to', index : 'to', width:100, editable : true },
                { name : 'name', index : 'name', editable : true },
                { name : 'agent', index : 'agent', editable : true },
                { name : 'bridge', index:'bridge', width:100 },
                { name : 'campaign', index:'campaign'},
                { name : 'date_created', index:'date_created'},
                { name : 'duration', index:'duration', align:'center', width: 70},
                { name : 'audio', index:'audio', title: false, align: 'center', formatter: setIcons },
                { name : 'transcription', index:'transcription', width:100, title: false, align:'center', formatter: getTranscription}
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
    });
    //MODAL
    $('#detailTranscription').on('show.bs.modal', function (event) {

        var data;
        var celValue;
        var button = $(event.relatedTarget);
        var idTranscription = button.data('toseedetail');
        var modal = $(this);

        modal.find('#transcriptionID').html(idTranscription);
        loadContent(idTranscription);
    });

    $('#detailTranscription').on('hidden.bs.modal', function (event) {
        document.getElementById("chatContent").innerHTML = "";
        //$("#chatContent").html("");
    });

</script>

<script defer>
    title = document.getElementById("contentMainTitle");
    title.innerHTML = "<h1 class=\"page-title txt-color-blueDark\"><i class=\"fa fa-lg fa-fw fa-book\"></i> Calls / <span> Traffic</span></h1>";
</script>
<!---->
<div class="modal fade" id="detailTranscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content centerModal">
            <!-- <div class="modal-header formatModalHeader">
                <h5 class="modal-title" id="exampleModalLabel" style="float: left;">Transcription / <span id="transcriptionID"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <!--<section class="blackBoxTrans"> este era mi blackbox-->

            <section class="containerTranscription">

                <section class="leftSideBar">
                    <header class="userHeaderTrans">
                        <img src="/img/avatars/sunny.png" alt="avatar">
                        <ul>
                            <li>Eduardo Moya</li>
                            <li><span>Call Duration: 1:20:00</span></li>
                            <li><span>Recording: 07/28/2017 at 11:28 AM</span></li>
                        </ul>
                    </header>
                </section>

                <section class="contentTranscription">

                    <header class="headerTranscription">
                        <ul>
                            <li>
                                <div class="agentIcon">
                                    <i class="fa fa-headset"></i>
                                </div>
                            </li>
                            <li><span>Agent: Robert Dosson</span></li>
                        </ul>
                        <ul>
                            <li>
                                <div class="callerIcon">
                                    <i class="fa fa-user"></i>
                                </div>
                            </li>
                            <li><span>Caller: Bennedit Hill</span></li>
                        </ul>
                    </header>
                    <section id="chatContent" class="chatContent">

                        <!--agent / function agentShow-->
                        <!--caller / function callerShow-->

                    </section>
                    <section class="footer">

                    </section>

                </section>
            </section>

            <!--</section> este era mi blackbox-->
            <!-- <div class="modal-body">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
