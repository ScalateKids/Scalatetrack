<h2>REQUIREMENTS LIST (<?php echo count($requirements); ?>)</h2>
<div class="addstuff">
     <div class="addstuff-circle">
     <a class="addstuff" href="?controller=components&action=add">&#10010;</a>
     </div>
     </div>
     <table class="table">
     <thead>
     <tr>
     <th>Component</th>
     <th>Requirements</th>
     <th></th>
     <th></th>
     </tr>
     </thead>
     <tbody>
	<?php foreach ($components as $component) { ?>
		<tr>
          <td class='highlight'><?php echo $component->getName(); ?></td>
		  <td class='highlight'><?php foreach($component->getRequirements() as $src) { echo $src->getCode()."\n";}?></td>
		  <td class='highlight'><a href="?controller=components&action=alter&code=<?php echo $component->getName(); ?>">&#9998;</a></td>
		  <td class='highlight'><a href="?controller=components&action=remove&code=<?php echo $component->getName(); ?>">&#10008;</a></td>
        </tr>
	<?php } ?>
</tbody>
</table>
