<h3>Modify existing component to the platform</h3>
<form class="loginform" method="post" action="?controller=components&action=save_edit&code=<?php echo $component->getName(); ?>" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Code</label>
        <input type="text" id="name" placeholder="es: a::b::c::d" name="name" value="<?php echo $component->getName(); ?>">
        <label>Requirements</label>
        <fieldset class="list">
                <?php foreach($requirements as $requirement) {?>
                    <input type="checkbox" name="requirements[]" class="list" value="<?php echo $requirement->getCode();?>" <?php foreach($component->getRequirements() as $src) { echo ($src->getCode() == $requirement->getCode() ? "checked" : ""); }?>><?php echo $requirement->getCode(); ?><br>
                <?php }?>
        </fieldset>
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
