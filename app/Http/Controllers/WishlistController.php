<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Web\Wishlist;

class WishlistController extends Controller{
    public function addWishlist($id){
        $user_id = Auth::id();
        $check = Wishlist::where('user_id',$user_id)->where('product_id',$id)->first();

        if (Auth::check()) {
            if ($check) {
                return \Response::json(['error' => 'Product Already Has On Your Wishlist']);
            }else {
                $wishlist = new Wishlist();
                $wishlist->user_id = $user_id;
                $wishlist->product_id = $id;
                $wishlist->save();
                return \Response::json(['success' => 'Product Added On Wishlist']);

            }
        }else {
            return \Response::json(['error' => 'At First Login Your Account']);
        }
    }
}
