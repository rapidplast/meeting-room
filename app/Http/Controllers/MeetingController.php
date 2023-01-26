<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->get('search')) {
            $Meeting = Meeting::with('categoryService')->search(['name', 'price'], $search)->get();
        } else {
            $Meeting = Meeting::with('categoryService')->get();
        }
        // $categoryService = CategoryService::all();
        return view('admin.service', compact('service', 'categoryService'));
    }

    public function serviceCustomer()
    {
        $Meeting = Meeting::with('categoryService')->get();
        return view('customer.service', compact('services'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_service_id' => 'required',
            'price' => 'required',
            'image' => 'nullable',
        ]);

        $Meeting = new Meeting;

        $Meeting->name = $request->get('name');
        $Meeting->price = $request->get('price');        
        $Meeting->save();


        return redirect()->route('service.index')
            ->with('success', 'Service Successfully Added');
    }


    public function show(Meeting $Meeting)
    {
    }


    public function edit($service_id)
    {
        $Meeting = Meeting::where('meeting_id', $service_id)
            ->first();
        // $categoryService = CategoryService::all();
        return view('admin.serviceEdit', ['service' => $Meeting]);
    }


    public function update(Request $request, $idservice)
    {
        $request->validate([
            'name' => 'required',
            'category_service_id' => 'required',
            'price' => 'required',
            'image' => 'nullable',
        ]);

        $Meeting = Meeting::where('service_id', $idservice)
            ->first();

        $Meeting->name = $request->get('name');        
        $Meeting->save();


        return redirect()->route('service.index')
            ->with('success', 'Service Successfully Updated');
    }


    public function destroy($idservice)
    {
        $Meeting = Meeting::where('service_id', $idservice)->first();

        $Meeting->delete();
        return redirect()->route('service.index')
            ->with('success', 'Service seccesfully Deleted');
    }
}
