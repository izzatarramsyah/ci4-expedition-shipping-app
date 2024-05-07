<?php

namespace App\Controllers;
use App\Models\CustomersModel;
use App\Models\ShipmentsModel;
use App\Models\ShipmentsDetailModel;
use App\Models\DeliveryStatusModel;
use App\Models\MstWeightRateModel;
use App\Models\MstRouteModel;
use App\Models\MstWeightModel;
use \Datetime;
use Dompdf\Dompdf;

class ShipmentsController extends BaseController  {

    public function index()  {
        $data['pageTitle'] = 'Create SO';
        $data['menu'] = 'shipments';
        $session = session();
        if ($session->has('dataUser')) {
            $data['dataUser'] = array_values(session('dataUser'));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return  view('view_modal/shipments/invoice')
                .view('view_modal/shipments/item')
                .view('view_menu/view_shipments', $data);
        }
    }

    public function getShipmentDetail(){
        $shipmentsDetailModel = new ShipmentsDetailModel();
        $result;
        try {
            $shipmentsId = $this->request->getPost('shipmentId');
            $shipmentsDetailData = $shipmentsDetailModel->getShipmentsDetailById( $shipmentsId );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $shipmentsDetailData
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function createShipments(){
        $idCustomer;
        $customer = new CustomersModel();
        $shipments = new ShipmentsModel();
        $deliveryStatus = new DeliveryStatusModel();
        $shipmentsDetailModel = new ShipmentsDetailModel();
        date_default_timezone_set('Asia/Jakarta'); 
        $nowDt = date('Y-m-d H:i:s');
        try {
            $shipmentsId = $this->request->getPost('shipmentsId');
            $senderName = $this->request->getPost('senderName');
            $senderAddress = $this->request->getPost('senderAddress');
            $senderPhoneNo = $this->request->getPost('senderPhoneNo');
            $receipmentName = $this->request->getPost('receipmentName');
            $receipmentPhoneNo = $this->request->getPost('receipmentPhoneNo');
            $develiveryAddress = $this->request->getPost('develiveryAddress');
            $itemShipments = $this->request->getPost('itemShipments');
            $dataUser = array_values(session("dataUser"));
            $customerData = $customer->getCustomerByName( $senderName );
            if ( $customerData[0]->id != null ) {
                $paramShipments = array(
                    'id' => $shipmentsId,
                    'customer_id' => $customerData[0]->id,
                    'employee_id' => $dataUser[0]["employeeId"],
                    'delivery_address' => $develiveryAddress,
                    'receipment_name' => $receipmentName,
                    'receipment_phone_no' => $receipmentPhoneNo,
                    'created_dtm' => $nowDt,
                    'created_by' => $dataUser[0]["name"]
                );
                $paramDelivery = array(
                    'shipment_id' => $shipmentsId,
                    'delivery_date' => $nowDt,
                    'status' => 'Waiting For Proccess',
                    'remarks' => ''
                );
                if ( $shipments->saveShipments($paramShipments) && $deliveryStatus->saveDeliveryStatus($paramDelivery) ) {
                    for ($i = 0; $i < count($itemShipments); $i++) {
                        $paramShipmentsDetail = array(
                            'shipment_id' => $shipmentsId,
                            'item_name' => $itemShipments[$i]['itemName'],
                            'quantity' => $itemShipments[$i]['itemQuantity'],
                            'weight' => $itemShipments[$i]['itemWeight'],
                            'created_dtm' => $nowDt,
                            'created_by' => $dataUser[0]["name"]
                        );
                        $shipmentsDetailModel->saveShipmentsDetail($paramShipmentsDetail);
                    }
                    return $this->response->setJSON([
                        'statusCode' => 200,
                        'message' => 'Success',
                        'object' => $shipmentsId
                    ]);
                }
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateShipments(){
        $deliveryStatus = new DeliveryStatusModel();
        date_default_timezone_set('Asia/Jakarta'); 
        $nowDt = date('Y-m-d H:i:s');
        try {
            $itemShipments = $this->request->getPost('itemShipments');
            $status = $this->request->getPost('status');
            for ($i = 0; $i < count($itemShipments); $i++) {
                $paramDelivery = array(
                    'shipment_id' => $itemShipments[$i],
                    'delivery_date' => $nowDt,
                    'status' => $status,
                    'remarks' => ''
                );
                $deliveryStatus->saveDeliveryStatus($paramDelivery);
            }
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscodex' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function printInvoice(){
        $weightRate = new MstWeightRateModel();
        $route = new MstRouteModel();
        $customer = new CustomersModel();
        $shipments = new ShipmentsModel();
        $shipmentsDetail = new ShipmentsDetailModel();
        $deliveryStatus = new DeliveryStatusModel();
        $subTotal = 0;
        try {
            $shipmentsId = 'CGK1714974756809';
            $data['shipments'] = $shipments->getShipmentsById( $shipmentsId );
            $resiCode = substr($shipmentsId, 0, 3);
            $data['route'] = $route->getRoute( $resiCode );
            $data['shipments_detail'] = $shipmentsDetail->getShipmentsDetailById( $shipmentsId );
            $weight = $weightRate->getListWeight();
            for ($i = 0; $i < count($data['shipments_detail']); $i++) {
                for ($y = 0; $y < count($weight); $y++) {
                    if ( (intval($data['shipments_detail'][$i]->weight) >= intval($weight[$y]->min_weight)) && 
                        (intval($data['shipments_detail'][$i]->weight) <= intval($weight[$y]->max_weight)) ) {
                        $subTotal += intval($data['shipments_detail'][$i]->quantity) * intval($weight[$y]->price);
                        break;
                    }
                }
            }
            $total = $subTotal + intval($data['route'][0]->price);
            $data['subTotal'] = $subTotal;
            $data['total'] = $total;
            $data['customer'] = $customer->getCustomerById( $data['shipments'][0]->customer_id );
            $data['delivery'] = $deliveryStatus->getDeliveryStatusById( $shipmentsId );
            return view('view_printout/invoice', $data);
        } catch (\Exception $e) {
            echo "<pre>"; var_dump($e); echo"</pre>";
        }
    }

}