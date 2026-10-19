<?php
// Practical 2: Read students.xml and insert/update rows in MySQL.
require_once __DIR__ . '/../config.php';
$xmlFile = __DIR__ . '/students.xml';
$message = '';
if (!is_file($xmlFile)) {
    die('students.xml file was not found. Keep it inside the practicals folder.');
}
$xml = simplexml_load_file($xmlFile);
if ($xml === false) {
    die('Could not read XML. Check that students.xml is valid.');
}
$stmt = $pdo->prepare('INSERT INTO students (roll_no, name, email, course) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=VALUES(name), email=VALUES(email), course=VALUES(course)');
$count = 0;
foreach ($xml->student as $student) {
    $roll = (int)$student->roll_no;
    $name = trim((string)$student->name);
    $email = trim((string)$student->email);
    $course = trim((string)$student->course);
    if ($roll > 0 && $name !== '' && $email !== '' && $course !== '') {
        $stmt->execute([$roll, $name, $email, $course]);
        $count++;
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>XML to MySQL</title></head><body>
<h1>Practical 2: XML to MySQL</h1>
<p>Processed <?= (int)$count ?> student record(s). New records were inserted; matching roll numbers were updated.</p>
<p><a href="mysql_to_xml.php">Go to Practical 3: Export MySQL to XML</a></p>
</body></html>
