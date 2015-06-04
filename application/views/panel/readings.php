<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2>Registros</h2>

<?php if (isset($error)): ?>
	<div class="alert alert-danger" data-dismiss="alert" role="alert"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (isset($info)): ?>
	<div class="alert alert-info" data-dismiss="alert" role="alert"><?php echo $info; ?></div>
<?php endif; ?>

<?php if ($readingsCount == 0): ?>
	<div class="alert alert-warning" role="alert">No existen lecturas de dispositivos registradas en la base de datos.</div>
<?php else: ?>

	<input type="serach" class="form-control" placeholder="Buscar..." id="busqueda" />
	<table class="table table-hover table-responsive">
	<thead>
		<tr>
			<th>Hora</th>
			<th>Dispositivo</th>
			<th>Usuario</th>
			<th>Profesor</th>
		</tr>
	</thead>
		<tbody>
				<?php foreach ($readings as $key => $read): ?>
					<tr>
						<td><?php echo $read->date; ?></td>
						<td><a href="dispositivos?tag=<?php echo $read->tag; ?>"><?php echo $read->tag; ?></a></td>
						<td><a href="usuarios?id=<?php echo $read->student_id; ?>"><?php echo $read->student; ?></a></td>
						<td><a href="usuarios?id=<?php echo $read->teacher_id; ?>"><?php echo $read->teacher; ?></a></td>
				</tr>
				<?php endforeach; ?>
		</tbody>
	</table>

<?php endif; ?>