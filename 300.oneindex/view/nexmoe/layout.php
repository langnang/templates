<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
  <title><?php e($title . ' - ' . config('site_name')); ?></title>
  <link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.1/css/mdui.css">
  <link rel="Shortcut Icon" type="image/x-icon" href="/favicon.ico">
  <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <link class="dplayer-css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.css">
  <style>
    body {
      background-color: #f2f5fa;
      padding-bottom: 60px;
      background-position: center bottom;
      background-repeat: no-repeat;
      background-attachment: fixed
    }

    audio:focus {
      border: 0;
      outline: 0;
    }

    /* 设置滚动条的样式 */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    /* 滚动槽 */
    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset006pxrgba(0, 0, 0, 0.3);
      border-radius: 10px;
    }

    /* 滚动条滑块 */
    ::-webkit-scrollbar-thumb {
      border-radius: 10px;
      background: rgba(0, 0, 0, 0.1);
      -webkit-box-shadow: inset006pxrgba(0, 0, 0, 0.5);
    }

    ::-webkit-scrollbar-thumb:window-inactive {
      background: rgba(255, 0, 0, 0.4);
    }

    .nexmoe-item {
      margin: 20px -8px 0 !important;
      padding: 15px !important;
      border-radius: 5px;
      background-color: #fff;
      -webkit-box-shadow: 0 .5em 3em rgba(161, 177, 204, .4);
      box-shadow: 0 .5em 3em rgba(161, 177, 204, .4);
      background-color: #fff
    }

    .mdui-img-fluid,
    .mdui-video-fluid {
      border-radius: 5px;
      border: 1px solid #eee
    }

    .mdui-list {
      padding: 0
    }

    .mdui-list-item {
      margin: 0 !important;
      border-radius: 5px;
      padding: 0 10px 0 5px !important;
      border: 1px solid #eee;
      margin-bottom: 10px !important
    }

    .mdui-list-item:last-child {
      margin-bottom: 0 !important
    }

    .mdui-list-item:first-child {
      border: none
    }

    .mdui-toolbar {
      width: auto;
      margin-top: 30px !important
    }

    .mdui-appbar .mdui-toolbar {
      height: 56px;
      font-size: 16px
    }

    .mdui-toolbar>* {
      padding: 0 6px;
      margin: 0 2px;
      opacity: .5
    }

    .mdui-toolbar>.mdui-typo-headline {
      padding: 0 16px 0 0
    }

    .mdui-toolbar>i {
      padding: 0
    }

    .mdui-toolbar>a:hover,
    a.mdui-typo-headline,
    a.active {
      opacity: 1
    }

    .mdui-container {
      max-width: 1280px
    }

    .mdui-list>.th {
      background-color: initial
    }

    .mdui-list-item>a {
      width: 100%;
      line-height: 48px
    }

    .mdui-toolbar>a {
      padding: 0 16px;
      line-height: 30px;
      border-radius: 30px;
      border: 1px solid #eee
    }

    .mdui-toolbar>a:nth-last-child(2) {
      opacity: 1;
      background-color: #1e89f2;
      color: #ffff
    }

    @media screen and (max-width: 1280px) {
      .mdui-container {
        width: 100% !important;
        margin: 0
      }
    }


    @media screen and (max-width: 980px) {
      .mdui-list-item .mdui-text-right {
        display: none
      }

      .mdui-toolbar>* {
        display: none
      }

      .mdui-toolbar>a:last-child,
      .mdui-toolbar>.mdui-typo-headline,
      .mdui-toolbar>i:first-child {
        display: block
      }
    }

    .mdui-textfield {
      display: none;
    }

    .upload_file {
      position: relative;
      display: block;
      margin: -14px;
      /* border: 1px solid #99D3F5; */
      /* border-radius: 4px; */
      padding: 20px 0px;
      overflow: hidden;
      color: #1E88C7;
      opacity: .8;
      text-decoration: none;
      text-indent: 0;
      line-height: 20px;
      text-align: center;
    }

    .upload_file input {
      position: absolute;
      font-size: 100px;
      right: 0;
      top: 0;
      opacity: 0;
    }

    .upload_file:hover {
      color: #1E88C7;
      text-decoration: none;
    }

    [class^=fa] {
      font-size: 24px;
    }
  </style>
  <script src="//cdnjs.loli.net/ajax/libs/mdui/0.4.1/js/mdui.min.js"></script>

