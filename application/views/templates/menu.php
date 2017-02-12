<div class="easyui-layout" style="width:100%;height:100%;">
	<div data-options="region:'north',border:false" style="background:#B3DFDA">
		<div style="padding:5px;text-align: right;background:#B3DFDA">
			<a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-setting'"></a>
		</div>
		<div id="mm1" style="width:150px;">
			<div>Pengaturan</div>
			<div onclick="logout()">Keluar</div>
		</div>
	</div>
  <script>
        function logout(){
            window.location.href = '<?php echo site_url('login/logout');?>';
        }
    </script>