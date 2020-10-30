<!DOCTYPE html>
<html lang="ja">
    <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-wodth, initial-scale=1">
    
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>あめざらし</title>
     <!--<link href="{{ asset('css/core.css') }}" rel="stylesheet">  --> 
    </head>
    
   <!-- <body>
     <div id="app">
         <button id="ajaxButton" type="button">実行する</button>
         <canvas id="canvas" height="400" width="700"></canvas>
     </div> 
        
        <script type="text/javascript">
         (function() {
             var asset_sum = '<//?php echo $asset_point; ?>';
             var httpRequest;
             document.getElementById("ajaxButton").addEventListener('click', makeRequest);
             
             function makeRequest() {
                 httpRequest = new XMLHttpRequest();
                 
                 if (!httpRequest) {
                     alert('中断します :XMLHTTPインスタンスを生成できませんでした');
                     return false;
                 }
                 httpRequest.onreadystatechange = graphDraw;
                 httpRequest.open('GET', "/test");
                 httpRequest.send();
             }
             
             function graphDraw() {
                 try {
                     if (httpRequest.readyState === XMLHttpRequest.DONE) {
                         if (httpRequest.status === 200) {
                             //
                             alert(asset_sum);
                             
                         }else {
                             alert('エラーが発生しました');
                         }
                     }
                 } catch (e) {
                     alert('例外を補足しました' + e.description);
                 }
             }
             
         })();
        </script>
    </body>-->
    
    
    <body id="app" onload="timer=setInterval('location.reload()', 10000)">
    
    
     <canvas id="canvas" height="500" width="800" style="border:inset 5px #ff0000"></canvas>
        
        <script type="text/javascript">
         (function() {
             
             var pastX = 0;
             var pastY = 0;
             
             var httpRequest;
             window.addEventListener('load', makeRequest);
             
             function makeRequest() { 
             httpRequest= new XMLHttpRequest();
             if (!httpRequest) {
                 alert('中断します:XMLHttpインスタンスを生成できませんでした。');
                 return false;
              }
             httpRequest.onreadystatechange = readGraph;
             httpRequest.open('GET', "/test");
             httpRequest.send();
             }
             
             function readGraph() {
                 try {
                     if (httpRequest.readyState === XMLHttpRequest.DONE) {
                         if (httpRequest.status === 200) {
                             var canvas = document.getElementById('canvas');
                             
                             var writeY = '<?php echo $asset_point; ?>';
                        
                             if (!writeX) {
                                 if(canvas.getContext) {
                                 var writeX = 5;
                                 var ctx = canvas.getContext('2d');
                                 
                                 ctx.beginPath();
                                 ctx.moveTo(pastX, pastY);
                                 ctx.lineTo(writeX, writeY);
                                 ctx.closePath();
                                 ctx.stroke();
                               }
                                 document.cookie = "name=" + 5;
                                 var cookies = document.cookie;
                                 var cookieArray = cookies.split(';');
                                 
                                 for(var c of cookieArray) {
                                     var cArray = c.split('=');
                                      if( cArray[0] == 'name') {
                                          pastX = cArray;
                                          writeX += 5;
                                          document.cookie = "name=" + writeX;
                                      }
                                 }
                             } else {
                                 if(canvas.getContext) {
                                 ctx.beginPath();
                                 ctx.moveTo(pastX, pastY);
                                 ctx.lineTo(writeX, writeY);
                                 ctx.closePath();
                                 ctx.stroke();
                                 }
                                 
                                 document.cookie = "name=" + pastX;
                                 var cookies = document.cookie;
                                 var cookieArray = cookies.split(';');
                                 
                                 for(var c of cookieArray) {
                                     var cArray = c.split('=');
                                      if( cArray[0] == 'name') {
                                          pastX = cArray;
                                          pastX += 5;
                                          document.cookie = "name=" + pastX;
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