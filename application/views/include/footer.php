</div >
</div>
<script src="<?= base_url('asset/javascripts/jquery-1.8.3.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('asset/javascripts/museutils.js?4215913851') ?>" type="text/javascript"></script>
<script src="<?= base_url('asset/javascripts/jquery.musemenu.js?3888647712') ?>" type="text/javascript"></script>
<script src="<?= base_url('asset/javascripts/jquery.watch.js?4199601726') ?>" type="text/javascript"></script>

<script src="<?= base_url('asset/App.js') ?>" type="text/javascript"></script>
<!-- Other scripts -->
<script type="text/javascript">
 
    Muse.Utils.addSelectorFn('.MenuBar', function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
    Muse.Utils.addSelectorFn('body', function() { Muse.Utils.fullPage('#page'); }); /* 100% height page */
   
 <?php if ($this->session->flashdata('Msg')): ?>
                               
                    alert("<?=trim($this->session->flashdata('Msg'))?>");
  <?php endif; ?>
</script>
</body>
</html>