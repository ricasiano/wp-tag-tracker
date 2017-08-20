<?php
namespace PH\RMN\Classes;

class AnalyticsHelper
{
	private $tags;
	private $stations = [
		'DZXL 558 Manila' => 'dzxl558',
		'DXMD 927 Gensan' => 'dxmd927',	
		'DYHB 747 Bacolod' => 'dyhb747',
		'DYHP 612 Cebu' => 'dyhp612',
		'DZXL 558 Manila' => 'dzxl558',
		'DWNX 1611 Naga' => 'dwnx1611',
		'DYHB 747 Bacolod' => 'dyhb747',
		'DYHP 612 Cebu' => 'dyhp612',
		'DYRI 774 Iloilo' => 'dyri774',
		'DYKR 1161 Kalibo' => 'dykr1161',
		'DYVR 657 Roxas' => 'dyvr657',
		'DXBC 693 Butuan' => 'dxbc693',
		'DXCC 828 CDO' => 'dxcc828',
		'DXMY 729 Cotabato' => 'dxmy729',
		'DXDC 621 Davao' => 'dxdc621',
		'DXDR 981 Dipolog' => 'dxdr981',
		'DXMD 927 Gensan' => 'dxmd927',
		'DXIC 711 Iligan' => 'dxic711',
		'DXKR 639 Koronadal' => 'dxkr639',
		'DXMB 648 Malaybalay' => 'dxmb648',
		'DXPR 603 Pagadian' => 'dxpr603',
		'DXRS 918 Surigao' => 'dxrs918',
		'DXRZ 900 Zamboanga' => 'dxrz900',
		'iFM 103.9 Baguio' => 'ifmbaguio',
		'iFM 104.7 Dagupan' => 'ifmdagupan',
		'iFM 99.5 Laoag' => 'ifmlaoag',
		'iFM 93.9 Manila' => 'ifmmanila',
		'iFM 91.1 Naga' => 'ifmnaga',
		'DWKD 98.5 Cauayan' => 'dwkd985',
		'iFM 94.3 Bacolod' => 'ifmbacolod',
		'iFM 93.9 Cebu' => 'ifmcebu',
		'iFM 95.1 Iloilo' => 'ifmiloilo',
		'DYXY 99.1 Tacloban' => 'dyxy991',
		'iFM 99.1 CDO' => 'ifmcdo',
		'iFM 93.9 Davao' => 'ifmdavao',
		'iFM 91.9 Gensan' => 'ifmgensan',
        'iFM 96.3 Zamboanga' => 'ifmzamboanga',
        'RMN News Nationwide The Sound of the Nation' => 'rmnnewsnationwidethesoundofthenation'
		];
	private $locations = [
			'LUZON' => 'luzon',
			'VISAYAS' => 'visayas',
			'MINDANAO' => 'mindanao',
			'Bacolod' => 'bacolod',
			'Baguio' => 'baguio',
			'Butuan' => 'butuan',
			'Manila' => 'manila',
			'CDO' => 'cdo',
			'Cebu' => 'cebu',
			'Cotabato' => 'cotabato',
			'Gensan' => 'gensan',
			'Dagupan' => 'dagupan',
			'Davao' => 'davao',
			'Dipolog' => 'dipolog',
			'Tacloban' => 'tacloban',
			'Iligan' => 'iligan',
			'Iloilo' => 'iloilo',
			'Kalibo' => 'kalibo',
			'Koronadal' => 'koronadal',
			'Laoag' => 'laoag',
			'Cauayan' => 'cauayan',
			'Malaybalay' => 'malaybalay',
			'Naga' => 'naga',
			'Pagadian' => 'pagadian',
			'Zamboanga' => 'zamboanga',
			'Roxas' => 'roxas',
			'Surigao' => 'surigao',
			'Lucena' => 'lucena',
			'Palawan' => 'palawan',
			'Vigan' => 'vigan',
			'Dumaguete' => 'dumaguete',
			'Masbate' => 'masbate',
			'Ozamis' => 'ozamis',
			'Daet' => 'daet',
			'Palawan' => 'palawan',
			'Sorsogon' => 'sorsogon',
			'Angeles' => 'angeles'
	];

	private $specialMappings = [
		'Cagayan de Oro' => 'CDO',
		'Cagayan-de-oro' => 'CDO',
		'General Santos' => 'Gensan',
		'Gen San' => 'Gensan',
		'Gen. San' => 'Gensan',
		'General-santos' => 'Gensan',
		'gen-san' => 'Gensan'
	];



    private $analyticsTags = array();
    public function __construct($tags = []) 
    {
        if (is_array($tags)) {
            $this->tags = $tags;
            $this->buildTags();
        }
    }

    private function buildTags()
    {
   		$this->analyticsTags['stations'] = [];
        $this->analyticsTags['locations'] = [];
        foreach ($this->tags as $tag)
        {
            $tagName = strtolower(str_replace(' ', '', $tag->name));
            $tagName = str_replace('-', '', $tagName);
            $tagInList = $this->tagInList($this->stations, $tagName);
            if(false !== $tagInList){
                $this->analyticsTags['stations'][] = $tagInList;
            }
            $tagInList = array_search($tagName, $this->locations);
            if(false !== $tagInList){
                $this->analyticsTags['locations'][] = $tagInList;
            }
            if (array_key_exists($tag->name, $this->specialMappings)){
            	$this->analyticsTags['locations'][] = $this->specialMappings[$tag->name];
            }
            
        }
        $this->analyticsTags['stations'] = array_values(array_unique($this->analyticsTags['stations'])); 
        $this->analyticsTags['locations'] = array_values(array_unique($this->analyticsTags['locations'])); 
    }

    private function tagInList($list, $tagName) 
    {
		foreach ($list as $key => $val) {
			if (strstr($tagName, $val)) {
				return $key;
			}
		}
		return false;
    }

    public function getAnalyticsTags()
    {	
        return $this->analyticsTags;
    }
}
