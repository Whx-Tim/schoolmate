<?php

namespace App\Http\Controllers\Index;

use App\Events\UserGetMessageList;
use App\Http\Requests\StoreMessageRequest;
use App\Model\Message;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    /**
     * @api {get} message/list/{send_to} 获取消息列表
     * @apiName getMessagesList
     * @apiGroup Message
     *
     * @apiSuccess {Number} id 消息id
     * @apiSuccess {String} content 消息内容
     * @apiSuccess {Number=0,1} readed 已读状态，0：未读，1：已读
     * @apiSuccess {Number} send_to 消息接受用户id
     * @apiSuccess {Number} send_from 消息发送用户id
     * @apiSuccess {Date}   created_at 创建时间/发送时间
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
    public function getList($send_to)
    {
        $messages = Message::getList(Auth::id(), $send_to);
        event(new UserGetMessageList($send_to));

        return $this->ajaxResponse(0, '操作成功', compact('messages'));
    }

    /**
     * @api {post} message/store 发送消息
     * @apiName SendMessage
     * @apiGroup Message
     *
     * @apiParam {String} content 消息内容
     * @apiParam {Number} send_to 消息接受用户id
     *
     * @apiSuccess {Number} id 消息id
     * @apiSuccess {String} content 消息内容
     * @apiSuccess {Number=0,1} readed 已读状态，0：未读，1：已读
     * @apiSuccess {Number} send_to 消息接受用户id
     * @apiSuccess {Number} send_from 消息发送用户id
     * @apiSuccess {Date}   created_at 创建时间/发送时间
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
    public function store(StoreMessageRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $data['send_from'] = Auth::id();
        $message = Message::create($data);

        return $this->ajaxResponse(0, '发送成功', compact('message'));
    }
}
