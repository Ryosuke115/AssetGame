<!DOCTYPE html>
<html lang="ja">
    <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-wodth, initial-scale=1">
    
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>あめざらし</title>
     <!--<link href="{{ asset('css/core.css') }}" rel="stylesheet">  --> 
    </head>
    <body id="app" onload="timer=setInterval('window.location.reload(true)', 11000)">
        <p>{{ $testY + 20 }}</p>
        <p>{{ $testX }}</p>
        
        <canvas id="canvas" height="1500" width="800" style="border:inset 5px #99ffff"></canvas>
        
        
        <script type="text/javascript">
        (function() {
            var zeroX = 0;
            var zeroY = 0;
            var plusX = '<?php echo $testX; ?>';
            var plusY = '<?php echo $testY; ?>';
            var pastX = '<?php echo $pastX; ?>';
            var pastY = '<?php echo $pastY; ?>';
            
            var httpRequest;
            window.addEventListener('load', makeRequest);
            
            function makeRequest() {
               httpRequest = new XMLHttpRequest();
                
               if(!httpRequest) {
                  alert('中断します:XMLhttpインスタンスを生成できませんでした。');
                    return false;
                }
                httpRequest.onreadystatechange = loadGraph;
                httpRequest.open('GET',"/test");
                httpRequest.send();
            }
            
            function loadGraph() {
                try {
                    if (httpRequest.readyState === XMLHttpRequest.DONE) {
                        if (httpRequest.status === 200) {
                            var canvas = document.getElementById('canvas');
                            
                            
                            
                            
                            
                         if (plusX <= 5) {
                            if (canvas.getContext) {
                                var ctx = canvas.getContext('2d');
                                
                                
                                
                                ctx.beginPath();
                                ctx.moveTo(0, 0);
                                ctx.lineTo(plusX, plusY);
                                ctx.closePath();
                                ctx.stroke();
                                
                                
                              } else {
                                  
                                  if (canvas.getContext) {
                                      var ctx = canvas.getContext('2d');
                                      ctx.beginPath();
                                      ctx.moveTo(pastX, pastY);
                                      ctx.lineTo(plusX, plusY);
                                      ctx.closePath();
                                      ctx.stroke();
                                  }
                              }
                            }
                        }
                    }
                } catch (e) {
                    alert('例外を補足しました' + e.description);
                }
            }
            
        })();
        </script>
    </body>
</html>