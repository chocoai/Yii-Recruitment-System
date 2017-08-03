<?php

/**
 * 帮助类
 * Class Helper
 */
class Helper
{

    static function excelTime($days, $time = false)
    {
        if (is_numeric($days)) {
            //based on 1900-1-1
            $jd = gregoriantojd(1, 1, 1970);
	    $gregorian = jdtogregorian($jd + intval($days) - 25569);
	    $myDate = explode('/', $gregorian);
            $myDateStr = str_pad($myDate[2], 4, '0', STR_PAD_LEFT)
                . "-" . str_pad($myDate[0], 2, '0', STR_PAD_LEFT)
                . "-" . str_pad($myDate[1], 2, '0', STR_PAD_LEFT)
                . ($time ? " 00:00:00" : '');
            return $myDateStr;
        }
        return $days;
    }

    /**
     * 压缩html : 清除换行符,清除制表符,去掉注释标记
     * @param $string
     * @return  压缩后的$string
     * */
    static function compress_html($string)
    {
        $string = str_replace("\r\n", '', $string); //清除换行符
        $string = str_replace("\n", '', $string); //清除换行符
        $string = str_replace("\t", '', $string); //清除制表符
        $pattern = array(
            "/> *([^ ]*) *</", //去掉注释标记
            "/[\s]+/",
            "/<!--[^!]*-->/",
            "/\" /",
            "/ \"/",
            "'/\*[^*]*\*/'"
        );
        $replace = array(
            ">\\1<",
            "  ",
            "",
            "\"",
            "\"",
            ""
        );
        return preg_replace($pattern, $replace, $string);
    }

}
