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
            //* Id 1 is reserved by editor
            [
                'title' => 'Cybersecurity',
                'description' => 'Cybersecurity involves protecting computer systems, networks, and data from unauthorized access, attacks, or damage. It includes practices like encryption, firewalls, and threat detection to safeguard sensitive information and ensure privacy and integrity.',
                'manager_id' => 2,
                'image' => 'https://media.istockphoto.com/id/1358828002/photo/cyber-security-concept-man-using-virtual-screen-with-padlock-illustration-closeup.jpg?s=1024x1024&w=is&k=20&c=AhlN8heHDCtrImFzp9igG8YJc9r5ltH1SwhTRLXc8W4=',
            ],
            [
                'title' => 'Artificial Intelligence (AI)',
                'description' => 'AI refers to the simulation of human intelligence in machines programmed to think, learn, and make decisions. It encompasses areas like machine learning, natural language processing, and robotics, enabling applications like virtual assistants, recommendation systems, and autonomous vehicles.',
                'manager_id' => 3,
                'image' => 'https://media.istockphoto.com/id/1453770260/photo/businessman-touching-the-brain-working-of-artificial-intelligence-automation-predictive.jpg?s=2048x2048&w=is&k=20&c=xUanndH-SEKWVdBFFQ5VVu-Y_CtWTXURTyJx8XpHYHc=',
            ],
            [
                'title' => 'Cloud Computing',
                'description' => 'Cloud computing is the delivery of computing services (like storage, servers, databases, and software) over the internet. It allows users to access resources on-demand, offering scalability, cost efficiency, and flexibility in managing data and applications.',
                'manager_id' => 4,
                'image' => 'https://media.istockphoto.com/id/1318623693/photo/cloud-computing.jpg?s=612x612&w=0&k=20&c=GIgvKe92Oh6ZvTkRxTg7hNZSXjf3_0fNIyiak4gVUgg=',
            ],
            [
                'title' => 'Game Development',
                'description' => 'Game development is the process of creating video games, combining programming, design, art, and storytelling. It involves building gameplay mechanics, graphics, and sound, often using game engines like Unity or Unreal Engine.',
                'manager_id' => 5,
                'image' => 'https://www.mooc.org/hubfs/game-development-programming-languages.jpg',
            ],
            [
                'title' => 'Data Science',
                'description' => 'Data science is the field of analyzing large volumes of data to extract valuable insights and knowledge. It integrates techniques from statistics, machine learning, and programming to solve real-world problems in areas like business, healthcare, and technology.',
                'manager_id' => 6,
                'image' => 'https://media.istockphoto.com/id/1389240110/photo/businessman-use-tablet-on-data-science-and-business-of-modern-technology-idea-and-creative.jpg?s=612x612&w=0&k=20&c=D1dDI0Psjm8lVlU7JBsOfbAMhpkg-r-pLtc-589eHv8=',
            ],
            [
                'title' => 'Internet of Things (IoT)',
                'description' => 'IoT refers to the network of interconnected devices embedded with sensors and software, enabling them to collect and exchange data. Examples include smart homes, wearable devices, and industrial automation, enhancing efficiency and connectivity.',
                'manager_id' => 7,
                'image' => 'https://imageio.forbes.com/specials-images/imageserve/65a840d4f0598075b91e8c0f/0x0.jpg?format=jpg&height=900&width=1600&fit=bounds',
            ],
        ];

        //* Insert the data into the themes table
        foreach ($themes as $theme) {
            Theme::create($theme);
        }
    }
}