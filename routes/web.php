<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use App\Http\Middleware\AllowDotsInUrlMiddleware;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/audiosall/{id_ca}', 'AudioController@index');
$router->post('/audios/new', 'AudioController@create');
$router->get('/audios/{id}', 'AudioController@show');
$router->put('/audios/update/{id:[0-9]+}', 'AudioController@update');
$router->delete('/audios/delete/{id}', 'AudioController@destroy');
$router->get('/audiogetnomid','AudioController@getNomId');
$router->get('/audiobyemail/{email_aud}', 'AudioController@getbyemail');

$router->get('/patient', 'PatientController@index');
$router->get('/patient/{id:[0-9]+}/{id_ca:[0-9]+}', 'PatientController@show');
$router->post('/patient/new/{id_ca}', 'PatientController@create');
$router->get('/patientbynom/{nom_pat}', 'PatientController@getByNom');
$router->get('/patientgetnom/{centreAudio}','PatientController@getNom');
$router->get('/patientgetidbynom/{nom_pat}','PatientController@getIdByNom');
$router->get('/patientrequest/{id_ca}', 'PatientController@getPatientRequest');
$router->put('/patient/update/{id}', 'PatientController@update');
$router->get('/patientcount/{id_ca}', 'PatientController@patientCount');
$router->get('/autocomplete/{id_ca}/{query}', 'PatientController@autocomplete');


$router->get('/typeappareil', 'TypeAppareilController@index');
$router->get('/typeappareil/typeappareil', 'TypeAppareilController@getTypeAppareil');
$router->get('/typeappareil/getidbytypeappareil/{typeAppareil}', 'TypeAppareilController@getIdByTypeAppareil');
$router->get('/typeappareil/{id}', 'TypeAppareilController@show');
$router->post('/typeappareil/new', 'TypeAppareilController@create');



$router->get('/fabriquant','FabriquantController@index');
$router->get('/fabriquant/nomfab', 'FabriquantController@getNomFab');
$router->get('/fabriquant/getidbynomfab/{nom_fab}', 'FabriquantController@getIdByNomFab');
$router->get('/fabriquant/{id}','FabriquantController@show');
$router->get('/fabricant/idnomfab','FabriquantController@getIdNomFab');
$router->post('/fabriquant/new','FabriquantController@create');

$router->get('/fabtype', 'FabTypeController@index');

$router->get('/modaud/{centreAudio}', 'ModeleAudioController@index');

$router->get('/appareil','AppareilController@index');
$router->get('/appreilidbymodele/modele_app/{modele_app}','AppareilController@getIdByModeleApp');
$router->get('/appareil/getmodele', 'AppareilController@getModele');
$router->get('/appareil/getmodeleid','AppareilController@getModeleId');
$router->get('/appareil/{id}','AppareilController@show');
$router->get('/appareil/getappbyfab/{id_fab}','AppareilController@getAppByAppareil');
$router->post('/appareil/new', 'AppareilController@create');

$router->get('/centreaudio', 'CentreAudioController@index');
$router->get('/centreaudio/{id}', 'CentreAudioController@show');
$router->post('/centreaudio/new', 'CentreAudioController@create');
$router->get('/centreaudiobyemail/{email_ca}', 'CentreAudioController@getByEmail');

$router->get('/calendar/calendarpatient/{id_pat}', 'CalendarController@calendarPatient');
$router->get('/calendar/{id_ca}/{id_cab}', 'CalendarController@index');
$router->post('/calendar/new', 'CalendarController@create');
$router->put('/calendar/{id}/edit', 'CalendarController@edit');
$router->put('/calendar/{id}/editetat', 'CalendarController@editetat');


$router->get('/todolist/{id_ca}', 'ToDoListController@index');
$router->get('/todolist/delete/{id}', 'ToDoListController@destroy');
$router->post('/todolist/new','ToDOListController@create');
$router->get('/todolist/show/{id}', 'ToDoListController@show');

$router->get('/question', 'QuestionController@index');
$router->get('/question/{id}', 'QuestionController@show');
$router->post('/question/new', 'QuestionController@create');

$router->get('/mcq','MCQController@index');
$router->get('/mcq/{id}','MCQController@show');
$router->post('/mcq/new','MCQController@create');

$router->get('/questionaddmcq', 'QuestionAddMCQController@index');
$router->get('/questionaddmcq/{id_mcq}', 'QuestionAddMCQController@show');
$router->post('/questionaddmcq/new','QuestionAddMCQController@create');
$router->get('/questionaddmcq/delete/{id}','QuestionAddMCQController@destroy');


$router->get('/patientaddmcq', 'PatientAddMCQController@index');
$router->get('/patientaddmcq/{id_mcq}', 'PatientAddMCQController@show');
$router->post('/patientaddmcq/new','PatientAddMCQController@create');
$router->get('/patientaddmcq/delete/{id}','PatientAddMCQController@destroy');
$router->put('/patientaddcmq/edit/{id}','PatientAddMCQController@edit');
$router->get('/patientaddcmq/bypat/{id_pat}','PatientAddMCQController@mcqByPatient');


$router->get('/notepatient','NotePatientController@index');
$router->get('/notepatient/bypatient/{id_pat}','NotePatientController@byPatient');
$router->post('/notepatient/new','NotePatientController@create');
$router->get('/notepatient/delete/{id}','NotePatientController@destroy');


$router->get('/sponsorship/godfather/{id_pat}','SponsorshipController@godfather');
$router->get('/sponsorship/godson/{id_pat}','SponsorshipController@godson');
$router->get('/sponsorship','SponsorshipController@index');


$router->get('/stockappareil/bypatient/{id_pat}','StockAppareilController@bypatient');
$router->get('/stockappareil/{id_ca}/{id_cab}/{condition}','StockAppareilController@index');
$router->get('/stockappareil/{id_ca}/{id_cab}/{id_fab}/{condition}','StockAppareilController@byfab');
//$router->get('/stockappareil/modele/{id_ca}/{id_cab}/{id_app}','StockAppareilController@bymodele');
$router->get('/stockappareil/modele/{id_ca}/{id_cab}/{id_app}/{condition}','StockAppareilController@bymodele');
$router->get('/stockappareilautocomplete/{id_ca}/{id_cab}/{query}','StockAppareilController@autocomplete');
$router->post('/stockappareil/new','StockAppareilController@create');
$router->put('/stockappareil/update/{numero_serie}/{condition}', 'StockAppareilController@update');
$router->put('/stockappareil/updateCabinet/{cabinet}','StockAppareilController@updateCabinet');


$router->get('/patientappareil/{id_pat}','PatientAppareilsController@getappareilbypatient');
$router->post('/patientappareil/new','PatientAppareilsController@create');
