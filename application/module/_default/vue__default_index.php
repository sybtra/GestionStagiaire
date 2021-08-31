<h1>Fil de mes abonnements</h1>    
<?php
foreach ($result as $row) {
    Ctr_message::afficheMessage($row);
}
?>