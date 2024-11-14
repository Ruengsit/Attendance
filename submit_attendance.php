<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employee_id = $_POST['employee_id'];
$full_name = $_POST['full_name'];
$work_type = $_POST['work_type'];
$other_work_type = isset($_POST['other_work_type']) ? $_POST['other_work_type'] : null; // ตรวจสอบว่ามีค่าอื่นๆ หรือไม่
$work_location = $_POST['work_location'];
$travel_date = $_POST['travel_date'];
$departure_time = $_POST['departure_time'];
$start_travel_from = $_POST['start_travel_from'];
$destination = $_POST['destination'];
$start_work_time = $_POST['start_work_time'];
$end_work_time = $_POST['end_work_time'];

// จัดการอัปโหลดไฟล์ภาพ
$work_image = null;
if (!empty($_FILES['work_image']['name'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
    }
    $work_image = $target_dir . basename($_FILES["work_image"]["name"]);
    if (!move_uploaded_file($_FILES["work_image"]["tmp_name"], $work_image)) {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
}

// เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
$stmt = $conn->prepare("INSERT INTO attendance (employee_id, full_name, work_type, other_work_type, work_location, travel_date, departure_time, start_travel_from, destination, start_work_time, end_work_time, work_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $employee_id, $full_name, $work_type, $other_work_type, $work_location, $travel_date, $departure_time, $start_travel_from, $destination, $start_work_time, $end_work_time, $work_image);

if ($stmt->execute()) {
    echo "<script>
    alert('New record created successfully');
    window.location.href = 'attendance_form.php';
</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
