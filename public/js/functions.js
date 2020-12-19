var KY = function () {

	var logout = function(event){
		$(document).on('click','.ecr-logout',function(){
			document.getElementById('ecr-logout-form').submit();
			return false;
		});
	}

	var openModal = function(){
		$(document).on('click','.gathr-open-modal',function(){

			var title = $(this).data('title');
			var img = $(this).data('img');

			$('#gathr-modal .modal-title').text(title);
			$('#gathr-modal .modal-body').html('<img src="'+img+'" alt="'+title+'" class="img-fluid" />');

			$('#gathr-modal').modal('show');

			return false;
		});
	}

	var getAjax = function(){
		$(document).on('change','.get-data',function(){
	    	
	    	if($(this).val() != ""){

		    	var route = $(this).data('route');
		        var destinity = $(this).data('des');
		    	var value = $(this).val();
		    	var crsf = $('meta[name="csrf-token"]').attr('content')
		    	

		    	var request = $.ajax({
		    		url: route,
		    		type: 'POST',
		    		dataType: 'json',
		    		data: {
		    			"value":value,
		    			"_token":crsf,
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
	    	}
	    });
	}

	var DT = function(){
		var datatable = function(){
			$('#ecr-table').DataTable();
		}
	}

	return {
		init: function () {
			logout();
			openModal();
			getAjax();
		},
		onload: function () {
		},
		onresize: function () {
			
		}
	};
	
	
}();