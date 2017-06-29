(function($){
	$(document).ajaxSend(function (event, xhr, setting) {
		if (setting.data) {
			var dataVars = new URLSearchParams(setting.data);
			if (dataVars.has('action') && dataVars.get('action') == 'bloom_subscribe') {
				if (dataVars.has('subscribe_data_array')) {
					var dataArray = JSON.parse(dataVars.get('subscribe_data_array'));
					if (dataArray.optin_id) {
						var successMsg = $('[data-optin_id="' + dataArray.optin_id + '"]').parent().siblings('.et_bloom_success_message').html();
						if (successMsg.search('redirect=') != -1) {
							var redirect = successMsg.substring(9);
							if (redirect) {
								$('[data-optin_id="' + dataArray.optin_id + '"]').parent().parent().attr('data-optin_id', dataArray.optin_id).attr('data-redirect', redirect);
								$('[data-optin_id="' + dataArray.optin_id + '"]').parent().siblings('.et_bloom_success_message').remove();
							}
						}
					}
				}
			}
		}
	});
	$(document).ajaxSuccess(function (event, xhr, setting) {
		if (xhr.responseJSON && xhr.responseJSON.success == 'success') {
			if (setting.data) {
				var dataVars = new URLSearchParams(setting.data);
				if (dataVars.has('action') && dataVars.get('action') == 'bloom_subscribe') {
					if (dataVars.has('subscribe_data_array')) {
						var dataArray = JSON.parse(dataVars.get('subscribe_data_array'));
						if (dataArray.optin_id) {
							var redirect = $('[data-optin_id="' + dataArray.optin_id + '"]').attr('data-redirect');
							if (redirect) window.location.href = redirect;
						}
					}
				}
			}
		}
	});
})(jQuery)