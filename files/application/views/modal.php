

<!-- SIMPLE AJAX MODAL -->
<script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        //jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }
    </script>

<div class="modal inmodal" id="modal_ajax" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                
            </div>
            <div class="modal-body">
                <!-- ajax content to be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- LARGE AJAX MODAL -->
<script type="text/javascript">
    function showLargeAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        //jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax_large').modal('show', {backdrop: 'true'});
        
        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax_large .modal-body').html(response);
            }
        });
    }
    </script>

<div class="modal inmodal" id="modal_ajax_large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 70%;">
        <div class="modal-content animated fadeInLeftBig">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php
                    echo $this->db->get_where('settings' , array('type' => 'company_name'))->row()->description;
                ?>
            </h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                
            </div>
            <div class="modal-body">
                <!-- ajax content to be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!---- DELETE MODAL -->
<script type="text/javascript">
    function showDeleteModal(delete_url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        //jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
        
        // LOADING THE AJAX MODAL
        jQuery('#modal_delete').modal('show', {backdrop: 'true'});
        $("#delete_link").attr("href", delete_url);
        
    }
    </script>

<div class="modal inmodal" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content animated rotateIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                Do you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="delete_link" href="#">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables -->
    <script src="assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/plugins/dataTables/dataTables.responsive.js"></script>


