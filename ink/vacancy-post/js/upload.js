(function ($j) {
	$j(document).ready(function () {
		$j(document).on('click', '#resumeSubmit', function (e) {
			e.preventDefault();

			var vacancy_name = $j("#vacancyName").val();
			var resume_author = $j("#resumeName").val();
			var resume_email = $j("#resumeEmail").val();
			var resume_file = $j("#resumeFile").val();

			console.log(resume_author);

			jQuery.ajax({
				type   : 'POST',
				url    : themename_ajax_object.ajax_url,
				data   : {
					action : 'themename_resume_data',
					name   : resume_author,
					email  : resume_email,
					file   : resume_file,
					vacancy: vacancy_name
				},
				success: function (data, textStatus, XMLHttpRequest) {
					jQuery.ajax({
						type   : 'POST',
						url    : themename_ajax_object.ajax_url,
						data   : {
							action : 'themename_resume_upload',
							file   : resume_file,
							vacancy: vacancy_name
						},
						success: function (data, textStatus, XMLHttpRequest) {

						},
						error  : function (MLHttpRequest, textStatus, errorThrown) {
						}
					})
				},
				error  : function (MLHttpRequest, textStatus, errorThrown) {
				}
			})

		});
	});
})(jQuery);