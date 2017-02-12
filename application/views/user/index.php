<table id="my-dg" style="width:100%;height:100%">
</table>
<script type="text/javascript">
    var dg = $("#my-dg");
    var idx = undefined;
    var user;
    
    dg.datagrid({
        fitColumns:true,
        singleSelect:true,
        pagination:true,
        rownumbers:true,
        pageSize: 30,
        url: '<?php echo site_url('user/data');?>',
        columns:[[
            {field:'username',title:'Username',sortable:true},
            {field:'bagian',title:'Bagian',width:200,sortable:true,
                formatter: function(value,row,index){
                    switch(row.bagian){
                        case "0" : return "Admin"; break;
                        case "1" : return "Bid.Agenda"; break;
                        case "1" : return "Bid.Bendahara"; break;
                        case "3" : return "Bid.Kasda"; break;
                        default: break;
                    }
                }
            },
            {field:'status',title:'Aktif',width:130,
                formatter: function(value,row,index){
                    switch(row.status){
                        case "0" : return "Non - Aktif"; break;
                        case "1" : return "Aktif"; break;
                        default: break;
                    }
                }
            }
        ]],
        onClickRow : function(index,row){
            console.log(row);
            idx = index;
            user = row;
        }

    }).datagrid('getPager').pagination({
        buttons:[
        {
            iconCls:'icon-add',
            handler:function(){
                window.location.href = '<?php echo site_url('user/add');?>';
            }
        },
        {
            iconCls:'icon-remove',
            handler:function(){
                if(idx==undefined){return};
                $.ajax({
                    type : 'GET',
                    url : '<?php echo site_url('user/remove');?>/'+user.username,
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
                window.location.href = '<?php echo site_url('user/save/');?>'+user.username;
            }
        }]  
    });
</script>