<h3>Add new component to the platform</h3>
<form class="loginform" method="post" action="?controller=components&action=save" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Code</label>
        <input type="text" id="name" placeholder="es: a::b::c::d" name="name">
        <label>Requirements</label>
        <fieldset class="list">
                <?php foreach($requirements as $requirement) {?>
                    <input type="checkbox" class="list" value="<?php echo $requirement->getCode();?>" name="requirements[]"><?php echo $requirement->getCode(); ?><br>
                <?php }?>
        </fieldset>
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
