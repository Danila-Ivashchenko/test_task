<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css?t=<?php echo(microtime(true).rand())?>">
	<title>Document</title>
</head>
<body>
	<div class="wrapper">
		<div class="inner">
	<?php

		require_once "./internal/database.php";

		if (isset($_GET["mess"])){
			$mess = $_GET["mess"];
			echo "<script>alert('$mess');</script>";
		}

		$conn = get_db();

		$sql = "SELECT * FROM PROTOCOL_TABLE";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$conn = null;
		echo "<table>
			<tr>
				<th>Номер протокола</th>
				<th>Дата выдачи (дд.мм.гг)</th>
				<th>Ответственный (ФИО)</th>
				<th>Соответствие («да», «нет»)</th>
			</tr>";

		foreach ($result as $row) {
			$protocol_number = $row['protocol_number'];
			$issue_date = $row['issue_date'];
			$responsible_employee = $row['responsible_employee'];
			$compliance_flag = $row['compliance_flag'] == 1 ? 'да' : 'нет';
			echo "<tr>
					<td>$protocol_number</td>
					<td>$issue_date</td>
					<td>$responsible_employee</td>
					<td>$compliance_flag</td>
				</tr>";
		}
		echo "</table>";

	?>

	<form action="./internal/add_row.php" method="POST">

	<div class="line">
		<label>Номер протокола:</label>
		<input type="text" name="protocol_number" required>
	</div>
	
	<div class="line">
		<label>Дата выдачи:</label>
		<input type="date" name="issue_date" required>
	</div>

	<div class="line">
		<label>Ответственный:</label>
		<input type="text" name="responsible_employee" required>
	</div>

	<div class="line">
	<label>Соответствие:</label>
		<div class="line_section">
			<input type="radio" name="compliance_flag" value="да" selected>Да
		</div>
		<div class="line_section">
			<input type="radio" name="compliance_flag" value="нет">Нет
		</div>
	</div>

	<div class="line">
		<input type="submit" value="Сохранить">
	</div>
	</form>
	</div>
	</div>
</body>
</html>
