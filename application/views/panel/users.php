<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Usuarios</h2>

<?php if (isset($error)): ?>
	<div class="alert alert-danger" data-dismiss="alert" role="alert"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (isset($info)): ?>
	<div class="alert alert-info" data-dismiss="alert" role="alert"><?php echo $info; ?></div>
<?php endif; ?>

<?php if ($userCount == 0): ?>
	<div class="alert alert-warning" role="alert">No existen usuarios registrados en la base de datos.</div>
<?php else: ?>

	<input type="serach" class="form-control" placeholder="Buscar..." id="busqueda" />
	<table class="table table-hover table-responsive">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Opciones</th>
		</tr>
	</thead>
		<tbody>
				<?php foreach ($users as $key => $user): ?>
					<tr>
						<td><?php echo $user->name; ?></td>
						<td><?php echo $user->email; ?></td>
						<td><?php echo $user->type; ?></td>
						<td>
							<button type="button" data-toggle="modal" data-target="#dialog-edit-user" data-user-id="<?php echo $user->id; ?>" data-type="<?php echo $user->type; ?>" data-email="<?php echo $user->email; ?>" data-name="<?php echo $user->name; ?>" class="btn btn-warning btn-xs">
								<span class="glyphicon glyphicon-pencil"></span>
							</button> 
							<button type="button" data-toggle="modal" data-target="#dialog-confirm-remove" data-target-id="<?php echo $user->id; ?>" data-target-name="<?php echo $user->name; ?>" class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-remove"></span>
							</button>
						</td>
				</tr>
				<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>

<button type="button" data-toggle="modal" data-target="#dialog-add-user" class="btn btn-info btn-sm">
	<span class="glyphicon glyphicon-plus"></span> Añadir
</button>

<!-- Dialogo confirmar eliminacion -->
<div id="dialog-confirm-remove" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-confirm-remove" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="label-confirm-remove">Confirmar eliminación</h4>
			</div>
			<form method="POST">
				<div class="modal-body">
					<p>¿Confirma la eliminación del usuario <strong class="remove-name"></strong>?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
				<input type="hidden" id="remove-id" name="user-remove-id" value="">
				<input type="hidden" name="form-type" value="user-remove">

			</form>
		</div>
	</div>
</div>

<!-- Dialogo editar -->
<div id="dialog-edit-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-edit-user" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="label-edit-user">Editar usuario</h4>
			</div>
			<form method="POST">
			<div class="modal-body">
				<div class="form-group">
					<label for="user-edit-type">Tipo</label>

					<div class="radio">
						<label>
						<input type="radio" name="user-edit-type" id="user-edit-type" value="student">
						Estudiante
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-edit-type" id="user-edit-type" value="teacher">
						Profesor
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-edit-type" id="user-edit-type" value="admin">
						Administrador
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-edit-type" id="user-edit-type" value="none">
						Inactivo
						</label>
					</div>
						
				</div>

				<!-- Email -->
				<div class="form-group">
					<label for="user-edit-email">Email</label>
					<input type="email" id="user-edit-email" name="user-edit-email" class="form-control" value="" required>
				</div>

				<!-- Nombre -->
				<div class="form-group">
					<label for="user-edit-name">Nombre</label>
					<input type="text" id="user-edit-name" name="user-edit-name" class="form-control" value="" required>
				</div>

				<!-- Password -->
				<div class="form-group">
					<label for="user-edit-password">Contraseña</label>
					<input type="password" id="user-edit-password" name="user-edit-password" class="form-control" value="" placeholder="********">
					<span id="helpBlock" class="help-block">Deja en blanco si no quieres modificarla</span>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
				<button type="submit" class="btn btn-primary">Editar</button>
			</div>
			<input type="hidden" id="user-edit-id" name="user-edit-id" value="">
			<input type="hidden" name="form-type" value="user-edit">

			</form>
		</div>
	</div>
</div>


<!-- Dialogo Añadir dispositivo --> 
<div id="dialog-add-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-add-user" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="label-add-user">Añadir usuario</h4>
			</div>
			<form method="POST">
			<div class="modal-body">
				<div class="form-group">
					<label for="user-add-type">Tipo</label>

					<div class="radio">
						<label>
						<input type="radio" name="user-add-type" id="user-add-type" value="student" checked>
						Estudiante
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-add-type" id="user-add-type" value="teacher">
						Profesor
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-add-type" id="user-add-type" value="admin">
						Administrador
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="user-add-type" id="user-add-type" value="none">
						Inactivo
						</label>
					</div>
						
				</div>

				<!-- Email -->
				<div class="form-group">
					<label for="user-add-email">Email</label>
					<input type="email" id="user-add-email" name="user-add-email" class="form-control" value="" required>
				</div>

				<!-- Nombre -->
				<div class="form-group">
					<label for="user-add-name">Nombre</label>
					<input type="text" id="user-add-name" name="user-add-name" class="form-control" value="" required>
				</div>

				<!-- Password -->
				<div class="form-group">
					<label for="user-add-password">Contraseña</label>
					<input type="password" id="user-add-password" name="user-add-password" class="form-control" value="" placeholder="********" required>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
				<button type="submit" class="btn btn-primary">Añadir</button>
			</div>
			<input type="hidden" name="form-type" value="user-add">

			</form>
		</div>
	</div>
</div>