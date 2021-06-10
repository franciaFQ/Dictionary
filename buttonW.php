<!-- Delete -->
    <div class="modal fade" id="del<?php echo $word; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Delete Word</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center>Word: <strong><?php echo $word; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancel</button>
                    <a href="actions.php?acc=delW&word=<?php echo $word ?>" class="btn btn-danger"> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->