<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BannersModel;
use App\Models\PromotionCardModel;
use App\Models\AboutModel;
use App\Models\TaxesModel;
use App\Models\AdmintagModel;
use App\Models\FrontendtagModel;
use App\Models\BlogModel;
use App\Models\ServicetagModel;

class Banner_Controller extends Api_Controller
{
    private function add_banner($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Product not added',
            'data' => null
        ];

        $uploadedFiles = $this->request->getFiles();
        if (empty ($uploadedFiles['images'])) {
            $resp['message'] = 'Your Banner Has No Image';
        } 
        // else if (empty ($data['bannerLink'])) {
        //     $resp['message'] = 'Please Add A Link';
        // }
        else {


            $banner_data = [
                'uid' => $this->generate_uid(UID_BANNER),
                'title' => $data['bannerTitle'],
                'description' => $data['bannerDescription'],
                'link' => $data['bannerLink'],
            ];
            
            
            foreach ($uploadedFiles['images'] as $file) {
                $file_src = $this->single_upload($file, PATH_BANNER_IMG);
                $banner_data['img'] = $file_src;
            }
            $BannerModel = new BannersModel();


            // Transaction Start
            $BannerModel->transStart();
            try {
                $BannerModel->insert($banner_data);
                // Commit the transaction if all queries are successful
                $BannerModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BannerModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Banner added';
            $resp['data'] = ['banner_id' => $banner_data['uid']];
        }
        return $resp;
    }

    private function banners()
    {

        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => ""
        ];
        
