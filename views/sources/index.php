<h2>SOURCES (<?php echo count($sources); ?>)</h2>
<div class="addstuff">
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=sources&action=add">&#10010;</a>
    </div>
</div>
<table class="table sources">
<thead>
	<tr>
		<th>Name</th>
        <th></th>
        <th></th>
	</tr>
</thead>
<tbody>
	<?php foreach($sources as $source) { ?>
		<tr>
			<td><?php echo $source->getName();?></td>
            <td><a href="?controller=sources&action=alter&name=<?php echo $source->getName(); ?>">&#9998;</a></td>
            <td><a href="?controller=sources&action=remove&name=<?php echo $source->getName(); ?>">&#10008;</a></td>
		</tr>
	<?php }?>
</tbody>
</table>
