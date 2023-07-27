
<?php include_once __DIR__."/../layouts/header.php" ?>

<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>UserName</th>
        <th>PassWord</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $index =>$user ):
        echo "<tr>
        <td> $user[id] </td>
        <td>$user[username]</td>
        <td>$user[password]</td>
            </tr>";
         endforeach;  ?>
    </tbody>
    <?php include_once __DIR__."/../layouts/footer.php" ?>
