$(document).ready(function() {
    //Chan double click submit button
    $('#frmCustom').submit(function() {
        $(this).find("button[type='submit]").prop('disabled', true);
    });
});

function removeData(obj, tblObj, btnObj, imgObj, message = "")
{
    $('body').on('click', obj, function(e) {
        e.preventDefault();

        var me = $(this),
            url = me.attr('href'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: '',
            text: 'Bạn có muốn xóa thông tin này?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f15e5d',
            cancelButtonColor: '#c1c1c1',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': csrf_token,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == 1) {
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.timeOut = 4000;
                            toastr.warning(message);
                        } else {
                            $(tblObj).DataTable().ajax.reload(null, false);
                            if (btnObj != "") {
                                $(btnObj).click();
                                sessionStorage.removeItem("oldImage");
                                if (imgObj) {
                                    var oldImg = sessionStorage.getItem("oldImage");
                                    if (oldImg != null) {
                                        var linkImage = '{{ URL::asset("/storage/destinations") }}/' + oldImg;
                                        $('#preview').attr('src', linkImage)
                                    } else {
                                        $('#preview').attr('src', '#')
                                    }
                                }
                            }
                            toastr.options.positionClass = 'toast-top-right';
                            toastr.options.timeOut = 4000;
                            toastr.success("Xóa thành công");
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        toastr.options.positionClass = 'toast-top-right';
                        toastr.options.timeOut = 4000;
                        toastr.error("Xóa thất bại");
                    }
                });
            }
        });
    });
}