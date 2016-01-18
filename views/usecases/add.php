<h3>Add new use case to the platform</h3>
<form class="loginform" method="post" action="?controller=usecases&action=save" enctype="multipart/form-data">
    <fieldset>
        <label for="code">Code</label>
        <input type="text" name="code" id="code" placeholder="es: RF1.1">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="es: RF1.1">
        <label for="actor">Actor</label>
        <select name="actor" id="actor">
            <option value="Utente">User</option>
            <option value="Terminale">Terminal</option>
            <option value="Driver">Driver</option>
        </select>
        <label for="parent">Parent</label>
        <select name="parent" id="parent">
            <option value="null">Nessuno</option>
            <?php foreach($usecases as $uc) {?>
                <option value="<?php echo $uc->getCode();?>"><?php echo $uc->getCode()." - ".$uc->getTitle();?></option>
            <?php }?>
        </select>
        <label for="description">Description</label>
        <textarea rows=3 id="description" name="description"></textarea>
        <br>
        <label for="precondition">Precondition</label>
        <input type="text" id="precondition" name="precondition" placeholder="precondition">
        <label for="postcondition">Postcondition</label>
        <input type="text" id="postcondition" name="postcondition" placeholder="postcondition">
        <label for="image">Use case UML</label>
        <input type="file" name="image" id="image">
        <br>
        <input type="submit" value="submit">
    </fieldset>
</form>
