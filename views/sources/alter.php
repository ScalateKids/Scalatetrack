<form class='loginform' action='?controller=sources&action=save_edit&name=<?php echo $source->getName(); ?>' method='post' enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $source->getName();?>">
        <input type="submit" value="submit">
    </fieldset>
</form>
