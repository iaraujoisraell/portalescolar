<div class="container-fluid padded">
    <div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons-->
            <div class="action-nav-normal">
                <div class="row-fluid">
                    
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?educacional/aluno">
                            <img src="<?php echo base_url(); ?>template/images/icons/icon-secondary/user.png" />
                            <span><?php echo 'Consulta Alunos'; ?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?educacional/turma">
                            <img src="<?php echo base_url(); ?>template/images/icons/class.png" />
                            <span><?php echo 'Turma'; ?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?educacional/matricula">
                            <img src="<?php echo base_url(); ?>template/images/icons/teacher.png" />
                            <span><?php echo 'Matrícula'; ?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="#">
                            <img src="<?php echo base_url(); ?>template/images/icons/icon-secondary/teacher.png" />
                            <span><?php echo 'Professor'; ?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                            <img src="<?php echo base_url(); ?>template/images/icons/noticeboard.png" />
                            <span><?php echo 'Avisos'; ?></span>
                        </a>
                    </div>



                </div>
                
            </div>
        </div>
        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>
    
     <div class="row-fluid">
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <div class="title">
                        <i class="icon-calendar"></i>
                        <?php echo 'Calendário Acadêmico'; ?>
                    </div>
                </div>
                <div class="box-content">
                    <div id="calendar2">
                    </div>
                </div>
            </div>
        </div>
        <!---CALENDAR ENDS-->

        <!---TO DO LIST STARTS-->
        <div class="span6">
            <div class="box">
                <div class="box-header">
                    <span class="title">
                        <i class="icon-reorder"></i>
                        <?php echo 'Avisos'; ?>
                    </span>
                </div>
                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                    <?php
                    $notices = $this->db->get('noticeboard')->result_array();
                    foreach ($notices as $row):
                        ?>
                        <div class="box-section news with-icons">
                            <div class="avatar blue">
                                <i class="icon-tag icon-2x"></i>
                            </div>
                            <div class="news-time">
                                <span><?php echo date('d', $row['create_timestamp']); ?></span> <?php echo date('M', $row['create_timestamp']); ?>
                            </div>
                            <div class="news-content">
                                <div class="news-title">
                                    <?php echo $row['notice_title']; ?>
                                </div>
                                <div class="news-text">
                                    <?php echo $row['notice']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!---TO DO LIST ENDS-->
    </div>


  
</div>

 <script>
        $(document).ready(function () {

            // page is now ready, initialize the calendar...

            $("#calendar2").fullCalendar({
                header: {
                    left: "prev,next",
                    center: "title",
                    right: "month,agendaWeek,agendaDay"
                },
                editable: 0,
                droppable: 0,
                /*drop: function (e, t) {
                 var n, r;
                 r = $(this).data("eventObject"), n = $.extend({}, r), n.start = e, n.allDay = t, $("#calendar").fullCalendar("renderEvent", n, !0);
                 if ($("#drop-remove").is(":checked")) return $(this).remove()
                 },
                 
                 nulled by Vokey*/
                events: [
<?php
$notices = $this->db->get('noticeboard')->result_array();
foreach ($notices as $row):
    ?>
                        {
                            title: "<?php echo $row['notice_title']; ?>",
                            start: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>),
                            end: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>)
                        },
    <?php
endforeach
?>
                ]
            })

        });
    </script>