
    
    <!-- Custom scripts -->
    <script src="assets/js/custom.js"></script>
    
    <!-- Mainly scripts -->
    <script src="assets/js/jquery-2.1.1.js"></script>
    <!-- jQuery UI -->
    <script src="assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Handle jQuery plugin naming conflict between jQuery UI and Bootstrap -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    $.widget.bridge('uitooltip', $.ui.tooltip);
    </script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="assets/js/syncrypts.js"></script>
    <script src="assets/js/plugins/pace/pace.min.js"></script>

    <!-- GITTER -->
    <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- iCheck -->
    <script src="assets/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Data picker -->
    <script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- MENU -->
    <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- Jquery Validate -->
    <script src="assets/js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Data Tables -->
    <script src="assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/plugins/dataTables/dataTables.responsive.js"></script>

    <script src="assets/js/plugins/dataTables/TableTools.min.js"></script>

    <!-- SUMMERNOTE -->
    <script src="assets/js/plugins/summernote/summernote.min.js"></script>
    <!-- CHOSEN SELECT -->
    <script src="assets/js/plugins/chosen/chosen.jquery.js"></script>
    <script>
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"100%"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


            $('.summernote').summernote({height:250});

        });
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };

    </script>

    <!-- Calls data table -->
    <script>
        $(document).ready(function() {
            $('.dataTables-example').dataTable({
                responsive: true,
                "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
               
                                        
            });
        });

    </script>

    <!-- Table Tools -->
    <script type="text/javascript">
        $(document).ready(function() {
            
        } );
    </script>
    
    <!-- Form validate -->
    <script type="text/javascript">
        $("#validated_form").validate();
    </script>
    
    <!-- Show notifications -->
    <?php if ($this->session->flashdata('flash_message') != ""): ?>

        <script type="text/javascript">


            $.gritter.add({
                title: '<?php echo $this->session->flashdata("flash_message");?>',
                text: '',
                time: 4000
            });

        </script>

    <?php endif;?>

    <!-- Call Datepicker -->
    <script>
        $(document).ready(function(){

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true
            });
			
			
            $('#data_5 .input-daterange').datepicker({
				//format: 'dd/mm/YYYY',
                keyboardNavigation: true,
                forceParse: true,
                autoclose: true
            });

        });
    </script>
    
    <!-- Form wizard -->
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>

    
    <!-- Contact box -->
    <script>
        $(document).ready(function(){
            $('.contact-box').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>

    <!-- SALE PAGE FUNCTIONS -->
    <script>
        <?php if ($page_name == 'sale_edit'):?>
            total_number = <?php echo $total_number;?>;
        <?php endif;?>
        <?php if ($page_name == 'sale_add'):?>
            total_number = 0;
        <?php endif;?>
        function add_product(product_id)
        {
            //if (total_number != 0)
              //  total_number = 0;

            total_number++;
            
            // get the product detail
            $.ajax({
                url: '<?php echo base_url();?>index.php?admin/get_selected_product/mouse/' +  product_id + '/' + total_number,
                success: function(response)
                {
                    jQuery('#invoice_entry_holder').append(response);
                    calculate_grand_total(); 
                }
            });

            // on change each single entry, update the grand total area also
            //     

        }




        function barcode_input(e , serial_number)
        {
             var key;

             if(window.event)
                  key = window.event.keyCode;     //IE
             else
                  key = e.which;     //firefox

              // confirm barcode input and add product to list
             if(key == 13)
             {
                    //alert(serial_number);
                    total_number++;
            
                    // get the product detail
                    $.ajax({
                        url: '<?php echo base_url();?>index.php?admin/get_selected_product/barcode/' +  serial_number + '/' + total_number,
                        success: function(response)
                        {
                            jQuery('#invoice_entry_holder').append(response);
                            calculate_grand_total(); 
                            $("#barcode").val("");
                        }
                    });
                    //$("#barcode_input").val() = '';
                    //$("#barcode_input").focus();
                  return false;
             }
             else
                  return true;
        }

        function calculate_single_entry_total(entry_number)
        {

            quantity        = $("#single_entry_quantity_"+entry_number).val();
            selling_price   = $("#single_entry_selling_price_"+entry_number).val();

            single_entry_total = quantity * selling_price;
            $("#single_entry_total_"+entry_number).html( single_entry_total );

            // on change each single entry, update the grand total area also
            calculate_grand_total();
        }

        // calculate the grand total area
        function calculate_grand_total()
        {

            // calculating subtotal
            sub_total = 0;
            for (var i = 1 ; i <= total_number ; i++)
            {
                sub_total   +=   Number( $("#single_entry_total_"+ i).html() );
                
            }
            $("#sub_total").html( sub_total );

            // calculating grand total
            discount_percentage    =   Number( $("#discount_percentage").val() );
            vat_percentage         =   Number( $("#vat_percentage").val() );

            sub_total              =   sub_total - (sub_total * (discount_percentage / 100));
            grand_total            =   sub_total + (sub_total * (vat_percentage / 100));

            grand_total            =    grand_total.toFixed(2);
            $("#grand_total").html( grand_total );
        }

        function get_product( type , category_id )
        {
            // get the product list
            $.ajax({
                url: '<?php echo base_url();?>index.php?admin/get_sale_product_list/' + type + '/' + category_id,
                success: function(response)
                {
                    jQuery('#product_list_holder').html(response);
                }
            });

            
            // get the sub-category list
            if (type == 'category')
            {
                $.ajax({
                    url: '<?php echo base_url();?>index.php?admin/get_sub_category_list/' + category_id,
                    success: function(response)
                    {
                        jQuery('#sub_category_holder').html(response);
                    }
                });
            }





        }

        function remove_row(entry_number)
        {
            //alert (total_number);
            $('#entry_row_'+entry_number).remove();

            for (var i = entry_number ; i < total_number ; i++)
            {
                $("#single_entry_total_"            + (i + 1) ).attr("id" , "single_entry_total_" + i);

                $("#serial_number_"                 + (i + 1) ).attr("id" , "serial_number_" + i);
                $("#serial_number_"                 + (i ) ).html(i);

                $("#single_entry_quantity_"         + (i + 1) ).attr("id" , "single_entry_quantity_" + i);
                $("#single_entry_quantity_"         + (i ) ).attr("onkeyup" , "calculate_single_entry_total(" + i + ")");

                $("#single_entry_selling_price_"    + (i + 1) ).attr("id" , "single_entry_selling_price_" + i);
                $("#single_entry_selling_price_"    + (i ) ).attr("onkeyup" , "calculate_single_entry_total(" + i + ")");
                
                $("#delete_button_"                 + (i + 1) ).attr("id" , "delete_button_" + i);
                $("#delete_button_"                 + (i ) ).attr("onclick" , "remove_row(" + i + ")");

                $("#entry_row_"                     + (i + 1) ).attr("id" , "entry_row_" + i);

                console.log(i);
            }

            total_number--;
            // on deletion each single entry, update the grand total area also
            calculate_grand_total();
        }
    </script>
    