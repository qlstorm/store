<?php

namespace lib;

class Elem {

    public static function add($row, $files) {
        $row['timestamp'] = date('Y-m-d H:i:s');

        $res = Connection::insert('goods', $row);

        if (!$res) {
            return;
        }

        $id = Connection::getInsertId();

        $dir = 'files/images/' . $id;

        mkdir($dir, 0777, true);

        $n = 1;
        
        foreach ($files as $file) {
            $path = $dir . '/' . time() . $n . '.jpg';

            Image::save($file, $path);

            $n++;
        }
    }
}
