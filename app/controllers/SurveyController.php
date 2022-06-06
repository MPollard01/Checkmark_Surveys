<?php

namespace App\Controllers;

use App\Models\Survey;
use App\Classes\Request;
use App\Classes\Redirect;
use App\Classes\Session;
use App\Models\EmailForm;
use App\Models\Response;

class SurveyController extends BaseController
{
    public function index()
    {
        $data['surveys'] = Survey::get();

        foreach($data['surveys'] as $value)
        {
            $resCount = Response::getResponseCount($value[0]);
            $data['count'][] = $resCount[0];
        }
        
        $this->useView('surveys', $data)->render();
    }

    public function showSurveyForm()
    {
        $this->useView('createsurvey')->render();
    }

    public function sendSurvey()
    {
        $survey = new Survey();
        if (Request::getMethod() === 'post') {
            $survey->loadData(Request::getJson());
            if($survey->save()) {
                echo "surveys/edit/$survey->id";
            } else {
                echo "failed";
            }
        }
    }

    public function sendEmail()
    {
        $emailForm = new EmailForm();
        if (Request::getMethod() === 'post') {
            $emailForm->loadData(Request::getJson());
            if($emailForm->validate() && $emailForm->send()) {
                echo var_dump($emailForm);
            }
            
        }
    }

    public function edit($id)
    {
        $survey['survey'] = Survey::getSingle($id['id']);
        $this->useView('editsurvey', $survey)->render();
    }

    public function editSurvey($id)
    {
        $survey = new Survey();
        $survey->id = $id['id'];
        if (Request::getMethod() === 'post') {
            $survey->loadData(Request::getJson());
            if($survey->update()) {
                echo "surveys/edit/$survey->id";
            } else {
                echo "failed";
            }
        }
    }

    public function response($id)
    {
        $survey['survey'] = Survey::getSingle($id['id']);
        $this->useView('respond', $survey)->render();
    }

    public function sendResponse()
    {
        $response = new Response();
        if (Request::getMethod() === 'post') {
            $response->loadData(Request::getJson());
            echo var_dump($response->answers[0]);
            if($response->save()) {
                echo var_dump($response);
            } else {
                echo "failed";
            }
        }
    }

    public function getResponse($id)
    {
        $this->useView('responses')->render();
    }

    public function getJsonResponse($id)
    {
        $data['answers'] = Response::fetchResponses($id['id']);
        $data['questions'] = Survey::getSingle($id['id']);

        echo json_encode($data);
    }

    public function deleteSurvey($id)
    {
        Survey::delete($id['id']);
    }
}