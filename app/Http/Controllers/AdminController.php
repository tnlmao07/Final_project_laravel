<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Contact;
use App\Models\CMS;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /* ----------- Code for Displaying users in the database---------------------------*/
    public function displayUsers(){
        $users=User::all();
        $roles=Role::all();
        $data= compact('users','roles');
        return view('dashboard')->with($data);
    }
    /* ----------- Code for Displaying the form for insertion of users by admin--------------------------*/
    public function addUsersForm(){  
        $url=url('/add-user');
        $updateToken=false;
        $title= "Add User";
        $roles=Role::all();
        $data=compact('url','title','roles','updateToken');
        
        return view('add-user')->with($data);
    }
    /* ----------- Code for  User insertion---------------------------*/
    public function addUsersFormPost(Request $request){  
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required',
                'password'=>'required'
            ]
        );
        $users=new User;
        $users->name =$request['name'];
        $users->email =$request['email'];
        $users->password =Hash::make($request['password']) ;
        $users->role_id =$request['role'];
        $users->save();
        return redirect('dashboard');
    }
    /* ----------- Code for User deletion ---------------------------*/
     public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->back();
    }
    /* ----------- Code for asset type updation form ---------------------------*/
    public function editUser($id){
        $user=User::find($id);
        $roles=Role::all();
        if(is_null($user)){
            return redirect()->back();
        }else{
            $url=url('user-management/update')."/".$id;
            $title="Update User Details";
            $updateToken=true;
            $data=compact('user','url','title','roles','updateToken');
            return view('add-user')->with($data);
        }
    }
    /* ----------- Code for Asset type updation ---------------------------*/
    public function updateUser($id,Request $request){
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required',
                'password'=>'required'
            ]
        );
        $user=User::find($id);
        $user->name =$request['name'];
        $user->email =$request['email'];
        $user->password =$request['password'] ;
        $user->role_id =$request['role'];        
        $user->save();
        return redirect('dashboard');
    }
    /* ----------- Code for Displaying Categories in the database---------------------------*/
    public function displayCategory(){
        $categories=Category::all();
        $data= compact('categories');
        return view('category')->with($data);
    }
    /* Code for displaying the category form */
    public function addCategoryForm(){  
        $url=url('/add-category');
        $updateToken=false;
        $title= "Add Category";
        $categories=Category::all();
        $data=compact('url','title','categories','updateToken');
        
        return view('add-category')->with($data);
    }
    /* ----------- Code for  User insertion---------------------------*/
    public function addCategoryFormPost(Request $request){  
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
        );
        $category=new Category;
        $category->name =$request['name'];
        $category->description =$request['description'];
        $category->save();
        return redirect('category');
    }
    /* ----------- Code for Category deletion ---------------------------*/
    public function deleteCategory($id){
        Category::find($id)->delete();
        return redirect()->back();
    }
    /* ----------- Code for Category updation form ---------------------------*/
    public function editCategory($id){
        $category=Category::find($id);
        if(is_null($category)){
            return redirect()->back();
        }else{
            $url=url('category/update')."/".$id;
            $title="Update Category Details";
            $updateToken=true;
            $data=compact('category','url','title','updateToken');
            return view('add-category')->with($data);
        }
    }
    /* ----------- Code for Category updation ---------------------------*/
    public function updateCategory($id,Request $request){
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
        );
        $category=Category::find($id);
        $category->name =$request['name'];
        $category->description =$request['description'];      
        $category->save();
        return redirect('category');
    }
 /* --------------------------Banner Management -------------------------------------------------------------------- */


    /* ----------- Code for Displaying banners in the database---------------------------*/
    public function displayBanner(){
        $banners=Banner::all();
        $data= compact('banners');
        return view('banner')->with($data);
    }
    /* Code for displaying the banner form */
    public function addBannerForm(){  
        $url=url('/add-banner');
        $updateToken=false;
        $title= "Add Banner";
        $banners=Banner::all();
        $data=compact('url','title','banners','updateToken');
        
        return view('add-banner')->with($data);
    }
    /* ----------- Code for  banner insertion---------------------------*/
    public function addBannerFormPost(Request $request){  
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
        );
        $banner=new Banner;
        $banner->name =$request['name'];
        $banner->description =$request['description'];

        $file = $request->file('file');
        $ext  = $banner->name . "." . $file->clientExtension();
        $file->storeAs('images/'.$banner->name.'/', $ext);
        $banner->image = 'images/'.$banner->name.'/'.$ext;

        $banner->save();
        return redirect('banner');
    }
    /* ----------- Code for Banner deletion ---------------------------*/
    public function deleteBanner($id){
        Banner::find($id)->delete();
        return redirect()->back();
    }
    /* ----------- Code for Banner updation form ---------------------------*/
    public function editBanner($id){
        $banner=Banner::find($id);
        if(is_null($banner)){
            return redirect()->back();
        }else{
            $url=url('banner/update')."/".$id;
            $title="Update Banner Details";
            $updateToken=true;
            $data=compact('banner','url','title','updateToken');
            return view('add-banner')->with($data);
        }
    }
    /* ----------- Code for Banner updation ---------------------------*/
    public function updateBanner($id,Request $request){
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
        );
        $banner=Banner::find($id);
        $banner->name =$request['name'];
        $banner->description =$request['description'];    
        
        $file = $request->file('file');
        $ext  = $banner->name . "." . $file->clientExtension();
        $file->storeAs('images/'.$banner->name.'/', $ext);
        $banner->image = 'images/'.$banner->name.'/'.$ext;

        $banner->save();
        return redirect('banner');
    }
    /* Code for Contact Us page */
    public function displayContactUs(){
        $query=Contact::all();
        $data=compact('query');
        return view('contact-us')->with($data);
    }
    /* ----------- Code for  Query deletion---------------------------*/
    public function deleteQuery($id){
        Contact::find($id)->delete();
        return redirect()->back();
    }
    /*----------------------- Coupon Management ------------------------------------------------*/
    public function displayCoupon(){
        $coupon=Coupon::all();
        $data=compact('coupon');
        return view('coupon')->with($data);
    }
     /* Code for displaying the coupon form */
     public function addCouponForm(){  
        $url=url('/add-coupon');
        $updateToken=false;
        $title= "Add Coupon";
        $coupons=Coupon::all();
        $data=compact('url','title','coupons','updateToken');
        
        return view('add-coupon')->with($data);
    }
    /* ----------- Code for  coupon insertion---------------------------*/
    public function addCouponFormPost(Request $request){  
        $request->validate(
            [
                'name'=>'required',
                'coupon_code'=>'required',
                'discount'=>'required'
            ]
        );
        $coupon=new Coupon;
        $coupon->name =$request['name'];
        $coupon->coupon_code =$request['coupon_code'];
        $coupon->discount =$request['discount'];
        $coupon->save();
        return redirect('coupon');
    }
    /* ----------- Code for Coupon deletion ---------------------------*/
    public function deleteCoupon($id){
        Coupon::find($id)->delete();
        return redirect()->back();
    }
    /* ----------- Code for Coupon updation form ---------------------------*/
    public function editCoupon($id){
        $coupon=Coupon::find($id);
        if(is_null($coupon)){
            return redirect()->back();
        }else{
            $url=url('coupon/update')."/".$id;
            $title="Update Coupon Details";
            $updateToken=true;
            $data=compact('coupon','url','title','updateToken');
            return view('add-coupon')->with($data);
        }
    }
    /* ----------- Code for Coupon updation ---------------------------*/
    public function updateCoupon($id,Request $request){
        $request->validate(
            [
                'name'=>'required',
                'coupon_code'=>'required',
                'discount'=>'required'
            ]
        );
        $coupon=Coupon::find($id);
        $coupon->name =$request['name'];
        $coupon->coupon_code =$request['coupon_code'];
        $coupon->discount =$request['discount'];    
        $coupon->save();
        return redirect('coupon');
    }
    /* ---------- Products Management------------- */
    /* code to display products */

    public function displayProduct(){
        $image=ProductImage::all();
        $productData = DB::select('SELECT products.id,products.name,products.description
        ,product_attributes.quantity,product_attributes.price,categories.name as category_name
        FROM categories JOIN products ON categories.id = products.category_id JOIN product_attributes
        ON product_attributes.product_id = products.id order by products.id');
        $data=compact('productData','image');
        //return $productData;
        return view('product')->with($data);
    }
    /* code to display product insertion form */
    public function addProductForm()
    {  
        $url=url('/add-product');
        $updateToken=false;
        $title= "Add Product";
        $category = Category::all();
        $data=compact('url','title','category','updateToken');
        return view('add-product')->with($data);
    }
    /* code to insert products */
    public function addProductFormPost(Request $request)
    {
        $validator=$request->validate(
            [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_quantity' => 'required',
                'product_price' => 'required',
                'images'=>'required'
            ]
        );
        if ($validator) {
            $productName = $request['product_name'];
            $productDescription = $request['product_description'];
            $categoryId = $request['category'];
            $product = new Product;
            $product->name = $productName;
            $product->description = $productDescription;
            $product->category_id = $categoryId;


            if ($product->save()) {
                $images = $request->file('images');

                if (!empty($images)) {
                    foreach ($images as $item) {
                        $filename = "Image-" . rand() . "-" . time() . "." . $item->extension();
                        if ($item->storeAs('/uploads'.'/'.$productName.'/', $filename)) {
                            $data = Product::where('name', $productName)->get();
                            $id = $data[0]->id;
                            $image = new ProductImage;
                            $image->product_id = $id;
                            $image->image_name = '/'.$productName.'/'.$filename;
                            $image->save();
                        } else {
                            $path = public_path() . "uploads/" . $filename;
                            unlink($path);
                            return back()->with('error', 'Image Not Added');
                        }
                    }
                    $productQuantity = $request->product_quantity;
                    $productPrice = $request->product_price;

                    $data = Product::where('name', $productName)->get();
                    $id = $data[0]->id;
                    $productAttribute = new ProductAttribute;
                    $productAttribute->quantity = $productQuantity;
                    $productAttribute->price = $productPrice;
                    $productAttribute->product_id = $id;
                    $productAttribute->save();
                    return redirect('product')->with('message', 'Product Added','updateToken');
                }
            }
        }
    }
    /* Code to delete product entry */
    public function DeleteProduct($id)
    {
        $product = Product::find($id);
        ProductImage::where('product_id', $id)->delete();
        if ($product->delete()) {
            return back()->with('message', 'Product deleted');
        } else {
            return back()->with('error', 'Product Not Deleted');
        }
    }
    /* code to display product images */
    public function displayImages($id)
    {
        $productId=$id;
        $images=ProductImage::where('product_id', $id)->get();
        $data=compact('images','productId');
        //return $images;
        //$productimages = productimage::all();
        return view('display-images')->with($data);
    }
    /* code to edit product */
    public function editProduct($id){
        $product=Product::find($id);
        if(is_null($product)){
            return redirect()->back();
        }else{
            $category=Category::all();
            $url=url('product/update')."/".$id;
            $title="Update Product Details";
            $updateToken=true;
            $products = DB::select(DB::raw('SELECT products.id ,products.name,products.description,product_attributes.quantity
            ,product_attributes.price
            FROM categories JOIN products ON categories.id = products.category_id JOIN product_attributes
            ON product_attributes.product_id = products.id WHERE product_id = :author '), array('author' => $id));
            foreach($products as $product){
                $product_name=$product->name;
                $product_description=$product->description;
                $product_quantity=$product->quantity;
                $product_price=$product->price;
            }
            $data=compact('url','title','updateToken','product_name','category','product_description',
            'product_quantity','product_price');
            return view('add-product')->with($data);
        }
    }
    /* code to update the product */
    public function updateProduct(Request $request,$id){
        $validator=$request->validate(
            [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_quantity' => 'required',
                'product_price' => 'required',
                'images'=>'required'
            ]
        );
        if ($validator) {
            $productName = $request['product_name'];
            $productDescription = $request['product_description'];
            $categoryId = $request['category'];
            $product = Product::find($id);
            $product->name = $productName;
            $product->description = $productDescription;
            $product->category_id = $categoryId;


            if ($product->save()) {
                $images = $request->file('images');

                if (!empty($images)) {
                    foreach ($images as $item) {
                        $filename = "Image-" . rand() . "-" . time() . "." . $item->extension();
                        if ($item->storeAs('/uploads'.'/'.$productName.'/', $filename)) {
                            $data = Product::where('name', $productName)->get();
                            $id = $data[0]->id;
                            $image = new ProductImage;
                            $image->product_id = $id;
                            $image->image_name = '/uploads'.'/'.$productName.'/'.$filename;
                            $image->save();
                        } else {
                            $path = public_path() . "uploads/" . $filename;
                            unlink($path);
                            return back()->with('error', 'Image Not Added');
                        }
                    }
                    $productQuantity = $request->product_quantity;
                    $productPrice = $request->product_price;


                    $productData = DB::select('SELECT products.id,products.name,products.description
        ,product_attributes.quantity,product_attributes.price,categories.name as category_name
        FROM categories JOIN products ON categories.id = products.category_id JOIN product_attributes
        ON product_attributes.product_id = products.id ');


                    $data = ProductAttribute::where('product_id', $id)->first();
                    $data->quantity = $productQuantity;
                    $data->price = $productPrice;
                    $data->save();
                    return redirect('product')->with('message', 'Product Added');
                }
            }
        }
    }
    /*----------------------- CMS  ------------------------------------------------*/

    /* cms dashboard */
    public function cms(){
        $cms=CMS::all();
        $data=compact('cms');
        return view('cms')->with($data);
    }
    /* cms insertion form */
    public function cmsForm(){
        $url=url('/cms-form');
        $updateToken=false;
        $title= "Add Static Content";
        $cms=CMS::all();
        $data=compact('url','title','cms','updateToken');
        
        return view('cms-form')->with($data);

    }
    
    /* ----------- Code for  content insertion---------------------------*/
    public function cmsFormPost(Request $request){  
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'
            ]
        );
        $cms=new CMS;
        $cms->name =$request['name'];
        $cms->description =$request['description'];
        $cms->save();
        return redirect('cms');
    }
    /* ----------- Code for cms deletion ---------------------------*/
    public function cmsDelete($id){
        CMS::find($id)->delete();
        return redirect()->back();
    }
    /* ----------- Code for cms updation form ---------------------------*/
    public function cmsEdit($id){
        $cms=CMS::find($id);
        if(is_null($cms)){
            return redirect()->back();
        }else{
            $url=url('cms/update')."/".$id;
            $title="Update CMS Details";
            $updateToken=true;
            $data=compact('cms','url','title','updateToken');
            return view('cms-form')->with($data);
        }
    }
    /* ----------- Code for cms updation ---------------------------*/
    public function cmsUpdate($id,Request $request){
        $request->validate(
            [
                'name'=>'required',
                'description'=>'required'            ]
        );
        $cms=CMS::find($id);
        $cms->name =$request['name'];
        $cms->description =$request['description'];
        $cms->save();
        return redirect('cms');
    }
    /* ---------------------------------order Management------------- */
    /* code for displaying orders */
    public function order(){
        $order=Order::all();
        $data=compact('order');
        return view('orders')->with($data);
    }
}
    

