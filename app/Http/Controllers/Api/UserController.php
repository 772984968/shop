<?php

namespace App\Http\Controllers\Api;

use App\Models\Idiom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use function MongoDB\BSON\toJSON;
use EasyWeChat;

class UserController extends AuthController
{
    public function __construct()
    {
        return parent::__construct();
    }

    //绑定微信信息
    public function setInfo(Request $request){
        $user=auth('api')->user();
        $this->checkValidate($request,
            [
                'nickName'=>'required',
            ]);
        if ($request->has('nickName')){
            $user->name=$request->input('nickName');
        }
        if ($request->has('phone')){
            $user->phone=$request->input('phone');
        }
        if ($user->save()){
            return $this->arrayResponse();
        }
        return $this->response()->errorInternal('系统错误，请重试');
    }

    //个人中心
    public function personal()
    {
        $user = auth('api')->user();
        return $this->arrayResponse('success', '200', $user);
    }

    //用户首页
    public function index()
    {
        return $this->arrayResponse();
    }

    //用户登陆
    public function login(Request $request)
    {

        return parent::login($request);
    }

    //用户退出
    public function logout()
    {
        return parent::logout();


    }

    //刷新令牌
    public function refresh()
    {
        return parent::refresh();
    }

    //小程序登陆
    public function weappStore(Request $request){
        $rs=$this->checkValidate($request,
            [
                'code'=>'required|string',
            ]);
        // 根据 code 获取微信 openid 和 session_key
       $miniProgram = EasyWeChat::miniProgram();
       $data = $miniProgram->auth->session($rs['code']);
     //  $data['openid']='othXi5PiFWC3ZNolCkSCUgkZCQy';
  //   $data['session_key']='6kAO6sfsgoGU0MjBxsah8A==';

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }
        // 找到 openid 对应的用户
        $user = User::where('weapp_openid', $data['openid'])->first();
        $attributes['weixin_session_key'] = $data['session_key'];
        if (!$user){
            $attributes['weapp_openid'] = $data['openid'];
            $user=User::create($attributes);
        }else{
            $user->update($attributes);
        }
        //更新用户信息
        $token=auth('api')->login($user);
        // 为对应用户创建 JWT
        return $this->respondWithToken($token);
        }
    //刷新数据
    public function idiom(Request $request)
    {
        $rs = DB::table('idioms')->offset($request->offset)->limit($request->limit)->select('id', 'name')->get();
        $client = new Client();
        foreach ($rs as $vo) {

            $res = $client->request('POST', 'http://api.jisuapi.com/chengyu/detail', [
                'form_params' => [
                    'appkey' => '52cde2b299a25128',
                    'chengyu' => $vo->name,
                ]
            ]);

            $rs = json_decode($body = $res->getBody());
            $antonym = [];
            $thesaurus = [];
            if (!empty($rs->result->antonym)) {
                $antonym = $rs->result->antonym;
            }
            if (!empty($rs->result->thesaurus)) {
                $thesaurus = $rs->result->thesaurus;
            }
            $res = DB::table('idioms')->where('id', $vo->id)->update(['antonym' => implode(',', $antonym), 'thesaurus' => implode(',', $thesaurus)]);
        }
    }

}
