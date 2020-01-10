<?php 
session_start();
if(!isset($_SESSION['ud_email']))
{
    session_destroy();
}
else{unset($_SESSION['stat']);unset($_SESSION['datefrom']);unset($_SESSION['dateto']);unset($_SESSION['a1']);} 
include './connection.php';
?>
<html>
    <head>    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href="./css/materialize.min.css" /><!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--><link href="./iconfont/material-icons.css" rel="stylesheet"><script type="text/javascript" src="./js/jquery-3.0.0.js"></script><script type="text/javascript" src="./js/materialize.js"></script>
     <style>
                    .cnt {
                        overflow-y: scroll;
                    }

                    .cnt::-webkit-scrollbar { 
                        /* This is the magic bit */
                        display: none;
                    }
                </style>
    </head>

    <body onload="changechart('year',''),pending()" class="cnt">
  <?php
    $total="0";$atotal="0";$ytotal="0";$attotal="0";$ax="0";$sx="0";
    
  //Sales
            //Daily
            $atm=mysqli_query($con,"SELECT ord_id,COUNT(ord_id) AS total FROM order_details WHERE ord_status=3 AND DATE(ord_date)=CURDATE()");
            while($atm1=mysqli_fetch_array($atm))
            {
                $at=mysqli_query($con,"SELECT oprd_qty,oprd_unit_price FROM order_products WHERE ord_id='".$atm1['ord_id']."'");
                while($at1=mysqli_fetch_array($at))
                {
                    $atotal=$atotal+($at1['oprd_qty']*$at1['oprd_unit_price']);
                }
                $ax=$atm1['total'];
            }
            //Monthly
            $stm=mysqli_query($con,"SELECT ord_id,COUNT(ord_id) AS total FROM order_details WHERE ord_status=3 AND YEAR(ord_date) = YEAR(CURDATE()) AND MONTH(ord_date) = MONTH(CURDATE())");
            while($stm1=mysqli_fetch_array($stm))
            {
                $st=mysqli_query($con,"SELECT oprd_qty,oprd_unit_price FROM order_products WHERE ord_id='".$stm1['ord_id']."'");
                while($st1=mysqli_fetch_array($st))
                {
                    $total=$total+($st1['oprd_qty']*$st1['oprd_unit_price']);
                }
                $sx=$stm1['total'];
            }
            //Year
            $ytm=mysqli_query($con,"SELECT ord_id,COUNT(ord_id) AS total FROM order_details WHERE ord_status=3 AND YEAR(ord_date)=YEAR(CURDATE())");
            while($ytm1=mysqli_fetch_array($ytm))
            {
                $yt=mysqli_query($con,"SELECT oprd_qty,oprd_unit_price FROM order_products WHERE ord_id='".$ytm1['ord_id']."'");
                while($yt1=mysqli_fetch_array($yt))
                {
                    $ytotal=$ytotal+($yt1['oprd_qty']*$yt1['oprd_unit_price']);
                }
                $yx=$ytm1['total'];
            }
            //All Time
            $yytm=mysqli_query($con,"SELECT ord_id,COUNT(ord_id) AS total FROM order_details WHERE ord_status=3");
            while($yytm1=mysqli_fetch_array($yytm))
            {
                $yyt=mysqli_query($con,"SELECT oprd_qty,oprd_unit_price FROM order_products WHERE ord_id='".$yytm1['ord_id']."'");
                while($yyt1=mysqli_fetch_array($yyt))
                {
                    $attotal=$attotal+($yyt1['oprd_qty']*$yyt1['oprd_unit_price']);
                }
                $yyx=$yytm1['total'];
            }
