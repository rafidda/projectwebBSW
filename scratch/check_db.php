<?php
$m = new mysqli('127.0.0.1', 'root', 'root', 'local', 10005);
if ($m->connect_error) {
    echo 'Error: ' . $m->connect_error . PHP_EOL;
} else {
    echo 'Connected!' . PHP_EOL;
    $res = $m->query("SELECT option_value FROM wp_options WHERE option_name = 'options_lelang_list'");
    if ($res && $row = $res->fetch_assoc()) {
        echo 'Length: ' . strlen($row['option_value']) . PHP_EOL;
        $data = @unserialize($row['option_value']);
        echo 'Count: ' . (is_array($data) ? count($data) : 'not array') . PHP_EOL;
        if (is_array($data)) {
            foreach ($data as $i) {
                echo ' - ' . ($i['judul'] ?? 'no title') . ' (' . ($i['harga_limit'] ?? '-') . ')' . PHP_EOL;
            }
        }
    } else {
        echo 'Not in DB' . PHP_EOL;
    }
}

