<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onsite Work Attendance Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 10px;
        }

        h1, h3 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            padding: 20px;
            margin: 10px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            flex: 1 1 45%;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .other-work-type {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-group {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <form action="submit_attendance.php" method="POST" enctype="multipart/form-data">
        <h1>ใบลงเวลานอกสถานที่</h1>
        <h3>
        คำชี้แจง<br>
        - ฟอร์มนี้ใช้เฉพาะพนักงานที่ไปปฏิบัติงานนอกสถานที่ (ปฏิบัติงาน, อบรม, สัมมนา, ดูงาน)<br>
        - ฟอร์มนี้ไม่ใช่ใบขออนุมัติการทำงานล่วงเวลา เป็นแค่ฟอร์มลงเวลาทำงานเท่านั้น
        </h3>

        <div class="form-row">
            <div class="form-group">
                <label for="employee_id">รหัสพนักงาน:</label>
                <input type="text" id="employee_id" name="employee_id" required>
            </div>
            <div class="form-group">
                <label for="full_name">ชื่อ - นามสกุล:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="work_type">รูปแบบการปฎิบัติงาน:</label>
                <select id="work_type" name="work_type" onchange="toggleOtherInput()" required>
                    <option value="On Site">On Site</option>
                    <option value="Work From Home">Work From Home</option>
                    <option value="Training">อบรม</option>
                    <option value="Seminar">สัมมนา</option>
                    <option value="Study Visit">ดูงาน</option>
                    <option value="Other">อื่นๆ</option>
                </select>
            </div>
            <div class="form-group other-work-type" id="other_work_type_group">
                <label for="other_work_type">รายละเอียดเพิ่มเติม:</label>
                <input type="text" id="other_work_type" name="other_work_type" placeholder="กรุณาระบุ">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="work_location">จุดที่ปฎิบัติงาน:</label>
                <!--<input type="text" id="work_location" name="work_location" required>-->
                <select id="work_location" name="work_location" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
    </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="travel_date">วันที่เดินทาง:</label>
                <input type="date" id="travel_date" name="travel_date" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="departure_time">เวลาออกเดินทาง:</label>
                <input type="time" id="departure_time" name="departure_time" required>
            </div>
            <div class="form-group">
                <label for="start_travel_from">เริ่มออกเดินทางจาก:</label>
                <input type="text" id="start_travel_from" name="start_travel_from" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="destination">ถึงสถานที่ปฎิบัติงาน:</label>
                <input type="text" id="destination" name="destination" required>
            </div>
            <div class="form-group">
                <label for="start_work_time">เวลาเริ่มปฎิบัติงาน:</label>
                <input type="time" id="start_work_time" name="start_work_time" required>
            </div>
        </div>

        <div class="form-group">
            <label for="end_work_time">เวลาเสร็จงาน:</label>
            <input type="time" id="end_work_time" name="end_work_time" required>
        </div>

        <div class="form-group">
            <label for="work_image">อัปโหลดรูปภาพสถานที่ปฏิบัติงาน:</label>
            <input type="file" id="work_image" name="work_image" accept="image/*">
        </div>

        <button type="submit">ส่งข้อมูลการลงเวลา</button>
    </form>

    <script>
        function toggleOtherInput() {
            var workTypeSelect = document.getElementById("work_type");
            var otherWorkTypeGroup = document.getElementById("other_work_type_group");

            if (workTypeSelect.value === "Other") {
                otherWorkTypeGroup.style.display = "block";
            } else {
                otherWorkTypeGroup.style.display = "none";
            }
        }
    </script>
</body>
</html>