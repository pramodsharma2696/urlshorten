<?php
namespace App\Repositories;

use App\Models\Url;
use App\Models\Attempt;
use Illuminate\Support\Str;
use App\Models\AttemptCount;
use Illuminate\Support\Facades\Auth;

class ShortnerRepositories{

    public function storedata($request)
    {
            $attempt = Attempt::first();
            $attempt_count = AttemptCount::where('user_id', Auth::user()->id)->first();
            if(!empty($attempt_count)){
            if($attempt_count->count <= $attempt->attempt_allowed){
                $urlobject = new Url;
                $urlobject->original_url = $request['url'];
                $randomStr = Str::random(6);
                $urlobject->shorten_url = md5($request['url'].$randomStr);
                $urlobject->user_id = Auth::user()->id;
                $urlobject->save(); 
                if (!$attempt_count) {
                    $attempt_count = new AttemptCount;
                    $attempt_count->user_id = $request->user()->id;
                    $attempt_count->count = 1;
                }
                else {
                     // Otherwise, update the existing record
                    $attempt_count->count += 1;
                }
                $attempt_count->save();
                return $urlobject;
            }else{
                return false;
            }
          }else{
                $urlobject = new Url;
                $urlobject->original_url = $request['url'];
                $randomStr = Str::random(6);
                $urlobject->shorten_url = md5($request['url'].$randomStr);
                $urlobject->user_id = Auth::user()->id;
                $urlobject->save();
                $attempt_count = new AttemptCount;
                $attempt_count->user_id = Auth::user()->id;
                $attempt_count->count = 1;
                $attempt_count->save();
                return $attempt_count;
               // return response()->json(['success' => true, 'message' =>'Url shorten successfully.']);
          }
        
    }

    public function redirect($shortened)
    {
        $url = Url::where('shorten_url', $shortened)->firstOrFail();
        return $url;
        
    }
    public function urldataUpdate($request, $id)
    {
        $updateurl = Url::find($id);
        $updateurl->original_url = $request['url'];
        $randomStr = Str::random(6);
        $updateurl->shorten_url = md5($request['url'].$randomStr);
        $updateurl->save();
        return $updateurl;
        
    }
    public function deleteurl($id){
        $url = Url::find($id);
        $url->delete();
        return $url;
    }
    public function deactivateurl($id){
        $url = Url::find($id);
        $url->status = 1;
        $url->save();
        return $url;
    }
    public function activateurl($id){
        $url = Url::find($id);
        $url->status = 0;
        $url->save();
        return $url;
    }
    public function upgradeUpdate($request){
        $upgrade = Attempt::where('user_id',Auth::user()->id)->first();
        $upgrade->attempt_allowed = $request['upgrade'];
        $upgrade->save();
        return $upgrade;
    }
}