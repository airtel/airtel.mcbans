

            </div> <!-- Close content -->
            
            <div class="banner_holder"><a href="http://airtel.lv" target="_blank"><img alt="airtel" src="<?php echo base_url(); ?>assets/img/art.png"></a></div>
            <div style="clear: both;"></div>
            
        </div> <!-- Close basic wrapper -->
        
    </div> <!-- Close basic container -->
    
    <?php 
    /**
     * Remove this if you want
     */
    if($this->config->item('iframe_mode') != TRUE)
        echo '<br /><br />';
    ?>
    
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.8.2.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- dataTables -->
    <script src="<?php echo base_url(); ?>assets/lib/datatables/jquery.dataTables.min.js"></script>
    
    <!-- Chosen select -->
    <script src="<?php echo base_url(); ?>assets/lib/chosen/chosen.jquery.js"></script>    
    
    <!-- Jquery validation -->
    <script src="<?php echo base_url(); ?>assets/lib/validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/validation/localization/messages_lv.js"></script>
    
    <!-- Variables -->
    <script>
        var iframe_mode = <?php echo ($this->config->item('iframe_mode')) ? 'true' : 'false'; ?>;
        var base_url = '<?php echo base_url(); ?>';
        var site_url = '<?php echo site_url(); ?>';
    </script>
    
    <!-- Airtel -->
    <script src="<?php echo base_url(); ?>assets/js/airtel.init.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/airtel.validation.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/airtel.iframe.js"></script>
    
    <script>
        $(document).ready(function() {
            
            setTimeout(function() {
                $('.content, .banner_holder').hide();
                $('html').removeClass('js');
                $('.content, .banner_holder').fadeIn(400);
            }, 700);
            
        });
    </script>
    
</body>
</html>