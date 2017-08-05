<?php
declare (strict_types=1);
use PHPUnit\Framework\TestCase;
use PH\RMN\Classes\AnalyticsHelper;

final class AnalyticsHelperTest extends TestCase
{

	public function emptyTags()
	{
		$analyticsHelper = new AnalyticsHelper();
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => [], 'locations' => []];
		$this->assertEquals($expected, $result);
	}

	public function testTagsNotFound()
	{
		$tags[0] = new StdClass;
		//DZXL558	DZXL 558	DZXL-558	DZXL558Manila	DZXL558 Manila	DZXL 558 Manila
		$tags[0]->name = 'United States';
		$tags[1] = new StdClass;
		$tags[1]->name = 'Canada';
		$tags[2] = new StdClass;
		$tags[2]->name = 'New Zealand';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => [], 'locations' => []];
		$this->assertEquals($expected, $result);
	}

	public function testMergedStationTags()
	{
		$tags[0] = new StdClass;
		//DZXL558	DZXL 558	DZXL-558	DZXL558Manila	DZXL558 Manila	DZXL 558 Manila
		$tags[0]->name = 'DZXL558';
		$tags[1] = new StdClass;
		$tags[1]->name = 'DZXL 558';
		$tags[2] = new StdClass;
		$tags[2]->name = 'DZXL-558';
		$tags[3] = new StdClass;
		$tags[3]->name = 'DXMD927Gensan';
		$tags[4] = new StdClass;
		$tags[4]->name = 'DXMD927 Gensan';
		$tags[5] = new StdClass;
		$tags[5]->name = 'DXMD 927 Gensan';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => ['DZXL 558 Manila', 'DXMD 927 Gensan'], 'locations' => []];
		$this->assertEquals($expected, $result);
	}

	public function testMergedStationWithLocationTags()
	{
		$tags[0] = new StdClass;
		//DZXL558	DZXL 558	DZXL-558	DZXL558Manila	DZXL558 Manila	DZXL 558 Manila
		$tags[0]->name = 'DZXL558';
		$tags[1] = new StdClass;
		$tags[1]->name = 'DZXL 558';
		$tags[2] = new StdClass;
		$tags[2]->name = 'DZXL-558';
		$tags[3] = new StdClass;
		$tags[3]->name = 'DXMD927Gensan';
		$tags[4] = new StdClass;
		$tags[4]->name = 'DXMD927 Gensan';
		$tags[5] = new StdClass;
		$tags[5]->name = 'DXMD 927 Gensan';
		$tags[6] = new StdClass;
		$tags[6]->name = 'gen-san';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => ['DZXL 558 Manila', 'DXMD 927 Gensan'], 'locations' => ['Gensan']];
		$this->assertEquals($expected, $result);
	}


	public function testDZXL558Manila()
	{
		$tags[0] = new StdClass;
		//DZXL558	DZXL 558	DZXL-558	DZXL558Manila	DZXL558 Manila	DZXL 558 Manila
		$tags[0]->name = 'DZXL558';
		$tags[1] = new StdClass;
		$tags[1]->name = 'DZXL 558';
		$tags[2] = new StdClass;
		$tags[2]->name = 'DZXL-558';
		$tags[3] = new StdClass;
		$tags[3]->name = 'DZXL558Manila';
		$tags[4] = new StdClass;
		$tags[4]->name = 'DZXL558 Manila';
		$tags[5] = new StdClass;
		$tags[5]->name = 'DZXL 558 Manila';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => ['DZXL 558 Manila'], 'locations' => []];
		$this->assertEquals($expected, $result);
	}

	public function testDXMD927Gensan()
	{
		$tags[0] = new StdClass;
		$tags[0]->name = 'DXMD927';
		$tags[1] = new StdClass;
		$tags[1]->name = 'DXMD 927';
		$tags[2] = new StdClass;
		$tags[2]->name = 'DXMD-927';
		$tags[3] = new StdClass;
		$tags[3]->name = 'DXMD927Gensan';
		$tags[4] = new StdClass;
		$tags[4]->name = 'DXMD927 Gensan';
		$tags[5] = new StdClass;
		$tags[5]->name = 'DXMD 927 Gensan';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => ['DXMD 927 Gensan'], 'locations' => []];
		$this->assertEquals($expected, $result);
	}

	public function testSpecialCases()
	{
		$tags[0] = new StdClass;
		//General Santos	Gen San	Gen. San		gen-san
		$tags[0]->name = 'General Santos';
		$tags[1] = new StdClass;
		$tags[1]->name = 'Gen San';
		$tags[2] = new StdClass;
		$tags[2]->name = 'Gen. San';
		$tags[3] = new StdClass;
		$tags[3]->name = 'General-santos';
		$tags[4] = new StdClass;
		$tags[4]->name = 'gen-san';

		$analyticsHelper = new AnalyticsHelper($tags);
		$result = $analyticsHelper->getAnalyticsTags();
		$expected = ['stations' => [], 'locations' => ['Gensan']];
		$this->assertEquals($expected, $result);
	}

}