<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = 10;
        $path = 'https://s3-eu-west-1.amazonaws.com/gallery-project/';

        $images = array(
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139065.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139092.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139129.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139158.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139218.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139243.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139302.png',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139330.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139358.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139402.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139429.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139470.jpg',
            'https://s3-eu-west-1.amazonaws.com/gallery-project/1547139940.jpg'
        );

        $downloadUrls = array(
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139065.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139092.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139129.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139158.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139218.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139243.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139302.png',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139330.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139358.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139402.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139429.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139470.jpg',
            'https://gallery-project.s3.eu-west-1.amazonaws.com/1547139940.jpg'
        );


        for($i=0; $i < $records; $i++){
            DB::table('images')->insert([
                'userId' => rand(1,5),
                'imageName' => 'Test Image '.($i+1),
                'imagePath' => $images[$i],
                'imageDownloadUrl' => $downloadUrls[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
