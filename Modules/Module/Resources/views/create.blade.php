@extends('base::layouts.master')
@section('title', __('Add'))

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('module:store') }}" class="form" method="POST">
                @csrf
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Module</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="module_name" class="form-control form-control-solid" placeholder="Name"/>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="module_desc" class="form-control form-control-solid" placeholder="Description"/>
                        </div>
                    </div>
                </div>
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Resource</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" value="new_source" name="resource_source" checked>
                                    <span></span>New Table
                                </label>
                                <label class="radio">
                                    <input type="radio" value="existing_source" name="resource_source">
                                    <span></span>Existing Table
                                </label>
                            </div>
                        </div>
                        <div id="new_source_form">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Table Name</label>
                                    <input type="text" name="table_name" class="form-control form-control-solid" placeholder="Table Name"/>
                                </div>
                                <div class="col-md-6">
                                    <label>Custom Table Name</label>
                                    <input type="text" name="custom_table_name" class="form-control form-control-solid" placeholder="Custom Table Name"/>
                                </div>
                            </div>
                            <div>
                                <h6>Fields</h6>
                                <div class="my-4">
                                    System Field:
                                    <span class="label label-pill label-inline">id</span>,
                                    <span class="label label-pill label-inline">created_at</span>,
                                    <span class="label label-pill label-inline">updated_at</span>
                                </div>
                                <div class="accordion accordion-toggle-arrow" id="accordionFieldList">
                                    <div id="fieldTemplate" class="card" style="display: none;">
                                        <div class="card-header">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseFieldId">
                                                <span class="font-size-base font-weight-normal field-name">Recent Reports</span>
                                            </div>
                                        </div>
                                        <div id="collapseFieldId" class="collapse" data-parent="#accordionFieldList">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input name="field[name][]" type="text" class="form-control form-control-solid" placeholder="Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Type</label>
                                                            <select name="field[type][]" class="form-control form-control-solid">
                                                                <option value="string">String</option>
                                                                <option value="integer">Integer</option>
                                                                <option value="dateTime">DateTime</option>
                                                                <option value="enum">Enum</option>
                                                                <option value="boolean">Boolean</option>
                                                                <option value="text">Text</option>
                                                                <option value="uuid">UUID</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 string-props integer-props">
                                                        <div class="form-group">
                                                            <label>Min</label>
                                                            <input name="field[min][]" type="number" class="form-control form-control-solid" placeholder="Min"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 string-props integer-props">
                                                        <div class="form-group">
                                                            <label>Max</label>
                                                            <input name="field[max][]" type="number" class="form-control form-control-solid" placeholder="Max"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 enum-props">
                                                        <div class="form-group">
                                                            <label>Enum</label>
                                                            <input name="field[enum][]" type="text" class="form-control form-control-solid" placeholder=""/>
                                                            <div class="font-size-sm text-muted mt-1">Use comma as separator.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 default-prop">
                                                        <div class="form-group">
                                                            <label>Default</label>
                                                            <input name="field[default][]" type="text" class="form-control form-control-solid" placeholder="null"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="checkbox-inline">
                                                            <label class="checkbox">
                                                                <input type="hidden" value="true" name="field[nullable][]">
                                                                <input type="checkbox" name="field[nullable_checkbox][]" checked>
                                                                <span></span>
                                                                Nullable
                                                            </label>
                                                            <label class="checkbox">
                                                                <input type="hidden" value="false" name="field[unique][]">
                                                                <input type="checkbox" name="field[unique_checkbox][]">
                                                                <span></span>
                                                                Unique
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button type="button" class="btn btn-light field-delete-button">Delete</button>
                                                        <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#collapseFieldId">Done</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button id="addFieldButton" type="button" class="btn btn-outline-primary btn-block">
                                        New Field
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">Actions</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>Datatables
                                </label>
                            </div>
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>List Option
                                </label>
                            </div>
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>Create
                                </label>
                            </div>
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>Detail
                                </label>
                            </div>
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>Delete
                                </label>
                            </div>
                            <div class="checkbox-inline col-md-3">
                                <label class="checkbox">
                                    <input type="checkbox" checked="checked" name="actions[]">
                                    <span></span>Edit
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary mr-2">Generate</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (() => {
            jQuery(document).ready(() => {
                const fieldTypeChanged = (f, val) => {
                    f.find('[class*="-props"]').hide();
                    f.find(`.${val}-props`).show();
                }

                const initializeField = (f) => {
                    f.show();

                    const defaultName = 'field';
                    f.find('input[name="field[name][]"]').val(defaultName)
                    f.find('input[name="field[name][]"]').on('input', (event) => {
                        f.find('.field-name').text(event.target.value);
                    }).trigger('input');

                    f.find('select[name="field[type][]"]').on('change', (event) => {
                        fieldTypeChanged(f, event.target.value);
                    }).trigger('change');

                    f.find('input[name="field[nullable_checkbox][]"]').on('change', (event) => {
                        f.find('input[name="field[nullable][]').val(event.target.checked);
                    }).trigger('change');

                    f.find('input[name="field[unique_checkbox][]"]').on('change', (event) => {
                        f.find('input[name="field[unique][]').val(event.target.checked);
                    }).trigger('change');

                    f.find('.field-delete-button').on('click', (event) => {
                        f.remove();
                    })
                    return f;
                }

                $('#addFieldButton').click(() => {
                    const id = Date.now().toString();
                    const fieldTemplate = $('#fieldTemplate')
                        .clone()[0]
                        .outerHTML
                        .replaceAll('FieldId', 'Field' + id)
                        .replace('fieldTemplate', 'field' + id);
                    const newField = $.parseHTML(fieldTemplate);

                    initializeField($(newField));

                    $('#accordionFieldList').append(newField);
                    $('#collapseField' + id).collapse('show');
                });
            })
            console.log('---')
        })()
    </script>
@endpush
