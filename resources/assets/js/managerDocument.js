/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global SendRequest, DatatableBase */

function doc(option) {
    var current = this;
    this.table = null;
    this.request = null;
    this.type = 'e';
    this.dataType = 'text';
    this.lang = {
        'trans': {
            'title_create': 'Thêm mới văn bản',
            'title_update': 'Cập nhật văn bản',
        },
    };
    this.url = {
        'ajaxList': '',
        'ajaxCreate': '',
        'ajaxUpdate': '',
        'ajaxListSigner': '',
        'ajaxListDocType': ''
    };
    this.columns = [
        {'data': 'notation'},
        {'data': 'description'},
    ];
    this.buttons = [];
    this.setUrl = function (url) {
        for (var key in this.url) {
            if (typeof url[key] !== 'undefined') {
                this.url[key] = url[key];
            }
        }
    };
    this.changeLang = function (lang) {
        for (var p_key in this.lang) {
            if (typeof lang[p_key] === 'undefined') {
                continue;
            }

            for (var c_key in this.lang[p_key]) {
                if (typeof lang[p_key][c_key] !== 'undefined') {
                    this.lang[p_key][c_key] = lang[p_key][c_key];
                }
            }
        }
    };
    this.loadDocType = function () {
        SendRequest.send(current.url.ajaxListDocType, current.request, 'get', function (response) {
            if (response.status === 200) {
                $('#vb-type').children(':nth-child(n+2)').remove();
                $('#vb-type').append(drawDocTypeList(response.responseJSON.data));
            } else {
                alert(current.lang.trans.load_categories_error + response.status);
            }
        });
    };
    this.addEvent = function () {
        $('#btn-vb-submit-form').on('click', function(e) {
            e.preventDefault();
            $('[name=content]').val(CKEDITOR.instances.vbcontent.getData());
            $('#form_modal_create_doc').submit();
        });
    }
    this.init = function (options) {
        if (typeof options.url !== 'undefined') {
            this.setUrl(options.url);
        }

        if (typeof options.lang !== 'undefined') {
            this.changeLang(options.lang);
        }

        DatatableBase.addItem(this);
        $('.dt-buttons').append('<a class="dt-button" id="btn-vb-open-form"><span>Create</span></a>');
        this.addEvent();
    };
    // this.showFormCreate = function (rData) {
    //     this.loadDocType();
    //     CKEDITOR.instances.vbcontent.setData('');
    // };

    this.init(option);

    return this;
}
