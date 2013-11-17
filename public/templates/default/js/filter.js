function change_filter(field, value, submit) {
	$('#filter_form').find('[name=' + field + ']').val(value);

	if (submit) submit_filter();
}

function submit_filter() {
	document.getElementById('filter_form').submit();
}
