<?php

function alertAndGoTo($msg, $url)
{
    echo "<script>
        alert(\"$msg\");
        window.location.href = \"$url\";
    </script>";
}


function alertAndBack($msg)
{
    echo "<script>
        alert (\"$msg\");
        window.history.back(); 
    </script>"; //回到歷史紀錄的上一頁
}

function alertAndClickBack($msg)
{
    echo "
    <style>
    button {
        padding: 8px;
        padding-left: 16px;
        padding-right: 16px;
        color: #fff;
        background-color: #2660a4;
        border: none;
        border-radius: 4px;
    }
    </style>
    <button onclick=\"goBack()\">回上一頁</button>
    <script>
        alert (\"$msg\");
        function goBack(){
            window.history.back(); 
        }
    </script>"; //製作<回上一頁>的按鈕
}
