<?php if (!($_SESSION["user"] ?? null)) : ?>
    <p>You need to login to see protected information.</p>
    <?php return; ?>
<?php endif; ?>


<table>
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Publicerad</th>
        <th>Skapad</th>
        <th>Updaterad</th>
        <th>Borttagen</th>
        <th>Redigera</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <a class="icons" href="edit?id=<?= $row->id ?>" title="Redigera innehåll">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>

<form method="post">
<button type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Skapa nytt</button>
</form>
