@extends('base::layouts.master')
@section('title', __('Add'))

@section('content')
<div class="row">
    <div class="col-md-6">
        <form class="form">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Form</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="email" class="form-control form-control-solid" placeholder="Enter full name"/>
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control select2" id="parent_menu" name="parent_menu">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Module</label>
                        <input type="email" class="form-control form-control-solid" placeholder="Enter full name"/>
                    </div>
                    <div class="form-group">
                        <label>Order</label>
                        <input type="number" class="form-control form-control-solid" placeholder="Enter email"/>
                    </div>
                    <div class="form-group">
                        <label>Route</label>
                        <select class="form-control select2" id="route" name="route">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>URI</label>
                        <input type="text" id="uri" class="form-control form-control-solid" placeholder="Enter URI or select route name"/>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function() {
            $('#parent_menu').select2({
                placeholder: "Parent Menu",
                allowClear: true,
                ajax: {
                    url: '{{ route('menu:api.options') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            $('#route').select2({
                placeholder: "Route",
                allowClear: true,
                ajax: {
                    url: '{{ route('menu:api.routes') }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
            $('#route').on('select2:select', (e) => {
                $('#uri').val(e?.params?.data?.path || '');
            })
        })
    </script>
@endsection
