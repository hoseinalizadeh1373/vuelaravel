<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at','desc')->get();
    }

    public function store(Request $request)
    {
        $newitem = new Item;
        $newitem->title = $request->title;
        $newitem->save();

        return $newitem;
    }
    public function update(Request $request,$id)
    {
        $existingItem = Item::find($id);

        if($existingItem){
            $existingItem->completed = $request->completed ? true : false;
            $existingItem->updated_at = Carbon::now();
            $existingItem->save();
            return $existingItem;
        }
        return 'not found';
    }
    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
            $existingItem->delete();
            return 'deleted';
        }
        return 'not found';
    }
}
