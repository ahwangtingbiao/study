<?php
include('inc/function.php');

delFile('up/');
?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>SWFUpload Demos - Simple Demo</title>
		<link href="css/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="swfupload/swfupload.js"></script>
		<script type="text/javascript" src="swfupload/swfupload.queue.js"></script>
		<script type="text/javascript" src="js/fileprogress.js"></script>
		<script type="text/javascript" src="js/handlers.js"></script>
		<script type="text/javascript">
			var swfu;

			window.onload = function() {
				var settings = {
					flash_url: "swfupload/swfupload.swf",
					flash9_url: "swfupload/swfupload_fp9.swf",
					upload_url: "upload.php",
					//				post_params: {
					//					"PHPSESSID": "<?php echo session_id(); ?>"
					//				},
					file_size_limit: "1 MB",
					file_types: "*.png;*.gif",
					file_types_description: "选择图片",
					file_upload_limit: 72,
					file_queue_limit: 0,
					custom_settings: {
						progressTarget: "fsUploadProgress",
						cancelButtonId: "btnCancel"
					},
					debug: false,

					// Button settings
					button_image_url: "images/TestImageNoText_65x29.png",
					button_width: "65",
					button_height: "29",
					button_placeholder_id: "spanButtonPlaceHolder",
					button_text: '<span class="theFont">选择</span>',
					button_text_style: ".theFont { font-size: 12; }",
					button_text_left_padding: 18,
					button_text_top_padding: 3,

					// The event handler functions are defined in handlers.js
					swfupload_preload_handler: preLoad,
					swfupload_load_failed_handler: loadFailed,
					file_queued_handler: fileQueued,
					file_queue_error_handler: fileQueueError,
					file_dialog_complete_handler: fileDialogComplete,
					upload_start_handler: uploadStart,
					upload_progress_handler: uploadProgress,
					upload_error_handler: uploadError,
					upload_success_handler: uploadSuccess,
					upload_complete_handler: uploadComplete,
					queue_complete_handler: queueComplete // Queue plugin event					

				};

				swfu = new SWFUpload(settings);
			};

			function file_dialog_start_function() {

			}

		</script>
	</head>

	<body>

		<div id="content">
			<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
				<div class="fieldset flash" id="fsUploadProgress">
					<span class="legend">上传表情</span>
				</div>
				<div id="divStatus"></div>
				<div>
					<span id="spanButtonPlaceHolder"></span>
					<input id="btnCancel" type="button" value="取消上传" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
				</div>

			</form>
		</div>
	</body>

	</html>
