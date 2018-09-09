<?php
$flag=false;
$host="/MyPage/";
    function getIp()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = "unknown";
	
        return json_encode(array('ip' => $ip));
    }
    function getCityByIp($ip)
    {
        $url="http://ip.taobao.com/service/getIpInfo.php?format=json&ip=".$ip;
        //print_r(file_get_contents($url));
        $ipinfo=json_decode(file_get_contents($url));
       	if($ipinfo->code=='1'){
	        return false;
       	}
	    $city = $ipinfo->data->country." ".
		$ipinfo->data->area." ".
		$ipinfo->data->region." ".
		$ipinfo->data->city." ".
		$ipinfo->data->isp;	
	    return $city;
    }

    header("Content-type:text/html;charset=utf-8");//设置编码格式
    $targetIp = getIp();
    $ip=json_decode($targetIp,true)["ip"];
    $model=$_GET["model"] or "";
    if($_GET["order"]!=310012){
        $filesize=abs(filesize("../tool/GotIt"));
        //大于32767就换文件重写
        if($filesize>=32767) rename("../tool/GotIt","../tool/over_at_".date("ymdHis"));
        // echo $filesize;
        $myfile = fopen("../tool/GotIt", "a+")or die("Unable to open file!"); 
       	fwrite($myfile, "Got ".$ip."\t from ".getCityByIp($ip)."\t at ".date("y-m-d H:i:s"));
        fwrite($myfile, "\n");
        fclose($myfile);
	//echo "Got ".$ip."\t in ".getCityByIp($ip)."\t at ".date("y-m-d H:i:s");
        // header("Location:http://www.rkpass.cn/u.jsp?u=320161");
        //echo "非本人登录";
    }
    else{$flag=true;}
?>

<!DOCTYPE html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <title>eatfingersss's Host Page</title>
    <link rel="shortcut icon" href="/MyPage/img/ico/favicon.ico">
    <link href="/MyPage/css/main.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="/MyPage/js/jquery1.8.2.min.js"></script>
    <script type="text/javascript" src="/MyPage/js/main.js"></script>
    <script type="text/javascript" src="/MyPage/js/hello.js"></script>

    <link rel="stylesheet" type="text/css" href="/MyPage/js/jquery-easyui-1.5.5.4/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/MyPage/js/jquery-easyui-1.5.5.4/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/MyPage/js/jquery-easyui-1.5.5.4/demo/demo.css">
    <script type="text/javascript" src="/MyPage/js/jquery-easyui-1.5.5.4/jquery.min.js"></script>
    <script type="text/javascript" src="/MyPage/js/jquery-easyui-1.5.5.4/jquery.easyui.min.js"></script>
    
    <link type="text/css" rel="stylesheet" href="/MyPage/img/ico/font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
        /*body:after{ content:""}*/
    </style>
</head>
<body style="background-color:#9999ff;padding-bottom:7.35% !important;z-index:999;">
  <!-- <script type="text/javascript" color="96,192,255" opacity="0.382" count="180" src="/MyPage/js/canvas-nest.js-master/dist/canvas-nest.js"></script>
   --> <audio id="BgmBox" src="" controlsList="nodownload" controls="controls" autoplay="autoplay" loop="loop"></audio> 
	<!--            V1.0 at 2018-7-2	23:32
	    		V1.1 at 2018-7-17	11:39
			V1.2 at 2018-7-19	11:16
			V1.3 at 2018-7-20	11:32
			V1.4 at 2018-8-19	12:03
			V1.5 at 2018-8-24	10:37   卧槽赶紧去看现代
			V1.6 at 2018-8-30	10:59
