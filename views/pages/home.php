<?php
echo '<h3>Hello there</h3>';
?>
<div class="addstuff">
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=pages&action=download_tex">&#8681;</a>
    </div>
    <div class="addstuff-circle">
        <a class="addstuff" href="?controller=pages&action=download_ctex">&#8681;</a>
    </div>
</div>
<table class="table floated" style="width:20%;">
    <caption>Requirements</caption>
	<thead>
	<tr>
		<th>Requirement</th>
        <th>Sources</th>
	</tr>
    </thead>
	<tbody>
        <?php foreach($rs as $key => $val) {?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><?php foreach($val as $v) { echo $v."<br>";} ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<table class="table floated" style="width:20%;">
    <caption>Sources</caption>
	<thead>
	<tr>
		<th>Source</th>
        <th>Requirements</th>
	</tr>
    </thead>
	<tbody>
        <?php foreach($sr as $key => $val) {?>
            <tr>
                <td><?php echo $key; ?></td>
                <td><?php foreach($val as $v) { echo $v."<br>";} ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
