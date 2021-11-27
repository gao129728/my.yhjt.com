var up_mst;
$(".uploadImg-box").hover(function(){
	var _this = $(this);
	up_mst = setTimeout(function(){
		if(_this.find('.imgView img').length > 0){
			_this.find('.uploadCover').fadeIn(300);
		}
		up_mst = null;
	},100)
}, function(){
	if(up_mst!=null) {clearTimeout(up_mst)};
	$(this).find('.uploadCover').fadeOut(300);
});

$(".uploadImg-box .up-img, .uploadImg-box .up-btn").click(function(){
	$(this).siblings('.imgFile').click();
});

$(".uploadImg-box .up-btn").click(function(){
	$(this).parents('.uploadCover').siblings('.imgFile').click();
});

$(".uploadImg-box .up-del").click(function(){
	var parent = $(this).parents('.uploadCover');
	parent.fadeOut(300);
	parent.siblings('.imgView').remove();
	parent.siblings('.up-img').show();
	if(parent.siblings('.input-del').length > 0){
		parent.siblings('.input-del').prop('checked', true);
	}
});

//图片上传预览 IE使用滤镜。
function previewImage(file, type)
{
	var ext = file.value.substr(file.value.length - 3).toLowerCase();

	if(typeof(type) != 'undefined' && type != ''){
		if(ext != type){
			layer.msg('图片必须是'+ type +'格式！', {icon: 5,time:1500,shade: 0.1}, function(index){
				layer.close(index);
			});
			return false;
		}
	}
	else
	{
		if (ext != "gif" && ext != "jpg" && ext != "png"){
			layer.msg('图片必须是GIF、JPG或PNG格式！', {icon: 5,time:1500,shade: 0.1}, function(index){
				layer.close(index);
			});
			return false;
		}
	}
	var MAXWIDTH  = $(file).parent().width();
	var MAXHEIGHT = $(file).parent().height();
	$(file).parent().append("<div class='imgView'></div>");
	var div = $(file).siblings('.imgView')[0];
	div.innerHTML = "<img id='img'/>";
	var img = $(file).siblings('.imgView').find('img')[0];

	if (file.files && file.files[0])
	{
		img.onload = function(){
			var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
			img.width  =  rect.width;
			img.height =  rect.height;
		};
		var reader = new FileReader();
		reader.onload = function(evt){img.src = evt.target.result;};
		reader.readAsDataURL(file.files[0]);
	}
	else //兼容IE
	{
		var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
		file.select();
		var src = document.selection.createRange().text;
		img.style.filter='progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image)';
		img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
		var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
		div.innerHTML = "<div style='margin:0 auto;position:relative;width:"+rect.width+"px;height:"+rect.height+"px;"+sFilter+src+"\"'></div>";
	}

	if($(file).siblings('.input-del').length > 0){
		$(file).siblings('.input-del').prop('checked', false);
	}
	$(file).siblings('.up-img').hide();
}








function clacImgZoomParam( maxWidth, maxHeight, width, height ){
	var param = {width:width, height:height};
	if( width>maxWidth || height>maxHeight )
	{
		rateWidth = width / maxWidth;
		rateHeight = height / maxHeight;

		if( rateWidth > rateHeight )
		{
			param.width =  maxWidth;
			param.height = Math.round(height / rateWidth);
		}else
		{
			param.width = Math.round(width / rateHeight);
			param.height = maxHeight;
		}
	}
	return param;
}


function previewImage(file, type)
{
    var ext = file.value.substr(file.value.length - 3).toLowerCase();

    if(typeof(type) != 'undefined' && type != ''){
        if(ext != type){
            layer.msg('文件必须是'+ type +'格式！', {icon: 5,time:1500,shade: 0.1}, function(index){
                layer.close(index);
            });
            return false;
        }
    }
    else
    {
        if (ext != "gif" && ext != "jpg" && ext != "png"){
            layer.msg('图片必须是GIF、JPG或PNG格式！', {icon: 5,time:1500,shade: 0.1}, function(index){
                layer.close(index);
            });
            return false;
        }
    }
    var MAXWIDTH  = $(file).parent().width();
    var MAXHEIGHT = $(file).parent().height();
    $(file).parent().append("<div class='imgView'></div>");
    var div = $(file).siblings('.imgView')[0];
    div.innerHTML = "<img id='img'/>";
    var img = $(file).siblings('.imgView').find('img')[0];

    if (file.files && file.files[0])
    {
        img.onload = function(){
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width  =  rect.width;
            img.height =  rect.height;
        };
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;};
        reader.readAsDataURL(file.files[0]);
    }
    else //兼容IE
    {
        var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        img.style.filter='progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image)';
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        div.innerHTML = "<div style='margin:0 auto;position:relative;width:"+rect.width+"px;height:"+rect.height+"px;"+sFilter+src+"\"'></div>";
    }

    if($(file).siblings('.input-del').length > 0){
        $(file).siblings('.input-del').prop('checked', false);
    }
    $(file).siblings('.up-img').hide();
}