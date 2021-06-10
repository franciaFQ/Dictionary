<!-- Delete -->
    <div class="modal fade" id="del<?php echo $code; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Delete Category</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center>Name: <strong><?php echo $nameC; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancel</button>
                    <a href="actions.php?acc=del&id=<?php echo $code ?>" class="btn btn-danger"> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $code; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Edit Category</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
					
					<div class="container-fluid">
						<form method="POST" action="actions.php?acc=edit">
							<div class="row">
								<div class="col-lg-2">
									<label style="position:relative; top:7px;" for="idE">ID:</label>
								</div>
								<div class="col-lg-10">
									<input type="text" name="idE" class="form-control" value="<?php echo $code; ?>" readonly="true">
								</div>
							</div>
							<div style="height:10px;"></div>
							<div class="row">
								<div class="col-lg-2">
									<label style="position:relative; top:7px;" for="nameE">Name:</label>
								</div>
								<div class="col-lg-10">
									<input type="text" name="nameE" class="form-control" value="<?php echo $nameC; ?>">
								</div>
							</div>
	                </div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"> Cancel</button>
                    <button type="submit" class="btn btn-warning"> Save</button>
                </div>
				</form>
            </div>
        </div>
    </div>
<!-- /.modal -->