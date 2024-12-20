var $referensi = localStorage.getItem('referensi');
var $ref = JSON.parse($referensi);

var $ummu = {
    register: function(){
        $ummu.config.autoload()
    },

    routes: {
        mechanic_activity: {
            edit: function(row, index) {
                app.Controllers.edit(row,index);
            }
        },

        auth: {
            username: function() {
                app.Controllers.username();
            }
        }
    },

    vars: {
        id: null,
        base_url: null,
        page_url: null,
        page: null,
        action: null,
        class: null,
        location_hash: null,
        error_ids: [],
        msdbToken: localStorage.getItem('msdbToken'),
        urlpath: window.location.href,
        urlParams: new URLSearchParams(window.location.search),
        page_previous: null,
        errors: [],
        rows: null,
        rad_external: 0,
        show_col_images: localStorage.getItem('show_col_images'),
        show_col_id: localStorage.getItem('show_col_id'),
        nav_tab: null,
        crud: null,
        module_kode: null,
        site_project_kode: null,
        required_field: [],
        index: null,
        element_id: null,
        arrayqu: []
    },

    config: {
        autoload: function(){
            // app.Events.initTable()
            $ummu.events.onClick.dorbittButton();
            $ummu.events.onChange.dorbittCheckBox();
            $ummu.events.onChange.dorbittRadio();
            $ummu.events.onChange.selectOption();
            $ummu.gallery.button();
            $ummu.events.onChangeFileGalleryUpload();
            $ummu.events.gallery.btn_show_gallery();
            $ummu.mygallery.autoload();
            // $ummu.events.gallery.btn_submit_file_upload();
            // $('#btn_login').on('click', function(){

            // })
            $('.nav-tabs .nav-link').on('click', function(){
                var nav_tab_id = $(this).attr('id');
                localStorage.setItem('nav_tab_id', nav_tab_id);
            })

            $('.datepicker000').datepicker({
                dateFormat: 'yy-mm-dd',
                uiLibrary: 'bootstrap4', 
                modal: true, 
                header: true, 
                footer: true
            });

            $('.clockpicker').clockpicker({
                // placement: 'top',
                autoclose: true,
                align: 'left',
                donetext: 'Done',
                'default': 'now'
            });

            $('#modal_filter').on('shown.bs.modal', function(){
                let date_from = localStorage.getItem('date_from');
                let time_from = localStorage.getItem('time_from');

                let date_to = localStorage.getItem('date_to');
                let time_to = localStorage.getItem('time_to');

                $('#date_from').val(date_from);
                $('#time_from').val(time_from);

                $('#date_to').val(date_to);
                $('#time_to').val(time_to);
            })

            $('#modal_filter #btn_save_filter').on('click', function(){
                var date_from = $('#date_from').val();
                var time_from = $('#time_from').val();
                var date_to = $('#date_to').val();
                var time_to = $('#time_to').val();

                localStorage.setItem('date_from', date_from);
                localStorage.setItem('time_from', time_from);
                localStorage.setItem('date_to', date_to);
                localStorage.setItem('time_to', time_to);

                $('#modal_filter').modal('hide');

                table.ajax.reload();
            });

            $('.btn-add-to-list').on('click', function(){
                if ($ummu.vars.index == null) {
                    $ummu.vars.index = 0;
                }else{
                    $ummu.vars.index = $ummu.vars.index + 1;
                }

                var dataInputID = $(this).attr('data-inputid');
                $ummu.vars.element_id = dataInputID + '_list';
                var tVal = $('#'+dataInputID).val();
                var text = '<li class="list-group-item d-flex justify-content-between align-items-center" style="padding:0px 0px 0px 10px;" id="index'+$ummu.vars.index+'">'+
                '<span class="list-group-item-text">'+tVal+'</span>'+
                '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$ummu.func.remove_element_by_index('+$ummu.vars.index+');"><i class="fas fa-trash-alt"></i></button>'+
                '</li>';
                if (tVal) {
                    $('#'+dataInputID+'_list').append(text);
                }
                $('#'+dataInputID).val('');

                // console.log(text)
            });

            // $('#txtSearchProdAssign').keypress(function (e) {
            //     var key = e.which;
            //     if(key == 13)  // the enter key code
            //     {
            //         $('input[name = butAssignProd]').click();
            //         return false;  
            //     }
            // });
        }
    },

    events: {
        initTable: function() {
            // $table.bootstrapTable({
            //     locale: 'en-US',
            // })
            // $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            //     $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            //     // save your data, here just save the current page
            //     seldata: dataections = $globFunc.getIdSelections();
            // })
            // $table.on('all.bs.table', function (e, name, args) {
            //     console.log(name, args)
            // })
            // $remove.click(function () {
            //     $('#btn_multiple_delete').attr('onclick','Routes.multiple_delete();')
            //     $('#modal_confirmation_multiple_delete').modal('show')
            // })
        },
        onChangeFileGalleryUpload: function(){
            $('#file_upload').change(function() {
                var $id = $('#upload_img_thumbnail');
                var $filename = $(this)[0].files[0].name;
                var reader = new FileReader();
                reader.onload = function (e) {
                    $($id).attr('src', e.target.result);
                    // alert(e.target.result)
                    $ummu.upload.filename = $filename;
                };
                reader.readAsDataURL($(this)[0].files[0]);
            })
        },

        /*onChange: {
            checkBox: function() {
                // $("#proyektor").change(function() {
                //     if(this.checked) {
                //         globalVars.proyektor = 1
                //     }else{
                //         globalVars.proyektor = 0
                //     }
                // });
            },

            selectOption: function() {
                $('#gedung').change(function() {
                    var maxNum = $(this).find(':selected').attr('data-lantai');
                    $('#lantai').val("");
                    $('#lantai').attr('max',maxNum);
                });
            }
        },

        onClick: {
            dorbittButton: function() {
                $('#btn_clear_form').click(function(){
                    app.Views.kosongkanForm();
                })

                $('#hapus_foto').click(function() {
                    $ummu.upload.ids = [];
                    $ummu.upload.filenames = [];
                    app.Views.defautlFotoRuangan();
                })

                $('#new').click(function() {
                    $ummu.upload.ids = [];
                    $ummu.upload.filenames = [];
                    app.Views.defautlFotoRuangan();
                })
            }
        }*/

        onClick: {
            dorbittButton: function() {
                $('#btn_show_password').click(function() {
                    var type = $('#password').attr('type');
                    if( type == 'password') {
                        $('#btn_show_password').html('<i class="bi bi-eye-slash-fill"></i>');
                        $('#password').attr('type', 'text')
                    }else{
                        $('#btn_show_password').html('<i class="bi bi-eye-fill"></i>');
                        $('#password').attr('type', 'password')
                    }
                })

                $('#message_modal_close').on('click', function(){
                    $('#message_modal').modal('hide');
                })

                $('#btn_endis').click(function() {
                    $('#password').val("");
                    if ($('#password').is(':disabled')) {
                        $('#password').removeAttr('disabled')
                        $('#trash_icon').show()
                        $('#pencil_icon').hide()
                    }else{
                        $('#password').attr('disabled','disabled')
                        $('#trash_icon').hide()
                        $('#pencil_icon').show()
                    }
                })

                $('#btn_modal_max').on('click', function() {
                    var el = $('#modal_dialog');
                    var hasClass = el.hasClass('modal-lg');
                    // console.log(hasClass)

                    if (hasClass == true) {
                        el.removeClass('modal-lg');
                        el.addClass('modal-fullscreen');
                    }else{
                        el.removeClass('modal-fullscreen');
                        el.addClass('modal-lg');
                    }
                })

                // $('#dorbitt_open_gallery').click(function() {
                //     var dataImage = $(this).attr('data-image');
                //     $ummu.upload.show_gallery();
                //     $('#modal_gallery').modal('show');
                //     // $ummu.upload.input_id = input_id;
                //     // $ummu.upload.image_id = image_id;
                // })

                // $('#dorbitt_open_gallery2').click(function() {
                //     var dataImage = $(this).attr('data-image');
                //     $ummu.upload.show_gallery2();
                //     $('#modal_gallery').modal('show');
                //     // $ummu.upload.input_id = input_id;
                //     // $ummu.upload.image_id = image_id;
                // })

                // $('#btn_select_file').click(function() {
                //     var ids = [];
                //     var filenames = [];
                //     $('.dorbitt_checkbox_image_gallery:checked').each(function() {
                //         var id = $(this).attr('id');
                //         var filename = $(this).data('name');

                //         ids.push(parseInt(id));
                //         filenames.push(filename)
                //         // console.log(filename)
                //     });

                //     $ummu.upload.ids = ids;
                //     $ummu.upload.filenames = filenames;

                //     app.Views.set_gallery_selected_to_img(filenames)

                //     $('#modal_gallery').modal('hide');
                //     // console.log(ids)
                // })

                $('#dorbitt_tabs .nav-tabs .nav-link').click(function() {
                    var urlhash = $(this).attr('data-bs-target');
                    window.location.hash = urlhash;
                    // console.log(urlhash)
                    // document.cookie = urlhash;
                    Cookies.set('urlhash', urlhash);
                })

                $('#btn_approved_list').on('click', function() {
                    $('#modal_approved_list').modal('show');
                })

                $('#update_profile').on('click', function() {
                    app.Controllers.update_profile();
                })

                $('.module-category').on('click', function() {
                    // console.log($(this).val());
                    localStorage.category_id = $(this).data('value');
                    var toUrl = $base_url + 'admin/session/module_category/' + $(this).data('value');
                    // $ummu.vars.page_previous = toUrl;
                    console.log(toUrl);
                    window.location.href = $base_url + 'admin/session/module_category/' + $(this).data('value');
                });

                $('.dorbitt-login-area #btn_next').on('click', function(){
                    var username = $('#username').val();
                    var msdb = $('#msdb').val();
                    if (username == '' || username == null) {
                        $('#alert').html('<div class="alert alert-danger">Username required.</div');
                    }
                    else if (msdb == '' || msdb == null) {
                        $('#alert').html('<div class="alert alert-danger">Company required.</div');
                    }
                    else{
                        $(this).addClass('disabled');
                        $ummu.routes.auth.username();
                    }
                })
            },
            escmButton: function() {
                $('#submit').on('click', function(){
                    var msdb = $('#msdb').val();
                    localStorage.msdbToken = msdb;
                    // console.log(msdb);
                })
            }
        },

        onChange: {
            dorbittCheckBox: function() {
                $(".dorbitt_checkbox").change(function() {
                    var element_id = $(this).attr('id');
                    if(this.checked) {
                        eval("globalVars."+element_id+" = 1");
                    }else{
                        eval("globalVars."+element_id+" = 0");
                    }
                });
            },

            dorbittInput: function() {
                /*// Pindah ke events => onChangeFileGalleryUpload
                $('#file_upload').change(function() {
                    var $id = $('#upload_img_thumbnail');
                    var $filename = $(this)[0].files[0].name;
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $($id).attr('src', e.target.result);
                        alert(e.target.result)
                        $ummu.upload.filename = $filename;
                    };
                    reader.readAsDataURL($(this)[0].files[0]);
                })*/
            },

            dorbittRadio: function() {
                $('.dorbitt-header #rad_approve').on('change', function() {
                    $ummu.views.approval.status_detail(1);
                })

                $('.dorbitt-header #rad_pending').on('change', function() {
                    $ummu.views.approval.status_detail(3);
                })

                $('.dorbitt-header #rad_reject').on('change', function() {
                    $ummu.views.approval.status_detail(2);
                })

                $('#rad_internal').on('change', function(){
                    $ummu.vars.rad_external = 0;
                })

                $('#rad_external').on('change', function(){
                    $ummu.vars.rad_external = 1;
                })
            },

            // rmChkDetApp: function() {
            //     // var radioApproveOnHeader = $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject');
            //     $('.dorbitt-detail .rad-approve').attr('checked', false);
            //     $('.dorbitt-detail .rad-pending').attr('checked', false);
            //     $('.dorbitt-detail .rad-reject').attr('checked', false);
            // }

            selectOption: function() {
                // $('#gedung').change(function() {
                //     var maxNum = $(this).find(':selected').attr('data-lantai');
                //     $('#lantai').val("");
                //     $('#lantai').attr('max',maxNum);
                // });

                // $('#module_category').on('click', function() {
                //     // console.log($(this).val());
                //     localStorage.category_id = $(this).data('value');
                //     var toUrl = $base_url + 'admin/session/module_category/' + $(this).data('value');
                //     // $ummu.vars.page_previous = toUrl;
                //     console.log(toUrl);
                //     window.location.href = $base_url + 'admin/session/module_category/' + $(this).data('value');
                // });
            },

            inputFile_onChange_fileUpload: function(){
                $('#file_upload').change(function() {
                    var $id = $('#upload_img_thumbnail');
                    var $filename = $(this)[0].files[0].name;
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $($id).attr('src', e.target.result);
                        // alert(e.target.result)
                        $ummu.upload.filename = $filename;
                    };
                    reader.readAsDataURL($(this)[0].files[0]);
                    console.log("OK");
                })
            },
        },

        gallery: {
            btn_show_gallery: function() {
                $('.btn_show_gallery').on('click', function(){
                    $('#modal_gallery').modal('show');
                })
            },
            btn_submit_file_upload: function(){
                $('#btn_submit_file_upload').click(function() {
                    var file = $('#file_upload').val();
                    if(file != ''){
                        $ummu.upload.upload_file_gallery()
                    }else{
                        alert('Silahkan pilih file terlebih dahulu.')
                    }
                })
            }
        },

        form_applicant: function() {
            $("#form_applicant").on("submit", function(event) {
                // alert( "Handler for `submit` called." );
                // $('#modal_loader').modal('show');
                $(this).attr('disabled', true);
                event.preventDefault();
            });
        },

        enter: function(inputID,buttonID) {
            var input = document.getElementById(inputID);
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById(buttonID).click();
                }
            });
        }
    },

    helpers: {
        currency: {
            // format number to US dollar
            us: function(data) {
                let USDollar = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                    // style: 'currency',
                    // currency: ' ',
                });

                return USDollar.format(data);
            }

            // // format number to British pounds
            // let pounds = Intl.NumberFormat('en-GB', {
            //     style: 'currency',
            //     currency: 'GBP',
            // });

            // // format number to Indian rupee
            // let rupee = new Intl.NumberFormat('en-IN', {
            //     style: 'currency',
            //     currency: 'INR',
            // });

            // // format number to Euro
            // let euro = Intl.NumberFormat('en-DE', {
            //     style: 'currency',
            //     currency: 'EUR',
            // });
        },

        formatTotalPrice: function(data) {
            var field = this.field
            return '$' + data.map(function (row) {
                return +row[field].substring(1)
            }).reduce(function (sum, i) {
                return sum + i
            }, 0)
        },

        operateFormatter: function() {
            return [
                // '<a class="like" href="javascript:void(0)" title="Like">',
                //     '<i class="fa fa-heart"></i>',
                // '</a>  ',
                // '<a href="#" id="add" class="remove" data-bs-toggle="modal" data-bs-target="#modal_confirmation">',
                //     '<i class="fa fa-trash"></i>',
                // '</a>   ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>  ',
                '<a class="edit" href="javascript:void(0)" title="Edit">',
                '<i class="fas fa-edit"></i>',
                '</a>'
                ];
        },

        detailFormatter: function(index, row) {
            var html = []
            $.each(row, function (key, value) {
                html.push('<p><b>' + key + ':</b> ' + value + '</p>')
            })
            return html
        },

        responseHandler:function(res) {
            $.each(res.rows, function (i, row) {
                row.state = $.inArray(row.id, selections) !== -1
            })
            return res
        },

        gedungFormatter: function(index, row) {
            var html = row.kode + ' | ' + row.name
            return html
        },

        rekeningFormatter: function(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            angka_hasil     = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);   

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '-' : '';
                angka_hasil += separator + ribuan.join('-');
            }

            angka_hasil = split[1] != undefined ? angka_hasil + ',' + split[1] : angka_hasil;
            return angka_hasil;            
        },

        companyNameFormatter: function(index, row) {
            var html = '<span class="text-muted">' + row.company_name + '</span>';
            return html
        }
    },

    controllers: {
        show: function(params) {
            // console.log(params)
            var url = $base_url+'/admin/ruangan/show';
            var ali = $globalAjax.ummu(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                params.success(response)
                $globFunc.ch_message(response.message);
                app.Controllers.show_gedung()
                app.Controllers.show_roomcateg()
            }).fail(function() {
                // An error occurred
            });
        },

        new: function() {
            $('#new').click(function(){
                $('#btnSubmit').attr('onclick', 'Routes.create()');
                $('#btn_clear_form').show()
                app.Views.kosongkanForm.apply()
            })
        },

        create: function() {
            var payload = JSON.stringify(
            {
                "body": {
                    "gedung_id": $('#gedung').val(),
                    "lantai": $('#lantai').val(),
                    "kode": $('#kode').val(),
                    "name": $('#name').val(),
                    "type_id": $('#type').val(),
                    "room_category_id": $('#category').val(),
                    "seat": $('#jumlah_seat').val(),
                    "proyektor": globalVars.proyektor,
                    "whiteboard": globalVars.whiteboard,
                    "image_ids": $ummu.upload.ids,
                    "image_names": $ummu.upload.filenames
                }
            });

            // console.log(payload)

            var params = {
                "type": "post",
                "action": "insert",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };

            // console.log(params)

            var url = $base_url + '/admin/ruangan/create'
            var ummu = $globalAjax.ummu(url, params);   
            ummu.done(function(result) {
                console.log(result)
                var response = JSON.parse(result);
                if (response.status==true) {
                    $('#InsertModal').modal('hide');
                    app.Views.set_value_to_table('insert',response.response);
                    $globFunc.ch_message(response.message);
                    app.Events.clear_form();
                }else{
                    $('#message_title, #text_message').empty();
                    var message = response.message;
                    var errors = response.errors;
                    $('#message_title').html(message);
                    for(let index in errors){
                        var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i>'+
                        errors[index]+
                        '</div>';
                        $('#text_message').append($error);
                    }
                    $('#message_modal').modal('show');
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        edit: function(row,index) {
            $('#btnSubmit').attr('onclick', 'Routes.update('+row.id+');');
            globalVars.dataIndex = index;
            $('#btnSubmit').html('Save changes');
            $('#btn_clear_form').hide();
            $('#InsertModal').modal('toggle');
            app.Views.kosongkanForm.apply()
            app.Views.set_value_to_form(row, index);
        },

        update: function(id) {
            var payload = JSON.stringify(
            {
                "body": {
                    "gedung_id": $('#gedung').val(),
                    "lantai": $('#lantai').val(),
                    "kode": $('#kode').val(),
                    "name": $('#name').val(),
                    "type_id": $('#type').val(),
                    "room_category_id": $('#category').val(),
                    "seat": $('#jumlah_seat').val(),
                    "proyektor": globalVars.proyektor,
                    "whiteboard": globalVars.whiteboard,
                    "image_ids": $ummu.upload.ids,
                    "image_names": $ummu.upload.filenames
                }
            });

            var params = {
                "type": "put",
                "action": "update",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };

            var url = $base_url + 'admin/ruangan/update/'+id
            var ummu = $globalAjax.ummu(url, params);

            ummu.done(function(result) {
                console.log(result)
                var response = JSON.parse(result);
                if (response.status==true) {
                    $('#InsertModal').modal('hide');
                    app.Views.set_value_to_table('update',id);
                    $globFunc.ch_message(response.message);
                }else{
                    $('#message_title, #text_message').empty();
                    var message = response.message;
                    var errors = response.errors;
                    $('#message_title').html(message);
                    for(let index in errors){
                        var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i>'+
                        errors[index]+
                        '</div>';
                        $('#text_message').append($error);
                    }
                    $('#message_modal').modal('show');
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });

            // console.log(JSON.parse(payload))
        },

        delete: function(id) {
            // controllers.delete(id)
            var params = {
                "type": "delete",
                "action": "delete",
                "data": null,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };

            var url = $base_url + 'admin/ruangan/delete/'+id
            var ummu = $globalAjax.ummu(url, params);

            ummu.done(function(result) {
                var response = JSON.parse(result);
                if (response.status==true) {
                    $globFunc.ch_message(response.message);
                    $table.bootstrapTable('removeByUniqueId', id)
                }else{
                    $('#modal_alert_input').html("");
                    var errors = response.errors;
                    $('#modal_alert_input').addClass('bg-danger');
                    for(let index in errors){
                        $('#modal_alert_input').append("<li>"+errors[index]+"</li>");
                    }
                    $('#modal_alert_input').fadeIn().delay(3000).fadeOut();
                }

                $('#modal_confirmation').modal('hide')
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        multiple_delete() {
            var payload = JSON.stringify(
            {
                "body": {
                    "ids": $globFunc.getIdSelections()
                }
            });

            var params = {
                "type": "delete",
                "action": "multiple_delete",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };

            var url = $base_url + "admin/ruangan/delete";
            var ummu = $globalAjax.ummu(url, params);

            ummu.done(function(result) {
                var response = JSON.parse(result);
                if (response.status==true) {
                    $globFunc.ch_message(response.message);
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: $globFunc.getIdSelections()
                    })
                    $remove.prop('disabled', true)
                }else{
                    $('#modal_alert_input').html("");
                    var errors = response.errors;
                    $('#modal_alert_input').addClass('bg-danger');
                    for(let index in errors){
                        $('#modal_alert_input').append("<li>"+errors[index]+"</li>");
                    }
                    $('#modal_alert_input').fadeIn().delay(3000).fadeOut();
                }
                $('#modal_confirmation_multiple_delete').modal('hide')
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        _import: function() {
            // if ($('#file_import').val()) {
            //     $('#ImportModal').modal('toggle');
            //     Controllers._import()                
            // }else{
            //     $('#modal_alert_import').html("File required")
            // }
        },

        show_gedung: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "kode",
                    "order": "asc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/ruangan/show_gedung';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                // console.log(response.rows)
                var params2 = {
                    "rows": response.rows,
                    "element_id": 'gedung',
                    "kode": 1
                };

                // $globFunc.set_value_to_option(response.rows,'gedung',1)
                // $globFunc.set_value_to_option3(params2)
                app.Views.set_value_to_option_gedung(params2)
            }).fail(function() {
                // An error occurred
            });
        },

        show_roomcateg: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/ruangan/show_roomcateg';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                // console.log(response.rows)
                $globFunc.set_value_to_option(response.rows,'category',0)
            }).fail(function() {
                // An error occurred
            });
        }
    },

    auth: {
        login: function(withMsdb = null){
            $('#btn_login').on('click', function(){
                var username = $('#username').val(),
                password = $('#password').val(),
                msdb = $('#msdb').val();

                if (withMsdb == 'withMsdb') {
                    if (msdb == null) {
                        alert('Silahkan pilih company.');
                    }else{
                        var vars = '?username='+username+'&password='+password+'&msdb='+msdb,
                        body = {
                            "body": {
                                "username": username,
                                "password": password,
                                "msdb": msdb
                            }
                        },
                        payload = {
                            "username": username,
                            "password": password,
                            "msdb": msdb
                        };
                    }
                }else{
                    var vars = '?username='+username+'&password='+password,
                    body = {
                        "body": {
                            "username": username,
                            "password": password
                        }
                    },
                    payload = {
                        "username": username,
                        "password": password
                    };
                }

                var url = $ummu.vars.base_url + 'auth/login/create'+vars;
                var params = {
                    "url": url,
                    "type": "post",
                    "action": "create",
                    "data": null,
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };

                console.log(params);

                // var ummu = $ummu.ajax.auth.login(params);   
                // ummu.done(function(result) {
                //     console.log(result)
                //     var response = result;
                //     if (response.status == true) {
                // //     $('#alert').html('<div class="alert alert-success">'+response.messages+'</div>');
                // //     $('#username_area, #btn_next').addClass('collapse');
                // //     $('#otp_area, #btn_verify_otp').removeClass('collapse');
                // //     $('#username_change, #username_change2').val($('#username').val());
                // //     $('#alert').html('');
                //         window.location.replace($ummu.vars.base_url + 'admin');
                //     }else{
                // //     $('#alert').html('<div class="alert alert-danger">'+response.errors+'</div>');
                // //     if (response.errors == 'You have already created an otp before.') {
                // //         $('#username_area, #btn_next').addClass('collapse');
                // //         $('#otp_area, #btn_verify_otp').removeClass('collapse');
                // //         $('#username_change, #username_change2').val($('#username').val());
                // //     }
                //     }
                // // $('#btn_next').removeClass('disabled');
                //     setTimeout( function() { 
                //         $('#modal_loader').modal('hide');
                //     }, 1000 );
                // }).fail(function() {
                // // An error occurred
                //     console.log(ummu)
                // });
            })
        },
        
        login_with_msdb: function(){
            $('#btn_login').on('click', function(){
                var username = $('#username').val(),
                password = $('#password').val(),
                msdb = $('#msdb').val();

                if (msdb == null) {
                    alert('Silahkan pilih company.');
                }else{
                    var vars = '?username='+username+'&password='+password+'&msdb='+msdb,
                    body = {
                        "body": {
                            "username": username,
                            "password": password,
                            "msdb": msdb
                        }
                    },
                    payload = {
                        "username": username,
                        "password": password,
                        "msdb": msdb
                    };

                    var url = $ummu.vars.base_url + 'auth/login/create'+vars;
                    var params = {
                        "url": url,
                        "type": "post",
                        "action": "create",
                        "data": null,
                        "cache": true,
                        "contentType": "application/json",
                        "dataType": "json"
                    };

                    // console.log(params);

                    var ummu = $ummu.ajax.auth.login(params);   
                    ummu.done(function(result) {
                        // console.log(result)
                        var response = result;
                        if (response.status == true) {
                            $('#alert').html('<div class="alert alert-success">'+response.message+'</div>');
                            window.location.replace($ummu.vars.base_url + 'admin');
                        }else{
                            $('#alert').html('<div class="alert alert-danger">'+response.message+'</div>');
                        }
                        setTimeout( function() { 
                            $('#modal_loader').modal('hide');
                        }, 1000 );
                    }).fail(function() {
                    // An error occurred
                        console.log(ummu)
                    });
                }

            })
        }
    },

    ajax: {
        auth: {
            login: function(params) {
                // console.log(params.data);
                var jqXHR = $.ajax({
                    "url": params.url,
                    "method": params.type,
                    "timeout": 0,
                    "headers": {
                        "Content-Type": params.contentType,
                    },
                    "data": params.data,
                    "prossesing": true,
                    'language': {
                        'loadingRecords': '&nbsp;',
                        'processing': '<div class="spinner"></div>'
                    },  
                    beforeSend: function(e) {
                        $('#modal_loader2').modal('show');
                    },
                    complete: function(){
                        // 
                    },
                    success: function(response){
                        // console.log(response)
                        setTimeout( function(){ 
                            $('.modal-loader2').modal('hide');
                        },1000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.responseText);
                        $('#modal_loader2').modal('hide');
                    }
                });

                return jqXHR;
            }
        },

        show0: function(url) {
            // console.log(payload);
            var jqXHR = $.ajax({
                "url": url,
                "method": 'GET',
                "timeout": 0,
                "headers": {
                    "Content-Type": 'application/json',
                },
                // "data": payload.data,
                "prossesing": true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
                },  
                beforeSend: function(e) {
                    // // if (payload.type == 'delete') {
                    // //     $('#loader_delete').show()
                    // // }else{
                    // //     $('#modal_loader_input').show()
                    // // }

                    // if (payload.action == 'delete') {
                    //     $('#loader_delete').show()
                    // }else if (payload.action == 'multiple_delete') {
                    //     $('#loader_mulitple_delete').show()
                    // }else if (payload.action == 'insert' || payload.action == 'update') {
                    //     $('#modal_loader_input').show()
                    // }

                    // if(e && e.overrideMimeType) {
                    //     e.overrideMimeType('application/jsoncharset=UTF-8')
                    // }
                    // $('#response_message, #response_message_modal, #response_message_modal_modal').removeClass('text-success msg_animation');
                },
                complete: function(){
                    // if (payload.action == 'delete') {
                    //     $('#loader_delete').hide()
                    // }else if (payload.action == 'multiple_delete') {
                    //     $('#loader_mulitple_delete').hide()
                    // }else if (payload.action == 'insert' || payload.action == 'update') {
                    //     $('#modal_loader_input').hide()
                    // }
                    // // $('#loader_delete').hide()
                    // // $('#loader_mulitple_delete').hide()
                    // // $('#modal_loader_input').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        ummu: function(url, payload) {
            // console.log(payload);
            var jqXHR = $.ajax({
                "url": url,
                "method": payload.type,
                "timeout": 0,
                "headers": {
                    "Content-Type": payload.contentType,
                },
                "data": payload.data,
                "prossesing": true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
                },  
                beforeSend: function(e) {
                    $('#modal_loader').modal('show')
                    // if (payload.type == 'delete') {
                    //     $('#loader_delete').show()
                    // }else{
                    //     $('#modal_loader_input').show()
                    // }

                    if (payload.action == 'delete') {
                        $('#loader_delete').show()
                    }else if (payload.action == 'multiple_delete') {
                        $('#loader_mulitple_delete').show()
                    }else if (payload.action == 'insert' || payload.action == 'update') {
                        $('#modal_loader_input').show()
                    }

                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    $('#response_message, #response_message_modal, #response_message_modal_modal').removeClass('text-success msg_animation');
                },
                complete: function(){
                    if (payload.action == 'delete') {
                        $('#loader_delete').hide()
                    }else if (payload.action == 'multiple_delete') {
                        $('#loader_mulitple_delete').hide()
                    }else if (payload.action == 'insert' || payload.action == 'update') {
                        $('#modal_loader_input').hide()
                    }
                    // $('#loader_delete').hide()
                    // $('#loader_mulitple_delete').hide()
                    // $('#modal_loader_input').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        ummu2: function(params) {
            // console.log(payload);
            var jqXHR = $.ajax({
                "url": params.url,
                "method": params.type,
                "timeout": 0,
                "headers": {
                    "Content-Type": params.contentType,
                },
                "data": params.data,
                "prossesing": true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
                },  
                beforeSend: function(e) {
                    $('#modal_loader').modal('show');
                    // if (payload.type == 'delete') {
                    //     $('#loader_delete').show()
                    // }else{
                    //     $('#modal_loader_input').show()
                    // }

                    if (params.action == 'delete') {
                        $('#loader_delete').show()
                    }else if (params.action == 'multiple_delete') {
                        $('#loader_mulitple_delete').show()
                    }else if (params.action == 'insert' || params.action == 'update') {
                        $('#modal_loader_input').show()
                    }

                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    $('#response_message, #response_message_modal, #response_message_modal_modal').removeClass('text-success msg_animation');
                },
                complete: function(){
                    if (params.action == 'delete') {
                        $('#loader_delete').hide()
                    }else if (params.action == 'multiple_delete') {
                        $('#loader_mulitple_delete').hide()
                    }else if (params.action == 'insert' || params.action == 'update') {
                        $('#modal_loader_input').hide()
                    }
                    // $('#loader_delete').hide()
                    // $('#loader_mulitple_delete').hide()
                    // $('#modal_loader_input').hide()

                    // console.log(response)
                    setTimeout( function(){ 
                        $('.modal-loader').modal('hide');
                    },1000);
                },
                success: function(response){
                    // 
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    $('#modal_loader').modal('hide');
                }
            });

            return jqXHR;
        },

        ummu3: function(params) {
            // console.log(params.data);
            var jqXHR = $.ajax({
                "url": params.url,
                "method": params.type,
                "timeout": 0,
                "headers": {
                    "Content-Type": params.contentType,
                },
                "data": params.data,
                "prossesing": true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
                },  
                beforeSend: function(e) {
                    $('#modal_loader').modal('show');
                },
                complete: function(){
                    // 
                },
                success: function(response){
                    // console.log(response)
                    setTimeout( function(){ 
                        $('.modal-loader').modal('hide');
                    },1000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                    $('#modal_loader').modal('hide');
                }
            });

            return jqXHR;
        },

        ummay: function(url, payload) {
            // console.log(payload);
            var jqXHR = $.ajax({
                "url": url,
                "method": payload.type,
                "timeout": 0,
                "headers": {
                    "Content-Type": payload.contentType,
                },
                "data": payload.data,
                beforeSend: function(e) {
                    // if (payload.action == 'delete') {
                    //     $('#loader_delete').show()
                    // }else if (payload.action == 'multiple_delete') {
                    //     $('#loader_mulitple_delete').show()
                    // }else if (payload.action == 'insert' || payload.action == 'update') {
                    //     $('#modal_loader_input').show()
                    // }
                    $('.modal-loader').modal('show');

                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    // $('#response_message').removeClass('text-success msg_animation');
                },
                complete: function(){
                    if (payload.action == 'delete') {
                        $('#loader_delete').hide()
                    }else if (payload.action == 'multiple_delete') {
                        $('#loader_mulitple_delete').hide()
                    }else if (payload.action == 'insert' || payload.action == 'update') {
                        $('#modal_loader_input').hide()
                    }

                    setTimeout( function(){ 
                        $('.modal-loader').modal('hide');
                    },1000);
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        ummuUpload: function() {
            var formData = new FormData();
            formData.append('file_mygallery', $('#file_mygallery')[0].files[0]);
            return $.ajax({
                "url": $base_url + 'mygallery/create',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData,
                beforeSend: function(e) {
                    $('#modal_loader').modal('show');
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    setTimeout( function(){ 
                        $('.modal-loader').modal('hide');
                    },1000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });
        },

        show: function(url, payload) {
            console.log(payload)
            // var data = params.data;
            // // console.log(data)

            // if (data.sort) {
            //     var sort = data.sort;
            // }else{
            //     var sort = "id"
            // }

            // if (data.order) {
            //     var order = data.order;
            // }else{
            //     var order = "desc"
            // }

            // var jqXHR = $.ajax({
            //     "url": url + "?limit=" + data.limit + "&offset=" + data.offset + "&sort=" + sort + "&order=" + order + "&search=" + data.search,
            //     "method": "GET",
            //     "timeout": 0,
            // });

            // return jqXHR;

            var jqXHR = $.ajax({
                "url": url,
                "method": payload.type,
                "timeout": 0,
                "headers": {
                    "Content-Type": payload.contentType,
                },
                "data": payload.data,
                beforeSend: function(e) {
                    $('#modal_loader_input').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    // $('#response_message').html('');
                    $('#response_message').removeClass('text-success msg_animation');
                },
                complete: function(){
                    setTimeout( function(){ 
                        $('#modal_loader').modal('hide');
                    },1000);
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        findAll: function(params, url) {
            var data = params.data;
            // console.log(data)

            if (data.sort) {
                var sort = data.sort;
            }else{
                var sort = "id"
            }

            if (data.order) {
                var order = data.order;
            }else{
                var order = "desc"
            }

            var jqXHR = $.ajax({
                "url": $base_url + url + "/findAll?limit=" + data.limit + "&offset=" + data.offset + "&sort=" + sort + "&order=" + order + "&search=" + data.search,
                "method": "GET",
                "timeout": 0,
            });

            return jqXHR;
        },

        save: function(url, method, payload) {
            console.log(payload)
            // var jqXHR = $.ajax({
            //     "url": url,
            //     "method": method,
            //     "timeout": 0,
            //     "headers": {
            //         "Content-Type": "application/json",
            //     },
            //     "data": payload,
            //     beforeSend: function(e) {
            //         $('#modal_loader_input').show()
            //         if(e && e.overrideMimeType) {
            //             e.overrideMimeType('application/jsoncharset=UTF-8')
            //         }
            //         $('#response_message').html('');
            //         $('#response_message').removeClass('text-success msg_animation');
            //     },
            //     complete: function(){
            //         $('#modal_loader_input').hide()
            //     },
            //     success: function(response){
            //         // console.log(response)
            //     },
            //     error: function (xhr, ajaxOptions, thrownError) {
            //         alert(xhr.responseText);
            //     }
            // });

            // return jqXHR;
        },

        create: function(url, payload) {
            var jqXHR = $.ajax({
                "url": url,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": payload,
                beforeSend: function(e) {
                    $('#modal_loader_input').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    $('#response_message').html('');
                    $('#response_message').removeClass('text-success msg_animation');
                },
                complete: function(){
                    $('#modal_loader_input').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        update: function(url, payload) {
            var jqXHR = $.ajax({
                "url": url,
                "method": "PUT",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": payload,
                beforeSend: function(e) {
                    $('#modal_loader_input').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                    $('#response_message').html('');
                    $('#response_message').removeClass('text-success msg_animation');
                },
                complete: function(){
                    $('#modal_loader_input').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });

            return jqXHR;
        },

        delete: function(url, params) {
            // 
        },

        multiple_delete(url,rows) {
            // console.log(rows)

            $('#btn_approve').prop('disabled', true);
            $('#modal_loader_approval').show();

            var r = [];
            $.each(rows, function( index, value ) {
                r[index] = {};

                r[index] = value.id;
                // r[index].appv_remark = "by multiple approve";
                // r[index].doc_number = value.doc_code;

                // var d = [];
                // $.each(value.detail, function( index2, value2) {
                //     d[index2] = {};

                //     // d[index2].status = 1;
                //     // d[index2].comment = "by multiple approve";
                //     // d[index2].part_code = value2.Prod_code;
                //     // d[index2].part_qty = value2.part_qty;
                //     // d[index2].harga = value2.harga;
                //     // d[index2].disc = value2.Disc;
                //     // d[index2].nomer = value2.nomer;
                //     d[index2].id = value2.id;
                // })

                // r[index].details = d;
            });

            var payload = JSON.stringify(
            {
                "body": {
                    "ids": r
                }
            });

            console.log(payload)

            // var payload = JSON.stringify(
            // {
            //     "body": {
            //         "ids": $ummu.func.getIdSelections()
            //     }
            // });

            var params = {
                "type": "delete",
                "action": "multiple_delete",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };

            // // var url = $base_url + "admin/ruangan/delete";
            var ummu = $ummu.ajax.ummay(url, params);
            ummu.done(function(result) {
                var response = JSON.parse(result);
                // if (response.status==true) {
                //     $globFunc.ch_message(response.message);
                //     $table.bootstrapTable('remove', {
                //         field: 'id',
                //         values: $globFunc.getIdSelections()
                //     })
                //     $remove.prop('disabled', true)
                // }else{
                //     $('#modal_alert_input').html("");
                //     var errors = response.errors;
                //     $('#modal_alert_input').addClass('bg-danger');
                //     for(let index in errors){
                //         $('#modal_alert_input').append("<li>"+errors[index]+"</li>");
                //     }
                //     $('#modal_alert_input').fadeIn().delay(3000).fadeOut();
                // }
                // $('#modal_confirmation_multiple_delete').modal('hide')
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        wilayahIndonesia: {
            getRegencies: function(provincie_id,auto_slected) {
                $.ajax({
                    type: 'GET',
                    url: $base_url + "admin/referensi/wilayah_indonesia/regencies/"+provincie_id,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                }).done(function(result) {
                    var data = result;
                    console.log(data)
                    for(let index in data){
                        if (data[index].id==auto_slected) {
                            var selected_auto = "selected";
                        }else{
                            var selected_auto = "";
                        }
                        $('#regencies').append("<option value='"+data[index].id+"'"+selected_auto+" >"+data[index].name+"</option>");
                    }
                    $('#regencies').attr('disabled', false);
                    
                    $("#regencies").select2({ 
                        dropdownParent: $("#InsertModal"),
                        theme: "bootstrap4",
                    });
                }).fail(function() {
                    // An error occurred
                });
            },

            getDistricts: function(regencie_id,auto_slected) {
                $.ajax({
                    type: 'GET',
                    url: $base_url + "admin/referensi/wilayah_indonesia/districts/"+regencie_id,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                }).done(function(result) {
                    var data = result;
                    console.log(data)
                    for(let index in data){
                        if (data[index].id==auto_slected) {
                            var selected_auto = "selected";
                        }else{
                            var selected_auto = "";
                        }
                        $('#districts').append("<option value='"+data[index].id+"'"+selected_auto+">"+data[index].name+"</option>");
                    }
                    $('#districts').attr('disabled', false);

                    $("#districts").select2({ 
                        dropdownParent: $("#InsertModal"),
                        theme: "bootstrap4",
                    });
                }).fail(function() {
                    // An error occurred
                });
            },

            getVillages: function(district_id,auto_slected) {
                $.ajax({
                    type: 'GET',
                    url: $base_url + "admin/referensi/wilayah_indonesia/villages/"+district_id,
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                }).done(function(result) {
                    var data = result;
                    console.log(data)
                    for(let index in data){
                        if (data[index].id==auto_slected) {
                            var selected_auto = "selected";
                        }else{
                            var selected_auto = "";
                        }
                        $('#villages').append("<option value='"+data[index].id+"'"+selected_auto+">"+data[index].name+"</option>");
                    }
                    $('#villages').attr('disabled', false);

                    $("#villages").select2({ 
                        dropdownParent: $("#InsertModal"),
                        theme: "bootstrap4",
                    });
                }).fail(function() {
                    // An error occurred
                });
            }
        },

        masterData: {
        },    

        getRefStatusMahasiswa: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/get_ref_status_mahasiswa/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getRefJenisTinggal: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/jenis_tinggal/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getRefAlatTransportasi: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/alat_transportasi/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getRefPekerjaan: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/pekerjaan/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getRefPenghasilan: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/penghasilan/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getRefPendidikan: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/pendidikan/",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        getProdi: function() {
            var jqXHR = $.ajax({
                type: 'GET',
                url: $base_url + "admin/prodi/findAll?limit=10&offset=0&sort=id&order=desc&search=",
                dataType: 'JSON',
                contentType: false,
                processData: false,
            });

            return jqXHR;
        },

        aumImport: function(url) {
            var form = new FormData();
            form.append("file", $('#file_import')[0].files[0]);
            // console.log(form);

            var settings = {
                "url": url,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    // "Content-Type": "multipart/form-data"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form,
                beforeSend: function(e) {
                    $('#modal_import #loader').show();
                },
                complete: function(){
                    $('#modal_import #loader').hide();
                },
                success: function(response){
                    console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            };

            return $.ajax(settings);
        },

        aumImport2: function(url) {
            var form = new FormData();
            form.append("file", $('#file_import')[0].files[0]);
            form.append("periode_id", $('#periode').val());
            // console.log(form);

            var settings = {
                "url": url,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    // "Content-Type": "multipart/form-data"
                },
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form,
                beforeSend: function(e) {
                    $('#modal_import2 #loader').show();
                },
                complete: function(){
                    $('#modal_import2 #loader').hide();
                },
                success: function(response){
                    console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            };

            return $.ajax(settings);
        },

        payroll: {
            payslip_periode: {
                create: function() {
                    // 
                }
            }
        },

        mygallery: {
            photos: {
                upload: function() {
                    var formData = new FormData();
                    formData.append('file_upload', $('#file_upload')[0].files[0]);
                    formData.append('file_description', $('#file_description').val());
                    return $.ajax({
                        "url": $base_url + 'mygallery/photos/create',
                        "method": "POST",
                        "timeout": 0,
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": formData,
                        beforeSend: function(e) {
                            $('#modal_loader').modal('show');
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType('application/jsoncharset=UTF-8')
                            }
                        },
                        complete: function(){
                            setTimeout( function(){ 
                                $('.modal-loader').modal('hide');
                            },1000);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.responseText);
                        }
                    });
                }
            }
        },

        hazard_report: {
            release: function() {
                var rows = $ummu.vars.rows;
                var url = globalVar.pageUrl;
                var r = [];
                $.each(rows, function( index, value ) {
                    r[index] = {};
                    r[index] = value.id;
                });

                var payload = JSON.stringify(
                {
                    "body": {
                        "ids": r
                    }
                });

                var params = {
                    "url": url + 'release',
                    "type": "put",
                    // "action": "insert",
                    "data": payload,
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };

                // console.log(params)

                $('#text_loader').html('Release in process...');
                var ummu = $ummu.ajax.ummu3(params);
                $('#modal_release_confirm').modal('hide');
                ummu.done(function(result) {
                    // var response = JSON.parse(result);
                    // console.log(result)
                    table.rows('.selected').remove().draw();
                    // $ummu.dt.after_cud();
                }).fail(function() {
                        // An error occurred
                    console.log(ummu)
                });
            },
            approve: function() {
                var rows = $ummu.vars.rows;
                var url = globalVar.pageUrl;
                var r = [];
                $.each(rows, function( index, value ) {
                    r[index] = {};
                    r[index] = value.id;
                });

                var payload = JSON.stringify(
                {
                    "body": {
                        "ids": r
                    }
                });

                var params = {
                    "url": url + 'approve',
                    "type": "put",
                    // "action": "insert",
                    "data": payload,
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };

                // console.log(params)

                $('#text_loader').html('Approve in process...');
                var ummu = $ummu.ajax.ummu3(params);
                $('#modal_approve_confirm').modal('hide');
                ummu.done(function(result) {
                    // var response = JSON.parse(result);
                    // console.log(result)
                    table.rows('.selected').remove().draw();
                    // $ummu.dt.after_cud();
                }).fail(function() {
                        // An error occurred
                    console.log(ummu)
                });
            },
            reject: function() {
                var rows = $ummu.vars.rows;
                var url = globalVar.pageUrl;
                var r = [];
                $.each(rows, function( index, value ) {
                    r[index] = {};
                    r[index] = value.id;
                });

                var payload = JSON.stringify(
                {
                    "body": {
                        "ids": r
                    }
                });

                var params = {
                    "url": url + 'reject',
                    "type": "put",
                    // "action": "insert",
                    "data": payload,
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };

                // console.log(params)

                $('#text_loader').html('Reject in process...');
                var ummu = $ummu.ajax.ummu3(params);
                $('#modal_reject_confirm').modal('hide');
                ummu.done(function(result) {
                    // var response = JSON.parse(result);
                    // console.log(result)
                    table.rows('.selected').remove().draw();
                    // $ummu.dt.after_cud();
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        }
    },

    func: {
        ch_message: function(message) {
            const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
            $('#response_message').html(text).addClass('text-success msg_animation');
        },

        ch_message_modal: function(message) {
            const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
            $('#response_message_modal').html(text).addClass('text-success msg_animation');
        },

        ch_message_modal_modal: function(message) {
            const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
            $('#response_message_modal_modal').removeClass().html(text).addClass('text-success msg_animation');
        },

        countDate: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            var inJam = Math.floor(inMenit / 60);
            var inHari = Math.floor(inJam / 24);

            var menit = inMenit - (inJam * 60);
            var jam = inJam - (inHari * 24);

            var response = inHari + " days, " + jam + " hours, " + menit + " minutes";

            // console.log(jam)
            return response;
        },

        countDate2: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            var inJam = Math.floor(inMenit / 60);
            var inHari = Math.floor(inJam / 24);

            var menit = inMenit - (inJam * 60);
            var jam = inJam - (inHari * 24);

            var response = inHari + " <span class='text-muted'>days</span>, " + jam + " <span class='text-muted'>hours</span>, " + menit + " <span class='text-muted'>minutes</span>";

            // console.log(jam)
            return response;
        },

        countDate3: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            var inJam = Math.floor(inMenit / 60);
            var inHari = Math.floor(inJam / 24);

            var menit = inMenit - (inJam * 60);
            var jam = inJam - (inHari * 24);

            var response = inHari + " day, " + jam + " hour, " + menit + " minute";

            // console.log(jam)
            return response;
        },

        countDate4: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            var inJam = Math.floor(inMenit / 60);
            var inJamK = inMenit / 60;

            return inJamK.toFixed(2);
        },

        datetime: {
            jmlMenit: function(datetime1, datetime2) {
                var inDetik = new Date(datetime2) - new Date(datetime1);
                var inMenit = Math.floor(inDetik / 60000);

                return inMenit;
            },
            jmlJam: function(datetime1, datetime2) {
                var inDetik = new Date(datetime2) - new Date(datetime1);
                var inMenit = Math.floor(inDetik / 60000);
                var inJam = Math.floor(inMenit / 60);
                var inJamK = inMenit / 60;

                return inJamK.toFixed(2);
            },
            toText: function(datetime1, datetime2) {
                var inDetik = new Date(datetime2) - new Date(datetime1);
                var inMenit = Math.floor(inDetik / 60000);
                var inJam = Math.floor(inMenit / 60);
                var inHari = Math.floor(inJam / 24);

                var menit = inMenit - (inJam * 60);
                var jam = inJam - (inHari * 24);

                var response = inHari + " day, " + jam + " hour, " + menit + " minute";

                return response;
            },
        },

        countDate4: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            var inJam = Math.floor(inMenit / 60);
            var inJamK = inMenit / 60;

            return inJamK.toFixed(2);
        },

        countMinute: function(datetime1, datetime2) {
            var inDetik = new Date(datetime2) - new Date(datetime1);
            var inMenit = Math.floor(inDetik / 60000);
            // var inJam = Math.floor(inMenit / 60);
            // var inHari = Math.floor(inJam / 24);

            // var menit = inMenit - (inJam * 60);
            // var jam = inJam - (inHari * 24);

            // var response = inHari + " days, " + jam + " hours, " + menit + " minutes";

            // console.log(jam)
            return inMenit;
        },

        getIdSelections: function() {
            return $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            })
        },

        set_value_to_option: function(rows,element_id,kode) {
            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                if (kode == 1) {
                    var text = rows[index].kode + ' - ' + rows[index].name;
                }else{
                    var text = rows[index].name;
                }
                $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
            }
        },

        set_value_to_option2: function(rows,element_id,kode) {
            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                if (kode == 1) {
                    var text = rows[index].kode + ' | ' + rows[index].name;
                }else{
                    var text = rows[index].name;
                }
                $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
            }
        },

        set_value_to_option3: function(params) {
            var rows = params.rows;
            var element_id = params.element_id;
            var kode = params.kode;
            // var data = params.data;

            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                if (kode == 1) {
                    var text = rows[index].kode + ' - ' + rows[index].name;
                }else{
                    var text = rows[index].name;
                }
                $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
            }
        },

        date_ymd: function(data) {
            if (data == 'null' || data == '' || data == null) {
                return '';
            }else{
                var d = new Date(data),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
        },

        img_ratio: function(element_id) {
            var aspectRatio = $('#'+element_id+' img').width()/$('#'+element_id+' img').height();

            if (aspectRatio > 1) {
                $('#'+element_id).addClass('circular--landscape');
            }else if (aspectRatio < 1) {
                $('#'+element_id).addClass('circular--portrait');
            }else{
                $('#'+element_id).addClass('circular--square');
            }
        },

        header_avatar_ratio: function(element_id) {
            var aspectRatio = $(element_id).width()/$(element_id).height();

            if (aspectRatio > 1) {
                $(element_id).addClass('circular--landscape-35');
            }else if (aspectRatio < 1) {
                $(element_id).addClass('circular--portrait-35');
            }else{
                $(element_id).addClass('circular--square-35');
            }
        },

        location_hash: function() {
            var urlhash = window.location.hash;
            var urlhashc = Cookies.get('urlhash');

            if (urlhash == urlhashc) {
                $('.nav-tabs li .nav-link').removeClass('active')
                $("[data-bs-target='"+urlhash+"']").addClass('active');

                $('.tab-content .tab-pane').removeClass('active').removeClass('show')
                $(".tab-content "+urlhash).addClass('active').addClass('show');
            }
        },

        rm_elinarr: function(array, value) {
            return array.filter(function (letter) {
                return letter !== value;
            });
        },

        removeItem: function (arr, item){
            return arr.filter(f => f !== item);
        },

        between: function (x, min, max) {
            var x = parseFloat(x);
            var min = parseFloat(min);
            var max = parseFloat(max);

            return x >= min && x <= max;
        },

        betweenNotMin: function (x, min, max) {
            var x = parseFloat(x);
            var min = parseFloat(min);
            var max = parseFloat(max);

            return x > min && x < max;
        },

        betweenNotMax: function (x, min, max) {
            var x = parseFloat(x);
            var min = parseFloat(min);
            var max = parseFloat(max);

            return x >= min && x < max;
        },

        approval: {
            gsum: function() {
                // $('#page_hide_spinner').show();
                // $('#modal_loader').modal('show');
                var params = {
                    "type": "get",
                    "action": "get",
                    "data": {
                        "limit":0,
                        "offset":0,
                        "sort": "kode",
                        "order": "asc",
                        "search": ""
                    },
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };
                var url = $base_url+'/admin/dashboard/approval_sum';
                var ali = $ummu.ajax.ummay(url,params);
                ali.done(function(result) {
                    var response = JSON.parse(result);
                    // console.log(response)
                    $ummu.localStorage.approval.sum.create(response);
                    $ummu.localStorage.approval.sum.show();
                    // $('#page_hide_spinner').hide();
                    // $('#modal_loader').modal('hide');
                }).fail(function() {
                    // An error occurred
                });
            }
        },

        getUrlParameter: function(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) 
            {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) 
                {
                    return sParameterName[1];
                }
            }
        },

        remove_element_by_index: function(index) {
            var tVal = $('#index'+index).val();
            $('#index'+index).remove();
            $ummu.vars.arrayqu = $ummu.func.removeItem($ummu.vars.arrayqu, tVal);
        },

        to_array_from_span_element_by_class: function($class) {
            const arrayqu = [];
            $('.' + $class).each(function() {
                arrayqu.push($(this).text());
            });
            return arrayqu;
        }
    },

    upload: {
        filename: null,
        randomname: null,
        input_id: null,
        image_id: null,
        ids: [],
        filenames: [],

            /*findAll_berangkas: function() {
                // $.ajax({
                //     type: 'GET',
                //     url: $base_url + "admin/berangkas/findAll",
                //     dataType: 'JSON',
                //     contentType: false,
                //     processData: false,
                // }).done(function(result) {
                //     console.log(result.status)
                //     if (result.status == true) {
                //         var data = result.rows;
                //         $('#album_berangkas').empty();
                //         for(let index in data){
                //             var $id = data[index].id;
                //             var filename = data[index].filename;
                //             if(filename == ''){
                //                 var $filename = 'no_image.jpg';
                //             }else{
                //                 var $filename = filename;
                //             }
                //             var $element = '<div class="col">'+
                //                 '<div class="card shadow-sm">'+
                //                     '<img class="img-thumbnail" src="'+ $base_url +'uploads/'+ $filename + '" style="height:160px;">'+
                //                     '<div class="card-body">'+
                //                         '<div class="d-flex justify-content-between align-items-center pt-3">'+
                //                             '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$ummu.upload.hapus_file_berangkas('+$id+')">Hapus</button>'+
                //                             '<button type="button" class="btn btn-sm btn-outline-success pilih-berkas" data-name="'+$filename+'">Pilih</button>'+
                //                         '</div>'+
                //                     '</div>'+
                //                 '</div>'+
                //             '</div>';
                //             $('#album_berangkas').append($element);
                //         }
                //         $('.pilih-berkas').click(function(){
                //             var $data_name = $(this).data('name');
                //             $ummu.upload.input_id.val($data_name)
                //             $('#modal_berangkas_file').modal('hide')
                //             $ummu.upload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                //         })
                //     }else{

                //     }
                // }).fail(function() {
                //     // An error occurred
                // });;

                var params = {
                        "type": "get",
                        "action": "get",
                        "data": {
                            "limit":0,
                            "offset":0,
                            "sort": "id",
                            "order": "desc",
                            "search": ""
                        },
                        "cache": true,
                        "contentType": "application/json",
                        "dataType": "json"
                    };
                    var url = $base_url+'/admin/berangkas/show';
                    var ali = $globalAjax.ummay(url,params);
                    ali.done(function(result) {
                        var response = JSON.parse(result);
                        $globFunc.ch_message_modal_modal(response.message);
                        // console.log(response.message)
                        // var params2 = {
                        //     "rows": response.rows,
                        //     "element_id": 'gedung',
                        //     "kode": 1
                        // };

                        // // $globFunc.set_value_to_option(response.rows,'gedung',1)
                        // // $globFunc.set_value_to_option3(params2)
                        // app.Views.set_value_to_option_gedung(params2)

                        var data = response.rows;
                        $('#album_berangkas').empty();
                        for(let index in data){
                            var $id = data[index].id;
                            var id = data[index].id;
                            var filename = data[index].filename;
                            var description = data[index].description;

                            if(filename == ''){
                                var $filename = 'no_image.jpg';
                            }else{
                                var $filename = filename;
                            }

                            if (description == '' || description == null) {
                                var description_ = filename;
                            }else{
                                var description_ = description;
                            }

                            // var $elementz = '<div class="col">'+
                            //     '<div class="card shadow-sm">'+
                            //         '<img class="img-thumbnail" src="'+ $base_url +'uploads/'+ $filename + '" style="height:160px;">'+
                            //         '<div class="card-body">'+
                            //             '<div class="d-flex justify-content-between align-items-center pt-3">'+
                            //                 '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$ummu.upload.hapus_file_berangkas('+$id+')"><i class="fas fa-trash"></i></button>'+
                            //                 '<button type="button" class="btn btn-sm btn-outline-success pilih-berkas" data-name="'+$filename+'">Pilih</button>'+
                            //                 '<input class="form-check-input dorbitt-checkbox" type="checkbox">'+
                            //             '</div>'+
                            //         '</div>'+
                            //     '</div>'+
                            // '</div>';

                            var $element = '<div class="cont-checkbox">'+
                                '<input type="checkbox" class="dorbitt_checkbox_image_berangkas" name="dorbitt_checkbox_image_berangkas" id="'+id+'" data-name="'+$filename+'" />'+
                                '<label for="'+id+'" class="lbl_berangkas">'+
                                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                                    '<span class="cover-checkbox">'+
                                        '<svg viewBox="0 0 12 10">'+
                                            '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                                        '</svg>'+
                                    '</span>'+
                                    '<div class="info">'+description_+'</div>'+
                                '</label>'+
                            '</div>';
                            $('#album_berangkas').append($element);
                        }
                        $('.pilih-berkas').click(function(){
                            var $data_name = $(this).data('name');
                            $ummu.upload.input_id.val($data_name)
                            $('#modal_berangkas_file').modal('hide')
                            $ummu.upload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                        })
                    }).fail(function() {
                        // An error occurred
                    });
            },*/

        button: function() {
            $('#dorbitt_open_gallery').click(function() {
                var dataImage = $(this).attr('data-image');
                $ummu.upload.show_gallery();
                $('#modal_gallery').modal('show');
                    // $ummu.upload.input_id = input_id;
                    // $ummu.upload.image_id = image_id;
            })

            $('#dorbitt_open_gallery2').click(function() {
                var dataImage = $(this).attr('data-image');
                $ummu.upload.show_gallery2();
                $('#modal_gallery').modal('show');
                    // $ummu.upload.input_id = input_id;
                    // $ummu.upload.image_id = image_id;
            })

            $('#btn_select_file').click(function() {
                var ids = [];
                var filenames = [];
                $('.dorbitt_checkbox_image_gallery:checked').each(function() {
                    var id = $(this).attr('id');
                    var filename = $(this).data('name');

                    ids.push(parseInt(id));
                    filenames.push(filename)
                        // console.log(filename)
                });

                $ummu.upload.ids = ids;
                $ummu.upload.filenames = filenames;

                    /*buat function dan custom sendiri di project masing-masing*/
                app.Views.set_gallery_selected_to_img(filenames)

                $('#modal_gallery').modal('hide');
                    // console.log(ids)
            })
        },

        show_gallery: function() {
            if ($globalVar.page == 'gallery') {
                var page = 'gallery/show';
            }else{
                var page = $globalVar.page+'/show_gallery';
            }
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/'+page;
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+description_+'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                }
                $('.pilih-berkas').click(function(){
                    var $data_name = $(this).data('name');
                    $ummu.upload.input_id.val($data_name)
                    $('#modal_gallery').modal('hide')
                    $ummu.upload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                })
            }).fail(function() {
                    // An error occurred
            });
        },

        show_gallery2: function() {
            var page = 'gallery/show';
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/'+page;
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+description_+'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                }
                $('.pilih-berkas').click(function(){
                    var $data_name = $(this).data('name');
                    $ummu.upload.input_id.val($data_name)
                    $('#modal_gallery').modal('hide')
                    $ummu.upload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                })
            }).fail(function() {
                    // An error occurred
            });
        },

        upload_file_gallery: function() {
            var formData = new FormData();
            formData.append('file_upload', $('#file_upload')[0].files[0]);
            $.ajax({
                "url": $base_url + 'admin/gallery/do_upload',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                    // console.log(response)
                    // console.log(response.status)
                if(response.status==true){
                        // $ummu.upload.randomname = response.name;
                    var payload = JSON.stringify({
                        "body": {
                            "filename": response.name,
                            "description": $('#file_description').val()
                        }
                    })
                    $ummu.upload.insert_file_gallery(payload);
                }else{
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html(response.errors.file_upload).fadeIn().delay(10000).fadeOut();
                }
            }).fail(function() {
                    // An error occurred
            });
        },

        insert_file_gallery: function(payload) {            
            $.ajax({
                "url": $base_url + 'admin/gallery/create',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": payload,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                    // console.log(result)
                var response = JSON.parse(result);
                if (response.status==true) {
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html('Upload sukses').fadeIn().delay(10000).fadeOut();
                    $ummu.upload.show_gallery();
                    $('#upload_img_thumbnail').attr('src', $base_url + 'uploads/no_image.jpg');
                    $('#file_upload, #file_description').val('');
                }else{
                        // $('#message_alert').html("");
                        // var errors = response.message;
                        // for(let index in errors){
                        //     $('#message_alert').append("<li>"+errors[index]+"</li>");
                        // }
                        // $('#message_modal').modal('show');
                }
                $globFunc.ch_message_modal_modal(response.message);
            }).fail(function() {
                    // An error occurred
                console.log(create)
            });
        },

        hapus_file_gallery: function(id) {
            $.ajax({
                "url": $base_url + "admin/gallery/delete/" + id,
                "method": "DELETE",
                "timeout": 0,
                beforeSend: function(e) {
                    $('#modal_loader_gallery').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_gallery').hide()
                },
                success: function(response){
                        // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                console.log(response.status)
                if(response.status==true){
                    $ummu.upload.show_gallery();
                }
            }).fail(function() {
                    // An error occurred
            });
        }
    },

    gallery: {
        filename: null,
        randomname: null,
        input_id: null,
        image_id: null,
        ids: [],
        filenames: [],

        button: function() {
            $('#dorbitt_open_gallery').click(function() {
                $('#modal_loader_gallery').show();
                var dataImage = $(this).attr('data-image');
                $ummu.gallery.show();
                $('#modal_gallery').modal('show');
                // $ummu.gallery.input_id = input_id;
                // $ummu.gallery.image_id = image_id;
            })

            $('#dorbitt_open_gallery2').click(function() {
                $('#modal_loader_gallery').show();
                var dataImage = $(this).attr('data-image');
                $ummu.gallery.show2();
                $('#modal_gallery').modal('show');
                // $ummu.gallery.input_id = input_id;
                // $ummu.gallery.image_id = image_id;
            })

            $('#btn_select_file').click(function() {
                var ids = [];
                var filenames = [];
                $('.dorbitt_checkbox_image_gallery:checked').each(function() {
                    var id = $(this).attr('id');
                    var filename = $(this).data('name');

                    ids.push(parseInt(id));
                    filenames.push(filename)
                    // console.log(filename)
                });

                $ummu.gallery.ids = ids;
                $ummu.gallery.filenames = filenames;
                
                /*buat function dan custom sendiri di project masing-masing*/
                app.Views.set_gallery_selected_to_img(filenames)

                $('#modal_gallery').modal('hide');
                // console.log(ids)
            })
        },

        show: function() {
            if ($globalVar.page == 'gallery') {
                var page = 'gallery/show';
            }else{
                var page = $globalVar.page+'/show_gallery';
            }
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/'+page;
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+description_+'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                }
                $('.pilih-berkas').click(function(){
                    var $data_name = $(this).data('name');
                    $ummu.gallery.input_id.val($data_name)
                    $('#modal_gallery').modal('hide')
                    $ummu.gallery.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                })
                $('#modal_loader_gallery').hide();
            }).fail(function() {
                // An error occurred
            });
        },

        show2: function() {
            var page = 'gallery/show';
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/'+page;
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+description_+'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                    $('#modal_loader_gallery').hide();
                }
                $('.pilih-berkas').click(function(){
                    var $data_name = $(this).data('name');
                    $ummu.gallery.input_id.val($data_name)
                    $('#modal_gallery').modal('hide')
                    $ummu.gallery.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                })
            }).fail(function() {
                // An error occurred
            });
        },

        gallery_file_gallery: function() {
            var formData = new FormData();
            formData.append('file_gallery', $('#file_gallery')[0].files[0]);
            $.ajax({
                "url": $base_url + 'admin/gallery/do_gallery',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                // console.log(response)
                // console.log(response.status)
                if(response.status==true){
                    // $ummu.gallery.randomname = response.name;
                    var payload = JSON.stringify({
                        "body": {
                            "filename": response.name,
                            "description": $('#file_description').val()
                        }
                    })
                    $ummu.gallery.insert_file_gallery(payload);
                }else{
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html(response.errors.file_gallery).fadeIn().delay(10000).fadeOut();
                }
            }).fail(function() {
                // An error occurred
            });
        },

        insert_file_gallery: function(payload) {            
            $.ajax({
                "url": $base_url + 'admin/gallery/create',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": payload,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                // console.log(result)
                var response = JSON.parse(result);
                if (response.status==true) {
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html('gallery sukses').fadeIn().delay(10000).fadeOut();
                    $ummu.gallery.show();
                    $('#gallery_img_thumbnail').attr('src', $base_url + 'gallerys/no_image.jpg');
                    $('#file_gallery, #file_description').val('');
                }else{
                    // $('#message_alert').html("");
                    // var errors = response.message;
                    // for(let index in errors){
                    //     $('#message_alert').append("<li>"+errors[index]+"</li>");
                    // }
                    // $('#message_modal').modal('show');
                }
                $globFunc.ch_message_modal_modal(response.message);
            }).fail(function() {
                // An error occurred
                console.log(create)
            });
        },

        hapus_file_gallery: function(id) {
            $.ajax({
                "url": $base_url + "admin/gallery/delete/" + id,
                "method": "DELETE",
                "timeout": 0,
                beforeSend: function(e) {
                    $('#modal_loader_gallery').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_gallery').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                console.log(response.status)
                if(response.status==true){
                    $ummu.gallery.show();
                }
            }).fail(function() {
                // An error occurred
            });
        }
    },

    mygallery: {
        filename: null,
        randomname: null,
        input_id: null,
        image_id: null,
        ids: [],
        filenames: [],
        paths: [],
        element_inputid: null,
        element_imageid: null,

        autoload: function() {
            $('.btn-show-mygallery').on('click', function() {
                var dataImage = $(this).attr('data-image');
                var dataInputID = $(this).attr('data-inputid');
                var dataImageID = $(this).attr('data-imageid');
                $ummu.mygallery.element_inputid = dataInputID;
                $ummu.mygallery.element_imageid = dataImageID;
                $ummu.mygallery.photos.show_for_modal();
                $('#modal_loader_gallery').show();
                $('#modal_mygallery').modal('show');
            });

            $('#mygallery_btn_select_file').on('click', function() {
                var ids = [];
                var filenames = [];
                var paths = [];
                $('.dorbitt_checkbox_image_gallery:checked').each(function() {
                    var id = $(this).attr('id');
                    var filename = $(this).data('name');
                    var path = $(this).data('path');

                    ids.push(parseInt(id));
                    filenames.push(filename);
                    paths.push(path);
                });

                $ummu.mygallery.ids = ids;
                $ummu.mygallery.filenames = filenames;
                $ummu.mygallery.paths = paths;

                $('#'+$ummu.mygallery.element_inputid).val(filenames);
                $('#'+$ummu.mygallery.element_inputid).attr('data-id',ids);
                $('#'+$ummu.mygallery.element_imageid).attr('src',paths);

                $('#modal_mygallery').modal('hide');
            })
        },

        show: function() {
            // if ($globalVar.page == 'gallery') {
            //     var page = 'gallery/show';
            // }else{
            //     var page = $globalVar.page+'/show_gallery';
            // }
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/mygallery/show';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;
                    var path = data[index].path;
                    var file_url = data[index].file_url;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox mr-2">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+ filename +'" data-path="'+ file_url +'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ file_url + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+ description_ +'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                }
                // $('.pilih-berkas').click(function(){
                //     var $data_name = $(this).data('name');
                //     $ummu.mygallery.input_id.val($data_name)
                //     $('#modal_gallery').modal('hide')
                //     $ummu.mygallery.image_id.attr('src', path2)
                // })
                $('#modal_loader_gallery').hide();
            }).fail(function() {
                // An error occurred
            });
        },

        show2: function() {
            var page = 'gallery/show';
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": "",
                    "created_by": true
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = $base_url+'/admin/'+page;
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                $globFunc.ch_message_modal_modal(response.message);
                var data = response.rows;
                $('#album_gallery').empty();
                for(let index in data){
                    var $id = data[index].id;
                    var id = data[index].id;
                    var filename = data[index].filename;
                    var description = data[index].description;

                    if(filename == ''){
                        var $filename = 'no_image.jpg';
                    }else{
                        var $filename = filename;
                    }

                    if (description == '' || description == null) {
                        var description_ = filename;
                    }else{
                        var description_ = description;
                    }

                    var $element = '<div class="cont-checkbox">'+
                    '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
                    '<label for="'+id+'" class="lbl_gallery">'+
                    '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                    '<span class="cover-checkbox">'+
                    '<svg viewBox="0 0 12 10">'+
                    '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                    '</svg>'+
                    '</span>'+
                    '<div class="info">'+description_+'</div>'+
                    '</label>'+
                    '</div>';
                    $('#album_gallery').append($element);
                    $('#modal_loader_gallery').hide();
                }
                $('.pilih-berkas').click(function(){
                    var $data_name = $(this).data('name');
                    $ummu.gallery.input_id.val($data_name)
                    $('#modal_gallery').modal('hide')
                    $ummu.gallery.image_id.attr('src', $base_url + 'uploads/' + $data_name)
                })
            }).fail(function() {
                // An error occurred
            });
        },

        gallery_file_gallery: function() {
            var formData = new FormData();
            formData.append('file_gallery', $('#file_gallery')[0].files[0]);
            $.ajax({
                "url": $base_url + 'admin/gallery/do_gallery',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": formData,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                // console.log(response)
                // console.log(response.status)
                if(response.status==true){
                    // $ummu.gallery.randomname = response.name;
                    var payload = JSON.stringify({
                        "body": {
                            "filename": response.name,
                            "description": $('#file_description').val()
                        }
                    })
                    $ummu.gallery.insert_file_gallery(payload);
                }else{
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html(response.errors.file_gallery).fadeIn().delay(10000).fadeOut();
                }
            }).fail(function() {
                // An error occurred
            });
        },

        insert_file_gallery: function(payload) {            
            $.ajax({
                "url": $base_url + 'admin/gallery/create',
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": payload,
                beforeSend: function(e) {
                    $('#modal_loader_submit_file').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_submit_file').hide()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                // console.log(result)
                var response = JSON.parse(result);
                if (response.status==true) {
                    $('#modal_alert_submit_file').addClass('bg-success');
                    $('#modal_alert_submit_file').html('gallery sukses').fadeIn().delay(10000).fadeOut();
                    $ummu.gallery.show();
                    $('#gallery_img_thumbnail').attr('src', $base_url + 'gallerys/no_image.jpg');
                    $('#file_gallery, #file_description').val('');
                }else{
                    // $('#message_alert').html("");
                    // var errors = response.message;
                    // for(let index in errors){
                    //     $('#message_alert').append("<li>"+errors[index]+"</li>");
                    // }
                    // $('#message_modal').modal('show');
                }
                $globFunc.ch_message_modal_modal(response.message);
            }).fail(function() {
                // An error occurred
                console.log(create)
            });
        },

        hapus_file_gallery: function(id) {
            $.ajax({
                "url": $base_url + "admin/gallery/delete/" + id,
                "method": "DELETE",
                "timeout": 0,
                beforeSend: function(e) {
                    $('#modal_loader_gallery').show()
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType('application/jsoncharset=UTF-8')
                    }
                },
                complete: function(){
                    $('#modal_loader_gallery').hide()
                },
                success: function(response){
                    // console.log(response)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            })
            .done(function(result) {
                var response = JSON.parse(result);
                console.log(response.status)
                if(response.status==true){
                    $ummu.gallery.show();
                }
            }).fail(function() {
                // An error occurred
            });
        },

        photos: {
            show: function() {
                // if ($globalVar.page == 'gallery') {
                //     var page = 'gallery/show';
                // }else{
                //     var page = $globalVar.page+'/show_gallery';
                // }
                var params = {
                    // "url": $base_url+'/mygallery/photos/show',
                    "type": "get",
                    "action": "get",
                    "data": {
                        "limit":0,
                        "offset":0,
                        "sort": "id",
                        "order": "desc",
                        "search": "",
                        "created_by": true
                    },
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };
                var url = $base_url+'/mygallery/photos/show';
                var ali = $ummu.ajax.ummay(url, params);
                ali.done(function(result) {
                    var response = JSON.parse(result);
                    $globFunc.ch_message_modal_modal(response.message);
                    var data = response.rows;
                    $('#album_gallery').empty();
                    for(let index in data){
                        var $id = data[index].id;
                        var id = data[index].id;
                        var filename = data[index].filename;
                        var description = data[index].description;
                        var path = data[index].path;
                        var file_url = data[index].file_url;

                        if(filename == ''){
                            var $filename = 'no_image.jpg';
                        }else{
                            var $filename = filename;
                        }

                        if (description == '' || description == null) {
                            var description_ = filename;
                        }else{
                            var description_ = description;
                        }

                        // var $element = '<div class="cont-checkbox mr-2">'+
                        //     '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+ filename +'" data-path="'+ path2 +'" />'+
                        //     '<label for="'+id+'" class="lbl_gallery">'+
                        //         '<img src="'+ path2 + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                        //         '<span class="cover-checkbox">'+
                        //             '<svg viewBox="0 0 12 10">'+
                        //                 '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                        //             '</svg>'+
                        //         '</span>'+
                        //         '<div class="info">'+ description_ +'</div>'+
                        //     '</label>'+
                        // '</div>';
                        // // $('#album_gallery').append($element);

                        var html = '<div class="col-md-2" id="mygallery_frame'+id+'">'+
                        '<div class="card mb-4 shadow-sm">'+
                                // '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">'+
                                //     '<title>Placeholder</title>'+
                                //     '<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>'+
                                // '</svg>'+
                        '<img src="'+ file_url +'" class="img-thumbnail" alt="...">'+

                        '<div class="card-body">'+
                                    // '<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>'+
                        '<div class="d-flex justify-content-between align-items-center">'+
                        '<div class="btn-group">'+
                        // '<button type="button" class="btn btn-sm btn-outline-secondary">View</button>'+
                        '<button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>'+
                        '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$ummu.mygallery.photos.delete('+id+');"><i class="fas fa-trash-alt"></i></button>'+
                        '</div>'+
                        '<small class="text-muted">9 mins</small>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                        $('#mygallery_album_photos').append(html);
                    }

                    // console.log(response)

                    // $('.pilih-berkas').click(function(){
                    //     var $data_name = $(this).data('name');
                    //     $ummu.mygallery.input_id.val($data_name)
                    //     $('#modal_gallery').modal('hide')
                    //     $ummu.mygallery.image_id.attr('src', path2)
                    // })
                    // $('#modal_loader_gallery').hide();
                }).fail(function() {
                    // An error occurred
                });
            },
            show_for_modal: function() {
                // if ($globalVar.page == 'gallery') {
                //     var page = 'gallery/show';
                // }else{
                //     var page = $globalVar.page+'/show_gallery';
                // }
                var params = {
                    "type": "get",
                    "action": "get",
                    "data": {
                        "limit":0,
                        "offset":0,
                        "sort": "id",
                        "order": "desc",
                        "search": "",
                        "created_by": true
                    },
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };
                var url = $base_url+'/mygallery/photos/show';
                var ali = $globalAjax.ummay(url,params);
                ali.done(function(result) {
                    var response = JSON.parse(result);
                    $globFunc.ch_message_modal_modal(response.message);
                    var data = response.rows;
                    $('#album_gallery').empty();
                    for(let index in data){
                        var $id = data[index].id;
                        var id = data[index].id;
                        var filename = data[index].filename;
                        var description = data[index].description;
                        var path = data[index].path;
                        var file_url = data[index].file_url;

                        if(filename == ''){
                            var $filename = 'no_image.jpg';
                        }else{
                            var $filename = filename;
                        }

                        if (description == '' || description == null) {
                            var description_ = filename;
                        }else{
                            var description_ = description;
                        }

                        var $element = '<div class="cont-checkbox mr-2">'+
                        '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+ filename +'" data-path="'+ file_url +'" />'+
                        '<label for="'+id+'" class="lbl_gallery">'+
                        '<img src="'+ file_url + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                        '<span class="cover-checkbox">'+
                        '<svg viewBox="0 0 12 10">'+
                        '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                        '</svg>'+
                        '</span>'+
                        '<div class="info">'+ description_ +'</div>'+
                        '</label>'+
                        '</div>';
                        $('#album_gallery').append($element);
                    }
                    // $('.pilih-berkas').click(function(){
                    //     var $data_name = $(this).data('name');
                    //     $ummu.mygallery.input_id.val($data_name)
                    //     $('#modal_gallery').modal('hide')
                    //     $ummu.mygallery.image_id.attr('src', path2)
                    // })
                    $('#modal_loader_gallery').hide();
                }).fail(function() {
                    // An error occurred
                });
            },
            btn_mygallery_photos_submit: function() {
                $('#btn_mygallery_photos_submit').on('click', function() {
                    if ($('#file_upload').val() == '') {
                        alert('Please choose file.');
                    } else {
                        var ali = $ummu.ajax.mygallery.photos.upload();
                        ali.done(function(result) {
                            var response = JSON.parse(result);
                            console.log(response);

                            var html = '<div class="col-md-2">'+
                            '<div class="card mb-4 shadow-sm">'+
                                // '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">'+
                                //     '<title>Placeholder</title>'+
                                //     '<rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>'+
                                // '</svg>'+
                            '<img src="'+ response.data.url +'" class="img-thumbnail" alt="...">'+

                            '<div class="card-body">'+
                                    // '<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>'+
                            '<div class="d-flex justify-content-between align-items-center">'+
                            '<div class="btn-group">'+
                            '<button type="button" class="btn btn-sm btn-outline-secondary">View</button>'+
                            '<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>'+
                            '</div>'+
                            '<small class="text-muted">9 mins</small>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                            $('#mygallery_album_photos').prepend(html);

                            $('.custom-file label').html('Choose file');
                            $('#file_upload').val('');
                        })  
                    }
                })
            },
            btn_mygallery_photos_submit_on_modal: function() {
                $('#modal_mygallery #btn_submit_file_upload').on('click', function(){
                    if ($('#file_upload').val() == '') {
                        alert('Please choose file.');
                    }else{
                        var ali = $ummu.ajax.mygallery.photos.upload();
                        ali.done(function(result) {
                            var response = JSON.parse(result);
                            console.log(response)

                            if (response.status == true) {
                                var html = '<div class="cont-checkbox">'+
                                '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+ response.data.id +'" data-name="'+ response.data.filename +'" data-path="'+ response.data.url +'"/>'+
                                '<label for="'+ response.data.id +'" class="lbl_gallery">'+
                                '<img src="'+ response.data.url +'?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
                                '<span class="cover-checkbox">'+
                                '<svg viewBox="0 0 12 10">'+
                                '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
                                '</svg>'+
                                '</span>'+
                                '<div class="info">'+ response.data.description +'</div>'+
                                '</label>'+
                                '</div>';
                                $('#album_gallery').prepend(html);
                                $('.custom-file label').html('Choose file');
                                $('#file_upload').val('');
                            }
                        })  
                    }
                })
            },
            delete: function(id) {
                var params = {
                    "type": "delete",
                    "action": "delete",
                    "data": {},
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json"
                };
                var url = $base_url+'/mygallery/photos/delete/'+id;
                var ali = $ummu.ajax.ummay(url, params);
                ali.done(function(result) {
                    var response = JSON.parse(result);
                    if (response.status == true) {
                        $('#mygallery_frame'+id).remove();
                    }
                }).fail(function() {
                    // An error occurred
                });
            },
        }
    },

    views: {
        inputEmpty: function(){
            // 
        },

        kosongkanForm: function(){
            $('#form_input_ruangan textarea').val("");
            $('#headerData .forBtnClear,select').val("");
            $('.forBtnClear').val("");
            $('#form_input_ruangan input,select').val("");
            $('.chk').prop('checked', false);
            $ummu.upload.ids = [];
        },

        set_value_to_form: function(row,index) {            
            $('#gedung').val(row.gedung_id).change();
            $('#kode').val(row.kode);
            $('#name').val(row.name);
            $('#lantai').val(row.lantai);
            $('#jumlah_seat').val(row.seat);
            $('#type').val(row.type_id).change();
            $('#category').val(row.room_category_id).change();

            if (row.proyektor == 1) {
                $('#proyektor').prop('checked', true);
                globalVars.proyektor = 1
            }else{
                globalVars.proyektor = 0
            }

            if (row.whiteboard == 1) {
                $('#whiteboard').prop('checked', true);
                globalVars.whiteboard = 1
            }else{
                globalVars.whiteboard = 0
            }

            $('#carousel_foto_ruangan, #carousel_indicator').empty();
            var rows = row.images;
            if (rows) {
                for(let index in rows){
                    if (index == 0) {
                        var aktif = 'active';
                    }else{
                        var aktif = '';
                    }

                    var indicator = '<li data-target="#carouselExampleCaptions" data-slide-to="'+index+'" class="'+aktif+'"></li>';

                    var html = '<div class="carousel-item '+aktif+'">'+
                    '<img src="'+$base_url+'uploads/'+rows[index]+'" class="d-block w-100 dorbitt-scale img-thumbnail" alt="...">'+
                                // '<div class="carousel-caption d-none d-md-block">'+
                                //     '<h5>First slide label</h5>'+
                                //     '<p>Some representative placeholder content for the first slide.</p>'+
                                // '</div>'+
                    '</div>';

                    $('#carousel_indicator').append(indicator);
                    $('#carousel_foto_ruangan').append(html);
                }
            }else{
                // var html = '<div class="carousel-item active">'+
                //                 '<img src="'+$base_url+'uploads/sc1.png" class="d-block w-100 dorbitt-scale img-thumbnail" alt="...">'+
                //                 '<div class="carousel-caption d-none d-md-block">'+
                //                     '<h5>First slide label</h5>'+
                //                     '<p>Some representative placeholder content for the first slide.</p>'+
                //                 '</div>'+
                //             '</div>';                
                // $('#carousel_foto_ruangan').append(html)
                app.Views.defautlFotoRuangan()
            }
        },

        set_value_to_option_gedung: function(params) {
            var rows = params.rows;
            var element_id = params.element_id;
            var kode = params.kode;

            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                if (kode == 1) {
                    var text = rows[index].kode + ' - ' + rows[index].name;
                }else{
                    var text = rows[index].name;
                }
                $('#'+element_id).append("<option data-lantai='"+ rows[index].jumlah_lantai+"' value='" + rows[index].id + "'>" + text + "</option>");
            }
        },

        set_value_to_table: function(method,id) {
            var row = {
                "id": id,
                "gedung_name": $('#gedung option:selected').text(),
                "lantai": $('#lantai').val(),

                "kode": $('#kode').val(),
                "name": $('#name').val(),
                "type_id": $('#type').val(),
                "type_name": $('#type option:selected').text(),
                "room_category_id": $('#category').val(),
                "category_name": $('#category option:selected').text(),

                "seat": $('#jumlah_seat').val(),
                "proyektor": globalVars.proyektor,
                "whiteboard": globalVars.whiteboard
            }

            if (method == 'insert') {
                $table.bootstrapTable('insertRow', {
                    index: 0,
                    row: row
                })
            }else{
                $table.bootstrapTable('updateRow', {
                    index: globalVars.dataIndex,
                    row: row
                })
            }
        },

        set_gallery_selected_to_img: function(rows) {
            // console.log(rows)
            $('#carousel_foto_ruangan, #carousel_indicator').empty();
            if (rows) {
                for(let index in rows){
                    // console.log(index)
                    if (index == 0) {
                        var aktif = 'active';
                    }else{
                        var aktif = '';
                    }

                    var indicator = '<li data-target="#carouselExampleCaptions" data-slide-to="'+index+'" class="'+aktif+'"></li>';

                    var html = 
                    '<div class="carousel-item '+aktif+'">'+
                    '<img src="'+$base_url+'uploads/'+rows[index]+'" class="d-block w-100 dorbitt-scale img-thumbnail" alt="...">'+
                                // '<div class="carousel-caption d-none d-md-block">'+
                                //     '<h5>First slide label</h5>'+
                                //     '<p>Some representative placeholder content for the first slide.</p>'+
                                // '</div>'+
                    '</div>';

                    $('#carousel_indicator').append(indicator);
                    $('#carousel_foto_ruangan').append(html);
                }
            }else{
                // var html = '<div class="carousel-item active">'+
                //                 '<img src="'+$base_url+'uploads/sc1.png" class="d-block w-100 dorbitt-scale img-thumbnail" alt="...">'+
                //                 '<div class="carousel-caption d-none d-md-block">'+
                //                     '<h5>First slide label</h5>'+
                //                     '<p>Some representative placeholder content for the first slide.</p>'+
                //                 '</div>'+
                //             '</div>';                
                // $('#carousel_foto_ruangan').append(html)
                app.Views.defautlFotoRuangan()
            }
        },

        defautlFotoRuangan: function(){
            var html = '<div class="carousel-item active">'+
            '<img src="'+$base_url+'uploads/sc1.png" class="d-block w-100 dorbitt-scale img-thumbnail" alt="...">'+
            '<div class="carousel-caption d-none d-md-block">'+
            '<h5>First slide label</h5>'+
            '<p>Some representative placeholder content for the first slide.</p>'+
            '</div>'+
            '</div>';                
            $('#carousel_foto_ruangan').append(html)
        },

        images: {
            default_dorbitt_avatar: function() {
                var dorbitt_avatar = $('#dorbitt_avatar img').data('origin');
                $('#dorbitt_avatar img').prop('src', dorbitt_avatar);
            },

            default_accset_avatar: function() {
                var accset_avatar = $('#accset_avatar img').data('origin');
                $('#accset_avatar img').prop('src', accset_avatar);
                $('#avatar_filename').val('');
            }
        },

        resdel() {
            $('#response_deleted').modal('show');
        },

        modal: {
            fullscreen: function(element_id) {
                var el = $(element_id);
                var hasClass = el.hasClass('modal-fullscreen');
                console.log(hasClass)

                if (hasClass == true) {
                    el.removeClass('modal-fullscreen');
                }else{
                    el.addClass('modal-fullscreen');
                }
            },
            res_del: function() {

            },
            form_filter: function() {
                var html = 
                '<div class="modal fade" id="modal_import" tabindex="-2" style="z-index: 3000;">'+
                '<div class="modal-dialog modal-dialog-centeredz">'+
                '<div class="modal-content">'+
                '<div class="modal-header bg-secondary">'+
                '<h5 class="modal-title text-light" id="message_title">Import</h5>'+
                '<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>'+
                '</div>'+
                '<div class="alert text-light collapse" id="modal_alert_import"></div>'+
                '<div class="collapse" id="loader">'+
                '<div class="d-flex justify-content-center mt-2">'+
                '<div class="spinner-border text-danger" role="status">'+
                '<span class="sr-only">Loading...</span>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="modal-body">'+
                '<div id="form_import">'+
                '<form enctype="multipart/form-data" id="form_import_file">'+
                '<div class="col-md-12">'+
                '<label class="form-label">File</label>'+
                '<input class="form-control" type="file" name="file" id="file_import">'+
                '</div>'+
                '</form>'+
                '</div>'+
                '<div class="mt-3">'+
                '<a class="text-sm" target="_blank" id="link_format_import">'+
                '<i class="fas fa-file-excel"></i>'+
                'Click for download format import file'+
                '</a>'+
                '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'+
                '<a href="#" type="button" class="btn btn-primary" id="btnImport" onclick="au_import();">Import</a>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>';
            }
        },

        approval: {
            status_detail: function(status) {
                $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('checked', false);
                $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('disabled', false);

                if (status == 1) { //approve
                    $('.dorbitt-detail .rad-approve').prop('checked', true);
                    $('.dorbitt-detail .rad-pending').prop('disabled', true);
                }

                if (status == 2) { //reject
                    $('.dorbitt-detail .rad-reject').prop('checked', true);
                    $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending').prop('disabled', true);
                }

                if (status == 3) { //pending
                    $('.dorbitt-detail .rad-pending').prop('checked', true);
                    $('.dorbitt-detail .rad-reject').prop('disabled', true);
                }
            },
            status_detail_on_load: function(status) {
                // $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('checked', false);
                $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('disabled', false);

                if (status == 1) { //approve
                    // $('.dorbitt-detail .rad-approve').prop('checked', true);
                    $('.dorbitt-detail .rad-pending').prop('disabled', true);
                }

                if (status == 2) { //reject
                    // $('.dorbitt-detail .rad-reject').prop('checked', true);
                    $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending').prop('disabled', true);
                }

                if (status == 3) { //pending
                    // $('.dorbitt-detail .rad-pending').prop('checked', true);
                    $('.dorbitt-detail .rad-reject').prop('disabled', true);
                }
            },
            sumLoad: function(data) {
                if (data) {
                    // Outstanding <span class="badge badge-pill badge-primary">0</span>
                    $('#dorbitt_tabs #outstanding-pill').html(
                        'Outstanding <span class="badge badge-pill badge-primary">'+data.jOutstanding+'</span>'
                        );
                    $('#dorbitt_tabs #pending-pill').html(
                        'Pending <span class="badge badge-pill badge-warning">'+data.jPending+'</span>'
                        );
                    $('#dorbitt_tabs #reject-pill').html(
                        'Reject <span class="badge badge-pill badge-danger">'+data.jReject+'</span>'
                        );
                }else{
                    $('#dorbitt_tabs #outstanding-pill').html(
                        'Outstanding <div class="spinner-grow spinner-grow-sm text-primary" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                        '</div>'
                        );
                    $('#dorbitt_tabs #pending-pill').html(
                        'Pending <div class="spinner-grow spinner-grow-sm text-warning" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                        '</div>'
                        );
                    $('#dorbitt_tabs #reject-pill').html(
                        'Reject <div class="spinner-grow spinner-grow-sm text-danger" role="status">'+
                        '<span class="sr-only">Loading...</span>'+
                        '</div>'
                        );
                }
            },
            button: {
                approve_all() {
                    if ($ummu.dt.select.count() > 0) {
                        table.button(1).enable();
                    }else{
                        table.button(1).disable();
                    }
                }
            }
        },

        sidebar: {
            info_badge: function($element_id,value) {
                var menuName = $('#'+element_id).html();
                $('#'+element_id).html(menuName + ' <span class="badge badge-pill badge-info float-right">'+value+'</span>');
            },

            show_by_category: function()
            {
                // if (localStorage.getItem('enmod__category_id')) {}
            }
        },

        button: {
            endis: function(element_id,status) {
                if (status == true) {
                    $(element_id).prop('disabled', false);
                }else{
                    $(element_id).prop('disabled', true);
                }
            },

            delete_selected(key) {
                if ($ummu.dt.select.count() > 0) {
                    table.button(key).enable();
                }else{
                    table.button(key).disable();
                }
            },

            std_shb: {
                onNew: function(){
                    $('#dbtn_new').attr('disabled', true);
                    $('#dbtn_edit').attr('disabled', true);
                    $('#dbtn_del').attr('disabled', true);
                    $('#dbtn_can').attr('disabled', false);
                    $('#dbtn_save').attr('disabled', false);
                    $('#dbtn_print').attr('disabled', true);
                    $('#dbtn_close').attr('disabled', true);
                    $('.dis-able').attr('disabled', false);
                    $('.input-form').attr('readonly', false);
                },
                onCan: function(){
                    $('.dis-able').val('');
                    $('.cnclear').val('');
                    $('#dbtn_new').attr('disabled', false);
                    $('#dbtn_edit').attr('disabled', true);
                    $('#dbtn_del').attr('disabled', true);
                    $('#dbtn_can').attr('disabled', true);
                    $('#dbtn_save').attr('disabled', true);
                    $('#dbtn_print').attr('disabled', true);
                    $('#dbtn_close').attr('disabled', false);
                    $('.dis-able').attr('disabled', true);
                    $('.input-form').attr('readonly', true);
                }
            },

            standard_shb_on_select() {
                $('#dbtn_new').attr('disabled', false);
                $('#dbtn_edit').attr('disabled', false);
                $('#dbtn_del').attr('disabled', false);
                $('#dbtn_can').attr('disabled', true);
                $('#dbtn_save').attr('disabled', true);
                $('#dbtn_print').attr('disabled', false);
                $('#dbtn_close').attr('disabled', false);
            },

            shb_btn_std(nw,edit,del,can,save,print,close) {
                if (nw === false) {
                    snw = 'disabled'
                }else{
                    snw = '';
                }

                // if (edit === false) {
                //     sedit = 'disabled'
                // }else{
                //     sedit = ''
                // }

                // if (del === false) {
                //     sdel = 'disabled'
                // }else{
                //     sdel = ''
                // }

                var html = 
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_new" '+snw+'><i class="fab fa-wpforms"></i> New</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_edit" disabled><i class="fal fa-edit"></i> Edit</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_del" disabled><i class="fal fa-trash-alt"></i> Del</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_can" disabled><i class="fal fa-times"></i> Can</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_save" disabled><i class="fal fa-save"></i> Save</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_print" disabled><i class="fal fa-print"></i> Print</button>'+
                '<button class="btn btn-sm btn-primary mb-1 mr-1" type="button" id="dbtn_close"><i class="fal fa-sign-out-alt"></i> Close</button>';
                // return html;
                $('#btn_std_shb').html(html);
            },

            dt: {
                crud: function(action = null) {
                    // var crud = JSON.parse($ummu.vars.crud);
                    var text = $ummu.cookie.getCookie('crud');
                    // var crud = text.replaceAll("-", ",");
                    if (text != '' || text != 0) {
                        var crud = text.split("-");
                    }else{
                        var crud = '';
                    }

                    var count_selc = $ummu.dt.select.count();
                    console.log(crud);

                    // c,rall,u,d,admin
                    // 0,1   ,2,3,4

                    if (crud) {
                        if (crud[0] == 1) {
                            if (count_selc == 1) {
                                table.button('#btn_new').disable();
                                table.button('#dt_btn_new').disable();
                            }else if (count_selc > 1) {
                                table.button('#btn_new').disable();
                                table.button('#dt_btn_new').disable();
                            }else{
                                table.button('#btn_new').enable();
                                table.button('#dt_btn_new').enable();
                            }

                            if (action == 'new') {
                                $('.modal_btn_edit').prop('disabled', true);
                                $('.modal_btn_save').prop('disabled', false);
                            }
                        }else{
                            table.button('#btn_new').disable();
                            table.button('#dt_btn_new').disable();
                        }

                        if (crud[2] == 1) {
                            if (count_selc == 1) {
                                table.button('#dt_btn_edit').enable();
                            }else if (count_selc > 1) {
                                table.button('#dt_btn_edit').disable();
                            }else{
                                table.button('#dt_btn_edit').disable();
                            }

                            if (action == 'edit') {
                                $('.modal_btn_edit').prop('disabled', false);
                                $('.modal_btn_save').prop('disabled', true);
                            }
                        }else{
                            table.button('#dt_btn_edit').disable();
                        }

                        if (crud[3] == 1) {
                            if (count_selc > 0) {
                                table.button('#dt_btn_delete').enable();
                            }else{
                                table.button('#dt_btn_delete').disable();
                            }
                        }else{
                            table.button('#dt_btn_delete').disable();
                        }
                    }else{
                        table.button('#dt_btn_new').enable();
                        table.button('#dt_btn_edit').disable();
                        table.button('#dt_btn_delete').disable();
                    }

                    if ($ummu.vars.module_kode == 'event_recruitment') {
                        if (count_selc == 1) {
                            table.button('#dt_btn_open_recruitment').enable();
                        }else{
                            table.button('#dt_btn_open_recruitment').disable();
                        }
                    }

                    if ($ummu.vars.module_kode == 'she_hazard_report') {
                        if (count_selc >= 1) {
                            table.button('#btn_release').enable();
                        }else{
                            table.button('#btn_release').disable();
                        }
                    }

                    // table.button('#btn_edit').disable();
                    // table.button('#btn_approve').disable();
                    // table.button('#btn_reject').disable();
                    // table.button('#btn_release').disable();
                    // table.button('#btn_multi_delete').disable();
                },

                crud_hzr: function(action = null) {
                    // var crud = JSON.parse($ummu.vars.crud);
                    var text = $ummu.cookie.getCookie('crud');
                    var a = $ummu.vars.nav_tab;

                    // var crud = text.replaceAll("-", ",");
                    if (text != '' || text != 0) {
                        var crud = text.split("-");
                    }else{
                        var crud = '';
                    }

                    var count_selc = $ummu.dt.select.count();
                    // console.log(crud);
                    // console.log(crud);
                    // console.log(count_selc);

                    // c,rall,u,d,admin
                    // 0,1   ,2,3,4

                    // if (crud) {
                    //     if (crud[0] == 1) {
                    //         if (count_selc == 1) {
                    //             table.button('#btn_new').disable();
                    //             table.button('#dt_btn_new').disable();
                    //         }else if (count_selc > 1) {
                    //             table.button('#btn_new').disable();
                    //             table.button('#dt_btn_new').disable();
                    //         }else{
                    //             table.button('#btn_new').enable();
                    //             table.button('#dt_btn_new').enable();
                    //         }

                    //         if (action == 'new') {
                    //             $('.modal_btn_edit').prop('disabled', true);
                    //             $('.modal_btn_save').prop('disabled', false);
                    //         }
                    //     }else{
                    //         table.button('#btn_new').disable();
                    //         table.button('#dt_btn_new').disable();
                    //     }

                    //     if (crud[2] == 1) {
                    //         if (count_selc == 1) {
                    //             table.button('#dt_btn_edit').enable();
                    //         }else if (count_selc > 1) {
                    //             table.button('#dt_btn_edit').disable();
                    //         }else{
                    //             table.button('#dt_btn_edit').disable();
                    //         }

                    //         if (action == 'edit') {
                    //             $('.modal_btn_edit').prop('disabled', false);
                    //             $('.modal_btn_save').prop('disabled', true);
                    //         }
                    //     }else{
                    //         table.button('#dt_btn_edit').disable();
                    //     }

                    //     if (crud[3] == 1) {
                    //         if (count_selc > 0) {
                    //             table.button('#dt_btn_delete').enable();
                    //         }else{
                    //             table.button('#dt_btn_delete').disable();
                    //         }
                    //     }else{
                    //         table.button('#dt_btn_delete').disable();
                    //     }
                    // }else{
                    //     table.button('#dt_btn_new').enable();
                    //     table.button('#dt_btn_edit').disable();
                    //     table.button('#dt_btn_delete').disable();
                    // }

                    // if ($ummu.vars.module_kode == 'event_recruitment') {
                    //     if (count_selc == 1) {
                    //         table.button('#dt_btn_open_recruitment').enable();
                    //     }else{
                    //         table.button('#dt_btn_open_recruitment').disable();
                    //     }
                    // }

                    // if ($ummu.vars.module_kode == 'she_hazard_report') {
                    //     if (count_selc >= 1) {
                    //         table.button('#btn_release').enable();
                    //     }else{
                    //         table.button('#btn_release').disable();
                    //     }
                    // }

                    // table.button('#btn_edit').disable();
                    // table.button('#btn_approve').disable();
                    // table.button('#btn_reject').disable();
                    // table.button('#btn_release').disable();
                    // table.button('#btn_multi_delete').disable();

                    

                    // c,rall,u,d,admin
                    // 0,1   ,2,3,4

                    // console.log(crud)

                    if (a === 0 || a === 3 ) {
                        if ($ummu.dt.select.count() > 0) {
                            table.button('#dt_btn_new').disable();
                            table.button('#dt_btn_edit').disable();
                            table.button('#dt_btn_release').enable();
                            table.button('#dt_btn_delete').enable();

                        }else{
                            table.button('#dt_btn_new').enable();
                            table.button('#dt_btn_edit').enable();
                            table.button('#dt_btn_release').disable();
                            table.button('#dt_btn_delete').disable();
                        }
                        // $ummu.views.button.dt.showhide_edit();

                        if ($ummu.dt.select.count() == 1) {
                            table.button('#dt_btn_edit').enable();
                        }else{
                            table.button('#dt_btn_edit').disable();
                        }
                    }

                    if (a == 1) {
                        if (crud) {
                            if (crud[4] == 1) {
                                if ($ummu.dt.select.count() > 0) {
                                    table.button('#dt_btn_approve').enable();
                                    table.button('#dt_btn_reject').enable();
                                }else{
                                    table.button('#dt_btn_approve').disable();
                                    table.button('#dt_btn_reject').disable();
                                }
                            }
                        }
                    }
                },

                showhide1: function(){
                    if ($ummu.dt.select.count() > 0) {
                        table.button(3).disable();
                        table.button(5).enable();
                        table.button(6).enable();
                    }else{
                        table.button(3).enable();
                        table.button(5).disable();
                        table.button(6).disable();
                    }
                    $ummu.views.button.dt.showhide_edit();
                },

                showhide2: function(){
                    var a = $ummu.vars.nav_tab;
                    // var crud = JSON.parse($ummu.vars.crud);
                    var text = $ummu.cookie.getCookie('crud');
                    if (text != '' || text != 0) {
                        var crud = text.split("-");
                    }else{
                        var crud = '';
                    }

                    // c,rall,u,d,admin
                    // 0,1   ,2,3,4

                    // console.log(crud)

                    if (a === 0 || a === 3 ) {
                        if ($ummu.dt.select.count() > 0) {
                            table.button('#btn_new').disable();
                            table.button('#btn_edit').disable();
                            table.button('#btn_release').enable();
                            table.button('#btn_multi_delete').enable();

                        }else{
                            table.button('#btn_new').enable();
                            table.button('#btn_edit').enable();
                            table.button('#btn_release').disable();
                            table.button('#btn_multi_delete').disable();
                        }
                        $ummu.views.button.dt.showhide_edit();
                    }

                    if (a == 1) {
                        if (crud) {
                            if (crud[4] == 1) {
                                if ($ummu.dt.select.count() > 0) {
                                    table.button('#btn_approve').enable();
                                    table.button('#btn_reject').enable();
                                }else{
                                    table.button('#btn_approve').disable();
                                    table.button('#btn_reject').disable();
                                }
                            }
                        }
                    }
                },

                showhide_edit: function(){
                    if ($ummu.dt.select.count() == 1) {
                        table.button('#btn_edit').enable();
                    }else{
                        table.button('#btn_edit').disable();
                    }
                }
            },

            hazard_report: {
                on_modal_form_edit: function() {
                    // console.log('ok');
                    $('.modal_btn_edit').prop('disabled', true);
                    $('.modal_btn_save').prop('disabled', false);
                    $('#form_entry_data input, #form_entry_data button, select').prop("disabled", false);
                    $('#tgl_penemuan, #waktu_penemuan').prop('disabled', true);
                    // $('#modal_btn_edit').prop('disabled', true);
                }
            },

            recruitment: function() {
                $('#dt_btn_open_recruitment').prop('disabled', true);
            }
        },

        select_option_append: function(params) {
            var rows = params.rows;
            var element_id = params.element_id;
            var with_kode = params.with_kode;

            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                if (with_kode == 1) {
                    var text = rows[index].kode + ' - ' + rows[index].name;
                }else{
                    var text = rows[index].name;
                }
                $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
            }
        },

        select_option_append2: function(params) {
            var rows = params.rows;
            var element_id = params.element_id;
            var id = "rows[index]."+params.id;
            var name = "rows[index]."+params.name;

            $('#'+element_id).empty();
            $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
            for(let index in rows){
                $('#'+element_id).append("<option value='" + eval(id) + "'>" + eval(name) + "</option>");
            }
        },

        list_to_badge: function(index, row) {

            var html = row.kode + ' | ' + row.name
            return html
        },

        emailFormatter: function(data) {
            var email = "";
            if (data) {
                const array = data.split(',');
                $.each(array , function(index, val) { 
                    // console.log(index, val)
                    email += '<a href="#" class="badge bg-primary">'+val+'</a><br> ';
                    // var b += a;
                });  
                // console.log(email);

                return email;      
            }
        },

        hazard_report: {
            // btn_edit: function() {
            //     return '<button type="button" class="btn btn-primary btn-edit" id="modal_btn_edit">Edit</button>';
            // },
            // btn_approve: function() {
            //     return '<button type="button" class="btn btn-primary btn-approve" id="modal_btn_approve">Approve</button>';
            // },
            // btn_save: function() {
            //     return '<button type="button" class="btn btn-primary btn-save" id="modal_btn_save">Save Change</button>';
            // },

            button_in_modal_form: function(action = null) {
                $('#form_entry_data input, #form_entry_data button, select').prop("disabled", true);
                $('.modal_btn_edit, .modal_btn_approve, .modal_btn_save').prop('disabled', true);
                // <button type="button" class="btn btn-primary btn-edit" id="modal_btn_edit">Edit</button>
                // <button type="button" class="btn btn-primary btn-approve" id="modal_btn_approve">Approve</button>
                // <button type="button" class="btn btn-primary btn-save" id="modal_btn_save">Save Change</button>
                if (action == 'new') {
                    $('.modal_btn_save').prop('disabled', false);
                    $('#form_entry_data input, #form_entry_data button, select').prop("disabled", false);
                    $('#tgl_penemuan, #waktu_penemuan').prop("disabled", true);
                }else{
                    var tab = $ummu.vars.nav_tab;
                    var crud = JSON.parse($ummu.vars.crud);

                    // if (/*tab === 0 || */tab === 3 ) {
                    //     if ($ummu.dt.select.count() > 0) {
                    //         table.button('#btn_new').disable();
                    //         table.button('#btn_edit').disable();
                    //         table.button('#btn_release').enable();
                    //         table.button('#btn_multi_delete').enable();

                    //     }else{
                    //         table.button('#btn_new').enable();
                    //         table.button('#btn_edit').enable();
                    //         table.button('#btn_release').disable();
                    //         table.button('#btn_multi_delete').disable();
                    //     }
                    //     // $ummu.views.button.dt.showhide_edit();
                    // }

                    /*var btnEdit = '<button type="button" class="btn btn-primary btn-edit" id="modal_btn_edit" onclick="$ummu.views.button.hazard_report.on_modal_form_edit();">Edit</button> ';
                    var btnApprove = '<button type="button" class="btn btn-primary btn-approve" id="modal_btn_approve">Approve</button> ';
                    var btnSave = '<button type="button" class="btn btn-primary btn-save" id="modal_btn_save">Save Change</button> ';*/
                    // console.log(crud);
                    // $('#insideButton').html(btnEdit + btnApprove + btnSave);

                    if (tab == 1) {
                        if (crud) {
                            if (crud.acc_admin == 1) {
                                $('.modal_btn_approve').prop('disabled', false);
                            }
                        }
                    }

                    if (tab == 2) {
                        // $('#form_entry_data input, #form_entry_data button, select').prop("disabled", true);
                    }

                    if (tab == 3) {
                        // $('#form_entry_data input, #form_entry_data button, select').prop("disabled", true);
                        // $('#tgl_penemuan, #waktu_penemuan').prop('disabled', true);
                        // $('#insideButton').html(btnEdit + btnSave);
                        $('.modal_btn_edit').prop('disabled', false);
                    }                    
                }
            },

            btn_edit: function() {
                $('.modal_btn_edit, .modal_btn_approve, .modal_btn_save').prop('disabled', true);
                $('#form_entry_data input, #form_entry_data button, select').prop("disabled", false);
                $('#tgl_penemuan, #waktu_penemuan').prop('disabled', true);
                $('.modal_btn_save').prop('disabled', false);
            },

            /*modal_btn_edit: function() {
                var btnSave = '<button type="button" class="btn btn-primary btn-save" id="modal_btn_save">Save Change</button> ';
                $('#form_entry_data input, #form_entry_data button, select').prop("disabled", false);
                $('#tgl_penemuan, #waktu_penemuan').prop('disabled', true);
                $('#insideButton').html(btnSave);
            }*/
        },

        dt: {
            info_filter: function(filter) {
                var html = 
                '<span class=""><i class="fas fa-filter text-danger"></i> FILTER:</span> <br> '+
                '<span class="text-info">From: </span><span class="badge badge-warning font-weight-normal">'+ filter.datetime_detail.from + 
                '</span> <span class="text-info">To: </span><span class="badge badge-warning font-weight-normal">' + filter.datetime_detail.to + ' </span>';
                table.column(0).footer().innerHTML = html
            }
        }
    },

    formatter: {
        date: {
            dateToYmd: function(data) {
                var d = new Date(data),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            },
            dmyToYmd: function(dmy) {
                const myArray = dmy.split("-");

                var d = myArray[0];
                var m = myArray[1];
                var y = myArray[2];

                var new_dmy = y + '-' + m + '-' + d;

                var dt = new Date(new_dmy),
                month = '' + (dt.getMonth() + 1),
                day = '' + dt.getDate(),
                year = dt.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            },
        },
        duration_menit: function(data) {
            return data + ' menit';
        },
        is_release: function(data) {
            if (data == 1) {
                return '<i class="fas fa-check-square text-success"></i>';
            }else{
                return '';
            }
        },
        active: function(data) {
            if (data == 1) {
                return '<i class="fas fa-check-square text-success"></i>';
            }else{
                return '';
            }
        },
        sap: {
            operation: function(index, row) {
                // console.log(row)
                if (row) {
                    return row.operation_kode + ' | ' + row.operation_name;
                }
            }
        },
        checked_if_value: function (data) {
            if (data == 1) {
                return '<i class="fas fa-check text-success"></i>';
            }else{
                return '';
            }
        }
    },

    render: {
        checked_if_value: function(data, type, row) {
            if (type === 'myExport') {
                return data === 'on' ? 'Y' : '';
            }

            if (data === 'on') {
                return '<i class="fas fa-check text-success"></i>';
            }else{
                return '';
            }
        }
    },

    validation: {
        keyup: function(element_id) {
            // $('#modal_response_message').html(msg);
            // if ($ummu.vars.error_ids === undefined || $ummu.vars.error_ids.length == 0) {
            //     $('#btn_approve').prop('disabled', false);
            // }else{
            //     $('#btn_approve').prop('disabled', true);
            // }

            var inArr = $ummu.vars.error_ids.includes(element_id);

            if (inArr == true) {
                $(element_id).addClass('text-danger');
            }else{
                $(element_id).removeClass('text-danger');
            }
        },

        keyup_false: function(element_id) {
            // $('#modal_response_message').html(msg);
            if ($ummu.vars.error_ids === undefined || $ummu.vars.error_ids.length == 0) {
                $('#btn_approve').prop('disabled', false);
            }else{
                $('#btn_approve').prop('disabled', true);
            }

            if ($ummu.vars.error_ids.includes(element_id) == true) {
                $(element_id).addClass('text-danger');
            }else{
                $(element_id).removeClass('text-danger');
            }
        },

        keyup_true: function(element_id) {
            // $('#modal_response_message').html(msg);
            if ($ummu.vars.error_ids === undefined || $ummu.vars.error_ids.length == 0) {
                $('#btn_approve').prop('disabled', false);
            }else{
                $('#btn_approve').prop('disabled', true);
            }

            if ($ummu.vars.error_ids.includes(element_id) == true) {
                $(element_id).addClass('text-danger');
            }else{
                $(element_id).removeClass('text-danger');
            }
        },

        form: function(element_id,button_id) {
            var inArr = $ummu.vars.error_ids.includes(element_id);

            if (inArr == true) {
                $(element_id).addClass('text-danger');
            }else{
                $(element_id).removeClass('text-danger');
            }

            if ($ummu.vars.error_ids === undefined || $ummu.vars.error_ids.length == 0) {
                $(button_id).prop('disabled', false);
            }else{
                $(button_id).prop('disabled', true);
            }
        },

        payslip_periode: {
            insert: function() {
                var name = $('#form_periode #name').val();
                if(name == '' || name == 'undefined' || name == null || name == 0) {
                    $('#name_msg_required').removeClass('collapse');
                    $ummu.vars.errors.push('name');
                    return false;
                }
                else{
                    $('#name_msg_required').addClass('collapse');
                    $ummu.vars.errors = $ummu.func.removeItem($ummu.vars.errors, 'name');
                    return true;
                }
            }
        },

        is_valid: function(value) {
            if (value == null || value == '' || value == 'undefined') {
                $ummu.vars.required_field.push(false);
                return false;
            }
        },

        is_valid_date: function(value) {
            if (value == '0000-00-00' || moment(value, 'YYYY-MM-DD',true).isValid() == false) {
                $ummu.vars.required_field.push(false);
                return false;
            }
        },

        is_valid_time: function(value) {
            if (moment(value, 'HH:mm',true).isValid() == false) {
                $ummu.vars.required_field.push(false);
                return false;
            }
        },

        hazard_report: {
            insert: function() {
                $ummu.vars.required_field = [];
                $('#modal_message #alert').html('');

                var tgl_penemuan = $('#tgl_penemuan').val();
                if ($ummu.validation.is_valid_date(tgl_penemuan) == false) {
                    $('#modal_message #alert').append('<div>- Tanggal Penemuan not Valid</div>');
                }

                var waktu_penemuan = $('#waktu_penemuan').val();
                if ($ummu.validation.is_valid_time(waktu_penemuan) == false) {
                    $('#modal_message #alert').append('<div>- Waktu Penemuan not Valid</div>');
                }

                var lokasi_temuan_id = $('#lokasi_penemuan').val();
                if ($ummu.validation.is_valid(lokasi_temuan_id) == false) {
                    $('#modal_message #alert').append('<div>- Lokasi temuan required.</div>');
                }

                var detail_lokasi = $('#detail_lokasi').val();
                if ($ummu.validation.is_valid(detail_lokasi) == false) {
                    $('#modal_message #alert').append('<div>- Detail lokasi required.</div>');
                }

                var jenis_temuan_id = $('#jenis_temuan').val();
                if ($ummu.validation.is_valid(jenis_temuan_id) == false) {
                    $('#modal_message #alert').append('<div>- Jenis temuan required.</div>');
                }

                var bahaya_ditemukan = $('#bahaya_ditemukan').val();
                if ($ummu.validation.is_valid(bahaya_ditemukan) == false) {
                    $('#modal_message #alert').append('<div>- Bahaya yang ditemukan required.</div>');
                }

                var penyebab_bahaya = $('#penyebab_bahaya').val();
                if ($ummu.validation.is_valid(penyebab_bahaya) == false) {
                    $('#modal_message #alert').append('<div>- Penyebab bahaya required.</div>');
                }

                var kode_bahaya_id = $('#kode_bahaya').val();
                if ($ummu.validation.is_valid(kode_bahaya_id) == false) {
                    $('#modal_message #alert').append('<div>- Kode bahayaq required.</div>');
                }

                var foto_temuan_id = $('#foto_temuan').attr('data-id');
                if ($ummu.validation.is_valid(foto_temuan_id) == false) {
                    $('#modal_message #alert').append('<div>- Foto temuan required.</div>');
                }

                var rincian_tindakan = $('#rincian_tindakan').val();
                if ($ummu.validation.is_valid(rincian_tindakan) == false) {
                    $('#modal_message #alert').append('<div>- Rincian tindakan required.</div>');
                }

                // var foto_perbaikan_id = $('#foto_perbaikan').attr('data-id');
                // if (foto_perbaikan_id == 'undefined') {
                //     $('#modal_message #alert').append('<div>- Foto perbaikan required.</div>');
                // }

                var status_id = $('input:radio[name=status]:checked').val();
                if ($ummu.validation.is_valid(status_id) == false) {
                    $('#modal_message #alert').append('<div>- Status required.</div>');
                }

                var nm_atasan = $('#nm_atasan').val();
                if ($ummu.validation.is_valid(nm_atasan) == false) {
                    $('#modal_message #alert').append('<div>- Nama atasan required.</div>');
                }

                if ($ummu.vars.required_field.includes(false)) {
                    return false;
                }
            }
        }
    },

    bt: {
        // 
    },

    dt: {
        select: {
            count: function() {
                return table.rows( { selected: true } ).count();
            },
            data: function() {
                return table.rows({selected: true}).data();
            },
            getRow: function(tbName) {
                return tbName.row({selected: true}).data();
            }
        },
        after_cud: function() {
            $ummu.views.button.dt.showhide1();
            $('#text_loader').html('');
        },
        button: {
            crud: function() {
                // var crud = JSON.parse($ummu.vars.crud);
                var text = $ummu.cookie.getCookie('crud');
                var tab = $ummu.vars.nav_tab;
                // var crud = text.replaceAll("-", ",");
                if (text != '' || text != 0) {
                    var crud = text.split("-");
                }else{
                    var crud = '';
                }
                var count_selc = $ummu.dt.select.count();

                if (crud) {
                    if ($ummu.vars.module_kode == 'she_hazard_report') {
                        // table.button('#dt_btn_new').disable();
                        table.button('#dt_btn_edit').disable();
                        table.button('#dt_btn_release').disable();
                        table.button('#dt_btn_delete').disable();
                        table.button('#dt_btn_approve').disable();
                        table.button('#dt_btn_reject').disable();

                        // console.log(crud);
                        // console.log(crud);
                        // console.log(count_selc);

                        // c,rall,u,d,admin
                        // 0,1   ,2,3,4

                        // if (crud) {
                        //     if (crud[0] == 1) {
                        //         if (count_selc == 1) {
                        //             table.button('#btn_new').disable();
                        //             table.button('#dt_btn_new').disable();
                        //         }else if (count_selc > 1) {
                        //             table.button('#btn_new').disable();
                        //             table.button('#dt_btn_new').disable();
                        //         }else{
                        //             table.button('#btn_new').enable();
                        //             table.button('#dt_btn_new').enable();
                        //         }

                        //         if (action == 'new') {
                        //             $('.modal_btn_edit').prop('disabled', true);
                        //             $('.modal_btn_save').prop('disabled', false);
                        //         }
                        //     }else{
                        //         table.button('#btn_new').disable();
                        //         table.button('#dt_btn_new').disable();
                        //     }

                        //     if (crud[2] == 1) {
                        //         if (count_selc == 1) {
                        //             table.button('#dt_btn_edit').enable();
                        //         }else if (count_selc > 1) {
                        //             table.button('#dt_btn_edit').disable();
                        //         }else{
                        //             table.button('#dt_btn_edit').disable();
                        //         }

                        //         if (action == 'edit') {
                        //             $('.modal_btn_edit').prop('disabled', false);
                        //             $('.modal_btn_save').prop('disabled', true);
                        //         }
                        //     }else{
                        //         table.button('#dt_btn_edit').disable();
                        //     }

                        //     if (crud[3] == 1) {
                        //         if (count_selc > 0) {
                        //             table.button('#dt_btn_delete').enable();
                        //         }else{
                        //             table.button('#dt_btn_delete').disable();
                        //         }
                        //     }else{
                        //         table.button('#dt_btn_delete').disable();
                        //     }
                        // }else{
                        //     table.button('#dt_btn_new').enable();
                        //     table.button('#dt_btn_edit').disable();
                        //     table.button('#dt_btn_delete').disable();
                        // }

                        // if ($ummu.vars.module_kode == 'event_recruitment') {
                        //     if (count_selc == 1) {
                        //         table.button('#dt_btn_open_recruitment').enable();
                        //     }else{
                        //         table.button('#dt_btn_open_recruitment').disable();
                        //     }
                        // }

                        // if ($ummu.vars.module_kode == 'she_hazard_report') {
                        //     if (count_selc >= 1) {
                        //         table.button('#btn_release').enable();
                        //     }else{
                        //         table.button('#btn_release').disable();
                        //     }
                        // }

                        // table.button('#btn_edit').disable();
                        // table.button('#btn_approve').disable();
                        // table.button('#btn_reject').disable();
                        // table.button('#btn_release').disable();
                        // table.button('#btn_multi_delete').disable();

                        

                        /** 
                         * crud[0] = create
                         * crud[1] = read all
                         * crud[2] = update
                         * crud[3] = delete
                         * crud[4] = admin*/

                        /**
                         * jika tab Not Release atau Rejected List active */
                        if (tab === 0 || tab === 3 ) {
                            if ($ummu.dt.select.count() > 0) {
                                // table.button('#dt_btn_new').disable();
                                // table.button('#dt_btn_edit').disable();
                                table.button('#dt_btn_release').enable();
                                table.button('#dt_btn_delete').enable();

                            }

                            if (crud[2] == 1) {
                                $ummu.dt.button.edit();
                            }

                            if ($ummu.dt.select.count() == 1) {
                                table.button('#dt_btn_edit').enable();
                            }else{
                                table.button('#dt_btn_edit').disable();
                            }
                        }

                        /**
                         * Jika tab Released List active */
                        if (tab == 1) {
                            /**
                             * pada tab Released List, dokument tidak bisa dilakukan Edit, Release dan Delete */
                            if (crud[4] == 1) {
                                if ($ummu.dt.select.count() > 0) {
                                    table.button('#dt_btn_approve').enable();
                                    table.button('#dt_btn_reject').enable();
                                }
                            }
                        }

                        // if (crud[2] == 1) {
                        //     if (count_selc == 1) {
                        //         table.button('#dt_btn_edit').enable();
                        //     }else if (count_selc > 1) {
                        //         table.button('#dt_btn_edit').disable();
                        //     }else{
                        //         table.button('#dt_btn_edit').disable();
                        //     }

                        //     if (action == 'edit') {
                        //         $('.modal_btn_edit').prop('disabled', false);
                        //         $('.modal_btn_save').prop('disabled', true);
                        //     }
                        // }else{
                        //     table.button('#dt_btn_edit').disable();
                        // }
                    }
                }
            },
            edit: function(){
                if ($ummu.dt.select.count() == 1) {
                    table.button('#dt_btn_edit').enable();
                }else{
                    table.button('#dt_btn_edit').disable();
                }
            }            
        }
    },

    localStorage: {
        approval: {
            sum: {
                create: function(data) {
                    localStorage.itr_jOut = data.ITR.jOutstanding;
                    localStorage.itr_jPend = data.ITR.jPending;
                    localStorage.itr_jRej = data.ITR.jReject;

                    localStorage.ur_jOut = data.UR.jOutstanding;
                    localStorage.ur_jPend = data.UR.jPending;
                    localStorage.ur_jRej = data.UR.jReject;

                    localStorage.mr_jOut = data.MR.jOutstanding;
                    localStorage.mr_jPend = data.MR.jPending;
                    localStorage.mr_jRej = data.MR.jReject;

                    localStorage.pr_jOut = data.PR.jOutstanding;
                    localStorage.pr_jPend = data.PR.jPending;
                    localStorage.pr_jRej = data.PR.jReject;

                    localStorage.po_jOut = data.PO.jOutstanding;
                    localStorage.po_jPend = data.PO.jPending;
                    localStorage.po_jRej = data.PO.jReject;
                },
                show: function() {
                    $('#info_itr #info_out span, #approval_itr span').html(localStorage.getItem('itr_jOut'));
                    $('#info_itr #info_pend span').html(localStorage.getItem('itr_jPend'));
                    $('#info_itr #info_rej span').html(localStorage.getItem('itr_jRej'));

                    $('#info_ur #info_out span, #approval_ur span').html(localStorage.getItem('ur_jOut'));
                    $('#info_ur #info_pend span').html(localStorage.getItem('ur_jPend'));
                    $('#info_ur #info_rej span').html(localStorage.getItem('ur_jRej'));

                    $('#info_mr #info_out span, #approval_mr span').html(localStorage.getItem('mr_jOut'));
                    $('#info_mr #info_pend span').html(localStorage.getItem('mr_jPend'));
                    $('#info_mr #info_rej span').html(localStorage.getItem('mr_jRej'));

                    $('#info_pr #info_out span, #approval_pr span').html(localStorage.getItem('pr_jOut'));
                    $('#info_pr #info_pend span').html(localStorage.getItem('pr_jPend'));
                    $('#info_pr #info_rej span').html(localStorage.getItem('pr_jRej'));

                    $('#info_po #info_out span, #approval_po span').html(localStorage.getItem('po_jOut'));
                    $('#info_po #info_pend span').html(localStorage.getItem('po_jPend'));
                    $('#info_po #info_rej span').html(localStorage.getItem('po_jRej'));
                }
            }
        },
        referensi: JSON.parse(localStorage.getItem('referensi')),
    },

    cookie: {
        setCookie: function(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        },

        getCookie: function(cname) {
            let name = cname + "=";
            let ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        },

        checkCookie: function() {
            let user = getCookie("username");
            if (user != "") {
                alert("Welcome again " + user);
            } else {
                user = prompt("Please enter your name:", "");
                if (user != "" && user != null) {
                    setCookie("username", user, 365);
                }
            }
        }
    },

    modal: {
        detele_confirm: function() {
            var html = 
            '<div class="modal fade" id="modal_confirm_delete" tabindex="-1">'+
            '<div class="modal-dialog">'+
            '<div class="modal-content">'+
            '<div class="modal-header">'+
            '<h5 class="modal-title">Confirmation</h5>'+
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
            '</div>'+
            '<div class="collapse" id="loader_delete">'+
            '<div class="d-flex justify-content-center mt-2">'+
            '<div class="spinner-border text-danger" role="status">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="modal-body">'+
            'Are you sure to delete this data?'+
            '</div>'+
            '<div class="modal-footer">'+
            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'+
            '<a href="#" id="btn_delete" class="btn btn-danger" onclick="app.controllers.delete();">Delete</a>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';

            $('.ummu-html').html(html);
        }
    }
}

$(document).ready(function () {
    $ummu.register.apply();
});




































function resdel() {
    $('#response_deleted').modal('show');
}

/**
* GLOBAL VARIABLE 
 * */
var $globalVar = {
    page: null,
    class: null,
    location_hash: null
}

/**
* GLOBAL FUNCTION 
 * */
var $globFunc = {
    ch_message: function(message) {
        const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
        $('#response_message').html(text).addClass('text-success msg_animation');
    },

    ch_message_modal: function(message) {
        const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
        $('#response_message_modal').html(text).addClass('text-success msg_animation');
    },

    ch_message_modal_modal: function(message) {
        const text = '<i class="fas fa-info-circle"></i> ' + message + ' . . .';
        $('#response_message_modal_modal').removeClass().html(text).addClass('text-success msg_animation');
    },

    countDate: function(datetime1, datetime2) {
        var inDetik = new Date(datetime2) - new Date(datetime1);
        var inMenit = Math.floor(inDetik / 60000);
        var inJam = Math.floor(inMenit / 60);
        var inHari = Math.floor(inJam / 24);

        var menit = inMenit - (inJam * 60);
        var jam = inJam - (inHari * 24);

        var response = inHari + " days, " + jam + " hours, " + menit + " minutes";

        // console.log(jam)
        return response;
    },
    countDate2: function(datetime1, datetime2) {
        var inDetik = new Date(datetime2) - new Date(datetime1);
        var inMenit = Math.floor(inDetik / 60000);
        var inJam = Math.floor(inMenit / 60);
        var inHari = Math.floor(inJam / 24);

        var menit = inMenit - (inJam * 60);
        var jam = inJam - (inHari * 24);

        var response = inHari + " <span class='text-muted'>days</span>, " + jam + " <span class='text-muted'>hours</span>, " + menit + " <span class='text-muted'>minutes</span>";

        // console.log(jam)
        return response;
    },
    countDate3: function(datetime1, datetime2) {
        var inDetik = new Date(datetime2) - new Date(datetime1);
        var inMenit = Math.floor(inDetik / 60000);
        var inJam = Math.floor(inMenit / 60);
        var inHari = Math.floor(inJam / 24);

        var menit = inMenit - (inJam * 60);
        var jam = inJam - (inHari * 24);

        var response = inHari + " day, " + jam + " hour, " + menit + " minute";

        // console.log(jam)
        return response;
    },
    getIdSelections: function() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id
        })
    },
    set_value_to_option: function(rows,element_id,kode) {
        $('#'+element_id).empty();
        $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
        for(let index in rows){
            if (kode == 1) {
                var text = rows[index].kode + ' - ' + rows[index].name;
            }else{
                var text = rows[index].name;
            }
            $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
        }
    },
    set_value_to_option2: function(rows,element_id,kode) {
        $('#'+element_id).empty();
        $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
        for(let index in rows){
            if (kode == 1) {
                var text = rows[index].kode + ' | ' + rows[index].name;
            }else{
                var text = rows[index].name;
            }
            $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
        }
    },
    set_value_to_option3: function(params) {
        var rows = params.rows;
        var element_id = params.element_id;
        var kode = params.kode;
        // var data = params.data;

        $('#'+element_id).empty();
        $('#'+element_id).append("<option value='' selected disabled>Choose...</option>");
        for(let index in rows){
            if (kode == 1) {
                var text = rows[index].kode + ' - ' + rows[index].name;
            }else{
                var text = rows[index].name;
            }
            $('#'+element_id).append("<option value='" + rows[index].id + "'>" + text + "</option>");
        }
    },
    date_ymd: function(data) {
        var d = new Date(data),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    },
    img_ratio: function(element_id) {
        var aspectRatio = $('#'+element_id+' img').width()/$('#'+element_id+' img').height();

        if (aspectRatio > 1) {
            $('#'+element_id).addClass('circular--landscape');
        }else if (aspectRatio < 1) {
            $('#'+element_id).addClass('circular--portrait');
        }else{
            $('#'+element_id).addClass('circular--square');
        }
    },
    header_avatar_ratio: function(element_id) {
        var aspectRatio = $(element_id).width()/$(element_id).height();

        if (aspectRatio > 1) {
            $(element_id).addClass('circular--landscape-35');
        }else if (aspectRatio < 1) {
            $(element_id).addClass('circular--portrait-35');
        }else{
            $(element_id).addClass('circular--square-35');
        }
    },
    modal_fullscreen: function(element_id) {
        var el = $(element_id);
        var hasClass = el.hasClass('modal-fullscreen');
        // console.log(hasClass)

        if (hasClass == true) {
            el.removeClass('modal-fullscreen');
        }else{
            el.addClass('modal-fullscreen');
        }
    },
}

