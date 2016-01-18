<h2>REQUIREMENTS LIST (<?php echo count($requirements); ?>)</h2>
<div class="addstuff">
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=requirements&action=add">&#10010;</a>
    </div>
</div>
<table class="table">
<thead>
	<tr>
		<th>Code</th>
		<th>Priority</th>
		<th>Type</th>
		<th>Satisfied</th>
        <th>Sources</th>
		<th>Description</th>
        <th></th>
        <th></th>
	</tr>
</thead>
<tbody>
	<?php foreach ($requirements as $requirement) { ?>
		<tr>
			<td><?php echo $requirement->getCode(); ?></td>
			<td><?php echo $requirement->getPriority(); ?></td>
			<td><?php echo $requirement->getType(); ?></td>
			<td><?php echo $requirement->getSatisfied(); ?></td>
            <td><?php foreach($requirement->getSources() as $src) { echo $src->getName()."\n";}?></td>
			<td><?php echo $requirement->getDescription(); ?></td>
            <td><a href="?controller=requirements&action=alter&code=<?php echo $requirement->getCode(); ?>">&#9998;</a></td>
            <td><a href="?controller=requirements&action=remove&code=<?php echo $requirement->getCode(); ?>">&#10008;</a></td>
        </tr>
	<?php } ?>
</tbody>
</table>
