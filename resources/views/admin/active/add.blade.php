@extends('layouts.admin')

@section('admin.title', '添加活动')

@section('breadcrumb')
    <li><a href="{{ url('admin/active') }}">活动管理</a></li>
    <li class="active">添加活动</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>活动封面图片</label>
                <img src="" alt="" style="width: 100%;">
                <div id="dropzone" class="dropzone"></div>
            </div>
            <form>
                <div class="form-group">
                    <label>活动名称</label>
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="form-group">
                    <label>活动时间</label>
                    <input type="text" class="form-control" name="time" value="">
                </div>
                <div class="form-group">
                    <label>活动地址</label>
                    <input type="text" class="form-control" name="address" value="">
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div id="map" style="width: 100%;height: 430px"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>联系人电话</label>
                    <input type="text" class="form-control" name="phone" value="">
                </div>
                <div class="form-group">
                    <label>限制人数</label>
                    <input type="text" class="form-control" name="person" value="">
                </div>
                <div class="form-group">
                    <label>活动状态</label>
                    <select name="status" class="form-control">
                        <option value="0" >未审核</option>
                        <option value="1" >已审核</option>
                        <option value="2" >已关闭</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>活动描述</label>
                    <textarea id="summernote" name="description" class="summernote"></textarea></div>
                <input type="hidden" name="poster" value="">
                <input type="hidden" name="lng" value="">
                <input type="hidden" name="lat" value="">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <a href="{{ url('admin/active/store') }}" class="btn btn-block btn-primary" id="add-btn">添加</a>
            </form>
        </div>
    </div>
@endsection

@push('admin.scripts')
<script>
    var map = new BMap.Map('map');
    var myGeo = new BMap.Geocoder();
    map.centerAndZoom("深圳",15);
    var top_left_control = new BMap.NavigationControl({
        anchor: BMAP_ANCHOR_TOP_LEFT,
        type: BMAP_NAVIGATION_CONTROL_SMALL
    });
    map.addControl(top_left_control);
    $('[name=address]').change(function () {
        var address = $(this).val();
        myGeo.getPoint(address, function (point) {
            if (point) {
                $('[name=lat]').val(point.lat);
                $('[name=lng]').val(point.lng);
                map.centerAndZoom(point,20);
                var marker = new BMap.Marker(point);
                map.addOverlay(marker);
                marker.enableDragging();
                marker.addEventListener("dragend", function () {
                    var point = marker.getPosition();
                    $('[name=lat]').val(point.lat);
                    $('[name=lng]').val(point.lng);
                })
            } else {
                alert("error");
            }
        },'深圳市');
        map.clearOverlays();
    });
</script>
@endpush