//Highest Selling            
            //Today
            $xz=mysqli_query($con,"SELECT prd_id,SUM(oprd_qty) as nos FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND DATE(order_details.ord_date)=CURDATE() GROUP BY prd_id ORDER BY nos DESC");
            $xz1=mysqli_fetch_array($xz);
            $xzz=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$xz1['prd_id']."'");
            $xz11=mysqli_fetch_array($xzz);
            //Month
            $xxz=mysqli_query($con,"SELECT prd_id,SUM(oprd_qty) as nos FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND MONTH(order_details.ord_date)=MONTH(CURDATE()) GROUP BY prd_id ORDER BY nos DESC");
            $xxz1=mysqli_fetch_array($xxz);
            $xxzz=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$xxz1['prd_id']."'");
            $xxz11=mysqli_fetch_array($xxzz);
            //Year
            $xxxz=mysqli_query($con,"SELECT prd_id,SUM(oprd_qty) as nos FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND YEAR(order_details.ord_date)=YEAR(CURDATE()) GROUP BY prd_id ORDER BY nos DESC");
            $xxxz1=mysqli_fetch_array($xxxz);
            $xxxzz=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$xxxz1['prd_id']."'");
            $xxxz11=mysqli_fetch_array($xxxzz);

            //All Time
            $z=mysqli_query($con,"SELECT prd_id,SUM(oprd_qty) as nos FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 GROUP BY prd_id ORDER BY nos DESC");
            $z1=mysqli_fetch_array($z);
            $zz=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$z1['prd_id']."'");
            $z11=mysqli_fetch_array($zz);
//Grossing
            //Today
            $q2=mysqli_query($con,"SELECT prd_id,oprd_qty*oprd_unit_price as total FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND DATE(order_details.ord_date)=CURDATE() ORDER BY total DESC");
            $q21=mysqli_fetch_array($q2);
            $q2q=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$q21['prd_id']."'");
            $q211=mysqli_fetch_array($q2q);
            //Month
            $q3=mysqli_query($con,"SELECT prd_id,oprd_qty*oprd_unit_price as total FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND MONTH(order_details.ord_date)=MONTH(CURDATE()) ORDER BY total DESC");
            $q31=mysqli_fetch_array($q3);
            $q3q=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$q31['prd_id']."'");
            $q311=mysqli_fetch_array($q3q);
            //Year
            $q4=mysqli_query($con,"SELECT prd_id,oprd_qty*oprd_unit_price as total FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 AND YEAR(order_details.ord_date)=YEAR(CURDATE()) ORDER BY total DESC");
            $q41=mysqli_fetch_array($q4);
            $q4q=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$q41['prd_id']."'");
            $q411=mysqli_fetch_array($q4q);
            //Highest Grossing
            $q=mysqli_query($con,"SELECT prd_id,oprd_qty*oprd_unit_price as total FROM order_products INNER JOIN order_details ON order_products.ord_id=order_details.ord_id WHERE order_details.ord_status=3 ORDER BY total DESC");
            $q1=mysqli_fetch_array($q);
            $qq=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$q1['prd_id']."'");
            $q11=mysqli_fetch_array($qq);
  ?>
    <div class="row">
        <div class="col s12">
    <div class="card blue-grey darken-1 row" style="width: 100%;">
        <div class="card-content white-text center col s12 m6" style="width: 25%">
            <div class="row">
                
