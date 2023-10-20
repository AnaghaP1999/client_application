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

    // client list
    public function index(Request $request) {
        $perPage = 10; 
        $clients = $this->client->getClientDetails($perPage);

        return view('dashboard', [
            'clients' => $clients
        ]);
    }

    public function getClients(Request $request) {
        $perPage = 10; 
        $clients = $this->client->getClientDetails($perPage);

        if ($request->ajax()) {
            
            return view('client-list', compact('clients'));
        }

        return view('dashboard', compact('clients'));
    }

    // client form
    public function clientForm() {
        $categories = $this->category->getCategories();
        return view('add-client',[
            'categories' => $categories
        ]);
    }

    // Add Category
    public function addCategory(Request $request) {

        $rules = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $details = $this->category->create($data);

        return response()->json([
            'id' => $details->id,
            'name' => $details->name,
        ]);
    }

    // Add/Update Client Details
    public function addClient(Request $request) {

        $rules = [
            'name' => 'required||regex:/^[A-Za-z\s]+$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $id = $request->id ?? '';
        $data = $request->all();

        if($id != '') {
            $clientDetails = $this->client->getClientById($id);
            $clientDetails->update($data);
        } else {
            $this->client->create($data);
        }

        return redirect()->route('dashboard')->with('success', 'Client Added/Updated successfully.');
    }

    // Edit Page - client
    public function editClientDetails(int $id = null) {
        $categories = $this->category->getCategories();
        $clientDetails = $this->client->getClientById($id);

        return view('edit-client', [
            'clientDetails' => $clientDetails,
            'categories' => $categories,
            'id' => $id
        ]);
    }

    // Delete Client
    public function deleteClient(int $id = null) {
        $clientDetails = $this->client->getClientById($id);
        if ($clientDetails) {
            $clientDetails->delete();
            return redirect()->route('dashboard')->with('success', 'Client deleted successfully');
        }
        return redirect()->route('dashboard')->with('error', 'Client not found');
    }
}
