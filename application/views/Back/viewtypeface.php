<?= $this->load->view('include/bakheader'); ?>
<div class="span10" >
    <div style="display: table;
         width: 100%;">
        <div class="pull-left"><h1>Font Code : <?= $typeface->FontCode ?>   </h1></div>
        <div class="pull-right">
            <?php if ($_SESSION['commitee']->SelectionRemain > 0 && $canmark): ?>
                <button onclick="App.confirm_mark(<?= $typeface->FontID ?>);" class="btn btn-large btn-info" > Mark  </button> 

            <?php else: ?>
                <div class="alert alert-info text-center">
                   
                       Mark already
                  
                </div>
            <?php endif; ?>
        </div>  
    </div>
    <p> <strong>Lastedited-Time </strong> :  <?= $typeface->Lasteditedtime ?>  </p>  
    <p> <strong>User</strong> :  <?= $username ?>  </p>  
    <p> <strong>Fontname</strong> :  <?= $typeface->Fontname ?>  </p>  
    <h4>Description</h4>
    <blockquote>
        <p> <?= $typeface->Description ?></p>
    </blockquote>
    <iframe class="showpdf"  src="<?= site_url('Backend/typeface/rendertypeface/' . $typeface->FontID) ?>"  ></iframe>




</div>


<?= $this->load->view('include/bakfooter'); ?>