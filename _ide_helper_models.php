<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Model{
/**
 * App\Model\Active
 *
 * @property int $id
 * @property string $name 活动名称
 * @property string $time 活动时间
 * @property string $address 活动地址
 * @property string $lnt 经度
 * @property string $lat 纬度
 * @property string $poster 活动海报图片
 * @property string $images 活动图片
 * @property int $count 参与人数
 * @property string $phone 联系人电话
 * @property string $description 活动描述
 * @property bool $status 活动状态
 * @property int $person 人数限制
 * @property float $money 报名金额
 * @property int $user_id 用户表外键
 * @property string $condition 邀请条件
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereCondition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereImages($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereLnt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active wherePerson($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active wherePoster($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Active whereUserId($value)
 */
	class Active extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\ActiveApply
 *
 * @property int $id
 * @property int $user_id 用户id，外键
 * @property int $active_id 活动id，外键
 * @property bool $status 申请状态
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereActiveId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ActiveApply whereUserId($value)
 */
	class ActiveApply extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Announcement
 *
 * @property int $id
 * @property string $title 公告标题
 * @property string $content 公告内容
 * @property int $announcement_id
 * @property string $announcement_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereAnnouncementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereAnnouncementType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Announcement whereUpdatedAt($value)
 */
	class Announcement extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Collection
 *
 * @property int $id
 * @property int $user_id 用户id，外键
 * @property int $collect_id
 * @property string $collect_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereCollectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereCollectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Collection whereUserId($value)
 */
	class Collection extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Course
 *
 * @property int $id
 * @property int $number 课程号
 * @property string $name 课程名称
 * @property string $teacher 主讲教师
 * @property int $user_id 用户id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereTeacher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Course whereUserId($value)
 */
	class Course extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\CourseGroup
 *
 * @property int $id
 * @property int $user_id 用户id，外键
 * @property int $course_id 课程id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereCourseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CourseGroup whereUserId($value)
 */
	class CourseGroup extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Good
 *
 * @property int $id
 * @property string $name 商品名称
 * @property bool $type 商品类型
 * @property float $money 商品价格
 * @property int $amount 商品数量
 * @property string $image 商品图片路径
 * @property string $poster 商品海报图片路径
 * @property string $description 商品描述
 * @property int $user_id 用户Id,外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good wherePoster($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Good whereUserId($value)
 */
	class Good extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\League
 *
 * @property int $id
 * @property string $name 社团名称
 * @property int $amount 限制人数
 * @property string $introduction 社团介绍
 * @property bool $type 社团类型
 * @property int $user_id 用户id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereIntroduction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\League whereUserId($value)
 */
	class League extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\LeagueGroup
 *
 * @property int $id
 * @property int $user_id 用户id，外键
 * @property int $league_id 社团id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereLeagueId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\LeagueGroup whereUserId($value)
 */
	class LeagueGroup extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Message
 *
 * @property int $id
 * @property string $content 聊天内容
 * @property bool $readed 是否已读
 * @property int $send_to 消息对象，外键
 * @property int $send_from 消息来源, 外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereReaded($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereSendFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereSendTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Order
 *
 * @property int $id
 * @property bool $pay_method 支付方式
 * @property bool $status 订单状态
 * @property float $total_money 订单总金额
 * @property float $postage 运费
 * @property int $receipt_id 收货id，外键
 * @property int $payment_id 付款id，外键
 * @property string $clinch_at 成交时间
 * @property string $send_at 发货时间
 * @property string $pay_at 付款时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereClinchAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePayAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePayMethod($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePaymentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePostage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereReceiptId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereSendAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereTotalMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Partime
 *
 * @property int $id
 * @property string $company_name 公司名称
 * @property string $address 办公地点
 * @property string $phone 公司电话
 * @property string $email 公司邮箱
 * @property string $salary 薪资
 * @property bool $job_time 工作时间
 * @property string $company_type 公司类型
 * @property string $description 兼职招聘描述
 * @property string $duration 工作最少时长
 * @property string $education 学历要求
 * @property bool $amount 招聘人数
 * @property string $end_time 截止时间
 * @property int $user_id 用户id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereCompanyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereCompanyType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereEducation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereJobTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereSalary($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Partime whereUserId($value)
 */
	class Partime extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Payment
 *
 * @property int $id
 * @property int $form_id 付款用户id，外键
 * @property int $to_id 收款用户id，外键
 * @property float $money 付款金额
 * @property int $transaction_id 交易号
 * @property bool $status 付款状态
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereFormId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereToId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\Receipt
 *
 * @property int $id
 * @property string $consignee 收货人
 * @property string $address 收货地址
 * @property string $phone 收货人电话
 * @property int $user_id 用户id，外键
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereConsignee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Receipt whereUserId($value)
 */
	class Receipt extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\UserInfo
 *
 * @property int $id
 * @property string $name 昵称
 * @property string $realname 真实姓名
 * @property int $student_id 学号
 * @property string $college 学院
 * @property string $grade 年级
 * @property bool $gender 性别
 * @property string $phone 联系电话
 * @property string $wx_openid 微信openid
 * @property string $wx_head_img 微信头像路径
 * @property string $wx_nickname 微信昵称
 * @property string $birthday 生日
 * @property int $user_id 用户外键
 * @property bool $is_certified 认证状态
 * @property bool $adminset 管理员标识
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereAdminset($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereCollege($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereGrade($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereIsCertified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereRealname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereWxHeadImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereWxNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\UserInfo whereWxOpenid($value)
 */
	class UserInfo extends \Eloquent {}
}

namespace App\Model{
/**
 * App\Model\View
 *
 * @property int $id
 * @property int $count 访问量
 * @property int $view_id
 * @property string $view_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereViewId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\View whereViewType($value)
 */
	class View extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Active[] $actives
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Active[] $applyActives
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Course[] $applyCourses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Course[] $courses
 * @property-read \App\Model\UserInfo $info
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

