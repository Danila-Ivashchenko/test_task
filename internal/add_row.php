<?php
	require_once "./database.php";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$protocol_number = $_POST['protocol_number'];
		$issue_date = $_POST['issue_date'];
		$responsible_employee = $_POST['responsible_employee'];
		$compliance_flag = $_POST['compliance_flag'] == "да" ? 1 : 0;

		$conn = get_db();

		$sql = "SELECT 1 FROM PROTOCOL_TABLE WHERE protocol_number = '{$protocol_number}'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		if (count($result) > 0) {
			echo "<script>alert('Протокол с таким номером уже существует');</script>";
			$conn = null;
			header("Location: ../protocol.php?mess=Протокол с таким номером уже существует");
			exit();
		} else {
			$stmt = $conn->prepare('INSERT INTO PROTOCOL_TABLE (protocol_number, issue_date, responsible_employee, compliance_flag) VALUES (:protocol_number, :issue_date, :responsible_employee, :compliance_flag)');

			$stmt->bindParam(':protocol_number', $protocol_number);
			$stmt->bindParam(':issue_date', $issue_date);
			$stmt->bindParam(':responsible_employee', $responsible_employee);
			$stmt->bindParam(':compliance_flag', $compliance_flag);

			$stmt->execute();
			$conn = null;
			header("Location: ../protocol.php");
			exit();
		}

	}
?>