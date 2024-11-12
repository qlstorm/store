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
        
        foreach ($files as $i => $file) {
            $path = $dir . '/' . time() . $i . '.' . $file['ext'];

            Image::save($file, $path);
        }
    }
}
