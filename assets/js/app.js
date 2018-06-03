$(document).ready(function(){
	var BASE_URL = '<?=BASE_URL;?>';

	toastr.options.closeMethod = 'fadeOut';
	toastr.options.closeDuration = 1000;
	toastr.options.closeEasing = 'swing';
	toastr.options.newestOnTop = false;
	toastr.options.timeOut = 5000; 
	toastr.options.extendedTimeOut = 1000;
	toastr.options.progressBar = true;
	toastr.options.closeButton = true;				
});
