<? $this->load->view('includes/header'); ?>
<? $this->load->view('includes/admin_navbar', array('active' => 'delete')); ?>
<div class="container">
	<div class="content" style="display:none">
		<div class="page-header">
			<h1>Delete A User</h1>
		</div>
		<div class="row">
			<div class="span4">
				<form id="formDelete" class="well" accept-charset="utf-8">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<select id="formSelect" name="email" class="input-large">
						<? foreach($users as $user): ?>
							<option value="<?=$user['email']?>">
							<?=$user['email']?>
							</option>
						<? endforeach;?>
						</select>
					</div>
					<button type="submit" class="btn btn-danger btn-large" data-loading-text="Sending...">
					<i class="icon-trash icon-white"></i> Delete User</button>
				</form>
			</div>
		</div>
		<div id="success" class="row" style="display: none">
			<div class="span4">
				<div id="successMessage" class="alert alert-success"></div>
			</div>
		</div>
		<div id="error" class="row" style="display: none">
			<div class="span4">
				<div id="errorMessage" class="alert alert-error"></div>
			</div>
		</div>
	</div>
	<script src="<?=base_url('js/jquery.js')?>"></script>
	<script src="<?=base_url('js/bootstrap-button.js')?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("#formDelete").submit(function(){
			
			$("#formDelete button").button('loading');
			$("#success").hide();
			$("#error").hide();
			
			var faction = "<?=site_url('admin/delete_user')?>";
			var fdata = $("#formDelete").serialize();

			$.post(faction, fdata, function(rdata){
				var json = jQuery.parseJSON(rdata);
				if(json.isSuccessful){
					$("#successMessage").html(json.message);
					$("#success").show();
					$("#formSelect option[value='"+ json.email + "']").remove();
				}else{
					$("#errorMessage").html(json.message);
					$("#error").show();
				}
				
				$("#formDelete button").button('reset');
			});
				
			return false;
		});

		$(".content").fadeIn(1000);
	});
	</script>
<? $this->load->view('includes/footer'); ?>