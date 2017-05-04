function message(id, s, m) {
    $(id).removeClass();
    $(id).addClass('alert alert-' + s);
    $(id).html(m);
    $(id).slideDown();
    $(id).delay(3000).slideUp();
}

function drawOrganizationList(organizations, organizationParentId, pre) {
    var response = '';
    if (typeof organizationParentId === 'undefined') {
        organizationParentId = null;
    }
    if (typeof pre === 'undefined') {
        pre = '';
    }
    $.each(organizations, function (key, organization) {
        if (organization.parent_id === organizationParentId) {
            var drawChil = drawOrganizationList(organizations, organization.id, pre + '- ');
            response += '<option value="' + organization.id + '">' + pre + organization.name + '</option>';
            response += drawChil;
        }
    });
    return response;
}

$(document).ready(function () {
    $('#side-menu').metisMenu();
    $('.alert').delay(3000).slideUp();
    var url = window.location;
    $('ul.nav a').filter(function () {
        return this.href === url.href;
    }).addClass('active').closest('ul').addClass('in');
});
var addNewImage = function (input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(img).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
};
String.prototype.trunc = function (n, useWordBoundary) {
    var isTooLong = this.length > n,
        s_ = isTooLong ? this.substr(0, n - 1) : this;
    s_ = (useWordBoundary && isTooLong) ? s_.substr(0, s_.lastIndexOf(' ')) : s_;
    return isTooLong ? s_ + '&hellip;' : s_;
};
