<?php

$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "kart_race";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = getResultsQuery();

    $result = $conn->query($sql);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}

function getResultsQuery()
{
    return "
    SELECT
        @row_num := @row_num + 1 AS position,
        pilot_code,
        pilot_name,
        laps_completed,
        total_time,
        total_time_millis
    FROM
    (
        SELECT
            pilot_code,
            pilot_name,
            COUNT(lap_number) AS laps_completed,
            SUM(lap_time) AS total_time,
            SUM(lap_time) * 1000 AS total_time_millis
        FROM
            race_results
        GROUP BY
            pilot_code, pilot_name
        HAVING
            laps_completed >= 4
    ) AS subquery,
    (SELECT @row_num := 0) AS r
    ORDER BY
        total_time ASC;";
}

function formatTime($totalTimeMillis)
{
    $totalTimeMillis = (int)$totalTimeMillis;

    $totalTimeSeconds = floor($totalTimeMillis / 1000);
    $hours = floor($totalTimeSeconds / 3600);
    $minutes = floor(($totalTimeSeconds % 3600) / 60);
    $seconds = $totalTimeSeconds % 60;
    $formattedMillis = sprintf("%03d", $totalTimeMillis % 1000);
    return sprintf("%02d:%02d:%02d.%s", $hours, $minutes, $seconds, $formattedMillis);
}

function getResultRow($row, $formattedTime)
{
    return "<tr>
            <td>" . htmlspecialchars($row["position"]) . "</td>
            <td>" . htmlspecialchars($row["pilot_code"]) . "</td>
            <td>" . htmlspecialchars($row["pilot_name"]) . "</td>
            <td>" . htmlspecialchars($row["laps_completed"]) . "</td>
            <td>" . htmlspecialchars($formattedTime) . "</td>
          </tr>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="https://fav.farm/🚗" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Corrida de Kart</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: .91rem;
        }

        table {
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 90%;
            max-width: 50rem;
        }

        th,
        td {
            padding: 12px 20px;
            text-align: center;
        }

        th {
            background-color: #4E54C8;
            color: white;
            font-weight: bold;
            text-align: center;
            font-style: italic;
            text-transform: uppercase;
            font-size: .97rem;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Posição Chegada</th>
            <th>Código Piloto</th>
            <th>Nome Piloto</th>
            <th>Voltas Completadas</th>
            <th>Tempo Total de Prova</th>
        </tr>

        <?php
        // Exibir os dados
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $totalTimeMillis = isset($row["total_time_millis"]) ? $row["total_time_millis"] : 0;
                $formattedTime = formatTime($totalTimeMillis);
                echo getResultRow($row, $formattedTime);
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum resultado encontrado</td></tr>";
        }

        $conn = null; // Fecha a conexão
        ?>
    </table>
</body>

</html>