/**
 * GLOBAL HELPERS 
 * */
var $globalHelper = {
    currency: {
        // format number to US dollar
        us: function(data) {
            let USDollar = new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 2,
                // style: 'currency',
                // currency: ' ',
            });

            return USDollar.format(data);
        }

        // // format number to British pounds
        // let pounds = Intl.NumberFormat('en-GB', {
        //     style: 'currency',
        //     currency: 'GBP',
        // });

        // // format number to Indian rupee
        // let rupee = new Intl.NumberFormat('en-IN', {
        //     style: 'currency',
        //     currency: 'INR',
        // });

        // // format number to Euro
        // let euro = Intl.NumberFormat('en-DE', {
        //     style: 'currency',
        //     currency: 'EUR',
        // });
    }

}

/**
 * GLOBAL UPLOAD 
 * */
var $globalUpload = {
    filename: null,
    randomname: null,
    input_id: null,
    image_id: null,
    ids: [],
    filenames: [],

    // /*findAll_berangkas: function() {
    //     // $.ajax({
    //     //     type: 'GET',
    //     //     url: $base_url + "admin/berangkas/findAll",
    //     //     dataType: 'JSON',
    //     //     contentType: false,
    //     //     processData: false,
    //     // }).done(function(result) {
    //     //     console.log(result.status)
    //     //     if (result.status == true) {
    //     //         var data = result.rows;
    //     //         $('#album_berangkas').empty();
    //     //         for(let index in data){
    //     //             var $id = data[index].id;
    //     //             var filename = data[index].filename;
    //     //             if(filename == ''){
    //     //                 var $filename = 'no_image.jpg';
    //     //             }else{
    //     //                 var $filename = filename;
    //     //             }
    //     //             var $element = '<div class="col">'+
    //     //                 '<div class="card shadow-sm">'+
    //     //                     '<img class="img-thumbnail" src="'+ $base_url +'uploads/'+ $filename + '" style="height:160px;">'+
    //     //                     '<div class="card-body">'+
    //     //                         '<div class="d-flex justify-content-between align-items-center pt-3">'+
    //     //                             '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$globalUpload.hapus_file_berangkas('+$id+')">Hapus</button>'+
    //     //                             '<button type="button" class="btn btn-sm btn-outline-success pilih-berkas" data-name="'+$filename+'">Pilih</button>'+
    //     //                         '</div>'+
    //     //                     '</div>'+
    //     //                 '</div>'+
    //     //             '</div>';
    //     //             $('#album_berangkas').append($element);
    //     //         }
    //     //         $('.pilih-berkas').click(function(){
    //     //             var $data_name = $(this).data('name');
    //     //             $globalUpload.input_id.val($data_name)
    //     //             $('#modal_berangkas_file').modal('hide')
    //     //             $globalUpload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
    //     //         })
    //     //     }else{

    //     //     }
    //     // }).fail(function() {
    //     //     // An error occurred
    //     // });;

    //     var params = {
    //             "type": "get",
    //             "action": "get",
    //             "data": {
    //                 "limit":0,
    //                 "offset":0,
    //                 "sort": "id",
    //                 "order": "desc",
    //                 "search": ""
    //             },
    //             "cache": true,
    //             "contentType": "application/json",
    //             "dataType": "json"
    //         };
    //         var url = $base_url+'/admin/berangkas/show';
    //         var ali = $globalAjax.ummay(url,params);
    //         ali.done(function(result) {
    //             var response = JSON.parse(result);
    //             $globFunc.ch_message_modal_modal(response.message);
    //             // console.log(response.message)
    //             // var params2 = {
    //             //     "rows": response.rows,
    //             //     "element_id": 'gedung',
    //             //     "kode": 1
    //             // };

    //             // // $globFunc.set_value_to_option(response.rows,'gedung',1)
    //             // // $globFunc.set_value_to_option3(params2)
    //             // app.Views.set_value_to_option_gedung(params2)

    //             var data = response.rows;
    //             $('#album_berangkas').empty();
    //             for(let index in data){
    //                 var $id = data[index].id;
    //                 var id = data[index].id;
    //                 var filename = data[index].filename;
    //                 var description = data[index].description;

    //                 if(filename == ''){
    //                     var $filename = 'no_image.jpg';
    //                 }else{
    //                     var $filename = filename;
    //                 }

    //                 if (description == '' || description == null) {
    //                     var description_ = filename;
    //                 }else{
    //                     var description_ = description;
    //                 }

    //                 // var $elementz = '<div class="col">'+
    //                 //     '<div class="card shadow-sm">'+
    //                 //         '<img class="img-thumbnail" src="'+ $base_url +'uploads/'+ $filename + '" style="height:160px;">'+
    //                 //         '<div class="card-body">'+
    //                 //             '<div class="d-flex justify-content-between align-items-center pt-3">'+
    //                 //                 '<button type="button" class="btn btn-sm btn-outline-danger" onclick="$globalUpload.hapus_file_berangkas('+$id+')"><i class="fas fa-trash"></i></button>'+
    //                 //                 '<button type="button" class="btn btn-sm btn-outline-success pilih-berkas" data-name="'+$filename+'">Pilih</button>'+
    //                 //                 '<input class="form-check-input dorbitt-checkbox" type="checkbox">'+
    //                 //             '</div>'+
    //                 //         '</div>'+
    //                 //     '</div>'+
    //                 // '</div>';

    //                 var $element = '<div class="cont-checkbox">'+
    //                     '<input type="checkbox" class="dorbitt_checkbox_image_berangkas" name="dorbitt_checkbox_image_berangkas" id="'+id+'" data-name="'+$filename+'" />'+
    //                     '<label for="'+id+'" class="lbl_berangkas">'+
    //                         '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
    //                         '<span class="cover-checkbox">'+
    //                             '<svg viewBox="0 0 12 10">'+
    //                                 '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
    //                             '</svg>'+
    //                         '</span>'+
    //                         '<div class="info">'+description_+'</div>'+
    //                     '</label>'+
    //                 '</div>';
    //                 $('#album_berangkas').append($element);
    //             }
    //             $('.pilih-berkas').click(function(){
    //                 var $data_name = $(this).data('name');
    //                 $globalUpload.input_id.val($data_name)
    //                 $('#modal_berangkas_file').modal('hide')
    //                 $globalUpload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
    //             })
    //         }).fail(function() {
    //             // An error occurred
    //         });
    // },*/

    // show_gallery: function() {
    //     if ($globalVar.page == 'gallery') {
    //         var page = 'gallery/show';
    //     }else{
    //         var page = $globalVar.page+'/show_gallery';
    //     }
    //     var params = {
    //         "type": "get",
    //         "action": "get",
    //         "data": {
    //             "limit":0,
    //             "offset":0,
    //             "sort": "id",
    //             "order": "desc",
    //             "search": "",
    //             "created_by": true
    //         },
    //         "cache": true,
    //         "contentType": "application/json",
    //         "dataType": "json"
    //     };
    //     var url = $base_url+'/admin/'+page;
    //     var ali = $globalAjax.ummay(url,params);
    //     ali.done(function(result) {
    //         var response = JSON.parse(result);
    //         $globFunc.ch_message_modal_modal(response.message);
    //         var data = response.rows;
    //         $('#album_gallery').empty();
    //         for(let index in data){
    //             var $id = data[index].id;
    //             var id = data[index].id;
    //             var filename = data[index].filename;
    //             var description = data[index].description;

    //             if(filename == ''){
    //                 var $filename = 'no_image.jpg';
    //             }else{
    //                 var $filename = filename;
    //             }

    //             if (description == '' || description == null) {
    //                 var description_ = filename;
    //             }else{
    //                 var description_ = description;
    //             }

    //             var $element = '<div class="cont-checkbox">'+
    //                 '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
    //                 '<label for="'+id+'" class="lbl_gallery">'+
    //                     '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
    //                     '<span class="cover-checkbox">'+
    //                         '<svg viewBox="0 0 12 10">'+
    //                             '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
    //                         '</svg>'+
    //                     '</span>'+
    //                     '<div class="info">'+description_+'</div>'+
    //                 '</label>'+
    //             '</div>';
    //             $('#album_gallery').append($element);
    //         }
    //         $('.pilih-berkas').click(function(){
    //             var $data_name = $(this).data('name');
    //             $globalUpload.input_id.val($data_name)
    //             $('#modal_gallery').modal('hide')
    //             $globalUpload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
    //         })
    //     }).fail(function() {
    //         // An error occurred
    //     });
    // },

    // show_gallery2: function() {
    //     var page = 'gallery/show';
    //     var params = {
    //         "type": "get",
    //         "action": "get",
    //         "data": {
    //             "limit":0,
    //             "offset":0,
    //             "sort": "id",
    //             "order": "desc",
    //             "search": "",
    //             "created_by": true
    //         },
    //         "cache": true,
    //         "contentType": "application/json",
    //         "dataType": "json"
    //     };
    //     var url = $base_url+'/admin/'+page;
    //     var ali = $globalAjax.ummay(url,params);
    //     ali.done(function(result) {
    //         var response = JSON.parse(result);
    //         $globFunc.ch_message_modal_modal(response.message);
    //         var data = response.rows;
    //         $('#album_gallery').empty();
    //         for(let index in data){
    //             var $id = data[index].id;
    //             var id = data[index].id;
    //             var filename = data[index].filename;
    //             var description = data[index].description;

    //             if(filename == ''){
    //                 var $filename = 'no_image.jpg';
    //             }else{
    //                 var $filename = filename;
    //             }

    //             if (description == '' || description == null) {
    //                 var description_ = filename;
    //             }else{
    //                 var description_ = description;
    //             }

    //             var $element = '<div class="cont-checkbox">'+
    //                 '<input type="checkbox" class="dorbitt_checkbox_image_gallery" name="dorbitt_checkbox_image_gallery" id="'+id+'" data-name="'+$filename+'" />'+
    //                 '<label for="'+id+'" class="lbl_gallery">'+
    //                     '<img src="'+ $base_url +'uploads/'+ $filename + '?crop=0.781xw:0.739xh;0.109xw,0.0968xh&resize=480:*"/>'+
    //                     '<span class="cover-checkbox">'+
    //                         '<svg viewBox="0 0 12 10">'+
    //                             '<polyline points="1.5 6 4.5 9 10.5 1"></polyline>'+
    //                         '</svg>'+
    //                     '</span>'+
    //                     '<div class="info">'+description_+'</div>'+
    //                 '</label>'+
    //             '</div>';
    //             $('#album_gallery').append($element);
    //         }
    //         $('.pilih-berkas').click(function(){
    //             var $data_name = $(this).data('name');
    //             $globalUpload.input_id.val($data_name)
    //             $('#modal_gallery').modal('hide')
    //             $globalUpload.image_id.attr('src', $base_url + 'uploads/' + $data_name)
    //         })
    //     }).fail(function() {
    //         // An error occurred
    //     });
    // },

    // upload_file_gallery: function() {
    //     var formData = new FormData();
    //     formData.append('file_upload', $('#file_upload')[0].files[0]);
    //     $.ajax({
    //         "url": $base_url + 'admin/gallery/do_upload',
    //         "method": "POST",
    //         "timeout": 0,
    //         "processData": false,
    //         "mimeType": "multipart/form-data",
    //         "contentType": false,
    //         "data": formData,
    //         beforeSend: function(e) {
    //             $('#modal_loader_submit_file').show()
    //             if(e && e.overrideMimeType) {
    //                 e.overrideMimeType('application/jsoncharset=UTF-8')
    //             }
    //         },
    //         complete: function(){
    //             $('#modal_loader_submit_file').hide()
    //         }
    //     })
    //     .done(function(result) {
    //         var response = JSON.parse(result);
    //         // console.log(response)
    //         // console.log(response.status)
    //         if(response.status==true){
    //             // $globalUpload.randomname = response.name;
    //             var payload = JSON.stringify({
    //                 "body": {
    //                     "filename": response.name,
    //                     "description": $('#file_description').val()
    //                 }
    //             })
    //             $globalUpload.insert_file_gallery(payload);
    //         }else{
    //             $('#modal_alert_submit_file').addClass('bg-success');
    //             $('#modal_alert_submit_file').html(response.errors.file_upload).fadeIn().delay(10000).fadeOut();
    //         }
    //     }).fail(function() {
    //         // An error occurred
    //     });
    // },

    // insert_file_gallery: function(payload) {            
    //     $.ajax({
    //         "url": $base_url + 'admin/gallery/create',
    //         "method": "POST",
    //         "timeout": 0,
    //         "processData": false,
    //         "mimeType": "multipart/form-data",
    //         "contentType": false,
    //         "data": payload,
    //         beforeSend: function(e) {
    //             $('#modal_loader_submit_file').show()
    //             if(e && e.overrideMimeType) {
    //                 e.overrideMimeType('application/jsoncharset=UTF-8')
    //             }
    //         },
    //         complete: function(){
    //             $('#modal_loader_submit_file').hide()
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             alert(xhr.responseText);
    //         }
    //     })
    //     .done(function(result) {
    //         // console.log(result)
    //         var response = JSON.parse(result);
    //         if (response.status==true) {
    //             $('#modal_alert_submit_file').addClass('bg-success');
    //             $('#modal_alert_submit_file').html('Upload sukses').fadeIn().delay(10000).fadeOut();
    //             $globalUpload.show_gallery();
    //             $('#upload_img_thumbnail').attr('src', $base_url + 'uploads/no_image.jpg');
    //             $('#file_upload, #file_description').val('');
    //         }else{
    //             // $('#message_alert').html("");
    //             // var errors = response.message;
    //             // for(let index in errors){
    //             //     $('#message_alert').append("<li>"+errors[index]+"</li>");
    //             // }
    //             // $('#message_modal').modal('show');
    //         }
    //         $globFunc.ch_message_modal_modal(response.message);
    //     }).fail(function() {
    //         // An error occurred
    //         console.log(create)
    //     });
    // },

    // hapus_file_gallery: function(id) {
    //     $.ajax({
    //         "url": $base_url + "admin/gallery/delete/" + id,
    //         "method": "DELETE",
    //         "timeout": 0,
    //         beforeSend: function(e) {
    //             $('#modal_loader_gallery').show()
    //             if(e && e.overrideMimeType) {
    //                 e.overrideMimeType('application/jsoncharset=UTF-8')
    //             }
    //         },
    //         complete: function(){
    //             $('#modal_loader_gallery').hide()
    //         },
    //         success: function(response){
    //             // console.log(response)
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             alert(xhr.responseText);
    //         }
    //     })
    //     .done(function(result) {
    //         var response = JSON.parse(result);
    //         console.log(response.status)
    //         if(response.status==true){
    //             $globalUpload.show_gallery();
    //         }
    //     }).fail(function() {
    //         // An error occurred
    //     });
    // }
}

