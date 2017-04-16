<?php

namespace App\Http\Controllers\Index;

use App\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
