<?php

use Illuminate\Database\Seeder;

class FormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formData = [
            'title'=>'Test Form',
            'description'=>'description',
            'bg_color'=>'#fff',
            'date'=>now(),
            'place'=>'place',
            'btn_text'=>'btn_text',
            'btn_color'=>'#fff',
        ];

        $form = \App\Form::create($formData);

        $formPageData = [
            'title'=>'Test Page',
            'description'=>'description',
            'bg_color'=>'#fff',
            'btn_text'=>'btn_text',
            'btn_color'=>'#fff',
        ];

        $page = $form->pages()->create($formPageData);

        $pageFieldsData = [
            'label_name'=>'text',
            'place_holder'=>'text',
            'min_value'=>0,
            'max_value'=>191,
            'is_required'=>true,
            'field_id'=>1,
        ];
        $page->fields()->create($pageFieldsData);

    }
}
