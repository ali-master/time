<?php
$start_time_field = htmlspecialchars(trim(addslashes($_POST['start_time'])));
$end_time_field = htmlspecialchars(trim(addslashes($_POST['start_time'])));
$start_time= explode(":",$start_time_field);
    $start_h = $start_time[0];
   // echo "start h is : " .$start_h ;
   // echo " --- " ;
    $start_m = $start_time[1];
   // echo "start_m is : " .$start_m ;
   // echo "<hr>" ;
 
    $end_time= explode(":",$end_time_field);
    $end_h = $end_time[0];
   // echo "end_h is : " .$end_h ;
   // echo " --- " ;
    $end_m = $end_time[1];
   // echo "end_m is : " .$end_m ;
   // echo "<hr>" ;
     
 
    $start_total = ( $start_h * 60 ) + $start_m ;
    //echo "start_total is : " .$start_total ;
    $end_total = ( $end_h * 60 ) + $end_m ;
    //echo "end_total is : " .$end_total ;
    //echo "" ;
 
    $tafrigh_m = $end_total  - $start_total ;
    //echo 'tafrigh_m is : ' . $tafrigh_m  ;
    //echo "<hr>" ;
 
    $faseleh_h = intval($tafrigh_m  / 60 );
    //echo 'faseleh_h is : ' . $faseleh_h  ;
    //echo "";
    $faseleh_m = ($tafrigh_m % 60);
    //echo 'faseleh_m is : ' . $faseleh_m  ;
     
     $fasele_zamani = $faseleh_h .":". $faseleh_m;
     
    $ajib_total = ($faseleh_h * 60 ) + $faseleh_m ;
    $ajib = $ajib_total / 12 ;
    $ekhtelaf_saat = round($ajib);
     
    function adder($old_h,$old_m,$new_m){
        $old_total_m = ($old_h * 60 ) + $old_m ;
        $new_total_m = $old_total_m + $new_m ;
         
        $output_h = intval($new_total_m  / 60 );
        $output_m = ($new_total_m % 60);
        $output =array();
        $output[0] = $output_h; // saat
        $output[1] = $output_m; // minute
        return $output;
    }
    $p = 1;
    $pele_h = $start_h;
    $pele_m = $start_m;
?>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<title>محاسبه ساعت</title>
	<link rel="stylesheet" type="text/css" href="assets/css/main.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/calculation.css">
	
</head>
<body>

<div style="display: none;"><h1><a href="http://www.isheed.com" title="isheed™  -  تیم وب گستر">تیم توسعه وب سایت - isheed</a></h1></div>

<div id="ali-HeaderOfflinePage">
	<center><div><img src="assets/images/bismeallah.png" alt="isheed™  -  تیم وب گستر" /></div></center>
</div>

<div id="ali-LOGO">
	<div class="ali-ImageLogo"><img src="assets/images/logo.png" /></div>
</div>

<div class="ali-Reason">
	<div class="ali-TitleReason"><h1>سیستم به دست آوردن ساعت صورت فلکی</h1></div>
	<div class="ali-TXTReason">
		<?php
		echo '<table>';
		echo '
        <tr>
        	<td>طلوع خورشید</td>
        	<td>'.$start_m.' : '.$start_h.' دقیقه</td>
        </tr>
		<tr>
        	<td>غروب خورشید</td>
        	<td>'.$end_m.' : '.$end_h.' دقیقه</td>
        </tr>
        <tr>
        	<td>فاصله زمانی</td>
        	<td>'.$fasele_zamani.' دقیقه</td>
        </tr>
        <tr>
        	<td>اختلاف ساعت</td>
        	<td>'.$ekhtelaf_saat.' دقیقه</td>
        </tr>
        <tr>
        	<td>ردیف	</td>
        	<td>زمان رویداد</td>
        </tr>';
    for($i=0 ; $i < 21 ;$i++){
        echo '<tr>';
            echo'<td>';
                echo $p ;
            echo'</td>';
            $cached = adder($pele_h ,$pele_m,$ajib);
            echo'<td>';
                echo $cached[0].':';
              	echo $cached[1]." دقیقه";
            echo'</td>';
        echo '</tr>';
    $pele_h = $cached[0] ;
    $pele_m =$cached[1] ;
     $p++;
    }
    echo '</table>';
		?>
	</div>
</div>
	<script type="text/javascript">
		String.prototype.toPersianDigit = function (a) {
			return this.replace(/\d+/g, function (digit) {
				var enDigitArr = [], peDigitArr = [];
				for (var i = 0; i < digit.length; i++) {
					enDigitArr.push(digit.charCodeAt(i));
				}
				for (var j = 0; j < enDigitArr.length; j++) {
					peDigitArr.push(String.fromCharCode(enDigitArr[j] + ((!!a && a == true) ? 1584 : 1728)));
				}
				return peDigitArr.join('');
			});
		};
		function TraceNodes(Node) {
			if (Node.nodeType == 3){ //TextNode
				Node.nodeValue = Node.nodeValue.toPersianDigit();
			}else{
				for (var i = 0; i < Node.childNodes.length; i++){
					TraceNodes(Node.childNodes[i]);
				}
			}
		}
		TraceNodes(document); 
    </script>
</body>
</html>