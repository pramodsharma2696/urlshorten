<?php

namespace App\Http\Controllers;

use App\Repositories\ShortnerRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlShortnerController extends Controller
{
    public function __construct(ShortnerRepositories $shortnerRepositories)
    {
        $this->shortnerRepositories = $shortnerRepositories;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
        if (!$validation->fails()) {
            $data = $this->shortnerRepositories->storedata($request->all());
            if ($data) {
                //session()->flash('success1', 'Url shorten successfully');
                // return response()->json(['success' => true, 'message' =>'Url shorten successfully.','link'=>route('dashboard')], 200);
                return json_encode(['success' => true, 'message' =>'Url shorten successfully.','link'=>route('dashboard')]);
                //return redirect()->route('dashboard');
            } else {
                //session()->flash('error', 'Url could not be shorten becasue you exceeded limit, Upgrade limit.');
                //return redirect()->back();
                return json_encode(['success' => false, 'message' =>'Url could not be shorten becasue you exceeded limit, Upgrade limit.','link'=>route('shorten.view')]);
            }
        } else {
            return back()->withErrors($validation->errors());
        }
    }
    public function redirect($shortened)
    {
        $data = $this->shortnerRepositories->redirect($shortened);
        if ($data) {
            return redirect($data->original_url);
        }
    }
    public function urlUpdate(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
        if (!$validation->fails()) {
            $data = $this->shortnerRepositories->urldataUpdate($request->all(), $id);
            if ($data) {
                return json_encode(['success' => true, 'message' =>'Url updated successfully.','link'=>route('dashboard')]);
               
            } else {
                return json_encode(['success' => false, 'message' =>'Url could not be updated.','link'=>route('shorten.view')]);
            }
        } else {
            return back()->withErrors($validation->errors());
        }

    }
    public function delete($id)
    {
        $data = $this->shortnerRepositories->deleteurl($id);
        if ($data) {
           return json_encode(['success' => true, 'message' =>'Shorten Url deleted successfully!','link'=>route('dashboard')]);
        }else{
            return json_encode(['success' => false, 'message' =>'failed to delete.','link'=>route('dashboard')]);
        }

    }

    public function Deactivate($id)
    {
        $data = $this->shortnerRepositories->deactivateurl($id);
        
        if($data) {
            return json_encode(['success' => true, 'message' =>'Shorten Url deactivated successfully!','link'=>route('dashboard')]);
         }else{
             return json_encode(['success' => false, 'message' =>'failed to deactivate.','link'=>route('dashboard')]);
         }

    }
    public function Activate($id)
    {
        $data = $this->shortnerRepositories->activateurl($id);
        if($data) {
            return json_encode(['success' => true, 'message' =>'Shorten Url activated successfully!','link'=>route('dashboard')]);
         }else{
             return json_encode(['success' => false, 'message' =>'failed to activate.','link'=>route('dashboard')]);
         }

    }

    public function UpgradeUpdate(Request $request)
    {
        $data = $this->shortnerRepositories->upgradeUpdate($request->all());
        if ($data) {
            //session()->flash('success1', 'Url shorten Limit updated to ' . $request->upgrade . ' successfully !');
           // return redirect()->route('dashboard');
           return json_encode(['success' => true, 'message' =>'Url shorten Limit updated to ' . $request->upgrade . ' successfully !','link'=>route('dashboard')]);
        }else{
            return json_encode(['success' => false, 'message' =>'failed to update limit.','link'=>route('dashboard')]);
        }

    }

}
