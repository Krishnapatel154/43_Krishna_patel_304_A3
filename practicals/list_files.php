<?php
// Practical 4: List files in this practical's sample_files directory.
$directory = __DIR__ . '/sample_files';
$items = array_values(array_filter(scandir($directory), function ($name) use ($directory) {
    return $name !== '.' && $name !== '..' && is_file($directory . DIRECTORY_SEPARATOR . $name);
}));
sort($items, SORT_NATURAL | SORT_FLAG_CASE);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>List Directory Files</title></head><body>
<h1>Practical 4: List Files in a Directory</h1>
<p>Directory: <code>practicals/sample_files</code></p>
<?php if (!$items): ?><p>No files found. Add a sample file into the sample_files folder.</p><?php else: ?>
<ul><?php foreach ($items as $item): ?><li><?= htmlspecialchars($item, ENT_QUOTES, 'UTF-8') ?></li><?php endforeach; ?></ul>
<?php endif; ?>
</body></html>
