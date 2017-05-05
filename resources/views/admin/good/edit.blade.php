@extends('layouts.admin')

@section('admin.title', '编辑商品')

@section('breadcrumb')
    <li><a href="{{ $good->homeUrl() }}">商品管理</a></li>
    <li class="active">编辑商品</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>商品图片</label>
                <img src="{{ $good->shopPicture }}" alt="" style="width: 100%;">
                <div id="dropzone" class="dropzone"></div>
            </div>
            <form>
                <div class="form-group">
                    <label>商品名称</label><input type="text" name="shopName" class="form-control" value="{{ $good->shopName }}">
                </div>
                <div class="form-group">
                    <label>商品价格</label><input type="text" name="shopPrice" class="form-control" value="{{ $good->shopPrice }}">
                </div>
                <div class="form-group">
                    <label>商品数量</label><input type="text" name="shopNumber" class="form-control" value="{{ $good->shopNumber }}">
                </div>
                <div class="form-group">
                    <label>商品类型</label>
                    <select name="shopType" class="form-control">
                        <option value="1" {{ $good->shopType==1 ? 'selected':'' }}>1</option>
                        <option value="2" {{ $good->shopType==2 ? 'selected':'' }}>2</option>
                        <option value="3" {{ $good->shopType==3 ? 'selected':'' }}>3</option>
                        <option value="4" {{ $good->shopType==4 ? 'selected':'' }}>4</option>
                        <option value="5" {{ $good->shopType==5 ? 'selected':'' }}>5</option>
                        <option value="6" {{ $good->shopType==6 ? 'selected':'' }}>6</option>
                        <option value="7" {{ $good->shopType==7 ? 'selected':'' }}>7</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>状态</label>
                    <select name="status" class="form-control">
                        <option value="0" {{ $good->status==0 ? 'selected' : '' }}>未审核</option>
                        <option value="1" {{ $good->status==1 ? 'selected' : '' }}>已审核</option>
                        <option value="2" {{ $good->status==2 ? 'selected' : '' }}>已关闭</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>商品描述</label>
                    <textarea name="shopDescription" class="summernote">{{ $good->shopDescription }}</textarea>
                </div>
                <input type="hidden" name="shopPicture" value="{{ $good->shopPicture }}">
                <a href="{{ $good->editUrl() }}" class="btn btn-primary btn-block" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection