@extends('admin.layouts.app')
@section('title', 'Lenders')
@push('style')
    <style>
        .dd-handle {
            display: block;
            height: 50px!important;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid #ccc;
            background: #fafafa;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            max-width: 100%;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <section class="content-header pb-1">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Menu Edit</h1>
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
        <!-- Main Lender -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header custom-d-flex">
                                <span><strong>Edit Menu : </strong>{{ @$menu->name }}</span>
                                <a href="{{ route('admin.create.item', @$menu->id)  }}"
                                   class="btn btn-sm btn-danger float-right c-mr3">
                                    <i class="fa fa-plus"></i><strong> Create</strong>
                                </a>
                                <a href="{{ route('admin.menu-items.index') }}"
                                   class="btn btn-sm btn-warning float-right mr-2">
                                    <i class="fa fa-arrow-left"></i><strong> Back</strong>
                                </a>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <div class="col-md-12 my-4 blue white-text">
                                    <div class="column">
                                        <div class="dd">
                                            <ol class="dd-list">
                                                @foreach($menu->menuItems()->orderBy('order', "ASC")->get() as $key => $item)
                                                    <li class="dd-item" data-id="{{ $item->id }}">
                                                        <span class="float-right pt-2 pr-2">
                                                            <a href="{{ route('admin.menu-items.edit', @$item->id)  }}"
                                                               title="Edit"
                                                               class="btn btn-info btn-sm cus_btn dz-clickable">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button onclick="deleteRow({{ @$item->id }})"
                                                                        href="JavaScript:void(0)"
                                                                        title="Delete"
                                                                        class="btn btn-danger btn-sm cus_btn">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <form id="row-delete-form{{ @$item->id }}"
                                                                      method="POST" class="d-none"
                                                                      action="{{ route('admin.menu-items.destroy', @$item->id) }}">
                                                                    @method('DELETE')
                                                                    @csrf()
                                                                </form>
                                                            </span>
                                                        <div class="dd-handle pt-3">
                                                            <span class="float-left">{{ @$item->name }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('script')
    <script>
        $('.dd').nestable({ maxDepth: 1});
        $('.dd').on('change', function (){
            $.post('{{ route('admin.menu-order', $menu->id) }}',
                {
                    order: JSON.stringify($(".dd").nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data){
                    if(data === 'backend'){
                        $.get('{{ route("admin.sidebarMenu.change") }}', function (response) {
                            $(".nav-sidebar").remove();
                            $(".ddMenuAppend").append(response);
                            toastMessage('success', 'Menu Order Successfully Updated')
                        });
                    }else{
                        toastMessage('success', 'Menu Order Successfully Updated')
                    }
                })
        })
    </script>
@endpush
