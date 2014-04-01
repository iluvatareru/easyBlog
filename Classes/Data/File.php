<?php

namespace Classes\Data;


class File extends AbstractData
{
    public function getAll($filename)
    {
        $allContent = file_get_contents("Content/".$filename.".json");

        return json_decode($allContent, true);
    }

    public function insert($filename, $data)
    {
        $data = [0 => $data];

        $jsonData = json_encode($data);

        file_put_contents("Content/".$filename.".json", $jsonData);
    }
}