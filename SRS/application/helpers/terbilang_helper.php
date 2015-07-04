<?php 
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	Pudyasto Adi Wibowo
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Terbilang Helpers
 *
 * @package		CodeIgniter
 * @subpackage          Helpers
 * @category            Helpers
 * @author		Pudyasto Adi Wibowo
 */

// ------------------------------------------------------------------------ 

if ( ! function_exists('terbilang'))
{      
    /**
     * Formats a numbers as bytes, based on size, and adds the appropriate suffix
     *
     * @angka	integer
     * @return	string 
     */

    function terbilang($angka) {
        $angka = (int)$angka;
        $bilangan = array(
                '',
                'satu',
                'dua',
                'tiga',
                'empat',
                'lima',
                'enam',
                'tujuh',
                'delapan',
                'sembilan',
                'sepuluh',
                'sebelas'
        );

        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('seratus %s', terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int)($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('seribu %s', terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
            $hasil_mod = $angka % 1000;
            return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
        } else if ($angka < 1000000000) {

            // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
            $hasil_bagi = (int)($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            // bilangan 'milyaran'
            $hasil_bagi = (int)($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) { 
            // bilangan 'triliun'                           
            $hasil_bagi = $angka / 1000000000000;                           
            $hasil_mod = fmod($angka, 1000000000000);                           
            return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod))); 
        } else if($angka === "0"){
            echo "";
        } else {
            return 'Format angka melebihi batas';                        
        }                   
    
    }        
}

