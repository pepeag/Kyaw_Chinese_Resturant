<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function menu()
    {
        $data = Menu::paginate(6);
        if (count($data) == 0) {
            $emptyStatus = 0;
        } else {
            $emptyStatus = 1;
        }
        return view('admin.menu.list')->with(['menu' => $data, 'status' => $emptyStatus]);
    }
    public function addMenu()
    {

        return view('admin.menu.add');
    }
    public function insertMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $file = $request->file('image'); // request data from create Form
        // dd($file);

        $fileName = uniqid() . '_ppa' . $file->getClientOriginalName();
        // dd($fileName);
        $file->move(public_path() . '/uploads/', $fileName); //create uploads folder in public folder and move to fileName

        $data = $this->requestMenu($request, $fileName);

        Menu::create($data); //create pizza
        return redirect()->route('admin#menu')->with(['menuSuccess' => 'Add Menu Successfully']);
    }
    private function requestMenu($request, $fileName)
    {
        return [
            'menu_name' => $request->name,
            'image' => $fileName,
            // 'image'=>$request->image,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
    public function deleteMenu($id)
    {
        $data = Menu::select('image')->where('menu_id', $id)->first();
        $fileName = $data['image'];

        Menu::where('menu_id', $id)->delete();
        if (File::exists(public_path() . '/uploads/' . $fileName)) {
            File::delete(public_path() . '/uploads/' . $fileName);
        }

        return back()->with(['menuDelete' => 'Menu delete successfully!']);
    }
    public function editMenu($id)
    {
        $data = Menu::where('menu_id', $id)->first();
        return view('admin.menu.update')->with(['menu' => $data]);
    }
    public function updateMenu($id, Request $request)

    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        //get request data from updataPizzafunction
        $updateData = $this->requestUpdate($request);
        //if image have data
        if (isset($updateData['image'])) {

            //get old image to delete
            $data = Menu::select('image')->where('menu_id', $id)->first();
            $fileName = $data['image']; //add $data of image to fileName

            //image file delete
            if (File::exists(public_path() . '/uploads/' . $fileName)) {
                File::delete(public_path() . '/uploads/' . $fileName);
            }

            //get new image like create method
            $file = $request->file('image');
            $fileName = uniqid() . '_ppa' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName); //move path to $fileName

            $updateData['image'] = $fileName; //override fileName to $updateData of image
            // dd($updateData['image']);

            // //update data
            // Pizza::where('pizza_id',$id)->update($updateData);
            // return redirect()->route('admin#pizza')->with(['updatePizza'=>'Pizza update successfully...']);
            // }
            // else{
            //if image have no data
        }
        Menu::where('menu_id', $id)->update($updateData);
        return redirect()->route('admin#menu')->with(['updateMenu' => 'Menu update successfully...']);
    }
    private function requestUpdate($request)
    {
        //request data add to $array
        $arr = [
            'menu_name' => $request->name,
            // 'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,

            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
        if (isset($request->image)) {
            $arr['image'] = $request->image; //add image to array of image
        }
        return $arr; //return data to $update function
    }
}
