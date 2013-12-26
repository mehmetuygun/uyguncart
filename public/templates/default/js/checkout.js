function loadAddressList(res) {
	var cur,
		html = '<option>Please select</option>',
		ship_address = $('#saddress'),
		bill_address = $('#baddress');

	for (var i=0; i < res.length; i++) {
		cur = res[i];

		details = [
			cur['full_name'],
			cur['address1'],
			cur['address2'],
			cur['city'],
			cur['postcode'],
			cur['country_name']
		];

		html += '<option value="' + cur['address_id'] + '">';
		html += details.join(', ');
		html += '</option>';
	}

	ship_address.html(html);
	bill_address.html(html);
}
