<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\WishList;
// use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {


        $data = WishList::join('products','wish_lists.product_id','products.id')
                        ->select('wish_lists.id','products.product_name','products.thumbnail','products.product_title','products.product_price','products.discount_rate','products.discount_price')
                        ->where('user_id',Auth::id())->get();
        return view('user.wish_list.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $userId =Auth::id();
        $check = WishList::where('user_id',$userId)->where('product_id',$id)->first();
        $data = array(
                    'user_id' =>$userId,
                    'product_id' =>$id
                );
        if(Auth::check()){
            if($check){
                return \Response::json(['error' => '<h3>Already has your wishlist!</h3>']);
            }else{
                DB::table('wish_lists')->insert($data);
                return \Response::json(['success' => '<h3>Product adds on your wishlist!</h3>']);
            }
        }else{
             return \Response::json(['errorMsg' => 'Please Login Your Account']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {



        // $data = App\Models\User\WishList::join('products','wish_lists.product_id','products.id')
        // ->select('products.*','wish_lists.id','wish_lists.product_id')->where('user_id',Auth::id())->get();
        $data = WishList::join('products','wish_lists.product_id','products.id')
                        ->select('wish_lists.id','products.product_name','products.thumbnail','products.product_title','products.product_price','products.discount_rate','products.discount_price')
                        ->where('user_id',Auth::id())->limit(4)->get();
        return view('user.wish_list.wish_list',compact('data'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wishCount()
    {
        $data =WishList::where('user_id',Auth::id())->count();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WishList::find($id)->where('user_id',auth()->user()->id)->delete();
        $notification = array(
            'messege'=>'Successfully Deleted!',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function view()
    {
        echo"DOne";
    }
    public function deleteWishItem($id) {
        Wishlist::where('user_id', Auth::id())
        ->where('product_id', $id)
        ->delete();
        return back();
    }
}
