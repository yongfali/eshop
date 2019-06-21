//店铺首页滚动广告设置脚本
/**
*店铺广告编辑保存
*/
$(function(){
  $('#adsSave').click(function(){
    var params = $('#adsImgForm').serialize();
    $.ajax({  
      url: 'settingSave',  
      type: 'post', 
      data: params, 
      dataType : 'json',
      success : function (msg) {
        if(msg.status){
          layer.msg('设置成功！',{icon:1});
          location.reload();
        }
        else{
          layer.msg('设置失败！',{icon:5});
        }    
      },
      error : function(){
        layer.msg('请求出错了，稍后再试...',{icon:16}); 
      }
    });
  });
});
// webuploader广告上传插件
(function( $ ){
      // 当domReady的时候开始初始化
      $(function() {
       var $wrap = $('.uploader-list-container'),
        // 图片容器先判断是否已有filelist
           fl = (function(){
            var len = $wrap.find( '.queueList' ).children('.filelist').size();
              if (len) {
                  $queue = $wrap.find( '.queueList' ).children('.filelist');
              }
              else{
               $queue = $( '<ul class="filelist"></ul>' )
               .appendTo( $wrap.find( '.queueList' ) );
              }
           })(),
              // 状态栏，包括进度和控制按钮
              $statusBar = $wrap.find( '.statusBar' ),
              // 文件总体选择信息。
              $info = $statusBar.find( '.info' ),
              // 上传按钮
              $upload = $wrap.find( '.uploadBtn' ),
              // 没选择文件之前的内容。
              $placeHolder = $wrap.find( '.placeholder' ),
              $progress = $statusBar.find( '.progress' ).hide(),
              // 添加的文件数量
              fileCount = 0,
              // 添加的文件总大小
              fileSize = 0,
              // 优化retina, 在retina下这个值是2
              ratio = window.devicePixelRatio || 1,
              // 缩略图大小
              thumbnailWidth = 160 * ratio,
              thumbnailHeight = 160 * ratio,
              // 可能有pedding, ready, uploading, confirm, done.
              state = 'pedding',
              // 所有文件的进度信息，key为file id
              percentages = {},
              // 判断浏览器是否支持图片的base64
              isSupportBase64 = ( function() {
                var data = new Image();
                var support = true;
                data.onload = data.onerror = function() {
                  if( this.width != 1 || this.height != 1 ) {
                    support = false;
                  }
                }
                data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
                return support;
              } )(),
              // 检测是否已经安装flash，检测flash的版本
              flashVersion = ( function() {
                var version;
                try {
                  version = navigator.plugins[ 'Shockwave Flash' ];
                  version = version.description;
                } catch ( ex ) {
                  try {
                    version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
                    .GetVariable('$version');
                  } catch ( ex2 ) {
                    version = '0.0';
                  }
                }
                version = version.match( /\d+/g );
                return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
              } )(),

              supportTransition = (function(){
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
          // 实例化
          uploader = WebUploader.create({
            pick: {
              id: '#filePicker-2',
              label: '点击选择图片',
              multiple : true
            },
            formData: {
              uid: sid
            },
            dnd: '#dndArea',
            paste: '#uploader',
            swf: '/eshop/Public/Common/webuploader/Uploader.swf',
            chunked: false,
            chunkSize: 512 * 1024,
            server: 'adsImgUpload',
            accept: {
              title: 'Images',
              extensions: 'gif,jpg,jpeg,bmp,png',
              mimeTypes: 'image/*'
            },

            // 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
            disableGlobalDnd: true,
            fileNumLimit: 5,
              fileSizeLimit: 25 * 1024 * 1024,    // 25 M
              fileSingleSizeLimit: 5 * 1024 * 1024    // 5 M
            });
          // 拖拽时不接受 js, txt 文件。
          uploader.on( 'dndAccept', function( items ) {
            var denied = false,
            len = items.length,
            i = 0,
                  // 修改js类型
                  unAllowed = 'text/plain;application/javascript ';
                  for ( ; i < len; i++ ) {
                  // 如果在列表里面
                  if ( ~unAllowed.indexOf( items[ i ].type ) ) {
                    denied = true;
                    break;
                  }
                }
                return !denied;
              });
          uploader.on('dialogOpen', function() {
            // console.log('here');
          });
          // 添加“添加文件”的按钮，
          uploader.addButton({
            id: '#filePicker2',
            label: '继续添加'
          });
          uploader.on('ready', function() {
            window.uploader = uploader;
          });
          // 当有文件添加进来时执行，负责view的创建
          function addFile( file ) {
            var $li = $( '<li id="' + file.id + '">' +
              '<p class="title">' + file.name + '</p>' +
              '<p class="imgWrap"></p>'+
              '<p class="progress"><span></span></p>' +
              '</li>' ),
            $btns = $('<div class="file-panel">' +
              '<span class="cancel">删除</span>' +
              '<span class="rotateRight">向右旋转</span>' +
              '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),
            showError = function( code ) {
              switch( code ) {
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
              $info.text( text ).appendTo( $li );
            };
            if ( file.getStatus() === 'invalid' ) {
              showError( file.statusText );
            } else {
                  // @todo lazyload
                  $wrap.text( '预览中' );
                  uploader.makeThumb( file, function( error, src ) {
                    var img;

                    if ( error ) {
                      $wrap.text( '不能预览' );
                      return;
                    }

                    if( isSupportBase64 ) {
                      img = $('<img src="'+src+'">');
                      $wrap.empty().append( img );
                    } else {
                      $.ajax('/eshop/Public/Common/webuploader/server/preview.php', {
                        method: 'POST',
                        data: src,
                        dataType:'json'
                      }).done(function( response ) {
                        if (response.result) {
                          img = $('<img src="'+response.result+'">');
                          $wrap.empty().append( img );
                        } else {
                          $wrap.text("预览出错");
                        }
                      });
                    }
                  }, thumbnailWidth, thumbnailHeight );
                  percentages[ file.id ] = [ file.size, 0 ];
                  file.rotation = 0;
                  }
          file.on('statuschange', function( cur, prev ) {
          if ( prev === 'progress' ) {
              $prgress.hide().width(0);
            } 
          else if ( prev === 'queued' ) {
          $li.off( 'mouseenter mouseleave' );
          $btns.remove();
          }
                  // 成功
                  if ( cur === 'error' || cur === 'invalid' ) {
                    showError( file.statusText );
                    percentages[ file.id ][ 1 ] = 1;
                  } else if ( cur === 'interrupt' ) {
                    showError( 'interrupt' );
                  } else if ( cur === 'queued' ) {
                    percentages[ file.id ][ 1 ] = 0;
                  } else if ( cur === 'progress' ) {
                    $info.remove();
                    $prgress.css('display', 'block');
                  } else if ( cur === 'complete' ) {
                    $li.append( '<span class="success1"></span>' );
                    //新增删除图标上传成功后用户仍可以删除该图片
                    $li.append('<span class="delImg"><a href="javascript:;" onclick="delAdsImg(this,0)">删除</a></span>')
                  }
                  $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
      });
          $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
          });
          $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
          });
          $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
            deg;
            switch ( index ) {
              case 0:
              uploader.removeFile( file );
              return;

              case 1:
              file.rotation += 90;
              break;

              case 2:
              file.rotation -= 90;
              break;
            }

            if ( supportTransition ) {
              deg = 'rotate(' + file.rotation + 'deg)';
              $wrap.css({
                '-webkit-transform': deg,
                '-mos-transform': deg,
                '-o-transform': deg,
                'transform': deg
              });
            } else {
              $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');                          
            }
          });
          $li.appendTo( $queue );
          }
                    // 负责view的销毁
                    function removeFile( file ) {
                      var $li = $('#'+file.id);
                      delete percentages[ file.id ];
                      updateTotalProgress();
                      $li.off().find('.file-panel').off().end().remove();
                    }
                    //
                    function updateTotalProgress() {
                      var loaded = 0,
                      total = 0,
                      spans = $progress.children(),
                      percent;
                      $.each( percentages, function( k, v ) {
                        total += v[ 0 ];
                        loaded += v[ 0 ] * v[ 1 ];
                      } );
                      percent = total ? loaded / total : 0;
                      spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
                      spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
                      updateStatus();
                    }
                    //
                    function updateStatus() {
                      var text = '', stats;
                      if ( state === 'ready' ) {
                        text = '选中' + fileCount + '张图片，共' +
                        WebUploader.formatSize( fileSize ) + '。';
                      } else if ( state === 'confirm' ) {
                        stats = uploader.getStats();
                        if ( stats.uploadFailNum ) {
                          text = '已成功上传' + stats.successNum+ '张照片至XX相册，'+
                          stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
                        }
                      } else {
                        stats = uploader.getStats();
                        text = '共' + fileCount + '张（' +
                        WebUploader.formatSize( fileSize )  +
                        '），已上传' + stats.successNum + '张';
                        if ( stats.uploadFailNum ) {
                          text += '，失败' + stats.uploadFailNum + '张';
                        }
                      }
                      $info.html( text );
                    }
                    /**
                    *onUploadSuccess onUploadError 新增
                    */
                    uploader.onUploadSuccess=function(file ,response){
                     var $li = $('#'+file.id);
                     if(response.status){
                       $li.append('<input type="hidden" name="imgURL[]" value="'+response.content+'"/>');
                       // $li.append('<input type="hidden" name="thumbURL[]" value="'+response.thumb+'"/>');
                       // $li.append('<input type="hidden" name="'+file.id+'_thumb" value="'+response.thumb+'"/>');
                     }
                   }
                   uploader.onUploadError=function(file,reason){
                    layer.msg(fileError,{icon:5});
}
function setState( val ) {
            var file, stats;
            if ( val === state ) {
              return;
            }
            $upload.removeClass( 'state-' + state );
            $upload.addClass( 'state-' + val );
            state = val;
            switch ( state ) {
              case 'pedding':
              $placeHolder.removeClass( 'element-invisible' );
              $queue.hide();
              $statusBar.addClass( 'element-invisible' );
              uploader.refresh();
              break;
              case 'ready':
              $placeHolder.addClass( 'element-invisible' );
              $( '#filePicker2' ).removeClass( 'element-invisible');
              $queue.show();
              $statusBar.removeClass('element-invisible');
              uploader.refresh();
              break;
              case 'uploading':
              $( '#filePicker2' ).addClass( 'element-invisible' );
              $progress.show();
              $upload.text( '暂停上传' );
              break;
              case 'paused':
              $progress.show();
              $upload.text( '继续上传' );
              break;
              case 'confirm':
              $progress.hide();
              $( '#filePicker2' ).removeClass( 'element-invisible' );
              $upload.text( '开始上传' );
              stats = uploader.getStats();
              if ( stats.successNum && !stats.uploadFailNum ) {
                setState( 'finish' );
                return;
              }
              break;
              case 'finish':
              stats = uploader.getStats();
              if ( stats.successNum ) {
                layer.msg( '上传成功',{icon:1});
              } else {
                          // 没有成功的图片，重设
                          state = 'done';
                          location.reload();
                        }
                        break;
                      }
                      updateStatus();
                    }
                    uploader.onUploadProgress = function( file, percentage ) {
                      var $li = $('#'+file.id),
                      $percent = $li.find('.progress span');
                      $percent.css( 'width', percentage * 100 + '%' );
                      percentages[ file.id ][ 1 ] = percentage;
                      updateTotalProgress();
                    };
                    uploader.onFileQueued = function( file ) {
                      fileCount++;
                      fileSize += file.size;
                      if ( fileCount === 1 ) {
                        $placeHolder.addClass( 'element-invisible' );
                        $statusBar.show();
                      }
                      addFile( file );
                      setState( 'ready' );
                      updateTotalProgress();
                    };
                    uploader.onFileDequeued = function( file ) {
                      fileCount--;
                      fileSize -= file.size;
                      if ( !fileCount ) {
                        setState( 'pedding' );
                      }
                      removeFile( file );
                      updateTotalProgress();
                    };
                    uploader.on( 'all', function( type ) {
                      var stats;
                      switch( type ) {
                        case 'uploadFinished':
                        setState( 'confirm' );
                        break;
                        case 'startUpload':
                        setState( 'uploading' );
                        break;
                        case 'stopUpload':
                        setState( 'paused' );
                        break;
                      }
                    });
                    uploader.onError = function( code ) {
                      if(code == 'Q_EXCEED_NUM_LIMIT'){
                        layer.msg("单次最多只能上传10张！",{icon:5});
                      }
                      else if(code == 'F_DUPLICATE'){
                       layer.msg("不可重复上传同一张图片！",{icon:5});
                     }
                     else if(code == 'F_DUPLICATE'){
                       layer.msg("不可重复上传同一张图片！",{icon:5});
                     }
                     else{
                       layer.msg("上传出错了！",{icon:5});
                     }
                   };

                   $upload.on('click', function() {
                    if ( $(this).hasClass( 'disabled' ) ) {
                      return false;
                    }

                    if ( state === 'ready' ) {
                      uploader.upload();
                    } else if ( state === 'paused' ) {
                      uploader.upload();
                    } else if ( state === 'uploading' ) {
                      uploader.stop();
                    }
                  });

                   $info.on( 'click', '.retry', function() {
                    uploader.retry();
                  } );

                   $info.on( 'click', '.ignore', function() {
                    layer.msg( 'todo',{icon:7} );
                  } );

                   $upload.addClass( 'state-' + state );
                   updateTotalProgress();
                 });
})( jQuery );
/**
*店铺首页广告图片上传后，删除上传成功后的照片
*$type为0表示图片只是上传未保存到数据库，1表示已经保存到数据库了
*/
function delAdsImg(obj,type){
  var params = {};
  params.type = type;
  if(!type){
    params.img_url = $(obj).parent('.delImg').next('input').attr('value');
  }
  else{
    params.id = $(obj).attr('value');
  }
  layer.confirm('确认删除该图片吗？',{icon:7},function(){
    $.ajax({
      type : "post",
      url : 'adsImgDel',
      dataType : "json",
      data : params,
      success : function(msg){
        if(msg.status){
          layer.msg('删除成功！',{icon:1});
              $(obj).parent().parent().remove();//删除对应的父节点让图片不再显示
            }
            else{
              layer.msg('删除失败！',{icon:5});
            }
          },
          error : function(){
            layer.msg('请求出错了，请稍后重试...',{icon:16})
          }
        });
  });
}


