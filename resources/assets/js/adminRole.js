/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global SendRequest, DatatableBase */

function role(option) {
    var current = this;
    this.table = null;
    this.request = null;
    this.type = 'cde';
    this.lang = {
        'trans': {
            'title_create': 'Tạo role mới',
            'title_update': 'Cập nhật role',
            'confirm_delete': 'Xác nhận xóa role đã tạo'
        },
    };
    this.url = {
        'ajaxList': '',
        'ajaxCreate': '',
        'ajaxUpdate': '',
        'ajaxDelete': '',
        'ajaxListPermisstion': '',
        'ajaxGetPermissionBaseRole': '',
    };
    this.columns = [
        {'data': 'name'},
        {'data': 'display_name'},
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
    this.init = function (options) {
        if (typeof options.url !== 'undefined') {
            this.setUrl(options.url);
        }

        if (typeof options.lang !== 'undefined') {
            this.changeLang(options.lang);
        }

        DatatableBase.addItem(this);
    };
    this.loadPermisstion = function () {
        SendRequest.send(current.url.ajaxListPermisstion, current.request, 'get', function (response) {
            if (response.status === 200) {
                $('#list-permission').html('');
                $('#list-permission').append('<h3>Permission</h3>')
                $('#list-permission').append(drawPermissionList(response.responseJSON.data));
            } else {
                alert('Load permisstion error' + response.status);
            }
        });
    };
    this.showFormUpdate = function (rData) {
        current.loadPermisstion();
        $('input[type=checkbox]').prop('checked', false);
        $('input[type=checkbox]').prop('disabled', false);

        $.each(rData.perms, function(k, perm) {
            $('input[type=checkbox][value=' + perm.id +']').prop('checked', true);
        });
        $('input[name=id]').val(rData.id);
        $('#name').val(rData.name);
        $('#display_name').val(rData.display_name);
        $('#description').val(rData.description);
    };
    this.showFormCreate = function (){
        this.loadPermisstion();
        $('input[type=checkbox]').prop('checked', false);
        $('input[type=checkbox]').prop('disabled', false);
    };
    this.init(option);

    return this;
}
