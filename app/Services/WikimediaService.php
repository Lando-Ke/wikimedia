<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WikimediaService
{
    protected $lang = 'en';

    public function setLang($newLang)
    {
        $this->lang = $newLang;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function search($query)
    {
        $content = $this->getContent(ucwords($query));
        if ($content){
            $description = $content;
            return ['status' => 'success', 'short_description' => $description];
        } else {
            return ['status' => 'failed', 'message' => "Sorry! We could not find a description for {$query}"];
        }
    }

    public function getContent($queryString)
    {
        //TODO: Add caching for search query to avoid having to ping the API for repeat searches

        $url = "https://{$this->getLang()}.wikipedia.org/w/api.php?action=query&prop=revisions&titles={$queryString}&rvlimit=1&formatversion=2&format=json&rvprop=content";
        $response = Http::get($url)->json()['query']['pages'][0];

        if (isset($response['revisions'])) {
            //return $response['revisions'][0]['content'];
            $firstLine = strtok($response['revisions'][0]['content'], "\n");
            //Edge case for Typo redirects
            if (str_contains(strtolower($firstLine), 'redirect')) {
                //clean new input
                $newQueryString = str_replace(["#redirect ", "#REDIRECT ", "[[", "]]"],"", $firstLine);
                return $this->getContent($newQueryString);
            }
            return str_replace(["short description", "{{", "}}", "|"],"", $firstLine);
        } else {
            return false;
        }
    }
}
