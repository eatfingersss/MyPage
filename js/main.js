/**
 * Created by asus on 2018/2/19.
 */
var debug=false;
var host="/MyPage/";
var audio;
var target;
var imgFlag=false;
var waittingTime=20000;
var rate=1.2;//放大倍数
var res=new Array();
var bgmNum=-1;
var model="undefined";
//var video=//document.getElementsById('BgmBox');
$(document).ready(function(){
    audio = document.getElementById("BgmBox");
    panelHide();//main面板显示
    $("#title").css(
       " border-radius","10px 10px 0px 0px"
    );
    var a_idx = 0;
    $("body").click(function(e) //鼠标点击+1s
    {
        var a = new Array("-1s","-1s");
        var $i = $("<span/>").text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        var x = e.pageX,
            y = e.pageY;
        $i.css({
            "z-index": 99999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": "#ff6651"
        });
        $("body").append($i);
        $i.animate({
                "top": y - 180,
                "opacity": 0
            },1500,
            function() {
                $i.remove();
            });
    });
    model = /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ? "mobile" :"fixed"  ;  
    $.ajax({
         url: host+"img/background-img/"+model+"/res.json",//json文件位置
         type: "GET",//请求方式为get
         dataType: "json", //返回数据格式为json
         error : function() {
             //alert("未找到,请联系站长");
         },
         success: function(dataType) {
             //max=$.parseJSON(JSON.stringify(dataType));
             //max=max.MaxCount
    
            target=$.parseJSON(JSON.stringify(dataType));
            var sum=0,count=0;
             for(key in target)
                 sum+=target[key];
             var temp=0;
             var i=0;
             for(key in target)//产生几率、图片类型、图片数量
             {
                 res[i]=new Object();
                 res[i].probability=(target[key]/sum)+temp;
                 temp=res[i].probability;
                 res[i].typ=key;
                 res[i].num=target[key];
                 i++;
             }
 //    //console.log(res);
            getImg("#backgroundImg1");
			getThemeByDivName("#backgroundImg1");
            $("#backgroundImg2").animate().fadeOut(1);
            getImg("#backgroundImg2");
         }, 
	 error:function(){console.log("cant resolve res.json");}
     });

    //定时更换背景
     setInterval(
     	 "divChange()",waittingTime
     ); //单位毫秒
    audioConstruct();

});

function audioConstruct() {
    var targetPhp=host+"util/BgmNum.php";
    
	//加载本地文件
    $.get(targetPhp).success(function(content){
        bgmNum=content;
        audio.loop = false;
        //一开始对文件没有约束条件
        setMusic(-1);
        //播放结束时间
        audio.addEventListener('ended', function () {
            //得到上一次播放的音频号
            var temp=audio.src.split('/');
            temp=temp[temp.length-1];
            var last=temp.split('.')[0];
            //console.log("last="+last);
            setMusic(last);
	    var temp=audio.src.split('/');
	    temp=temp[temp.length-1];
            clearList();
        }, false);
    });

}

function  setMusic(last) {
    do
        var target=Math.floor(Math.random()*bgmNum);
    while(target==last);
    //if(target==0) console.log("no bgm");
    //else 
	musicPlay(target);
}

function musicPlay(target) {
    audio.src=host+"bgm/mp3/"+target+".mp3";
    if(debug) console.log("got it:"+target+".mp3");
}

function getImg(str){
    var number=parseInt(Math.random() * 1000);
    number/=1000;
    for (key in res)
    {
        if(number<res[key].probability)
        {
            var id=parseInt(number * res[key].num);
	    //getTheme(id+'.'+res[key].typ);
            $(str).css("background-image","url("+host+"img/background-img/"+model+"/"+res[key].typ+"/"+id+"."+res[key].typ+")");
            // $(".content:after").css("background-image","url(../img/background-img/"+number+".jpg)");     
            if(debug) console.log("got it:"+id+"."+res[key].typ);
            break;
        }
    }
}
function getTheme(imgName){
    $.ajax({
        url: "MyPage/util/GetTheme.php",
        type: "post",
	data: "name="+imgName,
	dataType: "text",
	// data: {dt: $("#dt").val(), tm: $("#tm").val() },
	success: function (data){console.log('get '+data);$("body").css("background-color","rgb"+data);},
	error: function(){console.log("error at get theme");}
    });
	// .done(function( o ) {
	// // do something
	// });
	// process = fn.zTree.Process(vr=treeNode.name,is_template= true, status="aaa");
	// process.save();
        
}

function getThemeByDivName(div)
{
	var imgName=$(div).css("background-image");
	imgName=imgName.split('/');
	imgName=imgName[imgName.length-1];
	imgName=imgName.split('"')[0];
	getTheme(imgName);
}

function divChange(){
    if(imgFlag)
    {
        //getImg("#backgroundImg1");        
		getThemeByDivName("#backgroundImg1");
        $("#backgroundImg2").fadeOut(1000,function(){getImg("#backgroundImg2");});
        $("#backgroundImg1").fadeIn(1000);
        //getImg("#backgroundImg2");
    }else{
        //getImg("#backgroundImg2");
		getThemeByDivName("#backgroundImg2");
        $("#backgroundImg1").fadeOut(1000,function(){getImg("#backgroundImg1");});
        $("#backgroundImg2").fadeIn(1000);
        //getImg("#backgroundImg1");
    }
    imgFlag=!imgFlag;
    // if(!imgFlag)
    // {
    //     var wValue=rate * $("#backgroundImg1").width();  
    //     var hValue=rate * $("#backgroundImg1").height();  
    //     $("#backgroundImg2").animate(
    //     {
    //         width: 0.8333333 * $("#backgroundImg2").width(), 
    //         height: 0.8333333 * $("#backgroundImg2").width(), 
    //         left:"0px", 
    //         top:"0px"
    //     }, 1); 
    //     $("#backgroundImg1").animate(
    //     {
    //         width: wValue,
    //         height: hValue,  
    //         left:-((rate-1) * $("#backgroundImg1").width()/2),  
    //         top:-((rate-1) * $("#backgroundImg1").height()/2)
    //     }, waittingTime);    
    // }else{
    //     var wValue=rate * $("#backgroundImg2").width();  
    //     var hValue=rate * $("#backgroundImg2").height();  

    //     $("#backgroundImg1").animate(
    //     {
    //         width: 0.8333333 * $("#backgroundImg1").width(), 
    //         height: 0.8333333 * $("#backgroundImg1").width(), 
    //         left:"0px", 
    //         top:"0px"
    //     }, 1); 
    //     $("#backgroundImg2").animate(
    //     {
    //         width: wValue,
    //         height: hValue,  
    //         left:-((rate-1) * $("#backgroundImg2").width()/2),  
    //         top:-((rate-1) * $("#backgroundImg2").height()/2)
    //     }, waittingTime);            
    // }

        
}
