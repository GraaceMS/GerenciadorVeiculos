<?php

$host = "localhost";
$dbname = "gerenciador_veiculos";
$user = "root";
$password = "";


$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$results_per_page = 10;


$count_query = "SELECT COUNT(*) AS total FROM veiculos";
$count_stmt = $pdo->query($count_query);
$count_result = $count_stmt->fetch(PDO::FETCH_ASSOC);
$total_results = $count_result['total'];


$total_pages = ceil($total_results / $results_per_page);


if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}


$index_start = ($page - 1) * $results_per_page;
$index_end = $index_start + $results_per_page;


$query = "SELECT * FROM veiculos ORDER BY id DESC LIMIT $index_start, $results_per_page";
$stmt = $pdo->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
} else {
    $search_term = "";
}


?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    <label for="search">Buscar:</label>
    <input type="text" id="search" name="search" value="<?php echo $search_term; ?>">
    <button type="submit">Buscar</button>
</form>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Ano</th>
            <th>Placa</th>
            <th>Cor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['modelo']; ?></td>
                <td><?php echo $result['marca']; ?></td>
                <td><?php echo $result['ano']; ?></td>
                <td><?php echo $result['placa']; ?></td>
                <td><?php echo $result['cor']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div>
    <?php if ($total_pages > 1): ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?php echo $i; ?></strong>
            <?php else: ?>
                <a href="<?php echo $_SERVER['PHP_SELF'] . "?page=$i&search=$search