/**
 * GLOBAL DATATABLES
 * */
var $datatable = {
    umma: function(url, payload) {
        var table = $('#dataTable').DataTable({
            'ajax': '/test/0',
            'processing': true,
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': '<div class="spinner"></div>'
            }
        });
    },

    config: function(col)
    {
        return {
            deferLoading: 57,
            processing: true,
            lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
            select: true,
            layout: {
                topStart: {
                    buttons: [
                        "pageLength",
                        {
                            text: 'Approve',
                            action: function (e, dt, node, config) {
                                alert('Button activated');
                            }
                        }
                        ]
                }
            },
            columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
            ],
            fixedColumns: {
                start: 2
            },
            order: [[1, 'asc']],
            scrollCollapse: true,
            scrollX: true,
            scrollY: 300,
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            columns: [
                { data: ''},
                { 
                    data: 'doc_code',
                    render: function (data, type) {
                        return '<a href="#">' + data + ' <i class="fas fa-external-link-alt ml-2"></i></a>';
                    }
                },
                { 
                    data: 'doc_date',
                    render: function (data, type) {
                        // var d = new Date(data),
                        //     month = '' + (d.getMonth() + 1),
                        //     day = '' + d.getDate(),
                        //     year = d.getFullYear();

                        // if (month.length < 2) 
                        //     month = '0' + month;
                        // if (day.length < 2) 
                        //     day = '0' + day;

                        // return [year, month, day].join('-');
                        return $globFunc.date_ymd(data);
                    }
                },
                { data: 'category' },
                { data: 'CostCenterName' },
                { data: 'receive_name' },
                { data: 'aprove_name' },
                { data: 'doc_remark' }
                ]
        };
    }
}

