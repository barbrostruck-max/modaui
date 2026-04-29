jQuery(document).ready(function($) {
	'use strict';

	$(document).on('click', '#modaui-chatbot-widget .modaui-chatbot-widget--trigger', function (e) {
		console.log(modaui_js_options)
		if ( !modaui_js_options.guest_status ) {
			toastr.error(modaui_localize?.please_active_modaui ||
						'Please Active The modaui');
			return false;
		}

		var $this = $(this);
		var chat = $this.parent().find('.modaui-chatbot-widget--chat');
		var messages = chat.find('.modaui-chatbot-widget--messages');
		var message_list = chat.find('.modaui-chatbot-widget--message-list');
		chat.toggleClass('active');


		if ( ! $this.hasClass('loaded') ){
			$('#modaui-chatbot-widget').addClass('is-loading');
			messages.empty();
			jQuery.post( modaui_js_options.ajaxurl, { action: 'modaui_chatbot_get_chat' }, function ( response ) {
				if ( response.chat_history ) {
					$('#modaui-chatbot-widget .modaui-chatbot-widget--chat').toggleClass('active-message-list');
					message_list.append(response.output);
				} else {
					$('#modaui-chatbot-widget form').attr('data-id', response.chat_id);
					messages.append(response.output);
				}
				$('#modaui-chatbot-widget').removeClass('is-loading');
				messages.scrollTop(messages[0].scrollHeight - messages[0].clientHeight);
				$this.addClass('loaded');
			});

		}
		e.preventDefault();

	});

	$(document).on('click', '#modaui-chatbot-widget .start-new-chat', function (e) {

		if ( !modaui_js_options.guest_status ) {
			toastr.error(modaui_localize?.please_active_modaui ||
						'Please Active The modaui');
			return false;
		}

		var messages = $('#modaui-chatbot-widget .modaui-chatbot-widget--messages');
		messages.empty();
		var message_list = $('#modaui-chatbot-widget .modaui-chatbot-widget--message-list');

		$('#modaui-chatbot-widget .modaui-chatbot-widget--chat').removeClass('active-message-list');
		$('#modaui-chatbot-widget').addClass('is-loading');

		jQuery.post( modaui_js_options.ajaxurl, { action: 'modaui_chatbot_start_new_chat' }, function ( response ) {
			$('#modaui-chatbot-widget form').attr('data-id', response.chat_id);
			$('#modaui-chatbot-widget').removeClass('is-loading');
			messages.append(response.output);
			message_list.append(response.output_list);
			messages.scrollTop(messages[0].scrollHeight - messages[0].clientHeight);
		});

		e.preventDefault();

	});

	$(document).on('click', '#modaui-chatbot-widget .message-list', function (e) {

		if ( !modaui_js_options.guest_status ) {
			toastr.error(modaui_localize?.please_active_modaui ||
						'Please Active The modaui');
			return false;
		}
		$('#modaui-chatbot-widget .modaui-chatbot-widget--chat').toggleClass('active-message-list');

	});

	$(document).on('click', '#modaui-chatbot-widget .modaui-chatbot-widget--message-list--item', function (e) {

		if ( !modaui_js_options.guest_status ) {
			toastr.error(modaui_localize?.please_active_modaui ||
						'Please Active The modaui');
			return false;
		}

		var chat_id = $(this).attr('data-id');
		var messages = $('#modaui-chatbot-widget .modaui-chatbot-widget--messages');
		messages.empty();
		$('#modaui-chatbot-widget').addClass('is-loading');
		$('#modaui-chatbot-widget .modaui-chatbot-widget--chat').toggleClass('active-message-list');
		$('#modaui-chatbot-widget form').attr('data-id', chat_id);
		jQuery.post( modaui_js_options.ajaxurl, { action: 'modaui_chatbot_get_chat', chat_id: chat_id }, function ( response ) {
			$('#modaui-chatbot-widget').removeClass('is-loading');
			messages.append(response.output);
			messages.scrollTop(messages[0].scrollHeight - messages[0].clientHeight);
		});

	});

	// send message
	let chatBotStop = false;
	$(document).on('submit', '#modaui-chatbot-widget form', function (e) {

		if ( !modaui_js_options.guest_status ) {
			toastr.error(modaui_localize?.please_active_modaui ||
						'Please Active The modaui');
			return false;
		}

		let form = $(this);
		form.addClass('is-working');
		let chat_id = form.attr('data-id');
		let result = $('#modaui-chatbot-widget .modaui-chatbot-widget--messages');
		let button = form.find('.start');
		// let button_stop = form.find('.stop');
		let prompt = form.find('#prompt').val();
		form.find('#prompt').val('');
		let message_id = Date.now();
		// var message_data = '';
		chatBotStop = false;

		result.append(`<div class="modaui-chatbot-widget--message">${prompt}</div>`);
		result.scrollTop(result[0].scrollHeight - result[0].clientHeight);

		jQuery.post( modaui_js_options.ajaxurl, { action: 'modaui_chatbot_get_chat_data', chat_id: chat_id }, function ( response ) {
			if ( response.error ){
				toastr.error(response.message);
				result.append(`<div class="modaui-chatbot-widget--message ai text-${message_id}">${response.message}</div>`);
				result.scrollTop(result[0].scrollHeight - result[0].clientHeight);
				return false;
			} else {
				result.append(`<div class="modaui-chatbot-widget--message ai text-${message_id}"></div>`);
				result.scrollTop(result[0].scrollHeight - result[0].clientHeight);
				asyncChatBot(prompt,result,message_id,response.data, chat_id);
			}
		});

		e.preventDefault();

	});

	let asyncChatBot = async (prompt,result,message_id,message_data, chat_id) => {

		let prompt_first = prompt;
		const final_prompt = await jQuery.post(
			modaui_js_options.ajaxurl,
			{ action: 'modaui_chatbot_getMostSimilarText', prompt: prompt, chat_id: chat_id },
			function ( response ) {
				if ( response.extra_prompt ) {
					prompt = response.extra_prompt;
				}
			}
		);

		let chunk = [];
		let streaming = true;
		let controller = null; // Store the AbortController instance
		let message = result.find( '.modaui-chatbot-widget--message.text-' + message_id );

		controller = new AbortController();
		const signal = controller.signal;

		const response = await fetch(atob(modaui_js_options.guest_id), {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				Authorization: 'Bearer ' + atob(modaui_js_options.guest_event_id) + atob(modaui_js_options.guest_look_id) + atob(modaui_js_options.guest_product_id),
			},
			body: JSON.stringify({
				model: modaui_js_options.model.chatbot,
				messages: message_data.concat([{'role': 'user', 'content': prompt}]),
				stream: true, // For streaming responses
			}),
			signal, // Pass the signal to the fetch request
		});

		if(response.status != 200) {
			throw response;
		}
		// Read the response as a stream of data
		const reader = response.body.getReader();
		const decoder = new TextDecoder('utf-8');

		while (true) {
			// if ( window.console || window.console.firebug ) {
			// 	console.clear();
			// }

			if (chatBotStop) {
				return; // Exit the function
			}
			const { done, value } = await reader.read();
			if (done) {
				streaming = false;
				break;
			}
			// Massage and parse the chunk of data
			const chunk1 = decoder.decode(value);
			const lines = chunk1.split('\n');

			const parsedLines = lines
				.map((line) => line.replace(/^data: /, '').trim()) // Remove the "data: " prefix
				.filter((line) => line !== '' && line !== '[DONE]') // Remove empty lines and "[DONE]"
				.map((line) => {
					try {
						return JSON.parse(line);
					} catch (ex) {
						console.log(line);
					}
					return null;
				}); // Parse the JSON string

			for (const parsedLine of parsedLines) {
				if (!parsedLine) continue;
				const { choices } = parsedLine;
				const { delta } = choices[0];
				const { content } = delta;
				// const { finish_reason } = choices[0];

				if (content) {
					chunk.push(content);
					message.append(content.replace( /(?:\r\n|\r|\n)/g, ' <br> ' ));
					result.scrollTop(result[0].scrollHeight - result[0].clientHeight);
				}
			}
		}
		jQuery.post( modaui_js_options.ajaxurl, { action: 'modaui_chatbot_save_chat_data', prompt: prompt_first, message: chunk.join(''), chat_id: chat_id }, function ( response ) {
			result.scrollTop(result[0].scrollHeight - result[0].clientHeight);
			$('#modaui-chatbot-widget form').removeClass('is-working');
		});
	};

});