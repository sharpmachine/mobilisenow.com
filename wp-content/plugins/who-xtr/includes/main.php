<div class="page-header">
	<h1>Facebook App Settings</h1>
</div><!--End of page header -->
<div class="row">
    <form class="form-horizontal" role="form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
        <div class="form-group">
            <label for="" class="col-lg-2 control-label">Facebook App ID</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" name="hwextpro-fb-app-id" placeholder="Enter Facebook App ID here" value="<?php echo $hwextproOptions["hwextpro-fb-app-id"]; ?>" />
            </div>
        </div><!--End of form group -->

        <div class="form-group">
            <label for="" class="col-lg-2 control-label">Facebook App Secret</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" name="hwextpro-fb-app-scrt" placeholder="Enter Facebook Secret here" value="<?php echo $hwextproOptions["hwextpro-fb-app-scrt"] ?>" />
            </div>
        </div><!--End of form group -->
        
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
            	<input type="hidden" name="action" value="<?php echo base64_encode("save-fb-details"); ?>" />
                <input type="submit" class="btn btn-primary" value="Save" />
            </div>
        </div><!--End of form group -->
    </form>
</div><!--End of row -->