/**
 * GLOBAL AJAX
 * */
var $globalAjax = {
    ummu: function(url, payload) {
        // console.log(payload);
        var jqXHR = $.ajax({
            "url": url,
            "method": payload.type,
            "timeout": 0,
            "headers": {
                "Content-Type": payload.contentType,
            },
            "data": payload.data,
            "prossesing": true,
            'language': {
                'loadingRecords': '&nbsp;',
                'processing': '<div class="spinner"></div>'
            },  
            beforeSend: function(e) {
                // if (payload.type == 'delete') {
                //     $('#loader_delete').show()
                // }else{
                //     $('#modal_loader_input').show()
                // }

                if (payload.action == 'delete') {
                    $('#loader_delete').show()
                }else if (payload.action == 'multiple_delete') {
                    $('#loader_mulitple_delete').show()
                }else if (payload.action == 'insert' || payload.action == 'update') {
                    $('#modal_loader_input').show()
                }

                if(e && e.overrideMimeType) {
                    e.overrideMimeType('application/jsoncharset=UTF-8')
                }
                $('#response_message, #response_message_modal, #response_message_modal_modal').removeClass('text-success msg_animation');
            },
            complete: function(){
                if (payload.action == 'delete') {
                    $('#loader_delete').hide()
                }else if (payload.action == 'multiple_delete') {
                    $('#loader_mulitple_delete').hide()
                }else if (payload.action == 'insert' || payload.action == 'update') {
                    $('#modal_loader_input').hide()
                }
                // $('#loader_delete').hide()
                // $('#loader_mulitple_delete').hide()
                // $('#modal_loader_input').hide()
            },
            success: function(response){
                // console.log(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });

        return jqXHR;
    },

    ummay: function(url, payload) {
        // console.log(payload);
        var jqXHR = $.ajax({
            "url": url,
            "method": payload.type,
            "timeout": 0,
            "headers": {
                "Content-Type": payload.contentType,
            },
            "data": payload.data,
            beforeSend: function(e) {
                if (payload.action == 'delete') {
                    $('#loader_delete').show()
                }else if (payload.action == 'multiple_delete') {
                    $('#loader_mulitple_delete').show()
                }else if (payload.action == 'insert' || payload.action == 'update') {
                    $('#modal_loader_input').show()
                }

                if(e && e.overrideMimeType) {
                    e.overrideMimeType('application/jsoncharset=UTF-8')
                }
                // $('#response_message').removeClass('text-success msg_animation');
            },
            complete: function(){
                if (payload.action == 'delete') {
                    $('#loader_delete').hide()
                }else if (payload.action == 'multiple_delete') {
                    $('#loader_mulitple_delete').hide()
                }else if (payload.action == 'insert' || payload.action == 'update') {
                    $('#modal_loader_input').hide()
                }
            },
            success: function(response){
                // console.log(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });

        return jqXHR;
    },

    show: function(url, payload) {
        console.log(payload)
        // var data = params.data;
        // // console.log(data)

        // if (data.sort) {
        //     var sort = data.sort;
        // }else{
        //     var sort = "id"
        // }

        // if (data.order) {
        //     var order = data.order;
        // }else{
        //     var order = "desc"
        // }

        // var jqXHR = $.ajax({
        //     "url": url + "?limit=" + data.limit + "&offset=" + data.offset + "&sort=" + sort + "&order=" + order + "&search=" + data.search,
        //     "method": "GET",
        //     "timeout": 0,
        // });

        // return jqXHR;

        var jqXHR = $.ajax({
            "url": url,
            "method": payload.type,
            "timeout": 0,
            "headers": {
                "Content-Type": payload.contentType,
            },
            "data": payload.data,
            beforeSend: function(e) {
                $('#modal_loader_input').show()
                if(e && e.overrideMimeType) {
                    e.overrideMimeType('application/jsoncharset=UTF-8')
                }
                // $('#response_message').html('');
                $('#response_message').removeClass('text-success msg_animation');
            },
            complete: function(){
                $('#modal_loader_input').hide()
            },
            success: function(response){
                // console.log(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });

        return jqXHR;
    },

    findAll: function(params, url) {
        var data = params.data;
        // console.log(data)

        if (data.sort) {
            var sort = data.sort;
        }else{
            var sort = "id"
        }

        if (data.order) {
            var order = data.order;
        }else{
            var order = "desc"
        }

        var jqXHR = $.ajax({
            "url": $base_url + url + "/findAll?limit=" + data.limit + "&offset=" + data.offset + "&sort=" + sort + "&order=" + order + "&search=" + data.search,
            "method": "GET",
            "timeout": 0,
        });

        return jqXHR;
    },

    save: function(url, method, payload) {
        console.log(payload)
        // var jqXHR = $.ajax({
        //     "url": url,
        //     "method": method,
        //     "timeout": 0,
        //     "headers": {
        //         "Content-Type": "application/json",
        //     },
        //     "data": payload,
        //     beforeSend: function(e) {
        //         $('#modal_loader_input').show()
        //         if(e && e.overrideMimeType) {
        //             e.overrideMimeType('application/jsoncharset=UTF-8')
        //         }
        //         $('#response_message').html('');
        //         $('#response_message').removeClass('text-success msg_animation');
        //     },
        //     complete: function(){
        //         $('#modal_loader_input').hide()
        //     },
        //     success: function(response){
        //         // console.log(response)
        //     },
        //     error: function (xhr, ajaxOptions, thrownError) {
        //         alert(xhr.responseText);
        //     }
        // });

        // return jqXHR;
    },

    create: function(url, payload) {
        var jqXHR = $.ajax({
            "url": url,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": payload,
            beforeSend: function(e) {
                $('#modal_loader_input').show()
                if(e && e.overrideMimeType) {
                    e.overrideMimeType('application/jsoncharset=UTF-8')
                }
                $('#response_message').html('');
                $('#response_message').removeClass('text-success msg_animation');
            },
            complete: function(){
                $('#modal_loader_input').hide()
            },
            success: function(response){
                // console.log(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });

        return jqXHR;
    },

    update: function(url, payload) {
        var jqXHR = $.ajax({
            "url": url,
            "method": "PUT",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": payload,
            beforeSend: function(e) {
                $('#modal_loader_input').show()
                if(e && e.overrideMimeType) {
                    e.overrideMimeType('application/jsoncharset=UTF-8')
                }
                $('#response_message').html('');
                $('#response_message').removeClass('text-success msg_animation');
            },
            complete: function(){
                $('#modal_loader_input').hide()
            },
            success: function(response){
                // console.log(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });

        return jqXHR;
    },

    delete: function(url, params) {

    },

    wilayahIndonesia: {
        getRegencies: function(provincie_id,auto_slected) {
            $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/wilayah_indonesia/regencies/"+provincie_id,
                dataType: 'JSON',
                contentType: false,
                processData: false,
            }).done(function(result) {
                var data = result;
                console.log(data)
                for(let index in data){
                    if (data[index].id==auto_slected) {
                        var selected_auto = "selected";
                    }else{
                        var selected_auto = "";
                    }
                    $('#regencies').append("<option value='"+data[index].id+"'"+selected_auto+" >"+data[index].name+"</option>");
                }
                $('#regencies').attr('disabled', false);
                
                $("#regencies").select2({ 
                    dropdownParent: $("#InsertModal"),
                    theme: "bootstrap4",
                });
            }).fail(function() {
                // An error occurred
            });
        },

        getDistricts: function(regencie_id,auto_slected) {
            $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/wilayah_indonesia/districts/"+regencie_id,
                dataType: 'JSON',
                contentType: false,
                processData: false,
            }).done(function(result) {
                var data = result;
                console.log(data)
                for(let index in data){
                    if (data[index].id==auto_slected) {
                        var selected_auto = "selected";
                    }else{
                        var selected_auto = "";
                    }
                    $('#districts').append("<option value='"+data[index].id+"'"+selected_auto+">"+data[index].name+"</option>");
                }
                $('#districts').attr('disabled', false);

                $("#districts").select2({ 
                    dropdownParent: $("#InsertModal"),
                    theme: "bootstrap4",
                });
            }).fail(function() {
                // An error occurred
            });
        },

        getVillages: function(district_id,auto_slected) {
            $.ajax({
                type: 'GET',
                url: $base_url + "admin/referensi/wilayah_indonesia/villages/"+district_id,
                dataType: 'JSON',
                contentType: false,
                processData: false,
            }).done(function(result) {
                var data = result;
                console.log(data)
                for(let index in data){
                    if (data[index].id==auto_slected) {
                        var selected_auto = "selected";
                    }else{
                        var selected_auto = "";
                    }
                    $('#villages').append("<option value='"+data[index].id+"'"+selected_auto+">"+data[index].name+"</option>");
                }
                $('#villages').attr('disabled', false);

                $("#villages").select2({ 
                    dropdownParent: $("#InsertModal"),
                    theme: "bootstrap4",
                });
            }).fail(function() {
                // An error occurred
            });
        }
    },

    masterData: {

    },    

    getRefStatusMahasiswa: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/get_ref_status_mahasiswa/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getRefJenisTinggal: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/jenis_tinggal/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getRefAlatTransportasi: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/alat_transportasi/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getRefPekerjaan: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/pekerjaan/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getRefPenghasilan: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/penghasilan/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getRefPendidikan: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/referensi/pendidikan/",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    },

    getProdi: function() {
        var jqXHR = $.ajax({
            type: 'GET',
            url: $base_url + "admin/prodi/findAll?limit=10&offset=0&sort=id&order=desc&search=",
            dataType: 'JSON',
            contentType: false,
            processData: false,
        });

        return jqXHR;
    }
}

/**
 * GLOBAL REFERENCES
 * */
var $globalRef = {
    getAll: function() {
        $globalRef.getProvinces();
        $globalRef.getRefAgama();
        $globalRef.getRefStatusMahasiswa();
        $globalRef.getRefJenisTinggal();
        $globalRef.getRefAlatTransportasi();
        $globalRef.getRefPendidikan();
        $globalRef.getRefPekerjaan();
        $globalRef.getRefPenghasilan();
        $globalRef.getRoles();
    },

    getProvinces: function(selectedID = null) {
        var $data = $ref.provinces;
        // console.log(selectedID);
        $('#provinces').empty();
        if(selectedID === null){
            $('#provinces').append("<option value='' selected disabled>Choose...</option>");
            for(let index in $data){
                $('#provinces').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
            }
        }else{
            $('#provinces').append("<option value='' disabled>Choose...</option>");
            for(let index in $data){
                $('#provinces').append("<option value='"+$data[index].id+"'"+selectedID+">"+$data[index].name+"</option>");
            }
        }
        $("#provinces").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4",
            // placeholder: "Buscar y Selecionar",
            // width: 'auto',
            // dropdownAutoWidth: true,
            // allowClear: true,
        });
    },

    getRefAgama: function() {
        var $referensi = localStorage.getItem('referensi');
        var $ref = JSON.parse($referensi);
        var $data = $ref.agama;

        $('#agama').empty();
        $('#agama').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#agama').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        $("#agama").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4"
        });
    },

    getRefStatusMahasiswa: function() {
        var $data = $ref.status_mhs;

        $('#status').empty();
        $('#status').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#status').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        // $("#status").select2({ 
        //     dropdownParent: $("#InsertModal"),
        //     theme: "bootstrap4"
        // });
    },

    getRefJenisTinggal: function() {
        var $data = $ref.jenis_tinggal;

        $('#jenis_tinggal').empty();
        $('#jenis_tinggal').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#jenis_tinggal').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        $("#jenis_tinggal").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4"
        });
    },

    getRefAlatTransportasi: function() {
        var $data = $ref.alat_transportasi;

        $('#alat_transportasi').empty();
        $('#alat_transportasi').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#alat_transportasi').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        $("#alat_transportasi").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4"
        });
    },

    getRefPendidikan: function() {
        var $data = $ref.tingkat_pendidikan;

        $('#pendidikan_ayah, #pendidikan_ibu, #pendidikan_wali').empty();
        $('#pendidikan_ayah, #pendidikan_ibu, #pendidikan_wali').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#pendidikan_ayah, #pendidikan_ibu, #pendidikan_wali').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        $("#pendidikan_ayah, #pendidikan_ibu, #pendidikan_wali").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4",
        });
    },

    getRefPekerjaan: function() {
        var $data = $ref.jenis_pekerjaan;

        $('#pekerjaan_ayah, #pekerjaan_ibu, #pekerjaan_wali').empty();
        $('#pekerjaan_ayah, #pekerjaan_ibu, #pekerjaan_wali').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#pekerjaan_ayah, #pekerjaan_ibu, #pekerjaan_wali').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        $("#pekerjaan_ayah, #pekerjaan_ibu, #pekerjaan_wali").select2({ 
            dropdownParent: $("#InsertModal"),
            theme: "bootstrap4",
        });
    },

    getRefPenghasilan: function() {
        var $data = $ref.penghasilan;

        $('#penghasilan_ayah, #penghasilan_ibu, #penghasilan_wali').empty();
        $('#penghasilan_ayah, #penghasilan_ibu, #penghasilan_wali').append("<option value='' selected disabled>Choose...</option>");
        for(let index in $data){
            $('#penghasilan_ayah, #penghasilan_ibu, #penghasilan_wali').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
        }
        // $("#penghasilan_ayah, #penghasilan_ibu, #penghasilan_wali").select2({ 
        //     dropdownParent: $("#InsertModal"),
        //     theme: "bootstrap4",
        // });
    },

    // getRoles: function(selectedID = null) {
    //     var $data = $ref.roles;
    //     // console.log(selectedID);
    //     $('#role').empty();
    //     if(selectedID === null){
    //         $('#role').append("<option value='' selected disabled>Choose...</option>");
    //         for(let index in $data){
    //             $('#role').append("<option value='"+$data[index].id+"'>"+$data[index].name+"</option>");
    //         }
    //     }else{
    //         $('#role').append("<option value='' disabled>Choose...</option>");
    //         for(let index in $data){
    //             $('#role').append("<option value='"+$data[index].id+"'"+selectedID+">"+$data[index].name+"</option>");
    //         }
    //     }
    // },
}

