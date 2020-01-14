<?php

use Illuminate\Database\Seeder;

class FieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [
            [
                'name'=>'text',
                'type'=>1,
            ],[
                'name'=>'number',
                'type'=>2,
            ],[
                'name'=>'select',
                'type'=>3,
            ],[
                'name'=>'checkbox',
                'type'=>4,
            ],[
                'name'=>'radiobutton',
                'type'=>5,
            ],[
                'name'=>'textarea',
                'type'=>6,
            ],[
                'name'=>'image',
                'type'=>7,
            ],[
                'name'=>'signature',
                'type'=>8,
            ],
        ];

        foreach ($dataArray as $data)
            \App\Field::create($data);
    }
}
