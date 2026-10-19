<?php
// Practical 3: Read students from MySQL and write them to students_export.xml.
require_once __DIR__ . '/../config.php';
$rows = $pdo->query('SELECT roll_no, name, email, course FROM students ORDER BY roll_no')->fetchAll();
// Build a clean DOM document for the expected <name>text</name> structure.
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->formatOutput = true;
$root = $dom->createElement('students');
foreach ($rows as $row) {
    $node = $dom->createElement('student');
    foreach (['roll_no', 'name', 'email', 'course'] as $key) {
        $child = $dom->createElement($key);
        $child->appendChild($dom->createTextNode((string)$row[$key]));
        $node->appendChild($child);
    }
    $root->appendChild($node);
}
$dom->appendChild($root);
$outFile = __DIR__ . '/students_export.xml';
$dom->save($outFile);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>MySQL to XML</title></head><body>
<h1>Practical 3: MySQL to XML</h1>
<p>Exported <?= (int)count($rows) ?> student record(s).</p>
<p>Created file: <code>practicals/students_export.xml</code></p>
<p><a href="students_export.xml" target="_blank">View exported XML</a></p>
</body></html>