/** 
 * GLOBAL FORMATTER
 * */
var $globalFormatter = {
    jenis_kelamin: function(id) {
        if (id==0) {
            return 'Perempuan'
        }else if (id==1) {
            return 'Laki-laki'
        }else{
            return '-'
        }
    },

    sesi_kelas: function(id) {
        if (id==1) {
            return 'Pagi'
        }else if (id==2) {
            return 'Malam'
        }else{
            return '-'
        }
    },

    status_mahasiswa: function(id) {
        if (id==1) {
            return '<span class="badge bg-success">Active</span>'
        }else if (id==2) {
            return '<span class="badge bg-warning">Cuti</span>'
        }else if (id==3) {
            return '<span class="badge bg-danger">DO</span>'
        }else if (id==4) {
            return '<span class="badge bg-secondary">Mengundurkan Diri</span>'
        }else if (id==5) {
            return '<span class="badge bg-secondary">Pindah</span>'
        }else if (id==6) {
            return '<span class="badge bg-secondary">Lulus</span>'
        }else{
            return '-'
        }
    },

    forntAwesome: function(data) {
        var icon = $('<textarea />').html(data).text();
        return icon;
    },

    avatar: function(name)
    {
        if (name) {
            var img = '<img class="img-thumbnail" src="'+$base_url+'uploads/'+name+'">';
        }else{
            var img = '';
        }
        return img
    },

    active: function(id)
    {
        if (id) {
            return '<span class="badge bg-success">Active</span>';
        }else{
            return '-';
        }
    },

    moduleName: function(index, row)
    {
        if (row.is_parent == 'on') {
            var html = '<strong>'+row.name+'</strong>';
        }else{
            var html = row.name;
        }
        return html
    },

    latlng: function(index, row)
    {
        if (row.latitude) {
            var html = '<a href="http://maps.google.com/maps?q='+row.latitude+','+row.longitude+'&amp;t=m&amp;hl=en" target="_blank">'+row.latitude+','+row.longitude+'</a>';
        }else{
            var html = '';
        }

        return html;
    },

    join_datetime: function(index, row)
    {

    }
}