        $BannerModel = new BannersModel();
        $BanneData = $BannerModel
        ->get()
        ->getResultArray();
        // $BanneData = $BannerModel
        // ->first();
        $BanneData = !empty($BanneData) ? $BanneData : null;

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "data" => $BanneData,
        ];
        return $resp; 
    }

    private function delete_banner($data)
    {

        $resp = [
            "status" => false,
            "message" => "Data delete failed",
            "data" => ""
        ];
        $BannerModel = new BannersModel();
        $delete_data = $BannerModel->where('uid', $data['banner_id'])->delete();
        if($delete_data){
            $resp = [
                "status" => true,
                "message" => "Data deleted",
                "data" => "",
            ];
        }
        return $resp;

    }

    private function update_banner($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Banner Not Found!",
            "data" => $data
        ];
        $BannerModel = new BannersModel();
        try {

            // Selecting the cart with the specified User
            $banner = $BannerModel->where('uid', $data['banner_id'])->first();

            if ($banner) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'Banner Found';
                $resp['data'] = $banner;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function banner_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Banner not updated',
            'data' => null
        ];
        
        if (empty ($data['banner_id'])) {
            $resp['message'] = 'Banner Not Found!';
        }else {


            $banner_data = [
                'title' => $data['bannerTitle'],
                'description' => $data['bannerDescription'],
                'link' => $data['bannerLink'],
            ];
            
            $uploadedFiles = $this->request->getFiles();
            if(isset($uploadedFiles['images'])){
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_BANNER_IMG);
                    $banner_data['img'] = $file_src;
                }
            }
            
            $BannerModel = new BannersModel();


            // Transaction Start
            $BannerModel->transStart();
            try {
                $BannerModel
                        ->where('uid', $data['banner_id'])
                        ->set($banner_data)
                        ->update();
                $BannerModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BannerModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Banner Updated';
            $resp['data'] = "";
        }
        return $resp;
    }

    private function update_promotion_card($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Banner Not Found!",
            "data" => $data
        ];
        $PromotionCardModel = new PromotionCardModel();
        try {

            // Selecting the cart with the specified User
            $card = $PromotionCardModel->first();

            if ($card) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'Promotion Card Found';
                $resp['data'] = $card;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function promotion_card_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Banner not updated',
            'data' => null
        ];
    
        
        // Validate links
        if (empty($data['link1'])) {
            $resp['message'] = 'Your Card 1 Has Link';
        } else if (empty($data['link2'])) {
            $resp['message'] = 'Your Card 2 Has Link';
        } else {
    
            // Prepare card data
            $card_data = [
                'link1' => $data['link1'],
                'link2' => $data['link2'],
                'link3' => $data['link3'],
                'link4' => $data['link4'],
            ];
            
            // Get uploaded files
            $uploadedFiles = $this->request->getFiles();
    
            // Process image uploads
            if (isset($uploadedFiles['images1'])) {
                foreach ($uploadedFiles['images1'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img1'] = $file_src;
                }
            }
            if (isset($uploadedFiles['images2'])) {
                foreach ($uploadedFiles['images2'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img2'] = $file_src;
                }
            }
            if (isset($uploadedFiles['images3'])) {
                foreach ($uploadedFiles['images3'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img3'] = $file_src;
                }
            }
            if (isset($uploadedFiles['images4'])) {
                foreach ($uploadedFiles['images4'] as $file) {
                    $file_src = $this->single_upload($file, PATH_PROMOTION_CARD_IMG);
                    $card_data['img4'] = $file_src;
                }
            }
    
            // $this->prd($card_data);
            // Prepare the model and start transaction
            $PromotionCardModel = new PromotionCardModel();
            $PromotionCardModel->transStart();
    
            try {
                // Update the promotion card in the database
                $PromotionCardModel
                    ->where('uid', $data['card_id'])
                    ->set($card_data)
                    ->update();
    
                // Commit the transaction
                $PromotionCardModel->transCommit();
    
                // Set success response
                $resp['status'] = true;
                $resp['message'] = 'Card Updated';
                $resp['data'] = "";
            } catch (\Exception $e) {
                // Rollback if an error occurs
                $PromotionCardModel->transRollback();
                $resp['message'] = 'Error: ' . $e->getMessage();
            }
        }
    
        return $resp;
    }
    

    private function about($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Banner Not Found!",
            "data" => $data
        ];
        $AboutModel = new AboutModel();
        try {

            // Selecting the cart with the specified User
            $about = $AboutModel->first();

            if ($about) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'About Card Found';
                $resp['data'] = $about;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function about_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'About not updated',
            'data' => null
        ];
        
        $uploadedFiles = $this->request->getFiles();
        if (empty ($data['companyName'])) {
            $resp['message'] = 'Please Add Company Name';
        } else if (empty ($data['address'])) {
            $resp['message'] = 'Please Add A Link';
        } else if(empty ($data['bannerDescription'])){
            $resp['message'] = 'Please Add Description';
        } else if(empty ($data['phoneNo1'])){
            $resp['message'] = 'Please Add Phone No 1';
        } else if(empty ($data['phoneNo2'])){
            $resp['message'] = 'Please Add Phone No 2';
        } else if(empty ($data['map'])){
            $resp['message'] = 'Please Add Map URL';
        } else if(empty ($data['email'])){
            $resp['message'] = 'Please Add Email';
        } else if(empty ($data['about_id'])){
            $resp['message'] = 'About Not Found';
        } else {


            $about_data = [
                'company_name' => $data['companyName'],
                'about_description' => $data['bannerDescription'],
                'address' => $data['address'],
                'phone1' => $data['phoneNo1'],
                'phone2' => $data['phoneNo2'],
                'map' => $data['map'],
                'email' => $data['email'],
                'mission' => $data['mission'],
                'vision' => $data['vision'],
                'frontend_meta_description	' => $data['frontend-meta-description'],
                'frontend_meta_author' => $data['frontend-meta-author'],
                'frontend_copyright' => $data['frontend-copyright'],
                'admin_meta_description	' => $data['admin-meta-description'],
                'admin_meta_author' => $data['admin-meta-author'],
                'admin_copyright' => $data['admin-copyright']
            ];
            
            $uploadedFiles = $this->request->getFiles();
            if(isset($uploadedFiles['images'])){
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_LOGO);
                    $about_data['logo'] = $file_src;
                }
            }
            
            $AboutModel = new AboutModel();


            // Transaction Start
            $AboutModel->transStart();
            try {
                $AboutModel
                        ->where('uid', $data['about_id'])
                        ->set($about_data)
                        ->update();
                $AboutModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $AboutModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'About Updated';
            $resp['data'] = "";
        }
        return $resp;
    }

    private function Taxes($data)
    {
        // $this->prd($data['banner_id']);
        $resp = [
            "status" => false,
            "message" => "Taxes Not Found!",
            "data" => $data
        ];
        $TaxesModel = new TaxesModel();
        try {

            // Selecting the cart with the specified User
            $tax = $TaxesModel->first();

            if ($tax) {
                // Cart exists
                $resp['status'] = true;
                $resp['message'] = 'Taxes Found';
                $resp['data'] = $tax;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;

    }

    private function tax_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Tax not updated',
            'data' => null
        ];
        
        $uploadedFiles = $this->request->getFiles();
        if (empty ($data['gst'])) {
            $resp['message'] = 'Please Add GST';
        } else if (!isset($data['tax']) || $data['tax'] === '') {
            $resp['message'] = 'Please Add tax';
        } else if(!isset($data['delivary_charge']) || $data['delivary_charge'] === ''){
            $resp['message'] = 'Please Add delivary charge';
        } else if(empty ($data['tax_id'])){
            $resp['message'] = 'Tax Not Found';
        } else {


            $tax_data = [
                'gst' => $data['gst'],
                'tax' => $data['tax'],
                'delivary_charge' => $data['delivary_charge'],
            ];
            
            $TaxesModel = new TaxesModel();


            // Transaction Start
            $TaxesModel->transStart();
            try {
                $TaxesModel
                        ->where('uid', $data['tax_id'])
                        ->set($tax_data)
                        ->update();
                $TaxesModel->transCommit();
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $TaxesModel->transRollback();
                $resp['message'] = $e->getMessage();
            }

            $resp['status'] = true;
            $resp['message'] = 'Tax Updated';
            $resp['data'] = "";
        }
        return $resp;
    }

    // private function admin_tags($data)
    // {
    //     // Default response structure
    //     $resp = [
    //         'status' => false,
    //         'message' => 'Tags not saved',
    //         'data' => null
    //     ];
    
    //     // Get the tags array from the data
    //     $tags = $data['tags'];
    
    //     // Initialize the Tag model
    //     $AdmintagModel = new AdmintagModel();
    
    //     // Transaction Start
    //     $AdmintagModel->transStart();
    //     try {
    //         // Loop through each tag and save it individually
    //         foreach ($tags as $tag) {
    //             // Clean the tag (you can perform sanitization here if needed)
    //             $tag_data = [
    //                 'tag_name' => $tag
    //             ];
    
    //             // Insert the tag into the database
    //             $AdmintagModel->insert($tag_data);
    //         }
    
    //         // Commit the transaction if all tags are saved successfully
    //         $AdmintagModel->transCommit();
    
    //         // Success response
    //         $resp['status'] = true;
    //         $resp['message'] = 'Tags saved successfully';
    //         $resp['data'] = $tags;
    
    //     } catch (\Exception $e) {
    //         // Rollback the transaction if an error occurs
    //         $AdmintagModel->transRollback();
    //         $resp['message'] = 'Error: ' . $e->getMessage();
    //     }
    
    //     // Return the response
    //     return $resp;
    // }
    private function frontend_tags($data)
    {
        // Default response structure
        $resp = [
            'status' => false,
            'message' => 'Tags not saved',
            'data' => null
        ];
    
        // Get the tags array from the data
        $tags = $data['tags'];
    
        // Initialize the Tag model
        $FrontendtagModel = new FrontendtagModel();
    
        // Transaction Start
        $FrontendtagModel->transStart();
        try {
            // Loop through each tag and save it individually
            foreach ($tags as $tag) {
                // Clean the tag (you can perform sanitization here if needed)
                $tag_data = [
                    'tag_name' => $tag
                ];
    
                // Insert the tag into the database
                $FrontendtagModel->insert($tag_data);
            }
    
            // Commit the transaction if all tags are saved successfully
            $FrontendtagModel->transCommit();
    
            // Success response
            $resp['status'] = true;
            $resp['message'] = 'Tags saved successfully';
            $resp['data'] = $tags;
    
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            $FrontendtagModel->transRollback();
            $resp['message'] = 'Error: ' . $e->getMessage();
        }
    
        // Return the response
        return $resp;
    }

    private function blog_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Blog not updated',
            'data' => null
        ];
    
        // Check if title and description are provided
        if (empty($data['blog_title'])) {
            $resp['message'] = 'Please Add Blog Title';
        } elseif (empty($data['blog_description'])) {
            $resp['message'] = 'Please Add Blog Description';
        } elseif (empty($data['blog_uid'])) {
            $resp['message'] = 'No Uid';
        } else {
            // Prepare blog data
            $blog_data = [
                'blog_title' => $data['blog_title'],
                'blog_description' => $data['blog_description']
            ];
    
            // Handle file uploads
            $uploadedFiles = $this->request->getFiles();
            $existingBlogData = (new BlogModel())->where('uid', $data['blog_uid'])->first(); // Fetch the existing blog
    
            // Check if there were any uploaded files
            if (isset($uploadedFiles['images'])) {
                $imagePaths = [];
    
                foreach ($uploadedFiles['images'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // Save the file and get the file path
                        $file_src = $this->single_upload($file, PATH_BLOG);
                        if ($file_src) {
                            $imagePaths[] = $file_src; // Store the image path
                        } else {
                            error_log('Failed to upload file: ' . $file->getName());
                        }
                    } else {
                        error_log('Invalid file upload attempt: ' . $file->getName());
                    }
                }
    
                // If images were uploaded, store their paths in blog data
                if (!empty($imagePaths)) {
                    // If the blog already has an existing image, delete the old ones (optional)
                    if (!empty($existingBlogData['blog_image'])) {
                        $existingImages = explode(',', $existingBlogData['blog_image']);
                        foreach ($existingImages as $oldImagePath) {
                            if (file_exists($oldImagePath)) {
                                unlink($oldImagePath);  // Delete the old image file(s)
                            }
                        }
                    }
                    
                    // Join new image paths with commas and update the blog data
                    $blog_data['blog_image'] = implode(',', $imagePaths);
                }
            } else {
                // If no new image was uploaded, keep the old image (if any)
                if (!empty($existingBlogData['blog_image'])) {
                    $blog_data['blog_image'] = $existingBlogData['blog_image']; // Keep the old image
                }
            }
    
            // Database insertion/update logic
            $BlogModel = new BlogModel();
    
            // Start a transaction
            $BlogModel->transStart();
            try {
                // Update the blog data in the database
                $BlogModel
                    ->where('uid', $data['blog_uid'])
                    ->set($blog_data)
                    ->update();
    
                // Commit the transaction
                $BlogModel->transCommit();
    
                // Update the response status
                $resp['status'] = true;
                $resp['message'] = 'Blog Updated Successfully';
                $resp['data'] = $blog_data;
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BlogModel->transRollback();
                $resp['message'] = 'Error: ' . $e->getMessage();
            }
        }
    
        return $resp;
    }
    

    private function blog_add($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Blog not updated',
            'data' => null
        ];
        
        // Check if title and description are provided
        if (empty($data['blog_title'])) {
            $resp['message'] = 'Please Add Blog Title';
        } elseif (empty($data['blog_description'])) {
            $resp['message'] = 'Please Add Blog Description';
        } else {
            // Prepare blog data
            $blog_data = [
                "uid" => $this->generate_uid('VENAUTH'),
                'blog_title' => $data['blog_title'],
                'blog_description' => $data['blog_description']
            ];

            // Handle file uploads
            $uploadedFiles = $this->request->getFiles();
            if (isset($uploadedFiles['images'])) {
                $imagePaths = [];
                foreach ($uploadedFiles['images'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        // Save the file and get the file path
                        $file_src = $this->single_upload($file, PATH_BLOG);
                        if ($file_src) {
                            $imagePaths[] = $file_src; // Store the image path
                        } else {
                            error_log('Failed to upload file: ' . $file->getName());
                        }
                    } else {
                        error_log('Invalid file upload attempt: ' . $file->getName());
                    }
                }
                // If images were uploaded, store their paths in blog data
                if (!empty($imagePaths)) {
                    $blog_data['blog_image'] = implode(',', $imagePaths); // Join paths with commas if multiple images
                }
            }

            // Database insertion logic
            $BlogModel = new BlogModel();

            // Start a transaction
            $BlogModel->transStart();
            try {
                // Insert the blog data into the database
                $BlogModel->insert($blog_data);
                // $BlogModel
                //         ->where('uid', $data['about_id'])
                //         ->set($blog_data)
                //         ->update();

                // Commit the transaction
                $BlogModel->transCommit();

                // Update the response status
                $resp['status'] = true;
                $resp['message'] = 'Blog Updated Successfully';
                $resp['data'] = $blog_data;
            } catch (\Exception $e) {
                // Rollback the transaction if an error occurs
                $BlogModel->transRollback();
                $resp['message'] = 'Error: ' . $e->getMessage();
            }
        }

        return $resp;
    }
    private function single_banner()
    {

        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => ""
        ];
        
        $BannerModel = new BannersModel();
        // $BanneData = $BannerModel
        // ->get()
        // ->getResultArray();
        $BanneData = $BannerModel
        ->first();
        $BanneData = !empty($BanneData) ? $BanneData : null;

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "data" => $BanneData,
        ];
        return $resp; 
    }

    
    























    public function POST_add_banner()
    {
        $data = $this->request->getPost();
        $resp = $this->add_banner($data);
        return $this->response->setJSON($resp);

    }

    public function GET_banners()
    {
        $data = $this->request->getPost();
        $resp = $this->banners($data);
        return $this->response->setJSON($resp);

    }

    public function GET_delete_banner()
    {
        $data = $this->request->getGet();
        $resp = $this->delete_banner($data);
        return $this->response->setJSON($resp);

    }

    public function GET_update_banner()
    {
        $data = $this->request->getGet();
        $resp = $this->update_banner($data);
        return $this->response->setJSON($resp);

    }

    public function POST_banner_update()
    {
        $data = $this->request->getPost();
        $resp = $this->banner_update($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_promotion_card()
    {
        $data = $this->request->getGet();
        $resp = $this->update_promotion_card($data);
        return $this->response->setJSON($resp);

    }

    public function POST_promotion_card_update()
    {
        $data = $this->request->getPost();
        $resp = $this->promotion_card_update($data);
        return $this->response->setJSON($resp);

    }

    public function GET_about()
    {
        $data = $this->request->getGet();
        $resp = $this->about($data);
        return $this->response->setJSON($resp);

    }

    public function POST_about_update()
    {
        $data = $this->request->getPost();
        $resp = $this->about_update($data);
        return $this->response->setJSON($resp);

    }

    public function GET_Taxes()
    {
        $data = $this->request->getGet();
        $resp = $this->Taxes($data);
        return $this->response->setJSON($resp);

    }

    public function POST_tax_update()
    {
        $data = $this->request->getPost();
        $resp = $this->tax_update($data);
        return $this->response->setJSON($resp);

    }

    // public function POST_admin_tags()
    // {
    //     $data = $this->request->getPost();
    //     $resp = $this->admin_tags($data);
    //     return $this->response->setJSON($resp);

    // }

    public function POST_frontend_tags()
    {
        $data = $this->request->getPost();
        $resp = $this->frontend_tags($data);
        return $this->response->setJSON($resp);

    }

    public function POST_blog_update()
    {
        $data = $this->request->getPost();
        $resp = $this->blog_update($data);
        return $this->response->setJSON($resp);

    }
    public function POST_blog_add()
    {
        $data = $this->request->getPost();
        $resp = $this->blog_add($data);
        return $this->response->setJSON($resp);

    }

    public function GET_single_banner()
    {
        $data = $this->request->getGet();
        $resp = $this->single_banner($data);
        return $this->response->setJSON($resp);

    }
    
}
