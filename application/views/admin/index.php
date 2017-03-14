<div class="row-fluid">
    <div id="button-wrapper" class="col-md-12 btn-group-lg">
        <input type="button" id="btn-upload" class="btn btn-primary" value="Upload">
        <input type="button" id="btn-download" class="btn btn-primary" value="Download">
    </div>
    <div id="upload-form-wrapper" class="col-md-12">
        <?php echo form_open_multipart(base_url("admin/do_upload"), array('id'=>'admin-setting-form', 'class'=>'form-horizontal', 'data-toggle'=>'validator', 'role'=>'form')); ?>
            <div class="form-group">
                <label class="col-lg-3 control-label">Setting file:</label>
                <div>
                    <input name="settings" class="btn btn-default" type="file" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <input type="submit" id="btn-submit" class="btn btn-primary" value="Upload & Save">
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
    <div id="setting-table" class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Id</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['tid']; ?></td>
                    <td><?php echo $row['value']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#admin-setting-form')
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    settings: {
                        validators: {
                            notEmpty: {
                                message: 'The full name is required and cannot be empty'
                            },
                            file: {
                                extension: 'csv,xls,xlsx',
                                message: 'Please choose a correct excel file'
                            }                            
                        }
                    },
                }
            });
        
        jQuery( "#upload-form-wrapper" ).dialog({
            autoOpen: false,
            width: 700,
            modal: true,
            title: "Admin setup"
        });
        
        jQuery("#btn-upload").click(function() {
            jQuery( "#upload-form-wrapper" ).dialog( "open" );
        });
        
        jQuery("#btn-download").click(function() {
            location.href = '<?php echo base_url('admin/do_download'); ?>';
        });
    });
</script>
