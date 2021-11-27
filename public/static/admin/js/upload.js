
function showVideoUploadBox(obj) { //显示上传弹出层
    var left = obj.offset().left;
    var top = obj.offset().top + 26;
    var z_index_init = 1000;
    if ($("#post_box").css("display") == 'block') {
        z_index_init = 3000;
    }
    $("#photo_upload_box_outside").css({"z-index": z_index_init});

    $("#video_box_outside").css({"left": left, "top": top, "z-index": z_index_init + 1}).show();
    $("#video_upload_area").show();
    $("#video_loading,#video_success").hide();
    reupload_video();
}
function reupload_video() { //重新上传
    $('#video_upload_btn').show();
    $('#video_name_box').hide();
    $("#upload_video_area").show().addClass("disabled");
    $("#video_text").val("");
    $("#video_words_num").text(0);
    $("#video_success").hide();
    $("#video_file,#video_name").val("");
}

function checkVideoText(value) {
    var length = value.length;
    var other = 130 - length;
    if (length > 0) {
        $("#video_words_num").html(other);
    } else {
        $("#video_words_num").html("<span class='red'>" + other + "</span>");
    }
}
function video_upload_cancel() {  //取消上传
    uploader_video.stop();
    $("#video_loading,#video_name_box").hide();
    $("#video_upload_area,#video_upload_btn").show();
    $("#upload_video_area").show();
    $("#upload_video").addClass("disabled");
    $("#video_text").val("");
    $("#video_words_num").text(0);
    $("#video_success").hide();
    $("#video_file,#video_name").val("");
    var file_id = $("#video_iput").attr("file_id");
    var obj_file = uploader_video.getFile(file_id);
    uploader_video.removeFile(obj_file);
}