<!--                <div class="row" style="margin-bottom: 0">
                    <u class="card-title">New Orders</u><br>
                    <div id="pending"></div>
                </div>-->
            </div>
        </div>
        <div class="card-content white-text center col s12 m6" style="width: 25%">
            <u class="card-title">Total Sales</u><br>
            <?php echo "Today, ".date('d l')." : &#8377;".$atotal;?>(<?php if($ax==NULL){echo "0";} else {echo $ax;}?> Orders)<br>
            <?php echo "This Month, ".date('F')." : &#8377;".$total;?>(<?php if($sx==NULL){echo "0";} else {echo $sx;}?> Orders)<br>
            <?php echo "This Year, ".date('Y')." : &#8377;".$ytotal;?>(<?php if($yx==NULL){echo "0";} else {echo $yx;}?> Orders)<br>
            <?php echo "All Time : &#8377;".$attotal;?>(<?php if($yyx==NULL){echo "0";} else {echo $yyx;}?> Orders)
        </div>
        <div class="card-content white-text center col s12 m6" style="width: 25%">
            <u class="card-title">Highest Selling</u><br>
            <?php echo "Today, ".date("d l")." : ".$xz11['prd_name'].""; if($xz1['nos']==NULL){echo "(0";}else{echo "(".$xz1['nos'];};?> Kg/Pc)<br>
            <?php echo "This Month, ".date("F")." : ".$xxz11['prd_name']."";if($xz1['nos']==NULL){echo "(0";}else{echo "(".$xz1['nos'];};?> Kg/Pc)<br>
            <?php echo "This Year, ".date("Y")." : ".$xxxz11['prd_name']."(".$xxxz1['nos']." Kg/Pc)";?><br>
            <?php echo "All Time : ".$z11['prd_name']."(".$z1['nos']." Kg/Pc)";?>
        </div>
        <div class="card-content white-text center col s12 m6" style="width: 25%">
            <u class="card-title">Highest Grossing</u><br>
            <?php echo "Today, ".date("d l").": ".$q211['prd_name']."(&#8377;".$q21['total'].")";?><br>
            <?php echo "This Month, ".date("F")." : ".$q311['prd_name']."(&#8377;".$q31['total'].")";?><br>
            <?php echo "This Year, ".date("Y").": ".$q411['prd_name']."(&#8377;".$q41['total'].")";?><br>
            <?php echo "All Time : ".$q11['prd_name']."(&#8377;".$q1['total'].")";?>
        </div>
    </div>
        </div>
        <div class="col s12 m6" style="width: 100%; height: 50%;">
            <div class="row" style="width: 100%; height: 100%;">
                <center>
                    <div  class="row" style="padding-left: 30%">
                        <div class="col s12 m6" style="width: 20%">
                        <select id="chart" onchange="selectchart()">
                            <option value="year">Year</option>
                            <option value="month">Month</option>
                            <option value="custom">Custom</option>
                         </select>
                    </div>
                        <div id="year" class="col s12 m6" style="width: 20%">
                            <select id="yearsel" onchange="changechart('year',value)">
                                <option value="<?php echo date('Y');?>" selected="">Curr Year : <?php echo date('Y');?></option>
                            <?php $a=date('Y')-2015;for($i=0;$i<$a;$i++){?>    
                                <option value="<?php echo 2016+$i;?>"><?php echo 2016+$i;?></option>
                            <?php }?>
                            </select>
                    </div>
                    <div id="month" hidden="" class="col s12 m6" style="width: 20%">
                        <select id="monthsel" onchange="changechart('month',value)">
                        <option value="<?php echo date('n');?>" selected="">Curr Month : <?php echo date('M');?></option>
                        <?php for($i=1;$i<13;$i++){?>    
                            <option value="<?php echo $i?>"><?php $dateObj= DateTime::createFromFormat('!m', $i);$monthName = $dateObj->format('F'); echo $monthName;?></option>
                        <?php }?>
                        </select>
                    </div>
                    <div id="custom" hidden="" class="col s12 m6" style="width: 40%">
                        <select id="customyear" onchange="changechart('custom','')" class="col s12 m6" style="width: 50%">
                                <option value="<?php echo date('Y');?>" selected="">Curr Year : <?php echo date('Y');?></option>
                            <?php $a=date('Y')-2015;for($i=0;$i<$a;$i++){?>    
                                <option value="<?php echo 2016+$i;?>"><?php echo 2016+$i;?></option>
                            <?php }?>
                        </select>
                        <select id="custommonth" onchange="changechart('custom','')" class="col s12 m6" style="width: 50%">
                        <option value="<?php echo date('n');?>" selected="">Curr Month : <?php echo date('M');?></option>
                        <?php for($i=1;$i<13;$i++){?>    
                            <option value="<?php echo $i?>"><?php $dateObj= DateTime::createFromFormat('!m', $i);$monthName = $dateObj->format('F'); echo $monthName;?></option>
                        <?php }?>
                        </select>
                    </div>
                    </div>
                    <canvas id="c" ></canvas>
                    <canvas id="c1"></canvas>
                    <canvas id="c2"></canvas>
                </center>
        </div>
    </div>
    <div id="aaa"></div>
    </div>
    <script src="js/Chart.js"></script>
  <script>
   
     $(document).ready(function() {
    $('select').material_select();
  });
        function changechart(str,str1)
        {
            if(str1===null || str1===""){str1=new Date().getFullYear();}
            if(str==="year")
            {
                 var xmlhttp;
                if(window.XMLHttpRequest)
                {
                    xmlhttp= new XMLHttpRequest();
                }
                else
                    {
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                xmlhttp.onreadystatechange=function()
                {  
                    if(xmlhttp.readyState===4 && xmlhttp.status===200)
                    {
                        var obj=JSON.parse(xmlhttp.responseText);
                        var date=[];var date1=[];var per=[];var per1=[];
                        for(i=0;i<obj.length;i++)
                        {
                            if(obj[i].ord_total==null){date.push("0");date1.push("0");}
                            else{date.push(obj[i].ord_total);date1.push(obj[i].total);}
                        }
                        for(i=0;i<date.length-1;i++)
                        {
                            if(date[i+1]>date[i])
                            {   if(date[i]==0){per.push("+-"+date[i]+"%");}else{
                                var c=date[i+1]-date[i];alert(c);
                                c=c/date[i];alert(c);
                                c=c*100;alert(c);
                                c=c.toFixed(2);
                                per.push("+"+c+"%");}
                            }
                            else if(date[i+1]<date[i])
                            {
                                var c=date[i+1]-date[i];
                                c=c/date[i];
                                c=c*100;
                                c=c.toFixed(2);
                                per.push(c+"%");
                            }
                            else
                            {
                                per.push("+- 0%");
                            }
                        }
                        for(i=0;i<date1.length-1;i++)
                        {
                            if(date1[i+1]>date1[i])
                            {   if(date1[i]==0){per1.push("+-"+date1[i]+"%");}else{
                                var c=date1[i+1]-date1[i];
                                c=c/date1[i];
                                c=c*100;
                                c=c.toFixed(2);
                                per1.push("+"+c+"%");}
                            }
                            else if(date1[i+1]<date1[i])
                            {
                                var c=date1[i+1]-date1[i];
                                c=c/date1[i];
                                c=c*100;
                                c=c.toFixed(2);
                                per1.push(c+"%");
                            }
                            else
                            {
                                per1.push("+- 0%");
                            }
                        }
                        
                        var chardata={
                            labels:["January",["February ","Sales("+per[0]+")","Revenue("+per1[0]+")"],["March ","Sales("+per[1]+")","Revenue("+per1[1]+")"],["April","Sales("+per[2]+")","Revenue("+per1[2]+")"],["May ","Sales("+per[3]+")","Revenue("+per1[3]+")"],["June ","Sales("+per[4]+")","Revenue("+per1[4]+")"],["July ","Sales("+per[5]+")","Revenue("+per1[5]+")"],["August ","Sales("+per[6]+")","Revenue("+per1[6]+")"],["September ","Sales("+per[7]+")","Revenue("+per1[7]+")"],["October ","Sales("+per[8]+")","Revenue("+per1[8]+")"],["November ","Sales("+per[9]+")","Revenue("+per1[9]+")"],["December ","Sales("+per[10]+")","Revenue("+per1[10]+")"]],
                            datasets:[
                                {
                                    label: "Sales Chart "+str1,
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date,
            spanGaps: false,
              scaleStartValue:0

                                },
                                {
                                    label: "Revenue Chart "+str1,
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,72,192,0.4)",
            borderColor: "rgba(75,72,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date1,
            spanGaps: false,
              scaleStartValue:0

                                }
                            ]
                        };
                        $("#c").show();
                        $("#c1").hide();
                        $("#c2").hide();
                        var ctx = document.getElementById("c").getContext("2d");
                        var myLineChart = Chart.Line(ctx,{data:chardata});
                        
                    }
               };
               xmlhttp.open("POST","logic.php?page=chartyear",true);
               xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
               xmlhttp.send("year="+str1);
            }
            
            else if(str=="month")
            {
                 var xmlhttp;
                if(window.XMLHttpRequest)
                {
                    xmlhttp= new XMLHttpRequest();
                }
                else
                    {
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                xmlhttp.onreadystatechange=function()
                {  
                    if(xmlhttp.readyState===4 && xmlhttp.status===200)
                    {
                        var obj=JSON.parse(xmlhttp.responseText);
                         var date=[];var date1=[];
                        
                        for(i=0;i<obj.length;i++)
                        {
                            if(obj[i].ord_total==null){date.push("0");date1.push("0");}
                            else{date.push(obj[i].ord_total);date1.push(obj[i].total);}
                        }
                         var za= new Array();
                         
                            if(str1==1 || str1==3 || str1==5 || str1==7 || str1==8 || str1==10 || str1==12)
                            {
                                for(j=1;j<32;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==4 || str1==6 || str1==9 || str1==11)
                            {
                                for(j=1;j<31;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==2)
                            {
                                for(j=1;j<29;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==1){str2="January";}else if(str1==3){str2="March"}else if(str1==4){str2="April"}else if(str1==5){str2="May"}else if(str1==6){str2="June"}else if(str1==7){str2="July"}else if(str1==8){str2="August"}else if(str1==9){str2="September"}else if(str1==10){str2="October"}else if(str1==11){str2="November"}else if(str1==12){str2="December"}
                        var chardata={
                           
                            labels:za,
                            datasets:[
                                {
                                    label: "Sales Chart"+":"+str2,
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date,
            spanGaps: false,
              scaleStartValue:0

                                },
                                 {
                                    label: "Revenue Chart "+str1,
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,72,192,0.4)",
            borderColor: "rgba(75,72,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date1,
            spanGaps: false,
              scaleStartValue:0

                                }
                            ]
                        };
                        $("#c").hide();
                        $("#c1").show();
                        $("#c2").hide();
                        var ctx = document.getElementById("c1").getContext("2d");
                        var myLineChart = Chart.Line(ctx,{data:chardata});
                        
                    }
               };
               xmlhttp.open("GET","logic.php?page=chartmonth&month="+str1,true);
               xmlhttp.send();
            }
            else if(str=="custom")
            {
                var m=$("#custommonth").val();var str1=m;
                var y=$("#customyear").val();
                var xmlhttp;
                if(window.XMLHttpRequest)
                {
                    xmlhttp= new XMLHttpRequest();
                }
                else
                    {
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                xmlhttp.onreadystatechange=function()
                {  
                    if(xmlhttp.readyState===4 && xmlhttp.status===200)
                    {
                        var obj=JSON.parse(xmlhttp.responseText);
                         var date=[];var date1=[];
                        
                        for(i=0;i<obj.length;i++)
                        {
                            if(obj[i].ord_total==null){date.push("0");date1.push("0");}
                            else{date.push(obj[i].ord_total);date1.push(obj[i].total);}
                        }
                         var za= new Array();
                         
                            if(str1==1 || str1==3 || str1==5 || str1==7 || str1==8 || str1==10 || str1==12)
                            {
                                for(j=1;j<32;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==4 || str1==6 || str1==9 || str1==11)
                            {
                                for(j=1;j<31;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==2)
                            {
                                for(j=1;j<29;j++)
                                {
                                    za.push(j);
                                }
                            }
                            if(str1==1){str2="January";}else if(str1==3){str2="March"}else if(str1==4){str2="April"}else if(str1==5){str2="May"}else if(str1==6){str2="June"}else if(str1==7){str2="July"}else if(str1==8){str2="August"}else if(str1==9){str2="Septembet"}else if(str1==10){str2="October"}else if(str1==11){str2="November"}else if(str1==12){str2="December"}
                        var chardata={
                           
                            labels:za,
                            datasets:[
                                {
                                    label: "Sales Chart"+":"+str2,
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date,
            spanGaps: false,
              scaleStartValue:0

                                },
                                 {
                                    label: "Revenue Chart "+str1,
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,72,192,0.4)",
            borderColor: "rgba(75,72,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: date1,
            spanGaps: false,
              scaleStartValue:0

                                }
                            ]
                        };
                        $("#c").hide();
                        $("#c1").hide();
                        $("#c2").show();
                        var ctx = document.getElementById("c2").getContext("2d");
                        var myLineChart = Chart.Line(ctx,{data:chardata});
                        
                    }
               };
               xmlhttp.open("POST","logic.php?page=chart_custom",true);
               xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
               xmlhttp.send("month="+m+"&year="+y);
                
                
            }
        }
        
        function selectchart()
        {
            var a=$("#chart").val();
            if(a=="custom"){$("#year").hide();$("#month").hide();$("#custom").show();}
            else if(a=="year"){$("#year").show();$("#month").hide();$("#custom").hide();changechart(a,$('#yearsel').val());}
            else if(a=="month"){$("#year").hide();$("#month").show();$("#custom").hide();changechart(a,$('#monthsel').val());}
        }
        
        function pending()
        {
                var xmlhttp;
                if(window.XMLHttpRequest)
                {
                    xmlhttp= new XMLHttpRequest();
                }
                else
                    {
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                xmlhttp.onreadystatechange=function()
                {  
                    if(xmlhttp.readyState===4 && xmlhttp.status===200)
                    {
                        $("#pending").text(xmlhttp.responseText);
                    }
               };
               xmlhttp.open("GET","logic.php?page=pending",true);
               xmlhttp.send();
        }
        setInterval('pending()',60000);
  </script>
</body>
</html>