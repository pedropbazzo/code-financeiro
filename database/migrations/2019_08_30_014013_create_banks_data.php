<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /** @var \CodeFinance\Repositories\BankRepository $repository */
        $repository = app(\CodeFinance\Repositories\BankRepository::class);

        foreach ($this->getData() as $bankArray) {
            $repository->create($bankArray);

            //Dorme por um segundo depois executa o próximo
            sleep(1);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function getData() {
        return [
            [
                'name' => 'Caixa',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/logo-caixa.png'), 'logo-caixa.png'
                )
            ],
            [
                'name' => 'Bradesco',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/logo-bradesco.png'), 'logo-bradesco.png'
                )
            ],
            [
                'name' => 'Itau',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/logo-itau.png'), 'logo-itau.png'
                )
            ],
            [
                'name' => 'Santander',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/logo-santander.png'), 'logo-santander.png'
                )
            ],
            [
                'name' => 'Banco do Brasil',
                'logo' => new \Illuminate\Http\UploadedFile(
                    storage_path('app/files/banks/logos/logo-banco-brasil.jpg'), 'logo-banco-brasil.jpg'
                )
            ],
        ];
    }
}
