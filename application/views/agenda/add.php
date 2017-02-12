<?php echo validation_errors(); ?>


<?php 
	if($agenda==null){
?>
    <div class="easyui-panel" title="Tambah Agenda" style="width:100%;max-width:400px;padding:30px 60px;">
        <form id="ff" method="post" >
            <input type="hidden" name="action" value="save"/>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="code" style="width:100%" data-options="label:'Code:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="agenda" style="width:100%;height:60px" data-options="label:'Agenda:',required:true,multiline:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="price" style="width:100%" data-options="label:'Price:',required:true">
            </div>
        </form>
        <div style="text-align:center;padding:5px 0">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()" style="width:80px">Batal</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('add')" style="width:80px">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
        </div>
    </div>
<?php
	}else{
        $value = $agenda[0]; 
?>
    <div class="easyui-panel" title="Rubah Agenda" style="width:100%;max-width:400px;padding:30px 60px;">
        <form id="ff" method="post" >
            <input type="hidden" name="action" value="save"/>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="code" style="width:100%" data-options="label:'Code:',required:true" value="<?php echo $value['code']; ?>" disabled>
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="agenda" style="width:100%;height:60px" data-options="label:'Agenda:',required:true,multiline:true" value="<?php echo $value['agenda']; ?>">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="price" style="width:100%" data-options="label:'Price:',required:true" value="<?php echo $value['price']; ?>" >
            </div>
        </form>
        <div style="text-align:center;padding:5px 0">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()" style="width:80px">Batal</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('update')" style="width:80px">Simpan</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Bersihkan</a>
        </div>
    </div>
<?php
	}
?>
    <script>
        function submitForm(act){
            var url_form;
            
            $('#ff').form('submit',{
                url : '<?php 
                        if($agenda==null) echo site_url('agenda/add');
                        else echo site_url('agenda/').$agenda[0]['code'];
                        ?>',
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    window.location.href = '<?php echo site_url('agenda');?>';
                }
            });
        }
        function clearForm(){
            $('#ff').form('clear');
        }
        function cancel(){
            window.location.href = '<?php echo site_url('agenda');?>';
        }
    </script>

