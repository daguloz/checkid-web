<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Dispositivos</h2>

<?php if (isset($error)): ?>
	<div class="alert alert-danger" data-dismiss="alert" role="alert"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (isset($info)): ?>
	<div class="alert alert-info" data-dismiss="alert" role="alert"><?php echo $info; ?></div>
<?php endif; ?>

<?php if ($deviceCount == 0): ?>
	<div class="alert alert-warning" role="alert">No existen dispositivos registrados en la base de datos.</div>
<?php else: ?>

	<input type="serach" class="form-control" placeholder="Buscar..." id="busqueda" />
	<table class="table table-hover table-responsive">
	<thead>
		<tr>
			<th>Tag ID</th>
			<th>Tipo</th>
			<th>Usuario</th>
			<th>Opciones</th>
			<th>Descripcion</th>
		</tr>
	</thead>
		<tbody>
				<?php foreach ($devices as $key => $dev): ?>
					<tr>
						<td><?php echo $dev->tag; ?></td>
						<td>
							<?php
							echo '<span class="glyphicon glyphicon-';
							switch ($dev->type) {
							case 'dni':
								echo 'user" title="DNI"';
								break;
							case 'mobile':
								echo 'phone" title="Móvil"';
								break;
							case 'card':
								echo 'credit-card" title="Tarjeta"';
								break;
							case 'tag':
								echo 'tag" title="Tag"';
								break;
							case 'unknown':
								echo 'asterisk" title="Otro"';
								break;
							
							default:
								# code...
								break;
							}
							echo '></span>';
							?>
						</td>
						<td><a href="#"><?php echo $dev->name; ?></a></td>
						<td>
							<button type="button" data-toggle="modal" data-target="#dialog-edit-device" data-device-id="<?php echo $dev->id; ?>" data-type="<?php echo $dev->type; ?>" data-description="<?php echo $dev->description; ?>" data-user="<?php echo $dev->userId; ?>" data-tag="<?php echo $dev->tag; ?>" class="btn btn-warning btn-xs">
								<span class="glyphicon glyphicon-pencil"></span>
							</button> 
							<button type="button" data-toggle="modal" data-target="#dialog-confirm-remove" data-target-id="<?php echo $dev->id; ?>" data-target-name="<?php echo $dev->tag; ?>" class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-remove"></span>
							</button>
						</td>
						<td><?php echo $dev->description; ?></td>
				</tr>
				<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>

<button type="button" data-toggle="modal" data-target="#dialog-add-device" class="btn btn-info btn-sm">
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
					<p>¿Confirma la eliminación del dispositivo <strong class="remove-name"></strong>?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
				<input type="hidden" id="remove-id" name="device-remove-id" value="">
				<input type="hidden" name="form-type" value="device-remove">

			</form>
		</div>
	</div>
</div>

<!-- Dialogo editar -->
<div id="dialog-edit-device" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-edit-device" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="label-edit-device">Editar dispositivo</h4>
			</div>
			<form method="POST">
			<div class="modal-body">
				<div class="form-group">
					<label for="device-edit-type">Tipo</label>

					<div class="radio">
						<label>
						<input type="radio" name="device-edit-type" id="device-edit-type" value="dni">
						DNI
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-edit-type" id="device-edit-type" value="mobile">
						Móvil
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-edit-type" id="device-edit-type" value="tag">
						Tag
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-edit-type" id="device-edit-type" value="card">
						Tarjeta
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-edit-type" id="device-edit-type" value="unknown">
						Otro
						</label>
					</div>
						
				</div>

				<!-- Tag id -->
				<div class="form-group">
					<label for="device-edit-tag">Tag ID</label>
					<input type="text" id="device-edit-tag" name="device-edit-tag" class="form-control" value="">
				</div>

				<!-- Usuario -->
				<div class="form-group">
					<label for="device-edit-user">Usuario</label>
					<select class="selector form-control" data-placeholder="Seleccionar usuario" id="device-edit-user" name="device-edit-user">
						<?php foreach ($users as $key => $user): ?>
							<option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Descripcion -->
				<div class="form-group">
					<label for="device-edit-description">Descripción</label>
					<textarea id="device-edit-description" name="device-edit-description" class="form-control" rows="3"></textarea>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
				<button type="submit" class="btn btn-primary">Editar</button>
			</div>
			<input type="hidden" id="device-edit-id" name="device-edit-id" value="">
			<input type="hidden" name="form-type" value="device-edit">

			</form>
		</div>
	</div>
</div>


<!-- Dialogo Añadir dispositivo --> 
<div id="dialog-add-device" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label-add-device" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="label-add-device">Añadir dispositivo</h4>
			</div>
			<form method="POST">
			<div class="modal-body">
				<div class="form-group">
					<label for="device-add-type">Tipo</label>

					<div class="radio">
						<label>
						<input type="radio" name="device-add-type" id="device-add-type" value="dni" checked>
						DNI
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-add-type" id="device-add-type" value="mobile">
						Móvil
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-add-type" id="device-add-type" value="tag">
						Tag
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-add-type" id="device-add-type" value="card">
						Tarjeta
						</label>
					</div>

					<div class="radio">
						<label>
						<input type="radio" name="device-add-type" id="device-add-type" value="unknown">
						Otro
						</label>
					</div>
						
				</div>

				<!-- Tag id -->
				<div class="form-group">
					<label for="device-add-tag">Tag ID</label>
					<input type="text" name="device-add-tag" class="form-control" placeholder="0102030405" required>
				</div>

				<!-- Usuario -->
				<div class="form-group">
					<label for="device-add-user">Usuario</label>
					<select class="selector form-control" data-placeholder="Seleccionar usuario" id="device-add-user" name="device-add-user">
						<?php foreach ($users as $key => $user): ?>
							<option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Descripcion -->
				<div class="form-group">
					<label for="device-add-description">Descripción</label>
					<textarea name="device-add-description" class="form-control" rows="3"></textarea>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Volver</button>
				<button type="submit" class="btn btn-primary">Añadir</button>
			</div>
			<input type="hidden" name="form-type" value="device-add">

			</form>
		</div>
	</div>
</div>