/**
 * GLOBAL EVENTS
 * */
var $globalEvents = {
    onClick: {
        dorbittButton: function() {
            $('#btn_show_password').click(function() {
                var type = $('#password').attr('type');
                if( type == 'password') {
                    $('#btn_show_password').html('<i class="bi bi-eye-slash-fill"></i>');
                    $('#password').attr('type', 'text')
                }else{
                    $('#btn_show_password').html('<i class="bi bi-eye-fill"></i>');
                    $('#password').attr('type', 'password')
                }
            })

            $('#message_modal_close').on('click', function(){
                $('#message_modal').modal('hide');
            })

            $('#btn_submit_file_upload').click(function() {
                var file = $('#file_upload').val();
                if(file != ''){
                    $globalUpload.upload_file_gallery()
                }else{
                    alert('Silahkan pilih file terlebih dahulu.')
                }
            })

            $('#btn_endis').click(function() {
                $('#password').val("");
                if ($('#password').is(':disabled')) {
                    $('#password').removeAttr('disabled')
                    $('#trash_icon').show()
                    $('#pencil_icon').hide()
                }else{
                    $('#password').attr('disabled','disabled')
                    $('#trash_icon').hide()
                    $('#pencil_icon').show()
                }
            })

            $('#btn_modal_max').on('click', function() {
                var el = $('#modal_dialog');
                var hasClass = el.hasClass('modal-lg');
                // console.log(hasClass)

                if (hasClass == true) {
                    el.removeClass('modal-lg');
                    el.addClass('modal-fullscreen');
                }else{
                    el.removeClass('modal-fullscreen');
                    el.addClass('modal-lg');
                }
            })

            $('#dorbitt_open_gallery').click(function() {
                var dataImage = $(this).attr('data-image');
                $globalUpload.show_gallery();
                $('#modal_gallery').modal('show');
                // $globalUpload.input_id = input_id;
                // $globalUpload.image_id = image_id;
            })

            $('#dorbitt_open_gallery2').click(function() {
                var dataImage = $(this).attr('data-image');
                $globalUpload.show_gallery2();
                $('#modal_gallery').modal('show');
                // $globalUpload.input_id = input_id;
                // $globalUpload.image_id = image_id;
            })

            // $('#btn_select_file').click(function() {
            //     var ids = [];
            //     var filenames = [];
            //     $('.dorbitt_checkbox_image_gallery:checked').each(function() {
            //         var id = $(this).attr('id');
            //         var filename = $(this).data('name');

            //         ids.push(parseInt(id));
            //         filenames.push(filename)
            //         // console.log(filename)
            //     });

            //     $globalUpload.ids = ids;
            //     $globalUpload.filenames = filenames;

            //     // app.Views.set_gallery_selected_to_img(filenames)

            //     $('#modal_gallery').modal('hide');
            //     // console.log(ids)
            // })

            $('#dorbitt_tabs .nav-tabs .nav-link').click(function() {
                var urlhash = $(this).attr('data-bs-target');
                window.location.hash = urlhash;
                // console.log(urlhash)
                // document.cookie = urlhash;
                Cookies.set('urlhash', urlhash);
            })
        }
    },

    onChange: {
        dorbittCheckBox: function() {
            $(".dorbitt_checkbox").change(function() {
                var element_id = $(this).attr('id');
                if(this.checked) {
                    eval("globalVars."+element_id+" = 1");
                }else{
                    eval("globalVars."+element_id+" = 0");
                }
            });
        },

        dorbittInput: function() {
            $('#file_upload').change(function() {
                var $id = $('#upload_img_thumbnail');
                var $filename = $(this)[0].files[0].name;
                var reader = new FileReader();
                reader.onload = function (e) {
                    $($id).attr('src', e.target.result);
                    // alert(e.target.result)
                    $globalUpload.filename = $filename;
                };
                reader.readAsDataURL($(this)[0].files[0]);
            })
        },

        dorbittRadio: function() {
            $('.dorbitt-header #rad_approve').on('change', function() {
                $globalViews.approval.status_detail(1);
            })

            $('.dorbitt-header #rad_pending').on('change', function() {
                $globalViews.approval.status_detail(3);
            })

            $('.dorbitt-header #rad_reject').on('change', function() {
                $globalViews.approval.status_detail(2);
            })
        }

        // rmChkDetApp: function() {
        //     // var radioApproveOnHeader = $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject');
        //     $('.dorbitt-detail .rad-approve').attr('checked', false);
        //     $('.dorbitt-detail .rad-pending').attr('checked', false);
        //     $('.dorbitt-detail .rad-reject').attr('checked', false);
        // }

        // selectOption: function() {
        //     $('#gedung').change(function() {
        //         var maxNum = $(this).find(':selected').attr('data-lantai');
        //         $('#lantai').val("");
        //         $('#lantai').attr('max',maxNum);
        //     });
        // }
    },

    location_hash: function() {
        var urlhash = window.location.hash;
        var urlhashc = Cookies.get('urlhash');

        if (urlhash == urlhashc) {
            $('.nav-tabs li .nav-link').removeClass('active')
            $("[data-bs-target='"+urlhash+"']").addClass('active');

            $('.tab-content .tab-pane').removeClass('active').removeClass('show')
            $(".tab-content "+urlhash).addClass('active').addClass('show');
        }
    }
}

