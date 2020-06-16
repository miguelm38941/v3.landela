<?php

namespace App\Imports;

use App\Models\StandardBL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class StandardBLImport implements ToModel, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        if (!isset($row[0]) && !isset($row[1]) && !isset($row[2])) {
            return null;
        }
        if ($row[1] === NULL) {
            return null;
        }
        if ($row[0] === "DelivryNote") {
            return null;
        }

        return new StandardBL([
            'delivery_note' => $row[0],
            'purchase_order' => $row[1],
            'supplier_code' => $row[2],
            'supplier_label' => $row[3],
            'refinery_code' => $row[4],
            'refinery_label' => $row[5],
            'installation_code' => $row[6],
            'installation_label' => $row[7],
            'customer_code' => $row[8],
            'customer_label' => $row[9],
            'product_code' => $row[10],
            'product_label' => $row[11],
            'loadin_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]),
            'transporter_code' => $row[13],
            'transporter_label' => $row[14],
            'transport_include' => $row[15],
            'quantity' => $row[16],
            'buying_price' => $row[17],
            'transport_rate' => $row[18],
            'selling_price' => $row[19],
            'code_customer_to_invoce' => $row[20]
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le bon de livraison est requis');
                }
            },
            '1' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le bon de commande est requis');
                }
            },
            '2' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code fournisseur est requis');
                }
            },
            '4' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code raffinerie est requis');
                }
            },
            '6' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code installation est requis');
                }
            },
            '8' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code client est requis');
                }
            },
            '10' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code produit est requis');
                }
            },
            '12' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('La date de chargement est requise');
                }
            },
            '13' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Le code transporter est requis');
                }
            },
            '15' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('Transport incluse est requis');
                }
            },
            '16' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure('La quantité est requise');
                }
            },
            '17' => function($attribute, $value, $onFailure) {
                if ($value === '') {
                     $onFailure("Le prix d'achatest requis");
                }
            },
        ];
    }
}
