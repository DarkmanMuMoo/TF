<?= $this->load->view('include/bakheader'); ?>
<div class="span10" >

    <div id="search-bar" style="text-align: center;" >   
        ค้นหา:<input type="text"  name="keyword" id="text" class="input-small"  value="<?= (isset($text)) ? $text : '' ?>"/>
        User <?= $userdropdown ?>
        การให้คะแนน  <select id="select_con" name="select_con">  
            <option value="0"  <?= ($select_con == 0) ? 'selected="selected"' : ''; ?> > ทังหมด</option>
            <option value="1"  <?= ($select_con == 1) ? 'selected="selected"' : ''; ?>  > ยังไม่ได้ให้คะแนน </option>
            <option value="2" <?= ($select_con == 2) ? 'selected="selected"' : ''; ?>  > ให้คะแนนแล้ว  </option>
            <option value="3" <?= ($select_con == 3) ? 'selected="selected"' : ''; ?>  > ยังไม่ได้รับคะแนน จากใคร</option>

        </select>
        <button style="margin-left: 10px;
                margin-bottom: 10px;" onclick="App.search(App.getFont_template());" class="btn">Search</button>
    </div>
    <div id="result"  align="center">
        <table  class=" table table-bordered" >
            <thead>
            <th>
                FontCode
            </th>
            <th>
                Fontname
            </th>
            <th>
                UploadTime
            </th>
            <th>
                Lasteditedtime
            </th>
            <th>
                User
            </th>
            <th>
                Command
            </th>
            </thead>
            <tbody>


            </tbody>



        </table>
        <img id="loading-indicator"  src="<?= base_url('asset/images/ajax-loader.gif'); ?>" style="display:none; margin-top: 50px;" />
        <div id="page_link">


        </div>


    </div>



</div>
<?= $this->load->view('include/bakfooter'); ?>
<script>
  
    $('#search-bar #user').prepend('<option value="0" > All  </option>');
    
    if( $('#user option[selected]').length == 0){
        $('#user option[value="0"]').attr('selected', 'selected');
    }
    $(".chzn-select").chosen();
    App.setTemplate(App.getFont_template());
    App.generatequery(0);
</script>