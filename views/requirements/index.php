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
			<?php if (filter_var($requirement->getCode(), FILTER_VALIDATE_INT)) { ?>
				<td class='highlight'><?php echo $requirement->getCode(); ?></td>
				<td class='highlight'><?php echo $requirement->getPriority(); ?></td>
				<td class='highlight'><?php echo $requirement->getType(); ?></td>
				<td class='highlight'><?php echo $requirement->getSatisfied(); ?></td>
			    <td class='highlight'><?php foreach($requirement->getSources() as $src) { echo $src->getName()."\n";}?></td>
				<td class='highlight'><?php echo $requirement->getDescription(); ?></td>
			    <td class='highlight'><a href="?controller=requirements&action=alter&code=<?php
			$code = '';
			if ($requirement->getPriority() == 'Obbligatorio') {
				$code = 'OB';
			}
			elseif ( $requirement->getPriority() == 'Desiderabile' ) {
				$code = 'DE';
			}
			else {
				$code = 'OP';
			}
			$code .= $requirement->getType() . $requirement->getCode();
			echo $code; ?>">&#9998;</a></td>
		    <td class='highlight'><a href="?controller=requirements&action=remove&code=<?php echo $code; ?>">&#10008;</a></td>

			<?php } else { ?>
			<td><?php echo $requirement->getCode(); ?></td>
			<td><?php echo $requirement->getPriority(); ?></td>
			<td><?php echo $requirement->getType(); ?></td>
			<td><?php echo $requirement->getSatisfied(); ?></td>
            <td><?php foreach($requirement->getSources() as $src) { echo $src->getName()."\n";}?></td>
			<td><?php echo $requirement->getDescription(); ?></td>
            <td><a href="?controller=requirements&action=alter&code=<?php
		$code = '';
		if ($requirement->getPriority() == 'Obbligatorio') {
			$code = 'OB';
		}
		elseif ( $requirement->getPriority() == 'Desiderabile' ) {
			$code = 'DE';
		}
		else {
			$code = 'OP';
		}
		$code .= $requirement->getType() . $requirement->getCode();
		echo $code; ?>">&#9998;</a></td>
            <td><a href="?controller=requirements&action=remove&code=<?php echo $code; ?>">&#10008;</a></td>
			<?php } ?>
        </tr>
	<?php } ?>
</tbody>
</table>

