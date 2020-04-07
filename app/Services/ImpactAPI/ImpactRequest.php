<?php

namespace App\Services\ImpactAPI;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;  // TODO: rmove dependency using composition

abstract class ImpactRequest
{
    protected $service;
    protected $username;
    protected $password;
    protected $apiToken;
    public $requestBody;
	public $baseUri = 'https://api.impactexpress.co.uk/api/';
	public $endpoints = [
		'UPLOAD_MANIFEST' => 'UploadManifest',
	];

	public function __construct()
	{
		$this->username = config('app.impact_username');
        $this->password = config('app.impact_account_number');
		$this->apiToken = config('app.impact_api_token');
		$this->service = 'UPLOAD_MANIFEST';
	}

	abstract public function buildRequestBody($shipmentData);

	public function send()
	{
		$client = new Client();
		$response = $client->post($this->baseUri.$this->endpoints[$this->service], [
			'headers' => [
				'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $this->apiToken,
			],
			'body' => $this->requestBody
		]);
		return json_decode($response->getBody()->getContents());
	}
}
