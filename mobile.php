<html>
    <?php
        define('BASE_DIR', dirname(__FILE__));
        require_once(BASE_DIR.'/config.php');
        $config = array();
        $config = readConfig($config, CONFIG_FILE1);
        $config = readConfig($config, CONFIG_FILE2);
        $mjpegmode = 0;
        if(isset($_COOKIE["stream_mode"])) {
            if($_COOKIE["stream_mode"] == "MJPEG-Stream") {
                $streamButton = "Default-Stream";
                $mjpegmode = 1;
            }
        }
        $video_fps = $config['video_fps'];
        $divider = $config['divider'];
        $show_streaming = $_GET['action'] == 'stream'
    ?>
    <head>
        <title>Oculus</title>
        <link rel="stylesheet" href="css/style_minified.css" />
        <style>
            body {
                margin: 0;
                padding: 0;
            }

            #mjpeg_dest {                
		        height: 100%;
		        width: 100%;
		        object-fit: cover;
            }

            #main-buttons {
                bottom: 5%;
                position: absolute;
                text-align: center;
                width: 100%;
            }

            #preview_select, #timelapse_button {
                display: none;
            }

            #streaming_button {
                left: 50%;
                position: absolute;
                top: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
        <script src="js/script.js"></script>
    </head>
    <?php if ($show_streaming) { ?>
    <body onload="setTimeout('init(<?php echo " $mjpegmode, $video_fps, $divider" ?>);', 100);">
    <div id="preview_select"></div>
    <img id="mjpeg_dest" src="./loading.jpg">
    <div id="main-buttons">
        <input id="video_button" type="button" class="btn btn-primary">
        <input id="image_button" type="button" class="btn btn-primary">
        <input id="timelapse_button" type="button" class="btn btn-primary">
        <input id="md_button" type="button" class="btn btn-primary">
        <input id="halt_button" type="button" class="btn btn-danger">
        <input id="halt_streaming_button" type="button" class="btn btn-danger" value="stop streaming" onclick="window.location='/mobile.php';">
    </div>
    </body>
    <?php } else { ?>
    <body>
        <div id="streaming_button">
            <input id="halt_streaming_button" type="button" class="btn btn-primary" value="start streaming" onclick="window.location='/mobile.php?action=stream';">
        </div>
    </body>
    <?php } ?>
</html>
