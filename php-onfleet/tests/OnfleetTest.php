<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Onfleet\CurlClient;
use Onfleet\Onfleet;

class OnfleetTest extends TestCase
{

	/**
	 * @dataProvider data
	 */
	public function testAuth($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('authenticate')->willReturn(true);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		self::assertTrue($onfleet->verifyKey());
	}

	/**
	 * @dataProvider data
	 */
	public function testAdministrators($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["list"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->administrators->get();
		self::assertIsArray($response);
		self::assertSame(count($response), 2);
		self::assertSame($response[0]["email"], 'james@onfleet.com');
		self::assertSame($response[0]["type"], 'super');
		self::assertSame($response[1]["email"], 'wrapper@onfleet.com');
		self::assertSame($response[1]["type"], 'standard');
	}

	/**
	 * @dataProvider data
	 */
	public function testTasks($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["get"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->get('SxD9Ran6pOfnUDgfTecTsgXd');
		self::assertIsArray($response);
		self::assertSame($response["id"], "SxD9Ran6pOfnUDgfTecTsgXd");
		self::assertSame($response["notes"], "Onfleet API Wrappers!");
	}

	/**
	 * @dataProvider data
	 */
	public function testTaskByShortId($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["get"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->get('44a56188', 'shortId');
		self::assertIsArray($response);
		self::assertSame($response["shortId"], "44a56188");
		self::assertSame($response["trackingURL"], "https://onf.lt/44a56188");
	}

	/**
	 * @dataProvider data
	 */
	public function testRecipientByPhoneNumber($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getRecipients"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->recipients->get('+18881787788', 'phone');
		self::assertIsArray($response);
		self::assertSame($response["phone"], "+18881787788");
		self::assertFalse($response["skipSMSNotifications"]);
	}

	/**
	 * @dataProvider data
	 */
	public function testRecipientByPhoneName($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getRecipients"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->recipients->get('Onfleet Rocks', 'name');
		self::assertIsArray($response);
		self::assertSame($response["name"], "Onfleet Rocks");
	}

	/**
	 * @dataProvider data
	 */
	public function testCreateTeams($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["createTeams"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->teams->create([
			"name" => 'Onfleet Team',
			"workers" => [
				'1LjhGUWdxFbvdsTAAXs0TFos',
				'F8WPCqGmQYWpCkQ2c8zJTCpW',
			],
			"managers" => [
				'Mrq7aKqzPFKX22pmjdLx*ohM',
			],
			"hub" => 'tKxSfU7psqDQEBVn5e2VQ~*O',
		]);
		self::assertIsArray($response);
		self::assertSame($response["name"], "Onfleet Team");
	}

	/**
	 * @dataProvider data
	 */
	public function testWorkerEta($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["getWorkerEta"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->teams->getWorkerEta('SxD9Ran6pOfnUDgfTecTsgXd', [
			"dropoffLocation" => '101.627378,3.1403995',
			"pickupLocation" => '101.5929671,3.1484824',
			"pickupTime" => '1620965258',
		]);
		self::assertIsArray($response);
		self::assertSame($response["steps"][0]["arrivalTime"], 1621339297);
	}

	/**
	 * @dataProvider data
	 */
	public function testForceComplete($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["forceComplete"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->forceComplete('6Fe3qqFZ0DDwsM86zBlHJtlJ', [
			"completionDetails" => [
				"success" => true,
				"notes" => 'Forced complete by Onfleet Wrapper',
			]
		]);
		self::assertIsArray($response);
		self::assertSame($response["completionDetails"]["notes"], 'Forced complete by Onfleet Wrapper');
	}

	/**
	 * @dataProvider data
	 */
	public function testUpdateWorker($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["updateWorkers"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->workers->update('Mdfs*NDZ1*lMU0abFXAT82lM', [
			"name" => 'Stephen Curry',
			"phone" => '+18883133131',
		]);
		self::assertIsArray($response);
		self::assertSame($response["name"], 'Stephen Curry');
		self::assertSame($response["phone"], '+18883033030');
	}

	/**
	 * @dataProvider data
	 */
	public function testDeleteTask($data)
	{
		$curlClient = $this->createMock(CurlClient::class);
		$curlClient->method('execute')->willReturn(["code" => 200, "success" => true, "data" => $data["deleteTask"]]);
		$onfleet = new Onfleet($data["apiKey"], 70000, null);
		$onfleet->api->client = $curlClient;
		$response = $onfleet->tasks->deleteOne('AqzN6ZAq*qlSDJ0FzmZIMZz~');
		self::assertIsNumeric($response);
		self::assertSame($response, 200);
	}

	public function data()
	{
		return include("Response.php");
	}
}
