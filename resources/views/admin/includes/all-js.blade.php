<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
{{--<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>--}}
<!-- JQVMap -->
{{--<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>--}}
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
{{--select 2 js link--}}
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>

<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
{{--<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>--}}

<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


<!-- AdminLTE App -->
{{--<script src="{{ asset('backend') }}/dist/js/adminlte.min.js"></script>--}}
<!-- AdminLTE for demo purposes -->

{{--<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>--}}


<script src="https://cdn.tiny.cloud/1/jxp5f1smknvxj4ghtci43vdmsmoid841wzt6ub225bhvp95p/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

<script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>


<script>
    function colorPicker() {
        $('.colorPicker').spectrum({
            type: "component"
        });
    }

    colorPicker()
</script>

{{-- script --}}
@stack('script')

<script>
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;


    function initTinyMce() {
        tinymce.init({
            selector: 'textarea.TextEditor',
            plugins: 'preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save | insertfile image media link codesample',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            importcss_append: true,
            templates: [
                {
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...'},
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 500,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image imagetools table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            branding: false,
            tinycomments_mode: 'embedded',
            tinycomments_author: 'devxhub',

            automatic_uploads: true,
            file_picker_types: 'file image media',
            images_upload_handler: function (blobInfo, success, failure) {
                console.log(success)
                let data = new FormData();
                data.append('file', blobInfo.blob(), blobInfo.filename());
                axios.post('/tiny-file-upload', data)
                    .then(function (res) {
                        success(res.data.location);
                    })
                    .catch(function (err) {
                        failure('HTTP Error: ' + err.message);
                    });
            },

            setup: function (ed) {
                ed.on('KeyDown', function (e) {

                    if ((e.keyCode == 8 || e.keyCode == 46) && ed.selection) { // delete & backspace keys
                        var selectedNode = ed.selection.getNode(); // get the selected node (element) in the editor


                        console.log(selectedNode)


                        if (selectedNode && selectedNode.nodeName == 'IMG') {


                            axios.post('/tiny-file-upload-delete', {name: selectedNode.src})
                                .then(res => {
                                    console.log(res)
                                })
                        }
                    }
                });
            },
        });
    }

    initTinyMce()
</script>

<!-- our custom js-->

<script>


    $(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: true,
            timer: 3000
        });

        window.toastMessage = function (type, message) {
            Toast.fire({
                icon: type,
                title: message
            })
        }

        @foreach(['success', 'warning', 'error', 'info'] as $item)
        @if(session($item))
        toastMessage('{{ $item }}', '{{ session($item) }}')
        @endif
        @endforeach
    })

    // dashboard all image preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#old_img").addClass('display_none')
                $(".image_preview_delete_icon").addClass('display_none')
                $("#preview_image").removeClass('display_none')
                $(".chancel_btn").removeClass('display_none')
                $(".image-sec-hide").removeClass('display_none')
                $('#preview_image').attr('src', e.target.result);
                $('.old_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImage2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#old_img2").addClass('display_none2')
                $(".chancel_btn2").removeClass('display_none')
                $(".image-sec-hide").removeClass('display_none')
                $(".image_preview_delete_icon2").addClass('display_none')
                $("#preview_image2").removeClass('display_none2')
                $('#preview_image2').attr('src', e.target.result);
                $('.old_img2').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    var wantToImageDelete = true

    //hold site editable image delete
    function deleteImage(e, base_path, id) {
        if (!wantToImageDelete) {
            toastr.warning('please define solid image')
            return false
        }
        // console.log({base_path, id, image_id})
        $.get('{{ route('admin.image.delete') }}',
            {
                base_path: base_path,
                id: id,
            }, function (response) {
                if (response.success) {
                    $(e).parents('.image-sec-hide').addClass('display_none');
                    $(e).siblings('img').attr('src', '')
                    toastr.success('Image successfully deleted')
                }
            })
    }

    function chancelImage(e, fileClassName) {
        $(e).parents('.image-sec-hide').addClass('display_none');
        $("." + fileClassName).val('')
    }

    function deleteRow(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will not be able to recover this item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1ab394',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('row-delete-form' + id).submit();
            }
        })
    };

    // change publication status
    function changeStatus(e) {
        let id = $(e).attr('id'),
            route = $(e).data('route')

        axios.get(route + '/' + id)
            .then(function (response) {
                let statusBtn = $(e).find('span');

                if ($(statusBtn).hasClass('badge-primary')) {
                    $(statusBtn).removeClass('badge-primary').addClass('badge-danger')
                    $(statusBtn).text('Disable')
                } else {
                    $(statusBtn).removeClass('badge-danger').addClass('badge-primary')
                    $(statusBtn).text('Active')
                }
                toastMessage('success', 'Status has been updated successful.')
            })
            .catch(function (error) {
                toastMessage('error', 'Status could not be update.')
            })
    }

</script>
