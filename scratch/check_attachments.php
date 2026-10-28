<?php
$m = new mysqli('127.0.0.1', 'root', 'root', 'local', 10005);
$res = $m->query("SELECT post_title, guid FROM wp_posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image%' ORDER BY ID DESC LIMIT 15");
while ($r = $res->fetch_assoc()) {
    echo $r['post_title'] . ' => ' . $r['guid'] . PHP_EOL;
}

