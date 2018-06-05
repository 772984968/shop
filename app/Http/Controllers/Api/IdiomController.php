<?php

namespace App\Http\Controllers\Api;


use App\Models\Idiom;
use Illuminate\Http\Request;


class IdiomController extends AuthController
{
    public function __construct()
    {

    }

    public function details(Request $request)
    {
        $this->checkValidate($request
            ,['idiom_id'=>'required'
            ]);
        $rs=Idiom::find($request->input('idiom_id'));
        if ($rs){
            $rs->antonym=explode(',',$rs->antonym);
            $rs->thesaurus=explode(',',$rs->thesaurus);
            return $this->arrayResponse('success','200',$rs);
        }else{
            return $this->response()->errorNotFound();
        }
    }
   }
