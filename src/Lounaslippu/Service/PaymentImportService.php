<?php
/**
 * Created by IntelliJ IDEA.
 * User: kostersson
 * Date: 27.4.2015
 * Time: 1:42
 */

namespace Lounaslippu\Service;


use Lounaslippu\Model\Payment;
use Lounaslippu\Repository\PaymentRepository;
use Tsoha\Redirect;

class PaymentImportService
{
    /**
     * @var PaymentRepository
     */
    private $paymentRepository;


    /**
     * PaymentImportService constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function importCsv()
    {
        $file = fopen($_FILES['csvFile']['tmp_name'], "r");
        $payments = array();
        while (!feof($file)) {
            $row = fgetcsv($file, 0, "\t");
            if (count($row) == 14 && $row[0] != "Kirjauspäivä") {
                $dateOfPayment = new \DateTime($row[2]);
                $values = array(
                    'date_of_payment' => $dateOfPayment->format('Y-m-d H:i:s'),
                    'amount' => $this->makeFloat($row[3]),
                    'reference_number' => $row[8],
                    'amount_left' => 0,
                );
                $payments[] = new Payment($values);
            }
        }
        fclose($file);
        $insert = $this->paymentRepository->insert($payments);
        if($insert !== true){
            $message = "Maksujen kirjaamisessa tapahtui virhe.<br />" . $insert;
            $error = array("error" => $message);
            ErrorService::setErrors($error);
            return;
        }
        Redirect::to("/maksut/syotto", array("success" => "Maksut kirjattu onnistuneesti."));

    }

    private function makeFloat($str)
    {
        if (strstr($str, ",")) {
            $str = str_replace(" ", "", $str);
            $str = str_replace(",", ".", $str);
        }
        return floatval($str);
    }
}