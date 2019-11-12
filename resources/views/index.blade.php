<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <title>异常提示</title>
</head>

<body>
    <h1 id='note'></h1>

    <button id="clears">取消标题闪烁</button>
</body>
<script>


    var msg = {
        time: 0,
        title: document.title,
        timer: null,
        //显示新消息提示
        show: function () {
            var title = msg.title.replace("", "").replace("【您有新消息】", "");
            //定时器，此处产生闪烁
            //由于定时器无法清除，在此调用之前先主动清除一下定时器打到缓冲效果，否则定时器效果叠加标题闪烁频率越来越快
            clearTimeout(msg.timer);
            msg.timer = setTimeout(function () {
                msg.time++;
                msg.show();
                if (msg.time % 2 == 0) {
                    document.title = "【您有新消息】" + title
                } else {
                    document.title = title
                };
            }, 300);
            return [msg.timer, msg.title];
        },
        //取消新消息提示
        //此处起名最好不要用clear，由于关键字问题有时可能会无效
        clears: function () {
            clearTimeout(msg.timer);
            document.title = "警告";
        }
    }
    
    function getCount() {
        $.get("/api/count", function (data, status) {
            $("#note").text('未处理:' + data.count);
        });
    }
    getCount();


    ws = new WebSocket("ws://"+"{{ $socket_url }}");
    ws.onopen = function() {
    };
    ws.onmessage = function(e) {
        var param=JSON.parse(e.data);
        if(param.mode=='note'){
            $("#note").text('未处理:' + param.count);
            msg.clears();
            msg.show();
        }
    };


    $("#clears").click(function () {
        msg.clears();
    });

    
</script>

</html>