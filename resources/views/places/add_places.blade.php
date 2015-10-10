@extends('app')
@section('extraNav')
    <li><a href="#">Add New Category Group</a></li>
    <li><a href="#">Add New Category</a></li>
@endsection
@section('extraStyle')

@endsection
@section('content')

    <h4 style="color:#26a69a"> Admin Page</h4>
    <h5>Insert New Places</h5>
    @if($errors->any())
        <div class="alert error-text">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-sm-12">
            {!! Form::open(array('class'=> 'col s12 m8 l6 offset-m2 offset-l3','method'=>'post')) !!}
            <div class="row">
                <div class="input-field s12">
                    {!! Form::text('place_title','',array('class'=>'place_title')) !!}
                    {!! Form::label('lbl_place_title','Place Title',array('for'=>'place_title','class'  => 'lbl_place_title')) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::textarea('place_desc','',['class'=>'materialize-textarea']    ) !!}
                    {!! Form::label('lbl_place_desc','Place Description',array('for'=>'place_desc','class'  => 'lbl_place_desc')) !!}
                </div>
            </div>
            <div class="row">
                 <div class="input-field s12">
                    {!! Form::text('place_address','') !!}
                    {!! Form::label('lbl_place_address','Place Address',array('for'=>'place_address','class'  => 'lbl_place_address')) !!}
                 </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::text('contact') !!}
                    {!! Form::label('place_contact','Place Contact',array('for'=>'place_contact','class'  => 'lbl_place_contact')) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field m6 s12">
                    {!! Form::text('map_longitude') !!}
                    {!! Form::label('lbl_place_longitude','Place Longitude',array('for'=>'place_longitude','class'  => 'lbl_place_longitude')) !!}
                </div>
                <div class="input-field m6 s12">
                    {!! Form::text('map_latitude') !!}
                    {!! Form::label('lbl_place_latitude','Place Latitude',array('for'=>'place_latitude','class'  => 'lbl_place_latitude')) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::label('lbl_category_group','Select Your Category Group',array('class'=>'browser-select','id'=>'lbl_country_group')) !!}
                    </br>
                    {!! Form::select('category_group_id',$arrCategoryGroup, null ,['class'=>'browser-default','id'=>'category_group']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::label('lbl_category','Select Your Category',array('class' => 'browser-select hide','id'=>'lbl_category')) !!}
                    </br>
                    {!! Form::select('category_id', array("Default"=>""), null,array('class'=>'hide','id'=>'category')) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::label('lbl_state','Select Your State',['class'=>'browser-select','id'  => 'lbl_state_id']) !!}
                    {!! Form::select('state_id', $arrState ,null,['class'=>'browser-default','id'=>'state']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::label('lbl_location','Select Your Location',['class'=>'browser-select','id'  => 'lbl_location_id']) !!}
                    {!! Form::select('location_id', $arrLocation ,null,['class'=>'browser-default','id'=>'location']) !!}
                </div>
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Places's Picture</span>
                    {!! Form::input('file','btn_picture_path',null,['id'=>'picture_path']) !!}
                </div>
                <div class="file-path-wrapper">
                    {!! Form::input('text','picture_path',null,['class'=>'file-path validate']) !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::checkbox('premium_flag', 1 ,false,['class'=>'filled-in','id'=>'premium_flag']) !!}
                    {!! Form::label('premium_flag','Premium ?') !!}
                </div>
            </div>
            <div class="row">
                <div class="input-field s12">
                    {!! Form::button('Insert',array('class' => 'waves-effect waves-light btn','type'=>'submit')) !!}
                </div>
                <input type="hidden" name="admin_id" value="1">
                <input name="country_id" type="hidden" value="60">
            </div>
            {!! Form::close() !!}
        </div>
@endsection

@section('extraScript')
<script type='text/javascript'>
    $(document).ready(function(){
        $('#category_group,#location,#state').material_select();
        $('#category_group').on('change',function(){
            var intCategoryGroupId = $('#category_group').val();
            $.get("/flink/public/ref/category/"+intCategoryGroupId,function (data){
                if(data.length != 0) {
                    $('#category').find('option').remove();
                    $.each(data, function (index, value) {
                        $('#category').append("<option value='" + index + "'>" + value + "</option>");
                    });
                    $('#category,#lbl_category').removeClass('hide').addClass('browser-default').show();
                }
                else{
                    $('#category,#lbl_category').hide();
                }
            });
        });
    });
</script>
@endsection