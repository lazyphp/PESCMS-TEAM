<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Expand\Excel;

\Core\Func\CoreFunc::$defaultPath = false;
require_once PES_PATH . '/Expand/Excel/Classes/PHPExcel.php';

/**
 * Excel文件导入和导出
 */
class Excel {

    /**
     * 暴露EXCEL对象
     * 注意：不需要声明头部文件
     */
    public static function api() {
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
        return $objPHPExcel;
    }

    public static function save($obj, $fileName) {
        $obj->getActiveSheet()->setTitle($fileName);
        $obj->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($obj, 'Excel5');

        $objWriter->save('php://output');
        exit;
    }

    /**
     * 生成EXCEL文件
     * @param type $fileName 导出的文件名称
     * @param array $title 内容的列标题 | 一维数组
     * @param array $content 内容 | 必须为二维数组 |
     * 函数补充说明 当参数$content二维数组下的键值为非数字时
     * 程序会将内容值强制设置为文本类型。适用于：身份证，订单号码等纯数字内容
     * 声明方法如下: array('0' => array('order' => '123456789', '0' => 'abc', '1' => 'test')
     * 
     */
    public function export($fileName, array $title, array $content) {
        if (empty($title)) {
            die('请填写填写导出的列标题');
        }
        $letters = range('A', 'Z');
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");

        $countTitle = count($title);
        for ($i = 0; $i < $countTitle; $i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($letters[$i])->setAutoSize(true);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("{$letters[$i]}1", $title[$i])->getStyle("{$letters[$i]}1")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }


        $j = 2;
        foreach ($content as $item) {
            $i = 0;
            if (!is_array($item)) {
                die('内容数组非二维数组!');
            }
            foreach ($item as $key => $value) {
                //如果内容为数组，表明该内容需要设置样式
                if (is_array($value)) {
                    $value = $this->setStyle($value);
                }

                if (is_numeric($key)) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($letters[$i] . $j, $value)->getStyle($letters[$i] . $j)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                } else {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit($letters[$i] . $j, $value)->getStyle($letters[$i] . $j)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
                $i++;
            }
            $j++;
        }

        $objPHPExcel->getActiveSheet()->setTitle($fileName);
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $objWriter->save('php://output');
        exit;
    }

    /**
     * 设置样式(暂时只有颜色)
     */
    private function setStyle($array) {
        foreach ($array as $key => $value) {
            $objRichText2 = new \PHPExcel_RichText();
            $objRed = $objRichText2->createTextRun($key);
            switch (strtoupper($value)) {
                case 'RED':
                    $str = \PHPExcel_Style_Color::COLOR_RED;
                    break;
                case 'BLACK':
                    $str = \PHPExcel_Style_Color::COLOR_BLACK;
                    break;
                case 'WHITE':
                    $str = \PHPExcel_Style_Color::COLOR_WHITE;
                    break;
                case 'DARKRED':
                    $str = \PHPExcel_Style_Color::COLOR_DARKRED;
                    break;
                case 'BLUE':
                    $str = \PHPExcel_Style_Color::COLOR_BLUE;
                    break;
                case 'DARKBLUE':
                    $str = \PHPExcel_Style_Color::COLOR_DARKBLUE;
                    break;
                case 'GREEN':
                    $str = \PHPExcel_Style_Color::COLOR_GREEN;
                    break;
                case 'DARKGREEN':
                    $str = \PHPExcel_Style_Color::COLOR_DARKGREEN;
                    break;
                case 'YELLOW':
                    $str = \PHPExcel_Style_Color::COLOR_YELLOW;
                    break;
                case 'DARKYELLOW':
                    $str = \PHPExcel_Style_Color::COLOR_DARKYELLOW;
                    break;
                default :
                    return $key;
            }
            $objRed->getFont()->setColor(new \PHPExcel_Style_Color($str));
            return $objRichText2;
        }
    }
    
        /**
     * 导入EXCEL
     */
    public static function import($file) {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        return $objPHPExcel->getActiveSheet()->toArray();
    }

}
