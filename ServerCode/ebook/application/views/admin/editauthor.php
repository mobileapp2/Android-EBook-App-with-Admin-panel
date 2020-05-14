<?php
$this->load->view('admin/comman/header');
?>

<div class="clearfix"></div>

<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumb-->
		<div class="row pt-2 pb-2">
			<div class="col-sm-9">
				<h4 class="page-title">Add Author</h4>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javaScript:void();">Authors</a></li>
					<li class="breadcrumb-item active" aria-current="page">Add Author</li>
				</ol>
			</div>
			<div class="col-sm-3">
				<div class="btn-group float-sm-right">
					<a href="<?php echo base_url();?>index.php/admin/authorlist" class="btn btn-outline-primary waves-effect waves-light">Authors List</a>
				</div>
			</div>
		</div>
		<!-- End Breadcrumb-->
		<?php $vid=$authorlist[0]; ?>
		<div class="row">
			<div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Add Author
							<form id="edit_video_form"  enctype="multipart/form-data">

								<div class="form-group">
									<label for="input-1">Author Name</label>
									<input type="text" required value="<?php echo $vid->a_title; ?>" class="form-control" name="input_name" id="input-1" placeholder="Enter Book Name">
								</div>

								<div class="form-group">
									<label for="input-1">Author Address</label>
									<input type="text" required value="<?php echo $vid->a_address; ?>" class="form-control" name="input_address" id="input-1" >
								</div>

								<input type="hidden" name="id" value="<?php echo $vid->a_id; ?>">

								<div class="form-group">
									<label for="input-1"> Author Profile Picture</label>
									<input type="file" required  class="form-control" name="input_profile" id="input-1" onchange="readURL(this,'showImage')">
									<input type="hidden" name="inputprofile" value="<?php echo $vid->a_image; ?>">
									<p class="noteMsg">Note: Image Size must be less than 2MB.Image Height and Width less than 1000px.</p>
									<div><img id="showImage" src="<?php echo base_url().'assets/images/author/'.$vid->a_image; ?>" height="100px;" width="100px;"></div>
								</div>

								<div class="form-group">
									<label for="input-1">Book Description</label>
									<textarea cols="40" rows="5" style="height: 150px" type="text" class="form-control" name="input_description" id="input-1" required value="<?php echo $vid->a_bio; ?>" ><?php echo $vid->a_bio; ?></textarea>
								</div>

								<div class="form-group">
									<button type="button" onclick="updateauthor()" class="btn btn-primary shadow-primary px-5">Save</button>
								</div>

							</form>
						</div>
					</div>
				</div></div></div>
			</div>

			<?php
			$this->load->view('admin/comman/footerpage');
			?>
			<script type="text/javascript">

				function updateauthor(){

					$("#dvloader").show();
					var formData = new FormData($("#edit_video_form")[0]);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url(); ?>index.php/admin/updateauthor',
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
						dataType: "json",
						success:function(resp){
							$("#dvloader").hide();
							if(resp.status=='200'){
								document.getElementById("edit_video_form").reset();
								toastr.success(resp.msg,'success');
								setTimeout(function(){ location.reload(); }, 500);
							}else{
								toastr.error(resp.msg);
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							$("#dvloader").hide();
							toastr.error(errorThrown.msg,'failed');         
						}
					});
				}
			</script>