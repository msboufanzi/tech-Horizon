<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define your themes data
        $themes = [
            [
                'title' => 'Cybersecurity',
                'description' => 'Cybersecurity involves protecting computer systems, networks, and data from unauthorized access, attacks, or damage. It includes practices like encryption, firewalls, and threat detection to safeguard sensitive information and ensure privacy and integrity.',
                'manager_id' => 1,
            ],
            [
                'title' => 'Artificial Intelligence (AI)',
                'description' => 'AI refers to the simulation of human intelligence in machines programmed to think, learn, and make decisions. It encompasses areas like machine learning, natural language processing, and robotics, enabling applications like virtual assistants, recommendation systems, and autonomous vehicles.',
                'manager_id' => 2,
            ],
            [
                'title' => 'Cloud Computing',
                'description' => 'Cloud computing is the delivery of computing services (like storage, servers, databases, and software) over the internet. It allows users to access resources on-demand, offering scalability, cost efficiency, and flexibility in managing data and applications.',
                'manager_id' => 3,
            ],
            [
                'title' => 'Game Development',
                'description' => 'Game development is the process of creating video games, combining programming, design, art, and storytelling. It involves building gameplay mechanics, graphics, and sound, often using game engines like Unity or Unreal Engine.',
                'manager_id' => 1,
            ],
            [
                'title' => 'Data Science',
                'description' => 'Data science is the field of analyzing large volumes of data to extract valuable insights and knowledge. It integrates techniques from statistics, machine learning, and programming to solve real-world problems in areas like business, healthcare, and technology.',
                'manager_id' => 3,
            ],
            [
                'title' => 'Internet of Things (IoT)',
                'description' => 'IoT refers to the network of interconnected devices embedded with sensors and software, enabling them to collect and exchange data. Examples include smart homes, wearable devices, and industrial automation, enhancing efficiency and connectivity.',
                'manager_id' => 2,
            ],

        ];

        //* Insert the data into the themes table
        foreach ($themes as $theme) {
            Theme::create($theme);
        }
    }
}
