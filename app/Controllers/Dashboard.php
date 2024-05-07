<?php

namespace App\Controllers;
use App\Models\DeliveryStatusModel;
use App\Models\CustomersModel;
use App\Models\ShipmentsModel;
use App\Models\ShipmentsDetailModel;
class Dashboard extends BaseController
{
    public function index()  {
        $data["pageTitle"] = "Dashboard";
        $data["menu"] = "dashboard";
        $session = session();
        if ($session->has("dataUser")) {
            $data["dataUser"] = array_values(session("dataUser"));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return view("view_menu/view_dashboard", $data);
        }    
    }

    public function getDeliveryStatusData(){
        $deliveryStatus = new DeliveryStatusModel();
        $result = $deliveryStatus->getDeliveryStatusData();
        return $this->response->setJSON([
            'statuscode' => 200,
            'message' => 'success',
            'object' => $result
        ]);
    }

    public function getLatestOrder(){
        $shipmentsModel = new ShipmentsModel();
        $customersModel = new CustomersModel();
        $deliiveryStatusModel = new DeliveryStatusModel();
        $result = [];
        try {
            $shipmentsData = $shipmentsModel->getShipments();
            for ($i = 0; $i < count($shipmentsData); $i++) {
                $customerData = $customersModel->getCustomerById( intval($shipmentsData[$i]->customer_id) );
                $deliiveryStatus = $deliiveryStatusModel->getDeliveryStatusById( $shipmentsData[$i]->id );
                $temp = array(
                    'shipmentId' => $shipmentsData[$i]->id,
                    'deliveryAddress' => $shipmentsData[$i]->delivery_address,
                    'receipmentName' => $shipmentsData[$i]->receipment_name,
                    'receipmentPhoneNo' => $shipmentsData[$i]->receipment_phone_no,
                    'senderName' => $customerData[0]->name,
                    'senderAddress' => $customerData[0]->address,
                    'senderPhoneNo' => $customerData[0]->phone,
                    'status' => $deliiveryStatus[0]->status
                );  
                array_push($result, $temp);
            }
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $result
            ]);
        }  catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}
