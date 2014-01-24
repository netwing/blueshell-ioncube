<?php

class Color extends CApplicationComponent 
{

    static public function getContrastYIQ($hexcolor, $return = "hex")
    {
        $black = "#000";
        $white = "#fff";
        if ($return === "text") {
            $black = "black";
            $white = "white";
        }
        if ($return === "int") {
            $black = 0;
            $white = 255;
        }
        $hexcolor = trim($hexcolor, '#');
        $r = hexdec(substr($hexcolor,0,2));
        $g = hexdec(substr($hexcolor,2,2));
        $b = hexdec(substr($hexcolor,4,2));
        $yiq = (($r*299)+($g*587)+($b*114))/1000;
        return ($yiq >= 128) ? $black : $white;
    }

    static public function getContrast50($hexcolor, $return = "hex")
    {
        $black = "#000";
        $white = "#fff";
        if ($return == "text") {
            $black = "black";
            $white = "white";
        }
        if ($return === "int") {
            $black = 0;
            $white = 255;
        }
        $hexcolor = trim($hexcolor, '#');
        return (hexdec($hexcolor) > 0xffffff/2) ? $black : $white;
    }

    static public function getDecimal($hexcolor)
    {
        $hexcolor = trim($hexcolor, '#');
        $r = hexdec(substr($hexcolor,0,2));
        $g = hexdec(substr($hexcolor,2,2));
        $b = hexdec(substr($hexcolor,4,2));

        return array($r, $g, $b);        
    }

}