<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TallyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // Create a Guzzle client instance
        $client = new Client();

        // Define the API endpoint
        $url = 'http://127.0.0.1:9000/';
        $xmlData = '<ENVELOPE>

        <HEADER>

               <TALLYREQUEST>Import Data</TALLYREQUEST>

        </HEADER>

        <BODY>

        <IMPORTDATA>

                  <REQUESTDESC>

                      <REPORTNAME>All Masters</REPORTNAME>

                  </REQUESTDESC>

                  <REQUESTDATA>

                      <TALLYMESSAGE xmlns:UDF="TallyUDF">

                             <GROUP Action="Create">

                                <NAME>North Zone Debtors</NAME>
                                <PARENT>Sundry Debtors</PARENT>


                             </GROUP>

                     </TALLYMESSAGE>

                  </REQUESTDATA>

        </IMPORTDATA>

        </BODY>

        </ENVELOPE>'; // Your XML data here

        try {
            // Send a POST request with XML data
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/xml',
                ],
                'body' => $xmlData,
            ]);

            // Get response body or other data if needed
            $body = $response->getBody();
// return $body;
            $xml = simplexml_load_string( $body );

            // Convert SimpleXMLElement to JSON
            $json = json_encode($xml);
            return $json;
            // $data = json_decode($json);
            // foreach($data->BODY->DATA->COLLECTION->LEDGER  as $key=> $item){
            //     echo $item->{'LANGUAGENAME.LIST'}->{'NAME.LIST'}->NAME;
            // }
            // Return JSON response
            //return dd($data->body);
           // return $data->BODY->DATA->COLLECTION->LEDGER;

            // Process the response as needed
        } catch (GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions if the request fails
            echo 'Request failed: ' . $e->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Create a Guzzle client instance
        $client = new Client();

        // Define the API endpoint
        $url = 'http://127.0.0.1:9000/';
        $xmlData = '<ENVELOPE>

        <HEADER>

               <VERSION>1</VERSION>

               <TALLYREQUEST>EXPORT</TALLYREQUEST>

               <TYPE>COLLECTION</TYPE>
               <ID >List of Groups</ID>

        </HEADER>

        <BODY>

        </BODY>

 </ENVELOPE>'; // Your XML data here

        try {
            // Send a POST request with XML data
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/xml',
                ],
                'body' => $xmlData,
            ]);

            // Get response body or other data if needed
            $body = $response->getBody();
            $xml = simplexml_load_string( $body );

            // Convert SimpleXMLElement to JSON
            $json = json_encode($xml);
            $data = json_decode($json);
            return $data;
            foreach($data->BODY->DATA->COLLECTION->LEDGER  as $key=> $item){
                echo $item->{'LANGUAGENAME.LIST'}->{'NAME.LIST'}->NAME;
            }
            // Return JSON response
            //return dd($data->body);
           // return $data->BODY->DATA->COLLECTION->LEDGER;

            // Process the response as needed
        } catch (GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions if the request fails
            echo 'Request failed: ' . $e->getMessage();
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
