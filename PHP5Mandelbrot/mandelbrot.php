<?php
//PHP 7.3
define("BAILOUT",16);
define("MAX_ITERATIONS",1000);
class Mandelbrot
{
    function Mandelbrot()
	//Чтобы переделать этот код в PHP 5, нужно заменить __construct() на Mandelbrot()
    {
		set_time_limit(0);
		$avg=0;
		if (!$handle = fopen('result1.txt', 'a')) {
         echo "Не могу открыть файл (result.txt)";
         exit;
		}
		for($max_iter=100;$max_iter<=1000000;$max_iter*=10){
		for($z=0;$z<10;$z++){
			$d1 = microtime(1);
			for ($y = -39; $y < 39; $y++) {
				for ($x = -39; $x < 39; $x++) {
					if ($this->iterate($x/40.0,$y/40.0,$max_iter) == 0) 
						echo("*");
					else
						echo(" ");
				}
				echo("\n");
			}
			$d2 = microtime(1);
			$diff = $d2 - $d1;
			printf("\n".$z." MAX_ITERATIONS=".$max_iter.", PHP Elapsed %0.3f\n", $diff);
			$avg+=$diff;
		}
		$avg/=10;
		if (fwrite($handle, $max_iter." ".(string)$avg."\r\n") === FALSE) {
			echo "Не могу произвести запись в файл ($filename)";
			exit;
		}
		}
		fclose($handle);
    }
    function iterate($x,$y,$max_iter)
    {
        $cr = $y-0.5;
        $ci = $x;
        $zr = 0.0;
        $zi = 0.0;
        $i = 0;
        while (true) {
            $i++;
            $temp = $zr * $zi;
            $zr2 = $zr * $zr;
            $zi2 = $zi * $zi;
            $zr = $zr2 - $zi2 + $cr;
            $zi = $temp + $temp + $ci;
            if ($zi2 + $zr2 > BAILOUT)
                return $i;
            if ($i > $max_iter)
                return 0;
        }
    
    }
}
ob_start();
$m = new Mandelbrot();
ob_end_flush();
?>

