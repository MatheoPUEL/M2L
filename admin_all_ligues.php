<?php
// Variable globale a la page
$title = "Index";
$description = "Ma description";
?>

<?php
require_once('./inc/header.inc.php')
?>

<style>
    table {

        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #405cf5;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr {
        background-color: #c5c5c5;
    }
    .actions {
        display: flex;
    }


    button {
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 6px;

        color: #FFFFFF;

        transition-duration: 0.3s;
    }
    button:hover {
        cursor: pointer;
        opacity: 80%;
    }
    button .red {
        background-color: red;
    }
    button .blue {
        background-color: #405cf5;
    }

</style>
<div class="container" style="width: 80%; position: relative; left: 50%; transform: translateX(-50%)">
    <table>
        <tr>
            <th>Utlisateur</th>
            <th>Ligue</th>

            <th>Message</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>Jhon doe</td>
            <td>Football</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aut corporis cum dolorem enim expedita harum iste labore mollitia natus nihil nobis, obcaecati odit praesentium qui quis voluptas voluptate.</td>
            <td class="actions">
                <button class="red"><i class="fa-solid fa-trash"></i></button>
                <button class="blue"><i class="fa-solid fa-reply"></i></button>
            </td>
        </tr>
        <tr>
            <td>Jhon doe</td>
            <td>Takewondo</td>
            <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aut corporis cum dolorem enim expedita harum iste labore mollitia natus nihil nobis, obcaecati odit praesentium qui quis voluptas voluptate.</td>
            <td class="actions">
                <button class="red"><i class="fa-solid fa-trash"></i></button>
                <button class="blue"><i class="fa-solid fa-reply"></i></button>
            </td>
        </tr>

    </table>

    <h1>Liste des ligues</h1>
    <ul>
        <li><a href="./ligues.php">Takewondo</a></li>
        <li><a href="./ligues.php">Football</a></li>
        <li><a href="./ligues.php">Handball</a></li>
        <li><a href="./ligues.php">Autre</a></li>
    </ul>

</div>



<?php
require_once('./inc/footer.inc.php')
?>
