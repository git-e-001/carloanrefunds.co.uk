@extends('admin.layouts.app')

@section('title', 'Menus')

@push('style')

@endpush

@section('content')
    <div class="content-wrapper">

        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menus</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <hr style="margin: 0 0 10px 0!important;">


        <!-- Main Menu -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#frontend" data-toggle="tab">Frontend
                                            <span class="badge badge-warning">
                                                 {{ \App\Models\Menu::where('site', 'frontend')->count() }}
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#backend" data-toggle="tab">Backend
                                            <span class="badge badge-warning">
                                               {{ \App\Models\Menu::where('site', 'backend')->count() }}
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="frontend">
                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="navbar-danger text-white">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Background Color</th>
                                                    <th>Items</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($menus as $menu)
                                                    @if($menu->site === 'frontend')
                                                        <tr>
                                                            <td>{{ $menu->name }}</td>
                                                            <td><input type="text" onchange="bgHFCChange(this)"
                                                                       class="colorPicker"
                                                                       data-id="{{ $menu->id }}"
                                                                       value="{{ $menu->bg_color }}"></td>
                                                            <td>{{ $menu->menuItems()->count() }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.menu.edit', @$menu->id)  }}"
                                                                   title="Edit"
                                                                   class="btn btn-info btn-sm cus_btn">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button
                                                                    onclick="headerAndFooterBackgroundChange('{{$menu->name}}', '{{$menu->id}}', '{{$menu->bg_color}}')"
                                                                    title="Background Color Change"
                                                                    class="btn btn-info btn-sm cus_btn">
                                                                    <i class="fa fa-palette"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="7">No Records</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="backend">

                                        <div class="card-body p-0 table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="navbar-danger text-white">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Items</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($menus as $menu)
                                                    @if($menu->site === 'backend')
                                                        <tr>
                                                            <td>{{ $menu->name }}</td>
                                                            <td>{{ $menu->menuItems()->count() }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.menu.edit', @$menu->id)  }}"
                                                                   title="Edit"
                                                                   class="btn btn-info btn-sm cus_btn">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="7">No Records</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="headerFooterBgChangeModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title HFMN" id="headerFooterBgChangeModal">Modal title</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.change.header.footer.color') }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="menu_id" id="menuID">
                        <div class="form-group">
                            <label for="HFBgColor">Choose Color <span class="required-star"> *</span></label>
                            <input type="text" name="bg_color" id="BgColor" required class="form-control colorPicker">
                            @error('bg_color')
                            <span class="help-block m-b-none text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>
        function headerAndFooterBackgroundChange(menuName, id, color) {
            if (id) {
                $("#menuID").val(id)
                $("#BgColor").val(color)
                $(".HFMN").text('Change The ' + menuName + ' Background Color')
                $("#headerFooterBgChangeModal").modal('show')
            }
            colorPicker()
        }

        function bgHFCChange(el) {
            let menuId = $(el).data('id');
            let bgColor = $(el).val();
            if (menuId && bgColor) {
                axios.post("{{ route('admin.change.header.footer.color') }}", {
                    menu_id: menuId,
                    bg_color: bgColor,
                })
                    .then(res => {
                        if (res.status === 200) {
                            toastr.success('Background color successfully changed')
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        }

    </script>
@endpush
