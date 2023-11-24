<?php
// Simulate fetching data from a database
$data = array(
    array('id' => 1, 'name' => 'Item 1'),
    array('id' => 2, 'name' => 'Item 2'),
    array('id' => 3, 'name' => 'Item 3')
);

// Output the content as HTML
foreach ($data as $item) {
    echo '<p>ID: ' . $item['id'] . ' - Name: ' . $item['name'] . '</p>';
}
?>
