<div class="col-xs-12 div-users mt40">
    <table class="col-xs-12">
        <tr class="col-xs-12">
            <th class="col-xs-3">
                Pseudo
            </th>
            <th class="col-xs-3">
                Nom
            </th>
            <th class="col-xs-3">
                Prénom
            </th>
            <th class="col-xs-3">
                Radié(e)
            </th>
        </tr>
        <form method="post" action="<?php echo $app->urlFor('edit_users') ?>">
            <?php foreach($users as $user): ?>
                <tr class="col-xs-12">
                    <td class="col-xs-3">
                        <?php echo $user['pseudo'] ?>
                    </td>
                    <td class="col-xs-3">
                        <?php echo $user['nom'] ?>
                    </td>
                    <td class="col-xs-3">
                        <?php echo $user['prenom'] ?>
                    </td>
                    <td class="col-xs-3">

                        <input type="radio" name="user-premium-<?php echo $user['id'] ?>" value="0"
                            <?php if($user['premium'] == 0): ?> checked=checked" <?php endif; ?>>
                        Non
                        </input>
                        <input type="radio" name="user-premium-<?php echo $user['id'] ?>"
                            <?php if($user['premium'] == 1): ?> checked=checked" <?php endif; ?>value="1">
                        Oui
                        </input>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="col-xs-12">
                <td colspan="4" class="col-xs-12 t-center">
                    <input type="submit" value="Modifier"/>
                </td>
            </tr>
        </form>
    </table>
</div>