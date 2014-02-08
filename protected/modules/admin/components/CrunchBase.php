<?php
class CrunchBase
{
    const BASE_URL_CRUNTBASE = 'http://www.crunchbase.com';
    const API_KEY = 'xc5923aef7sehht4hxfhsbqs';

    public function loadCompanies()
    {
        try {
            $date = new DateTime();
            $date->modify('-1 month');

            $params = array(
                'advanced_search' => array(
                    'acquired_or_options' => 0,
                    'funded_or_options' =>  1,
                    'funded_or_options' =>  0,
                    'funded_round_code' =>  'all',
                    'funded_after_month' =>  $date->format('m'),
                    'funded_after_year' =>  $date->format('Y'),
                )

            );
            $params = http_build_query($params);

            $html = $this->getResponseCurl(self::BASE_URL_CRUNTBASE . '/search/advanced/companies', $params);

            preg_match('/\<a href=\"(.*)\"\>/Ui', $html, $res);

            $contentFirstPage = $this->getResponseCurl($res[1]);

            $this->parseContent($contentFirstPage);

            $paginationPageUrl = $this->getPaginationPageUrl($contentFirstPage);

            foreach ($paginationPageUrl as $pageUrl) {
                $contentPage = $this->getResponseCurl(self::BASE_URL_CRUNTBASE . $pageUrl);
                $this->parseContent($contentPage);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function parseContent($content)
    {
        foreach ($this->getPermalinkPage($content) as $permalink) {
            $infoCompany = $this->getInfoCompany($permalink);
            $this->saveCompany($infoCompany);
        }
    }

    public function getResponseCurl($url, $post = false)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($post) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }
        $html = curl_exec($curl);
        curl_close($curl);
        if (!$html) {
            throw new Exception(Yii::t('yii','Not available to CrunchBase'));
        }
        return $html;
    }

    public function getPermalinkPage($contentPage)
    {
        preg_match_all('/\<div\sclass=\"search\wresult\wname\"\>\n\t(.*)\n\t\<\/div\>/mi', $contentPage, $res);
        $rezult = array();
        for ($i = 0; $i < count($res[1]); $i++) {
            preg_match('/href=\"(.*)\"\s/i', $res[1][$i], $tmp);
            $rezult[] = $tmp[1];
        }
        return $rezult;
    }

    public function getPaginationPageUrl($contentFirstPage)
    {
        preg_match('/\<div class=\"pagination.*\>(.*)\<\/div\>/Ui', $contentFirstPage, $res);
        preg_match_all('/\<a href=\"(.*)\"/Ui', $res[1], $res);
        $pagesURL =  array_unique($res[1]);
        preg_match('/page=(.*)$/Ui', $pagesURL[count($pagesURL)-1], $res);
        preg_match('/\/search\/advanced\/companies\/(.*)page=/Ui', $pagesURL[count($pagesURL) - 1], $resa);
        $pagesURL = array();
        for($i = 2; $i <= $res[1]; $i++) {
            $pagesURL[] = $resa[0] . $i;
        }
        return $pagesURL;
    }

    public function getInfoCompany($permalink)
    {
        try {
            $infoCompany = json_decode(file_get_contents("http://api.crunchbase.com/v/1{$permalink}.js?api_key=" . self::API_KEY), true);
        } catch (Exception $e) {
            $infoCompany = false;
        }
        return  $infoCompany;
    }

    public function saveCompany($infoCompany)
    {
        try {
            if (!$infoCompany) throw new Exception(Yii::t('yii',"No information about company"));

            $date = date('Y-m-d H:i:s');

            $company = Company::model()->find('permalink=:permalink', array(':permalink'=>$infoCompany['permalink']));

            if (is_null($company)) {
                $company = new Company();
                $company->created_at_db = $date;
            }

            $created_at = new DateTime($infoCompany['created_at']);
            $updated_at = new DateTime($infoCompany['updated_at']);
            $founded = date('Y-m-d H:i:s', mktime(0, 0, 0, $infoCompany['founded_month'], $infoCompany['founded_day'], $infoCompany['founded_year']));

            $company->name = $infoCompany['name'];
            $company->permalink = $infoCompany['permalink'];
            $company->homepage_url = $infoCompany['homepage_url'];
            $company->twitter_username = $infoCompany['twitter_username'];
            $company->number_of_employees = $infoCompany['number_of_employees'];
            $company->founded = $founded;
            $company->tag_list = $infoCompany['tag_list'];
            $company->email_address = $infoCompany['email_address'];
            $company->phone_number = $infoCompany['phone_number'];
            $company->description = $infoCompany['description'];
            $company->created_at = $created_at->format('Y-m-d H:i:s');
            $company->updated_at = $updated_at->format('Y-m-d H:i:s');
            $company->total_money_raised = $infoCompany['total_money_raised'];
            $company->funding_rounds = serialize($infoCompany['funding_rounds']);
            $company->offices = serialize($infoCompany['offices']);
            $company->updated_at_db = $date;

            if ($company->save()) {
                if (!empty($infoCompany['relationships'])) {
                    foreach($infoCompany['relationships'] as $infoPerson) {
                        $person = Person::model()->find(
                            'permalink=:permalink', array(':permalink' => $infoPerson['person']['permalink'])
                        );
                        if (is_null($person)) {
                            $person = new Person();
                            $person->first_name = $infoPerson['person']['first_name'];
                            $person->last_name = $infoPerson['person']['last_name'];
                            $person->permalink = $infoPerson['person']['permalink'];
                            $person->created_at_db = $date;
                            $person->updated_at_db = $date;
                            $person->save();
                        }
                        $personCompany = PersonCompany::model()->find(
                            'person_id=:person_id and company_id=:company_id',
                            array(
                                ':person_id'=>$person->id,
                                ':company_id'=>$company->id
                            )
                        );
                        if (is_null($personCompany)) {
                            $personCompany = new PersonCompany();
                        }
                        $personCompany->person_id = $person->id;
                        $personCompany->company_id = $company->id;
                        $personCompany->position = $infoPerson['title'];
                        $personCompany->status = $personCompany::STATUS_WORK;
                        $personCompany->save();
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function LoadInfoPerson($id)
    {
        try {
            $person = Person::model()->findByPk($id);

            $infoPerson = json_decode(file_get_contents("http://api.crunchbase.com/v/1/person/{$person->permalink}.js?api_key=".self::API_KEY), true);

            $created_at = new DateTime($infoPerson['created_at']);
            $updated_at = new DateTime($infoPerson['updated_at']);

            $person->first_name = $infoPerson['first_name'];
            $person->last_name = $infoPerson['last_name'];
            $person->permalink = $infoPerson['permalink'];
            $person->twitter_username = $infoPerson['twitter_username'];
            $person->created_at = $created_at->format('Y-m-d H:i:s');
            $person->updated_at = $updated_at->format('Y-m-d H:i:s');
            $person->updated_at_db = date('Y-m-d H:i:s');

            $person->save();

        } catch (Exception $e)  {
            echo $e->getMessage();
        }
    }

}