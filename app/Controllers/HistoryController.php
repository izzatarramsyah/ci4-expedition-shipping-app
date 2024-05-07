<?php

namespace App\Controllers;
use App\Models\CustomersModel;
use App\Models\ShipmentsModel;
use App\Models\ShipmentsDetailModel;
use App\Models\DeliveryStatusModel;

class HistoryController extends BaseController  {

    public function index()  {
        $data['pageTitle'] = 'Shipment History';
        $data['menu'] = 'history';
        $session = session();
        if ($session->has('dataUser')) {
            $data['dataUser'] = array_values(session('dataUser'));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return view('view_modal/history/detail')
                .view('view_modal/history/delivery')
                .view('view_menu/view_history', $data);
        }
    }

    public function getDeliveryStatusById(){
        $deliiveryStatusModel = new DeliveryStatusModel();
        try {
            $shipmentsId = $this->request->getPost('shipmentId');
            $deliiveryStatus = $deliiveryStatusModel->getDeliveryStatusById( $shipmentsId );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $deliiveryStatus
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function checkHistory(){
        $shipmentsModel = new ShipmentsModel();
        $customersModel = new CustomersModel();
        $deliiveryStatusModel = new DeliveryStatusModel();
        $result = [];
        try {
            $shipmentsId = $this->request->getPost('shipmentsId');
            $startDate = $this->request->getPost('startDate');
            $endDate = $this->request->getPost('endDate');
            if ( $shipmentsId != null || $shipmentsId != '' ) {
                $shipmentsData = $shipmentsModel->getShipmentsById( $shipmentsId );
            } else {
                $shipmentsData = $shipmentsModel->getShipmentsByDateRange( $startDate, $endDate );
            }
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