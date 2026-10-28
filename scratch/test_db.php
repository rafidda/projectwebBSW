<?php
foreach ([10000, 10001, 10002, 10003, 10004, 10005, 3306] as $port) {
    try {
        $m = @new mysqli('127.0.0.1', 'root', 'root', 'local', $port);
        if (!$m->connect_error) {
            echo "Connected on port " . $port . PHP_EOL;
            $res = $m->query("SELECT option_value FROM wp_options WHERE option_name = 'options_lelang_list'");
            if ($row = $res->fetch_assoc()) {
                echo "options_lelang_list in DB length: " . strlen($row['option_value']) . PHP_EOL;
                $data = @unserialize($row['option_value']);
                echo "Items count: " . (is_array($data) ? count($data) : 'not array') . PHP_EOL;
                if (is_array($data)) {
                    foreach ($data as $item) {
                        echo " - " . ($item['judul'] ?? 'no title') . " (" . ($item['harga_limit'] ?? '-') . ")" . PHP_EOL;
                    }
                }
            } else {
                echo "options_lelang_list NOT in DB (null)" . PHP_EOL;
            }
            break;
        }
    } catch (Throwable $e) {
    }
}

