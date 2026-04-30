$(document).ready(function () {
	'use strict';

	var addonFilter = 'Installed';
	var categoryFilter = 'All';
	var strFilter = '';
	var isInstalling = false;

	$('[data-toogle="cart"]').on('click', function (event) {
		event.preventDefault();

		const $button = $(this);
		const url = $button.attr('href');

		toastr.info(modaui_localize.updating_cart || 'Updating Cart');

		$.get(url, function (data) {
			$button.toggleClass('in-cart');

			$('#itemCount').html(data.itemCount);

			toastr.success(data.message);
		});
	});

	function updateList() {
		$('.lqd-extension').each((index, element) => {
			var show = true;

			if (addonFilter == 'All') {
				// show all
			} else if (addonFilter == 'Installed') {
				if ($(element).attr('data-installed') != '1') {
					show = false;
				}
			} else if (addonFilter == 'Free') {
				if ($(element).attr('data-price') != '0') {
					show = false;
				}
			} else if (addonFilter == 'Paid') {
				if ($(element).attr('data-price') == '0') {
					show = false;
				}
			}

			if (categoryFilter != 'All') {
				if ($(element).attr('data-category') != categoryFilter) {
					show = false;
				}
			}

			if (!$(element).attr('data-name').toLowerCase().includes(strFilter)) {
				show = false;
			}

			if (show) {
				$(element).removeClass('hidden');
			} else {
				$(element).addClass('hidden');
			}
		});
	}

	$('.addons_filter').on('click', function () {
		$('.addons_filter').removeClass('active');
		$(this).addClass('active');
		var filter = $(this).attr('data-filter');
		addonFilter = filter;
		updateList();
	});

	$('.category_filter').on('click', function () {
		$('.category_filter').removeClass('active');
		$(this).addClass('active');
		var category = $(this).attr('data-category');
		categoryFilter = category;
		updateList();
	});

	$('#search_str').on('keydown', function (e) {
		if (e.key == 'Enter') {
			strFilter = $('#search_str').val();
			updateList();
		}
	});

	$('#btn_confirm_method').on('click', function () {

		const btn = $(this);
		let formData = new FormData();

		btn.prop('disabled', true);
		btn.addClass('lqd-is-busy');
		Alpine.store('appLoadingIndicator').show();

		$.ajax({
			type: 'post',
			url: '/dashboard/admin/marketplace/buy/' + btn.attr('data-name'),
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {
				window.location.href = data.url;
			},
			error: function (data) {
			},
			complete: function () {
				btn.prop('disabled', false);
				btn.removeClass('lqd-is-busy');
				Alpine.store('appLoadingIndicator').hide();
			}
		});
	});

	$('.btn_install').on('click', function () {
		if (isInstalling) return;
		isInstalling = true;
		let btn = $(this);

		btn.addClass('lqd-is-busy');

		btn.attr('disable', true);

		let formData = new FormData();

		Alpine.store('appLoadingIndicator').show();

		$.ajax({
			type: 'post',
			url: '/install-extension/' + btn.attr('data-name'),
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {
				toastr.success(modaui_localize?.addon_installed ||'Add-on installed succesfully.');
				setTimeout(() => {
					window.location.reload();
				}, 2000);
			},
			error: function (data) {
				if ( data?.responseJSON?.message ){
					toastr.error( data?.responseJSON?.message);
				}
			},
			complete: function () {
				isInstalling = false;
				btn.removeClass('lqd-is-busy');
				btn.attr('disable', false);
				Alpine.store('appLoadingIndicator').hide();
			}
		});
	});

	$('.btn_installed').on('click', function () {
		if (isInstalling) return;
		isInstalling = true;
		let btn = $(this);

		btn.addClass('lqd-is-busy');
		btn.attr('disable', true);

		let formData = new FormData();

		Alpine.store('appLoadingIndicator').show();

		$.ajax({
			type: 'post',
			url: '/uninstall-extension/' + btn.attr('data-name'),
			data: formData,
			contentType: false,
			processData: false,
			success: function (data) {
				toastr.success(modaui_localize?.addon_uninstalled ||'Add-on uninstalled succesfully.');
				setTimeout(() => {
					window.location.reload();
				}, 2000);
			},
			error: function (data) {
				if ( data?.responseJSON?.message ){
					toastr.error( data?.responseJSON?.message);
				}
			},
			complete: function () {
				isInstalling = false;
				btn.removeClass('lqd-is-busy');
				btn.attr('disable', false);
				Alpine.store('appLoadingIndicator').hide();
			}
		});

	});

	const accordionItems = document.querySelectorAll('.custom-accordion-item');

	$('.custom-accordion-header').on('click', function () {

		const accordionItem = $($(this).closest('.custom-accordion-item'));

		const accordionIcon = $(accordionItem.find('.custom-accordion-icon'));

		const accordionBody = $(accordionItem.find('.custom-accordion-body'));

		if (accordionItem.hasClass('active')) {
			accordionIcon.removeClass('rotate-180');
			accordionItem.removeClass('active');
			accordionBody.animate({
				height: 0
			}, 200, 'linear', function () {
				accordionBody.hide();
			});
		} else {
			accordionIcon.addClass('rotate-180');
			accordionItem.addClass('active');
			accordionBody.css('height', '0px');
			accordionBody.css('display', 'block');
			accordionBody.css('overflow', 'hidden');
			// accordionBody.removeClass('hidden');
			accordionBody.animate({
				height: '100%'
			}, 200, 'linear', function () {
				// accordionBody.hide();
			});
		}
	});


});

