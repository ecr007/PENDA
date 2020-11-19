$(document).ready(function() {
    $('#dataTable').DataTable();

    $(document).on('change','.get-data',function(){
        var fun = $(this).data('fun');
    	var method = $(this).data('method');
        var destinity = $(this).data('des');
    	var value = $(this).val();
    	

    	var request = $.ajax({
    		url: URL+"/ajax.php",
    		type: 'POST',
    		dataType: 'json',
    		data: {
                "action":fun,
    			"method":method,
    			"value":value
    		}
    	});
    	
    	request.always(function(data) {
    		if(data.code == 200){
    			$('#'+destinity).html(data.html);
    		}
    	
    		if(data.code == 400){
    		}
    	
    		if(data.code == 500){
    		}
    	});
    });
});