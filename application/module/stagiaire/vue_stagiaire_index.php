    <h2>stagiaire</h2>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Nom</th>
    			<th>Prénom</th>
    			<th>adresse</th>
    			<th>ville</th>
    			<th>code</th>
    			<th>Promotion</th>
    			<!--
    			<th>modifier</th>
    			<th>supprimer</th>
-->
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($result as $row) {
				extract($row); ?>
    			<tr>

    				<td><?= mhe($row['sta_id']) ?></td>
    				<td><?= mhe($row['sta_nom']) ?></td>
    				<td><?= mhe($row['sta_prenom']) ?></td>
    				<td><?= mhe($row['sta_adresse']) ?></td>
    				<td><?= mhe($row['sta_ville']) ?></td>
    				<td><?= mhe($row['sta_code']) ?></td>
    				<td><?= mhe($row['sta_promotion']) ?></td>
    				<!--    				<td><a class="btn btn-warning" href="<?= hlien("staeur", "edit", "id", $row["sta_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("staeur", "del", "id", $row["sta_id"]) ?>">Supprimer</a></td>-->
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>