<?php echo validation_errors(); ?>


<?php 
    if($user==null){
?>
    <div class="easyui-panel" title="Tambah User" style="width:100%;max-width:450px;padding:30px 60px;">
        <form id="ff" method="post" >
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="username" style="width:100%" data-options="label:'Username:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Password" name="password" style="width:100%" data-options="label:'Password:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-passwordbox" prompt="Password" name="re-password" style="width:100%" data-options="label:'Re-Password:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <select class="easyui-combobox" name="bagian" label="Bagian" labelPosition="left" style="width:100%;">
                    <option value="0">Admin</option>
                    <option value="1">Bid.Agenda</option>
                    <option value="2">Bid.Bendahara</option>
                    <option value="3">Bid.Kasda</option>
                </select>
            </div>
            <div style="margin-bottom:20px">
                <select class="easyui-combobox" name="status" label="Status" labelPosition="left" style="width:100%;">
                    <option value="1">Aktif</option>
                    <option value="0">Non - Aktif</option>
                </select>
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
        $value = $user[0]; 
?>
    <div class="easyui-panel" title="Edit User" style="width:100%;max-width:450px;padding:30px 60px;">
        <form id="ff" method="post" >
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="username" style="width:100%" data-options="label:'Username:',required:true" value="<?php echo $value['username'];?>" disabled>
            </div>
            <div style="margin-bottom:20px">
                <select class="easyui-combobox" name="bagian" label="Bagian" labelPosition="left" style="width:100%;">
                    <option value="0" <?php if($value['bagian']=="0") echo "selected"; ?> >Admin</option>
                    <option value="1" <?php if($value['bagian']=="1") echo "selected"; ?> >Bid.Agenda</option>
                    <option value="2" <?php if($value['bagian']=="2") echo "selected"; ?> >Bid.Bendahara</option>
                    <option value="3" <?php if($value['bagian']=="3") echo "selected"; ?> >Bid.Kasda</option>
                </select>
            </div>
            <div style="margin-bottom:20px">
                <select class="easyui-combobox" name="status" label="Status" labelPosition="left" style="width:100%;">
                    <option value="1" <?php if($value['status']=="1") echo "selected"; ?>>Aktif</option>
                    <option value="0" <?php if($value['status']=="0") echo "selected"; ?> >Non - Aktif</option>
                </select>
            </div>
        </form>
        <div style="text-align:center;padding:5px 0">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancel()" style="width:80px">Batal</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm('add')" style="width:80px">Submit</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
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
                        if($user==null) echo site_url('user/add');
                        else echo site_url('user/save/').$user[0]['username'];
                        ?>',
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    if(result=="success")
                        window.location.href = '<?php echo site_url('user');?>';
                    else 
                        alert(result);
                }
            });
        }
        function clearForm(){
            $('#ff').form('clear');
        }
        function cancel(){
            window.location.href = '<?php echo site_url('user');?>';
        }
    </script>

