<h2>USE CASES (<?php echo count($usecases); ?>)</h2>
<div class="addstuff">
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=usecases&action=add">&#10010;</a>
    </div>
</div>
<table class="table">
    <thead>
        <th>Code</th>
        <th>Title</th>
        <th>Description</th>
        <th>Actor</th>
        <th>Parent</th>
        <th>Precondition</th>
        <th>Postcondition</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
    <?php foreach($usecases as $uc) { ?>
        <tr>
            <td><a href="?controller=usecases&action=show&code=<?php echo $uc->getCode(); ?>"><?php echo $uc->getCode();?></a></td>
            <td><?php echo $uc->getTitle();?></td>
            <td><?php echo $uc->getDescription();?></td>
            <td><?php echo $uc->getActor();?></td>
            <td><?php echo $uc->getParent();?></td>
            <td><?php echo $uc->getPre();?></td>
            <td><?php echo $uc->getPost();?></td>
            <td><a href="?controller=usecases&action=alter&code=<?php echo $uc->getCode(); ?>">&#9998;</a></td>
            <td><a href="?controller=usecases&action=remove&code=<?php echo $uc->getCode(); ?>">&#10008;</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
