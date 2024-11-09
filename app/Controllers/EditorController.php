<?php

namespace App\Controllers;

use App\Models\EditorModel;
use CodeIgniter\HTTP\ResponseInterface;

class EditorController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        }
        return view('editor_view');
    }

    public function save()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        }

        $raw_data = file_get_contents('php://input');
        // log($raw_data);
        $data = json_decode($raw_data, true);
        // log($data);

        $name = $data['name'] ?? null ;
        $content = $data['content'] ?? null;

        $model = new EditorModel();

        // Check if content is set
        if (empty($content)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['status' => 'error', 'message' => 'No content provided']);
        }

        // Attempt to save the content
        $result = $model->save([ 'name' => $name ,'content' =>json_encode($content), 'user_id' => session()->get('user_id')]); // Assuming save_text accepts an array

        // Check for the result of the save operation
        if ($result) {
            return $this->response->setStatusCode(200)
                ->setJSON(['status' => 'success', 'message' => 'Content saved successfully']);
        } else {
            return $this->response->setStatusCode(500)
                ->setJSON(['status' => 'error', 'message' => 'Failed to save content']);
        }
    }

    public function getContent() {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        }

        $userId = session()->get('user_id');
        $model = new EditorModel();
        $data['content'] = $model->where('user_id', $userId)->findall();

        // $real_data = json_decode($data['']);

        return view('content', $data);
   }
}
