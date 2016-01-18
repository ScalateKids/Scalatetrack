<h3>Update existing use case to the platform</h3>
<form class="loginform" method="post" action="?controller=usecases&action=save_edit&code=<?php echo $uc->getCode(); ?>" enctype="multipart/form-data">
    <fieldset>
        <label for="code">Code</label>
        <input type="text" name="code" id="code" placeholder="es: RF1.1" value="<?php echo $uc->getCode();?>">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="es: RF1.1" value="<?php echo $uc->getTitle();?>">
        <label for="actor">Actor</label>
        <select name="actor" id="actor">
            <option value="Utente" <?php echo ($uc->getActor() == 'Utente' ? "selected" : "");?>>User</option>
            <option value="Terminale" <?php echo ($uc->getActor() == 'Terminale' ? "selected" : "");?>>Terminal</option>
            <option value="Driver" <?php echo ($uc->getActor() == 'Driver' ? "selected" : "");?>>Driver</option>
        </select>
        <label for="parent">Parent</label>
        <select name="parent" id="parent">
            <option value="null">Nessuno</option>
            <?php foreach($usecases as $ucs) {?>
                <option value="<?php echo $ucs->getCode();?>" <?php echo ($uc->getParent() == $ucs->getParent() ? "selected" : "");?>><?php echo $ucs->getCode()." - ".$ucs->getTitle();?></option>
            <?php }?>
        </select>
        <label for="description">Description</label>
        <textarea rows=3 id="description" name="description"><?php echo $uc->getDescription(); ?></textarea>
        <br>
        <label for="precondition">Precondition</label>
        <input type="text" id="precondition" name="precondition" placeholder="precondition"  value="<?php echo $uc->getPre();?>">
        <label for="postcondition">Postcondition</label>
        <input type="text" id="postcondition" name="postcondition" placeholder="postcondition"  value="<?php echo $uc->getPost();?>">
        <label for="image">Use case UML</label>
        <input type="file" name="image" id="image">
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
