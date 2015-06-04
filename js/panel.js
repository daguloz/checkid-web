// Panel CheckID

$(document).ready(function() {


	$('#dialog-edit-device').on('show.bs.modal', function (event) {

		// Botón que activa el modal
		var button = $(event.relatedTarget);

		// Extrae valores de atributos data-*
		var id = button.data('device-id');
		var type = button.data('type');
		var tag = button.data('tag');
		var user = button.data('user');
		var description = button.data('description');
		
		var modal = $(this);
		modal.find('.modal-title').text('Editando dispositivo ' + tag);
		modal.find('#device-edit-type[value=' +  type + ']').prop('checked', true);
		modal.find('#device-edit-tag').val(tag);
		modal.find('#device-edit-user').val(user);
		modal.find('#device-edit-description').val(description);
		modal.find('#device-edit-id').val(id);
	});

	$('#dialog-edit-user').on('show.bs.modal', function (event) {

		// Botón que activa el modal
		var button = $(event.relatedTarget);

		// Extrae valores de atributos data-*
		var id = button.data('user-id');
		var type = button.data('type');
		var name = button.data('name');
		var email = button.data('email');
		
		var modal = $(this);
		modal.find('.modal-title').text('Editando usuario ' + name);
		modal.find('#user-edit-type[value=' +  type + ']').prop('checked', true);
		modal.find('#user-edit-name').val(name);
		modal.find('#user-edit-email').val(email);
		modal.find('#user-edit-id').val(id);
	});

	$('#dialog-confirm-remove').on('show.bs.modal', function (event) {

		// Botón que activa el modal
		var button = $(event.relatedTarget);

		// Extrae valores de atributos data-*
		var id = button.data('target-id');
		var name = button.data('target-name');
		
		var modal = $(this);
		modal.find('.remove-name').text(name);
		modal.find('#remove-id').val(id);
	});


});