/**
 * GLOBAL VIEWS
 * */
var $globalViews = {    
    approval: {
        status_detail: function(status) {
            $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('checked', false);
            $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('disabled', false);

            if (status == 1) { //approve
                $('.dorbitt-detail .rad-approve').prop('checked', true);
                $('.dorbitt-detail .rad-pending').prop('disabled', true);
            }

            if (status == 2) { //reject
                $('.dorbitt-detail .rad-reject').prop('checked', true);
                $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending').prop('disabled', true);
            }

            if (status == 3) { //pending
                $('.dorbitt-detail .rad-pending').prop('checked', true);
                $('.dorbitt-detail .rad-reject').prop('disabled', true);
            }
        },
        status_detail_on_load: function(status) {
            // $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('checked', false);
            $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending, .dorbitt-detail .rad-reject').prop('disabled', false);

            if (status == 1) { //approve
                // $('.dorbitt-detail .rad-approve').prop('checked', true);
                $('.dorbitt-detail .rad-pending').prop('disabled', true);
            }

            if (status == 2) { //reject
                // $('.dorbitt-detail .rad-reject').prop('checked', true);
                $('.dorbitt-detail .rad-approve, .dorbitt-detail .rad-pending').prop('disabled', true);
            }

            if (status == 3) { //pending
                // $('.dorbitt-detail .rad-pending').prop('checked', true);
                $('.dorbitt-detail .rad-reject').prop('disabled', true);
            }
        },
    },

    modal: {
        message: function() {
            var html = '<div class="modal fade" id="message_modal" tabindex="-1" style="z-index: 2000;">'+
            '<div class="modal-dialog">'+
            '<div class="modal-content">'+
            '<div class="modal-header bg-secondary">'+
            '<h5 class="modal-title text-light" id="message_title">Messages</h5>'+
            '<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>'+
            '</div>'+
            '<div class="alert" id="text_message"></div>'+
            '</div>'+
            '</div>'+
            '</div>';
        }
    }
}