<form method="post" action="<?= hlien("stagiaire", "edit") ?>">
    <input type="hidden" name="sta_id" id="sta_id" value="<?= $id ?>" />
    <div class='form-group'>
        <label for='sta_nom'>nom</label>
        <input id='sta_nom' name='sta_nom' type='text' size='50' value='<?= mhe($sta_nom) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='sta_prenom'>prenom</label>
        <input id='sta_prenom' name='sta_prenom' type='text' size='50' value='<?= mhe($sta_prenom) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='sta_adresse'>adresse</label>
        <input id='sta_adresse' name='sta_adresse' type='text' size='50' value='<?= mhe($sta_adresse) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='sta_ville'>ville</label>
        <input id='sta_ville' name='sta_ville' type='text' size='50' value='<?= mhe($sta_ville) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='sta_code'>code postal</label>
        <input id='sta_code' name='sta_code' type='text' size='50' value='<?= mhe($sta_code) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='sta_promotion'>promotion</label>
        <select name="sta_promotion" id="sta_promotion">
            <option>prepa</option>
            <option>tertiaire</option>
            <option>IFMK</option>
        </select>
    </div>
    <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>