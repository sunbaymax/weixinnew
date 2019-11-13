$(function () {
    /*
     luckyNum为每次抽几人
     luckyResult为抽奖结果的集合（数组）
     luckyNum为5那么luckyResult的length也为5
     */
    var Obj = {};
    Obj.luckyResult = [];
    Obj.luckyPrize = '';
    Obj.luckyNum = $(".select_lucky_number").val();
    var isClick = true;
//  $(".loader_file").text('抽奖已结束！')
//  return false;

    /*
     一次抽几人改变事件
     */
    // $(".select_lucky_number").bind('change', function () {
    //     Obj.luckyNum = $(this).val();
    // })
    /*
     图片预加载
     */
    function loadImage(arr, callback) {
        var loadImageLen = 1;
        var arrLen = arr.length;
        $('.all_number').html("/" + arrLen);
        for (var i = 0; i < arrLen; i++) {
            var img = new Image(); //创建一个Image对象，实现图片的预下载
            img.onload = function () {
                img.onload = null;
                ++loadImageLen;
                $(".current_number").html(loadImageLen);
                if (loadImageLen == arrLen) {
                    callback(img); //所有图片加载成功回调；
                };
            }
            img.src = arr[i].image;
        }
    }

    /*
     把3D动画初始化，等待执行
     personArray为本地引入数据
     */
    Obj.M = $('.container').lucky({
        row: 7, //每排显示个数  必须为奇数
        col: 5, //每列显示个数  必须为奇数
        depth: 5, //纵深度
        iconW: 30, //图片的宽
        iconH: 30, //图片的高
        iconRadius: 8, //图片的圆角
        data: personArray, //数据的地址数组
    });
    /*
    执行图片预加载并关闭加载试图
    */
    loadImage(personArray, function (img) {
        $('.loader_file').hide();
    });
    /*
     若为ajax请求执行这段代码
     此为为ajax请求;
     $.get('index.php',function(data){
         if(data.res == 1){
             personArray = data.data; //此为数组

             //执行图片预加载并关闭加载试图
             loadImage(personArray, function (img) {
                $('.loader_file').hide();
             })
             Obj.M = $('.container').lucky({
             row : 7, //每排显示个数  必须为奇数
             col : 7, //每列显示个数  必须为奇数
             depth : 6, //纵深度
             iconW : 30, //图片的宽
             iconH : 30, //图片的高
             iconRadius : 8, //图片的圆角
             data : personArray, //数据的地址数组
         });
         }
     })
     */

    /*
     中奖人员展示效果
     传入当前中奖数组中单个的key
     */
    function showLuckyPeople(num) {

        setTimeout(function () {
            var $luckyEle = $('<img class="lucky_icon" />');
            var $userName = $('<p class="lucky_userName"></p>');
            var $fragEle = $('<div class="lucky_userInfo"></div>');
            $fragEle.append($luckyEle, $userName);
            $('.mask').append($fragEle);
            $(".mask").fadeIn(200);
            if (Obj.luckyPrize == 3) {
                $luckyEle.attr('src', personArray[Obj.luckyResult[num]].headimgurl);
                $userName.text(personArray[Obj.luckyResult[num]].username)
            } else {
                $luckyEle.attr('src', personArray[num].headimgurl);
                $userName.text(personArray[num].username)
            }


            $fragEle.animate({
                'left': '50%',
                'top': '50%',
                'height': '200px',
                'width': '200px',
                'margin-left': '-100px',
                'margin-top': '-100px',
            }, 1000, function () {
                setTimeout(function () {
                    $fragEle.animate({
                        'height': '100px',
                        'width': '100px',
                        'margin-left': '100px',
                        'margin-top': '-50px',
                    }, 400, function () {
                        $(".mask").fadeOut(0);
                        $luckyEle.attr('class', 'lpl_userImage').attr('style', '');
                        $userName.attr('class', 'lpl_userName').attr('style', '');
                        $fragEle.attr('class', 'lpl_userInfo').attr('style', '');
                        $('.lpl_list.active').append($fragEle);
                    })
                }, 1000)
            })
        }, num * 2500)
        setTimeout(function () {
            $('.lucky_list').show();
        }, 2500)
    }

    /*
     停止按钮事件函数
     */
    $('#stop').click(function () {
        Obj.M.stop();
        $(".container").hide();
        $(this).hide();
        var i = 0;
        var setArr = [];
        var openArr = [];  // 存放三等奖名单  openid
        if (Obj.luckyNum == 3) {
        	// 三等奖
            // console.log(personArray,222);
            // console.log(Obj.luckyResult)
            for (; i < Obj.luckyResult.length; i++) {
                setArr.push(personArray[Obj.luckyResult[i]].id);
                openArr.push(personArray[Obj.luckyResult[i]].openid);
                showLuckyPeople(i);
                
            }
            setLucky(setArr);
            console.log(openArr,'三等奖');
        } else if(Obj.luckyNum == 2){
			// 二等奖
			console.log(personArray,'二等奖');
            for (; i < personArray.length; i++) {
                showLuckyPeople(i);
            }

        }else{
        	// 一等奖
        	console.log(personArray,'一等奖');
        	 for (; i < personArray.length; i++) {
                showLuckyPeople(i);
            }
        }
        isClick = false;
        
        
        
        

    })
    //中奖结果消息推送
//  function sentMessage(draw,openid){
//  	$.ajax({
//  		type:"post",
//  		url:"http://www.ccsc58.cc/weixinnew/last8_28.php",
//          data:{
//          	first:""
//          },
//  	});
//  }
    
    /*
     开始按钮事件函数
     */
    getLucky('三等奖');
    $('#open').click(function () {
        if(isClick){
            Obj.luckyNum = $(".select_lucky_number").val();
            $('.lucky_list').hide();
            $(".container").show();
            Obj.M.open();
            if (Obj.luckyNum == 3) {
                //此为人工写入获奖结果
                randomLuckyArr();
    
                //人工获奖结果结束
            } else if (Obj.luckyNum == 2) {
                getLucky('二等奖');
                //此为ajax请求获奖结果
                //$.get('luckyNum.php',{luckyNum : Obj.luckyNum,luckyPrize:Obj.luckyPrize},function(data){
                //	  if(data.res == 1){
                //		  Obj.luckyResult = data.luckyResult;
                //        $("#stop").show(500);
                //	  }
                //})
                //ajax获奖结果结束
            } else {
                getLucky('一等奖');
            }
            setTimeout(function () {
                $("#stop").show(500);
            }, 1000)
        }
    })

    /*
     前端写中奖随机数
     */
    function randomLuckyArr() {
        console.log(personArray);
        Obj.luckyResult = [];
        for (var i = 0; i < Obj.luckyNum; i++) {
            var random = Math.floor(Math.random() * personArray.length);

            if (Obj.luckyResult.indexOf(random) == -1) {
                Obj.luckyResult.push(random)
                // 一等奖   二等奖  三等奖
                // console.log(Obj);
            } else {
                i--;
            }
        }
    }

    /*
     切换奖品代码块
     */
    function tabPrize() {
        
        var luckyDefalut = $(".lucky_prize_picture").attr('data-default');
        var index = luckyDefalut ? luckyDefalut : 1;
        tabSport(index, 3);
        var lucky_prize_number = $('.lucky_prize_show').length;
        $('.lucky_prize_left').click(function () {
            isClick = true;
            $('.lucky_prize_right').addClass('active');
            index <= 1 ? 1 : --index;
            tabSport(index, lucky_prize_number);
        })
        $('.lucky_prize_right').click(function () {
//          isClick = true;
            isClick = false;
            $('.lucky_prize_left').addClass('active');
            index >= lucky_prize_number ? lucky_prize_number : ++index;
            tabSport(index, lucky_prize_number);
        })

    }

    /*
     切换奖品左右按钮公共模块
     */
    function tabSport(i, lucky_prize_number) {
        if (i >= lucky_prize_number) {
            $('.lucky_prize_left').addClass('active');
            $('.lucky_prize_right').removeClass('active');
        }
        if (i <= 1) {
            $('.lucky_prize_left').removeClass('active');
        }
        Obj.luckyPrize = i;
        $('.lucky_prize_show').hide().eq(i - 1).show();
        $(".lucky_prize_title").html($('.lucky_prize_show').eq(i - 1).attr('alt'));
        $('.lpl_list').removeClass('active').hide().eq(i - 1).show().addClass('active');
        if (i == 1) {
            $(".select_lucky_number").val(1);
            getLuckyList('一等奖');
        } else if (i == 2) {
            $(".select_lucky_number").val(2);
            getLuckyList('二等奖');
        } else {
            $(".select_lucky_number").val(3);
            getLuckyList('三等奖');
        }
    }
    tabPrize();

    /**
     * 给后台 发送三等奖名单

     */
    function setLucky(sta) {
        $.ajax({
            url: "http://www.zjcoldcloud.com/weixin_lucky/site_lucky.php",
            type: "post",
            data: {
                id: sta.join(",")
            },
            dataType: "JSON",
            success: function (res) {
                // console.log(res);
            },
            error: function (err) {
                console.log(err);
            }
        })
    }
    /** 
     * 读取中奖名单  内定
     */
    function getLucky(sta) {
        personArray = [];
        $.ajax({
            url: "http://www.zjcoldcloud.com/weixin_lucky/site_winner.php",
            type: "post",
            data: {
                draw: sta
            },
            dataType: "JSON",
            success: function (res) {
                var data = res.data;
                personArray = data;
                // $(".lucky_number").text(data.length);
            },
            error: function (err) {
                console.log(err);
            }
        })
    }
    /**
     * 读取中奖列表
     */
    function getLuckyList(sta) {
        $.post("http://www.zjcoldcloud.com/weixin_lucky/site_list.php", {
            draw: sta
        }, function (res) {
            var data = res.data;
            $(".lucky_number").text(data.length);
        }, "JSON")
    }
    /**
     * 导出
     * 
     */
    var importArr = [];
    $(".isExport").click(function () {
        $.post("http://www.zjcoldcloud.com/weixin_lucky/admin_setting.php", {
            draw: 1
        }, function (res) {
            var data = res.data;
			if(data.length==0){
				alert("没有抽奖数据");
				return false;
			}
            data.forEach((item, index) => {
                var obj = {
		                    姓名: item.nickname,
		                    电话: item.telphone,
		                    公司: item.company,
		                    所中奖项: item.draw
                }
                importArr.push(obj);

            });
            downloadExl(importArr);
        }, "JSON")
    })
    var tmpDown; //导出的二进制对象
    function downloadExl(json, type) {
        var tmpdata = json[0];
        json.unshift({});
        var keyMap = []; //获取keys
        for (var k in tmpdata) {
            keyMap.push(k);
            json[0][k] = k;
        }
        var tmpdata = []; //用来保存转换好的json 
        json.map((v, i) => keyMap.map((k, j) => Object.assign({}, {
            v: v[k],
            position: (j > 25 ? getCharCol(j) : String.fromCharCode(65 + j)) + (i + 1)
        }))).reduce((prev, next) => prev.concat(next)).forEach((v, i) => tmpdata[v.position] = {
            v: v.v
        });
        var outputPos = Object.keys(tmpdata); //设置区域,比如表格从A1到D10
        var tmpWB = {
            SheetNames: ['mySheet'], //保存的表标题
            Sheets: {
                'mySheet': Object.assign({},
                    tmpdata, //内容
                    {
                        '!ref': outputPos[0] + ':' + outputPos[outputPos.length - 1] //设置填充区域
                    })
            }
        };
        tmpDown = new Blob([s2ab(XLSX.write(tmpWB, {
                bookType: (type == undefined ? 'xlsx' : type),
                bookSST: false,
                type: 'binary'
            } //这里的数据是用来定义导出的格式类型
        ))], {
            type: ""
        }); //创建二进制对象写入转换好的字节流
        var href = URL.createObjectURL(tmpDown); //创建对象超链接
        document.getElementById("hf").href = href; //绑定a标签
        document.getElementById("hf").click(); //模拟点击实现下载
        setTimeout(function () { //延时释放
            URL.revokeObjectURL(tmpDown); //用URL.revokeObjectURL()来释放这个object URL
        }, 100);
    }

    function s2ab(s) { //字符串转字符流
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    // 将指定的自然数转换为26进制表示。映射关系：[0-25] -> [A-Z]。
    function getCharCol(n) {
        let temCol = '',
            s = '',
            m = 0
        while (n > 0) {
            m = n % 26 + 1
            s = String.fromCharCode(m + 64) + s
            n = (n - m) / 26
        }
        return s
    }
})