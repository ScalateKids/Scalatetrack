<h3>Add new requirement to the platform</h3>
<form class="loginform" method="post" action="?controller=requirements&action=save" enctype="multipart/form-data">
    <fieldset>
        <label for="code">Code</label>
        <input type="text" id="code" placeholder="es: RF1.1" name="code">
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="F">Functional</option>
            <option value="Q">Qualitative</option>
            <option value="T">Technologic</option>
            <option value="V">Bond</option>
        </select>
        <label for="priority">Priority</label>
        <select name="priority" id="priority">
            <option value="Obbligatorio">Mandatory</option>
            <option value="Desiderabile">Desirable</option>
            <option value="Opzionale">Optional</option>
        </select>
        <label for="description">Description</label>
        <textarea rows=3 id="description" name="description"></textarea>
        <label>Sources</label>
        <fieldset class="list">
                <?php foreach($sources as $source) {?>
                    <input type="checkbox" class="list" value="<?php echo $source->getName();?>" name="sources[]"><?php echo $source->getName(); ?><br>
                <?php }?>
        </fieldset>
        <br>
        <input type="checkbox" name="satisfied" value="Si" id="satisfied"> Satisfied
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
