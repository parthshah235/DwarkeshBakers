var uniqueModal = {
	modal : null,
	title : null,
	content : null,
	action : null,
	init : function () {
		$('body').append('<div id="modalUnique" class="modal modal-fixed-footer"><div class="modal-content"><h4 id="muTitle" style="background-color: #ee6e73;color: white;padding-top: 8px;height: 50px;" class="brand-logo center"></h4><hr/><p id="muContent"></p></div><div class="modal-footer center-align" id="muAction"></div></div>');
		this.modal = $('#modalUnique');
		this.title = $('#modalUnique #muTitle');
		this.content = $('#modalUnique #muContent');
		this.action = $('#modalUnique #muAction');
	},
	setTitle : function (title) {
		this.title.html(title);
		return 1;
	},
	setContent : function (content) {
		this.content.html(content);
		return 1;
	},
	/*
	usage exemple :
	uniqueModal.setAction([
		uniqueModal.createAction('send', 'sendFunction(var1, var2)'),
		uniqueModal.createAction('cancel', 'uniqueModal.close()')
	]);
	*/
	setAction : function (array) {
		if (!Array.isArray(array)) {
			console.warn('uniqueModal : WARN : setAction arg is not an array.');
			return -1;
		};
		var html = "";
		for (var i = array.length - 1; i >= 0; i--) {
			html += '<a class="modal-action modal-close waves-effect waves-green btn" style="float:none;" onClick="'
				+array[i].callback_name.replace(/'/g, "\\'").replace(/"/g, "'")
				+'">'+array[i].name+'</a>&nbsp;';
		};
		this.action.html(html);
		return 1;
	},
	createAction : function (button_name, callback_name) {
		var ret = {
			name : button_name,
			callback_name : callback_name
		};
		return ret;
	},
	open : function (options) {
		this.modal.openModal(options);
		return 1;
	},
	close : function () {
		this.modal.closeModal();
		$('.lean-overlay').fadeOut();
		return 1;
	}
};