<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

 */


class WorkshopsCrud extends MyCrud {
    function prepareForDisplay($data)
    {
        if (empty($data)) return;

        foreach ($data as $d => &$row) {
            foreach ($row as $field => &$value) {

                if ($field == 'workshopDesc') {
                    $value = nl2br($value);
                }
            }
        } /// outer foreach

        return $data;
    } /// prepare...
}

?>