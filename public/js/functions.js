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

	return {
		init: function () {
			logout();
			openModal();
		},
		onload: function () {
		},
		onresize: function () {
			
		}
	};
	
	
}();