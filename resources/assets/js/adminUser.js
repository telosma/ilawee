/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global SendRequest, DatatableBase */

function Account(option) {
    var current = this;
    this.table = null;
    this.request = null;
    this.type = 'cde';
    this.lang = {
        'trans': {
            'title_create': 'Tạo mới tài khoản',
            'title_update': 'Cập nhật tài khoản',
            'confirm_reset_pass': 'Do you want reset password users selected?',
            'confirm_delete': 'Xác nhận xóa tài khoản'
        }
    };
    this.url = {
        'ajaxList': '',
        'ajaxCreate': '',
        'ajaxUpdate': '',
        'ajaxDelete': '',
        'ajaxResetPass': '',
        'ajaxListRole': '',
    };
    this.columns = [
        {'data': 'name'},
        {'data': 'email'},
        {
            'data': function(data) {
                var roles = '';
                $.each(data.roles, function(key, role) {
                    roles += role.name + ':';
                });

                return roles;
            }
        }
    ];
    this.buttons = [
        {
            text: 'reset password',
            action: function () {
                current.resetPassword();
            },
            enabled: false,
        },
    ];
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

        DatatableBase.order.column = 4;
        DatatableBase.order.type = 'desc';
        DatatableBase.addItem(this);
        this.addEvent();
    };
    this.addEvent = function () {
        DatatableBase.table.on('select.dt deselect.dt processing.dt', function () {
            var selectedRows = DatatableBase.table.rows({selected: true}).count();
            if (selectedRows > 0) {
                DatatableBase.table.button(5).enable();
            } else {
                DatatableBase.table.button(5).disable();
            }
        });
    };
    this.loadRole = function () {
        SendRequest.send(current.url.ajaxListRole, current.request, 'get', function (response) {
            if (response.status === 200) {
                $('#list-role').html('');
                $('#list-role').append('<h3>Gán Quyền</h3>')
                $('#list-role').append(drawRoleList(response.responseJSON.data));
            } else {
                alert('Load Role error' + response.status);
            }
        });
    };
    this.showFormCreate = function (rData) {
        this.loadRole();
    }
    // this.showFormUpdate = function (rData) {
    //     $('input[name=name]').val(rData.name);
    //     $('input[name=email]').val(rData.email);
    // };
    // this.resetPassword = function () {
    //     var ids = [];
    //     DatatableBase.table
    //         .rows({selected: true})
    //         .data()
    //         .each(function (group, i) {
    //             ids.push(group.id);
    //         });
    //     if (confirm(current.lang.trans.confirm_reset_pass)) {
    //         SendRequest.send(current.url.ajaxResetPass, {id: ids}, 'post', DatatableBase.showMessage);
    //         DatatableBase.table.ajax.reload(null, false);
    //     }
    // };
    this.init(option);

    return this;
}
