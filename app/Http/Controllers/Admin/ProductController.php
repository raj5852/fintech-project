<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
use App\Models\Admin\Product;
use App\Models\Admin\Membership;
use Str;
use App\Helpers\Helper;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\User;
use App\Notifications\NewProductNotification;
use App\Notifications\ProductUpdateNotification;
use App\Services\Admin\ProductService;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()
            ->where('pre_order_status', '==', 0)
            ->orWhere('pre_order_status', null)
            ->when(request('search'), function ($query) {
                return $query->where('product_name', 'like', '%' . request('search') . '%');
            })
            ->paginate(10)->withQueryString();

        return view('admin.product.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    function preorders()
    {

        $products = Product::latest()
            ->where('pre_order_status', 1)
            ->with('category')
            ->select('category_id', 'id', 'product_name', 'discount_price', 'pre_order_status', 'minimum_orders', 'thumbnail', 'status')
            ->when(request('search'), function ($query) {
                return $query->where('product_name', 'like', '%' . request('search') . '%');
            })
            ->withCount('orderItems')

            ->paginate(10)->withQueryString();
        return view('admin.product.preorders', compact('products'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands    = Brand::all();
        $meberships  = Membership::all();
        return view('admin.product.create', compact('categories', 'brands', 'meberships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();

        $validated = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'product_code' => 'required|unique:products|max:255',
            'category_id'  => 'required',
            'product_price' => 'required',
            'product_slug' => 'required|unique:products,product_slug'
        ], [
            'product_name.required' => 'The product name field is required.',
            'product_name.unique' => 'The product name is already taken.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'product_code.required' => 'The product code field is required.',
            'product_code.unique' => 'The product code is already taken.',
            'product_code.max' => 'The product code must not exceed 255 characters.',
            'category_id.required' => 'The category field is required.',
            'product_price.required' => 'The product price field is required.',
            'product_slug.required' => 'The product slug field is required.',
            'product_slug.unique' => 'The product slug is already taken.',
        ]);


        $product =   $data = new Product();
        $data->product_name       = $request->product_name;
        $data->product_slug       = Str::slug($request->product_slug);
        $data->product_code       = $request->product_code;
        // $data->product_title      = $request->product_title;
        $data->product_short_desc = $request->product_short_desc;
        $data->product_price      = $request->product_price;
        $data->category_id        = $request->category_id;
        $data->subcategory_id     = $request->subcategory_id;
        $data->brand_id           = $request->brand_id;
        $data->specification      = json_encode($request->specification);
        $data->specification_ans  = json_encode($request->specification_ans);
        $data->description        = $request->description;
        $data->tag                = $request->tag;
        $data->buying_price       = $request->buying_price;
        // $data->membership_id      = $request->membership_id;
        $data->membership_id  = json_encode($request->membership_id);
        $data->visibility         = $request->visibility;
        $data->is_free            = $request->is_free;
        $data->pre_order_status = $request->preorder;
        $data->minimum_orders = $request->minimum_orders;
        $data->product_url            =  array_combine($request->product_url, $request->product_version);
        if ($request->commission_rate != null) {
            if ($request->commission_type != null) {
                $data->commissions = array_combine($request->commission_type, $request->commission_rate);
            }
        }
        $data->is_link_updated = CURRENT_TIME();


        $data->discount_price            = $request->discount_price;
        $data->status            = $request->status ?? 1;

        //----Discount-----
        $p_price = $data->product_price;
        $d_rate  = $request->discount_rate;
        $d_type  = $request->discount_type;
        $data->discount_type    = $request->discount_type;
        $data->discount_rate    = $request->discount_rate;
        $data->discount_price   = Helper::discount($p_price, $d_rate, $d_type);
        //-----/Discount------


        $thumbnail = $request->thumbnail;
        if ($thumbnail) {
            $data->thumbnail = Helper::upload_image($thumbnail,  200, 200);
        }

        $images = array();
        if ($request->images) {
            foreach ($request->images as $key => $image) {

                array_push($images, Helper::upload_image($image,  310, 272));
            }
            $data->images = json_encode($images);
        }

        $data->save();
        $data->memberships()->attach($request->memberships);

        $notification = array(
            'messege' => 'Successfully Created !',
            'alert-type' => 'success'
        );


        // $product = Product::first();
        if ($data->pre_order_status != 1) {
            ProductService::membershipNotification($product);
        }



        if ($data->pre_order_status == 1) {
            return \to_route('product.preorders')->with($notification);
        }
        return \to_route('index.product')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return   $data         = Product::find($id);
        $more_image   = json_decode($data->images, true);
        $specification = json_decode($data->specification, true);
        $tag          = explode(',', $data->tag);
        return view('admin.product.view', compact('data', 'more_image', 'specification', 'tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data          = Product::find($id);


        $more_image    = json_decode($data->images, true);
        $categories    = Category::all();
        $sub_categories = SubCategory::all();
        $brands        = Brand::all();
        $meberships      = Membership::all();
        return view('admin.product.edit', compact('data', 'categories', 'brands', 'sub_categories', 'more_image', 'meberships'));
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
        $validated = $request->validate([
            'product_name' => 'required|unique:products,product_name,' . $id,
            'product_code' => 'required|unique:products,product_code,' . $id,
            'category_id'  => 'required',
            'product_price' => 'required',
            'product_slug' => [
                'required',
                Rule::unique('products', 'product_slug')->ignore($id),
            ],
        ], [
            'product_name.required' => 'The product name field is required.',
            'product_name.unique' => 'The product name is already taken.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'product_code.required' => 'The product code field is required.',
            'product_code.unique' => 'The product code is already taken.',
            'product_code.max' => 'The product code must not exceed 255 characters.',
            'category_id.required' => 'The category field is required.',
            'product_price.required' => 'The product price field is required.',
            'product_slug.required' => 'The product slug field is required.',
            'product_slug.unique' => 'The product slug is already taken.',
        ]);




        $product =    $data = Product::find($id);

        $is_link_updated = 0;
        $Request_linkcount = count($request->product_url);
        $product_linkCount = count(array_keys($data->product_url));


        if ($Request_linkcount > $product_linkCount) {
            $is_link_updated = 1;
            $data->is_link_updated  = CURRENT_TIME();
        }


        $data->product_name       = $request->product_name;
        $data->product_slug       = Str::slug($request->product_slug);
        $data->product_code       = $request->product_code;
        // $data->product_title      = $request->product_title;
        $data->product_short_desc = $request->product_short_desc;
        $data->product_price      = $request->product_price;
        $data->category_id        = $request->category_id;
        $data->subcategory_id     = $request->subcategory_id;
        $data->brand_id           = $request->brand_id;
        $data->specification      = json_encode($request->specification);
        $data->specification_ans  = json_encode($request->specification_ans);
        $data->membership_id  = json_encode($request->membership_id);
        $data->description        = $request->description;
        $data->tag                = $request->tag;
        $data->pre_order_status = $request->preorder;
        $data->minimum_orders = $request->minimum_orders;
        $data->product_url            = array_combine($request->product_url, $request->product_version);

        if ($request->commission_rate != null) {
            if ($request->commission_type != null) {
                $data->commissions = array_combine($request->commission_type, $request->commission_rate);
            }
        }

        //----Discount-----
        $p_price = $data->product_price;
        $d_rate  = $request->discount_rate;
        $d_type  = $request->discount_type;
        $data->discount_type    = $request->discount_type;
        $data->discount_rate    = $request->discount_rate;
        $data->discount_price   = Helper::discount($p_price, $d_rate, $d_type);
        //-----/Discount------

        // $data->membership_id    = $request->membership_id;
        $data->visibility       = $request->visibility;
        $data->is_free          = $request->is_free;

        $thumbnail = $request->thumbnail;
        if ($thumbnail) {
            $data->thumbnail = Helper::upload_image($thumbnail,  310, 272);
        }

        $old_images = $request->has('old_images');
        if ($old_images) {
            $images = $request->old_images;
            $data->images = json_encode($images);
        } else {
            $images = array();
            $data->images = json_encode($images);
        }

        // $images = array();
        if ($request->images) {
            foreach ($request->images as $key => $image) {

                array_push($images, Helper::upload_image($image,  310, 272));
            }
            $data->images = json_encode($images);
        }

        $data->save();
        $data->memberships()->sync($request->memberships);
        // return $product;
        $notification = array(
            'messege' => 'Successfully Update !',
            'alert-type' => 'success'
        );

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->format('Y-m-d');

        if ($data->pre_order_status == 0 && $data->minimum_orders != 0) {
            ProductService::membershipNotification($product);

            $data->minimum_orders = 0;
            $data->save();
        }



        if ($is_link_updated == 1 && $data->status == 1 && $data->pre_order_status == 0) {
            ProductService::editProductNotification($product);
        }



        return \to_route('index.product')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);

        if (File::exists($data->thumbnail)) {

            File::delete($data->thumbnail);
        }

        $images = json_decode($data->images, true);

        if ($images > 0) {
            foreach ($images as $key => $ims) {
                File::delete($ims);
            }
        }
        $data->delete();
        $notification = array(
            'messege' => 'Successfully Deleted !',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }



    /**
     * Get Categorywise Subcategory
     *
     * @param int $cat_id
     *
     */

    public function getSubcategory($cat_id)
    {
        $data = SubCategory::where('category_id', $cat_id)->get();
        return response()->json($data);
    }

    public function ImageDelete()
    {
        $data = Product::first();
        $data->delete();
        return back();
    }

    function stausChange($productId, $statusId)
    {
        $product = Product::findOrFail($productId);
        if ($product) {
            $product->status = $statusId;

            if ($product->status == 0) {
                $product->is_link_updated = \CURRENT_TIME();
            }

            $product->save();

            return \redirect()->back()->with('success', 'Status Updated Successfully!');
        }
    }
}
