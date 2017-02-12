<table id="my-dg" title="Custom DataGrid Pager" style="width:700px;height:250px">
</table>
<script type="text/javascript">
    var dg = $("#my-dg");
    var url = '<?php echo site_url('agenda/data');?>';
    var idx = undefined;
    var agenda;
    dg.datagrid({
        fitColumns:true,
        singleSelect:true,
        pagination:true,
        rownumbers:true,
        url: '<?php echo site_url('agenda/data');?>',
         columns:[[
            {field:'code',title:'Code',width:80},
            {field:'agenda',title:'Agenda',width:100,sortable:true},
            {field:'price',title:'Price',width:80,align:'right',sortable:true}
        ]],
        onClickRow : function(index,row){
            console.log(row);
            idx = index;
            agenda = row;
        }

    }).datagrid('getPager').pagination({
        buttons:[
        {
            iconCls:'icon-add',
            handler:function(){
                window.location.href = '<?php echo site_url('agenda/add');?>';
            }
        },
        {
            iconCls:'icon-remove',
            handler:function(){
                if(idx==undefined){return};
                $.ajax({
                    type : 'GET',
                    url : '<?php echo site_url('agenda/remove');?>/'+agenda.code,
                    success : function(data){
                        if(data=="success"){
                            dg.datagrid('deleteRow', idx);
                            dg.datagrid('reload');
                            idx = undefined;
                        }else{
                            alert("Data tidak berhasil di hapus");   
                        }
                    }
                });
            }
        },{
            iconCls:'icon-edit',
            handler:function(){
                if(idx==undefined){return};
                window.location.href = '<?php echo site_url('agenda/');?>'+agenda.code;
            }
        }]  
    });
</script>