{{'@'}}extends('brackets/admin::admin.layout.form')

{{'@'}}section('body')

    <div class="container-xl">

        <div class="card">

            <{{ $modelRouteAndViewName }}-form
                :action="'{{'{{'}} url('admin/{{ $modelRouteAndViewName }}/store') }}'"
                inline-template>

                <form class="form-horizontal" method="post" @submit.prevent="onSubmit" :action="this.action">

                    <div class="card-header">
                        <i class="fa fa-plus"></i> New {{ $modelBaseName }}
                    </div>

                    <div class="card-block">

                        @foreach($columns as $col)
                            @if($col['type'] == 'date')

                                <div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="YYYY-MM-DD">
                                        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                    </div>
                                </div>
                            @elseif($col['type'] == 'time')

                                <div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="hh:mm:ss">
                                        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                    </div>
                                </div>
                            @elseif($col['type'] == 'datetime')

                                <div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                                    <div class="col-sm-6">
                                        <input type="text" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="YYYY-MM-DD hh:mm:ss">
                                        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                    </div>
                                </div>
                            @elseif($col['type'] == 'text')

                                <div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                                    <div class="col-md-9 col-xl-8">
                                        <textarea v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }" rows="3" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="Lorem ipsum dolor itum.."></textarea>
                                        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                    </div>
                                </div>
                            @elseif($col['type'] == 'boolean')

                                <div class="form-check row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <div class="col-md-9 col-xl-8 offset-md-3">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" name="{{ $col['name'] }}" value="1">
                                            {{ ucfirst($col['name']) }}?
                                            <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                        </label>
                                    </div>
                                </div>
                            @else

                                <div class="form-group row" :class="{'has-danger': errors.has('{{ $col['name'] }}'), 'has-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid }">
                                    <label for="{{ $col['name'] }}" class="col-md-3 col-form-label text-md-right">{{ ucfirst($col['name']) }}</label>
                                    <div class="col-md-9 col-xl-8">
                                        <input type="text" v-model="form.{{ $col['name'] }}" v-validate="'{{ implode('|', $col['frontendRules']) }}'" class="form-control" :class="{'form-control-danger': errors.has('{{ $col['name'] }}'), 'form-control-success': this.fields.{{ $col['name'] }} && this.fields.{{ $col['name'] }}.valid}" id="{{ $col['name'] }}" name="{{ $col['name'] }}" placeholder="{{ ucfirst($col['name']) }}">
                                        <div v-if="errors.has('{{ $col['name'] }}')" class="form-control-feedback" v-cloak>{{'@{{'}} errors.first('{{ $col['name'] }}') }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{'{{'}} csrf_field() }}

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </{{ $modelRouteAndViewName }}-form>

        </div>

    </div>

{{'@'}}endsection