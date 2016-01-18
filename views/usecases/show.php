<h2>USE CASE (<?php echo $uc->getCode(); ?>)</h2>
<div class="addstuff">
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=usecases&action=alter&code=<?php echo $uc->getCode();?>">&#9998;</a>
    </div>
</div>
<table class="table uc">
    <tr>
        <th>Code:</th><td><?php echo $uc->getCode();?></td>
    </tr>
    <tr>
        <th>Title:</th><td><?php echo $uc->getTitle();?></td>
    </tr>
    <tr>
        <th>Description:</th><td><?php echo $uc->getDescription();?></td>
    </tr>
    <tr>
        <th>Actor:</th><td><?php echo $uc->getActor();?></td>
    </tr>
    <tr>
        <th>Parent:</th><td><?php echo $uc->getParent();?></td>
    </tr>
    <tr>
        <th>Precondition:</th><td><?php echo $uc->getPre();?></td>
    </tr>
    <tr>
        <th>Postcondition:</th><td><?php echo $uc->getPost();?></td>
    </tr>
    <tr>
        <th>UML:</th><td><img src="<?php echo "uploads/uml/" . $uc->getImagePath();?>" alt=""></td>
    </tr>
</table>
<h4>Event flow:</h4>
<table class="table">
<?php foreach($children as $child) { ?>
	<tr>
	<td><a href="?controller=usecases&action=show&code=<?php echo $child->getCode(); ?>"><?php echo $child->getCode(); ?></td>
	</tr>
<?php } ?>
</table>
