@extends('layouts.admin')

@section('admin.title', '添加商品')

@section('breadcrumb')
    <li><a href="{{ url('admin/good') }}">商品管理</a></li>
    <li class="active">添加商品</li>
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>商品图片</label>
                <img src="" alt="" style="width: 100%;">
                <div id="dropzone" class="dropzone"></div>
            </div>
            <form>
                <div class="form-group">
                    <label>商品名称</label><input type="text" name="shopName" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>商品价格</label><input type="text" name="shopPrice" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>商品数量</label><input type="text" name="shopNumber" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>商品类型</label>
                    <select name="shopType" class="form-control">
                        <option value="1" >衣服</option>
                        <option value="2" >商品</option>
                        <option value="3" >医药</option>
                        <option value="4" >水果</option>
                        <option value="5" >零食</option>
                        <option value="6" >家具</option>
                        <option value="7" >书籍</option>
                        <option value="8" >瓷器</option>
                        <option value="9" >电器</option>
                        <option value="10" >其他</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>状态</label>
                    <select name="status" class="form-control">
                        <option value="0" >未审核</option>
                        <option value="1" >已上架</option>
                        <option value="2" >已下架</option>
                        <option value="3" >已关闭</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>商品描述</label>
                    <textarea name="shopDescription" class="summernote"></textarea>
                </div>
                <input type="hidden" name="shopPicture" value="">
                <a href="{{ url('admin/good/store') }}" class="btn btn-primary btn-block" id="update-btn">更新</a>
            </form>
        </div>
    </div>
@endsection