<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meeting;

class MeetingSeeder extends Seeder
{

  public function run()
  {
    $services = [
      [        
        'name' => 'Meeting Room 1',
    
      ],

      [       
        'name' => 'Meeting Room 2',

      ],
      [       
        'name' => 'Meeting Room 3',

      ],
      [       
        'name' => 'Meeting Room 4',        
      ],
    ];

    meeting::insert($services);
  }
}
