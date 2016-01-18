<h3>Modify existing requirement to the platform</h3>
<form class="loginform" method="post" action="?controller=requirements&action=save_edit&code=<?php echo $requirement->getCode(); ?>" enctype="multipart/form-data">
    <fieldset>
        <label for="code">Code</label>
        <input type="text" id="code" placeholder="es: RF1.1" name="code" value="<?php echo $requirement->getCode(); ?>">
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="F" <?php echo ($requirement->getType() == 'F' ? "selected" : "");?>>Functional</option>
            <option value="Q" <?php echo ($requirement->getType() == 'Q' ? "selected" : "");?>>Qualitative</option>
            <option value="T" <?php echo ($requirement->getType() == 'T' ? "selected" : "");?>>Technologic</option>
            <option value="V" <?php echo ($requirement->getType() == 'V' ? "selected" : "");?>>Bond</option>
        </select>
        <label for="priority">Priority</label>
        <select name="priority" id="priority">
            <option value="Obbligatorio" <?php echo ($requirement->getPriority() == 'Obbligatorio' ? "selected" : "");?>>Mandatory</option>
            <option value="Desiderabile" <?php echo ($requirement->getPriority() == 'Desiderabile' ? "selected" : "");?>>Desirable</option>
            <option value="Opzionale" <?php echo ($requirement->getPriority() == 'Opzionale' ? "selected" : "");?>>Optional</option>
        </select>
        <label for="description">Description</label>
        <textarea rows=3 id="description" name="description"><?php echo $requirement->getDescription(); ?></textarea>
        <label>Sources</label>
        <fieldset class="list">
                <?php foreach($sources as $source) {?>
                    <input type="checkbox" name="sources[]" class="list" value="<?php echo $source->getName();?>" <?php foreach($requirement->getSources() as $src) { echo ($src->getName() == $source->getName() ? "checked" : ""); }?>><?php echo $source->getName(); ?><br>
                <?php }?>
        </fieldset>
        <br>
        <input type="checkbox" name="satisfied" value="Si" id="satisfied" <?php echo ($requirement->getSatisfied() == 'Si' ? "checked" : ""); ?>> Satisfied
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
