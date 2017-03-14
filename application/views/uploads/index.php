<div class="row-fluid">
    <div class="col-md-12">
        <?php echo form_open_multipart(base_url("uploads/do_upload"), array('id'=>'uploads-form', 'class'=>'form-horizontal', 'data-toggle'=>'validator', 'role'=>'form')); ?>
            <div class="form-group">
                <label class="col-lg-3 control-label">Investors:</label>
                <div class="col-lg-8">
                    <?php echo form_dropdown('investor', $investors, $investor, "id='investor' class='' required"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Setting file:</label>
                <div class="col-lg-8">
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
    <div class="col-md-12">
        <div class="list-group">
            <?php foreach ($files as $f): ?>
            <a href="#" class="list-group-item"><?php echo $f; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#uploads-form').formValidation({
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
                            message: 'Please choose a excel file'
                        }                            
                    }
                },
            }
        });

        jQuery('#investor').selectpicker({
            size: 10,
        });

    });
</script>
