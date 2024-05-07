<?php

namespace App\Controllers;
use App\Models\MstRouteModel;
use App\Models\MstWeightRateModel;

class MasterController extends BaseController
{
    
    public function index()  {
        $data['pageTitle'] = 'Data Master';
        $data['menu'] = 'master';
        $session = session();
        if ($session->has('dataUser')) {
            $data['dataUser'] = array_values(session('dataUser'));
            $data["profileMenu"] = array_values(session("profileMenu"));
            return  view('view_modal/master/editRoute')
                .view('view_modal/master/editWeight')
                .view('view_menu/view_master', $data);
        }
    }

    public function getRoute()  {
        $route = new MstRouteModel();
        $result;
        try {
            $code = $this->request->getPost('code');
            $result = $route->getRoute( $code );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function getListRoute()  {
        $route = new MstRouteModel();
        try {
            $result = $route->getListRoute();
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success',
                'object' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    } 

    public function saveRoute(){
        $route = new MstRouteModel();
        try {
            $shipment_code = $this->request->getPost('shipment_code');
            $destination = $this->request->getPost('destination');
            $duration = $this->request->getPost('duration');
            $price = $this->request->getPost('price');
            $param = array(
                'shipment_code' => $shipment_code,
                'destination' => $destination,
                'duration' => intval($duration),
                'price' => intval($price)
            );
            if ( !$route->saveRoute($param) ) {
                return $this->response->setJSON([
                    'statuscode' => 500,
                    'message' => 'Failed'
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

    public function updateRoute()  {
        $route = new MstRouteModel();
        try {
            $shipment_code = $this->request->getPost('shipment_code');
            $destination = $this->request->getPost('destination');
            $duration = $this->request->getPost('duration');
            $price = $this->request->getPost('price');
            $param = array(
                'shipment_code' => $shipment_code,
                'destination' => $destination,
                'duration' => $duration,
                'price' => $price
            );
            if ( $route->updateRoute($param) ) {
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
    
    public function deleteRoute()  {
        $route = new MstRouteModel();
        try {
            $code = $this->request->getPost('code');
            if ( $route->deleteRoute($code) ) {
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

    public function getListWeight()  {
        $weight = new MstWeightRateModel();
        try {
            $result = $weight->getListWeight();
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'Success',
                'object' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    } 

    public function saveWeight(){
        $weight = new MstWeightRateModel();
        try {
            $minWeight = $this->request->getPost('minWeight');
            $maxWeight = $this->request->getPost('maxWeight');
            $price = $this->request->getPost('price');
            $param = array(
                'min_weight' => intval($minWeight),
                'max_weight' => intval($maxWeight),
                'price' => intval($price)
            );
            if ( !$weight->saveWeight($param) ) {
                return $this->response->setJSON([
                    'statuscode' => 500,
                    'message' => 'Failed'
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

    public function deleteWeight()  {
        $weight = new MstWeightRateModel();
        try {
            $id = $this->request->getPost('id');
            if ( $weight->deleteWeight($id) ) {
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

    public function updateWeight()  {
        $weight = new MstWeightRateModel();
        try {
            $id = $this->request->getPost('id');
            $minWeight = $this->request->getPost('minWeight');
            $maxWeight = $this->request->getPost('maxWeight');
            $price = $this->request->getPost('price');
            $param = array(
                'id' => $id,
                'min_weight' => intval($minWeight),
                'max_weight' => intval($maxWeight),
                'price' => intval($price)
            );
            if ( $weight->updateWeight($param) ) {
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

    public function getWeight()  {
        $weight = new MstWeightRateModel();
        $result;
        try {
            $id = $this->request->getPost('id');
            $result = $weight->getWeight( $id );
            return $this->response->setJSON([
                'statuscode' => 200,
                'message' => 'success',
                'object' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'statuscode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

}
