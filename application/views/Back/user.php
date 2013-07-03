<?= $this->load->view('include/bakheader'); ?>
<div class="span10" >

    <div id="search-bar" style="text-align: center;" >   
        ค้นหา:<input type="text"  name="keyword" id="text" class="input-small"  value="<?= (isset($text)) ? $text : '' ?>"/>

        เพศ  <select id="sex" name="sex">  
            <option value="0"  <?= ($selected == 0) ? 'selected="selected"' : ''; ?> > ทังหมด</option>
            <option value="1"  <?= ($selected == 1) ? 'selected="selected"' : ''; ?>  >  ชาย </option>
            <option value="2"  <?= ($selected == 2) ? 'selected="selected"' : ''; ?>  > หญิง </option>
        </select>
        <button style="margin-left: 10px;
                margin-bottom: 10px;" onclick="App.search();" class="btn">Search</button>
    </div>
    <div id="result"  align="center">
        <table  class=" table table-bordered" >
            <thead>
            <th>
                Username
            </th>
            <th>
                Name
            </th>
            <th>
                Mobile
            </th>
            <th>
                Telephone
            </th>
            <th>
                Age
            </th>
            <th>
                Email
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
  

    App.setTemplate(App.getUser_template());
    App.generatequery(0);
</script>