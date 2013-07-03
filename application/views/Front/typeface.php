<?= $this->load->view('include/header'); ?>
<div  class="wraper">
    <h1>Type Face</h1>
    <table  class="table table-bordered typelist " class="typelist"  >
        <thead><th>Type Code</th>
        <th>Type Name</th>

        <th>Upload Time</th>
        <th>Last Edited</th>
        <th>Command</th>
        </thead>
        <tbody>

            <?php foreach ($typelist as $type): ?>
                <tr>
                    <td><?= $type->FontCode ?></td>
                    <td><?= $type->Fontname ?></td>
                    <td><?= $type->Uploadtime ?></td>
                    <td><?= $type->Lasteditedtime ?></td>
                    <td><a class="btn btn-primary" href="<?= site_url('typeface/viewtypeface/' . $type->FontID) ?>"   >View</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <hr/>
    <div class="add-section" >
        <?php echo validation_errors('<div style="margin-top: 20px;" class="alert alert-error">', '</div>'); ?>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= site_url('typeface/addfont') ?>" >
            <fieldset>
                <!-- Form Name -->
                <legend>Add Font</legend>
                <!-- Text input-->
                <div class="control-group">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <input id="fontname" name="fontname" type="text" placeholder="Name" class="input-xlarge" required>
                    </div>
                </div>

                <!-- File Button --> 
                <div class="control-group view">
                    <label class="control-label">Font File</label>
                    <div class="controls">
                        <input id="fontfile" name="fontfile"  type="file" required >
                    </div>
                </div>

                <!-- Textarea -->
                <div class="control-group">
                    <label class="control-label">Description</label>
                    <div class="controls">                     
                        <textarea id="description" name="description"  style="margin: 0px; width: 335px; height: 151px;" ></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls">
                        <input type="submit" value="Apply" class="btn btn-primary"  >
                    </div>
                </div>

            </fieldset>
        </form>



    </div>
</div>

<?= $this->load->view('include/footer'); ?>
<script>


    App.validate_addform();
</script>