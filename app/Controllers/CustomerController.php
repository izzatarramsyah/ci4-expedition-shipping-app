<?php

namespace App\Controllers;
use App\Models\CustomersModel;
use \Datetime;

class CustomerController extends BaseController  {

    public function index()  {
        $data['pageTitle'] = 'Customer Management';
        $data['menu'] = 'customer';
        $session = session();
        if ($session->has('dataUser')) {
            $data['dataUser'] = array_values(session('dataUser'));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return  view('view_modal/customer/edit')
                .view('view_menu/view_customer', $data);
        }
    }

    public function getListCustomer(){
        try {
            $customer = new CustomersModel();
            $customerData = $customer->getListCustomer();
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success',
                'object' => $customerData
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getCustomerByName(){
        try {
            $customerName = $this->request->getPost('customerName');
            $customer = new CustomersModel();
            $customerData = $customer->getCustomerByName( $customerName );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success',
                'object' => $customerData
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveCustomer(){
        $customer = new CustomersModel();
        $nowDt = date('Y-m-d H:i:s');
        try {
            $name = $this->request->getPost('name');
            $phoneNo = $this->request->getPost('phoneNo');
            $address = $this->request->getPost('address');
            $dataUser = array_values(session("dataUser"));
            $paramCust = array(
                'name' => $name,
                'address' => $addres,
                'phone' => $phoneNo,
                'created_dtm' => $nowDt,
                'status' => 'A',
                'created_by' => $dataUser[0]["name"]
            );
            if ( !$customer->saveCustomer($paramCust) ) {
                return $this->response->setJSON([
                    'statusCode' => 500,
                    'message' => 'Failed'
                ]);
            } else {
                return $this->response->setJSON([
                    'statusCode' => 200,
                    'message' => 'Success'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateCustomer(){
        $customer = new CustomersModel();
        $nowDt = date('Y-m-d H:i:s');
        try {
            $id = $this->request->getPost('id');
            $name = $this->request->getPost('name');
            $phoneNo = $this->request->getPost('phoneNo');
            $addres = $this->request->getPost('addres');
            $dataUser = array_values(session("dataUser"));
            $paramCust = array(
                'id' => $id,
                'name' => $name,
                'address' => $addres,
                'phone' => $phoneNo,
                'updated_dtm' => $nowDt,
                'updated_by' => $dataUser[0]["name"]
            );
            if ( !$customer->updateCustomer($paramCust) ) {
                return $this->response->setJSON([
                    'statusCode' => 500,
                    'message' => 'Failed'
                ]);
            } else {
                return $this->response->setJSON([
                    'statusCode' => 200,
                    'message' => 'Success'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateStatusCustomer(){
        $customer = new CustomersModel();
        try {
            $id = $this->request->getPost('id');
            $status = $this->request->getPost('status');
            $customerData = $customer->updateCustomerStatus( $id, $status );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteCustomer()  {
        $customer = new CustomersModel();
        try {
            $id = $this->request->getPost('id');
            if ( $customer->deleteCustomer($id) ) {
                return $this->response->setJSON([
                    'statuscode' => 200,
                    'message' => 'success'
                ]);
            } else {
                return $this->response->setJSON([
                    'statuscode' => 200,
                    'message' => 'Success'
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

}