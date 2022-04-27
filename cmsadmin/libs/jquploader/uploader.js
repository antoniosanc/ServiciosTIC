$().ready(function()
{
	var settings = {
		url: "./libs/jquploader/upload.php",
		dragDrop:true,
		fileName: "myfile",
		allowedTypes:"jpg,png,gif,jpeg",	
		returnType:"json",
		 onSuccess:function(files,data,xhr)
		{
			 setTimeout("location.reload();", 2000);
		},
		showDelete:true,
		deleteCallback: function(data,pd)
		{
		for(var i=0;i<data.length;i++)
		{
			$.post("./libs/jquploader/delete.php",{op:"delete",name:data[i]},
			function(resp, textStatus, jqXHR)
			{
				//Show Message  
				$("#status").append("<p align='center' class='text-error' >Archivo eliminado</p>").hide("normal");      
			});
		 }      
		pd.statusbar.hide(); //You choice to hide/not.

	}
	}
	var uploadObj = $("#mulitplefileuploader").uploadFile(settings);

});