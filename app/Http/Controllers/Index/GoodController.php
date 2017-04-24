<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\StoreGoodRequest;
use App\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $goods = $this->getListOrderByDesc(new Good(), $request);

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
            $good = Good::create($request->except(['_token','_method']));
        } catch (\Exception $exception) {
            Log::info('商品添加异常:' .$exception);

            return $this->ajaxResponse(1, '发布失败');
        }


        return $this->ajaxResponse(0, '发布成功', compact('good'));
    }



}
