<?php
namespace PH\RMN\Classes;

class AnalyticsHelper
{
	private $tags;
	private $stations = array(
			'dzxl558',
			'dwnx1611',
			'dyhb747',
			'dyhp612',
			'dyri774',
			'dykr1161',
			'dyvr657',
			'dxbc693',
			'dxcc828',
			'dxmy729',
			'dxdc621',
			'dxdr981',
			'dxmd927',
			'dxic711',
			'dxkr639',
			'dxmb648',
			'dxpr603',
			'dxrs918',
			'dxrz900',
			'dwkd985',
			'ifmbaguio',
			'ifmdagupan',
			'ifmlaoag',
			'ifmmanila',
			'ifmnaga',
			'ifmbacolod',
			'ifmcebu',
			'ifmiloilo',
			'ifmtacloban',
			'ifmcdo',
			'ifmdavao',
			'ifmgensan',
			'ifmzamboanga',	
			);
	private $locations = array(
			'luzon',
			'visayas',
			'mindanao',
			'bacolod',
			'baguio',
			'butuan',
			'cauayan',
			'cdo',
			'cebu',
			'cotabato',
			'dagupan',
			'davao',
			'dipolog',
			'gensan',
			'iligan',
			'iloilo',
			'kalibo',
			'koronadal',
			'laoag',
			'malaybalay',
			'manila',
			'naga',
			'pagadian',
			'roxas',
			'surigao',
			'tacloban',
			'zamboanga',);



    private $analyticsTags = array();
    public function __construct($tags) 
    {
        if (is_array($tags)) {
            $this->tags = $tags;
            $this->buildTags();
        }
    }

    private function buildTags()
    {
        foreach ($this->tags as $tag)
        {
            $tagName = strtolower(str_replace(' ', '', $tag->name));
            if(in_array($tagName, $this->stations)){
                $this->analyticsTags['stations'][] = $tag->name;
            }
            if(in_array($tagName, $this->locations)){
                $this->analyticsTags['locations'][] = $tag->name;
            }
        } 
    }

    public function getAnalyticsTags()
    {
        return $this->analyticsTags;
    }
}