</head>

<body class="mdui-theme-primary-blue-grey mdui-theme-accent-blue">
  <div class="mdui-container">
    <div class="mdui-container-fluid">
      <div class="mdui-toolbar nexmoe-item">
        <a href="./"><i class="mdui-icon material-icons">home</i></a>

        <?php foreach ((array)$navs as $n => $l) : ?>
          <?php if ($n !== '/') : ?>
            <i class="mdui-icon material-icons mdui-icon-dark" style="margin:0;">chevron_right</i>
            <a href="<?php e($l); ?>"><?php e($n); ?></a>
          <?php endif; ?>
        <?php endforeach; ?>
        <a href="./?/admin" style="margin-left: auto;"><i class="mdui-icon material-icons">account_circle</i></a>
      </div>
      <div class="nexmoe-item" style="display: none;">
        <div class="mdui-center" id="dplayer"></div>
      </div>
      <div class="nexmoe-item" style="display: none;">
        <audio class="mdui-center" id="audio" src="" controls autoplay style="width: 100%;" poster=""></audio>
      </div>
      <?php if ($_COOKIE['admin'] == md5(config('password') . config('refresh_token'))) : ?>
        <div class="nexmoe-item" style="display: none;">
          <div class="mdui-center">
            <a href="javascript:;" class="upload_file">
              <i class="mdui-icon material-icons" style="font-size: 96px;">add_circle_outline</i>
              <input type="file" name="" id="">
            </a>
          </div>
        </div>
      <? endif ?>

    </div>
    <?php view::section('content'); ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script>

  <script>
    $(".upload_file").on("change", "input[type='file']", function() {
      var filePath = $(this).val();
      console.log(filePath)
      if (filePath.indexOf("jpg") != -1 || filePath.indexOf("png") != -1) {
        $(".fileerrorTip").html("").hide();
        var arr = filePath.split('\\');
        var fileName = arr[arr.length - 1];
        $(".showFileName").html(fileName);
      } else {
        $(".showFileName").html("");
        $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
        return false
      }
    })

    var dp = new DPlayer({
      autoplay: true,
      container: document.getElementById('dplayer'),
      lang: 'zh-cn',
      video: {
        type: 'auto'
      }
    });
    var dp_next_index = null;
    dp.on('ended', function() {
      if (!dp_next_index) {
        dp.pause();
        return;
      }
      $(".mdui-list-item.file.mdui-ripple>a").eq(dp_next_index)[0].click()
    });
    var audio = $("#audio")[0];
    var audio_next_index = null;
    audio.addEventListener('ended', function() {
      if (!audio_next_index) {
        audio.pause();
        return;
      }
      $(".mdui-list-item.file.mdui-ripple>a").eq(audio_next_index)[0].click()
    }, false);

    function play_video() {
      $(".mdui-list-item.file.mdui-ripple").removeClass("mdui-list-item-active");
      $(this).parent().addClass("mdui-list-item-active");
      $("#dplayer").parent().css("display", "block");

      const type = $(this).attr("data-type")
      const key = $(this).attr("data-key");
      const url = $(this).attr("data-url");
      const els = $(".mdui-list-item.file.mdui-ripple>a[data-type=" + type + "]");
      const list = $(".mdui-list-item.file.mdui-ripple>a");
      const index = els.index(this);
      if (index == els.length - 1) {
        dp_next_index = null;
      } else {
        dp_next_index = list.index(els.eq(index + 1)[0]);
      }
      dp.switchVideo({
        url
      });
      dp.play();
    }

    function play_audio() {
      $(".mdui-list-item.file.mdui-ripple").removeClass("mdui-list-item-active");
      $(this).parent().addClass("mdui-list-item-active");
      $("#audio").parent().css("display", "block");

      const type = $(this).attr("data-type")
      const key = $(this).attr("data-key");
      const url = $(this).attr("data-url");
      const els = $(".mdui-list-item.file.mdui-ripple>a[data-type=" + type + "]");
      const list = $(".mdui-list-item.file.mdui-ripple>a");
      const index = els.index(this);
      if (index == els.length - 1) {
        audio_next_index = null;
      } else {
        audio_next_index = list.index(els.eq(index + 1)[0]);
      }
      audio.setAttribute("src", url);
    }
  </script>
</body>

</html>