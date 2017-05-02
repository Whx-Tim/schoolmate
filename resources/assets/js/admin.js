// $(function () {
//     $(".Form:not(.editor)").on('submit', function () {
//         // ajax + form.serialize()
//     });
//
//     $(".Form.editor").on('submit', function () {
//         // 手动提取Code
//         var code = $(".summernote").code(),
//             data = $(form).serialize();
//
//         data = data + '&content=' + code;
//
//         sendRequest('', 'POST', function (success) {
//             if (success) {
//
//             }
//         }, data);
//     });
//
//     function sendRequest(url, type, callback, data) {
//
//         $.ajax({
//             success: function () {
//                 callback(true);
//             },
//             data: data,
//             error: function () {
//                 callback(false);
//             }
//         })
//     }
//
//     // 插入HTML到编辑器中
//     setTimeout(function () {
//         $(".summernote").code(CONTENT);
//     }, 500);
//
//     $(".summernote").on('image_insert', function (ev) {
//         ev.preventDefault();
//
//         sendRequest('upload/photo', 'PATCH', function (success) {
//             if (success) {
//                 $(".summernote").insert('');
//             }
//         });
//     })
// });

$(function () {
    $(".summernote").each(function () {
        $(this).summernote({
            lang: 'zh-CN',
            callbacks: {
                onImageUpload: function (files) {
                    if (files.length) {
                        $(files).each(function (){
                            var Formdata = new FormData();
                            Formdata.append('image', this);

                            $.ajax({
                                url: '/upload',
                                type: 'POST',
                                dataType: 'json',
                                data: Formdata,
                                enctype: 'multipart/form-data',
                                processData: false,
                                contentType: false,
                                success:function (data){
                                    if (data.status != 'error'){
                                        $(".summernote").summernote('insertImage', data.url);
                                    } else {
                                        toastr.error(data.message);
                                    }
                                },
                                error: function (er) {
                                    toastr.error(er.resposeText);
                                }
                            });
                        });
                    }
                }
            }
        });
    });
    $(".editor").each(function () {
        $(this).on('submit', function (ev) {
            ev.preventDefault();
            var form = ev.target;

            $.ajax({
                url: this.action,
                type: $(this).find('input[name=_method]') == undefined ? this.method : $(this).find('input[name=_method]').attr('value'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function (data) {
                    if (typeof(data.redirect) == 'undefined') {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                        return false;
                    } else {
                        swal({
                            title: data.message,
                            text: '2秒后自动跳转',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: true,
                            showCancelButton: false,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: '确定'
                        },function () {
                            window.location.href = data.redirect;
                        });

                    }
                },
                error: function (error) {
                    if (error.status === 422) {
                        var errors = JSON.parse(error.responseText);
                        for (var er in errors) {
                            var sel = '[name=' + er +']',
                                groupEl = $($(form).find(sel)[0]).parents('.form-group')[0];
                            // Add error class to the form-group
                            $(groupEl).addClass('has-error shaky');
                            setTimeout(function () {
                                $(groupEl).removeClass('has-error shaky')
                            }, 8000);

                            $(sel).focus();
                            toastr.error('<h4>'+errors[er][0]+'</h4>');
                        }
                    } else {
                        toastr.error(error.responseText);
                    }
                }
            })
        }.bind(this));
    });
});