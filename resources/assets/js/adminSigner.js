/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global SendRequest, DatatableBase */

function Signer(option) {
    var current = this;
    this.table = null;
    this.request = null;
    this.type = 'cde';
    this.lang = {
        'trans': {
            'title_create': 'Tạo mới thông tin người ký',
            'title_update': 'Cập nhật thông tin người ký',
            'confirm_delete': 'Xác nhận xóa người ký'
        },
    };
    this.url = {
        'ajaxList': '',
        'ajaxCreate': '',
        'ajaxUpdate': '',
        'ajaxDelete': '',
        'ajaxOrganizationListOnly': '',
    };
    this.columns = [
        {'data': 'name'},
        {'data': 'jobTitle'},
        {'data': 'organization.name'},
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
    this.loadOrganization = function () {
        SendRequest.send(current.url.ajaxOrganizationListOnly, current.request, 'get', function (response) {
            if (response.status === 200) {
                $('#organization_id').children(':nth-child(n+2)').remove();
                $('#organization_id').append(drawOrganizationList(response.responseJSON.data));
            } else {
                alert(current.lang.trans.load_categories_error + response.status);
            }
        });
    };
    this.showFormUpdate = function (rData) {
        current.loadOrganization();
        $('option').prop('selected', false);
        $('option').prop('disabled', false);
        $('option[value="' + rData.organization_id + '"]').prop('selected', true);
        $('option[value="' + rData.id + '"]').prop('disabled', true);
        $('input[name=id]').val(rData.id);
        $('input[name=jobTitle]').val(rData.jobTitle);
        $('#name').val(rData.name);
    };
    this.showFormCreate = function (){
        this.loadOrganization();
        $('option').prop('selected', false);
        $('option').prop('disabled', false);
    };
    this.init(option);

    return this;
}
