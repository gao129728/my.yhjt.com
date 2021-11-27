(function ($) {
    // 当domReady的时候开始初始化
    $(function () {
        var $wrap = $('#uploader'),
            // 图片容器
            $queue = $('<ul class="filelist"></ul>')
                .appendTo($wrap.find('.queueList')),
            // 状态栏，包括进度和控制按钮
            $statusBar = $wrap.find('.statusBar'),
            // 文件总体选择信息。
            $info = $statusBar.find('.info'),
            // 上传按钮
            $upload = $wrap.find('.uploadBtn'),
            // 没选择文件之前的内容。
            $placeHolder = $wrap.find('.placeholder'),
            $progress = $statusBar.find('.progress').hide(),
            // 添加的文件数量
            fileCount = 0,
            // 添加的文件总大小
            fileSize = 0,
            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth = 110 * ratio,
            thumbnailHeight = 110 * ratio,
            // 可能有pedding, ready, uploading, confirm, done.
            state = 'pedding',
            // 所有文件的进度信息，key为file id
            percentages = {},
            // 判断浏览器是否支持图片的base64
            isSupportBase64 = (function () {
                var data = new Image();
                var support = true;
                data.onload = data.onerror = function () {
                    if (this.width != 1 || this.height != 1) {
                        support = false;
                    }
                }
                data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                return support;
            })(),
            // 检测是否已经安装flash，检测flash的版本
            flashVersion = (function () {
                var version;

                try {
                    version = navigator.plugins[ 'Shockwave Flash' ];
                    version = version.description;
                } catch (ex) {
                    try {
                        version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                            .GetVariable('$version');
                    } catch (ex2) {
                        version = '0.0';
                    }
                }
                version = version.match(/\d+/g);
                return parseFloat(version[ 0 ] + '.' + version[ 1 ], 10);
            })(),
            supportTransition = (function () {
                var s = document.createElement('p').style,
                    r = 'transition' in s ||
                        'WebkitTransition' in s ||
                        'MozTransition' in s ||
                        'msTransition' in s ||
                        'OTransition' in s;
                s = null;
                return r;
            })(),
            // WebUploader实例
            uploader;

        if (!WebUploader.Uploader.support('flash') && WebUploader.browser.ie) {
            // flash 安装了但是版本过低。
            if (flashVersion) {
                (function (container) {
                    window['expressinstallcallback'] = function (state) {
                        switch (state) {
                            case 'Download.Cancelled':
                                layer.msg('您取消了更新！',{icon:2,time:2000,shade: 0.3});
                                break;

                            case 'Download.Failed':
                                layer.msg('安装失败！',{icon:2,time:2000,shade: 0.3});
                                break;

                            default:
                                layer.msg('安装已成功，请刷新！',{icon:2,time:2000,shade: 0.3});
                                break;
                        }
                        delete window['expressinstallcallback'];
                    };

                    var swf = './expressInstall.swf';
                    // insert flash object
                    var html = '<object type="application/' +
                        'x-shockwave-flash" data="' + swf + '" ';

                    if (WebUploader.browser.ie) {
                        html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
                    }

                    html += 'width="100%" height="100%" style="outline:0">' +
                        '<param name="movie" value="' + swf + '" />' +
                        '<param name="wmode" value="transparent" />' +
                        '<param name="allowscriptaccess" value="always" />' +
                        '</object>';

                    container.html(html);

                })($wrap);

                // 压根就没有安装。
            } else {
                $wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
            }

            return;
        } else if (!WebUploader.Uploader.support()) {
            layer.msg('Web Uploader 不支持您的浏览器！',{icon:2,time:2000,shade: 0.3});
            return;
        }

        // 实例化
        uploader = WebUploader.create({
            pick: {
                id: '#filePicker',
                multiple:false
            },
            dnd: '#dndArea',
            paste: '#uploader',
            swf: 'webUploader/Uploader.swf',
            threads:1,
            chunked: true,
            chunkSize: 2 * 1024 * 1024,
            server: '/cfwl_system.php/upload/chunkUpload',
            //runtimeOrder: 'flash',
            accept: {
                title: 'Files',
                extensions: 'rar,zip,7z,gz,mp4',
                mimeTypes: ''
            },
            thumb:false,
            resize: false,
            compress:false,
            duplicate:true,
            // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
            disableGlobalDnd: false,
            fileNumLimit:1,
            fileSizeLimit: 500 * 1024 * 1024, // 500M
            fileSingleSizeLimit: 500 * 1024 * 1024    // 500M
        });

        // 拖拽时不接受 js, txt 文件。
        uploader.on('dndAccept', function (items) {
            var denied = false,
                len = items.length,
                i = 0,
                // 修改js类型
                unAllowed = 'text/plain;application/javascript ';

            for (; i < len; i++) {
                // 如果在列表里面
                if (~unAllowed.indexOf(items[ i ].type)) {
                    denied = true;
                    break;
                }
            }
            return !denied;
        });

        // uploader.on('filesQueued', function() {
        //     uploader.sort(function( a, b ) {
        //         if ( a.name < b.name )
        //           return -1;
        //         if ( a.name > b.name )
        //           return 1;
        //         return 0;
        //     });
        // });

        uploader.on('ready', function () {
            window.uploader = uploader;
        });

        uploader.on('uploadAccept', function( file, response ) {
            if(response._raw.replace(/[\r\n]/g,"") != ""){
                //var error_obj = eval( "(" + response + ")" );
                if (typeof(response.error) != "undefined" ) {
                    // 通过return false来告诉组件，此文件上传有错。
                    layer.msg('文件上传错误！',{icon:2,time:2000,shade: 0.3});
                    return false;
                }else if(response.result == "success"){
                    $(".file-name").html(response.name);
                    handelFile(upload_data_arr[0], response.name);
                    parent.location.reload();
                    return true;
                }else{
                    return false;
                }
            };
        });

        // 当有文件添加进来时执行，负责view的创建
        function addFile(file) {
            var file_name = file.name;
            var $li = $('<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>' +
                '<p class="progress"><span></span></p>' +
                '<p class="wait">等待上传</p>' +
                '</li>'),
                $prgress = $li.find('p.progress span'),
                $wait = $li.find('p.wait'),
                $wrap = $li.find('p.imgWrap'),
                $info = $('<p class="error"></p>'),
                showError = function (code) {
                    switch (code) {
                        case 'exceed_size':
                            text = '文件大小超出';
                            break;

                        case 'interrupt':
                            text = '上传暂停';
                            break;

                        default:
                            text = '上传失败，请重试';
                            break;
                    }

                    $info.text(text).appendTo($li);
                };

            if (uploader.options.chunkSize >= file.size){
                uploader.options.chunked = false;
            }

            if (file.getStatus() === 'invalid') {
                showError(file.statusText);
            } else {
                // @todo lazyload
                $wrap.text('');
                uploader.makeThumb(file, function (error, src) {
                    var img;

                    if (error) {
                        $wrap.text('');
                        return;
                    }

                    if (isSupportBase64) {
                        img = $('<img src="' + src + '">');
                        $wrap.empty().append(img);
                    } else {
                        $wrap.text("");
                    }
                }, thumbnailWidth, thumbnailHeight);

                percentages[ file.id ] = [file.size, 0];
                file.rotation = 0;
            }

            file.on('statuschange', function (cur, prev) {
                $wait.remove();

                if (prev === 'progress') {
                    $prgress.hide().width(0);
                } else if (prev === 'queued') {
                    $li.off('mouseenter mouseleave');
                }

                // 成功
                if (cur === 'error' || cur === 'invalid') {
                    showError(file.statusText);
                    percentages[ file.id ][ 1 ] = 1;
                } else if (cur === 'interrupt') {
                    showError('interrupt');
                } else if (cur === 'queued') {
                    percentages[ file.id ][ 1 ] = 0;
                } else if (cur === 'progress') {
                    $info.remove();
                    $prgress.css('display', 'block');
                } else if (cur === 'complete') {
                    $li.append('<span class="success">上传成功</span>');
                }

                $li.removeClass('state-' + prev).addClass('state-' + cur);
            });

            $li.appendTo($queue);
        }

        // 负责view的销毁
        function removeFile(file) {
            var $li = $('#' + file.id);
            delete percentages[ file.id ];
            updateTotalProgress();
            $li.off().find('.file-panel').off().end().remove();
        }

        function updateTotalProgress() {
            var loaded = 0,
                total = 0,
                spans = $progress.children(),
                percent;

            $.each(percentages, function (k, v) {
                total += v[ 0 ];
                loaded += v[ 0 ] * v[ 1 ];
            });

            percent = total ? loaded / total : 0;

            spans.eq(0).text(Math.round(percent * 100) + '%');
            spans.eq(1).css('width', Math.round(percent * 100) + '%');
            updateStatus();
        }

        function updateStatus() {
            var text = '', stats;
            if (state === 'ready') {
                text = '已选择文件，共' +
                    WebUploader.formatSize(fileSize);
            } else if (state === 'confirm') {
                stats = uploader.getStats();
                if (stats.uploadFailNum) {
                    text = '已成功上传' + stats.successNum + '个文件，' +
                        stats.uploadFailNum + '个文件上传失败，<a class="retry" href="#">重新上传</a>'
                }

            } else {
                stats = uploader.getStats();
                text = '共' +
                    WebUploader.formatSize(fileSize) +
                    '，文件正在上传';
                if (stats.successNum) {
                    text = '共' +
                        WebUploader.formatSize(fileSize) +
                        '，文件上传成功';
                }
                if (stats.uploadFailNum) {
                    text = '共' +
                        WebUploader.formatSize(fileSize) +
                        '，'+ stats.successNum +'文件上传成功'+'，失败' + stats.uploadFailNum + '个文件';
                }
            }
            $info.html(text);
        }

        function setState(val) {
            var file, stats;

            if (val === state) {
                return;
            }

            $upload.removeClass('state-' + state);
            $upload.addClass('state-' + val);
            state = val;

            switch (state) {
                case 'pedding':
                    $placeHolder.removeClass('element-invisible');
                    $queue.hide();
                    $statusBar.addClass('element-invisible');
                    uploader.refresh();
                    break;

                case 'ready':
                    $placeHolder.addClass('element-invisible');
                    $('#filePicker2').removeClass('element-invisible');
                    $queue.show();
                    $statusBar.removeClass('element-invisible');
                    uploader.refresh();
                    break;

                case 'uploading':
                    $('#filePicker2').addClass('element-invisible');
                    $progress.show();
                    $upload.text('暂停上传');
                    $(".newsBtn").hide();
                    $(".delFile").hide();
                    break;

                case 'paused':
                    $progress.show();
                    $upload.text('继续上传');
                    $(".delFile").show();
                    break;

                case 'confirm':
                    $progress.hide();
                    $('#filePicker2').removeClass('element-invisible');
                    $upload.text('开始上传');
                    $(".delFile").hide();
                    $(".newsBtn").show();

                    stats = uploader.getStats();
                    if (stats.successNum && !stats.uploadFailNum) {
                        setState('finish');
                        return;
                    }
                    break;
                case 'finish':
                    stats = uploader.getStats();
                    if (stats.successNum){
                        layer.msg('上传成功',{icon:1,time:2000,shade: 0.3}, function(){
                            parent.location.reload();
                            parent.layer.closeAll();

                        });
                    } else {
                        // 没有成功的图片，重设
                        state = 'done';
                        location.reload();
                    }
                    break;
            }

            updateStatus();
        }

        uploader.onUploadProgress = function (file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            $percent.css('width', percentage * 100 + '%');
            percentages[ file.id ][ 1 ] = percentage;
            updateTotalProgress();
        };

        uploader.onFileQueued = function (file) {
            fileCount++;
            fileSize += file.size;

            if (fileCount === 1) {
                $placeHolder.addClass('element-invisible');
                $statusBar.show();
            }

            addFile(file);
            setState('ready');
            updateTotalProgress();
        };

        uploader.onFileDequeued = function (file) {
            fileCount--;
            fileSize -= file.size;

            if (!fileCount) {
                setState('pedding');
            }

            removeFile(file);
            updateTotalProgress();
        };

        uploader.on('all', function (type) {
            var stats;
            switch (type) {
                case 'uploadFinished':
                    setState('confirm');
                    break;

                case 'startUpload':
                    setState('uploading');
                    break;

                case 'stopUpload':
                    setState('paused');
                    break;

            }
        });

        uploader.onError = function (code, name_max, file) {
            switch (code) {
                case 'Q_EXCEED_NUM_LIMIT':
                    text = '文件总数量超出 (单次最多选择'+ name_max +'个文件)';
                    break;

                case 'Q_EXCEED_SIZE_LIMIT':
                    text = '文件大小超出 (文件大小不超过'+ name_max/(1024*1024) +'M)';
                    break;

                case 'Q_TYPE_DENIED':
                    text = name_max.name+' 文件类型错误 (仅限'+ uploader.option('accept')[0].extensions +')';
                    break;
                case 'F_EXCEED_SIZE':
                    text = file.name+' 文件大小超出 (文件大小不超过'+ name_max/(1024*1024) +'M)';
                    break;
                default:
                    text = code;
                    break;
            }
            layer.msg('Eroor：' + text,{icon:2,time:2000,shade: 0.3});
        };

        $upload.on('click', function () {
            if ($(this).hasClass('disabled')) {
                return false;
            }
            $(".editFooterTr").hide();
            if (state === 'ready') {
                uploader.upload();
            } else if (state === 'paused') {
                uploader.upload();
            } else if (state === 'uploading') {
                uploader.stop(true);
            }
        });

        $info.on('click', '.retry', function () {
            uploader.retry();
        });

        //清空列表
        $(".newsBtn").on('click', function (){
            var _alllist = $('.filelist li');
            $.each(_alllist, function(i){
                var del_id = $(_alllist.get(i)).attr("id");
                uploader.removeFile(del_id, true);
            });
            fileSize = 0;
            uploader.reset();
            $(".editFooterTr").show();
        });

        //取消上传
        $(".delFile").on('click', function (){
            layer.confirm('是否确定取消上传？', {icon: 3, title:'提示'}, function(index){
                $('.uploadBtn').hide();
                $('.filelist .error').text("取消上传");
                $('.statusBar .info').text("正在取消上传...");
                $.ajax({
                    type:"post",
                    url:"/cfwl_system.php/article/cancel_upload_file",
                    data:'',
                    success:function(msg){
                        $(".newsBtn").click();
                        $('.uploadBtn').show();
                    }
                });
                layer.close(index);
            });
        });

        updateTotalProgress();
    });

})(jQuery);