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

class ShipmentPackageController extends BaseController  {

    public function index()  {
        $data['pageTitle'] = 'Shipment Package';
        $data['menu'] = 'shipping-package';
        $session = session();
        if ($session->has('dataUser')) {
            $data['dataUser'] = array_values(session('dataUser'));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return   view('view_modal/shipping/proccessUpdate')
                .view('view_menu/view_shipping_package', $data);
        }
    }

    public function getDeliveryStatus(){
        $deliveryStatusModel = new DeliveryStatusModel();
        $result;
        try {
            $delivArea = $this->request->getPost('delivArea');
            $startDate = $this->request->getPost('startDate');
            $endDate = $this->request->getPost('endDate');
            $result = $deliveryStatusModel->getDeliveryStatus( $delivArea,$startDate,$endDate );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

}