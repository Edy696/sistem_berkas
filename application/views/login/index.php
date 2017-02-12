
<div style="margin:10% auto;display: flex;justify-content: center;">
	<div class="easyui-panel" title="Login" style="width:100%;max-width:400px;padding:30px 60px;">
	<?php 
	echo validation_errors();
	?>
	<form id="ff" method="post" action="<?php echo site_url('login/login');?>">
		<div style="margin-bottom:20px">
			<input class="easyui-textbox" name="username" style="width:100%" data-options="label:'Username:',required:true">
		</div>
		<div style="margin-bottom:20px">
			<input name="password" class="easyui-passwordbox" prompt="Password" iconWidth="28" style="width:100%;height:34px;padding:10px" data-options="label:'Username:',required:true">
		</div>
	</form>
	<div style="text-align:center;padding:5px 0">
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Masuk</a>
	</div>
</div>
<script>
	function submitForm(){
		$('#ff').submit();
	}
</script>