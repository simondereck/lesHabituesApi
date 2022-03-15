<?php
namespace App\Tools;

class SMTools
{
    public static string $salt = "lesHabitues";
    public static int $USER_BLOCK = 0x0000;
    public static int $USER_ACTIVE = 0x0001;
    public static int $TYPE_TOTAL = 0x0000;
    public static int $TYPE_DEBITER = 0x0001;
    public static int $TYPE_CREDITER = 0x0002;
    public static int $TYPE_AVEC_OFFERT = 0x0003;

    public static function publish($arr){
        echo "<pre>";
        var_dump($arr);
        die;
    }

    public static function getDateString():string
    {
        return date_format(date_create(), 'Y-m-d H:i:s');
    }


    public static function getDateLocal():string
    {
        return date_format(date_create(), 'y-m');
    }



}