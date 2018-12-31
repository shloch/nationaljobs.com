<br /><div class="header_01">Award</div>
<form action="<?php echo base_url() . 'index.php/award/addAwards'; ?>" id="addAwardsForm" method="post">
    <fieldset>
        <p class="note">Fields marked with an asterisk (<abbr title="Required field">*</abbr>) are required.</p>

        <!-- Awards -->
        <div>
            <label for="facebook">Your Awards
                <abbr title="Required field"></abbr>
            </label>
            <br />
            <br />
            <div id="parentAwardTableList" style="border: 1px solid red; width: 538px; text-align: center; height: 400px; overflow: auto;">
                <table cellpadding="0" cellspacing="0" border="0" class="display awardTableList" id="awardTableList">
                     <thead>
                             <tr>
                                     <th>Title</th>
                                     <th>Issuing Organization</th>
                                     <th>Date</th>
                                     <th>Place</th>
                                     <th>Description</th>
                                     <th>Action</th>
                             </tr>
                     </thead>
                     <tbody>
                            <tr  rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr  rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr  rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr  rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr  rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                            <tr rel="1">
                                    <td>Title</td>
                                    <td>org</td>
                                    <td>date</td>
                                    <td>place</td>
                                    <td>descr</td>
                                    <td class="center">
                                        <input class="editAward" rel="3" type="button" value = "Edit" />
                                        <input class="deleteAward" rel="3" type="button" value = "Delete" />
                                    </td>
                            </tr>
                    </tbody>
                </table>
            
            </div>
<!--            <span id="errorAwards" class="error2">Please no more than 1000 characters.</span>-->
        </div>
        <!-- Controls -->
        <div class="controls">
            <label for="submit"></label>
            <input id="submit" name="submit" type="submit" class="button_editAwards"
                   value="Save" />
        </div>
        <p class="note loaderImageContener" id="loaderContenerFor_editAwards">
            &nbsp;
        </p>
    </fieldset>
</form>


<script language="javascript">       
    $(function(){
        oAwardTableList = $('#parentAwardTableList').dataTable({
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