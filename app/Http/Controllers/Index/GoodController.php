<?php

namespace App\Http\Controllers\Index;

use App\Events\Created;
use App\Http\Requests\StoreGoodRequest;
use App\Http\Requests\StoreReceiptRequest;
use App\Model\Good;
use App\Model\Partime;
use App\Model\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoodController extends Controller
{
    /**
     * @api {get} good/list 获取商品信息列表
     * @apiName getGoodList
     * @apiGroup Good
     *
     * @apiParam {Number} [page] 当前页码
     * @apiParam {String="created_at","updated_at","shopPrice","shopNumber"} [condition] 排序条件
     *
     * @apiSuccess {Number} id 商品id
     * @apiSuccess {String} shopName 商品名称
     * @apiSuccess {String} shopType 商品类型
     * @apiSuccess {Float}  shopPrice 商品价格
     * @apiSuccess {Number} shopNumber 商品数量
     * @apiSuccess {String} shopPicture 商品图片
     * @apiSuccess {String} shopDescription 商品描述
     * @apiSuccess {String} status 商品状态
     * @apiSuccess {Number=1，0} authChoice 是否显示商家信息
     * @apiSuccess {Number} user_id 用户id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     *
     */
    public function getGoodList(Request $request)
    {
//        $goods = $this->getListOrderByDesc(new Good(), $request);
        $goods = Good::where([['shopNumber','>',0],['status',1]])->orderBy('created_at','desc')->paginate();

        return $this->ajaxResponse(0, '操作成功', compact('goods'));
    }

    /**
     * @api {get} good/detail/{good_id} 获取商品详情
     * @apiName getGoodDetail
     * @apiGroup Good
     *
     * @apiSuccess {Number} id 商品id
     * @apiSuccess {String} shopName 商品名称
     * @apiSuccess {String} shopType 商品类型
     * @apiSuccess {Float}  shopPrice 商品价格
     * @apiSuccess {Number} shopNumber 商品数量
     * @apiSuccess {String} shopPicture 商品图片
     * @apiSuccess {String} shopDescription 商品描述
     * @apiSuccess {String} status 商品状态
     * @apiSuccess {Number=1，0} authChoice 是否显示商家信息
     * @apiSuccess {Number} user_id 用户id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "操作成功",
     *         "data": {
     *         }
     *     }
     */
    public function getGood(Good $good)
    {
        $good->view()->increment('count');

        return $this->ajaxResponse(0, '操作成功', compact('good'));
    }

    /**
     * @api {post} good/store 发布商品
     * @apiName storeGood
     * @apiGroup Good
     *
     * @apiParam {String} shopName 商品名称
     * @apiParam {Float}  shopPrice 商品价格
     * @apiParam {Number} shopNumber 商品数量
     * @apiParam {Number} shopType 商品类型
     * @apiParam {String} shopPicture 商品海报图片路径
     * @apiParam {String} [image] 商品图片路径
     * @apiParam {String} [shopDescription] 商品图片路径
     * @apiParam {String} [shopDescription] 商品图片路径
     * @apiParam {Number=1} [authChoice] 是否显示商家信息
     *
     * @apiSuccess {Number} id 商品id
     * @apiSuccess {String} shopName 商品名称
     * @apiSuccess {String} shopType 商品类型
     * @apiSuccess {Float}  shopPrice 商品价格
     * @apiSuccess {Number} shopNumber 商品数量
     * @apiSuccess {String} shopPicture 商品图片
     * @apiSuccess {String} shopDescription 商品描述
     * @apiSuccess {String} status 商品状态
     * @apiSuccess {Number=1，0} authChoice 是否显示商家信息
     * @apiSuccess {Number} user_id 用户id
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发布成功",
     *         "data": {
     *         }
     *     }
    */
    public function storeGood(StoreGoodRequest $request)
    {
        try {
            $good = Auth::user()->goods()->create($request->except(['_token','_method','user_id']));
            event(new Created(Auth::user()->username.'发布了一个商品'));
        } catch (\Exception $exception) {
            Log::info('商品添加异常:' .$exception);

            return $this->ajaxResponse(1, '发布失败');
        }


        return $this->ajaxResponse(0, '发布成功', compact('good'));
    }

    /**
     * @api {post} good/receipt/store 添加收货地址
     * @apiName StoreGoodReceipt
     * @apiGroup Good
     *
     * @apiSuccess {String} consignee 收货人
     * @apiSuccess {String} address 收货地址
     * @apiSuccess {String} phone 收货人电话
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         "errcode": 0,
     *         "errmsg": "发布成功",
     *         "data": {
     *         }
     *     }
     */
    public function storeReceipt(StoreReceiptRequest $request)
    {
        $receipt = Receipt::create($request->except(['_token','_method']));

        return $this->ajaxResponse(0, '保存成功', compact('receipt'));
    }

    public function buyGood(Good $good)
    {
        if ($good->shopNumber > 0) {
            $good->decrement('shopNumber');
        } else {
            return $this->ajaxResponse(1, '商品已卖完');
        }

        return $this->ajaxResponse(0, '购买成功');
    }

    public function searchGood(Request $request)
    {
        $good = Good::orderBy('created_at','desc')->where('status',1);

        if ($request->input('shopName')) {
            $good = $good->where('shopName','like','%'.$request->input('shopName').'%');
        }
        if ($request->input('shopType')) {
            $good = $good->where('shopType',$request->input('shopType'));
        }
        if ($request->input('priceStart')) {
            $good = $good->where('shopPrice','>',$request->input('priceStart'));
        }
        if ($request->input('priceEnd')) {
            $good = $good->where('shopPrice','<',$request->input('priceEnd'));
        }

        $goods = $good->paginate();
//        $goods = Good::where([['shopName','%like%', $request->input('shopName') ? $request->input('shopName'):''],['status',1]])->Where('shopType',$request->input('shopType'))->Where([
//            ['shopPrice','>',$request->input('priceStart')],
//            ['shopPrice','<',$request->input('priceEnd')]
//        ])->paginate($request->get('per_page'));

        return $this->ajaxResponse(0, '获取成功', compact('goods'));
    }

    public function delete(Good $good)
    {
        return $good->delete() ? $this->ajaxResponse(0, '删除成功') : $this->ajaxResponse(1, '删除失败');
    }

    public function down($good)
    {
        return Good::where('id', $good)->update(['status' => 2]) ? $this->ajaxResponse(0, '下架成功') : $this->ajaxResponse(1, '下架失败');
    }

    public function up($good)
    {
        return Good::where('id', $good)->update(['status' => 1]) ? $this->ajaxResponse(0, '上架成功') : $this->ajaxResponse(1, '上架失败');
    }

    public function myGoods(Request $request)
    {
        $goods = Auth::user()->goods()->paginate($request->input('per_page'));

        return $this->ajaxResponse(0, '获取成功', compact('goods'));
    }
}
