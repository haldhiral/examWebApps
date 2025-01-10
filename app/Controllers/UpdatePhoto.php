<?php

namespace App\Controllers;

use App\Models\PhotoModel;

class UpdatePhoto extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('isloggedin')) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');
        }

        return view('update_photo');
    }

    public function update()
    {
        $session = session();

        // Ensure the user is logged in
        if (!$session->get('isloggedin')) {
            $session->setFlashdata('error', 'Please Login First!');
            return redirect()->to('login');
        }

        // Get the Base64 encoded photo from the form
        $photoData = $this->request->getPost('photo');

        if (empty($photoData)) {
            $session->setFlashdata('error', 'No photo was captured.');
            return redirect()->back();
        }

        // Decode the Base64 string into an image
        $photoData = explode(',', $photoData); // Split to separate metadata and image data
        if (count($photoData) !== 2) {
            $session->setFlashdata('error', 'Invalid photo data.');
            return redirect()->back();
        }

        $imageData = base64_decode($photoData[1]);
        if ($imageData === false) {
            $session->setFlashdata('error', 'Failed to decode photo data.');
            return redirect()->back();
        }

        // Generate the filename using the session's name
        $filename = $session->get('name') . '.png'; // Save as PNG file
        $uploadPath = FCPATH . 'uploads/photos/'; // Define the upload path

        // Ensure the upload directory exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Save the file
        $filePath = $uploadPath . $filename;
        if (file_put_contents($filePath, $imageData) === false) {
            $session->setFlashdata('error', 'Failed to save photo.');
            return redirect()->back();
        }

        // Use the PhotoModel to insert or update the record
        $photoModel = new PhotoModel();
        $data = [
            'student_name' => $session->get('name'),
            'username' => $session->get('username'),
            'photo' => $filename,
        ];

        if (!$photoModel->upsertPhotoByUsername($session->get('username'), $data)) {
            $session->setFlashdata('error', 'Failed to update photo in the database.');
            return redirect()->back();
        }

        // Redirect with success message
        $session->setFlashdata('success', 'Photo updated successfully!');
        return redirect()->to('student');
    }
}