-->
    <div id="backgroundImg1"></div>
    <div id="backgroundImg2"></div>
    <div id="banner">
    	<div id="title">
	    <div id="mini">
	     	<a id="miniPanel" href="javascript:void(0)" onclick="panelMini()">
		    <i class="fa fa-minus"></i>
		</a>	    
     	    </div>
        	<p id="welcome" style="font-size: 45px;">Welcome,
                <?php                    
		    echo json_decode($targetIp,true)["ip"]." ";
		    if($flag==true)	echo "</p><p>服主身份已确认";
		?>
            </p>
            <p style="margin-bottom:0px;">Here is 106.14.162.34</p>
	    <div id="button">
		<a id="panelControl" href="javascript:void(0)" onclick="panelHide()">
	            <i class="fa fa-arrow-circle-up"></i>
	    	</a>
	    	<a id="musicList" href="javascript:void(0)" onclick="openDlg()">
		    <i class="fa fa-music" ></i>
	    	</a>
	    </div>
        </div>
        <div id="main">
            <div id="functionDiv">
                <div class="function">
                    <a href=../action/download.php>
			<i class="fa fa-download" aria-hidden="true"></i>&nbsp;Download
		    </a>
                </div>
                <table class="line"><tr><td valign="top"></td></tr></table>
                <div class="function">
                    <a href="eatfingersss.top:8008" ><i class="fa fa-gamepad" aria-hidden="true"></i>&nbsp;Editor</a>
                </div>
                <table class="line"><tr><td valign="top"></td></tr></table>
                <div class="function">
                    <a href="https://wfaw.richasy.cn" ><i class="fa fa-link" aria-hidden="true"></i>&nbsp;favorite</a>
                </div>
                <table class="line"><tr><td valign="top"></td></tr></table>
                <div class="function-m">
                    <a href="http://www.baidu.com" >more...</a>
                </div>
            </div>
            <div id="find">
                <p></p>
            </div>

            <script type="text/javascript">
                var musicFlag=true;
		var main_status="hide",banner_status="display";
		var banner_height,num;
                $(document).ready(function(){
		    //dlgOut(100);
		    if(!<?php echo $flag?'true':'false'?>)console.log('游客身份确认');
		    var model = /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ? "mobile" :"desktop"  ;	
		    var themeColor;
		    var canvasColor="96,192,255";
		    console.log('you are '+model);
		    $("#welcome").append("<i class=\"fa fa-"+model+"\" aria-hidden=\"true\"></i>  !");
		    if(model=="desktop"&&
			<?php echo ($model!='simple' ? 'true' : 'false'); ?>
		    ) 
		    {
			$("body").append("<script id=\"canvas\" type=\"text/javascript\" color=\""+canvasColor+"\" opacity=\"0.618\" count=\"180\" src=\"/MyPage/js/canvas-nest.js-master/dist/canvas-nest.js\"><//script>");
		    	console.log('canvas特效，启动！');
		    }
		    document.getElementById("BgmBox").volume = 0.382;
		    $('#dlg').parent().parent().css("bottom", "0px !important");
                    $('#bgmList').datalist({
                        onClickRow: function(index,row){
                            if(!musicFlag)return;
                            musicPlay(row["group"]);
                        }
                    });
		    
                });
                function openDlg(){
                    //$('#dlg').dialog('open');
		    $("#dlg").parent().fadeIn(500);
                    $(".window-shadow").fadeIn(500);
                }
                function closeDlg(){
                    //$('#dlg').dialog('close');
                }
                function clearList(){
                    var res=$('#bgmList').datalist('getSelections');
                    if(res.length>0)
                        $('#bgmList').datalist('clearSelections');
                }
		function dlgOut(num){
		    if(num==undefined) num=500;
		    $("#dlg").parent().fadeOut(num);
		    $(".window-shadow").fadeOut(num);
		    //return false;
		}
		function panelMini(){
		    if(banner_status=="display")
		    {
			banner_height = document.getElementById("banner").style.height;
			$("#banner").animate({
			    height:"30px"
			},800,
				function(){
					$("#banner").animate({
						width:"50px"
					},800,
						function(){
							$('#title').animate({
								opacity:"0.2"
							},300)
						}
					)
				}
			);
			$("#title").animate({
                            //backgroundcolor:"rgba(220,228,222,0.1)"
                        },800);
                        $("#main").animate({
                            //opacity:"1"
                        },800);
			banner_status="hide";
		    }
		    else
		    {
			$('#title').css({opacity:"0.7"});
			$("#banner").animate({
                            width:"70%"
                        },800,function(){$("#banner").animate({height:"95%"},800)});
                        $("#main").animate({
                            //opacity:"1"
                        },800);
                        $("#title").animate({
                            //backgroundcolor:"rgba(220,228,222,0.7)"
                        },800);
			//$("#banner").hover(function(){$("#banner").animate({opacity:"0.7"})});
                        banner_status="display";
		    }
		}
		function panelHide(){
		    if(main_status=='display') 
		    {
			$("#title").animate({
			    "border-radius":"10px 10px 10px 10px"
			},400);
			$("#main").css({"z-index":"-1"});
			//$("#title").css({"border-radius":"10px 10px 10px 10px"});
			$("#main").animate({
        		    opacity: "0",
        		    bottom:"75px"

		    	},800,function(){$("#main").css({visibility:"hidden"})});
			main_status='hide';
		    }
		    else
		    {
			$("#title").animate({
                           "border-radius":"10px 10px 0px 0px"
                        },400);
                        $("#main").css({"z-index":"99"});
			//$("#title").css({"border-radius":"10px 10px 0px 0px"});
			$("#main").css({visibility:"visible"});
			$("#main").animate({
        		    opacity: "1",
        		    bottom:"0px"
			},800);
			main_status='display';
		    }

		}
            </script>
	    <div id="listBox">
            	<div id="dlg" class="easyui-dialog" title="音乐列表" data-options="closed:false,onBeforeClose:function(){dlgOut();return false;}"
                     style="width:180px;left:0px;max-height:390px;"
            >
                    <div id="bgmList" class="easyui-datalist" title="" style="" data-options="
                        url:'<?php echo$host?>util/GetBgmList.php',
                    	method: 'get'
                    ">
                    </div>
            	</div>
	    </div>
        </div>
    </div>

    

</body>
</html>
