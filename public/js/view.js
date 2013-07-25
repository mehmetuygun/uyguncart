$(function() {
	$('input[name=search]').on('input', function() {
		var search = $('input[name=search]').val();
		ajax(search, 1);
	});

	$('#delete').on('click',function(){
		var checkboxValues = [];
		$('tbody [type=checkbox]:checked').each(function() {
			checkboxValues.push(this.value);
		});

		if (checkboxValues.length == 0)
			alert('Please select the items you want to delete.');
		else if (!confirm('Are sure you want to delete?'))
			return;

		$.post('delete', {list:checkboxValues}, function() {
			ajax('', 1);
		});
	});

	init_delete();
	init_pagination();
});

function ajax(search, page) {
	$.post('ajax', {page:page,search:search}, function(data) {
		draw_table(data[0]);
		init_delete();
		draw_page(data[1]);
	}, 'json');
}

function check_all() {
	$('tbody [type=checkbox]').each(function() {
		this.checked = !this.checked;
	});
}

function draw_page(data) {
	pagination(data[1],data[0]);
	show_info(data[1],data[2]);
	init_pagination();
}

function init_delete(){
	$('.delete_one').unbind('click').on('click',function() {
		checkboxValues = [$(this).attr("href").substring(1)];

		if (!confirm('Are sure you want to delete?'))
			return;

		$.post('delete', {list:checkboxValues}, function() {
			ajax('', 1);
		});
	});
}

function init_pagination() {
	$(".pagination ul li a").unbind('click').on('click', function() {
		if ($(this).parent().hasClass('disabled')) return;
		var search = $('input[name="search"]').val();
		var page = $(this).attr('href').substring(1);
		ajax(search, page);
	});
}

pagination = function(page, pcount) {
	var returnLink = function(label, page, clsDef) {
		if (clsDef) clsDef = ' class="' + clsDef + '" ';
		return '<li' + clsDef + '>\
			<a href="#' + page + '" onclick="return false">' +
			label +'</a></li>';
	};

	var range = function(pcount) {
		var nums = [];
		for (var i = 1; i <= pcount; i++) {
			nums.push(i);
		}
		return nums;
	};

	var getPageNumbers = function(page, pcount) {
		var nums = range(pcount);
		if (pcount <= 10) return nums;
		if (page < 6) {
			return nums.splice(0, 6).concat(['...'], nums.splice(-4, 4));
		} else if (page > pcount - 5) {
			return nums.splice(0, 4).concat(['...'], nums.splice(-6, 6));
		} else {
			return nums.splice(0, 2).concat(['...'], nums.splice(page - 5, 5), ['...'], nums.splice(-2, 2));
		}
	};

	var html = '<ul>';
	page = parseInt(page);
	pcount = parseInt(pcount);
	var nums = getPageNumbers(page, pcount);
	var prev = page > 1 ? page - 1 : '';
	var next = page < pcount ? page + 1 : '';
	html += returnLink('&laquo;', prev, prev ? '' : 'disabled');
	for (var i = 0; i < nums.length; i++) {
		if (nums[i] == page) {
			html += returnLink(nums[i], '', 'active');
		} else if (nums[i] != '...') {
			html += returnLink(nums[i], nums[i], '');
		} else {
			html += returnLink(nums[i], nums[i], 'disabled');
		}
	}
	html += returnLink('&raquo;', next, next ? '' : 'disabled');
	html += '</ul>';
	$('.pagination').html(html);
}

function show_info(page,entries) {
	var message,limit=10;
	if(entries<=limit && page == 1)
		message = "Showing 1 to "+entries+" of "+entries+" entries.";
	if(entries>limit && page == 1)
		message = "Showing 1 to 10 of "+entries+" entries.";
	if(entries>limit && page > 1) {
		if(entries>(limit*page))
			message = "Showing "+(((page*limit)-limit)+1)+" to "+(page*limit)+" of "+entries+" entries.";
		else
			message = "Showing "+(((page*limit)-limit)+1)+" to "+entries+" of "+entries+" entries.";
	}
	$("#show_info").empty();
	$("#show_info").append(message);
}
