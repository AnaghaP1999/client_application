<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private $category;
    private $client;

    // constructor
    public function __construct(Category $category, Client $client) {
        $this->category = $category;
        $this->client = $client;
    }
    // client form
    public function clientForm() {
        $categories = $this->category->getCategories();
        return view('add-client',[
            'categories' => $categories
        ]);
    }

    public function addRequirement(Request $request) {

        $rules = [
            'name' => 'required||regex:/^[A-Za-z\s]+$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $this->category->create($data);

        return response()->json($data);
    }

    public function addClient(Request $request) {

        $rules = [
            'name' => 'required||regex:/^[A-Za-z\s]+$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $this->client->create($data);

        return redirect()->route('dashboard')->with('success', 'Added Client successfully.');
    }
}
