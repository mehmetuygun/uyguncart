addresses = [];

$(function() {
	$('#saddress,#baddress').on('change', loadAddressDetails);
});

function loadAddressDetails() {
	var det_container,
		cur,
		html = '',
		addr_id = $(this).val();

	det_container = $(this)
		.closest('.form-group')
		.siblings('.address-details');

	cur = addresses[addr_id];
	if (!cur) {
		det_container.empty();
		return;
	}

	details = [
		cur['full_name'],
		cur['address1'],
		cur['address2'],
		cur['city'],
		cur['postcode'],
		cur['country_name']
	];

	html += '<p>' + details.join('</p><p>') + '</p>';
	html += '<a href="' + base_url + 'address/edit/' + addr_id + '"';
	html += ' class="btn btn-default edit-btn" data-target="#addressModal"';
	html += ' data-toggle="modal">Edit</a>';
	det_container.html(html);
}

function loadAddressList(res) {
	var cur,
		html = '<option>Please select</option>',
		ship_address = $('#saddress'),
		bill_address = $('#baddress');

	var prev_ship = ship_address.val();
	var prev_bill = bill_address.val();

	addresses = [];
	for (var i=0; i < res.length; i++) {
		cur = res[i];
		addresses[cur['address_id']] = cur;

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

	ship_address.html(html)
		.val(prev_ship)
		.trigger('change');
	bill_address.html(html)
		.val(prev_bill)
		.trigger('change');
}
