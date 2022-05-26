<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use SoapClient;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class BrightOfficeService
{
    const ERR_UNKNOWN = 1;

    /**
     * EPIC WARNING:
     * This was lift-and-shifted from the old website which was in turn stolen from the example docs.
     * This code is horrific.
     */

    private function generateXML(Customer $customer, $forcePotential = false)
    {
        // Generate an example XML

        $title     = htmlentities($customer->title);
        $firstname = htmlentities($customer->first_name);
        $othername = htmlentities($customer->middle_names);
        $lastname  = htmlentities($customer->last_name);

        try {
            $sourceName = isset($customer->utm_source) ? htmlentities($customer->utm_source) : 'Direct';
        } catch (\Exception $e) {
            Log::info($e->getMessage() . ' File: ' . $e->getFile() . ', Line: ' . $e->getLine());

            $sourceName = '';
        }

        $dob = htmlentities(Carbon::parse($customer->dob)->format('d/m/Y'));

        $previousname = htmlentities($customer->previous_first_name . ' ' . $customer->previous_last_name);

        $address1 = htmlentities($customer->currentAddress->line_1);
        $address2 = '';

        if ($customer->currentAddress->line_2 != '') {
            $address2 .= htmlentities($customer->currentAddress->line_2);

            if ($customer->currentAddress->line_3 != '') {
                $address2 .= ', ' . htmlentities($customer->currentAddress->line_3);
            }
        }

        $city     = htmlentities($customer->currentAddress->city);
        $county   = htmlentities($customer->currentAddress->county);
        $postcode = htmlentities($customer->currentAddress->postcode);

        $email = htmlentities($customer->email);

        $hometel   = htmlentities($customer->telephone_home);
        $worktel   = htmlentities($customer->telephone_work);
        $mobiletel = htmlentities($customer->telephone_mobile);

        $marketingEmail     = $customer->optin_email ? 'Yes' : 'No';
        $marketingSms       = $customer->optin_sms ? 'Yes' : 'No';
        $marketingTelephone = $customer->optin_telephone ? 'Yes' : 'No';
        $marketingPost      = $customer->optin_post ? 'Yes' : 'No';

        $iva = $customer->in_iva > 0 ? 'Yes' : 'No';
        $dmp = $customer->in_dmp > 0 ? 'Yes' : 'No';

        $specialcircumstances = $customer->should_be_aware ? 'No' : 'Yes';

        $resumeLink = htmlentities("https://carloanrefunds.co.uk/resume/" . urlencode($customer->resume_token));

        $previousAddresses = array();
        foreach ($customer->previousAddresses as $previousAddress) {
            $prevaddress1 = htmlentities($previousAddress->line_1);
            $prevaddress2 = htmlentities($previousAddress->line_2);
            $prevcity     = htmlentities($previousAddress->city);
            $prevcounty   = htmlentities($previousAddress->county);
            $prevpostcode = htmlentities($previousAddress->postcode);

            $previousAddresses[] = <<<XML
        <PreviousAddress>
            <Address1>$prevaddress1</Address1>
            <Address2>$prevaddress2</Address2>
            <Address3>$prevcity</Address3>
            <Address4>$prevcounty</Address4>
            <Postcode>$prevpostcode</Postcode>
        </PreviousAddress>
XML;
        }
        $previousAddressesXml = implode("\n", $previousAddresses);

        $cases = array();
        if ($customer->loans->count() === 0 || $forcePotential) {
            if ($customer->partialLoans->count() == 0) {
                $partialLoan         = new \stdClass();
                $partialLoan->loans  = 0;
                $partialLoan->lender = 'Page1Only';

                if ($customer->esigned_ts) {
                    $partialLoan->lender = 'Esigned';
                }

                $customer->partialLoans = [
                    $partialLoan
                ];
            }

            if ($customer->esigned_ts) {
                $loaFile      = 'loa.pdf';
                $contractFile = 'contract.pdf';
            } else {
                $loaFile      = 'Not completed yet';
                $contractFile = 'Not completed yet';
            }

            foreach ($customer->partialLoans as $loan) {
                $totalloans   = $loan->loans;
                $loanprovider = $loan->lender;

                $cases[] = <<<XML
    <Case>
        <CreateCase>1</CreateCase>
        <UserName>Simon Hatch</UserName>
        <ApplicantID></ApplicantID>

        <Provider>$loanprovider</Provider>
        <ProviderRef>$loanprovider</ProviderRef>
        <AccountNumber>$loanprovider</AccountNumber>
        <SourceName>$sourceName</SourceName>
        <ClaimType>PAYDAY-LOAN</ClaimType>

        <Title>$title</Title>
        <FirstName>$firstname</FirstName>
        <OtherName>$othername</OtherName>
        <LastName>$lastname</LastName>

        <DateofBirth>$dob</DateofBirth>

        <PreviousName>$previousname</PreviousName>

        <Address1>$address1</Address1>
        <Address2>$address2</Address2>
        <Address3>$city</Address3>
        <Address4>$county</Address4>
        <PostCode>$postcode</PostCode>

        <PreviousAddresses>
            $previousAddressesXml
        </PreviousAddresses>

        <Email>$email</Email>

        <HomeTelephone>$hometel</HomeTelephone>
        <WorkTelephone>$worktel</WorkTelephone>
        <MobileTelephone>$mobiletel</MobileTelephone>

        <Files>
            <Group>
                <Description>Contract</Description>
                <File>$contractFile</File>
            </Group>
            <Group>
                <Description>LOA</Description>
                <File>$loaFile</File>
            </Group>
        </Files>

        <CustomerType>Payday Loan</CustomerType>

        <CaseAssessor>
            <Questionnaire>
                <Question>
                    <QuestionNumber>1</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>2</QuestionNumber>
                    <QuestionAnswer>$totalloans</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>3</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>4</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>5</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>6</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>7</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>8</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>9</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>10</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>11</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>12</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>13</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>14</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>15</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>16</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>17</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>18</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>19</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>20</QuestionNumber>
                    <QuestionAnswer></QuestionAnswer>
                </Question>
            </Questionnaire>
        </CaseAssessor>

        <CustomerQuestionnaire>
            <Question>
                <QNo>1</QNo>
                <Answer>$iva</Answer>
            </Question>
            <Question>
                <QNo>2</QNo>
                <Answer>$dmp</Answer>
            </Question>
            <Question>
                <QNo>3</QNo>
                <Answer>$specialcircumstances</Answer>
            </Question>
            <Question>
                <QNo>6</QNo>
                <Answer>$marketingEmail</Answer>
            </Question>
            <Question>
                <QNo>7</QNo>
                <Answer>$marketingSms</Answer>
            </Question>
            <Question>
                <QNo>8</QNo>
                <Answer>$marketingTelephone</Answer>
            </Question>
            <Question>
                <QNo>9</QNo>
                <Answer>$marketingPost</Answer>
            </Question>
            <Question>
                <QNo>10</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>11</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>12</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>13</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>14</QNo>
                <Answer>$specialcircumstances</Answer>
            </Question>
            <Question>
                <QNo>15</QNo>
                <Answer>$resumeLink</Answer>
            </Question>
        </CustomerQuestionnaire>
    </Case>
XML;
            }
        } else {
            foreach ($customer->loans as $loan) {
                $optin = 'No';
                $ppi   = 'No';

                $alreadymadecontact = $loan->claimed_before ? 'Yes' : 'No';
                $totalloans         = 1;
                $instalments        = $loan->rollovers;
                $borrowed           = $loan->capital;
                $yearofborrow       = $loan->date->format('Y');
                $borrowingbehaviour = '';
                $didlenderofferhelp = '';
                $outstandingloans   = '';
                $arreas             = '';
                $writtenoff         = '';
                $miscinfo           = '';

                $agreementId         = $loan->agreement_id;
                $date                = $loan->agreement_id != 'LETTER' ? $loan->date->format('M Y') : '';
                $capital             = $loan->agreement_id != 'LETTER' ? $loan->capital : '';
                $claimedBefore       = $loan->previously_claimed ? 'Yes' : 'No';
                $singleRepayment     = $loan->agreement_id != 'LETTER' ? ($loan->single_repayment ? 'Yes' : 'No') : '';
                $rollovers           = $loan->agreement_id != 'LETTER' ? $loan->rollovers : '';
                $rolloverOutOfDebt   = $loan->agreement_id != 'LETTER' ? ($loan->missed_payment_rollover_offered ? 'Yes' : 'No') : '';
                $lastLoanDescription = $loan->agreement_id != 'LETTER' ? $loan->state->description : '';
                $simonBotch          = $loan->missed_payment_rollover_offered ? 'Our client also advises that on at least one occasion that their loan payment was missed and they fell into arrears. They state that the rollover loan was offered as a way to resolve this situation and bring the loan out of the collections process. Failure to repay the loan should have indicated there was a possibility that the borrower was in financial difficulty and as such forbearance should have been shown. To take an action that simply move the problem to another month, cost them more and still left them with the same level of indebtedness is an indicator of irresponsible lending. In these situations we would have expected to see the interest and charges frozen and a suitable, affordable, repayment plan put in place.' : '';

                $loanprovider   = $loan->lender ? htmlentities($loan->lender->name) : '';
                $customProvider = $loan->lender_id == 0 ? ucfirst($loan->lender_name) : $loan->lender->name;

                $cases[] = <<<XML
    <Case>
        <CreateCase>2</CreateCase>
        <UserName>Simon Hatch</UserName>
        <ApplicantID></ApplicantID>

        <ClaimType>PAYDAY-LOAN</ClaimType>
        <Provider>$loanprovider</Provider>
        <ProviderRef>$customProvider</ProviderRef>
        <AccountNumber>$customProvider</AccountNumber>
        <SourceName>$sourceName</SourceName>


        <Title>$title</Title>
        <FirstName>$firstname</FirstName>
        <OtherName>$othername</OtherName>
        <LastName>$lastname</LastName>

        <DateofBirth>$dob</DateofBirth>

        <PreviousName>$previousname</PreviousName>

        <Address1>$address1</Address1>
        <Address2>$address2</Address2>
        <Address3>$city</Address3>
        <Address4>$county</Address4>
        <PostCode>$postcode</PostCode>

        <PreviousAddresses>
            $previousAddressesXml
        </PreviousAddresses>

        <Email>$email</Email>

        <HomeTelephone>$hometel</HomeTelephone>
        <WorkTelephone>$worktel</WorkTelephone>
        <MobileTelephone>$mobiletel</MobileTelephone>

        <Files>
            <Group>
                <Description>Contract</Description>
                <File>contract.pdf</File>
            </Group>
            <Group>
                <Description>LOA</Description>
                <File>loa.pdf</File>
            </Group>
        </Files>

        <CustomerType>Payday Loan</CustomerType>

        <CaseAssessor>
            <Questionnaire>
                <Question>
                    <QuestionNumber>1</QuestionNumber>
                    <QuestionAnswer>$alreadymadecontact</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>2</QuestionNumber>
                    <QuestionAnswer>$totalloans</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>3</QuestionNumber>
                    <QuestionAnswer>$instalments</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>4</QuestionNumber>
                    <QuestionAnswer>$borrowed</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>5</QuestionNumber>
                    <QuestionAnswer>$yearofborrow</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>6</QuestionNumber>
                    <QuestionAnswer>$borrowingbehaviour</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>7</QuestionNumber>
                    <QuestionAnswer>$didlenderofferhelp</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>8</QuestionNumber>
                    <QuestionAnswer>$outstandingloans</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>9</QuestionNumber>
                    <QuestionAnswer>$arreas</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>10</QuestionNumber>
                    <QuestionAnswer>$writtenoff</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>11</QuestionNumber>
                    <QuestionAnswer>$miscinfo</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>12</QuestionNumber>
                    <QuestionAnswer>$agreementId</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>13</QuestionNumber>
                    <QuestionAnswer>$date</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>14</QuestionNumber>
                    <QuestionAnswer>$capital</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>15</QuestionNumber>
                    <QuestionAnswer>$claimedBefore</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>16</QuestionNumber>
                    <QuestionAnswer>$singleRepayment</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>17</QuestionNumber>
                    <QuestionAnswer>$rollovers</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>18</QuestionNumber>
                    <QuestionAnswer>$rolloverOutOfDebt</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>19</QuestionNumber>
                    <QuestionAnswer>$lastLoanDescription</QuestionAnswer>
                </Question>
                <Question>
                    <QuestionNumber>20</QuestionNumber>
                    <QuestionAnswer>$simonBotch</QuestionAnswer>
                </Question>
            </Questionnaire>
        </CaseAssessor>

        <CustomerQuestionnaire>
            <Question>
                <QNo>1</QNo>
                <Answer>$iva</Answer>
            </Question>
            <Question>
                <QNo>2</QNo>
                <Answer>$dmp</Answer>
            </Question>
            <Question>
                <QNo>3</QNo>
                <Answer>$specialcircumstances</Answer>
            </Question>
            <Question>
                <QNo>4</QNo>
                <Answer>$optin</Answer>
            </Question>
            <Question>
                <QNo>5</QNo>
                <Answer>$ppi</Answer>
            </Question>
            <Question>
                <QNo>6</QNo>
                <Answer>$marketingEmail</Answer>
            </Question>
            <Question>
                <QNo>7</QNo>
                <Answer>$marketingSms</Answer>
            </Question>
            <Question>
                <QNo>8</QNo>
                <Answer>$marketingTelephone</Answer>
            </Question>
            <Question>
                <QNo>9</QNo>
                <Answer>$marketingPost</Answer>
            </Question>
            <Question>
                <QNo>10</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>11</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>12</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>13</QNo>
                <Answer>No</Answer>
            </Question>
            <Question>
                <QNo>14</QNo>
                <Answer>$specialcircumstances</Answer>
            </Question>
            <Question>
                <QNo>15</QNo>
                <Answer>$resumeLink</Answer>
            </Question>
        </CustomerQuestionnaire>

    </Case>
XML;
            }
        }

        $casesBlock = implode("\n", $cases);
        $xml        = <<<XML
<Application>
<Cases>
    $casesBlock
</Cases>
</Application>
XML;
//echo '<pre>';
//echo htmlentities($xml);
//exit();
        return $xml;
    }

    private function byArray($zipFile)
    {
        // Create the byte array in the format the XMLReceive understands
        $fileName = $zipFile;

        if (file_exists($fileName)) {
            $data = "";
            $fp   = fopen($fileName, "r");
            while (!feof($fp)) $data .= fread($fp, 1024);
            fclose($fp);

            $byArray = $data;
        } else {
            $byArray = NULL;
        }

        return $byArray;
    }

    private function postXML($url, $xml, $byArray)
    {
        /*
            If you are getting an error "Class 'SoapClient' not found"....
            Locate php.ini in your apache bin folder, I.e Apache/bin/php.ini.
            Remove the ; from the beginning of extension=php_soap.dll.
            Restart your Apache server.
        */
        $soapclient = new SoapClient($url . '/XMLReceive.asmx?WSDL');
        $result     = $soapclient->CaseApplicationZipped(array("XMLApplication" => $xml, "byArray" => $byArray));

        return $result;
    }

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    public function submitToBrightOffice(Customer $customer, $forcePotential = false)
    {
        $zipFile = tempnam(sys_get_temp_dir(), 'brightOfficeUpload-');
        unlink($zipFile); // https://stackoverflow.com/questions/64698935/using-ziparchive-with-php-8-and-temporary-files

        $zip     = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE) !== true) {
            exit("Failed to generate final copies of required documents\n");
        }

        try {
            $loa      = Storage::get($customer->getLoaPdfPath());
            $contract = Storage::get($customer->getContractPdfPath());
        } catch (\Exception $e) {
            $loa      = '';
            $contract = '';
            Log::error('Not DOCUMENTS - ' . $e->getMessage() . ', Line: ' . $e->getFile());
        }

        $zip->addFromString("loa.pdf", $loa);
        $zip->addFromString("contract.pdf", $contract);
        $zip->close();

        // *********************************************************************************************************
        // submit data!
        // code unashameedly stolen from bright office's example.  It's super ugly, but is supplied as "working".

        $url = "http://www.carloanrefundsoffice.com";
        $xml = $this->generateXML($customer, $forcePotential);

        $xmlPath = 'xmls/' . $customer->id . ($forcePotential ? '-potential' : '-real') . '.xml';
        Storage::put($xmlPath, $xml);

        $byArray = $this->byArray($zipFile);
        unlink($zipFile); // cleanup after ourselves
        $result = $this->postXML($url, $xml, $byArray);

        $xmlResult = simplexml_load_string($result->CaseApplicationZippedResult);

        if (empty($xmlResult) || $xmlResult->references->reference != 'Record created OK') {
            $this->eror = self::ERROR_UNKNOWN;

            return false;
        }

        $this->error = null;

        return true;
    }
}
