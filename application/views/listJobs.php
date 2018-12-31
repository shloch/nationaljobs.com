<?php
/*
 * lists all the jobs posted by the currently logged User/company
 * CHRIS BRis : Thursday 08/08/2013 - Ramadan day (9:46pm)
 */
?>

<link rel="stylesheet" href="<?php echo base_url() ?>css/form.css" media="screen">

<h1>MANAGE YOUR CREATED JOBS</h1>
<center>
    <?PHP
    echo '<img src="' . base_url() . 'images/add.jpeg" alt="" title=""/>';
    echo anchor("company/createJob", "CREATE NEW JOB", "Click here to create new job");
    if ($jobsForThisCompany != FALSE) {
        ?>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="listJobsTable" width="100%">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Job Title</th>
                    <th>Number of Views</th>
                    <th>Contract Type</th>
                    <th>Education Required</th>
                    <th>DeadLine</th>
                    <th>EDIT/DELETE</th>
            </thead>      
            <tbody>
                <?php
                $i = 0;
                //print_r($jobsForThisCompany);
                foreach ($jobsForThisCompany as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <a href="<?php echo site_url('company/jobDetails/' . $row->job_id); ?>"><?php echo $row->title; ?> </a>
                        </td>
                        <td><?php echo $row->visit_counter; ?></td>
                        <td><?php echo $row->contract_type; ?></td>
                        <td><?php echo $row->education_requirement; ?></td>
                        <td><?php echo $row->deadline; ?></td>
                        <td>
                            <a href="<?php echo site_url('company/editJob/' . $row->job_id); ?>" title="">
                                <img src="<?php echo base_url() ?>images/edit.jpeg" alt="edit" title="Edit Job"/>
                            </a>
                            <a href="<?php echo site_url('company/deleteJob/' . $row->job_id); ?>" title="" onclick="return confirm('Are you sure?')">
                                <img src="<?php echo base_url() ?>images/del.jpeg" alt="delete" title="Delete Job"/>
                            </a>
                            
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
            </tr>

        </table><br/><br/><br/>
        <?php
    } else {
        echo "<div>No jobs Created Yet.........</div><BR/><BR/>";
        echo '<img src="' . base_url() . 'images/add.jpeg" alt="" title=""/>';
        echo anchor("company/createJob", "CREATE NEW JOB", "Click here to create new job");
    }
    ?>

</center>



<script language="javascript">       
    $(function(){
        oAwardTableList = $('#listJobsTable').dataTable({
            "sDom": 'T<"clear">lfrtip',
            "oTableTools": {
                "sRowSelect": "multi",
                "aButtons": [ "select_all", "select_none" ]
            },
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sUrl": "<?php echo base_url() ?>librairies/DataTables-1.9.4/media/language/en-EN.txt"
            }
        });
    })
    //    $(document).ready(function() {
    //        $('#example').dataTable();
    //    } );
</script>    
<!--The table scripts-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/datatable_additional_css.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo base_url() ?>librairies/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>librairies/DataTables-1.9.4/extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url() ?>librairies/DataTables-1.9.4/extras/TableTools/media/js/TableTools.js"></script>

<link rel="stylesheet" href="<?php echo base_url() ?>librairies/DataTables-1.9.4/media/css/demo_page.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>librairies/DataTables-1.9.4/media/css/demo_table_jui.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>librairies/DataTables-1.9.4/extras/TableTools/media/css/TableTools.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url() ?>librairies/DataTables-1.9.4/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css" type="text/css" media="screen" />
